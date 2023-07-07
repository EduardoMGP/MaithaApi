<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\ApiResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return ApiResource::make(UserResource::collection(User::all()));
    }

    public function show($id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (!$user)
            return ApiResource::make(null, __('api.user.not_found'), false);

        return ApiResource::make(UserResource::make($user));
    }

    public function create(UserRequest $request)
    {
        return ApiResource::make(UserResource::make(User::create($request->all()), __('api.user.created')));
    }

    public function update(UserRequest $request, $id)
    {
        if (!empty($request->all())) {
            /** @var User $user */
            $user = User::find($id);

            if (!$user)
                return ApiResource::make(null, __('api.user.not_found'), false);

            if ($user->update($request->all()))
                return ApiResource::make(UserResource::make($user), __('api.user.updated'), true);
        }

        return ApiResource::make(null, __('api.user.not_updated'), false);
    }

    public function delete(Request $request, $id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (!$user)
            return ApiResource::make(null, __('api.user.not_found'), false);

        if ($user->delete())
            return ApiResource::make(null, __('api.user.deleted'), true);

        return ApiResource::make(null, __('api.user.not_deleted'), false);
    }

}
