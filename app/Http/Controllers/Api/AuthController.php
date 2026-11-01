<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials  = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $token = auth('api')->attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => 'ایمیل یا رمز عبور اشتباه است.',
            ], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout(){
        auth('api')->logout();

        return response()->json([
           'message' => 'Successfully logged out'
        ]);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();

        return response()->json([
            'access_token' => $token,
           'token_type' => 'bearer',
        ]);
    }
}
