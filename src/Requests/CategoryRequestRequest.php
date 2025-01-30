<?php

namespace Invento\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Invento\Product\Models\ProductCategory;

class CategoryRequestRequest extends FormRequest
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
            'name' => ['required','string','min:4','max:50'],
            'parent_id' => 'nullable','exists:product_categories,id',
            'icon' =>  ['nullable','string','max:50'],
        ];

    }
}
