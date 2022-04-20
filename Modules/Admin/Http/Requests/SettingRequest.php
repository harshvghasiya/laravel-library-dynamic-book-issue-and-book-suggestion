<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'site_url' => 'required',
            'email' => 'required|email',
            'second_email' => 'required|email',
            'mobile' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'site_url.required' => 'Please enter Site Url',
            'email.required' =>'Please enter email',
            'second_email.required' =>'Please enter second email',
            'mobile.required' => 'Please enter mobile number',
        ];
    }
}
