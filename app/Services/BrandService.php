<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class BrandService
{
    private $imagePath = 'uploads/brands';

    public function getPaginatedBrands(int $perPage = 10)
    {
        return Brand::orderBy('id', 'DESC')->paginate($perPage);
    }

    public function createBrand(array $request)
    {
        $brand = new Brand();
        $brand->name = $request['name'];
        $brand->slug = Str::slug($request['slug']);

        if (isset($request['image']) && $request['image'] instanceof UploadedFile) {
            $brand->image = handleImageUpload($request['image'], $this->imagePath);
        }

        $brand->save();

        return $brand;
    }

    public function updateBrand(array $request, Brand $brand)
    {
        $brand->name = $request['name'];
        $brand->slug = Str::slug($request['slug']);

        if (isset($request['image']) && $request['image'] instanceof UploadedFile) {
            deleteImage($this->imagePath, $brand->image);
            $brand->image = handleImageUpload($request['image'], $this->imagePath);
        }

        $brand->save();

        return $brand;
    }

    public function deleteBrand(Brand $brand)
    {
        if (!empty($brand->image)) {
            deleteImage($this->imagePath, $brand->image);
        }

        return $brand->delete();
    }
}
