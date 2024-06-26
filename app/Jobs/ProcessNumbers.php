<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class ProcessNumbers implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected array $numbers)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $batchSize = 100;
        $chunkedNumbers = array_chunk($this->numbers, $batchSize);

        $jobs = collect($chunkedNumbers)->map(function ($chunk) {
            return new FindPrimeNumbers($chunk);
        });

        Bus::batch($jobs)->dispatch();
    }
}
