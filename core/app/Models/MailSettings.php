<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MailSettings extends Model
{
    /** @var array Guarded props */
    protected $guarded = ['id'];

    /** @var array Props that can be mass assigment */
    protected $fillable = [
        'mail_id', 'charset_randomize', 'dkim_signature', 'domain_key_signature', 'encoded_randomize',
        'message_id_domain', 'mixer', 'random_lines', 'received', 'time_randomize', 'tz_randomize',
        'rotation_count', 'rotation_mode'
    ];

    /** @var array Model dates */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Settings mail
     *
     * @return BelongsTo
     */
    public function mail()
    {
        return $this->belongsTo(Mail::class, 'mail_id');
    }

    /**
     * Create mail settings
     *
     * @param Mail $mail
     * @return mixed
     */
    public static function initSettings(Mail $mail)
    {
        $settings = self::create([
            'mail_id' => $mail->id
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
        unset($fillable[array_search('mail_id', $fillable)]);

        return $fillable;
    }
}
