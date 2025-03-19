<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CategoryService
{
    private $imagePath = 'uploads/categories';

    public function getPaginatedCategories(int $perPage = 10)
    {
        return Category::orderBy('id', 'DESC')->paginate($perPage);
    }

    public function createCategory(array $request)
    {
        $category = new Category();
        $category->name = $request['name'];
        $category->slug = Str::slug($request['slug']);

        if (isset($request['image']) && $request['image'] instanceof UploadedFile) {
            $category->image = handleImageUpload($request['image'], $this->imagePath);
        }

        $category->save();

        return $category;
    }

    public function updateCategory(array $request, Category $category)
    {
        $category->name = $request['name'];
        $category->slug = Str::slug($request['slug']);

        if (isset($request['image']) && $request['image'] instanceof UploadedFile) {
            deleteImage($this->imagePath, $category->image);
            $category->image = handleImageUpload($request['image'], $this->imagePath);
        }

        $category->save();

        return $category;
    }

    public function deleteCategory(Category $category)
    {
        if (!empty($category->image)) {
            deleteImage($this->imagePath, $category->image);
        }

        return $category->delete();
    }
}
