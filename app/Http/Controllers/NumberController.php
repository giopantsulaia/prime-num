<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrimeNumbersRequest;
use App\Jobs\FindPrimeNumbers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    public function submit(PrimeNumbersRequest $request): JsonResponse
    {
        FindPrimeNumbers::dispatch($request->validated());

        return response()->json(['success' => true]);
    }
}
