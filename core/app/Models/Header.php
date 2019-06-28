<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
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
     * Create mail header
     *
     * @param Mail $mail
     * @return Header
     */
    public static function initHeader(Mail $mail)
    {
        $header = self::create([
            'mail_id'   => $mail->id,
            'data'      => '[]'
        ]);

        return $header;
    }
}
