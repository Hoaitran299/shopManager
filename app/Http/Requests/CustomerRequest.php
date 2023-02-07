<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'email' => 'required|max:255|email:rfc,dns|unique:mst_customer',
            'tel_num' => 'required|regex:/^([0-9]*)$/|min:7|max:13',
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
            'name.required' => trans('CustomerRequired'),
            'name.min' => trans('CustomerMinlength'),
            'email.required' => trans('EmailRequired'),
            'email.email' =>  trans('EmailType'),
            'email.unique' =>  trans('email.unique'),
            "email.exists" => trans('email.exists'),
            "email.unique" => trans('email.unique'),
            "email.max" => trans('email.max'),

            "tel_num.required" => trans('tel_num.required'),
            "tel_num.regex" => trans('tel_num.regex'),
            "tel_num.min" => trans('tel_num.min'),
            "tel_num.max" => trans('tel_num.max'),

            "address.required" => trans('address.required'),
            "address.max" => trans('address.max'),
        ];
    }
}
