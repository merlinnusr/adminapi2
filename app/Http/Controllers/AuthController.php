<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;

class AuthController extends Controller
{
    public function login(StoreLoginRequest $request)
    {
        $data = $request->validated();

        if (! $token = auth()->attempt($data)) {
            throw new \Exception('Unauthorized');
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
