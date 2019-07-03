<?php

namespace App\Http\Requests\Api\v1\Campaigns;

use Illuminate\Foundation\Http\FormRequest;

class AdditionalSettingsUpdateRequest extends FormRequest
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
            'thread_count'  => ['integer', 'min:0'],
            'timeout'       => ['integer', 'min:0']
        ];
    }
}
