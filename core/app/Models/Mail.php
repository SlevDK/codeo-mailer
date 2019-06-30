<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mail extends Model
{
    /** @var array Guarded props */
    protected $guarded = ['id'];

    /** @var array Props that can be mass assigment */
    protected $fillable = [
        'campaign_id', 'name', 'order', 'enabled'
    ];

    /** @var array Model dates */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Mail campaign
     *
     * @return BelongsTo
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    /**
     * Mail topic
     *
     * @return HasOne
     */
    public function topic()
    {
        return $this->hasOne(Topic::class, 'mail_id');
    }

    /**
     * Mail body
     *
     * @return HasOne
     */
    public function body()
    {
        return $this->hasOne(Body::class, 'mail_id');
    }

    /**
     * Mail headers
     *
     * @return HasOne
     */
    public function header()
    {
        return $this->hasOne(Header::class, 'mail_id');
    }

    /**
     * Mail settings
     *
     * @return HasOne
     */
    public function settings()
    {
        return $this->hasOne(MailSettings::class, 'mail_id');
    }

    /**
     * Create new mail
     *
     * @param Campaign $campaign
     * @param array $data
     * @return Mail
     */
    public static function initMail(Campaign $campaign, array $data)
    {
        $mail = self::create([
            'campaign_id' => $campaign->id,
            'name'  => $data['name']
        ]);

        return $mail;
    }

    /**
     * Return fillable props array
     *
     * @return array
     */
    public function fillableProps()
    {
        $fillable = $this->fillable;
        // unset campaign_id for security reasons
        unset($fillable[array_search('campaign_id', $fillable)]);

        return $fillable;
    }
}
