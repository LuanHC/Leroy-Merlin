<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class UpdateProduct extends FormRequest
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
        $id = $this->route()->parameters()['product'];

        return [
            'id' => 'required|exists:products,id',
            'category_id' => 'required|exists:categories,id',
            'lm' => 'required|unique:products,lm,'.$id,
            'name' => 'required',
            'free_shipping' => 'required',
            'description' => 'required',
            'price' => 'required',
        ];
    }
}
