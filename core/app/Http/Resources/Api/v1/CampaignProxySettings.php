<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignProxySettings extends JsonResource
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
            'limit' => $this->limit,
            'limit_interval'    => $this->limit_interval,
            'mode'  => $this->mode,
            'pause_time'    => $this->pause_time,
            'ssl_limit'     => $this->ssl_limit,
            'thread_limit'  => $this->thread_limit,
            'proxy_data'    => json_encode($this->proxy_data)
        ];
    }
}
