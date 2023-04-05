<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use App\Traits\Helper;
use App\Traits\HttpResponses;
use App\Traits\HandlesDatabaseErrors;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    use HttpResponses;
    use Helper;
    use HandlesDatabaseErrors;

    public function index(): JsonResponse
    {
        try {
            $groupId = Helper::getCurrentGroupId();

            $tasks = TasksResource::collection(
                Task::where('group_id', $groupId)->get(),
            );

            return response()->json($tasks);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function store(StoreTaskRequest $storeTaskrequest): JsonResponse
    {
        try {
            $groupId = Helper::getCurrentGroupId();

            $task = Task::create([
                'id' => $storeTaskrequest->id,
                'group_id' => $groupId,
                'user_id' => Auth::user()->id,
                'title' => $storeTaskrequest->title,
                'description' => $storeTaskrequest->description,
                'category' => $storeTaskrequest->category,
                'reward' => $storeTaskrequest->reward,
                'is_done' => $storeTaskrequest->is_done,
                'path_icon_todo' => $storeTaskrequest->path_icon_todo,
                'associated_day' => $storeTaskrequest->associated_day
            ]);

            $resource = new TasksResource($task);
            return response()->json($resource);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function store_multiple(Request $request): JsonResponse
    {
        try {
            $groupId = Helper::getCurrentGroupId();

            $tasks = $request->input('tasks');

            if (!is_array($tasks)) {
                throw new Exception("Le paramètre 'tasks' doit être un tableau");
            }

            $tasksData = [];

            foreach ($tasks as $task) {

                $validatedData = Validator::make($task, (new StoreTaskRequest())->rules())->validate();

                $taskData = [
                    'id' => $validatedData['id'],
                    'group_id' => $groupId,
                    'category' => $validatedData['category'],
                    'title' => $validatedData['title'],
                    'description' => $validatedData['description'],
                    'reward' => $validatedData['reward'],
                    'is_done' => $validatedData['is_done'],
                    'associated_day' => $validatedData['associated_day'],
                    'path_icon_todo' => $validatedData['path_icon_todo']
                ];

                array_push($tasksData, $taskData);
            }

            Task::insert($tasksData);

            return response()->json(['message' => "Les tâches ont été ajoutées", 'date' => $tasksData], 200);
        } catch (Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function show(Task $task): JsonResponse
    {
        try {
            if (Auth::user()->id !== $task->user_id) {
                throw new Exception('You are not authorized to make this request', 403);
            }

            $groupId = Helper::getCurrentGroupId();

            if ($groupId === $task->group_id) {
                return response()->json($task);
            }

            return response()->json('Task not found', 404);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function update(StoreTaskRequest $request, Task $task): JsonResponse
    {
        try {
            $groupId = Helper::getCurrentGroupId();

            if ($groupId === $task->group_id) {
                $task->update($request->all());
                return response()->json(new TasksResource($task));
            } else {
                return $this->error('', 'You are not authorized to make this request', 403);
            }
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function toggle_task(Task $task): JsonResponse
    {
        try {
            $groupId = Helper::getCurrentGroupId();

            if ($groupId === $task->group_id) {
                $task->update(['is_done' => (int)!$task->is_done]);

                return response()->json(new TasksResource($task));
            } else {
                throw new \Exception('You are not authorized to make this request', 403);
            }
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e, $e->getCode(), $e->getMessage());
        }
    }

    public function destroy(Task $task): JsonResponse
    {
        try {
            $groupId = Helper::getCurrentGroupId();

            if ($groupId !== $task->group_id) {
                throw new \Exception('You are not authorized to make this request', 403);
            }

            $task->delete();

            return response()->json(new TasksResource($task));

        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e, $e->getCode(), $e->getMessage());
        }
    }
}
