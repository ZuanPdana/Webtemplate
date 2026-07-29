<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'loginFromMain'])->name('admin.login.submit');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

    Route::get('/promotions', [PromotionController::class, 'index'])->name('admin.promotions.index');
    Route::get('/promotions/create', [PromotionController::class, 'create'])->name('admin.promotions.create');
    Route::post('/promotions', [PromotionController::class, 'store'])->name('admin.promotions.store');
    Route::get('/promotions/{promo}/edit', [PromotionController::class, 'edit'])->name('admin.promotions.edit');
    Route::put('/promotions/{promo}', [PromotionController::class, 'update'])->name('admin.promotions.update');
});
