<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Models\Recruitation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiTrait;

class RecruitationController extends Controller
{
    use ApiTrait;

    public function check($nim)
    {
        $recruitation = Recruitation::whereNim($nim)->latest()->firstOrFail();
        if ($recruitation->is_accepted == 1) {
            return $this->sendResponse([
                'message' => 'You have been accepted!',
                'status' => 200,
            ]);
        } else if ($recruitation->is_accepted == 2) {
            return $this->sendResponse([
                'message' => 'You have not been accepted!',
                'status' => 200,
            ]);
        } else if ($recruitation->is_accepted == 3) {
            return $this->sendResponse([
                'message' => 'You have not been accepted yet!',
                'status' => 200,
            ]);
        } else if ($recruitation->is_accepted == 0) {
            return $this->sendResponse([
                'message' => 'You have not been accepted yet!',
                'status' => 400,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'regex:/([A-Za-z0-9._%+-]+@student.telkomuniversity.ac.id$)/'],
            'name' => ['required', 'string'],
            'nim' => ['required', 'min:10'],
            'ksm' => ['required', 'string'],
            'cv' => ['required', 'string'],
            'motivation_letter' => ['required', 'string'],
            'major' => ['required', 'string'],
            'generation' => ['required', 'numeric'],
            'division' => ['required'],
            'share_poster' => ['required', 'string'],
            'whatsapp' => ['required', 'string'],
            'yt_evidence' => ['required', 'string'],
            'linkedin_evidence' => ['required', 'string'],
            'line_evidence' => ['required', 'string'],
            'instagram_evidence' => ['required', 'string'],
            'twibbon_evidence' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed!',
                'errors' => $validator->errors(),
            ], 422);
        }

        Recruitation::create([
            'email' => $request->email,
            'cv' => $request->cv,
            'portofolio' => $request->portfolio,
            'motivation_letter' => $request->motivation_letter,
            'ksm' => $request->ksm,
            'name' => $request->name,
            'nim' => $request->nim,
            'major' => $request->major,
            'generation' => $request->generation,
            'division' => $request->division,
            'is_accepted' => 0,
            'share_poster' => $request->share_poster,
            'whatsapp' => $request->whatsapp,
            'yt_evidence' => $request->yt_evidence,
            'linkedin_evidence' => $request->linkedin_evidence,
            'line_evidence' => $request->line_evidence,
            'instagram_evidence' => $request->instagram_evidence,
            'twibbon_evidence' => $request->twibbon_evidence,
        ]);

        return $this->sendResponse(['message' => 'Registration success!', 'status' => 201]);
    }
}
