<?php

namespace Invento\Blog\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Invento\Blog\Models\Blog;

class BlogRequest extends FormRequest
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
            'title' => ['required', 'string','min:10','max:80'],
            'short_description' => ['nullable', 'string', 'max:200'],
            'content' => ['nullable', 'string', 'max:900000'],
            'tag' => ['nullable', 'array'],
            'status' => ['required'],
            'display_order' => ['nullable','numeric','min:0'],
            'category' => ['required'],
            'thumbnail' => ['required','string']
        ];
    }
}
