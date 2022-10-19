<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    //

    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username',$request->username)->first();
        
        if ( !$user || !Hash::check($request->password,$user->password)){
            return response()->json([
                'message' => 'invalid login'
            ],401);
        }

        return response()->json([
            'token' => $user->createToken('auth-sanctum')->plainTextToken,
            'role' => $user->role 
        ],200);

    }

    public function logout(){
        $token = PersonalAccessToken::findToken(request('token'));
        if ( $token == NULL){
            return response()->json([
                'message' => 'Unauthorized user'
            ],401);
        }

        $user = $token->tokenable;
        $user->tokens()->where('id', request('token'))->delete();

        return response()->json([
            'message' => 'logout success'
        ],200);
    }

}
