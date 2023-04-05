<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\User;
use App\Traits\Helper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{

    use Helper;

    public function getTheCurrentUserGroup(): JsonResponse
    {
        $group =  GroupResource::collection(
            Group::where('user_id1', Auth::user()->id)->get(),
        );

        if (count($group) == 0) {
            $group =  GroupResource::collection(
                Group::where('user_id2', Auth::user()->id)->get(),
            );
        }


        return response()->json($group);
    }

    /**
     * Create a group with the two user
     *
     * @return \Illuminate\Http\Response
     */

     //a refacto pour bien catcher les erreurs etc.
    public function setGroup($partnerCode)
    {
        $userId = Auth::user()->id;

        try {
            $idPartner = User::where('personal_code',  $partnerCode)->value('id');



        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Erreur lors de la récupération de l\'ID du partenaire: ' . $e->getMessage(),
            ]);
        }

        if (!$idPartner) {
            return response()->json([
                'code' => 404,
                'message' => 'Aucun utilisateur trouvé pour le code partenaire donné.',
            ]);
        }

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
        User::where('id', $idPartner)->update(['other_code' => Auth::user()->personal_code]);
        User::where('id', $userId)->update(['other_code' => $partnerToModify->personal_code]);

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


    /**
     * Return the count group
     * @return \Illuminate\Http\Response
     */
    public function get_total_groups()
    {
        try {
            $total = DB::table('groups')->count();
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        return response()->json([
            'count' => $total,
        ]);
    }
}
