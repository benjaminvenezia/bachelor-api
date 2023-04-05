<?php

namespace App\Traits;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

trait HandlesDatabaseErrors
{
    /**
     * Handle a database error and return a JSON response with an error message and code.
     *
     * @param \Exception $e
     * @param int $defaultErrorCode
     * @param string $defaultErrorMessage
     * @return JsonResponse
     */
    static function handleDatabaseError(\Exception $e, int $defaultErrorCode = 500, string $defaultErrorMessage = 'Une erreur s\'est produite lors de l\'exécution de la requête SQL.'): JsonResponse
    {
        $errorCode = $defaultErrorCode;
        $errorMessage = $defaultErrorMessage;

        if ($e instanceof QueryException) {
            $errorCode = 400;
        }

        return response()->json(['error' => $errorMessage, 'details' => $e->getMessage()], $errorCode);
    }
}
