<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class AuthRequest extends UserRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $route = $this->route()->getName();

        switch ($route) {
            case 'api.register':
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:users,email',
                    'password' => 'required|string|min:8|confirmed',
                ];

            case 'api.login':
                return [
                    'email' => 'required|email',
                    'password' => 'required',
                ];

            case 'api.logout.all':
                return [
                    'password' => 'required',
                ];

            default:
                return [];
        }
    }

}
