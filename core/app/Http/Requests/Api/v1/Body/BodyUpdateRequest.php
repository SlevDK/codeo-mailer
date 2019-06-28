<?php

namespace App\Http\Requests\Api\v1\Body;

use Illuminate\Foundation\Http\FormRequest;

class BodyUpdateRequest extends FormRequest
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
            'content'   => ['required', 'string']
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
            'content.required'  => 'content missing',
            'content.string'    => 'content must be string'
        ];
    }
}
