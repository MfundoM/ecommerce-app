<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $brandId = request()->route('brand')?->id ?? null;
        $imageRule = $brandId ? 'nullable' : 'required';

        return [
            'name' => ['required', 'min:2'],
            'slug' => ['required', 'min:2', "unique:brands,slug,$brandId"],
            'image' => [$imageRule, 'mimes:png,jpg,jpeg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The brand name is required.',
            'name.min' => 'The brand name must be at least 2 characters.',

            'slug.required' => 'The brand slug is required.',
            'slug.min' => 'The brand slug must be at least 2 characters.',
            'slug.unique' => 'The brand slug must be unique.',

            'image.required' => 'The brand image is required.',
            'image.mimes' => 'The brand image must be a file of type: png, jpg, jpeg.',
            'image.max' => 'The brand image size must not exceed 2MB.',
        ];
    }
}
