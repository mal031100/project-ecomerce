<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|max:100,unique:products,name,'.request()->id,
            'price' => 'required',
            'sale' => 'required',
            'amount' => 'required',
        ];
    }

    public function messages()
    {
      return  [            
        'name.unique' => 'Tên sản phẩm đã tồn tại',
        'name.max' => 'Tên sản phẩm quá dài',
        'name.required' => 'Không được để trống tên sản phẩm',
        'price.required' => 'Không được để trống giá sản phẩm',
        'sale.required' => 'Không được để trống giá khuyến mại sản phẩm',
        'amount.required' => 'Không được để trống số lượng sản phẩm',
      ];
    }
}
