<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class ShopService
{
    public function getShopData(int $perPage = 12)
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate($perPage);
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();

        return compact('products', 'categories', 'brands');
    }
}
