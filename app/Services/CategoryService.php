<?php

namespace App\Services;

use App\Models\Category;
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

        if (isset($request['image']) && is_uploaded_file($request['image'])) {
            $category->image = handleImageUpload($request['image'], $this->imagePath, 124, 124);
        }

        $category->save();

        return $category;
    }

    public function updateCategory(array $request, Category $category)
    {
        $category->name = $request['name'];
        $category->slug = Str::slug($request['slug']);

        if (isset($request['image']) && is_uploaded_file($request['image'])) {
            deleteImage($this->imagePath, $category->image);
            $category->image = handleImageUpload($request['image'], $this->imagePath, 124, 124);
        }

        $category->save();

        return $category;
    }

    public function deleteCategory(Category $category)
    {
        if ($category->image) {
            deleteImage($this->imagePath, $category->image);
        }

        return $category->delete();
    }
}
