<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MenuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $r)
    {       
        return [
            'cms_id' => 'required|checkMenuExit',

        ];
    }

    public function messages()
    {
        return [
            'cms_id.required' => 'Please Select Menu.' ,
            'cms_id.check_menu_exit' => "Menu Already Exist",
        ];
    }
}
