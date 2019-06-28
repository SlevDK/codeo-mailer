<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Body extends Model
{
    /** @var array Guarded props */
    protected $guarded = ['id'];

    /** @var array Props that can be mass assigment */
    protected $fillable = [
        'mail_id', 'content'
    ];

    /** @var array Model dates */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Body mail
     *
     * @return BelongsTo
     */
    public function mail()
    {
        return $this->belongsTo(Mail::class, 'mail_id');
    }

    /**
     * Create mail body
     *
     * @param Mail $mail
     * @return mixed
     */
    public static function initBody(Mail $mail)
    {
        $body = self::create([
            'mail_id'   => $mail->id,
            'content'   => ''
        ]);

        return $body;
    }
}
