<?php

namespace App\Http\Resources\Api\v1\Database;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FromDomainCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'count' => $this->count(),
            'total' => $this->total(),
            'prev'  => $this->previousPageUrl(),
            'next'  => $this->nextPageUrl(),

            'results' => $this->collection
        ];
    }
}
