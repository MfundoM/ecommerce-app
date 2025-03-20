<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function getPaginatedCategories(int $perPage = 10)
    {
        return Category::orderBy('id', 'DESC')->paginate($perPage);
    }

    public function createCategory(array $request)
    {
        $category = new Category();
        $category->name = $request['name'];
        $category->slug = Str::slug($request['slug']);

        $category->save();

        return $category;
    }

    public function updateCategory(array $request, Category $category)
    {
        $category->name = $request['name'];
        $category->slug = Str::slug($request['slug']);

        $category->save();

        return $category;
    }

    public function deleteCategory(Category $category)
    {
        return $category->delete();
    }
}
