<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $categories = Category::query()->pluck('id', 'slug')->all();

        $catalog = [
            'sport' => [
                'Nike Air Max 270',
                'Adidas Ultraboost 23',
                'Puma RS-X',
                'Under Armour HOVR Phantom',
                'Brooks Ghost 15',
                'Asics Gel-Nimbus 24',
                'New Balance Fresh Foam X880',
            ],
            'casual' => [
                'Vans Old Skool',
                'Converse Chuck 70',
                'Adidas Samba OG',
                'New Balance 574',
                'Puma Suede Classic',
                'Nike Blazer Mid',
                'Reebok Club C 85',
            ],
            'formal' => [
                'Clarks Desert Boot',
                'Cole Haan Wingtip',
                'Oxford Leather Shoes',
                'Derby Dress Shoes',
                'Brogue Cap Toe',
                'Loafer Tassel',
                'Monk Strap Leather',
            ],
            'running' => [
                'Nike Pegasus 40',
                'Hoka Clifton 9',
                'Saucony Kinvara 13',
                'Mizuno Wave Rider 27',
                'Adidas Adizero Adios',
                'New Balance FuelCell Rebel',
                'Brooks Launch 9',
            ],
            'boots' => [
                'Timberland 6-Inch Boot',
                'Dr. Martens 1461',
                'Red Wing Iron Ranger',
                'Sorel Caribou Boot',
                'Blundstone 550 Chelsea',
                'Wolverine 1000 Mile',
                'Caterpillar Second Shift',
            ],
        ];

        foreach ($catalog as $slug => $items) {
            if (! isset($categories[$slug])) {
                continue;
            }

            foreach ($items as $index => $name) {
                $productSlug = Str::slug($name);

                Product::query()->updateOrCreate(
                    ['slug' => $productSlug],
                    [
                        'category_id' => $categories[$slug],
                        'name' => $name,
                        'description' => fake()->paragraphs(2, true),
                        'price' => fake()->numberBetween(550000, 2200000),
                        'stock' => fake()->numberBetween(8, 120),
                        'weight' => fake()->randomFloat(2, 0.8, 1.8),
                        'thumbnail' => 'products/' . $productSlug . '.jpg',
                        'featured' => $index < 2,
                        'popular' => $index < 3,
                        'status' => 'published',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                );
            }
        }
    }
}
