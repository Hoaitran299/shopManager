<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|max:255|email:rfc,dns|unique:mst_users',
            'password' => 'required|min:5|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirm' => 'required|min:5|same:password',
        ];
    }

    /**
     * customize msg error
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('UserRequired'),
            'name.min' => trans('UserMinlength'),
            'email.required' => trans('EmailRequired'),
            'email.email' =>  trans('EmailType'),
            'email.unique' =>  trans('email.unique'),
            'email.exists' => trans('email.exists'),
            "email.max" => trans('email.max'),

            'password.required' =>  trans('password.required'),
            "password.min" => trans('PasswordMinlength'),
            "password.regex" => trans('password.regex'),

            "password_confirm.required" => trans('PasswordConfirmRequired'),
            "password_confirm.min" => trans('PasswordConfirmMinlength'),
            "password_confirm.same" => trans('PasswordConfirmEqualTo')
        ];
    }
}
