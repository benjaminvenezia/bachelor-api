<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Traits\HandlesDatabaseErrors;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;
    use HandlesDatabaseErrors;

    public function login(LoginUserRequest $request): JsonResponse
    {
        try {
            $request->validated($request->all());

            if (!Auth::attempt($request->only(['email', 'password']))) {
                throw new Exception('Vos identifiants ne correspondent pas', 401);
            }

            $user = Auth::user();

            if(!$user) {
                throw new Exception('Vous devez vous authentifier', 401);
            }

            if ($user->other_code === "") {
                throw new Exception('Vous devez vous lier à votre partenaire avant d\'accéder à la page d\'accueil', 403);
            }

            return $this->success([
                'user' => $user,
                'token' => $user->createToken('Api Token of ' . $user->name)->plainTextToken,
            ]);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function register(StoreUserRequest $request): JsonResponse
    {
        try {
            $request->validated($request->all());

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'personal_code' => $request->personal_code
            ]);

            return $this->success([
                'user' => $user,
                'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
            ]);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }

    public function logout(): JsonResponse
    {   
        try {
            $user = Auth::user();

            if (!$user) {
                throw new Exception('L\'utilisateur n\'est pas authentifié', 401);
            }
    
            $user->currentAccessToken()->delete();
    
            return $this->success([
                'message' => 'You have been successfully been logged out and your token has been deleted',
            ]);
        } catch (\Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
      
    }
}
