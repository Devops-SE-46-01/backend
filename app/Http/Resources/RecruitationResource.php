<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecruitationResource extends JsonResource
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
            'email' => $this->email,
            'nim' => $this->nim,
            'major' => $this->major,
            'generation' => $this->generation,
            'division' => $this->division,
            'cv' => 'public/motion/recruitation/' . $this->nim . '/' . $this->cv,
            'portofolio' => 'public/motion/recruitation/' . $this->nim . '/' . $this->portofolio,
            'motivation_letter' => 'public/motion/recruitation/' . $this->nim . '/' . $this->motivation_letter,
            'ksm' => 'public/motion/recruitation/' . $this->nim . '/' . $this->ksm,
            'is_accepted' => $this->is_accepted,
            'topic_proposal' => $this->topic_proposal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

    }
}
