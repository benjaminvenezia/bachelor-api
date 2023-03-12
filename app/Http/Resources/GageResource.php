<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'is_done' => $request->is_done,
            'cost' => $request->cost,
            'date_string' => $request->date_string,
            'day' => $request->day,
            'month' => $request->month,
            'year' => $request->year,
            'user_id' => $this->user_id,
        ];
    }
}
