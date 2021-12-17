<?php

namespace App\Http\Requests\Auth;

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
            'email' => 'required|string|email',
            'password' => 'required|string|min:6|max:20',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Không được để trống Email',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'password.required' => 'Không được để trống',
            'password.min' => 'Mật khẩu ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu quá dài',
        ];
    }
}
