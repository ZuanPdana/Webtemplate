<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wishlist - SHOESTEP</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F7F6F3] text-[#1F2937] antialiased">
    <div class="min-h-screen">
        <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 backdrop-blur">
            <div class="mx-auto flex flex-wrap items-center justify-between gap-4 px-6 py-4 max-w-7xl">
                <a href="{{ route('shop.home') }}" class="text-lg font-black tracking-[0.3em] text-slate-950">SHOESTEP</a>

                <nav class="hidden items-center gap-8 text-sm text-slate-600 md:flex">
                    <a href="{{ route('shop.home') }}" class="transition hover:text-slate-950">Beranda</a>
                    <a href="{{ route('shop.home') }}#produk" class="transition hover:text-slate-950">Produk</a>
                    <a href="{{ route('shop.home') }}#fitur" class="transition hover:text-slate-950">Fitur</a>
                    <a href="{{ route('shop.home') }}#tentang" class="transition hover:text-slate-950">Tentang</a>
                    <a href="/tracking" class="transition hover:text-slate-950">Order</a>
                </nav>

                <div class="flex items-center gap-3">
                    <div id="search-wrapper" class="relative hidden md:block">
                        <div id="search-bar" style="display:flex;align-items:center;gap:8px;border-radius:9999px;border:1px solid #e2e8f0;background:#f8fafc;padding:8px 16px;width:220px;transition:width 0.3s ease,border-color 0.2s,background 0.2s,box-shadow 0.2s;overflow:hidden;" onfocusin="this.style.borderColor='#94a3b8';this.style.background='#fff';this.style.boxShadow='0 4px 20px rgba(15,23,42,0.08)'" onfocusout="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';this.style.boxShadow='none'">
                            <svg id="search-icon" xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;flex-shrink:0;color:#94a3b8;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.35-4.35" />
                            </svg>
                            <input type="text" placeholder="Cari sepatu..." autocomplete="off" spellcheck="false" style="flex:1;min-width:0;background:transparent;font-size:13px;color:#0f172a;border:none;outline:none;" />
                        </div>
                    </div>

                    <button onclick="window.location.href='{{ route('shop.wishlist') }}'" title="Wishlist" class="relative inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                        </svg>
                        <span id="wishlist-badge" class="absolute -top-1 -right-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-rose-500 text-[10px] text-white" style="display:none;">0</span>
                    </button>

                    <button onclick="window.location.href='{{ route('shop.home') }}'" title="Keranjang" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <path d="M16 10a4 4 0 0 1-8 0" />
                        </svg>
                    </button>

                    <button onclick="window.location.href='/profile'" title="Profil" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M5.121 17.804A13.937 13.937 0 0 1 12 15c2.756 0 5.302.88 7.379 2.373M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path d="M4.5 19a8.25 8.25 0 0 1 15 0" />
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 py-10">
            <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.35em] text-cyan-700">Ruang Wishlist</p>
                        <h1 class="mt-4 text-4xl font-black tracking-tight text-slate-950">Koleksi Favorit Saya</h1>
                        <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-500">
                            Wishlist kamu terhubung langsung ke produk di database. Harga dan stok selalu akurat saat kamu membuka halaman ini.
                        </p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
                        <div class="rounded-[1.75rem] bg-cyan-50 p-5 shadow-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-700">Total Favorit</p>
                            <p id="wishlist-count" class="mt-3 text-4xl font-black text-slate-950">{{ $favorites->count() }}</p>
                        </div>
                        <div class="rounded-[1.75rem] bg-slate-950 p-5 text-white shadow-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.3em]">Tips</p>
                            <p class="mt-3 text-sm leading-6 text-slate-100/90">Klik tombol keranjang untuk memindahkan produk langsung ke checkout.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-10">
                <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_280px]">
                    <div class="space-y-6">
                        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h2 class="text-2xl font-black text-slate-950">Wishlist Produk</h2>
                                    <p class="mt-2 text-sm text-slate-500">Produk-produk yang kamu tandai tetap tersimpan di sini.</p>
                                </div>
                                <form action="{{ route('shop.wishlist.clear') }}" method="POST" class="inline-flex" onsubmit="return confirm('Yakin menghapus semua wishlist?');">
                                    @csrf
                                    <button type="submit" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Hapus Semua</button>
                                </form>
                            </div>
                        </div>

                        <div id="wishlist-grid" class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                            @forelse($favorites as $favorite)
                                @php
                                    $product = $favorite->product;
                                    $image = $product->images->first()?->image ?? $product->thumbnail;
                                @endphp
                                @if($product)
                                    <article class="rounded-[2rem] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl overflow-hidden">
                                        <div class="relative overflow-hidden bg-slate-950">
                                            @if($image)
                                                <img src="{{ asset($image) }}" alt="{{ $product->name }}" class="h-56 w-full object-cover" />
                                            @else
                                                <div class="flex h-56 items-center justify-center bg-slate-900 text-slate-300">Tidak ada gambar</div>
                                            @endif
                                            <form action="{{ route('shop.wishlist.remove', $product) }}" method="POST" class="absolute right-4 top-4">
                                                @csrf
                                                <button type="submit" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/90 text-slate-900 shadow-sm transition hover:bg-white" title="Hapus dari wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path d="M18 6 6 18M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center justify-between gap-3 text-xs uppercase tracking-[0.28em] text-slate-500">
                                                <span>{{ $product->category?->name ?? 'Tidak ada kategori' }}</span>
                                                <span class="rounded-full bg-emerald-50 px-2 py-1 text-emerald-700">Stok {{ $product->stock }}</span>
                                            </div>
                                            <h3 class="mt-4 text-xl font-black text-slate-950">{{ $product->name }}</h3>
                                            <p class="mt-3 text-sm leading-6 text-slate-500">Status: {{ Str::title(str_replace('_', ' ', $product->status)) }}</p>
                                            <div class="mt-6 flex items-center justify-between gap-3">
                                                <p class="text-xl font-black text-slate-950">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                                <button onclick="addToCartFromWishlist({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }});" class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Tambah</button>
                                            </div>
                                        </div>
                                    </article>
                                @endif
                            @empty
                                <div class="col-span-full rounded-[2rem] border border-dashed border-slate-300 bg-white/90 p-16 text-center text-slate-500">
                                    <p class="text-4xl">💔</p>
                                    <p class="mt-4 text-lg font-black text-slate-950">Wishlist masih kosong</p>
                                    <p class="mt-2 max-w-xl mx-auto text-sm text-slate-500">Tambahkan produk favorit dari halaman katalog untuk melihatnya di sini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <aside class="space-y-6">
                        <div class="rounded-[2rem] border border-slate-200 bg-slate-950 p-6 text-white shadow-sm">
                            <p class="text-xs uppercase tracking-[0.3em] text-cyan-300">Wishlist Insight</p>
                            <ul class="mt-5 space-y-4 text-sm leading-7 text-slate-200/90">
                                <li>• Harga dan stok terambil langsung dari database.</li>
                                <li>• Data selalu sama dengan catalog produk saat ini.</li>
                                <li>• Gunakan tombol tambah untuk checkout yang lebih cepat.</li>
                            </ul>
                        </div>
                        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-black text-slate-950">Rekomendasi</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-500">Produk favorit akan muncul di katalog kamu berikutnya untuk memudahkan pembelian.</p>
                        </div>
                    </aside>
                </div>
            </section>
        </main>
    </div>

    <script>
        function addToCartFromWishlist(id, name, price) {
            var existing = JSON.parse(localStorage.getItem('shoestep_cart') || '[]');
            existing.push({ id: id, name: name, price: price, quantity: 1 });
            localStorage.setItem('shoestep_cart', JSON.stringify(existing));
            alert('Produk "' + name + '" telah ditambahkan ke keranjang.');
        }
    </script>
</body>

</html>
