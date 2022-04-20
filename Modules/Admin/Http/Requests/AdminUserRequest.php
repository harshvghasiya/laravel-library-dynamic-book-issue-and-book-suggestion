<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $r)
    {

        $input = $r->all();
        $id    = !empty($input['id']) ? $input['id'] : "";

        $data = [
            'right_id' => 'required',
            'name'     => 'required',
            'email'    => 'required|email|checkEmailExitAdminUser:' . $id . '',
            'status'   => 'required',
        ];

        if (isset($id) && !empty($id)) {

            if (isset($input['change_password']) && $input['change_password'] == 1) {

                $data['password'] = "required";
            }

        } else {

            $data['password'] = "required";
        }
        return $data;
    }

    public function messages()
    {
        return [
            'right_id.required'                 => trans('lang_data.please_select_right_label'),
            'name.required'                     => trans('lang_data.name_required'),
            'email.required'                    => trans('lang_data.email_required'),
            'email.check_email_exit_admin_user' => trans('lang_data.email_exit_admin_user'),
            'password.required'                 => trans('lang_data.password_required'),
            'status.required'                   => trans('lang_data.select_status_label'),
        ];
    }
}
