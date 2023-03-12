<?php

namespace App\Traits;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * This trait is used to when printing the requests.
 */
trait Helper
{




    /**
     * Return the id of current group
     *
     * @return integer|string
     */
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

        if (count($group) > 0) {
            return $group[0]->id;
        } else {
            return null;
        }
    }

    static function getCurrentPartner()
    {
        try {
            $partner = User::where('personalCode', Auth::user()->otherCode)->firstOrFail();

            return $partner;
        } catch (ModelNotFoundException $e) {
            return new JsonResponse([
                'message' => 'Erreur: Vous ne pouvez pas attribuer de gage car vous n\'êtes lié à aucun utilisateur. Cela ne devrait pas arriver, merci de contacter le développeur.'
            ]);
        }
    }

    static function getCurrentPartnerId()
    {
        try {
            $partner = User::where('personalCode', Auth::user()->otherCode)->firstOrFail();


            return $partner->id;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}
