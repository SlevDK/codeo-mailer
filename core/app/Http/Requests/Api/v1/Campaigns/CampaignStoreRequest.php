<?php

namespace App\Http\Requests\Api\v1\Campaigns;

use App\Exceptions\Api\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CampaignStoreRequest extends FormRequest
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
            'name'  => ['string', 'min:3', 'max:255'],
            'note'  => ['string']
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
