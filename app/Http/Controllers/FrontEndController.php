<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Jobs\CollectMoreResult;
use App\Jobs\SaveCollectedResult;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FrontEndController extends Controller
{
    /**
     * Display a index route default response.
     */
    public function index(Request $request)
    {
        $semesters = [
            'all' => "All Semester",
            '1st' => '1st',
            '2nd' => '2nd',
            '3rd' => '3rd',
            '4th' => '4th',
            '5th' => '5th',
            '6th' => '6th',
            '7th' => '7th',
            '8th' => '8th'
        ];

        return view("index", compact("semesters"));
    }

    /**
     * Display a index route default response.
     */
    public function result(Request $request)
    {
        $semesters = [
            'all' => "All Semester",
            '1st' => '1st',
            '2nd' => '2nd',
            '3rd' => '3rd',
            '4th' => '4th',
            '5th' => '5th',
            '6th' => '6th',
            '7th' => '7th',
            '8th' => '8th'
        ];

        $request->validate([
            "roll" => "required",
            "semester" => "required",
        ], [
            "roll.required" => "Roll No can't be empty."
        ]);

        $roll = intval($request->roll);
        $semester = $request->input("semester", "8th");

        $response = Http::get('https://btebresultsbd.com/api/result', [
            'rollNumber' => $roll,
            'technology' => "diploma in engineering",
        ]);

        try {
            $results = Cache::remember("{$roll}_{$semester}", 5 * 60, function () use ($roll, $semester, $request) {
                $results = Result::where("roll", $roll)
                    // ->where("semester", "<=", $request->input("semester", "8th"))
                    ->when($request->semester, function ($query) use ($request) {
                        $semester = $request->input("semester", "8th");
                        if ($semester == "all") {
                            return $query;
                        }
                        return $query->where("semester", $semester);
                    })
                    ->orderBy("semester", "DESC")
                    ->get();

                if (!$results->count() > 0) {
                    CollectMoreResult::dispatch($roll, 5000);

                    $response = Http::get('https://btebresultsbd.com/api/result', [
                        'rollNumber' => $roll,
                        'technology' => "diploma in engineering",
                    ]);
                    if ($response->successful()) {
                        $rslts = $response->object();

                        foreach ($rslts as $key => $rslt) {
                            if (isset($rslt?->roll)) {
                                $result = Result::where("roll", $rslt?->roll)
                                    ->where("semester", $rslt?->semester)->firstOrNew();
                                $result->roll = $roll;
                                $result->gpa = $rslt?->results?->gpa;
                                $result->failed = str_replace(["{ ", " }"], "", $rslt?->results?->subjects ?? "");
                                $result->semester = $rslt?->semester;
                                $result->regulation = $rslt?->regulation;
                                $result->published = $rslt?->Date;
                                $result->institute = $rslt?->institute;
                                $result->metadata = $rslt?->results;
                                $result->save();
                            }
                        }
                    }

                    $results = Result::where("roll", $roll)
                        // ->where("semester", "<=", $request->input("semester", "8th"))
                        ->when($request->semester, function ($query) use ($request) {
                            $semester = $request->input("semester", "8th");
                            if ($semester == "all") {
                                return $query;
                            }
                            return $query->where("semester", $semester);
                        })
                        ->orderBy("semester", "DESC")
                        ->get();
                }

                return $results;
            });
        } catch (\Throwable $th) {
            throw $th;
            CollectMoreResult::dispatch($roll, 50);
        }

        if (!$results?->count() > 0) {
            return redirect()->route("index")->withErrors([
                "result" => "No Results found."
            ]);
        }

        return view("index", compact("semesters", "results", "roll"));
    }
}
