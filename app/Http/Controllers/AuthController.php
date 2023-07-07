<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(AuthRequest $request)
    {
        $user = User::create($request->validated());
        return ApiResource::make(UserResource::make($user),
            __('api.user.created'), true, Response::HTTP_CREATED
        );
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            return ApiResource::make(null,
                __('api.invalid_credentials'), false, Response::HTTP_UNAUTHORIZED
            );
        }
        /** @var User $user */
        $user = Auth::user();
        $now = (new \DateTime())->setTimezone(new \DateTimeZone('America/Sao_Paulo'));
        $expire = $now->add(new \DateInterval('P2D'));
        $token = $user->createToken('auth_token', ['*'],  $expire)->plainTextToken;
        $user->token = $token;
        $user->token_expire_at = $expire;
        return ApiResource::make(UserResource::make($user),
            __('api.login_success'), true, Response::HTTP_OK
        );
    }

    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        $user->tokens()->find($user->currentAccessToken()->id)->delete();
        return ApiResource::make(null, __('api.logout_success'), true, Response::HTTP_OK);
    }

    public function logoutAll(AuthRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $credentials = $request->validated();
        $credentials['email'] = $user->email;
        if (!Auth::guard('web')->attempt($credentials))
            return ApiResource::make(null, __('api.invalid_credentials'), false, Response::HTTP_UNAUTHORIZED);

        $user->tokens()->delete();
        return ApiResource::make(null, __('api.logout_success'), true, Response::HTTP_OK);
    }
}
