<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'url' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('lang_data.title_filed_required'),
            'url.required' => trans('lang_data.url_required'),
        ];
    }
}
