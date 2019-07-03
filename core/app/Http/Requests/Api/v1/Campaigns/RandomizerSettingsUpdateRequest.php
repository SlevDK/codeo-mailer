<?php

namespace App\Http\Requests\Api\v1\Campaigns;

use Illuminate\Foundation\Http\FormRequest;

class RandomizerSettingsUpdateRequest extends FormRequest
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
            'add_no_display_blocks'     => ['boolean'],
            'add_random_class_name'     => ['boolean'],
            'color_difference'          => ['integer', 'min:0'],
            'edit_color'                => ['boolean'],
            'edit_font_family'          => ['boolean'],
            'edit_font_size'            => ['boolean'],
            'edit_text'                 => ['boolean'],
            'edit_text_chance'          => ['integer', 'min:0'],
            'enabled'                   => ['boolean'],
            'font_size_difference'      => ['integer', 'min:0'],
            'random_class_chance'       => ['integer', 'min:0'],
            'no_display_block_text_difference'      => ['integer', 'min:0'],
            'no_display_blocks_difference'          => ['integer', 'min:0'],
            'random_class_name_length'              => ['integer', 'min:0'],
        ];
    }
}
