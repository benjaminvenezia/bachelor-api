<?php

namespace App\Helpers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class MyHelper
{

    public static function getCurrentGroupId(): int|string
    {
        $group = GroupResource::collection(
            Group::where('user_id1', Auth::user()->id)->get(),
        );

        if (count($group) == 0) {
            $group =  GroupResource::collection(
                Group::where('user_id2', Auth::user()->id)->get(),
            );
        }

        if (!is_array($group)) {
            return false;
        }

        return $group[0]->id;
    }
}
