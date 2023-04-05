<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\User;
use App\Traits\Helper;
use App\Traits\HandlesDatabaseErrors;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{

    use Helper;
    use HandlesDatabaseErrors;

    public function getTheCurrentUserGroup(): JsonResponse
    {
        $group =  GroupResource::collection(
            Group::where('user_id1', Auth::user()->id)->get(),
        );

        if (count($group) == 0) {
            $group = GroupResource::collection(
                Group::where('user_id2', Auth::user()->id)->get(),
            );
        }

        return response()->json($group);
    }

    public function setGroup($partnerCode): JsonResponse
    {
        try {
            $userId = Auth::user()->id;
            $idPartner = User::where('personal_code',  $partnerCode)->value('id');

            if (!$idPartner) {
                throw new Exception('Aucun utilisateur trouvé pour le code partenaire donné.', 404);
            }

            if (Group::where('user_id1', '=', $userId)->count() > 0 || Group::where('user_id2', '=', $idPartner)->count() > 0) {
                throw new Exception('Erreur, un des deux utilisateurs est déjà dans un groupe.', 403);
            }

            if ($idPartner == $userId) {
                throw new Exception('Vous ne pouvez composer un group avec vous même.', 403);
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
            
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e, $e->getCode(), $e->getMessage());
        }
    }

    public function get_total_groups(): JsonResponse
    {
        try {
            $total = DB::table('groups')->count();

            return response()->json(['count' => $total]);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        } 
    }
}
