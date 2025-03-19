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
        $imageRule = $categoryId ? 'nullable' : 'required';

        return [
            'name' => ['required', 'min:2'],
            'slug' => ['required', 'min:2', "unique:categories,slug,$categoryId"],
            'image' => [$imageRule, 'mimes:png,jpg,jpeg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'name.min' => 'The category name must be at least 2 characters.',

            'slug.required' => 'The category slug is required.',
            'slug.min' => 'The category slug must be at least 2 characters.',
            'slug.unique' => 'The category slug must be unique.',

            'image.required' => 'The category image is required.',
            'image.mimes' => 'The category image must be a file of type: png, jpg, jpeg.',
            'image.max' => 'The category image size must not exceed 2MB.',
        ];
    }
}
