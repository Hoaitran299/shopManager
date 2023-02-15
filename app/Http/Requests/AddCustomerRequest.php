<?php

namespace App\Http\Requests;

use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AddCustomerRequest extends FormRequest
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
            'txtName' => 'required|min:5|max:50',
            'txtEmail' => 'required|max:50|email:rfc,dns',
            'txtTel_num' => 'required|regex:/^([0-9]*)$/|min:10|max:12',
            'txtAddress' => 'required|max:100',
        ];
    }

    /**
     * customize msg error
     * @return array
     */
    public function messages()
    {
        return [
            'txtName.required' => trans('CustomerRequired'),
            'txtName.min' => trans('CustomerMinlength'),
            'txtName.max' => trans('name.max'),
            'txtEmail.required' => trans('EmailRequired'),
            'txtEmail.email' =>  trans('EmailType'),
            'txtEmail.exists' => trans('email.exists'),
            "txtEmail.max" => trans('email.max'),

            "txtTel_num.required" => trans('tel_num.required'),
            "txtTel_num.regex" => trans('tel_num.regex'),
            "txtTel_num.min" => trans('tel_num.min'),
            "txtTel_num.max" => trans('tel_num.max'),

            "txtAddress.required" => trans('address.required'),
            "txtAddress.max" => trans('address.max'),
        ];
    }

    // /**
    //  * Hanle a failed validation attempt
    //  * 
    //  * @param \Illuminate\Contracts\Validation\Validator
    //  * @return void
    //  * 
    //  * @throws \Illuminate\Validation\ValidationException
    //  */
    
    // protected function failedValidation(Validator $validator) {
    //     throw(new ValidationException($validator))
    //     ->status(200)
    //     ->errorBag($this->errorBag)
    //     ->redirect($this->getRedirectUrl());
    // }
}
