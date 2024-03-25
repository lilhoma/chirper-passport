<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    // public function register()
    // {
    //     $validator = Validator::make(request()->input(), [
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|confirmed|min:8|max:255'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()],401);
    //     }

    //     request()->merge(['password' => bcrypt(request('password'))]);
    //     $user = User::create(request()->input());
    //     $success['token'] = $user -> createToken('chirp_access_token') -> accessToken;

    //     return response()->json($success);
    // }

    // public function logout()
    // {
    //     auth()->user()->tokens->each(function ($token, $key){
    //         $token->delete();
    //     });
    //     return response()->json('Logged out succesfully', 200);
    // }

    // public function login() 
    // {
    //     if (auth()->attempt(request()->input())) {
    //         $user = auth()->user();
    //         $success['token'] =$user -> createToken('chirp_access_token') -> accessToken;
    //         return response()->json($success, 200);
    //     } else
    //     {

    //     }
    // }
}
