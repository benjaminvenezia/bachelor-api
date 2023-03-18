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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $task = DefaultTask::create([
                'id' => $request->id,
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'reward' => $request->reward,
                'path_icon_todo' => $request->path_icon_todo,
            ]);

            return $task;
        } catch (\Exception $e) {
            $errorMessage = 'Une erreur s\'est produite lors de la création de la tâche par défaut.';
            $errorCode = 500;

            if ($e instanceof \Illuminate\Database\QueryException) {
                $errorMessage = 'Une erreur s\'est produite lors de l\'exécution de la requête SQL.';
                $errorCode = 400;
            }

            return response()->json(['error' => $errorMessage, 'details' => $e->getMessage()], $errorCode);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DefaultTask  $defaultTask
     * @return \Illuminate\Http\Response
     */
    public function show(DefaultTask $defaultTask)
    {
        try {
            return $defaultTask;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        try {
            $defaultTask->update($request->all());

            return new DefaultTaskResource($defaultTask);
        } catch (\Exception $e) {
            return $this->error('Update error', $e->getMessage(), 500);
        }
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
