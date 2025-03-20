<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;

class ShopService
{
    public function getShopData(int $perPage = 12)
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate($perPage);
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();

        return compact('products', 'categories', 'brands');
    }

    public function getProductDetails($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('brand_id', $product->brand_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(10)
            ->get();
        $colors = $product->colors;
        $sizes = $product->sizes;

        return compact('product', 'relatedProducts', 'colors', 'sizes');
    }
}
