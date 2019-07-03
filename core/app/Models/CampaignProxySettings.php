<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignProxySettings extends Model
{
    /** @var array Guarded props */
    protected $guarded = ['id'];

    /** @var array Props that can be mass assigment */
    protected $fillable = [
        'campaign_id', 'limit', 'limit_interval', 'mode', 'pause_time',
        'ssl_limit', 'thread_limit', 'proxy_data'
    ];

    /** @var array Model dates */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Create campaign proxy settings
     *
     * @param Campaign $campaign
     * @return CampaignProxySettings
     */
    public static function initProxySettings(Campaign $campaign)
    {
        $settings = self::create([
            'campaign_id'   => $campaign->id,
            'proxy_data'    => '[]'
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
