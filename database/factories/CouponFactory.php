<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Coupon>
 */
class CouponFactory extends Factory
{
    public function definition(): array
    {
        $discountType = fake()->randomElement(['percentage', 'fixed']);

        return [
            'code' => Str::upper(fake()->unique()->bothify('FOOD##??')),
            'description' => fake()->sentence(),
            'discount_type' => $discountType,
            'discount_value' => $discountType === 'percentage'
                ? fake()->randomFloat(2, 5, 40)
                : fake()->randomFloat(2, 5, 100),
            'minimum_order' => fake()->randomFloat(2, 0, 250),
            'usage_limit' => fake()->optional()->numberBetween(50, 1000),
            'used_count' => fake()->numberBetween(0, 25),
            'expired_at' => fake()->dateTimeBetween('+1 month', '+6 months'),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
