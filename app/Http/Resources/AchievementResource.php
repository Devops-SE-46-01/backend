<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AchievementResource extends JsonResource
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
            'description' => $this->description,
            'category' => $this->category,
            'organizer' => $this->organizer,
            'showcase' => $this->showcase,
            'photo' => 'public/motion/achievement/' . $this->photo,
            'team_name' => $this->team,
            'held' => $this->held,
            'teams' => new AchievementTeamResource($this->whenLoaded('teams'))
        ];
    }
}
