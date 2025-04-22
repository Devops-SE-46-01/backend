<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiTrait;
use App\Models\Recruitation;
use Illuminate\Http\Request;
use App\Models\ProjectShowcase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProjectShowcaseResource;
use App\Http\Requests\UpdateProjectShowcaseRequest;

class ProjectShowcaseController extends Controller
{
    use ApiTrait;

    public function update(UpdateProjectShowcaseRequest $request, ProjectShowcase $project_showcase)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }
        if ($request->hasFile('qr')) {
            $data['qr'] = $request->file('qr')->store('qrcodes');
        }

        $project_showcase->update($data);

        return new ProjectShowcaseResource($project_showcase);
    }
}
