<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\MyHelper;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Vos identifiants ne correspondent pas', 401);
        }
        $user = User::where('email', $request->email)->first();

        if (Auth::user()->otherCode === "") {
            return $this->error('', 'Vous devez vous lier à votre partenaire avant d\'accéder à la page d\'accueil', 401);
        }

        // if (!MyHelper::getCurrentGroupId()) {
        //     return $this->error('', 'Il semblerait que vous ne soyez pas dans un groupe... Ceci ne devrait pas arriver, merci de contacter le support. :)', 401);
        // }

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'personalCode' => $request->personalCode
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have been successfully been logged out and your token has been deleted',
        ]);
    }
}
