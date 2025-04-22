<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectShowcase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProjectShowcaseController extends Controller
{
    /**
     * Display a listing of the projects.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $projects = ProjectShowcase::all();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Projects retrieved successfully',
            'data' => $projects
        ]);
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string|max:255',
            'team_name' => 'required|string|max:255',
            'team_members' => 'required|string',
            'proposal' => 'nullable|string|url',
            'prd' => 'nullable|string|url',
            'figma' => 'nullable|string|url',
            'github' => 'nullable|string|url',
            'about' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'qr' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'design_system' => 'nullable|string|url',
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

    /**
     * Display the specified project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Update the specified project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $project = ProjectShowcase::find($id);

        if (!$project) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'project_name' => 'sometimes|string|max:255',
            'team_name' => 'sometimes|string|max:255',
            'team_members' => 'sometimes|string',
            'proposal' => 'nullable|string|url',
            'prd' => 'nullable|string|url',
            'figma' => 'nullable|string|url',
            'github' => 'nullable|string|url',
            'about' => 'sometimes|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'qr' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'design_system' => 'nullable|string|url',
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
            // Delete old thumbnail if exists
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        // Handle QR code upload if provided
        if ($request->hasFile('qr')) {
            // Delete old QR code if exists
            if ($project->qr) {
                Storage::disk('public')->delete($project->qr);
            }
            
            $qrPath = $request->file('qr')->store('qr_codes', 'public');
            $data['qr'] = $qrPath;
        }

        $project->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Project updated successfully',
            'data' => $project
        ]);
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $project = ProjectShowcase::find($id);

        if (!$project) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found'
            ], 404);
        }

        // Delete associated files if they exist
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        
        if ($project->qr) {
            Storage::disk('public')->delete($project->qr);
        }

        $project->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Project deleted successfully'
        ]);
    }
}
