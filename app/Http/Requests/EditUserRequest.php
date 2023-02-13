<?php

namespace App\Http\Requests;

use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'password' => ['sometimes','min:5',new PasswordRule],
            'password_confirm' => 'sometimes|min:5|same:password',
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
            "password.min" => trans('PasswordMinlength'),
            "password.regex" => trans('password.regex'),
            "password_confirm.min" => trans('PasswordConfirmMinlength'),
            "password_confirm.same" => trans('PasswordConfirmEqualTo')
        ];
    }

    /**
     * Return validation error message
     *
     * @return array
     */
    protected function prepareForValidation()
    {
        if ($this->password == null) {
            $this->request->remove('password');
            $this->request->remove('password_confirm');
        }
    }
}
