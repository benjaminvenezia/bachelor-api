<?php

namespace App\Traits;

/**
 * This trait is used to when printing the requests.
 */
trait HttpResponses
{
    protected function success($data, string $message = null, int $code = 200)
    {
        return response()->json([
            'status' => 'Request was succesful',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($data, string $message = null, int $code)
    {
        return response()->json([
            'status' => 'Error has occured...',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
