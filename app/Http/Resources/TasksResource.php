<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'reward' => $this->reward,
            'isDone' => $this->isDone,
            'associatedDay' => $this->associated_day,
            'userId' => $this->user_id,
            'user name' => $this->user->name,
            'user email' => $this->user->email,
        ];
    }
}
