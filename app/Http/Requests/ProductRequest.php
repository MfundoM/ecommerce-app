<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $productId = request()->route('product')?->id ?? null;
        $imageRule = $productId ? 'nullable' : 'required';

        return [
            'name' => ['required', 'min:2'],
            'slug' => ['required', "unique:products,slug,$productId"],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'regular_price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0', 'lte:regular_price'],
            'SKU' => ['required', 'string', 'unique:products,SKU,' . $productId],
            'stock_status' => ['required', 'in:in_stock,out_of_stock'],
            'featured' => ['required', 'boolean'],
            'quantity' => ['required', 'integer', 'min:0'],
            'image' => [$imageRule, 'mimes:png,jpg,jpeg', 'max:2048'],
            'images' => ['nullable', 'array'],
            'images.*' => ['mimes:png,jpg,jpeg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.min' => 'The product name must be at least 2 characters.',

            'slug.required' => 'The product slug is required.',
            'slug.unique' => 'The product slug must be unique.',

            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category does not exist.',

            'brand_id.required' => 'Please select a brand.',
            'brand_id.exists' => 'The selected brand does not exist.',

            'short_description.required' => 'The short description is required.',
            'short_description.string' => 'The short description must be a valid string.',

            'description.required' => 'The product description is required.',
            'description.string' => 'The product description must be a valid string.',

            'regular_price.required' => 'The regular price is required.',
            'regular_price.numeric' => 'The regular price must be a number.',
            'regular_price.min' => 'The regular price cannot be negative.',

            'sale_price.numeric' => 'The sale price must be a number.',
            'sale_price.min' => 'The sale price cannot be negative.',
            'sale_price.lte' => 'The sale price must be less than or equal to the regular price.',

            'SKU.required' => 'The SKU is required.',
            'SKU.string' => 'The SKU must be a string.',
            'SKU.unique' => 'The SKU must be unique.',

            'stock_status.required' => 'The stock status is required.',
            'stock_status.in' => 'The stock status must be either "in_stock" or "out_of_stock".',

            'featured.required' => 'The featured status is required.',
            'featured.boolean' => 'The featured status must be true or false.',

            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'The quantity must be an integer.',
            'quantity.min' => 'The quantity must be at least 0.',

            'image.required' => 'The main product image is required.',
            'image.mimes' => 'The main product image must be a file of type: png, jpg, jpeg.',
            'image.max' => 'The main product image size must not exceed 2MB.',

            'images.array' => 'The additional images must be an array.',
            'images.*.mimes' => 'Each additional image must be a file of type: png, jpg, jpeg.',
            'images.*.max' => 'Each additional image size must not exceed 2MB.',
        ];
    }
}
