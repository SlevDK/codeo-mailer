<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MailSettings extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'charset_randomize'     => (bool) $this->charset_randomize,
            'dkim_signature'        => (bool) $this->dkim_signature,
            'domain_key_signature'  => (bool) $this->domain_key_signature,
            'encoded_randomize'     => (bool) $this->encoded_randomize,
            'message_id_domain'     => (string) $this->message_id_domain,
            'mixer'                 => (bool) $this->mixer,
            'random_lines'          => (integer) $this->random_lines,
            'received'              => (bool) $this->received,
            'time_randomize'        => (bool) $this->time_randomize,
            'tz_randomize'          => (bool) $this->tz_randomize
        ];
    }
}
