<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->catchPhrase();
        $slug = Str::slug($name . '-' . fake()->unique()->numberBetween(1000, 9999));

        return [
            'category_id' => Category::factory(),
            'name' => Str::headline($name),
            'slug' => $slug,
            'description' => fake()->paragraphs(3, true),
            'price' => fake()->randomFloat(2, 3, 120),
            'stock' => fake()->numberBetween(0, 500),
            'weight' => fake()->randomFloat(2, 0.1, 5),
            'thumbnail' => 'products/' . $slug . '.jpg',
            'featured' => fake()->boolean(20),
            'popular' => fake()->boolean(30),
            'status' => fake()->randomElement(['draft', 'published', 'out_of_stock']),
        ];
    }
}
