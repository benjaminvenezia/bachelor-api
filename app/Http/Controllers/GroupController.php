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
        $userId = Auth::user()->id;

        if (Group::where('user_id1', '=', $userId)->count() > 0 || Group::where('user_id2', '=', $idPartner)->count() > 0) {
            return response()->json([
                'message' => 'Erreur, un group avec cet identifiant existe déjà!',
            ]);
        }

        $group = new Group();
        $group->user_id1 = $userId;
        $group->user_id2 = $idPartner;
        $group->name = "Les petits nettoyeurs";

        $group->save();

        return response()->json([
            'message' => 'Groupe crée avec succès!',
        ]);
    }
}
