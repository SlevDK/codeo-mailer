<?php

namespace App\Http\Requests\Api\v1\MailSettings;

use App\Exceptions\Api\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class MailSettingsUpdateRequest extends FormRequest
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
            'charset_randomize'     => ['boolean'],
            'dkim_signature'        => ['boolean'],
            'domain_key_signature'  => ['boolean'],
            'encoded_randomize'     => ['boolean'],
            'message_id_domain'     => ['string', 'max:255'],
            'mixer'                 => ['boolean'],
            'random_lines'          => ['integer', 'mix:0'],
            'received'              => ['boolean'],
            'time_randomize'        => ['boolean'],
            'tz_randomize'          => ['boolean'],
            'rotation_count'        => ['integer'],
            'rotation_mode'         => ['integer']
        ];
    }

    /**
     * Reloaded validation exception
     *
     * @param Validator $validator
     * @throws ValidationException
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        // errors during validation
        $errors = $validator->errors()->toArray();

        // failed array is empty
        if(empty($errors))
            parent::failedValidation($validator);

        throw new ValidationException(array_shift($errors)[0]);
    }
}
