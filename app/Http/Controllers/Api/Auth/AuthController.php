<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    public function loginWithGoogle(Request $request)
    {
        // Log::info('request from frontend', ["data" => $request->all()]);

        $request->validate([
            'access_token' => 'required|string',
        ]);

        try {

            $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->access_token);

            $user = User::updateOrCreate(
                [
                    'email' => $googleUser->getEmail(),
                ],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password' => null
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Invalid Google Token',
                'message' => $e->getMessage()
            ], 401);
        }
    }
}
