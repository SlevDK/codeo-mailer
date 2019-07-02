<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FromLogin extends Model
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
     * Create mail from-login
     *
     * @param Mail $mail
     * @return mixed
     */
    public static function initFromLogin(Mail $mail)
    {
        $fromLogin = self::create([
            'mail_id'   => $mail->id,
            'data'      => '[]'
        ]);

        return $fromLogin;
    }
}
