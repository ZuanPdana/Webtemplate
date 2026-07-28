<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::with(['category', 'images'])
        ->where('status', 'published')
        ->orderByDesc('featured')
        ->orderByDesc('popular')
        ->orderBy('name')
        ->get();

    return view('halamanhome', compact('products'));
});
