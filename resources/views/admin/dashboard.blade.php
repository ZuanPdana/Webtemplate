<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SHOESTEP - Admin Home</title>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#F7F6F3] text-[#1D1B18] antialiased">
        <div class="min-h-screen">
            @include('admin.partials.navbar')

            <main>
                {{-- Hero --}}
                <section class="bg-slate-950 text-white">
                    <div class="mx-auto grid max-w-7xl gap-8 px-6 py-14 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                        <div class="space-y-5">
                            <span class="inline-flex items-center rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-200">admin center</span>
                            <h1 class="text-4xl font-black leading-tight tracking-tight md:text-5xl">
                                Selamat datang,<br>
                                <span class="text-slate-300">{{ $admin?->name ?? $adminId }}</span>
                            </h1>
                            <p class="max-w-xl text-sm leading-7 text-slate-300">Gunakan navigasi di atas untuk mengelola produk, user, dan promo secara terpisah.</p>
                            @if (session('status'))
                                <div class="inline-flex rounded-full border border-emerald-300/40 bg-emerald-400/15 px-4 py-2 text-xs font-semibold text-emerald-100">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $productStats['total'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">Total Produk</p>
                            </div>
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $productStats['inStock'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">In Stock</p>
                            </div>
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $userStats['total'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">Total User</p>
                            </div>
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $couponStats['active'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">Promo Aktif</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Quick nav cards --}}
                <section class="mx-auto max-w-7xl px-6 py-12">
                    <p class="mb-6 text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Navigasi Cepat</p>
                    <div class="grid gap-5 sm:grid-cols-3">
                        <a href="{{ route('admin.products') }}"
                           class="group flex items-start gap-4 rounded-3xl border border-slate-200/80 bg-white p-6 shadow-lg shadow-slate-900/5 transition hover:border-slate-300 hover:shadow-xl">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-100 transition group-hover:bg-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-black text-slate-900">Produk</h3>
                                <p class="mt-1 text-xs text-slate-500">{{ $productStats['total'] }} produk · {{ $productStats['outOfStock'] }} out of stock</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.users') }}"
                           class="group flex items-start gap-4 rounded-3xl border border-slate-200/80 bg-white p-6 shadow-lg shadow-slate-900/5 transition hover:border-slate-300 hover:shadow-xl">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-100 transition group-hover:bg-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-black text-slate-900">User</h3>
                                <p class="mt-1 text-xs text-slate-500">{{ $userStats['total'] }} user · {{ $userStats['blocked'] }} diblokir</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.coupons') }}"
                           class="group flex items-start gap-4 rounded-3xl border border-slate-200/80 bg-white p-6 shadow-lg shadow-slate-900/5 transition hover:border-slate-300 hover:shadow-xl">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-100 transition group-hover:bg-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                    <line x1="7" y1="7" x2="7.01" y2="7"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-black text-slate-900">Promo</h3>
                                <p class="mt-1 text-xs text-slate-500">{{ $couponStats['total'] }} kupon · {{ $couponStats['active'] }} aktif</p>
                            </div>
                        </a>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>

        <div class="min-h-screen">
            <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 backdrop-blur">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-6 py-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-lg font-black tracking-[0.3em] text-slate-950">SHOESTEP</a>
                    <nav class="hidden items-center gap-8 text-sm text-slate-600 md:flex">
                        <a href="#overview" class="transition hover:text-slate-950">Overview</a>
                        <a href="#products" class="transition hover:text-slate-950">Produk</a>
                        <a href="#users" class="transition hover:text-slate-950">User</a>
                        <a href="#coupons" class="transition hover:text-slate-950">Promo</a>
                    </nav>
                    <a href="{{ route('admin.logout') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">Logout</a>
                </div>
            </header>

            <main>
                {{-- Hero / Overview --}}
                <section id="overview" class="bg-slate-950 text-white">
                    <div class="mx-auto grid max-w-7xl gap-8 px-6 py-14 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                        <div class="space-y-5">
                            <span class="inline-flex items-center rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-200">admin center</span>
                            <h1 class="text-4xl font-black leading-tight tracking-tight md:text-5xl">Dashboard Admin<br />{{ $adminId }}</h1>
                            <p class="max-w-xl text-sm leading-7 text-slate-300">Kelola produk, stok, promo diskon, dan semua data user dalam satu tampilan terintegrasi.</p>
                            @if (session('status'))
                                <div class="inline-flex rounded-full border border-emerald-300/40 bg-emerald-400/15 px-4 py-2 text-xs font-semibold text-emerald-100">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $productStats['total'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">Total Produk</p>
                            </div>
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $productStats['inStock'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">In Stock</p>
                            </div>
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $userStats['total'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">Total User</p>
                            </div>
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $coupons->where('status','active')->count() }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">Promo Aktif</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ═══ PRODUCT TABLE ═══ --}}
                <section id="products" class="mx-auto max-w-7xl px-6 py-12">
                    <div class="mb-5 flex flex-wrap items-end justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Produk</p>
                            <h2 class="mt-2 text-3xl font-black text-slate-950">Kelola produk & stok</h2>
                        </div>
                        <a href="{{ route('admin.products.create') }}"
                           class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                            Tambah Produk
                        </a>
                    </div>

                    {{-- Controls --}}
                    <div class="mb-4 flex flex-wrap items-center gap-3">
                        <input id="product-search" type="text" placeholder="Cari nama produk atau kategori…"
                            oninput="filterProducts()"
                            class="flex-1 min-w-[200px] rounded-full border border-slate-200 bg-white px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">

                        <select id="product-sort" onchange="sortProducts()"
                            class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="name_asc">Nama A–Z</option>
                            <option value="name_desc">Nama Z–A</option>
                            <option value="price_asc">Harga Terendah</option>
                            <option value="price_desc">Harga Tertinggi</option>
                            <option value="stock_asc">Stok Terendah</option>
                            <option value="stock_desc">Stok Tertinggi</option>
                            <option value="sold_desc">Terlaris</option>
                        </select>
                    </div>

                    <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/5">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm" id="product-table">
                                <thead class="bg-slate-50 text-[11px] uppercase tracking-[0.2em] text-slate-500">
                                    <tr>
                                        <th class="px-4 py-3">ID</th>
                                        <th class="px-4 py-3">Produk</th>
                                        <th class="px-4 py-3">Kategori</th>
                                        <th class="px-4 py-3">Harga</th>
                                        <th class="px-4 py-3">Stock</th>
                                        <th class="px-4 py-3">Terjual</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="product-tbody" class="divide-y divide-slate-100">
                                    @foreach ($products as $product)
                                        <tr class="product-row hover:bg-slate-50/60"
                                            data-name="{{ strtolower($product->name) }}"
                                            data-category="{{ strtolower($product->category?->name ?? '') }}"
                                            data-price="{{ $product->price }}"
                                            data-stock="{{ $product->stock }}"
                                            data-sold="{{ $product->sold_count ?? 0 }}"
                                            data-created="{{ $product->created_at?->timestamp ?? 0 }}">
                                            <td class="px-4 py-3 font-semibold text-slate-600">#{{ $product->id }}</td>
                                            <td class="px-4 py-3 font-semibold text-slate-900">{{ $product->name }}</td>
                                            <td class="px-4 py-3 text-slate-600">{{ $product->category?->name ?? '-' }}</td>
                                            <td class="px-4 py-3 text-slate-600">Rp{{ number_format((float) $product->price, 0, ',', '.') }}</td>
                                            <td class="px-4 py-3 text-slate-600">{{ $product->stock }}</td>
                                            <td class="px-4 py-3 text-slate-600">{{ $product->sold_count ?? 0 }}</td>
                                            <td class="px-4 py-3">
                                                <span @class([
                                                    'inline-flex rounded-full px-2.5 py-1 text-xs font-semibold',
                                                    'bg-emerald-100 text-emerald-700' => $product->status === 'published',
                                                    'bg-amber-100 text-amber-700' => $product->status === 'draft',
                                                    'bg-rose-100 text-rose-700' => in_array($product->status, ['out_of_stock', 'archived'], true),
                                                ])>{{ $product->status }}</span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <a href="{{ route('admin.products.edit', $product) }}"
                                                   class="inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-700">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Pagination controls --}}
                        <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3 text-sm text-slate-500">
                            <span id="product-count-label">Menampilkan <strong id="product-showing">0</strong> dari <strong id="product-total">{{ $products->count() }}</strong> produk</span>
                            <div class="flex items-center gap-2">
                                <button onclick="productPage(-1)" class="rounded-full border border-slate-200 px-3 py-1 text-xs hover:bg-slate-100">&#8592; Prev</button>
                                <span id="product-page-label" class="text-xs font-semibold">Hal 1</span>
                                <button onclick="productPage(1)" class="rounded-full border border-slate-200 px-3 py-1 text-xs hover:bg-slate-100">Next &#8594;</button>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ═══ USER TABLE ═══ --}}
                <section id="users" class="mx-auto max-w-7xl px-6 pb-12">
                    <div class="mb-5 flex flex-wrap items-end justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi User</p>
                            <h2 class="mt-2 text-3xl font-black text-slate-950">Kelola semua user</h2>
                        </div>
                        <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                            <span class="rounded-full bg-slate-100 px-3 py-1">{{ $userStats['inactive'] }} Inactive</span>
                            <span class="rounded-full bg-slate-100 px-3 py-1">{{ $userStats['blocked'] }} Blocked</span>
                        </div>
                    </div>

                    {{-- Controls --}}
                    <div class="mb-4 flex flex-wrap items-center gap-3">
                        <input id="user-search" type="text" placeholder="Cari nama, username, atau email…"
                            oninput="filterUsers()"
                            class="flex-1 min-w-[200px] rounded-full border border-slate-200 bg-white px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">

                        <select id="user-sort" onchange="sortUsers()"
                            class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="name_asc">Nama A–Z</option>
                            <option value="name_desc">Nama Z–A</option>
                            <option value="status">Status</option>
                        </select>
                    </div>

                    <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/5">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm">
                                <thead class="bg-slate-50 text-[11px] uppercase tracking-[0.2em] text-slate-500">
                                    <tr>
                                        <th class="px-4 py-3">ID</th>
                                        <th class="px-4 py-3">Nama</th>
                                        <th class="px-4 py-3">Username</th>
                                        <th class="px-4 py-3">Email</th>
                                        <th class="px-4 py-3">Phone</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="user-tbody" class="divide-y divide-slate-100">
                                    @foreach ($users as $user)
                                        <tr class="user-row hover:bg-slate-50/60"
                                            data-name="{{ strtolower($user->name) }}"
                                            data-username="{{ strtolower($user->username ?? '') }}"
                                            data-email="{{ strtolower($user->email) }}"
                                            data-status="{{ $user->status }}"
                                            data-created="{{ $user->created_at?->timestamp ?? 0 }}">
                                            <td class="px-4 py-3 font-semibold text-slate-600">#{{ $user->id }}</td>
                                            <td class="px-4 py-3 font-semibold text-slate-900">{{ $user->name }}</td>
                                            <td class="px-4 py-3 text-slate-600">{{ $user->username }}</td>
                                            <td class="px-4 py-3 text-slate-600">{{ $user->email }}</td>
                                            <td class="px-4 py-3 text-slate-600">{{ $user->phone ?? '-' }}</td>
                                            <td class="px-4 py-3">
                                                <span @class([
                                                    'inline-flex rounded-full px-2.5 py-1 text-xs font-semibold',
                                                    'bg-emerald-100 text-emerald-700' => $user->status === 'active',
                                                    'bg-amber-100 text-amber-700' => $user->status === 'inactive',
                                                    'bg-rose-100 text-rose-700' => $user->status === 'blocked',
                                                ])>{{ $user->status }}</span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                   class="inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-700">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3 text-sm text-slate-500">
                            <span>Menampilkan <strong id="user-showing">0</strong> dari <strong id="user-total">{{ $users->count() }}</strong> user</span>
                            <div class="flex items-center gap-2">
                                <button onclick="userPage(-1)" class="rounded-full border border-slate-200 px-3 py-1 text-xs hover:bg-slate-100">&#8592; Prev</button>
                                <span id="user-page-label" class="text-xs font-semibold">Hal 1</span>
                                <button onclick="userPage(1)" class="rounded-full border border-slate-200 px-3 py-1 text-xs hover:bg-slate-100">Next &#8594;</button>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ═══ COUPON / PROMO TABLE ═══ --}}
                <section id="coupons" class="mx-auto max-w-7xl px-6 pb-16">
                    <div class="mb-5 flex flex-wrap items-end justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Promo</p>
                            <h2 class="mt-2 text-3xl font-black text-slate-950">Kode Promo & Diskon</h2>
                        </div>
                        <a href="{{ route('admin.coupons.create') }}"
                           class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                            Tambah Promo
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/5">
                        @if ($coupons->isEmpty())
                            <p class="px-6 py-8 text-sm text-slate-500">Belum ada promo. <a href="{{ route('admin.coupons.create') }}" class="font-semibold text-slate-900 underline">Buat sekarang</a>.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-left text-sm">
                                    <thead class="bg-slate-50 text-[11px] uppercase tracking-[0.2em] text-slate-500">
                                        <tr>
                                            <th class="px-4 py-3">Kode</th>
                                            <th class="px-4 py-3">Tipe</th>
                                            <th class="px-4 py-3">Nilai</th>
                                            <th class="px-4 py-3">Min. Order</th>
                                            <th class="px-4 py-3">Pakai / Limit</th>
                                            <th class="px-4 py-3">Kadaluarsa</th>
                                            <th class="px-4 py-3">Status</th>
                                            <th class="px-4 py-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach ($coupons as $coupon)
                                            <tr class="hover:bg-slate-50/60">
                                                <td class="px-4 py-3 font-mono font-semibold text-slate-900">{{ $coupon->code }}</td>
                                                <td class="px-4 py-3 text-slate-600">{{ $coupon->discount_type === 'percentage' ? 'Persentase' : 'Nominal' }}</td>
                                                <td class="px-4 py-3 font-semibold text-slate-900">
                                                    @if ($coupon->discount_type === 'percentage')
                                                        {{ $coupon->discount_value }}%
                                                    @else
                                                        Rp{{ number_format((float) $coupon->discount_value, 0, ',', '.') }}
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3 text-slate-600">Rp{{ number_format((float) $coupon->minimum_order, 0, ',', '.') }}</td>
                                                <td class="px-4 py-3 text-slate-600">{{ $coupon->used_count }} / {{ $coupon->usage_limit ?? '∞' }}</td>
                                                <td class="px-4 py-3 text-slate-600">{{ $coupon->expired_at ? $coupon->expired_at->format('d M Y') : '—' }}</td>
                                                <td class="px-4 py-3">
                                                    <span @class([
                                                        'inline-flex rounded-full px-2.5 py-1 text-xs font-semibold',
                                                        'bg-emerald-100 text-emerald-700' => $coupon->status === 'active',
                                                        'bg-amber-100 text-amber-700' => $coupon->status === 'inactive',
                                                        'bg-rose-100 text-rose-700' => $coupon->status === 'expired',
                                                    ])>{{ $coupon->status }}</span>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <a href="{{ route('admin.coupons.edit', $coupon) }}"
                                                       class="inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-700">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </section>
            </main>
        </div>

        <script>
        /* ═══════════════════════════
           PRODUCT TABLE: search + sort + paginate
        ═══════════════════════════ */
        var PRODUCT_PAGE_SIZE = 10;
        var productCurrentPage = 1;
        var productFilteredRows = [];

        function getAllProductRows() {
            return Array.from(document.querySelectorAll('#product-tbody .product-row'));
        }

        function filterProducts() {
            var q = document.getElementById('product-search').value.toLowerCase().trim();
            productCurrentPage = 1;
            productFilteredRows = getAllProductRows().filter(function(r) {
                return !q || r.dataset.name.includes(q) || r.dataset.category.includes(q);
            });
            sortProducts(true);
        }

        function sortProducts(fromFilter) {
            if (!fromFilter) {
                productCurrentPage = 1;
                if (!productFilteredRows.length) productFilteredRows = getAllProductRows();
            }
            var key = document.getElementById('product-sort').value;
            productFilteredRows.sort(function(a, b) {
                if (key === 'newest')     return b.dataset.created - a.dataset.created;
                if (key === 'oldest')     return a.dataset.created - b.dataset.created;
                if (key === 'name_asc')   return a.dataset.name.localeCompare(b.dataset.name);
                if (key === 'name_desc')  return b.dataset.name.localeCompare(a.dataset.name);
                if (key === 'price_asc')  return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                if (key === 'price_desc') return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                if (key === 'stock_asc')  return parseInt(a.dataset.stock) - parseInt(b.dataset.stock);
                if (key === 'stock_desc') return parseInt(b.dataset.stock) - parseInt(a.dataset.stock);
                if (key === 'sold_desc')  return parseInt(b.dataset.sold) - parseInt(a.dataset.sold);
                return 0;
            });
            renderProductPage();
        }

        function productPage(delta) {
            var maxPage = Math.max(1, Math.ceil(productFilteredRows.length / PRODUCT_PAGE_SIZE));
            productCurrentPage = Math.min(maxPage, Math.max(1, productCurrentPage + delta));
            renderProductPage();
        }

        function renderProductPage() {
            var allRows = getAllProductRows();
            allRows.forEach(function(r) { r.style.display = 'none'; });
            var start = (productCurrentPage - 1) * PRODUCT_PAGE_SIZE;
            var slice = productFilteredRows.slice(start, start + PRODUCT_PAGE_SIZE);
            var tbody = document.getElementById('product-tbody');
            slice.forEach(function(r) {
                tbody.appendChild(r);
                r.style.display = '';
            });
            document.getElementById('product-showing').textContent = slice.length;
            document.getElementById('product-total').textContent = productFilteredRows.length;
            var maxPage = Math.max(1, Math.ceil(productFilteredRows.length / PRODUCT_PAGE_SIZE));
            document.getElementById('product-page-label').textContent = 'Hal ' + productCurrentPage + ' / ' + maxPage;
        }

        /* ═══════════════════════════
           USER TABLE: search + sort + paginate
        ═══════════════════════════ */
        var USER_PAGE_SIZE = 10;
        var userCurrentPage = 1;
        var userFilteredRows = [];

        function getAllUserRows() {
            return Array.from(document.querySelectorAll('#user-tbody .user-row'));
        }

        function filterUsers() {
            var q = document.getElementById('user-search').value.toLowerCase().trim();
            userCurrentPage = 1;
            userFilteredRows = getAllUserRows().filter(function(r) {
                return !q || r.dataset.name.includes(q) || r.dataset.username.includes(q) || r.dataset.email.includes(q);
            });
            sortUsers(true);
        }

        function sortUsers(fromFilter) {
            if (!fromFilter) {
                userCurrentPage = 1;
                if (!userFilteredRows.length) userFilteredRows = getAllUserRows();
            }
            var key = document.getElementById('user-sort').value;
            userFilteredRows.sort(function(a, b) {
                if (key === 'newest')    return b.dataset.created - a.dataset.created;
                if (key === 'oldest')    return a.dataset.created - b.dataset.created;
                if (key === 'name_asc')  return a.dataset.name.localeCompare(b.dataset.name);
                if (key === 'name_desc') return b.dataset.name.localeCompare(a.dataset.name);
                if (key === 'status')    return a.dataset.status.localeCompare(b.dataset.status);
                return 0;
            });
            renderUserPage();
        }

        function userPage(delta) {
            var maxPage = Math.max(1, Math.ceil(userFilteredRows.length / USER_PAGE_SIZE));
            userCurrentPage = Math.min(maxPage, Math.max(1, userCurrentPage + delta));
            renderUserPage();
        }

        function renderUserPage() {
            var allRows = getAllUserRows();
            allRows.forEach(function(r) { r.style.display = 'none'; });
            var start = (userCurrentPage - 1) * USER_PAGE_SIZE;
            var slice = userFilteredRows.slice(start, start + USER_PAGE_SIZE);
            var tbody = document.getElementById('user-tbody');
            slice.forEach(function(r) {
                tbody.appendChild(r);
                r.style.display = '';
            });
            document.getElementById('user-showing').textContent = slice.length;
            document.getElementById('user-total').textContent = userFilteredRows.length;
            var maxPage = Math.max(1, Math.ceil(userFilteredRows.length / USER_PAGE_SIZE));
            document.getElementById('user-page-label').textContent = 'Hal ' + userCurrentPage + ' / ' + maxPage;
        }

        /* Init on load */
        document.addEventListener('DOMContentLoaded', function() {
            productFilteredRows = getAllProductRows();
            sortProducts(true);
            userFilteredRows = getAllUserRows();
            sortUsers(true);
        });
        </script>
    </body>
</html>

        <div class="min-h-screen">
            <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 backdrop-blur">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-6 py-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-lg font-black tracking-[0.3em] text-slate-950">SHOESTEP</a>
                    <nav class="hidden items-center gap-8 text-sm text-slate-600 md:flex">
                        <a href="#overview" class="transition hover:text-slate-950">Overview</a>
                        <a href="#products" class="transition hover:text-slate-950">Produk</a>
                        <a href="#users" class="transition hover:text-slate-950">User</a>
                    </nav>
                    <a href="{{ route('admin.logout') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">Logout</a>
                </div>
            </header>

            <main>
                <section id="overview" class="bg-slate-950 text-white">
                    <div class="mx-auto grid max-w-7xl gap-8 px-6 py-14 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                        <div class="space-y-5">
                            <span class="inline-flex items-center rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-200">admin center</span>
                            <h1 class="text-4xl font-black leading-tight tracking-tight md:text-5xl">Dashboard Admin<br />{{ $adminId }}</h1>
                            <p class="max-w-xl text-sm leading-7 text-slate-300">Tampilan admin dibuat serupa dashboard user, dengan kemampuan administrasi untuk memonitor stok, serta mengelola dan mengedit semua data produk dan user.</p>
                            @if (session('status'))
                                <div class="inline-flex rounded-full border border-emerald-300/40 bg-emerald-400/15 px-4 py-2 text-xs font-semibold text-emerald-100">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $productStats['total'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">Total Produk</p>
                            </div>
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $productStats['inStock'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">In Stock</p>
                            </div>
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $userStats['total'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">Total User</p>
                            </div>
                            <div class="rounded-3xl bg-white/5 px-4 py-5">
                                <p class="text-3xl font-black">{{ $userStats['active'] }}</p>
                                <p class="mt-2 text-[11px] uppercase tracking-[0.2em] text-slate-300">User Active</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="products" class="mx-auto max-w-7xl px-6 py-12">
                    <div class="mb-5 flex flex-wrap items-end justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Produk</p>
                            <h2 class="mt-2 text-3xl font-black text-slate-950">Kelola produk & stok</h2>
                        </div>
                        <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                            <span class="rounded-full bg-slate-100 px-3 py-1">{{ $productStats['published'] }} Published</span>
                            <span class="rounded-full bg-slate-100 px-3 py-1">{{ $productStats['outOfStock'] }} Out of Stock</span>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/5">
                        @if ($products->isEmpty())
                            <p class="px-6 py-8 text-sm text-slate-500">Belum ada produk.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-left text-sm">
                                    <thead class="bg-slate-50 text-[11px] uppercase tracking-[0.2em] text-slate-500">
                                        <tr>
                                            <th class="px-4 py-3">ID</th>
                                            <th class="px-4 py-3">Produk</th>
                                            <th class="px-4 py-3">Kategori</th>
                                            <th class="px-4 py-3">Harga</th>
                                            <th class="px-4 py-3">Stock</th>
                                            <th class="px-4 py-3">Status</th>
                                            <th class="px-4 py-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach ($products as $product)
                                            <tr class="hover:bg-slate-50/60">
                                                <td class="px-4 py-3 font-semibold text-slate-600">#{{ $product->id }}</td>
                                                <td class="px-4 py-3 font-semibold text-slate-900">{{ $product->name }}</td>
                                                <td class="px-4 py-3 text-slate-600">{{ $product->category?->name ?? '-' }}</td>
                                                <td class="px-4 py-3 text-slate-600">Rp{{ number_format((float) $product->price, 0, ',', '.') }}</td>
                                                <td class="px-4 py-3 text-slate-600">{{ $product->stock }}</td>
                                                <td class="px-4 py-3">
                                                    <span @class([
                                                        'inline-flex rounded-full px-2.5 py-1 text-xs font-semibold',
                                                        'bg-emerald-100 text-emerald-700' => $product->status === 'published',
                                                        'bg-amber-100 text-amber-700' => $product->status === 'draft',
                                                        'bg-rose-100 text-rose-700' => in_array($product->status, ['out_of_stock', 'archived'], true),
                                                    ])>{{ $product->status }}</span>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-700">Edit Produk</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </section>

                <section id="users" class="mx-auto max-w-7xl px-6 pb-16">
                    <div class="mb-5 flex flex-wrap items-end justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi User</p>
                            <h2 class="mt-2 text-3xl font-black text-slate-950">Kelola semua user</h2>
                        </div>
                        <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                            <span class="rounded-full bg-slate-100 px-3 py-1">{{ $userStats['inactive'] }} Inactive</span>
                            <span class="rounded-full bg-slate-100 px-3 py-1">{{ $userStats['blocked'] }} Blocked</span>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/5">
                        @if ($users->isEmpty())
                            <p class="px-6 py-8 text-sm text-slate-500">Belum ada user.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-left text-sm">
                                    <thead class="bg-slate-50 text-[11px] uppercase tracking-[0.2em] text-slate-500">
                                        <tr>
                                            <th class="px-4 py-3">ID</th>
                                            <th class="px-4 py-3">Nama</th>
                                            <th class="px-4 py-3">Username</th>
                                            <th class="px-4 py-3">Email</th>
                                            <th class="px-4 py-3">Phone</th>
                                            <th class="px-4 py-3">Status</th>
                                            <th class="px-4 py-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach ($users as $user)
                                            <tr class="hover:bg-slate-50/60">
                                                <td class="px-4 py-3 font-semibold text-slate-600">#{{ $user->id }}</td>
                                                <td class="px-4 py-3 font-semibold text-slate-900">{{ $user->name }}</td>
                                                <td class="px-4 py-3 text-slate-600">{{ $user->username }}</td>
                                                <td class="px-4 py-3 text-slate-600">{{ $user->email }}</td>
                                                <td class="px-4 py-3 text-slate-600">{{ $user->phone ?? '-' }}</td>
                                                <td class="px-4 py-3">
                                                    <span @class([
                                                        'inline-flex rounded-full px-2.5 py-1 text-xs font-semibold',
                                                        'bg-emerald-100 text-emerald-700' => $user->status === 'active',
                                                        'bg-amber-100 text-amber-700' => $user->status === 'inactive',
                                                        'bg-rose-100 text-rose-700' => $user->status === 'blocked',
                                                    ])>{{ $user->status }}</span>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-700">Edit User</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
