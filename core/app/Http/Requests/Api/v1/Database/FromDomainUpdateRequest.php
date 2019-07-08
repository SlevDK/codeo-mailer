<?php

namespace App\Http\Requests\Api\v1\Database;

use Illuminate\Foundation\Http\FormRequest;

class FromDomainUpdateRequest extends FormRequest
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
            'name'  => ['string', 'min:1'],
            'data'  => [
                'json',
                function($attr, $value, $fail) {
                    return $this->checkJsonData($value, $fail);
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
    public function checkJsonData($data, $fail)
    {
        $headers = json_decode($data, true);
        $err_msg = 'Header data is incorrect';

        if(!is_array($headers))
            return $fail($err_msg);

        foreach($headers as $entity) {

            // check 'content' -> present, 0 < len(content) < 255
            if(!isset($entity['domain']) || strlen($entity['domain']) < 1 || strlen($entity['domain']) > 255)
                return $fail($err_msg);

            // check 'type' -> present, list or text
            if(!isset($entity['type']) || !in_array($entity['type'], ['simple', 'text']))
                return $fail($err_msg);
        }

        return null;
    }
}
