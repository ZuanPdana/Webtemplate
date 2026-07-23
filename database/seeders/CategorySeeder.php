<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            ['name' => 'Burger', 'icon' => 'burger'],
            ['name' => 'Pizza', 'icon' => 'pizza'],
            ['name' => 'Dessert', 'icon' => 'dessert'],
            ['name' => 'Drinks', 'icon' => 'drink'],
            ['name' => 'Seafood', 'icon' => 'fish'],
            ['name' => 'Pasta', 'icon' => 'pasta'],
            ['name' => 'Chicken', 'icon' => 'chicken'],
            ['name' => 'Coffee', 'icon' => 'coffee'],
            ['name' => 'Salad', 'icon' => 'salad'],
            ['name' => 'Asian Food', 'icon' => 'bowl-food'],
            ['name' => 'Healthy Food', 'icon' => 'leaf'],
            ['name' => 'Breakfast', 'icon' => 'sun'],
            ['name' => 'BBQ', 'icon' => 'fire'],
            ['name' => 'Noodles', 'icon' => 'noodles'],
            ['name' => 'Ice Cream', 'icon' => 'ice-cream'],
        ];

        foreach ($categories as $index => $category) {
            Category::query()->updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['name'] . ' dishes and menu items.',
                    'icon' => $category['icon'],
                    'image' => 'categories/' . Str::slug($category['name']) . '.jpg',
                    'sort_order' => $index + 1,
                    'status' => 'active',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            );
        }
    }
}
