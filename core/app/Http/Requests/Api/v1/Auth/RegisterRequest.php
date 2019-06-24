<?php

namespace App\Http\Requests\Api\v1\Auth;

use App\Exceptions\Api\AlreadyExistException;
use App\Exceptions\Api\ValidationException;
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
            'username'  => ['required', 'string', 'min:4', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'min:6', 'max:255']
        ];
    }

    /**
     * Custom validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'Username required',
            'email.required'    => 'Email required',
            'password.required' => 'Password required'
        ];
    }

    /**
     * Reloaded validation exception
     *
     * @param Validator $validator
     * @throws AlreadyExistException
     * @throws ValidationException
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        // failed fields
        $failed = $validator->failed();
        $first = array_shift($failed);

        // failed array is empty
        if(!$first)
            parent::failedValidation($validator);

        // if user already exists (`unique` trigger)
        if(isset($first['Unique']))
            throw new AlreadyExistException('User with username/email already exists');

        // errors during validation
        $errors = $validator->errors()->toArray();

        throw new ValidationException(array_shift($errors)[0]);
    }
}
