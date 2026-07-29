@extends('admin.layout')

@section('title', 'Administrasi Produk')

@section('content')
<div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Produk</p>
            <h1 class="mt-3 text-3xl font-black text-slate-950">Daftar Produk</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.products.create') }}" class="rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Tambah Produk</a>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.products.index') }}" class="admin-search-form mt-6 grid gap-3 md:grid-cols-[1fr_auto]">
        <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari produk..." autocomplete="off" class="relative z-10 rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 outline-none focus:border-slate-300 focus:ring-2 focus:ring-emerald-200 focus:ring-offset-0 focus:text-slate-900 w-full" />
        <div class="flex flex-col gap-3 md:flex-row md:items-center">
            <select name="sort" class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none w-full md:w-auto">
                <option value="name_asc" {{ request('sort', 'name_asc') === 'name_asc' ? 'selected' : '' }}>Nama A → Z</option>
                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Harga terendah</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Harga tertinggi</option>
                <option value="purchases_desc" {{ request('sort') === 'purchases_desc' ? 'selected' : '' }}>Pembelian terbanyak</option>
                <option value="purchases_asc" {{ request('sort') === 'purchases_asc' ? 'selected' : '' }}>Pembelian tersedikit</option>
                <option value="stock_desc" {{ request('sort') === 'stock_desc' ? 'selected' : '' }}>Stok terbanyak</option>
                <option value="stock_asc" {{ request('sort') === 'stock_asc' ? 'selected' : '' }}>Stok tersedikit</option>
            </select>
            <button type="submit" class="rounded-3xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-500">Cari</button>
        </div>
    </form>

    <div class="mt-6">
        <div class="hidden md:block overflow-hidden rounded-xl border border-slate-200 shadow-sm">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-900">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Produk</th>
                        <th class="px-6 py-3 font-semibold">Kategori</th>
                        <th class="px-6 py-3 font-semibold">Harga</th>
                        <th class="px-6 py-3 font-semibold">Stok</th>
                        <th class="px-6 py-3 font-semibold">Terjual</th>
                        <th class="px-6 py-3 font-semibold">Status</th>
                        <th class="px-6 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($products as $product)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="h-14 w-14 rounded-2xl object-cover" />
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $product->name }}</p>
                                        <p class="text-xs text-slate-500">{{ Str::limit($product->description, 60) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $product->category?->name ?? '-' }}</td>
                            <td class="px-6 py-4">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $product->stock }}</td>
                            <td class="px-6 py-4">{{ $product->purchases_count ?? 0 }}</td>
                            <td class="px-6 py-4 uppercase text-slate-600">{{ str_replace('_', ' ', $product->status) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-sm text-slate-500">Tidak ada produk ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-4 md:hidden">
            @forelse($products as $product)
                <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="h-16 w-16 rounded-lg object-cover" />
                            <div>
                                <p class="font-semibold text-slate-900">{{ $product->name }}</p>
                                <p class="text-xs text-slate-500">{{ $product->category?->name ?? '-' }}</p>
                                <p class="mt-1 text-sm text-slate-700">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">Edit</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-xl border border-slate-200 bg-white p-6 text-center text-sm text-slate-500">Tidak ada produk ditemukan.</div>
            @endforelse
        </div>
    </div>

    @if(method_exists($products, 'links'))
        <div class="mt-4">{{ $products->links() }}</div>
    @endif
</div>
@endsection
