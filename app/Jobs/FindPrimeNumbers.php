<?php

namespace App\Jobs;

use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FindPrimeNumbers implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;

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
        foreach($this->numbers as $number) {
            if($this->isPrimeNum($number)) {
                Log::channel('prime')->info($number . ": number found at ". Carbon::now());
            }
        }
    }

    private function isPrimeNum(int|float $number): bool
    {
        if ($number <= 1) {
            return false;
        }
        for ($i = 2; $i * $i <= $number; $i++) {
            if ($number % $i == 0) {
                return false;
            }
        }
        return true;
    }
}
