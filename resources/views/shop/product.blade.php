<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $product->name }} - SHOESTEP</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F7F6F3] text-[#1D1B18] antialiased">
    <div class="min-h-screen">
        <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 backdrop-blur">
            <div class="mx-auto flex flex-wrap items-center justify-between gap-4 px-6 py-4 max-w-7xl">
                <a href="{{ route('shop.home') }}" class="text-lg font-black tracking-[0.3em] text-slate-950">SHOESTEP</a>
                <nav class="hidden items-center gap-8 text-sm text-slate-600 md:flex">
                    <a href="{{ route('shop.home') }}" class="transition hover:text-slate-950">Beranda</a>
                    <a href="#produk" class="transition hover:text-slate-950">Produk</a>
                    <a href="/profile" class="transition hover:text-slate-950">Profil</a>
                    <a href="/tracking" class="transition hover:text-slate-950">Order</a>
                </nav>
                <div class="flex items-center gap-3"></div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 py-12">
            <div class="grid gap-8 lg:grid-cols-[1.2fr_auto]">
                <section class="space-y-8 rounded-[2rem] bg-white p-8 shadow-sm">
                    <div class="grid gap-6 lg:grid-cols-[1.25fr_0.75fr]">
                        <div class="space-y-6">
                            <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-slate-50 p-6">
                                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                    @if ($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="h-80 w-full rounded-[1.5rem] object-cover" />
                                    @else
                                        <div class="flex h-80 items-center justify-center rounded-[1.5rem] bg-slate-200">
                                            <span class="text-slate-500">Tidak ada gambar utama</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6">
                                <div class="flex flex-wrap items-center justify-between gap-4">
                                    <div>
                                        <p class="text-sm uppercase tracking-[0.24em] text-slate-500">{{ $product->category?->name ?? 'Kategori' }}</p>
                                        <h1 class="mt-3 text-3xl font-black text-slate-950">{{ $product->name }}</h1>
                                    </div>
                                    <p class="rounded-full bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-600">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="mt-6 space-y-3 text-sm leading-7 text-slate-600">
                                    <p>{{ $product->description }}</p>
                                    <p>Status: <span class="font-semibold text-slate-900">{{ str_replace('_', ' ', $product->status) }}</span></p>
                                    <p>Stok: <span class="font-semibold text-slate-900">{{ $product->stock }}</span></p>
                                    <p>Berat: <span class="font-semibold text-slate-900">{{ $product->weight ?? '0' }} kg</span></p>
                                </div>
                            </div>

                            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                                <h2 class="text-xl font-black text-slate-950">Galeri Gambar</h2>
                                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                    @forelse($product->images as $image)
                                        <div class="overflow-hidden rounded-[1.5rem] border border-slate-200 bg-slate-50">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->alt_text }}" class="h-44 w-full object-cover" />
                                        </div>
                                    @empty
                                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-6 text-center text-slate-500">Tidak ada gambar tambahan.</div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                                <h2 class="text-xl font-black text-slate-950">Ulasan Produk</h2>
                                <div class="mt-5 space-y-4">
                                    @forelse($product->reviews as $review)
                                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-4">
                                            <div class="flex flex-wrap items-center justify-between gap-2">
                                                <div>
                                                    <p class="font-semibold text-slate-900">{{ $review->title }}</p>
                                                    <p class="text-xs text-slate-500">{{ $review->user?->name ?? 'Pelanggan' }} • {{ $review->rating }} / 5</p>
                                                </div>
                                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-emerald-700">{{ $review->status }}</span>
                                            </div>
                                            <p class="mt-3 text-sm leading-7 text-slate-700">{{ $review->comment }}</p>
                                        </div>
                                    @empty
                                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-6 text-center text-slate-500">Belum ada ulasan untuk produk ini.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <aside class="space-y-6">
                            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                                <h2 class="text-sm uppercase tracking-[0.24em] text-slate-500">Aksi Cepat</h2>
                                <div class="mt-6 flex flex-col gap-3">
                                    <button onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})" class="rounded-full bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Tambah ke Keranjang</button>
                                    <button onclick="buyNow({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})" class="rounded-full bg-emerald-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-500">Beli Sekarang</button>
                                </div>
                            </div>
                        </aside>
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>

</html>
