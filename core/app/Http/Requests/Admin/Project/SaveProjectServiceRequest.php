<?php

namespace App\Http\Requests\Admin\Project;

use Illuminate\Foundation\Http\FormRequest;

class SaveProjectServiceRequest extends FormRequest
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
            'department_id' => 'required',
            'service_id' => 'required',
            'purchase_type' => 'required',
            'total_hour' => 'required',
            'hour' => '',
            'number_of_employee' => '',
            'working_day' => '',
        ];
    }
}
