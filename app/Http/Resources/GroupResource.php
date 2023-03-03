<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'id' => $this->id,
            'GroupName' => $this->name,
            'user1' => User::where('id', '=', $this->user_id1)->get(),
            'user2' =>  User::where('id', '=', $this->user_id2)->get(),
        ];
    }
}
