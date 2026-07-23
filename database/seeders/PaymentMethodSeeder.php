<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $methods = [
            ['name' => 'Cash', 'code' => 'cash'],
            ['name' => 'Cash on Delivery', 'code' => 'cod'],
            ['name' => 'Bank Transfer', 'code' => 'bank-transfer'],
            ['name' => 'Credit Card', 'code' => 'credit-card'],
            ['name' => 'Debit Card', 'code' => 'debit-card'],
            ['name' => 'PayPal', 'code' => 'paypal'],
            ['name' => 'Stripe', 'code' => 'stripe'],
            ['name' => 'Midtrans', 'code' => 'midtrans'],
            ['name' => 'Xendit', 'code' => 'xendit'],
            ['name' => 'QRIS', 'code' => 'qris'],
        ];

        foreach ($methods as $index => $method) {
            PaymentMethod::query()->updateOrCreate(
                ['code' => $method['code']],
                [
                    'name' => $method['name'],
                    'provider' => $method['name'],
                    'description' => $method['name'] . ' payment option.',
                    'icon' => 'payment-methods/' . $method['code'] . '.svg',
                    'instructions' => 'Follow the checkout instructions to complete payment using ' . $method['name'] . '.',
                    'status' => 'active',
                    'sort_order' => $index + 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            );
        }
    }
}
