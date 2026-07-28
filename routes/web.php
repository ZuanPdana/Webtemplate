<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    $products = Product::with(['category', 'images'])
        ->where('status', 'published')
        ->orderByDesc('featured')
        ->orderByDesc('popular')
        ->orderBy('name')
        ->get();

    return view('halamanhome', compact('products'));
});

Route::get('/search', function (Request $request) {
    $query = trim($request->get('q', ''));

    if (strlen($query) < 2) {
        return response()->json([]);
    }

    $products = Product::with(['category', 'images'])
        ->where('status', 'published')
        ->where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%")
              ->orWhereHas('category', function ($cq) use ($query) {
                  $cq->where('name', 'like', "%{$query}%");
              });
        })
        ->orderByDesc('featured')
        ->orderByDesc('popular')
        ->limit(8)
        ->get()
        ->map(function ($product) {
            $image = $product->images->first()?->image;
            $imageUrl = null;
            if ($image) {
                $imageUrl = asset($image);
            } elseif ($product->thumbnail) {
                $imageUrl = asset('storage/' . $product->thumbnail);
            }

            return [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => 'Rp' . number_format($product->price, 0, ',', '.'),
                'category' => $product->category?->name ?? 'Produk',
                'image'    => $imageUrl,
                'featured' => $product->featured,
                'popular'  => $product->popular,
            ];
        });

    return response()->json($products);
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/checkout', function () {
    $items = collect(json_decode(request()->cookie('shoestep_checkout', '[]'), true) ?: []);

    if ($items->isEmpty()) {
        $items = collect(json_decode(request()->cookie('shoestep_cart', '[]'), true) ?: []);
    }

    return view('checkout', ['items' => $items]);
});

Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

