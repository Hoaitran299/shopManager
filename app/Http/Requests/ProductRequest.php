<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|min:5|max:50',
            'product_price' => 'required|min:0|numeric',
            'description' => 'max:255',
            'product_image' => 'sometimes|mimes:jpeg,jpg,png|max:2048|dimensions:max_width=1024,max_height=1024',
        ];
    }

    /**
     * Return validation error message
     *
     * @return array
     */
    public function messages()
    {
        return [
            "product_name.required" => trans('product_name.required'),
            "product_name.min" => trans('product_name.min'),
            "product_name.max" => trans('name.max'),

            "product_price.required" => trans('product_price.required'),
            "product_price.numeric" => trans('product_price.digits'),
            "product_price.min" => trans('product_price.min'),

            "product_image.mimes" => trans('product_image.extension'),
            "product_image.max" => trans('product_image.capacity'),
            "product_image.dimensions" => trans('product_image.maxsize'),

            'description' => trans('description.max'),

        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if($this->product_image){
            $this->request->remove('product_image');
        }
    }
}
