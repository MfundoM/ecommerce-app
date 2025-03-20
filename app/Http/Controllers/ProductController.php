<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{

    /**
     * __construct
     *
     * @param  mixed $productService
     * @return void
     */
    public function __construct(private ProductService $productService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getPaginatedProducts();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $createProductData = $this->productService->getCreateProductData();

        return view('admin.products.create', $createProductData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->createProduct($request->validated());

        return redirect()->route('products.index')->with('status', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->productService->showProduct($product);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $editProductData = $this->productService->getEditProductData($product);

        return view('admin.products.edit', $editProductData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->productService->updateProduct($request->validated(), $product);

        return redirect()->route('products.index')->with('status', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return redirect()->route('products.index')->with('status', 'Product deleted successfully');
    }
}
