<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Add_ProductForm extends FormRequest
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
            'name' => 'required|max:50',
            'number' => 'required|min:0',
            'price' => 'required|min:0',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa điền tên sản phẩm',
            'name.max' => 'Tên có độ dài không quá 50 kí tự',
            'number.required' => 'Bạn chưa điền số lượng',
            'number.min' => 'Số lượng phải là số dương',
            'price.required' => 'Bạn chưa điền giá',
            'price.min' => 'Giá phải là số dương'
        ];
    }
}
