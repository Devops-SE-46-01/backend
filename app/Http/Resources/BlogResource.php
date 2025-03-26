<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => 'public/motion/blog/' . $this->thumbnail,
            'author' => $this->author,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
