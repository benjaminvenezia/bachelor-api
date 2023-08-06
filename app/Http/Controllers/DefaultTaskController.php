<?php

namespace App\Http\Controllers;

use App\Http\Requests\DefaultTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\DefaultTaskResource;
use App\Models\DefaultTask;
use Illuminate\Http\JsonResponse;
use App\Traits\HandlesDatabaseErrors;

class DefaultTaskController extends Controller
{
    use HandlesDatabaseErrors;

    public function get_all_defaults_tasks(): JsonResponse
    {
        try {
            $defaultTasks = DefaultTaskResource::collection(
                DefaultTask::all(),
            );

            return response()->json(['data' => $defaultTasks]);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function store_default_task(DefaultTaskRequest $taskRequest): JsonResponse
    {
        try {
            $validatedData = $taskRequest->validated();

            $defaultTasks = DefaultTask::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'category' => $validatedData['category'],
                'reward' => $validatedData['reward'],
                'path_icon_todo' => $validatedData['path_icon_todo'],
            ]);

            return response()->json($defaultTasks);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }


    public function show_default_task(DefaultTask $defaultTask): JsonResponse
    {
        try {
            return response()->json($defaultTask);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function update_default_task(StoreTaskRequest $taskRequest, DefaultTask $defaultTask): JsonResponse
    {
        try {
            $defaultTask->update($taskRequest->validated());

            return response()->json(new DefaultTaskResource($defaultTask));
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function destroy_default_task(DefaultTask $defaultTask): JsonResponse
    {
        try {
            $defaultTask->delete();
            return response()->json(new DefaultTaskResource($defaultTask));
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }
}
