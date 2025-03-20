<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Casual',
            'Formal',
            'Sportswear',
            'Luxury',
            'Trendy',
            'Streetwear',
            'Vintage',
            'Bohemian',
            'Chic',
            'Athleisure',
            'Comfort',
            'Summer',
            'Winter',
            'Eco-Friendly',
            'Sustainable',
            'Plus Size',
            'Slim Fit',
            'Fitted',
            'Loose Fit',
            'Ethnic',
            'Party Wear',
            'Bridal',
            'Denim',
            'Graphic Tees',
            'Sweater',
            'T-shirt',
            'Jacket',
            'Coat',
            'Knitwear',
            'Activewear',
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate([
                'name' => $tag,
            ]);
        }
    }
}
