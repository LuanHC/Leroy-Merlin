<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class StoreProduct extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'lm' => 'required|unique:products,lm',
            'name' => 'required',
            'free_shipping' => 'required',
            'description' => 'required',
            'price' => 'required',
        ];
    }
}
