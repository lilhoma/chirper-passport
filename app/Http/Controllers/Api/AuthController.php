<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password'])
        ]);

        $user -> email_verified_at = now();
        $user -> remember_token = Str::random(10);
        $user -> save();

        return response()->json(['user' => $user]);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Las credenciales son válidas
            $user = Auth::user();

            // Genera un nuevo token de acceso
            $token = $user->createToken('token')->accessToken;

            return response()->json(['user' => $user, 'access_token' => $token]);
        }

        // Las credenciales son inválidas
        return response()->json(['error' => 'Invalid Credentials'], 401);
    }

    public function logout()
    {
        auth() -> user() -> tokens -> each(function($token, $key){
            $token -> delete();
        });

        return response() -> json('Logged Out succesfully', 201);

    }

}