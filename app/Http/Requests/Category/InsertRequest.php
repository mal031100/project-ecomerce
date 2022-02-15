<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class InsertRequest extends FormRequest
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
            'name' => 'required|unique:categories',
            'description' => 'required|max:50'
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'không được để chống tên danh mục',
            'name.unique' => 'danh mục đã có trong CSDL',
            'description.required' => 'miêu tả danh mục không được để chống',
            'description.max' => 'miêu tả danh mục quá dài'
        ];
    }
}
