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
            ['name' => 'Sport', 'icon' => 'sport'],
            ['name' => 'Casual', 'icon' => 'casual'],
            ['name' => 'Formal', 'icon' => 'formal'],
            ['name' => 'Running', 'icon' => 'running'],
            ['name' => 'Boots', 'icon' => 'boots'],
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
