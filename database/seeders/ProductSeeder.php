<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Nike',
            'Adidas',
            'Puma',
            'Gucci',
            'Louis Vuitton',
            'Zara',
            'H&M',
            'Levi’s',
            'Tommy Hilfiger',
            'Calvin Klein',
            'Versace',
            'Balenciaga',
            'Burberry',
            'Ralph Lauren',
            'Under Armour',
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate([
                'name' => $brand,
                'slug' => \Illuminate\Support\Str::slug($brand),
            ]);
        }

        $categories = [
            'T-Shirts',
            'Jeans',
            'Dresses',
            'Jackets & Coats',
            'Sweaters & Hoodies',
            'Shoes & Sneakers',
            'Sportswear',
            'Accessories',
            'Formal Wear',
            'Casual Wear',
            'Underwear & Lingerie',
            'Sleepwear & Loungewear',
            'Swimwear',
            'Hats & Caps',
            'Socks & Leggings',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate([
                'name' => $category,
                'slug' => \Illuminate\Support\Str::slug($category)
            ]);
        }

        Product::factory(50)->create()->each(function ($product) {
            $product->colors()->attach(Color::inRandomOrder()->take(2)->pluck('id'));
            $product->sizes()->attach(Size::inRandomOrder()->take(2)->pluck('id'));

            $tags = Tag::inRandomOrder()->take(3)->pluck('id')->toArray();
            $product->tags()->attach($tags);
        });
    }
}
