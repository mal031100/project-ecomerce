<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'role' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.request' => 'không được để trống tên',
            'name.request' => 'không được để trống email',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'name.request' => 'không được để trống số điện thoại',
            'name.request' => 'không được để trống địa chỉ',
            'name.request' => 'không được để trống role',
        ];
    }
}
