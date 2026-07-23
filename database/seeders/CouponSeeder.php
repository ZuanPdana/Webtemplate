<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $coupons = [
            ['code' => 'WELCOME10', 'discount_type' => 'percentage', 'discount_value' => 10],
            ['code' => 'FOODIE15', 'discount_type' => 'percentage', 'discount_value' => 15],
            ['code' => 'SAVE20', 'discount_type' => 'fixed', 'discount_value' => 20],
            ['code' => 'LUNCH5', 'discount_type' => 'fixed', 'discount_value' => 5],
            ['code' => 'DINNER25', 'discount_type' => 'percentage', 'discount_value' => 25],
            ['code' => 'FRESH30', 'discount_type' => 'fixed', 'discount_value' => 30],
            ['code' => 'ORDER50', 'discount_type' => 'fixed', 'discount_value' => 50],
            ['code' => 'TASTY12', 'discount_type' => 'percentage', 'discount_value' => 12],
            ['code' => 'HOTFOOD8', 'discount_type' => 'fixed', 'discount_value' => 8],
            ['code' => 'MEAL40', 'discount_type' => 'percentage', 'discount_value' => 40],
        ];

        foreach ($coupons as $coupon) {
            Coupon::query()->updateOrCreate(
                ['code' => $coupon['code']],
                [
                    'description' => 'Promo code ' . $coupon['code'],
                    'discount_type' => $coupon['discount_type'],
                    'discount_value' => $coupon['discount_value'],
                    'minimum_order' => $coupon['discount_type'] === 'percentage' ? 100 : 50,
                    'usage_limit' => 1000,
                    'used_count' => 0,
                    'expired_at' => $now->copy()->addMonths(3),
                    'status' => 'active',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            );
        }
    }
}
