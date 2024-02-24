<?php

namespace App\Http\Requests\Modules\Chat;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
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
            'chatMessage'   => 'required_without:chatFiles',
            'chatFiles'     => 'required_without:chatMessage',
            'groupId'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'chatMessage.required_without' => 'Please write a message or select an attachment',
            'chatFiles.required_without' => 'Please write a message or select an attachment',
            'groupId.required' => 'Please select a chat from list',
        ];
    }

    public function failed()
    {
        return parent::failed() || $this->errors()->any();
    }
}
