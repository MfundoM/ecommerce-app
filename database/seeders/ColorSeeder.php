<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Black',
            'White',
            'Red',
            'Blue',
            'Green',
            'Yellow',
            'Pink',
            'Orange',
            'Purple',
            'Gray',
            'Brown',
            'Beige',
            'Navy',
            'Teal',
            'Olive',
            'Burgundy',
            'Turquoise',
            'Champagne',
            'Mustard',
            'Mint',
            'Lavender',
            'Coral',
            'Aqua',
            'Indigo',
            'Magenta',
        ];

        foreach ($colors as $color) {
            Color::firstOrCreate([
                'name' => $color,
            ]);
        }
    }
}
