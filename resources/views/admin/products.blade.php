<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SHOESTEP - Kelola Produk</title>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#F7F6F3] text-[#1D1B18] antialiased">
        <div class="min-h-screen">
            @include('admin.partials.navbar')

            <main class="mx-auto max-w-7xl px-6 py-10">
                @if (session('status'))
                    <div class="mb-6 inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-semibold text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Produk</p>
                        <h1 class="mt-2 text-3xl font-black text-slate-950">Kelola produk & stok</h1>
                        <p class="mt-1 text-sm text-slate-500">
                            {{ $productStats['total'] }} produk ·
                            {{ $productStats['published'] }} published ·
                            {{ $productStats['outOfStock'] }} out of stock
                        </p>
                    </div>
                    <a href="{{ route('admin.products.create') }}"
                       class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                        Tambah Produk
                    </a>
                </div>

                {{-- Search + Sort controls --}}
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
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-slate-50 text-[11px] uppercase tracking-[0.2em] text-slate-500">
                                <tr>
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Thumbnail</th>
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
                                        <td class="px-4 py-3">
                                            @php
                                                $thumb = $product->thumbnail;
                                                $imgSrc = $thumb
                                                    ? (str_starts_with($thumb, 'http')
                                                        ? $thumb
                                                        : (Storage::disk('public')->exists($thumb)
                                                            ? Storage::url($thumb)
                                                            : asset($thumb)))
                                                    : null;
                                            @endphp
                                            @if ($imgSrc)
                                                <img src="{{ $imgSrc }}" alt="{{ $product->name }}"
                                                     class="h-12 w-12 rounded-xl object-cover border border-slate-100">
                                            @else
                                                <div class="h-12 w-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                                </div>
                                            @endif
                                        </td>
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
                    <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3 text-sm text-slate-500">
                        <span>Menampilkan <strong id="product-showing">0</strong> dari <strong id="product-total">{{ $products->count() }}</strong> produk</span>
                        <div class="flex items-center gap-2">
                            <button onclick="productPage(-1)" class="rounded-full border border-slate-200 px-3 py-1 text-xs hover:bg-slate-100">&#8592; Prev</button>
                            <span id="product-page-label" class="text-xs font-semibold">Hal 1</span>
                            <button onclick="productPage(1)" class="rounded-full border border-slate-200 px-3 py-1 text-xs hover:bg-slate-100">Next &#8594;</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script>
        var PRODUCT_PAGE_SIZE = 10;
        var productCurrentPage = 1;
        var productFilteredRows = [];

        function getAllProductRows() { return Array.from(document.querySelectorAll('#product-tbody .product-row')); }

        function filterProducts() {
            var q = document.getElementById('product-search').value.toLowerCase().trim();
            productCurrentPage = 1;
            productFilteredRows = getAllProductRows().filter(function(r) {
                return !q || r.dataset.name.includes(q) || r.dataset.category.includes(q);
            });
            sortProducts(true);
        }

        function sortProducts(fromFilter) {
            if (!fromFilter) { productCurrentPage = 1; if (!productFilteredRows.length) productFilteredRows = getAllProductRows(); }
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
            var max = Math.max(1, Math.ceil(productFilteredRows.length / PRODUCT_PAGE_SIZE));
            productCurrentPage = Math.min(max, Math.max(1, productCurrentPage + delta));
            renderProductPage();
        }

        function renderProductPage() {
            getAllProductRows().forEach(function(r) { r.style.display = 'none'; });
            var start = (productCurrentPage - 1) * PRODUCT_PAGE_SIZE;
            var slice = productFilteredRows.slice(start, start + PRODUCT_PAGE_SIZE);
            var tbody = document.getElementById('product-tbody');
            slice.forEach(function(r) { tbody.appendChild(r); r.style.display = ''; });
            document.getElementById('product-showing').textContent = slice.length;
            document.getElementById('product-total').textContent = productFilteredRows.length;
            var max = Math.max(1, Math.ceil(productFilteredRows.length / PRODUCT_PAGE_SIZE));
            document.getElementById('product-page-label').textContent = 'Hal ' + productCurrentPage + ' / ' + max;
        }

        document.addEventListener('DOMContentLoaded', function() {
            productFilteredRows = getAllProductRows();
            sortProducts(true);
        });
        </script>
    </body>
</html>
