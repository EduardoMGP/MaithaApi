<?php

namespace App\Http\Requests;

use App\Http\Resources\ApiResource;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->routeIs('api.register')) {
            return [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email',
                ],
                'password' => 'required|string|min:8|confirmed',
            ];
        } else if ($this->routeIs('api.login')) {
            return [
                'email' => 'required|email',
                'password' => 'required',
            ];
        }

        return [];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('api.required', ['attribute' => 'name']),
            'email.required' => __('api.required', ['attribute' => 'email']),
            'password' => [
                'required' => __('api.required', ['attribute' => 'password']),
                'min' => __('api.min', ['attribute' => 'password', 'min' => 8]),
                'confirmed' => __('api.password_confirmed'),
            ],
            'email' => [
                'required' => __('api.required', ['attribute' => 'email']),
                'unique' => __('api.email.unique', ['attribute' => 'email']),
                'email' => __('api.email.email', ['attribute' => 'email']),
                'max' => __('api.max', ['attribute' => 'email', 'max' => 255]),
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = ApiResource::make(
            null, $validator->errors(),
            __('api.validation_error'), false, Response::HTTP_UNPROCESSABLE_ENTITY
        )->response();

        throw new ValidationException($validator, $response);
    }

}
