<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    private function ensureAdminLoggedIn(): ?RedirectResponse
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('login');
        }

        return null;
    }

    private function currentAdmin(): ?Admin
    {
        return Admin::where('username', session('admin_id'))->first();
    }

    /* ────────────────────────────── AUTH ─────────────────────────────── */

    public function loginFromMain(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $admin = Admin::where('username', $request->input('login'))->first();

        if ($admin && Hash::check($request->input('password'), $admin->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->username,
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'login' => 'Username admin atau password salah.',
        ])->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id']);

        return redirect()->route('login');
    }

    /* ─────────────────────────── DASHBOARD HOME ──────────────────────── */

    public function dashboard()
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $productStats = [
            'total'      => Product::count(),
            'inStock'    => Product::where('stock', '>', 0)->count(),
            'published'  => Product::where('status', 'published')->count(),
            'outOfStock' => Product::where('status', 'out_of_stock')->count(),
        ];

        $userStats = [
            'total'    => User::count(),
            'active'   => User::where('status', 'active')->count(),
            'inactive' => User::where('status', 'inactive')->count(),
            'blocked'  => User::where('status', 'blocked')->count(),
        ];

        $couponStats = [
            'total'  => Coupon::count(),
            'active' => Coupon::where('status', 'active')->count(),
        ];

        return view('admin.dashboard', [
            'admin'        => $this->currentAdmin(),
            'adminId'      => session('admin_id'),
            'productStats' => $productStats,
            'userStats'    => $userStats,
            'couponStats'  => $couponStats,
        ]);
    }

    /* ───────────────────────── ADMIN PROFILE ─────────────────────────── */

    public function profile()
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        return view('admin.profile', [
            'admin'   => $this->currentAdmin(),
            'adminId' => session('admin_id'),
        ]);
    }

    public function updateProfile(Request $request)
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $admin = $this->currentAdmin();

        $validated = $request->validate([
            'name'     => ['nullable', 'string', 'max:150'],
            'email'    => ['nullable', 'email', 'max:180', Rule::unique('admins', 'email')->ignore($admin->id)],
            'avatar'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($admin->avatar && Storage::disk('public')->exists($admin->avatar)) {
                Storage::disk('public')->delete($admin->avatar);
            }
            $path = $request->file('avatar')->store('admins', 'public');
            $validated['avatar'] = $path;
        } else {
            unset($validated['avatar']);
        }

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $admin->update($validated);

        return redirect()->route('admin.profile')->with('status', 'Profil berhasil diperbarui.');
    }

    /* ─────────────────────── PRODUCTS PAGE ──────────────────────────── */

    public function productsPage()
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $products = Product::with(['category:id,name'])
            ->withCount(['orderItems as sold_count'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.products', [
            'admin'    => $this->currentAdmin(),
            'adminId'  => session('admin_id'),
            'products' => $products,
            'productStats' => [
                'total'      => $products->count(),
                'inStock'    => $products->where('stock', '>', 0)->count(),
                'published'  => $products->where('status', 'published')->count(),
                'outOfStock' => $products->where('status', 'out_of_stock')->count(),
            ],
        ]);
    }

    public function createProduct()
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $categories = Category::where('status', 'active')->orderBy('sort_order')->get();

        return view('admin.create-product', [
            'admin'      => $this->currentAdmin(),
            'adminId'    => session('admin_id'),
            'categories' => $categories,
        ]);
    }

    public function storeProduct(Request $request)
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $validated = $request->validate([
            'category_id'    => ['required', 'integer', Rule::exists('categories', 'id')->where(fn ($q) => $q->whereNull('deleted_at'))],
            'name'           => ['required', 'string', 'max:150'],
            'slug'           => ['required', 'string', 'max:180', 'unique:products,slug'],
            'description'    => ['required', 'string'],
            'price'          => ['required', 'numeric', 'min:0'],
            'stock'          => ['required', 'integer', 'min:0'],
            'weight'         => ['nullable', 'numeric', 'min:0'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'thumbnail'      => ['nullable', 'string', 'max:255'],
            'status'         => ['required', Rule::in(['draft', 'published', 'out_of_stock', 'archived'])],
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('products', 'public');
            $validated['thumbnail'] = $path;
        }

        if (empty($validated['thumbnail'])) {
            $validated['thumbnail'] = 'products/default.jpg';
        }

        unset($validated['thumbnail_file']);

        $validated['featured'] = $request->boolean('featured');
        $validated['popular']  = $request->boolean('popular');

        Product::create($validated);

        return redirect()->route('admin.products')->with('status', 'Produk baru berhasil ditambahkan.');
    }

    public function editProduct(Product $product)
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $categories = Category::where('status', 'active')->orderBy('sort_order')->get();

        return view('admin.edit-product', [
            'admin'      => $this->currentAdmin(),
            'adminId'    => session('admin_id'),
            'product'    => $product,
            'categories' => $categories,
        ]);
    }

    public function updateProduct(Request $request, Product $product)
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $validated = $request->validate([
            'category_id'    => ['required', 'integer', Rule::exists('categories', 'id')->where(fn ($q) => $q->whereNull('deleted_at'))],
            'name'           => ['required', 'string', 'max:150'],
            'slug'           => ['required', 'string', 'max:180', Rule::unique('products', 'slug')->ignore($product->id)],
            'description'    => ['required', 'string'],
            'price'          => ['required', 'numeric', 'min:0'],
            'stock'          => ['required', 'integer', 'min:0'],
            'weight'         => ['nullable', 'numeric', 'min:0'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'thumbnail'      => ['nullable', 'string', 'max:255'],
            'status'         => ['required', Rule::in(['draft', 'published', 'out_of_stock', 'archived'])],
        ]);

        if ($request->hasFile('thumbnail_file')) {
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $path = $request->file('thumbnail_file')->store('products', 'public');
            $validated['thumbnail'] = $path;
        }

        if (empty($validated['thumbnail'])) {
            $validated['thumbnail'] = $product->thumbnail;
        }

        unset($validated['thumbnail_file']);

        $validated['featured'] = $request->boolean('featured');
        $validated['popular']  = $request->boolean('popular');

        $product->update($validated);

        return redirect()->route('admin.products')->with('status', 'Produk berhasil diperbarui.');
    }

    /* ─────────────────────────── USERS PAGE ─────────────────────────── */

    public function usersPage()
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $users = User::orderByDesc('created_at')->get();

        return view('admin.users', [
            'admin'    => $this->currentAdmin(),
            'adminId'  => session('admin_id'),
            'users'    => $users,
            'userStats' => [
                'total'    => $users->count(),
                'active'   => $users->where('status', 'active')->count(),
                'inactive' => $users->where('status', 'inactive')->count(),
                'blocked'  => $users->where('status', 'blocked')->count(),
            ],
        ]);
    }

    public function editUser(User $user)
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        return view('admin.edit-user', [
            'admin'   => $this->currentAdmin(),
            'adminId' => session('admin_id'),
            'user'    => $user,
        ]);
    }

    public function updateUser(Request $request, User $user)
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:150'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'email'    => ['required', 'email', 'max:180', Rule::unique('users', 'email')->ignore($user->id)],
            'avatar'   => ['nullable', 'string', 'max:255'],
            'phone'    => ['nullable', 'string', 'max:30', Rule::unique('users', 'phone')->ignore($user->id)],
            'bio'      => ['nullable', 'string'],
            'status'   => ['required', Rule::in(['active', 'inactive', 'blocked'])],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $validated['phone']  = $validated['phone']  ?: null;
        $validated['avatar'] = $validated['avatar'] ?: null;

        $user->update($validated);

        return redirect()->route('admin.users')->with('status', 'Data user berhasil diperbarui.');
    }

    /* ─────────────────────────── COUPONS PAGE ────────────────────────── */

    public function couponsPage()
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $coupons = Coupon::orderByDesc('created_at')->get();

        return view('admin.coupons', [
            'admin'   => $this->currentAdmin(),
            'adminId' => session('admin_id'),
            'coupons' => $coupons,
        ]);
    }

    public function createCoupon()
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        return view('admin.create-coupon', [
            'admin'   => $this->currentAdmin(),
            'adminId' => session('admin_id'),
        ]);
    }

    public function storeCoupon(Request $request)
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $validated = $request->validate([
            'code'           => ['required', 'string', 'max:50', 'unique:coupons,code'],
            'description'    => ['nullable', 'string'],
            'discount_type'  => ['required', Rule::in(['percentage', 'fixed'])],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'minimum_order'  => ['required', 'numeric', 'min:0'],
            'usage_limit'    => ['nullable', 'integer', 'min:1'],
            'expired_at'     => ['nullable', 'date', 'after:now'],
            'status'         => ['required', Rule::in(['active', 'inactive', 'expired'])],
        ]);

        $validated['code'] = strtoupper($validated['code']);

        Coupon::create($validated);

        return redirect()->route('admin.coupons')->with('status', 'Promo/kupon berhasil ditambahkan.');
    }

    public function editCoupon(Coupon $coupon)
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        return view('admin.edit-coupon', [
            'admin'   => $this->currentAdmin(),
            'adminId' => session('admin_id'),
            'coupon'  => $coupon,
        ]);
    }

    public function updateCoupon(Request $request, Coupon $coupon)
    {
        if ($redirect = $this->ensureAdminLoggedIn()) {
            return $redirect;
        }

        $validated = $request->validate([
            'code'           => ['required', 'string', 'max:50', Rule::unique('coupons', 'code')->ignore($coupon->id)],
            'description'    => ['nullable', 'string'],
            'discount_type'  => ['required', Rule::in(['percentage', 'fixed'])],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'minimum_order'  => ['required', 'numeric', 'min:0'],
            'usage_limit'    => ['nullable', 'integer', 'min:1'],
            'expired_at'     => ['nullable', 'date'],
            'status'         => ['required', Rule::in(['active', 'inactive', 'expired'])],
        ]);

        $validated['code'] = strtoupper($validated['code']);

        $coupon->update($validated);

        return redirect()->route('admin.coupons')->with('status', 'Promo/kupon berhasil diperbarui.');
    }
}
