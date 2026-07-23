<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 25, 200);
        $shipping = fake()->randomFloat(2, 3, 20);
        $tax = round($subtotal * fake()->randomFloat(4, 0.03, 0.12), 2);
        $discount = fake()->randomFloat(2, 0, min(50, $subtotal));
        $total = max(0, $subtotal + $shipping + $tax - $discount);

        return [
            'user_id' => User::factory(),
            'address_id' => Address::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'coupon_id' => fake()->boolean(35) ? Coupon::factory() : null,
            'order_number' => 'ORD-' . fake()->unique()->numerify('########'),
            'status' => fake()->randomElement(['pending', 'confirmed', 'processing', 'shipped', 'delivered']),
            'payment_status' => fake()->randomElement(['pending', 'paid']),
            'subtotal' => $subtotal,
            'discount_amount' => $discount,
            'shipping_cost' => $shipping,
            'tax_amount' => $tax,
            'total_amount' => $total,
            'tracking_number' => fake()->optional()->bothify('TRK-########'),
            'tracking_url' => fake()->optional()->url(),
            'placed_at' => fake()->dateTimeBetween('-30 days', 'now'),
            'shipped_at' => fake()->optional(0.6)->dateTimeBetween('-15 days', 'now'),
            'delivered_at' => fake()->optional(0.4)->dateTimeBetween('-10 days', 'now'),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
