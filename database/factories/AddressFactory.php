<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'label' => fake()->randomElement(['Home', 'Office', 'Apartment', 'Warehouse']),
            'recipient_name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'line_one' => fake()->streetAddress(),
            'line_two' => fake()->optional()->secondaryAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->randomElement(['Indonesia', 'Singapore', 'Malaysia']),
            'type' => fake()->randomElement(['shipping', 'billing']),
            'is_default' => fake()->boolean(50),
        ];
    }
}
