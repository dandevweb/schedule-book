<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LoginResource;
use App\Exceptions\LoginInvalidException;

class LoginController extends Controller
{
    public function __invoke(Request $request): LoginResource
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (! Auth::attempt($data)) {
            throw new LoginInvalidException('O login está incorreto');
        }

        $user = user();

        $token = [
            'access_token' => $user->createToken('auth_token')->plainTextToken,
            'token_type'   => 'Bearer',
        ];

        $response = new LoginResource($user);

        return $response->additional($token);
    }
}
