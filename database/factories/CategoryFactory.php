<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'parent_id' => null,
            'name' => Str::headline($name),
            'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 9999)),
            'description' => fake()->optional()->sentence(),
            'icon' => fake()->optional()->randomElement(['burger', 'pizza', 'coffee', 'salad', 'dessert']),
            'image' => fake()->optional()->imageUrl(640, 480, 'food'),
            'sort_order' => fake()->numberBetween(0, 50),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
