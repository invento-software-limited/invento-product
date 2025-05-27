<?php

namespace Invento\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'sku' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'cost_price' => 'nullable|numeric|min:0|max:99999999.99',
            'sale_price' => 'nullable|numeric|min:0|max:99999999.99',
            'discount_price' => 'nullable|numeric|min:0|max:99999999.99',
            'thumbnail' => 'nullable|string|max:255',
            'other_images' => 'nullable|string',
            'slug' => 'nullable|string|max:255'
        ];
    }
}
