<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            PaymentMethodSeeder::class,
            CouponSeeder::class,
        ]);

        User::query()->updateOrCreate(
            ['email' => 'priska@shoestep.test'],
            [
                'name' => 'Priska Widya',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80',
                'phone' => '+62 812-3456-7890',
                'bio' => 'Pecinta sepatu dan kolektor sneakers dengan gaya urban modern. Selalu mencari model baru yang nyaman dipakai setiap hari.',
                'status' => 'active',
                'remember_token' => Str::random(10),
            ],
        );

        User::factory()
            ->count(24)
            ->create();

        $this->call([
            ProductSeeder::class,
            ProductImageSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
