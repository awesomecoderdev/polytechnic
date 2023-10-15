<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Jobs\SaveCollectedResult;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CollectMoreResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $roll, public $maximum = 1000, public $chunk = 300)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            foreach (["4th", "5th", "6th", "7th", "8th"] as $key => $semester) {
                $response = Http::timeout(5)->get('https://btebresultsbd.com/api/group', [
                    'startRoll' => $this->roll,
                    'endRoll' => $this->roll + $this->maximum,
                    'semester' => $semester,
                    'technology' => "diploma in engineering",
                ]);

                if ($response->successful()) {
                    $results = $response->json("result", []);
                    $results = array_chunk($results, $this->chunk);
                    foreach ($results as $key => $list) {
                        SaveCollectedResult::dispatch($list);
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            // skip
        }
    }
}
