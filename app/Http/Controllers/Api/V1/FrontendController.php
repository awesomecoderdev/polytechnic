<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response as HTTP;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Http as HttpRequest;

class FrontendController extends Controller
{
    /**
     * Display a index route default response.
     */
    public function index(Request $request)
    {

        /**
            foreach (range('a', 'z') as $key => $search) {
                $response = HttpRequest::get("https://btebresultszone.com/api/institutes/search?search=$search");
                $collages = $response->json();

                $data = collect($collages)->map(function ($item, $key) {
                    $collage = [
                        "name" => str_replace([", ,", "  "], [",", " "], $item["name"]),
                        "eiin" => $item["code"],
                        "district" => $item["district"],
                    ];
                    return $collage;
                })->toArray();



                foreach ($data as $key => $value) {
                    try {
                        $collage = new Collage();
                        $collage->name = $value["name"];
                        $collage->eiin = $value["eiin"];
                        $collage->district = $value["district"];
                        $collage->save();
                    } catch (\Throwable $th) {
                        // throw $th;
                    }
                }
            }
         */




        try {
            $student = $request->user('student');
            // $student->load(["address", "bookings"]);
            return Response::json([
                "success" => true,
                "status" => 200,
                "message" => "Polytechnic API Version V0.1",
            ],  HTTP::HTTP_OK); // HTTP::HTTP_OK
        } catch (\Exception $e) {
            //throw $e;
            return Response::json([
                'success'   => false,
                'status'    => HTTP::HTTP_FORBIDDEN,
                'message'   => "Something went wrong.",
                'err' => $e->getMessage(),
            ],  HTTP::HTTP_FORBIDDEN); // HTTP::HTTP_OK
        }
    }

    /**
     * Display a auth route default response.
     */
    public function auth(Request $request)
    {
        return Response::json([
            "success" => true,
            "status" => 200,
            "message" => "{$request->collage?->name} | Auth Version V0.1",
        ],  HTTP::HTTP_OK); // HTTP::HTTP_OK

    }
}
