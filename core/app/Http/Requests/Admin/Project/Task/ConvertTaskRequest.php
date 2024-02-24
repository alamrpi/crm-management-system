<?php

namespace App\Http\Requests\Admin\Project\Task;

use Illuminate\Foundation\Http\FormRequest;

class ConvertTaskRequest extends FormRequest
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
            'task_type' => 'required',
            'main_task_id' => '',
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
