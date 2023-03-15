<?php

namespace App\Http\Controllers;

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
            $defaultTasks = DefaultTask::all();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DefaultTask  $defaultTask
     * @return \Illuminate\Http\Response
     */
    public function show(DefaultTask $defaultTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DefaultTask  $defaultTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DefaultTask $defaultTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DefaultTask  $defaultTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(DefaultTask $defaultTask)
    {
        //
    }
}
