<?php

namespace App\Http\Controllers\Api;


use App\Traits\ApiTrait;
use Illuminate\Http\Request;

use App\Models\ProjectShowcase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProjectShowcaseResource;
use App\Http\Requests\UpdateProjectShowcaseRequest;

class ProjectShowcaseController extends Controller
{
    use ApiTrait;

    /**
     * Validation rule for URL fields
     */
    private const URL_VALIDATION = 'nullable|string|url';

    /**
     * Validation rule for image fields
     */
    private const IMAGE_VALIDATION = 'nullable|image|mimes:jpeg,png,jpg|max:2048';

    public function index()
    {
        $projects = ProjectShowcase::all();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Projects retrieved successfully',
            'data' => $projects
        ]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string|max:255',
            'team_name' => 'required|string|max:255',
            'team_members' => 'required|string',
            'proposal' => self::URL_VALIDATION,
            'prd' => self::URL_VALIDATION,
            'figma' => self::URL_VALIDATION,
            'github' => self::URL_VALIDATION,
            'about' => 'required|string',
            'thumbnail' => self::IMAGE_VALIDATION,
            'qr' => self::IMAGE_VALIDATION,
            'design_system' => self::URL_VALIDATION,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // Handle thumbnail upload if provided
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        // Handle QR code upload if provided
        if ($request->hasFile('qr')) {
            $qrPath = $request->file('qr')->store('qr_codes', 'public');
            $data['qr'] = $qrPath;
        }

        $project = ProjectShowcase::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Project created successfully',
            'data' => $project
        ], 201);
    }

    public function show($id)
    {
        $project = ProjectShowcase::find($id);

        if (!$project) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Project retrieved successfully',
            'data' => $project
        ]);
    }

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

        return $this->sendResponse(['message' => new ProjectShowcaseResource($project_showcase), 'status' => 201]);
    }


    public function destroy(ProjectShowcase $project_showcase)
    {
        $project_showcase->delete();
        return response()->json(null, 204);
    }

}
