<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {}

    public function edit() {}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required|string|max:255',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('blogs', 'public');
            $validatedData['thumbnail'] = $thumbnailPath;
        }

        $blog = Blog::create($validatedData);

        return response()->json([
            'message' => 'Blog created successfully',
            'data' => $blog,
        ], 201);
    }

    public function update() {}

    public function destroy() {}
}
