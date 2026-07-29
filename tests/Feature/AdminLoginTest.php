<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_with_database_credentials(): void
    {
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        $response = $this->post('/login', [
            'login' => 'admin',
            'password' => 'admin123',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertTrue(session()->get('admin_logged_in'));
        $this->assertSame('admin', session()->get('admin_id'));
    }
}
