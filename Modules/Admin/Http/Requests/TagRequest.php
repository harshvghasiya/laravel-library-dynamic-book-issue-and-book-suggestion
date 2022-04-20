<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TagRequest extends FormRequest
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
            'title' => 'required|checkTagTitleExit:'.$id.'',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('lang_data.title_filed_required'),
            'title.check_tag_title_exit' => trans('lang_data.already_used_another_resource'),
        ];
    }
}
