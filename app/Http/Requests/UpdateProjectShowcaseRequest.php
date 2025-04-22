<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProjectShowcaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'project_name' => 'sometimes|nullable|string|max:255',
            'team_name' => 'sometimes|nullable|string|max:255',
            'team_members' => 'sometimes|nullable|string',
            'proposal' => 'sometimes|nullable|url',
            'prd' => 'sometimes|nullable|url',
            'figma' => 'sometimes|nullable|url',
            'github' => 'sometimes|nullable|url',
            'about' => 'sometimes|nullable|string',
            'thumbnail' => 'sometimes|nullable|image|max:2048',
            'qr' => 'sometimes|nullable|image|max:2048',
            'design_system' => 'sometimes|nullable|url',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }

}
