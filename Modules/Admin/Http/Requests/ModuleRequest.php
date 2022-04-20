<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('lang_data.title_filed_required'),
        ];
    }
}
