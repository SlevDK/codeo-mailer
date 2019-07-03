<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignRandomizerSettings extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'add_no_display_blocks'     => (boolean) $this->add_no_display_blocks,
            'add_random_class_name'     => (boolean) $this->add_random_class_name,
            'color_difference'          => (integer) $this->color_difference,
            'edit_color'                => (boolean) $this->edit_color,
            'edit_font_family'          => (boolean) $this->edit_font_family,
            'edit_font_size'            => (boolean) $this->edit_font_size,
            'edit_text'                 => (boolean) $this->edit_text,
            'edit_text_chance'          => (integer) $this->edit_text_chance,
            'enabled'                   => (boolean) $this->enabled,
            'font_size_difference'      => (integer) $this->font_size_difference,
            'random_class_chance'       => (integer) $this->random_class_chance,
            'no_display_block_text_difference'      => (integer) $this->no_display_block_text_difference,
            'no_display_blocks_difference'          => (integer) $this->no_display_blocks_difference,
            'random_class_name_length'              => (integer) $this->random_class_name_length
        ];
    }
}
