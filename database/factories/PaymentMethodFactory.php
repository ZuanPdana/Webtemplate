<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Cash',
            'Cash on Delivery',
            'Bank Transfer',
            'Credit Card',
            'Debit Card',
            'PayPal',
            'Stripe',
            'Midtrans',
            'Xendit',
            'QRIS',
        ]);

        return [
            'name' => $name,
            'code' => Str::slug($name) . '-' . fake()->unique()->numberBetween(100, 999),
            'provider' => fake()->company(),
            'description' => fake()->sentence(),
            'icon' => fake()->optional()->imageUrl(128, 128, 'payment'),
            'instructions' => fake()->optional()->paragraph(),
            'status' => 'active',
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }
}
