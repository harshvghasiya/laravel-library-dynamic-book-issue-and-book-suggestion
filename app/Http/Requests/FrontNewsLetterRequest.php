<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontNewsLetterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {   
        $input = $this->request->all();
        return [
            'email' => 'required|CheckEmailNewsLetter|email',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('lang_data.please_enter_your_email_address_label'),
            'email.email' => trans('lang_data.please_enter_valid_email_address_label'),
            'email.check_email_news_letter' => trans('lang_data.please_enter_valid_email_already_sub_label'),
        ];
    }
}
