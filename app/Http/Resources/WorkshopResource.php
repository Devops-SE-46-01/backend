<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopResource extends JsonResource
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
            'photo' => 'public/motion/workshop/' . $this->photo,
            'description' => $this->description,
            'speaker' =>  $this->speaker,
            'speaker_title' =>  $this->speaker_title,
            'datetime' => $this->datetime,
            'deadline' => $this->deadline,
            'queue' => $this->queue,
            'url' => $this->url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

    }
}
