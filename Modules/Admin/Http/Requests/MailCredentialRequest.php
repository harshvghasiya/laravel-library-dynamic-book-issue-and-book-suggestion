<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailCredentialRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mail_username' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_driver' => 'required',
            'mail_encryption' => 'required',
            'mail_from_name' => 'required',
            'mail_from_address' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'mail_username.required' => trans('lang_data.mail_username_required'),
            'mail_port.required' => trans('lang_data.mail_port_required'),
            'mail_host.required' => trans('lang_data.mail_host_required'),
            'mail_driver.required' => trans('lang_data.mail_driver_required'),
            'mail_encryption.required' => trans('lang_data.mail_encryption_required'),
            'mail_from_address.required' => trans('lang_data.mail_from_address_required'),
            'mail_from_name.required' => trans('lang_data.mail_from_name_required'),
        ];
    }
}
