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
        $user1 = User::where('id', '=', $this->user_id1)->get();
        $user2 = User::where('id', '=', $this->user_id2)->get();

        $pts1 = $user1[0]->points;
        $pts2 = $user2[0]->points;

        $delta = ($pts1 > $pts2) ? $pts1 - $pts2 : $pts2 - $pts1;
        $winner = ($pts1 > $pts2) ? $user1[0]->name : $user2[0]->name;
        $looser = ($pts1 > $pts2) ? $user2[0]->name : $user1[0]->name;

        return [
            'idGroup' => $this->id,
            'GroupName' => $this->name,
            'idUser1' => $user1[0]->id,
            'idUser2' => $user2[0]->id,
            'user1Points' => $user1[0]->points,
            'user2Points' => $user2[0]->points,
            'delta' => $delta,
            'winner' => $winner,
            'looser' => $looser

        ];
    }
}
