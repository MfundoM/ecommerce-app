<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductService
{
    private $prodImgPath = 'uploads/products';
    private $prodImgThumbnailPath = 'uploads/products/thumbnails';

    public function getPaginatedProducts(int $perPage = 10)
    {
        return Product::orderBy('id', 'DESC')->paginate($perPage);
    }

    public function createProduct(array $request)
    {
        $product = new Product();
        $product->name = $request['name'];
        $product->slug = Str::slug($request['name']);
        $product->short_description = $request['short_description'];
        $product->description = $request['description'];
        $product->regular_price = $request['regular_price'];
        $product->sale_price = $request['sale_price'];
        $product->SKU = $request['SKU'];
        $product->stock_status = $request['stock_status'];
        $product->featured = $request['featured'];
        $product->quantity = $request['quantity'];
        $product->category_id = $request['category_id'];
        $product->brand_id = $request['brand_id'];

        if (isset($request['image']) && $request['image'] instanceof UploadedFile) {
            $product->image = handleImageUpload($request['image'], $this->prodImgThumbnailPath, 540, 689, 104, 104);
        }

        $galleryImages = [];
        if (!empty($request['images'])) {
            foreach ($request['images'] as $file) {
                if ($file instanceof UploadedFile && in_array($file->getClientOriginalExtension(), ['jpg', 'png', 'jpeg'])) {
                    $galleryImages[] = handleImageUpload($file, $this->prodImgPath, 540, 689, 540, 540);
                }
            }
        }

        $product->images = json_encode($galleryImages);
        $product->save();

        return $product;
    }

    public function showProduct(Product $product)
    {
        // TODO implement showProduct method
    }

    public function updateProduct(array $request, Product $product)
    {
        $product->name = $request['name'];
        $product->slug = Str::slug($request['name']);
        $product->short_description = $request['short_description'];
        $product->description = $request['description'];
        $product->regular_price = $request['regular_price'];
        $product->sale_price = $request['sale_price'];
        $product->SKU = $request['SKU'];
        $product->stock_status = $request['stock_status'];
        $product->featured = $request['featured'];
        $product->quantity = $request['quantity'];
        $product->category_id = $request['category_id'];
        $product->brand_id = $request['brand_id'];

        if (isset($request['image']) && $request['image'] instanceof UploadedFile) {
            deleteImage($this->prodImgThumbnailPath, $product->image);
            $product->image = handleImageUpload($request['image'], $this->prodImgThumbnailPath, 540, 689, 104, 104);
        }

        $galleryImages = [];
        if (!empty($request['images'])) {
            if (!empty($product->images)) {
                foreach (json_decode($product->images, true) ?? [] as $image) {
                    deleteImage($this->prodImgPath, $image);
                }
                Log::info("Deleted image: " . $this->prodImgPath);
            }

            foreach ($request['images'] as $file) {
                if ($file instanceof UploadedFile && in_array($file->getClientOriginalExtension(), ['jpg', 'png', 'jpeg'])) {
                    $galleryImages[] = handleImageUpload($file, $this->prodImgPath, 540, 689, 540, 540);
                }
            }
            $product->images = json_encode($galleryImages);
        }
        $product->save();

        return $product;
    }

    public function deleteProduct(Product $product)
    {
        if (!empty($product->image)) {
            deleteImage($this->prodImgThumbnailPath, $product->image);
        }

        if (!empty($product->images)) {
            foreach (json_decode($product->images, true) ?? [] as $image) {
                deleteImage($this->prodImgPath, $image);
            }
        }

        return $product->delete();
    }
}
