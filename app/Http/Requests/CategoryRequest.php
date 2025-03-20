<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $categoryId = request()->route('category')?->id ?? null;

        return [
            'name' => ['required', 'min:2'],
            'slug' => ['required', 'min:2', "unique:categories,slug,$categoryId"]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'name.min' => 'The category name must be at least 2 characters.',

            'slug.required' => 'The category slug is required.',
            'slug.min' => 'The category slug must be at least 2 characters.',
            'slug.unique' => 'The category slug must be unique.'
        ];
    }
}
