<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Thumbnails;

class BlogController extends Controller
{
    use ApiTrait;

    public function index(Request $request)
    {
        $query = Blog::query();

        if ($request->has('author')) {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        $perPage = $request->get('per_page', 10);
        $blogs = $query->paginate($perPage);
        return $this->sendResponse(['message' => 'Success', 'status' => 200, 'data' => $blogs], 200);
    }

    public function create(Request $request)
    {
        $path = $request->file('thumbnail')->store('public/thumbnails');
        $thumbnailUrl = Storage::url($path);

        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'thumbnail' => $thumbnailUrl,
        ]);

        return $this->sendResponse($path);
    }
    public function edit() {}
    public function store() {}
    public function update(BlogRequest $request, $id)
    {
        $requestedData = $request->validated();
        $blog = Blog::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            if (Storage::exists($blog->thumbnail)) {
                Storage::delete($blog->thumbnail);
            }
        }

        $path = $request->file('thumbnail')->store('public/thumbnails');
        $thumbnailUrl = Storage::url($path);
        $requestedData['thumbnail'] = $thumbnailUrl;

        Blog::update($requestedData);

        return $this->sendResponse(['message' => 'Success', 'status' => 200], 200);
    }
    public function destroy() {}
}
