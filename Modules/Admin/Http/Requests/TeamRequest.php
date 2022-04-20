<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'role' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('lang_data.name_required'),
            'role.required' => trans('lang_data.team_role_required_label'),
        ];
    }
}
