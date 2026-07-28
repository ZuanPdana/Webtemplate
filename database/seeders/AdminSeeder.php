<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->updateOrInsert(
            ['username' => 'admin'],
            [
                'password' => bcrypt('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
