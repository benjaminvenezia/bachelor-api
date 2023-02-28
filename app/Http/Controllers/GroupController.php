<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Create a group with the two user
     *
     * @return \Illuminate\Http\Response
     */
    public function setGroup(Request $request, $idPartner)
    {
        $group = new Group();
        $userId = Auth::user()->id;

        $group->user_id1 = $userId;
        $group->user_id2 = $idPartner;
        $group->name = "Les petits nettoyeurs";

        $group->save();
    }
}
