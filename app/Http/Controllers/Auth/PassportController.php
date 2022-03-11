<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => 'required',
            'remember' => 'boolean'
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);
        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'error' => 'The provided credentials are not correct'
            ], 422);
        }


        /**
         * @var User $user
         */


        $user = Auth::user();
        $token = $user->createToken('main')->accessToken;

        return response([
            'user' => $user,
            'token' => $token,
        ]);

    }


    public function logout()
    {
        /**
         * @var User $user
         */

        $user = Auth::user();
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        return response([
            'success' => true
        ]);

    }
}
