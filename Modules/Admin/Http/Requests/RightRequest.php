<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RightRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $r)
    {   
        $input = $r->all();
        $id    = !empty($input['id']) ? $input['id'] : "";

        return [
            'name' => 'required|checkRightExit:'.$id.'',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('lang_data.name_required'),
            'name.check_right_exit' => trans('lang_data.right_name_exit_rihgt'),

        ];
    }
}
