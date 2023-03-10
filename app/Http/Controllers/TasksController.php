<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\MyHelper;

class TasksController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     * Retourne toutes les tâches pour le groupe actuel
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupId = MyHelper::getCurrentGroupId();

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

        $groupId = MyHelper::getCurrentGroupId();

        $task = Task::create([
            'id' => $request->id,
            'group_id' => $groupId,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'reward' => $request->reward,
            'isDone' => $request->isDone,
            'associated_day' => $request->associated_day
        ]);

        return new TasksResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        try {
            $groupId = MyHelper::getCurrentGroupId();

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
            $groupId = MyHelper::getCurrentGroupId();

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        try {
            $groupId = MyHelper::getCurrentGroupId();

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
