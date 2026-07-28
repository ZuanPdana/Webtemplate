<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    if (session('admin_logged_in')) {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->check()) {
        return redirect()->route('shop.home');
    }

    return redirect()->route('login');
})->name('portal');

Route::get('/shop', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $categories = \App\Models\Category::where('status', 'active')->orderBy('sort_order')->get();

    $products = Product::with(['category', 'images'])
        ->where('status', 'published')
        ->orderByDesc('featured')
        ->orderByDesc('popular')
        ->orderBy('name')
        ->get();

    return view('halamanhome', compact('products', 'categories'));
})->name('shop.home');

Route::get('/home', function () {
    return redirect()->route('shop.home');
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
})->middleware('auth')->name('profile');

Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::get('/tracking', function () {
    return view('tracking');
});

Route::get('/checkout', function () {
    $items = collect(json_decode(request()->cookie('shoestep_checkout', '[]'), true) ?: []);

    if ($items->isEmpty()) {
        $items = collect(json_decode(request()->cookie('shoestep_cart', '[]'), true) ?: []);
    }

    return view('checkout', ['items' => $items]);
});

Route::get('/register', [App\Http\Controllers\UserAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\UserAuthController::class, 'register'])->name('register.submit');
Route::get('/login', [App\Http\Controllers\UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\UserLoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [App\Http\Controllers\UserLoginController::class, 'logout'])->name('logout');

Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'loginFromMain'])->name('admin.login.submit');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

