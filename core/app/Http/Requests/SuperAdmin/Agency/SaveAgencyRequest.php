<?php

namespace App\Http\Requests\SuperAdmin\Agency;

use Illuminate\Foundation\Http\FormRequest;

class SaveAgencyRequest extends FormRequest
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
            'agency_name' => 'required',
            'tagline' => 'required',
            'email' => 'required',
            'address' => 'required',
            'website' => 'required',
            'about' => 'required',
            'logo' => 'required',
        ];
    }
}
