<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Campaign extends Model
{
    /** @var array Guarded props */
    protected $guarded = ['id'];

    /** @var array Props that can be mass assigment */
    protected $fillable = [
        'user_id', 'name', 'note', 'status', 'emails_total_count', 'email_processed_count'
    ];

    /** @var array Model dates */
    protected $dates = [
        'start_time', 'total_time', 'created_at', 'updated_at'
    ];

    /** @var array Campaign permitted statuses */
    protected const permittedStatuses = [
        'active', 'paused', 'finished', 'stopping', 'draft', 'archive'
    ];

    /**
     * Campaign owner
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * Campaign mails
     *
     * @return HasMany
     */
    public function mails()
    {
        return $this->hasMany(Mail::class, 'campaign_id');
    }

    /**
     * Campaign maillist
     *
     * @return HasOne
     */
    public function maillist()
    {
        return $this->hasOne(Maillist::class, 'campaign_id');
    }

    /**
     * Campaign proxy settings
     *
     * @return HasOne
     */
    public function proxySettings()
    {
        return $this->hasOne(CampaignProxySettings::class, 'campaign_id');
    }

    /**
     * Campaign from email settings
     *
     * @return HasOne
     */
    public function fromEmailSettings()
    {
        return $this->hasOne(CampaignFromEmailSettings::class, 'campaign_id');
    }

    /**
     * Campaign randomizer settings
     *
     * @return HasOne
     */
    public function randomizerSettings()
    {
        return $this->hasOne(CampaignRandomizerSettings::class, 'campaign_id');
    }

    /**
     * Campaign additional settings
     *
     * @return HasOne
     */
    public function additionalSettings()
    {
        return $this->hasOne(CampaignAdditionalSettings::class, 'campaign_id');
    }

    /**
     * Own by (user id) scope
     *
     * @param $query
     * @param int $id
     * @return mixed
     */
    public function scopeOwnBy($query, $id)
    {
        return $query->where('user_id', $id);
    }

    /**
     * (Campaign) status scope
     *
     * @param $query
     * @param string $status
     * @return mixed
     */
    public function scopeStatus($query, $status)
    {
        // like 'all'
        if(!in_array($status, self::permittedStatuses))
            return $query;

        return $query->where('status', $status);
    }

    /**
     * Create new campaign
     *
     * @param array $campaignData
     * @return Campaign
     */
    public static function initCampaign(array $campaignData)
    {
        $campaignData['user_id'] = auth('api')->id();

        $model = self::create($campaignData);

        return $model;
    }

    /**
     * Return fillable props array
     *
     * @return array
     */
    public function fillableProps()
    {
        $fillable = $this->fillable;
        // unset user_id for security reasons
        unset($fillable[array_search('user_id', $fillable)]);

        return $fillable;
    }

    /**
     * Return permitted statuses array
     *
     * @return array
     */
    public static function permittedStatuses()
    {
        return static::permittedStatuses;
    }
}
