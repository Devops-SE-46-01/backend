<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AchievementTeamResource extends ResourceCollection
{
    public function toArray($request)
    {
        $teams = [];

        foreach ($this as $team) {
            array_push($teams, [
                'id' => $team->id,
                'photo' =>  'public/motion/achievement/' . $team->photo,
                'id_achievement' => $team->id_achievement,
                'name' => $team->name,
                'nim' => $team->nim,
                'major' => $team->major,
                'generation' => $team->generation
            ]);
        }

        return $teams;
    }
}
