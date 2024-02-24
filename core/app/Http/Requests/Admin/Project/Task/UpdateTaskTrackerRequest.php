<?php

namespace App\Http\Requests\Admin\Project\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskTrackerRequest extends FormRequest
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
            'tracker_id' => 'required',
            'working_hour' => '',
            'startTime' => '',
            'endTime' => ''
        ];
    }
}
