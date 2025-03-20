<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * __construct
     *
     * @param  mixed $shopService
     * @return void
     */
    public function __construct(private ShopService $shopService) {}

    public function index()
    {
        $shopData = $this->shopService->getShopData();

        return view('shop.index', $shopData);
    }

    public function productDetails($slug)
    {
        $productData = $this->shopService->getProductDetails($slug);

        return view('shop.product-details', $productData);
    }
}
