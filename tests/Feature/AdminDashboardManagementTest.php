<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('shows products and users in admin dashboard', function () {
    $category = Category::factory()->create(['name' => 'Sneakers']);
    $product = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Alpha Runner',
        'stock' => 12,
        'status' => 'published',
    ]);
    $user = User::factory()->create([
        'name' => 'Budi',
        'username' => 'budi-user',
        'email' => 'budi@example.com',
    ]);

    $response = $this
        ->withSession(['admin_logged_in' => true, 'admin_id' => 'admin01'])
        ->get('/admin/dashboard');

    $response->assertOk();
    $response->assertSee('Dashboard Admin');
    $response->assertSee($product->name);
    $response->assertSee((string) $product->stock);
    $response->assertSee($user->username);
});

it('allows admin to update product data', function () {
    $categoryA = Category::factory()->create();
    $categoryB = Category::factory()->create();
    $product = Product::factory()->create([
        'category_id' => $categoryA->id,
        'name' => 'Before Name',
        'slug' => 'before-name',
        'status' => 'draft',
        'thumbnail' => 'products/before-name.jpg',
    ]);

    $response = $this
        ->withSession(['admin_logged_in' => true, 'admin_id' => 'admin01'])
        ->put('/admin/products/' . $product->id, [
            'category_id' => $categoryB->id,
            'name' => 'After Name',
            'slug' => 'after-name',
            'description' => 'Updated description',
            'price' => '99.90',
            'stock' => 44,
            'weight' => '1.25',
            'thumbnail' => 'products/after-name.jpg',
            'featured' => '1',
            'popular' => '1',
            'status' => 'published',
        ]);

    $response->assertRedirect('/admin/dashboard');

    $product->refresh();
    expect($product->category_id)->toBe($categoryB->id);
    expect($product->name)->toBe('After Name');
    expect($product->slug)->toBe('after-name');
    expect($product->price)->toBe('99.90');
    expect($product->stock)->toBe(44);
    expect($product->weight)->toBe('1.25');
    expect($product->thumbnail)->toBe('products/after-name.jpg');
    expect($product->featured)->toBeTrue();
    expect($product->popular)->toBeTrue();
    expect($product->status)->toBe('published');
});

it('allows admin to update user data', function () {
    $user = User::factory()->create([
        'username' => 'before-user',
        'email' => 'before@example.com',
        'password' => Hash::make('old-pass'),
    ]);

    $response = $this
        ->withSession(['admin_logged_in' => true, 'admin_id' => 'admin01'])
        ->put('/admin/users/' . $user->id, [
            'name' => 'After User',
            'username' => 'after-user',
            'email' => 'after@example.com',
            'avatar' => 'https://example.com/new-avatar.jpg',
            'phone' => '081234567890',
            'bio' => 'Updated bio',
            'status' => 'inactive',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response->assertRedirect('/admin/dashboard');

    $user->refresh();
    expect($user->name)->toBe('After User');
    expect($user->username)->toBe('after-user');
    expect($user->email)->toBe('after@example.com');
    expect($user->avatar)->toBe('https://example.com/new-avatar.jpg');
    expect($user->phone)->toBe('081234567890');
    expect($user->bio)->toBe('Updated bio');
    expect($user->status)->toBe('inactive');
    expect(Hash::check('new-password', $user->password))->toBeTrue();
});
