<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class BlogController extends Controller
{
    use ApiTrait;

    public function index(Request $request)
    {
        $data = Blog::all();
        return $this->sendResponse($data, 200);
    }

    public function create() {}

    public function edit() {}

    public function store() {}

    public function update() {}

    public function destroy() {}
}
