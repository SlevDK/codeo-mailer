<?php

namespace App\Http\Requests\Api\v1\Campaigns;

use Illuminate\Foundation\Http\FormRequest;

class FromEmailSettingsUpdateRequest extends FormRequest
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
            'limit'             => ['integer', 'min:0'],
            'limit_interval'    => ['integer', 'min:0'],
            'mode'              => ['integer', 'min:0'],
            'pause_time'        => ['integer', 'min:0'],
            'ssl_limit'         => ['integer', 'min:0'],
            'thread_limit'      => ['integer', 'min:0'],
        ];
    }
}
