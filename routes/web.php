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

    $favoriteProductIds = auth()->user()->favorites()->pluck('product_id')->toArray();

    return view('halamanhome', compact('products', 'categories', 'favoriteProductIds'));
})->name('shop.home');

Route::get('/shop/product/{product}', function (Product $product) {
    $product->load([
        'category',
        'images' => fn ($query) => $query->orderBy('sort_order'),
        'reviews.user',
    ])->loadCount([
        'favorites',
        'orderItems as purchases_count',
    ]);

    return view('shop.product', compact('product'));
})->middleware('auth')->name('shop.product.show');

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

Route::get('/wishlist', function () {
    $favorites = auth()->user()->favorites()
        ->with(['product.category', 'product.images'])
        ->get();

    return view('wishlist', compact('favorites'));
})->middleware('auth')->name('shop.wishlist');

Route::post('/wishlist/toggle/{product}', function (Product $product) {
    $user = auth()->user();
    $favorite = $user->favorites()->where('product_id', $product->id)->first();

    if ($favorite) {
        $favorite->delete();
        $count = $user->favorites()->count();

        return response()->json([
            'status' => 'removed',
            'count' => $count,
        ]);
    }

    $user->favorites()->create(['product_id' => $product->id]);
    $count = $user->favorites()->count();

    return response()->json([
        'status' => 'added',
        'count' => $count,
    ]);
})->middleware('auth')->name('shop.wishlist.toggle');

Route::post('/wishlist/remove/{product}', function (Product $product) {
    $user = auth()->user();
    $user->favorites()->where('product_id', $product->id)->delete();

    return redirect()->route('shop.wishlist');
})->middleware('auth')->name('shop.wishlist.remove');

Route::post('/wishlist/clear', function () {
    $user = auth()->user();
    $user->favorites()->delete();

    return redirect()->route('shop.wishlist');
})->middleware('auth')->name('shop.wishlist.clear');

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

require __DIR__.'/admin.php';

