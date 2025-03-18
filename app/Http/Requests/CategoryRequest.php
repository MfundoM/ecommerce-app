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

        $required = $categoryId ? 'nullable' : 'required';

        return [
            'name' => ['required', 'min:2'],
            'slug' => ['required', 'min:2', "unique:brands,slug,$categoryId"],
            'image' => [$required, 'mimes:png,jpg,jpeg', 'max:2048'],
        ];
    }
}
