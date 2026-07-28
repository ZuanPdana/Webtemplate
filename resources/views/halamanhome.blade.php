<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SHOESTEP - Home</title>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#F7F6F3] text-[#1D1B18] antialiased">
        <div class="min-h-screen">
            <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 backdrop-blur">
                <div class="mx-auto flex flex-wrap items-center justify-between gap-4 px-6 py-4 max-w-7xl">
                    <a href="/" class="text-lg font-black tracking-[0.3em] text-slate-950">SHOESTEP</a>
                    <nav class="hidden items-center gap-8 text-sm text-slate-600 md:flex">
                        <a href="/profile" class="transition hover:text-slate-950">Profil</a>
                        <a href="#produk" class="transition hover:text-slate-950">Produk</a>
                        <a href="#fitur" class="transition hover:text-slate-950">Fitur</a>
                        <a href="#tentang" class="transition hover:text-slate-950">Tentang</a>
                        <a href="#kontak" class="transition hover:text-slate-950">Kontak</a>
                    </nav>
                    <div class="flex items-center gap-3">
                        <button class="hidden items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-500 hover:bg-slate-100 md:inline-flex">
                            <span>🔍</span>
                            <span>Cari sepatu...</span>
                        </button>
                        <a href="#produk" class="rounded-full bg-slate-950 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-slate-200/20 transition hover:bg-slate-800">Belanja</a>
                    </div>
                </div>
            </header>

            <main>
                <section class="bg-slate-950 text-white">
                    <div class="mx-auto grid max-w-7xl gap-10 px-6 py-20 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                        <div class="space-y-8">
                            <span class="inline-flex items-center rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-200">koleksi terbaru 2024</span>
                            <div class="max-w-2xl space-y-6">
                                <h1 class="text-5xl font-black leading-tight tracking-tight md:text-6xl">Step Up<br />Your Style</h1>
                                <p class="max-w-xl text-base leading-8 text-slate-300">Temukan berbagai sepatu terbaik untuk setiap langkahmu. Kualitas premium, model kekinian, dan pilihan lengkap untuk gaya harianmu.</p>
                            </div>
                            <div class="flex flex-wrap gap-4">
                                <a href="#produk" class="inline-flex items-center justify-center rounded-full bg-white px-8 py-3.5 text-sm font-semibold text-slate-950 transition hover:bg-slate-100">Belanja Sekarang</a>
                                <a href="#fitur" class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/5 px-8 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10">Lihat Koleksi</a>
                            </div>
                            <div class="grid grid-cols-3 gap-4 sm:grid-cols-3">
                                <div class="rounded-3xl bg-white/5 px-4 py-5 text-center">
                                    <p class="text-3xl font-black">500+</p>
                                    <p class="mt-2 text-xs uppercase tracking-[0.25em] text-slate-400">Produk</p>
                                </div>
                                <div class="rounded-3xl bg-white/5 px-4 py-5 text-center">
                                    <p class="text-3xl font-black">50K+</p>
                                    <p class="mt-2 text-xs uppercase tracking-[0.25em] text-slate-400">Pelanggan</p>
                                </div>
                                <div class="rounded-3xl bg-white/5 px-4 py-5 text-center">
                                    <p class="text-3xl font-black">4.9★</p>
                                    <p class="mt-2 text-xs uppercase tracking-[0.25em] text-slate-400">Rating</p>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-x-0 top-0 h-1/2 bg-white/10 blur-3xl" aria-hidden="true"></div>
                            <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-slate-900 p-8 shadow-[0_40px_80px_rgba(15,23,42,0.35)]">
                                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.15),transparent_40%)]"></div>
                                <div class="relative overflow-hidden rounded-[1.75rem] bg-slate-800 p-8">
                                    <svg viewBox="0 0 240 140" class="h-full w-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <ellipse cx="120" cy="128" rx="100" ry="9" fill="#64748b" />
                                        <path d="M35 108 Q50 72 100 65 L168 58 Q200 58 205 76 Q210 92 192 100 Q172 108 120 112 Q72 115 35 108Z" fill="#475569" />
                                        <path d="M100 65 Q112 46 136 44 L180 46 Q198 49 202 65 L168 58Z" fill="#94a3b8" />
                                        <path d="M35 108 Q42 100 66 99 L198 99 Q210 99 210 105 L198 111 Q120 117 35 108Z" fill="#334155" />
                                        <path d="M108 65 L114 44" stroke="#f8fafc" stroke-width="2.5" />
                                        <path d="M126 64 L130 45" stroke="#f8fafc" stroke-width="2.5" />
                                        <path d="M144 62 L146 47" stroke="#f8fafc" stroke-width="2.5" />
                                        <circle cx="60" cy="86" r="5" fill="#94a3b8" />
                                        <circle cx="76" cy="83" r="5" fill="#94a3b8" />
                                        <circle cx="92" cy="81" r="5" fill="#94a3b8" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-slate-950 text-white">
                    <div class="mx-auto max-w-7xl px-6 py-4 text-center text-sm font-semibold tracking-[0.2em] text-slate-300">
                        🎉 PROMO SPESIAL — DISKON 50% untuk pembelian pertama! Gunakan kode <span class="rounded-full bg-white/10 px-2 py-1 text-white">SHOESTEP50</span>
                    </div>
                </section>

                <section id="produk" class="mx-auto max-w-7xl px-6 py-16">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Pilihan Produk</p>
                            <h2 class="mt-3 text-3xl font-black text-slate-950 sm:text-4xl">Produk unggulan untuk setiap gaya</h2>
                            <p class="mt-4 max-w-xl text-sm leading-7 text-slate-600">Temukan sepatu dengan kualitas terbaik dan desain modern yang nyaman dipakai sepanjang hari.</p>
                        </div>
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                            <div class="flex flex-wrap items-center gap-2 rounded-full bg-slate-100 p-2">
                                <button class="rounded-full bg-slate-950 px-4 py-2 text-xs font-semibold text-white">Semua</button>
                                <button class="rounded-full px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-200">Sport</button>
                                <button class="rounded-full px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-200">Casual</button>
                                <button class="rounded-full px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-200">Formal</button>
                            </div>
                            <div class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 shadow-sm">Urutkan: Terbaru</div>
                        </div>
                    </div>

                    <div class="mt-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                        @forelse ($products as $product)
                            <article class="group overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                                <div class="relative overflow-hidden bg-slate-100 p-6">
                                    @if ($product->featured)
                                        <span class="absolute left-4 top-4 rounded-full bg-slate-950 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.28em] text-white">Terlaris</span>
                                    @elseif ($product->popular)
                                        <span class="absolute left-4 top-4 rounded-full bg-amber-100 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.28em] text-amber-700">Populer</span>
                                    @endif
                                    <button class="absolute right-4 top-4 inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-lg shadow-sm">♡</button>
                                    <div class="flex h-52 items-center justify-center">
                                        @php
                                        $image = $product->images->first()?->image;
                                    @endphp
                                    @if ($image)
                                        <img src="{{ asset($image) }}" alt="{{ $product->name }}" class="h-40 w-full object-contain" />
                                    @elseif ($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="h-40 w-full object-contain" />
                                    @else
                                        <svg viewBox="0 0 240 140" class="h-40 w-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <ellipse cx="120" cy="128" rx="100" ry="9" fill="#e2e8f0" />
                                            <path d="M35 108 Q50 72 100 65 L168 58 Q200 58 205 76 Q210 92 192 100 Q172 108 120 112 Q72 115 35 108Z" fill="#cbd5e1" />
                                            <path d="M100 65 Q112 46 136 44 L180 46 Q198 49 202 65 L168 58Z" fill="#94a3b8" />
                                            <path d="M35 108 Q42 100 66 99 L198 99 Q210 99 210 105 L198 111 Q120 117 35 108Z" fill="#64748b" />
                                        </svg>
                                    @endif
                                    </div>
                                </div>
                                <div class="space-y-4 p-6">
                                    <div class="flex items-center justify-between text-xs uppercase tracking-[0.25em] text-slate-400">
                                        <span>{{ $product->category?->name ?? 'Kategori' }}</span>
                                        <span class="rounded-full bg-emerald-50 px-2 py-1 text-emerald-600">Stok {{ $product->stock }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-black text-slate-950">{{ $product->name }}</h3>
                                        <p class="mt-2 text-sm text-slate-500">{{ Str::title($product->status) }} / {{ $product->weight ?? '0.0' }} kg</p>
                                    </div>
                                    <div class="flex items-center justify-between gap-4 pt-2">
                                        <p class="text-lg font-black text-slate-950">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                        <a href="#" class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Beli</a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full rounded-[2rem] border border-dashed border-slate-300 bg-white/90 p-12 text-center">
                                <p class="text-lg font-black text-slate-950">Produk habis</p>
                                <p class="mt-3 text-sm text-slate-500">Tidak ada produk tersedia saat ini. Silakan cek kembali nanti.</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section id="fitur" class="bg-slate-50 py-16">
                    <div class="mx-auto grid max-w-7xl gap-6 px-6 md:grid-cols-3">
                        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
                            <p class="text-4xl">🚚</p>
                            <h3 class="mt-6 text-xl font-black text-slate-950">Gratis Ongkir</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-600">Pengiriman gratis untuk pembelian di atas Rp500.000.</p>
                        </div>
                        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
                            <p class="text-4xl">↩️</p>
                            <h3 class="mt-6 text-xl font-black text-slate-950">Retur 30 Hari</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-600">Retur mudah dan cepat tanpa ribet.</p>
                        </div>
                        <div class="rounded-[2rem] bg-white p-8 shadow-sm">
                            <p class="text-4xl">💬</p>
                            <h3 class="mt-6 text-xl font-black text-slate-950">CS 24/7</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-600">Dukungan pelanggan siap membantu kapan saja.</p>
                        </div>
                    </div>
                </section>

                <section id="tentang" class="mx-auto max-w-7xl px-6 py-16">
                    <div class="grid gap-10 lg:grid-cols-[2fr_1fr] lg:items-center">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Tentang SHOESTEP</p>
                            <h2 class="mt-4 text-3xl font-black text-slate-950 sm:text-4xl">Solusi belanja sepatu yang cepat dan modern</h2>
                            <p class="mt-6 max-w-xl text-base leading-8 text-slate-600">Kami memberikan pengalaman belanja yang mudah, koleksi lengkap, dan dukungan pelanggan cepat agar setiap pembelian terasa memuaskan.</p>
                        </div>
                        <div class="rounded-[2rem] bg-slate-950 p-10 text-white shadow-xl">
                            <p class="text-sm uppercase tracking-[0.25em] text-slate-400">Toko Resmi</p>
                            <h3 class="mt-6 text-3xl font-black">Belanja nyaman dari rumah</h3>
                            <p class="mt-4 text-sm leading-7 text-slate-300">Nikmati koleksi terbaru, dukungan 24 jam, dan proses checkout yang mudah. Semua tersedia dalam satu tempat.</p>
                            <div class="mt-8 flex flex-wrap gap-4">
                                <span class="rounded-full border border-white/20 bg-white/5 px-4 py-2 text-xs uppercase tracking-[0.25em] text-white">Terpercaya</span>
                                <span class="rounded-full border border-white/20 bg-white/5 px-4 py-2 text-xs uppercase tracking-[0.25em] text-white">Aman</span>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
