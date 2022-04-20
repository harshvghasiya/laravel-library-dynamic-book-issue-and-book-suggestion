<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=> 'required',
            'from' => 'required|email',
            'subject' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'from.email' => 'Please enter a valid email address',
            'from.required' => 'Email address is required',
            'title.required'=> trans('lang_data.title_filed_required'),
            'subject.required'=> 'Subject field is required'
        ];
    }
}
