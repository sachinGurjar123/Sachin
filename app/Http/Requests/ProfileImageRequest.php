<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileImageRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|max:10000' //Not more than 10 MB
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.required' => __('validation.required', ['attribute' => 'profile image']),
            'image.image' => __('validation.image', ['attribute' => 'profile image']),
            'image.max' => __('validation.max', ['attribute' => '`profile image`', 'max' => '10000']),
        ];
    }
}
