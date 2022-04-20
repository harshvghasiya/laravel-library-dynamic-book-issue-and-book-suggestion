<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'url' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('lang_data.name_required'),
            'url.required' => trans('lang_data.url_required'),
        ];
    }
}
