<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'reward' => $this->reward,
            'is_done' => $this->is_done,
            'associated_day' => $this->associated_day,
            'path_icon_todo' => $this->path_icon_todo
            // 'userId' => $this->user_id,
            // 'user name' => $this->user->name,
            // 'user email' => $this->user->email,
        ];
    }
}
