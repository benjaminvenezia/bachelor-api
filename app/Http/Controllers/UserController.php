<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Traits\HandlesDatabaseErrors;

class UserController extends Controller
{
    use HandlesDatabaseErrors;

    public function index(): JsonResponse
    {
        try {
            $users =  UserResource::collection(
                User::all(),
            );

            return response()->json($users);
        } catch (Exception $e) {

            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function getCurrentUser(): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                throw new Exception('L\'utilisateur n\'est pas authentifié', 401);
            }

            return response()->json($user);
        } catch (Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    //Cette méthode est certainement trop permissive (retourne email etc.)
    public function show(string $code): JsonResponse
    {
        try {
            if (User::where('personal_code', '=', $code)->count() === 0) {
                throw new \Exception('Erreur, ce code est rattaché a aucun utilisateur.', 403);
            }

            $user = User::where('personal_code', $code)->first();

            return response()->json($user);
        } catch (Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e, $e->getCode(), $e->getMessage());
        }
    }

    public function update(UserRequest $userRequest, User $user): JsonResponse
    {
        try {
            if (!Auth::user()) {
                throw new \Exception('Erreur lors de la mise à jour de l\'utilisateur: l\'utilisateur est non connecté.', 400);
            }

            if (Auth::user()->id !== $user->id) {
                throw new \Exception('Vous n\'avez pas le droit de faire cette requête.', 403);
            }

            $user->update($userRequest->validated());

            return response()->json(new UserResource($user));
        } catch (Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e, $e->getCode(), $e->getMessage());
        }
    }
}
