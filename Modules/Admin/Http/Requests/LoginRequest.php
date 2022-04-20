<?php
 
namespace Modules\Admin\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
 
class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
 
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
 
    public function messages()
    {
        return [
            'email.email' => 'Please enter a valid email address',
            'email.required' => 'Email address is required',
            'password.required' => 'Password is required',
        ];
    }
}