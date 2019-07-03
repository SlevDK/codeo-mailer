<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignRandomizerSettings extends Model
{
    /** @var array Guarded props */
    protected $guarded = ['id'];

    /** @var array Props that can be mass assigment */
    protected $fillable = [
        'campaign_id', 'add_no_display_blocks', 'add_random_class_name', 'color_difference',
        'edit_color', 'edit_font_family', 'edit_font_size', 'edit_text', 'edit_text_chance',
        'enabled', 'font_size_difference', 'no_display_block_text_difference',
        'no_display_blocks_difference', 'random_class_chance', 'random_class_name_length'
    ];

    /** @var array Model dates */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Create campaign proxy settings
     *
     * @param Campaign $campaign
     * @return CampaignRandomizerSettings
     */
    public static function initRandomizerSettings(Campaign $campaign)
    {
        $settings = self::create([
            'campaign_id'   => $campaign->id,
        ]);

        return $settings;
    }

    /**
     * Return fillable props array
     *
     * @return array
     */
    public function fillableProps()
    {
        $fillable = $this->fillable;
        // unset mail_id for security reasons
        unset($fillable[array_search('campaign_id', $fillable)]);

        return $fillable;
    }
}
