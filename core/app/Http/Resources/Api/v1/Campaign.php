<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class Campaign extends JsonResource
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
            'id'    => $this->id,
            'name'  => $this->name,
            'note'  => $this->note,
            'status'    => $this->status,

            'start_time'    => $this->start_time,
            'total_time'    => $this->total_time,
            'emails_total_count'    => $this->emails_total_count,
            'email_processed_count' => $this->email_processed_count,

            'mails' => [

            ]
        ];
    }
}
