<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MemberCollection extends ResourceCollection
{

    /**
     * set aim collection
     */
    public $collects = 'App\Http\Resources\ProductResource';

    public function toArray($request)
    {
        return [
            'total' => $this->total(),
            'data' => $this->collection,
            'first' => $this->url(1),
            'last' => $this->url($this->lastPage()),
            'prev' => $this->previousPageUrl(),
            'next' => $this->nextPageUrl(),
            'current_page' => $this->currentPage(),
            'from' => 1,
            'last_page' => $this->lastPage(),
            'per_page' => $this->perPage(),
        ];
    }
}
