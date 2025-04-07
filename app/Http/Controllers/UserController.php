<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return new UserCollection(User::all());
    }

    public function show($username)
    {
        if ($user = User::where('username', $username)->first()){
            return new UserResource($user);
        }else{
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $userValidator = $request->validate(
            [
                'username' => 'required|string',
//                'password' => '<PASSWORD>',
                'password' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'address' => 'required|string',
            ]
        );

        if (User::where('username', $userValidator['username'])->first())
            return response()->json(['message' => 'User already exists'], 400);

        if (User::where('email', $userValidator['email'])->first())
            return response()->json(['message' => 'Email already exists'], 400);

        if (User::where('phone', $userValidator['phone'])->first())
            return response()->json(['message' => 'Phone already exists'], 400);

        return new UserResource(User::create($userValidator));
    }

    public function update(Request $request, $username){
        $userValidator = $request->validate(
            [
                'username' => 'string',
//                'password' => '<PASSWORD>',
                'password' => 'string',
                'email' => 'email',
                'phone' => 'string',
                'address' => 'string',
            ]
        );

        if ($user = User::where('username', $username)->first()){
            $user->update($userValidator);
            return new UserResource($user);
        }else{
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function destroy($username){
        if ($user = User::where('username', $username)->first()){
            $user->delete();
            return response()->json(['message' => 'User deleted'], 200);
        }else{
            return response()->json(['message' => 'User not found'], 404);
        }
    }

}
