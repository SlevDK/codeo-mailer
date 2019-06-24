<?php

namespace App\Http\Requests\Api\v1\Auth;

use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'exists:users'],
            'password' => ['required']
        ];
    }

    /**
     * Reloaded validation exception
     *
     * @param Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw $this->customValidationException();
    }

    /**
     * Return validation exception with custom message
     *
     * @param array $errors
     * @return \Illuminate\Validation\ValidationException
     */
    public function customValidationException(array $errors = [])
    {
        return \Illuminate\Validation\ValidationException::withMessages([
            "non_field_errors" => [
                "Unable to log in with provided credentials."
            ]
        ]);
    }
}
