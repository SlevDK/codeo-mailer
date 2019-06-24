<?php

namespace App\Http\Requests\Api\Auth;

use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'max:255']
        ];
    }

    /**
     * Reloaded validation exception
     *
     * @param Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     * @throws CustomValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $validation_errors = $validator->failed();

        if(isset($validation_errors['email']['Unique']))
            throw $this->customValidationException([
                'code' => 33,
                'message' => 'User with provided username/email already exists'
            ]);

        parent::failedValidation($validator);
    }

    /**
     * Return validation exception with custom message
     *
     * @param array $errors
     * @return CustomValidationException
     */
    public function customValidationException(array $errors = [])
    {
        $ex = new CustomValidationException('');
        return $ex->withErrors($errors);
    }
}
