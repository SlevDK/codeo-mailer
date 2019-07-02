<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topic extends Model
{
    /** @var array Guarded props */
    protected $guarded = ['id'];

    /** @var array Props that can be mass assigment */
    protected $fillable = [
        'mail_id', 'data'
    ];

    /** @var array Model dates */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Topic mail
     *
     * @return BelongsTo
     */
    public function mail()
    {
        return $this->belongsTo(Mail::class, 'mail_id');
    }

    /**
     * Create mail topic
     *
     * @param Mail $mail
     * @return Topic
     */
    public static function initTopic(Mail $mail)
    {
        $topic = self::create([
            'mail_id'   => $mail->id,
            'data'      => '[]'
        ]);

        return $topic;
    }
}
