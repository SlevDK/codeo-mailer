<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    protected $permittedStatuses = [
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
        if(!in_array($status, $this->permittedStatuses))
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

}
