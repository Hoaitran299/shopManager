<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|max:50|email|exists:mst_users,email',
            'password' => 'required',
        ];
    }

    /**
     * customize msg error
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => trans('email.required'),
            'email.email' =>  trans('email.email'),
            'email.exists' =>  trans('email.exists'),
            'email.max' =>  trans('email.email'),
            'password.required' =>  trans('password.required'),
        ];
    }
}
