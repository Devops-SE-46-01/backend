<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => 'public/motion/product/' . $this->photo,
            'description' => $this->description,
            'url' =>  $this->url,
            'url_android' =>  $this->url_android,
            'url_ios' =>  $this->url_ios,
            'creator' => $this->creator,
            'platform' => $this->platform
        ];
    }
}
