<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 * This trait is used to when printing the requests.
 */
trait HttpResponses
{
    protected function success(mixed $data, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error(mixed $data, string $message = null, int $code): JsonResponse
    {
        return response()->json([
            'status' => 400,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
