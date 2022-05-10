<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInformationRequest extends FormRequest
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
            // 'email' => 'required|email|unique:users,email,'.request()->user_id,
            // 'dob' => 'required',
            // 'gender' => 'required',
            // 'mobile_no' => 'required|numeric|unique:users,mobile_no,'.request()->user_id,
            // 'newsletter_notify' => 'required',
            // 'push_notify' => 'required',
        ];
    }
}
