<?php

namespace App\Traits;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

/**
 * This trait is used to when printing the requests.
 */
trait Helper
{

    static function getCurrentGroupId(): int|string
    {
        $group = GroupResource::collection(
            Group::where('user_id1', Auth::user()->id)->get(),
        );

        if (count($group) == 0) {
            $group = GroupResource::collection(
                Group::where('user_id2', Auth::user()->id)->get(),
            );
        }

        return $group[0]->id;
    }
}
