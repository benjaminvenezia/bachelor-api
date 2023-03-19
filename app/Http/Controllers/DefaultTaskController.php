<?php

namespace App\Http\Controllers;

use App\Http\Resources\DefaultTaskResource;

use App\Models\DefaultTask;
use Illuminate\Http\Request;

class DefaultTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $defaultTasks = DefaultTaskResource::collection(
                DefaultTask::all(),
            );

            return $defaultTasks;
        } catch (\Exception $e) {
            $errorMessage = 'Une erreur s\'est produite lors de la récupération des données.';
            $errorCode = 500;

            if ($e instanceof \Illuminate\Database\QueryException) {
                $errorMessage = 'Une erreur s\'est produite lors de l\'exécution de la requête SQL.';
                $errorCode = 400;
            }

            return response()->json(['error' => $errorMessage, 'details' => $e->getMessage()], $errorCode);
        }
    }
}
