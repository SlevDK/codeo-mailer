<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignFromEmailSettings extends Model
{
    /** @var array Guarded props */
    protected $guarded = ['id'];

    /** @var array Props that can be mass assigment */
    protected $fillable = [
        'campaign_id', 'limit', 'limit_interval', 'mode', 'pause_time',
        'ssl_limit', 'thread_limit'
    ];

    /** @var array Model dates */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Create campaign from email settings
     *
     * @param Campaign $campaign
     * @return CampaignFromEmailSettings
     */
    public static function initFromEmailSettings(Campaign $campaign)
    {
        $settings = self::create([
            'campaign_id'   => $campaign->id
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
