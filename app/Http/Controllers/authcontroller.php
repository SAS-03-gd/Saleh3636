<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class authcontroller extends Controller
{
    public function login(request $request)
    {
        $credentials=$request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);
        $user=User::where('email',$credentials['email'])->first();
        if(!$user)
        {
            return response()->json(['message'=>'user not found'],404);
        }
        if($user&&hash::check($credentials['password'],$user->password))
        {
            $token=$user->createToken('auth_token')->plainTextToken;
            return response()->json(['token'=>$token]);
        }
        return response()->json(['message'=>'invalid credentials'],401);
    }

    public function logout(request $request){
        $request->user('user')->currentAccessToken()->delete();
        return response()->json([
            'message'=>'logout succesful'
        ],);
    }

    public function register(request $request)
    {
        $input=$request->validate([
            'name'=>['required','string'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','confirmed']
        ]);

        $user=User::create($input);
        return response()->json([
            'message'=>'user created successfully',
            'user'=>$user,
            'token'=>$user->createToken('auth_token')->plainTextToken
        ],201);
            
    
    }

    public function profile(request $request){
        return response()->json(['user'=>$request->user()]);
    }
}
