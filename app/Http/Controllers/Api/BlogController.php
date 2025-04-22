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
use Throwable;

class BlogController extends Controller
{
    use ApiTrait;

    public function index(Request $request)
    {
        try {
            $query = Blog::query();

            if ($request->has('author')) {
                $query->where('author', 'like', '%' . $request->author . '%');
            }

            $perPage = $request->get('per_page', 10);
            $blogs = $query->paginate($perPage);
            return $this->sendResponse(['message' => 'Success', 'status' => 200, 'data' => $blogs], 200);
        } catch (Throwable $err) {
            return $this->sendResponse(['message' => $err->getMessage(), 'status' => 422], 422);
        }
    }


    public function update(BlogRequest $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            if ($request->hasFile('thumbnail')) {

                if ($request->file('thumbnail')->getSize() > 2 * 1024 * 1024) {
                    return $this->sendResponse('Image Size Exceed 2MB', 422);
                }

                if (Storage::exists($blog->thumbnail)) {
                    Storage::delete($blog->thumbnail);
                }
            }

            $path = $request->file('thumbnail')->store('public/thumbnails');
            $thumbnailUrl = Storage::url($path);
            $requestedData['thumbnail'] = $thumbnailUrl;

            $blog->update($requestedData);

            return $this->sendResponse(['message' => 'Edit Success', 'status' => 200], 200);
        } catch (Throwable $err) {
            return $this->sendResponse(['message' => $err->getMessage(), 'status' => 422], 422);
        }
      
    }
  
      public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Post deleted successfully'
        ]);
    }
}
