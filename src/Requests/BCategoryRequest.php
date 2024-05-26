<?php

namespace Invento\Blog\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BCategoryRequest extends FormRequest
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
            'display_order' => ['nullable','numeric'],
            'meta_title' => ['nullable','string','min:4'],
            'meta_description' => ['nullable','string','min:4'],
        ];
    }
}
