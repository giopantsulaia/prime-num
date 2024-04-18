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
        try {
            $validatedData = $request->validated();

            FindPrimeNumbers::dispatch($validatedData['numbers']);

            return response()->json(['success' => true]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return response()->json(['errors' => $exception->errors()], 422);
        }
    }
}
