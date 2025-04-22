<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectShowcaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Sama seperti store, tapi file bisa nullable
        return [
            'project_name'   => 'sometimes|required|string|max:255',
            'team_name'      => 'sometimes|required|string|max:255',
            'team_members'   => 'sometimes|nullable|string',
            'proposal'       => 'sometimes|nullable|url',
            'prd'            => 'sometimes|nullable|url',
            'figma'          => 'sometimes|nullable|url',
            'github'         => 'sometimes|nullable|url',
            'about'          => 'sometimes|nullable|string',
            'thumbnail'      => 'sometimes|nullable|image|max:2048',
            'qr'             => 'sometimes|nullable|image|max:2048',
            'design_system'  => 'sometimes|nullable|url',
        ];
    }
}
