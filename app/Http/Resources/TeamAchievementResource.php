<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamAchievementResource extends JsonResource
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
            'photo' =>  'public/motion/achievement/' . $this->photo,
            'id_achievement' => $this->id_achievement,
            'name' => $this->name,
            'nim' => $this->nim,
            'major' => $this->major,
            'generation' => $this->generation
        ];
    }
}
