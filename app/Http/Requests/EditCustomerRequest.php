<?php

namespace App\Http\Requests;

use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class EditCustomerRequest extends FormRequest
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
            'customer_name' => 'required|min:5',
            'email' => 'required|max:255|email:rfc,dns',
            'tel_num' => 'required|regex:/^([0-9]*)$/|min:10|max:12',
            'address' => 'required|max:255',
        ];
    }

    /**
     * customize msg error
     * @return array
     */
    public function messages()
    {
        return [
            'customer_name.required' => trans('CustomerRequired'),
            'customer_name.min' => trans('CustomerMinlength'),
            'email.required' => trans('EmailRequired'),
            'email.email' =>  trans('EmailType'),
            'email.exists' => trans('email.exists'),
            "email.max" => trans('email.max'),

            "tel_num.required" => trans('tel_num.required'),
            "tel_num.regex" => trans('tel_num.regex'),
            "tel_num.min" => trans('tel_num.min'),
            "tel_num.max" => trans('tel_num.max'),

            "address.required" => trans('address.required'),
            "address.max" => trans('address.max'),
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
