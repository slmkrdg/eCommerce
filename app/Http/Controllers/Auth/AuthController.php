<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status'  => '0',
                'message' => 'Bilgiler hatalı'
            ], 401);
        }

        $user = Auth::user();

        // Token oluşturma
        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json([
            'status'  => '1',
            'message' => 'İşlem başarılı',
            'data'    => [            
                'user'  => $user,
                'token' => $token,
            ]
        ]);
    }
}
