<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maillist extends Model
{
    /** @var array Guarded props */
    protected $guarded = ['id'];

    /** @var array Props that can be mass assigment */
    protected $fillable = [
        'campaign_id', 'data'
    ];

    /** @var array Model dates */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Create campaign maillist
     *
     * @param Campaign $campaign
     * @return Maillist
     */
    public static function initMaillist(Campaign $campaign)
    {
        $maillist = self::create([
            'campaign_id'   => $campaign->id,
            'data'          => '[]'
        ]);

        return $maillist;
    }
}
