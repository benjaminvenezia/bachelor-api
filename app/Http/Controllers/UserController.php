<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  UserResource::collection(
            User::all(),
        );

        return $users;
    }

    /**
     * Find an user by our otherCode value
     *
     * @return \Illuminate\Http\Response
     */
    public function findUserByCode(Request $request, $code)
    {
        if (User::where('personalCode', '=', $code)->count() === 0) {
            return response()->json([
                'message' => 'Erreur, ce code est rattaché a aucun utilisateur.',
            ]);
        }

        $partner = User::where('personalCode', $code)->first();

        return $partner;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user()->id !== $user->id) {
            // return $this->error('', 'You are not authorized to make this request', 403);
            $errorHandling = [
                'message' => "You are not authorized to make this request",
                'code' => 403
            ];

            return json_encode($errorHandling);
        }

        $user->update($request->all());

        return new UserResource($user);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(User $user)
    // {
    //     return $this->isNotAuthorized($user) ? $this->isNotAuthorized($user) : new UserResource($user);
    //     //$task = Task::find($id); pas nécessaire cf shortcut. :)
    // }

    private function isNotAuthorized($user)
    {
        if (Auth::user()->id !== $user->id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }
}
