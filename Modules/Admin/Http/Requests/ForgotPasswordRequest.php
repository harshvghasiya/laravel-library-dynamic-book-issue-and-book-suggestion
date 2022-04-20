<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $r)
    {

        $input = $r->all();
        $data = [
            'email'    => 'required|email|checkEmailExitForgotPassword',
        ];

        return $data;
    }

    public function messages()
    {
        return [
            'email.check_email_exit_forgot_password' => trans('lang_data.this_email_addres_not_exit'),
        ];
    }
}
