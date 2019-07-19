<?php

namespace App\Http\Requests\Api\v1\Database;

use Illuminate\Foundation\Http\FormRequest;

class FileStoreRequest extends FormRequest
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
            'name'  => ['string', 'alpha_num'],
            'file'  => ['file', 'mimetypes:text/plain', 'mimes:txt']
        ];
    }
}