<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $guiltyUser = User::where('id', $this->user_id)->first();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'is_done' => $this->is_done,
            'cost' => $this->cost,
            'date_string' => $this->date_string,
            'day' => $this->day,
            'month' => $this->month,
            'year' => $this->year,
            'user_id' => $this->user_id,
            'user_name' => $guiltyUser->name,
            'user_points' => $guiltyUser->points
        ];
    }
}
