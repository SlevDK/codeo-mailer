<?php

namespace App\Http\Requests\Api\v1\Header;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class HeaderUpdateRequest extends FormRequest
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
            'data'  => [
                'required', 'json',
                function($attr, $value, $fail) {
                    return $this->checkHeaderData($value, $fail);
                }
            ]
        ];
    }

    /**
     * Custom rule Clojure
     * @see https://laravel.com/docs/5.8/validation#using-closures
     *
     * @param $data
     * @param $fail
     * @return mixed
     */
    public function checkHeaderData($data, $fail)
    {
        $headers = json_decode($data, true);
        $err_msg = 'Header data is incorrect';

        foreach($headers as $entity) {

            // check 'content' -> present, 0 < len(content) < 255
            if(!isset($entity['content']) || strlen($entity['content']) < 1 || strlen($entity['content']) > 255)
                return $fail($err_msg);

            // check 'type' -> present, list or text
            if(!isset($entity['type']) || !in_array($entity['type'], ['list', 'text']))
                return $fail($err_msg);

            // check list 'id' (if type = list) -> present, must b integer
            if($entity['type'] == 'list' && (!isset($entity['id']) || intval($entity['id']) < 1))
                return $fail($err_msg);
        }

        return null;
    }
}
