<?php

namespace App\Http\Requests\Admin\Project;

use Illuminate\Foundation\Http\FormRequest;

class SaveProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id' => 'required',
            'project_name' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'deadline' => 'required',
            'target' => 'required',
            'thumbnail' => 'nullable|mimes:jpg,bmp,png,jpeg,PNG'
        ];
    }
}
