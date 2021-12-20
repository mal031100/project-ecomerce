<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'address' => 'required|string',
            'role' => 'required',
            'password' => 'required|string|min:6|max:20',
            'repassword' => 'required_with:password|same:password|min:6|max:20'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống họ tên',
            'email.required' => 'Không được để trống Email',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Không được để trống số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'address.required' => 'Không được để trống địa chỉ',
            'role.required' => 'Không được để trống role',
            'password.required' => 'Không được để trống mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu quá dài',
            'repassword.required_with' => 'Không được để trống',
            'repassword.same' => 'Mật khẩu không trùng khớp'
        ];   
    }
}
