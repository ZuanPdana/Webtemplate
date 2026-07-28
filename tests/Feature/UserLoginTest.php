<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_saved_credentials(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('secret123'),
            'status' => 'active',
        ]);

        $response = $this->post('/login', [
            'login' => 'user@example.com',
            'password' => 'secret123',
        ]);

        $response->assertRedirect('/shop');
    }
}
