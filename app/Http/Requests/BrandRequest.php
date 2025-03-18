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

        $required = $brandId ? 'nullable' : 'required';

        return [
            'name' => ['required', 'min:2'],
            'slug' => ['required', 'min:2', "unique:brands,slug,$brandId"],
            'image' => [$required, 'mimes:png,jpg,jpeg', 'max:2048'],
        ];
    }
}
