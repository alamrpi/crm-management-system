<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => '',
            'address' => '',
            'company_name' => '',
            'website' => '',
            'logo' => 'nullable|mimes:jpg,bmp,png,jpeg',
            'photo' => 'nullable|mimes:jpg,bmp,png,jpeg'
        ];
    }
}
