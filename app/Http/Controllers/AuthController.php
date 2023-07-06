<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(AuthRequest $request)
    {
        $user = User::create($request->validated());
        return ApiResource::make(UserResource::make($user),
            __('api.user_created'), true, Response::HTTP_CREATED
        );
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->validated();
        if (!auth()->attempt($credentials)) {
            return ApiResource::make(null,
                __('api.invalid_credentials'), false, Response::HTTP_UNAUTHORIZED
            );
        }
        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->token = $token;
        $user->refresh_token = $token;

        return ApiResource::make(UserResource::make($user),
            __('api.login_success'), true, Response::HTTP_OK
        );
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return ApiResource::make(null,
            __('api.logout_success'), true, Response::HTTP_OK
        );
    }
}
