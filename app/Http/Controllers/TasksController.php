<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\TasksResource;
use App\Models\Group;
use App\Models\Task;
use App\Traits\Helper;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    use HttpResponses;
    use Helper;

    /**
     * Display a listing of the resource.
     * Retourne toutes les tâches pour le groupe actuel
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupId = Helper::getCurrentGroupId();

        $tasks = TasksResource::collection(
            Task::where('group_id', $groupId)->get(),
        );

        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $request->validated($request->all());

        $groupId = Helper::getCurrentGroupId();

        $task = Task::create([
            'id' => $request->id,
            'group_id' => $groupId,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'reward' => $request->reward,
            'is_done' => $request->is_done,
            'path_icon_todo' => $request->path_icon_todo,
            'associated_day' => $request->associated_day
        ]);

        return new TasksResource($task);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_multiple(Request $request)
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
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }


    /**
     * Display the specified resource.'
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        try {
            $groupId = Helper::getCurrentGroupId();

            if ($groupId === $task->group_id) {
                return $task;
            } else {
                return $this->isNotAuthorized($task);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        try {
            $groupId = Helper::getCurrentGroupId();

            if ($groupId === $task->group_id) {
                $task->update($request->all());

                return new TasksResource($task);
            } else {
                return $this->error('', 'You are not authorized to make this request', 403);
            }
        } catch (\Exception $e) {
            return $this->error('Update error', $e->getMessage(), 500);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggle_task(Request $request, Task $task)
    {
        try {
            $groupId = Helper::getCurrentGroupId();

            if ($groupId === $task->group_id) {
                $task->update(['is_done' => (int)!$task->is_done]);

                return new TasksResource($task);
            } else {
                return $this->error('', 'You are not authorized to make this request', 403);
            }
        } catch (\Exception $e) {
            return $this->error('Update error', $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        try {
            $groupId = Helper::getCurrentGroupId();

            if ($groupId !== $task->group_id) {
                return $this->error('', 'You are not authorized to make this request', 403);
            }

            $task->delete();

            return new TasksResource($task);
        } catch (\Exception $e) {
            return $this->error('', $e->getMessage(), 500);
        }
    }

    private function isNotAuthorized($task)
    {
        if (Auth::user()->id !== $task->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }
}
