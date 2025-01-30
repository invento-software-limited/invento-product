<?php

namespace Invento\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Invento\Product\Models\Product;

class ProductRequest extends FormRequest
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
            'first_name' => ['required', 'string','min:3','max:80'],
            'last_name' => ['nullable', 'string','min:2','max:80'],
            'qualification' => ['required', 'string'],
            'designation' => ['required', 'string'],
            'id_number' => ['nullable', 'string'],
            'gender' => ['nullable', Rule::in(Product::GENDER)],
            'dob' => ['nullable'],
            'email' => ['nullable', 'email','string'],
            'phone' => ['nullable', 'string'],
            'description' => ['nullable', 'string', 'max:900000'],
            'status' => ['required'],
            'display_order' => ['nullable','numeric','min:0'],
            'department' => 'nullable','exists:departments,id',
            'image' => ['nullable','string']
        ];
    }
}
