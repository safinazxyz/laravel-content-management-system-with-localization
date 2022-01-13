<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AdminChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the application is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'required',
            'new_pwd' => 'required|min:8',
            'confirm_new_pwd' => 'required',
        ];
    }
//    public function messages()
//    {
//        return [
//            'current_password.required' => 'Current_password is required',
//            'new_pwd.required' => 'New Password is required.',
//            'new_pwd.min' => 'New Password at least 8 char.',
//            'confirm_new_pwd.required' => 'Confirmation Password is required.'
//        ];
//    }

}
