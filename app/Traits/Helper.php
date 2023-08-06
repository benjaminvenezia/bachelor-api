<?php

namespace App\Traits;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Traits\HandlesDatabaseErrors;

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
    static function getCurrentGroupId(): int|string|null|JsonResponse
    {
        try {

            if (!Auth::user()) {
                throw new Exception('Erreur lors de la récupération de l\'identifiant du groupe : l\'utiliseur n\'est pas connecté.');
            }

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
        } catch (Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e, 500, 'L\'identifiant du group n\'a pas pu être récupéré.');
        }
    }

    static function getCurrentPartner(): User
    {
        try {
            if (!Auth::user()) {
                throw new Exception('Erreur lors de la récupération du partenaire : l\'utiliseur n\'est pas connecté.');
            }

            $partner = User::where('personal_code', Auth::user()->other_code)->firstOrFail();

            return $partner;
        } catch (ModelNotFoundException $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e, 500, 'Erreur: Vous ne pouvez pas attribuer de gage car vous n\'êtes lié à aucun utilisateur. Cela ne devrait pas arriver, merci de contacter le développeur.');
        }
    }

    static function getPartnerId(): int|null|JsonResponse
    {
        try {
            if (!Auth::user()) {
                throw new Exception('Erreur lors de la récupération de l\'identifiant du partenaire : l\'utiliseur n\'est pas connecté.');
            }
            $partner = User::where('personal_code', Auth::user()->other_code)->firstOrFail();
            return $partner->id;
        } catch (Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e, 500, 'Une erreur est suvenur lors de la tentative vous lier à votre partenaire.');
        }
    }

    static function getUserId(): int|JsonResponse
    {
        try {
            if (!Auth::user()) {
                throw new Exception('Erreur lors de la récupération de l\'identifiant de l\'utilisateur : l\'utiliseur n\'est pas connecté.');
            }

            $userId = Auth::user()->id;
            return $userId;
        } catch (Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e, 500, 'Une erreur est suvenur lors de la tentative vous lier à votre partenaire.');
        }
    }
}
