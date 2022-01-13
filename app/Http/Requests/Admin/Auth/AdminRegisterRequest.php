<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'full_name' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|confirmed',
        ];
    }
//    public function messages()
//    {
//        return [
//            'full_name.required' => 'Name is required.',
//            'full_name.min' => 'The admin name must be at least 3 characters.',
//            'full_name.max' => 'The admin name may not be greater than 100 characters.',
//            'full_name.regex' => 'The admin name format is invalid.',
//            'email.required' => 'Email is required.',
//            'email.email' => 'Email format is invalid.',
//            'email.unique' => 'This email already registered!',
//            'password.required' => 'Password is required.',
//            'password.min' => 'The password must be at least 8 characters.',
//            'password.confirmed' => 'Password must confirm.',
//        ];
//    }
}
