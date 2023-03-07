<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\TasksResource;
use App\Models\Group;
use App\Models\Task;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    use HttpResponses;

    /**
     * Return the id of the current user Group.
     *
     * @return void
     */
    public function getCurrentGroupId(): int|string
    {
        $group = GroupResource::collection(
            Group::where('user_id1', Auth::user()->id)->get(),
        );

        if (count($group) == 0) {
            $group =  GroupResource::collection(
                Group::where('user_id2', Auth::user()->id)->get(),
            );
        }

        return $group[0]->id;
    }


    /**
     * Display a listing of the resource.
     * Retourne toutes les tâches pour le groupe actuel
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupId = $this->getCurrentGroupId();

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

        $task = Task::create([
            'id' => $request->id,
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

        $groupId = $this->getCurrentGroupId();

        if ($groupId === $task->group_id) {
            return $task;
        } else {
            return $this->isNotAuthorized($task);
        }

        //$task = Task::find($id); pas nécessaire cf shortcut. :)
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
        $group =  GroupResource::collection(
            Group::where('user_id1', Auth::user()->id)->get(),
        );

        if (count($group) == 0) {
            $group =  GroupResource::collection(
                Group::where('user_id2', Auth::user()->id)->get(),
            );
        }

        if ($group[0]->id === $task->group_id) {
            $task->update($request->all());

            return new TasksResource($task);
        } else {

            return $this->error('', 'You are not authorized to make this request', 403);
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
        return $this->isNotAuthorized($task) ? $this->isNotAuthorized($task) : $task->delete();
    }

    private function isNotAuthorized($task)
    {
        if (Auth::user()->id !== $task->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }
}
