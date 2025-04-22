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
        $aslab = Aslab::create($request->all());

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
                'message' => 'Asistant Laboratory not found',
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
                'message' => 'Asistant Laboratory not found',
            ], 404);
        }

        $aslab->delete();

        return $this->sendResponse([
            'status' => 200,
            'message' => 'Success delete Asistant Laboratory',
        ]);
    }
}
