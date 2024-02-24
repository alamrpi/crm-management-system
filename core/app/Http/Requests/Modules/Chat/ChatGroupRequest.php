<?php

namespace App\Http\Requests\Modules\Chat;

use Illuminate\Foundation\Http\FormRequest;

class ChatGroupRequest extends FormRequest
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
            'group_name'        => 'required',
            'photo'             => 'required|mimes:jpg,bmp,png,jpeg',
            'groupParticipant'  => ''
        ];
    }
    public function failed()
    {
        return parent::failed() || $this->errors()->any();
    }
}
