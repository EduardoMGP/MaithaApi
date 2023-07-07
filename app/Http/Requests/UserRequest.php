<?php

namespace App\Http\Requests;

use App\Http\Resources\ApiResource;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'string|max:255',
            'email' => 'email|max:255|unique:users,email',
            'password' => 'string|min:8|confirmed',
        ];

        if ($this->routeIs('api.user.create')) {
            $rules['name'] .= '|required';
            $rules['email'] .= '|required';
            $rules['password'] .= '|required';
        }

       return $rules;
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
            'name.string' => __('api.name.string'),
            'name.max' => __('api.name.max', ['max' => 255]),
            'email.required' => __('api.required', ['attribute' => 'email']),
            'email.email' => __('api.email.email'),
            'email.max' => __('api.email.max', ['max' => 255]),
            'email.unique' => __('api.email.unique'),
            'password.required' => __('api.required', ['attribute' => 'password']),
            'password.string' => __('api.password.string'),
            'password.min' => __('api.password.min', ['min' => 8]),
            'password.confirmed' => __('api.password.confirmed'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = ApiResource::make($validator->errors(),
            __('api.validation_error'), false, Response::HTTP_UNPROCESSABLE_ENTITY
        )->response();

        throw new ValidationException($validator, $response);
    }

}
