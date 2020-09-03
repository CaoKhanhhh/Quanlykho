<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Add_UserForm extends FormRequest
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
            'date_of_births' => 'required',
            'email' => 'required|email|unique:users',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa điền họ tên',
            'name.max' => 'Tên có độ dài không quá 50 kí tự',
            'date_of_births.required' => 'Bạn chưa điền ngày sinh',
            'email.required' => 'Bạn chưa điền email',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'email.unique' => 'Email đã được sử dụng',
        ];
    }
}
