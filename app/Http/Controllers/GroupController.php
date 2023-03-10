<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\User;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{

    use Helper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTheCurrentUserGroup()
    {
        $group =  GroupResource::collection(
            Group::where('user_id1', Auth::user()->id)->get(),
        );

        if (count($group) == 0) {
            $group =  GroupResource::collection(
                Group::where('user_id2', Auth::user()->id)->get(),
            );
        }

        return $group;
    }

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
                'code' => 403,
                'message' => 'Erreur, un des deux utilisateurs est déjà dans un groupe.',
            ]);
        }

        if ($idPartner == $userId) {
            return response()->json([
                'code' => 403,
                'message' => 'Vous ne pouvez composer un group avec vous même.',
            ]);
        }

        $partnerToModify = User::find($idPartner);
        User::where('id', $idPartner)->update(['otherCode' => Auth::user()->personalCode]);
        User::where('id', $userId)->update(['otherCode' => $partnerToModify->personalCode]);

        //--------
        $group = new Group();
        $group->user_id1 = $userId;
        $group->user_id2 = $idPartner;
        $group->name = "Les petits nettoyeurs";

        $group->save();

        return response()->json([
            'code' => 200,
            'message' => 'Groupe crée avec succès!',
        ]);
    }
}
