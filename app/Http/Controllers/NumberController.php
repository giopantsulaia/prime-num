<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrimeNumbersRequest;
use App\Jobs\ProcessNumbers;
use Illuminate\Http\JsonResponse;

class NumberController extends Controller
{
    public function submit(PrimeNumbersRequest $request): JsonResponse
    {
        ProcessNumbers::dispatch($request->numbers);

        return response()->json(['success' => true]);
    }
}
