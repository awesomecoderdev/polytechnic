<?php

namespace App\Jobs;

use App\Models\Result;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SaveCollectedResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $results)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this?->results ?? [] as $key => $rslt) {
            try {
                $result = Result::where("roll", $rslt["roll"])->where("semester", $rslt["semester"])->firstOrNew();
                $result->roll = $rslt["roll"];
                $result->gpa = $rslt["results"]["gpa"];
                $result->failed = str_replace(["{ ", " }"], "", $rslt["results"]["subjects"]);
                $result->semester = $rslt["semester"];
                $result->regulation = $rslt["regulation"];
                $result->published = $rslt["Date"];
                $result->institute = $rslt["institute"];
                $result->metadata = $rslt["results"];
                $result->save();
            } catch (\Throwable $th) {
                //throw $th;
                // skip
            }
        }
    }
}
