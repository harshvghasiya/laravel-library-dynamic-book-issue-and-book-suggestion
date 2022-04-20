<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AclRequest extends FormRequest
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
            'title' => 'required|checkAclNameExit:'.$id.'',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('lang_data.title_filed_required'),
            'title.check_acl_name_exit' => trans("lang_data.acl_name_exit_acl"),
        ];
    }
}
