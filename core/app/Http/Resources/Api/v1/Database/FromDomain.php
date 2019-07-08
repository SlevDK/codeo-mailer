<?php

namespace App\Http\Resources\Api\v1\Database;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FromDomain extends JsonResource
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
            'name'  => $this->name
        ];
    }
}
