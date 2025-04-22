<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectShowcaseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'project_name'  => $this->project_name,
            'team_name'     => $this->team_name,
            'team_members'  => $this->team_members,
            'proposal'      => $this->proposal,
            'prd'           => $this->prd,
            'figma'         => $this->figma,
            'github'        => $this->github,
            'about'         => $this->about,
            'thumbnail_url' => $this->thumbnail ? Storage::url($this->thumbnail) : null,
            'qr_url'        => $this->qr ? Storage::url($this->qr) : null,
            'design_system' => $this->design_system,
            'created_at'    => $this->created_at->toDateTimeString(),
            'updated_at'    => $this->updated_at->toDateTimeString(),
        ];
    }
}
