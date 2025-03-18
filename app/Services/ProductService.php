<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getPaginatedProducts(int $perPage = 10)
    {
        return Product::orderBy('id', 'DESC')->paginate($perPage);
    }

    public function createProduct(array $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function updateProduct(array $request, Product $product)
    {
        //
    }

    public function deleteProduct(Product $product)
    {
        //
    }
}
