<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Services\BrandService;
use App\Http\Requests\BrandRequest;

class BrandController extends Controller
{
    /**
     * __construct
     *
     * @param  mixed $brandService
     * @return void
     */
    public function __construct(private BrandService $brandService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->brandService->getPaginatedBrands();

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $this->brandService->createBrand($request->validated());

        return redirect()->route('brands.index')->with('status', 'Brand has been created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $this->brandService->updateBrand($request->validated(), $brand);

        return redirect()->route('brands.index')->with('status', 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $this->brandService->deleteBrand($brand);

        return redirect()->route('brands.index')->with('status', 'Brand deleted successfully');
    }
}
