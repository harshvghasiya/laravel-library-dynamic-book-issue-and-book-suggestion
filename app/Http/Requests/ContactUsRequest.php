<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {   
        $input = $this->request->all();
        return [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'subject' => 'required',
            // 'g-recaptcha-response' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('lang_data.name_required'),
            'email.required' => trans('lang_data.please_enter_your_email_address_label'),
            'email.email' => trans('lang_data.please_enter_valid_email_address_label'),
            'message.required' => trans('lang_data.message_required'),
            'subject.required' => trans('lang_data.subject_required')
        ];
    }
}
