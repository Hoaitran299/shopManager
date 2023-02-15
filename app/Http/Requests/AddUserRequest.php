<?php

namespace App\Http\Requests;

use App\Rules\PasswordRule;
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
            'name' => 'required|min:5|max:50',
            'email' => 'required|max:50|email|unique:mst_users,email',
            'password' => ['required','min:5','max:30',new PasswordRule],
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
            'name.max' => trans('name.max'),
            'email.required' => trans('EmailRequired'),
            'email.email' =>  trans('EmailType'),
            'email.unique' =>  trans('email.unique'),
            'email.exists' => trans('email.exists'),
            "email.max" => trans('email.max'),

            'password.required' =>  trans('password.required'),
            "password.min" => trans('PasswordMinlength'),
            "password.max" => trans('password.max'),
            "password.regex" => trans('password.regex'),

            "password_confirm.required" => trans('PasswordConfirmRequired'),
            "password_confirm.min" => trans('PasswordConfirmMinlength'),
            "password_confirm.same" => trans('PasswordConfirmEqualTo')
        ];
    }
}
