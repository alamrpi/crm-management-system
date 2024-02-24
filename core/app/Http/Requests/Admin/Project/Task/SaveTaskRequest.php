<?php

namespace App\Http\Requests\Admin\Project\Task;

use Illuminate\Foundation\Http\FormRequest;

class SaveTaskRequest extends FormRequest
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
            'main_task_id' => '',
            'task_name' => 'required',
            'department_id' => 'required',
            'service_id' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'due_date' => 'required'
        ];
    }

    /**
     * Determine if the validation rules have been passed.
     *
     * @return bool
     */
    public function failed()
    {
        return parent::failed() || $this->errors()->any();
    }
}
