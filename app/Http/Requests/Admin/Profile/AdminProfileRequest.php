<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;

class AdminProfileRequest extends FormRequest
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
            'admin_name' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
            'admin_mobile' => 'required|regex:/^[0-9]+$/|max:11|min:10',
            'admin_image'=>'mimes:jpeg,jpg,png,gif|max:1000'
        ];
    }

//    public function messages()
//    {
//        return [
//            'admin_name.required' => 'Name is required.',
//            'admin_name.min' => 'The admin name must be at least 3 characters.',
//            'admin_name.max' => 'The admin name may not be greater than 100 characters.',
//            'admin_name.regex' => 'The admin name format is invalid.',
//            'admin_mobile.required' => 'Mobile number is required.',
//            'admin_mobile.regex' => 'The admin mobile format is invalid.',
//            'admin_mobile.max' => 'The admin mobile may not be greater than 11 numbers.',
//            'admin_mobile.min' => 'The admin mobile must be at least 10 numbers.',
//            'admin_image.mimes' => 'The admin image must be a file of type: jpeg, jpg, png, gif.',
//            'admin_image.max' => 'The admin image may not be greater than 1MB',
//        ];
//    }
}
