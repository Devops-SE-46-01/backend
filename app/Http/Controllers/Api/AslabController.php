<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Models\Aslab;

class AslabController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private const NOT_FOUND_MESSAGE = 'Asistant Laboratory not found';

    public function index()
    {
        $aslab = Aslab::all();
        return $this->sendResponse([
            'status' => 200,
            'message' => 'Success get all Asistant Laboratory',
            'aslab' => $aslab,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position' => 'required|string|max:255',
            'social_media' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('aslab', 'public');
            $validateData['image'] = $imagePath;
        }

        $aslab = Aslab::create($validateData);

        return $this->sendResponse([
            'status' => 201,
            'message' => 'Success create Asistant Laboratory',
            'aslab' => $aslab,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $aslab = Aslab::find($id);

        if (!$aslab) {
            return $this->sendResponse(self::NOT_FOUND_MESSAGE, 404);
        }

        return $this->sendResponse([
            'status' => 200,
            'message' => 'Success get Asistant Laboratory',
            'aslab' => $aslab,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $aslab = Aslab::find($id);

        if (!$aslab) {
            return $this->sendResponse([
                'status' => 404,
                'message' => self::NOT_FOUND_MESSAGE,
            ], 404);
        }

        $aslab->update($request->all());

        return $this->sendResponse([
            'status' => 200,
            'message' => 'Success update Asistant Laboratory',
            'aslab' => $aslab,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $aslab = Aslab::find($id);

        if (!$aslab) {
            return $this->sendResponse([
                'status' => 404,
                'message' => self::NOT_FOUND_MESSAGE,
            ], 404);
        }

        $aslab->delete();

        return $this->sendResponse([
            'status' => 200,
            'message' => 'Success delete Asistant Laboratory',
        ]);

    }
}
