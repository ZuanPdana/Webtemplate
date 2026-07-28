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
                        {{-- ── Inline Search Bar ── --}}
                        <div id="search-wrapper" class="relative">
                            <div id="search-bar"
                                style="display:flex;align-items:center;gap:8px;border-radius:9999px;border:1px solid #e2e8f0;background:#f8fafc;padding:8px 16px;width:220px;transition:width 0.3s ease,border-color 0.2s,background 0.2s,box-shadow 0.2s;overflow:hidden;"
                                onfocusin="this.style.borderColor='#94a3b8';this.style.background='#fff';this.style.boxShadow='0 4px 20px rgba(15,23,42,0.08)'"
                                onfocusout="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';this.style.boxShadow='none'">
                                <svg id="search-icon" xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;flex-shrink:0;color:#94a3b8;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                                </svg>
                                <input
                                    id="search-input"
                                    type="text"
                                    placeholder="Cari sepatu..."
                                    autocomplete="off"
                                    spellcheck="false"
                                    oninput="handleSearchInput(this.value)"
                                    onkeydown="handleSearchKeydown(event)"
                                    onfocus="onSearchFocus()"
                                    style="flex:1;min-width:0;background:transparent;font-size:13px;color:#0f172a;border:none;outline:none;"
                                />
                                <button
                                    id="search-clear"
                                    onclick="clearSearch()"
                                    tabindex="-1"
                                    style="display:none;align-items:center;justify-content:center;width:18px;height:18px;flex-shrink:0;border-radius:50%;background:#e2e8f0;color:#64748b;border:none;cursor:pointer;"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:10px;height:10px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
                                </button>
                                {{-- Spinner --}}
                                <svg id="search-spinner" style="display:none;width:16px;height:16px;flex-shrink:0;color:#94a3b8;animation:spin 1s linear infinite;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <style>@keyframes spin{to{transform:rotate(360deg)}}</style>
                                    <circle style="opacity:0.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path style="opacity:0.75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                                </svg>
                            </div>

                            {{-- Dropdown --}}
                            <div
                                id="search-dropdown"
                                class="absolute right-0 top-[calc(100%+10px)] w-80 overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-2xl shadow-slate-900/10 transition-all duration-200"
                                style="opacity:0;transform:translateY(-6px) scale(0.98);pointer-events:none;"
                            >
                                {{-- Typed query preview --}}
                                <div id="search-query-preview" class="hidden items-center gap-2 border-b border-slate-100 px-4 py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                                    <span class="text-xs text-slate-400">Mencari:</span>
                                    <span id="search-query-text" class="text-xs font-semibold text-slate-700 truncate"></span>
                                </div>

                                {{-- States --}}
                                <div id="search-state-hint" class="flex flex-col items-center gap-1.5 py-8 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                                    <p class="text-xs text-slate-400">Ketik untuk mencari produk</p>
                                </div>
                                <div id="search-state-empty" class="hidden flex-col items-center gap-1.5 py-8 text-center">
                                    <p class="text-2xl">🥿</p>
                                    <p class="text-xs font-semibold text-slate-600">Produk tidak ditemukan</p>
                                    <p class="mt-0.5 text-[11px] text-slate-400">Coba kata kunci lain</p>
                                </div>

                                {{-- Results list --}}
                                <ul id="search-list" class="hidden max-h-72 overflow-y-auto divide-y divide-slate-50" role="listbox"></ul>

                                {{-- Footer --}}
                                <div id="search-footer" class="hidden items-center justify-between border-t border-slate-100 px-4 py-2.5">
                                    <span id="search-count" class="text-[11px] font-medium text-slate-400"></span>
                                    <div class="flex items-center gap-1 text-[10px] text-slate-300">
                                        <kbd class="rounded border border-slate-200 bg-slate-50 px-1 py-0.5 font-mono">↑↓</kbd>
                                        <kbd class="rounded border border-slate-200 bg-slate-50 px-1 py-0.5 font-mono">↵</kbd>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ── End Inline Search Bar ── --}}

                        {{-- ── Navbar Action Icons ── --}}
                        <div style="display:flex;align-items:center;gap:4px;">

                            {{-- Wishlist --}}
                            <button id="nav-wishlist" onclick="openWishlistPanel()" title="Wishlist" style="position:relative;width:40px;height:40px;border-radius:50%;border:none;background:transparent;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#64748b;transition:background 0.15s;" onmouseenter="this.style.background='#f1f5f9'" onmouseleave="this.style.background='transparent'">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                                <span id="wishlist-badge" style="display:none;position:absolute;top:4px;right:4px;background:#ef4444;color:#fff;font-size:9px;font-weight:700;border-radius:50%;width:16px;height:16px;line-height:16px;text-align:center;">0</span>
                            </button>

                            {{-- Cart --}}
                            <button id="nav-cart" onclick="openCartPanel()" title="Keranjang" style="position:relative;width:40px;height:40px;border-radius:50%;border:none;background:transparent;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#64748b;transition:background 0.15s;" onmouseenter="this.style.background='#f1f5f9'" onmouseleave="this.style.background='transparent'">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                    <line x1="3" y1="6" x2="21" y2="6"/>
                                    <path d="M16 10a4 4 0 0 1-8 0"/>
                                </svg>
                                <span id="cart-badge" style="display:none;position:absolute;top:4px;right:4px;background:#0f172a;color:#fff;font-size:9px;font-weight:700;border-radius:50%;width:16px;height:16px;line-height:16px;text-align:center;">0</span>
                            </button>

                            {{-- Profile --}}
                            <div style="position:relative;">
                                <button id="nav-profile" onclick="toggleProfileMenu()" title="Profil" style="width:40px;height:40px;border-radius:50%;border:none;background:transparent;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#64748b;transition:background 0.15s;" onmouseenter="this.style.background='#f1f5f9'" onmouseleave="this.style.background='transparent'">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </button>
                                <div id="profile-menu" style="display:none;position:absolute;right:0;top:calc(100%+8px);background:#fff;border:1px solid #e2e8f0;border-radius:16px;box-shadow:0 8px 32px rgba(15,23,42,0.12);min-width:160px;overflow:hidden;z-index:100;">
                                    <a href="/profile" style="display:flex;align-items:center;gap:10px;padding:12px 16px;font-size:13px;font-weight:500;color:#0f172a;text-decoration:none;transition:background 0.15s;" onmouseenter="this.style.background='#f8fafc'" onmouseleave="this.style.background='transparent'">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;color:#94a3b8;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                        Profil Saya
                                    </a>
                                    <a href="#" style="display:flex;align-items:center;gap:10px;padding:12px 16px;font-size:13px;font-weight:500;color:#0f172a;text-decoration:none;transition:background 0.15s;" onmouseenter="this.style.background='#f8fafc'" onmouseleave="this.style.background='transparent'">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;color:#94a3b8;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                        Pengaturan
                                    </a>
                                    <div style="height:1px;background:#f1f5f9;margin:4px 0;"></div>
                                    <a href="#" style="display:flex;align-items:center;gap:10px;padding:12px 16px;font-size:13px;font-weight:500;color:#ef4444;text-decoration:none;transition:background 0.15s;" onmouseenter="this.style.background='#fef2f2'" onmouseleave="this.style.background='transparent'">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                        Keluar
                                    </a>
                                </div>
                            </div>

                        </div>
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
                            <div class="flex flex-wrap items-center gap-2 rounded-full bg-slate-100 p-2" id="category-filter">
                                <button onclick="filterByCategory('semua', this)" class="cat-btn rounded-full px-4 py-2 text-xs font-semibold" style="background:#0f172a;color:#fff;">Semua</button>
                                <button onclick="filterByCategory('sport', this)" class="cat-btn rounded-full px-4 py-2 text-xs font-semibold" style="background:transparent;color:#475569;">Sport</button>
                                <button onclick="filterByCategory('casual', this)" class="cat-btn rounded-full px-4 py-2 text-xs font-semibold" style="background:transparent;color:#475569;">Casual</button>
                                <button onclick="filterByCategory('formal', this)" class="cat-btn rounded-full px-4 py-2 text-xs font-semibold" style="background:transparent;color:#475569;">Formal</button>
                                <button onclick="filterByCategory('running', this)" class="cat-btn rounded-full px-4 py-2 text-xs font-semibold" style="background:transparent;color:#475569;">Running</button>
                            </div>
                            <div style="position:relative;">
                                <button id="sort-btn" onclick="toggleSortMenu()" style="display:flex;align-items:center;gap:6px;border-radius:9999px;border:1px solid #e2e8f0;background:#fff;padding:8px 16px;font-size:12px;font-weight:600;color:#475569;cursor:pointer;box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                                    <span id="sort-label">Urutkan: Terbaru</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:12px;height:12px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                                </button>
                                <div id="sort-menu" style="display:none;position:absolute;right:0;top:calc(100%+6px);background:#fff;border:1px solid #e2e8f0;border-radius:16px;box-shadow:0 8px 32px rgba(15,23,42,0.12);min-width:180px;overflow:hidden;z-index:50;">
                                    <button onclick="applySort('terbaru', this)" class="sort-opt" style="display:block;width:100%;text-align:left;padding:10px 16px;font-size:13px;color:#0f172a;background:none;border:none;cursor:pointer;font-weight:600;">Terbaru</button>
                                    <button onclick="applySort('terlaris', this)" class="sort-opt" style="display:block;width:100%;text-align:left;padding:10px 16px;font-size:13px;color:#0f172a;background:none;border:none;cursor:pointer;">Terlaris</button>
                                    <button onclick="applySort('termurah', this)" class="sort-opt" style="display:block;width:100%;text-align:left;padding:10px 16px;font-size:13px;color:#0f172a;background:none;border:none;cursor:pointer;">Harga Terendah</button>
                                    <button onclick="applySort('termahal', this)" class="sort-opt" style="display:block;width:100%;text-align:left;padding:10px 16px;font-size:13px;color:#0f172a;background:none;border:none;cursor:pointer;">Harga Tertinggi</button>
                                    <button onclick="applySort('nama', this)" class="sort-opt" style="display:block;width:100%;text-align:left;padding:10px 16px;font-size:13px;color:#0f172a;background:none;border:none;cursor:pointer;">Nama A–Z</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="product-grid" class="mt-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                        @forelse ($products as $product)
                    <article
                                class="product-card group overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
                                data-search="{{ strtolower($product->name . ' ' . ($product->category?->name ?? '') . ' ' . $product->description) }}"
                                data-category="{{ strtolower($product->category?->name ?? '') }}"
                                data-price="{{ $product->price }}"
                                data-name="{{ strtolower($product->name) }}"
                                data-featured="{{ $product->featured ? '1' : '0' }}"
                                data-popular="{{ $product->popular ? '1' : '0' }}"
                                data-id="{{ $product->id }}"
                            >
                                <div class="relative overflow-hidden bg-slate-100 p-6">
                                    @if ($product->featured)
                                        <span class="absolute left-4 top-4 rounded-full bg-slate-950 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.28em] text-white">Terlaris</span>
                                    @elseif ($product->popular)
                                        <span class="absolute left-4 top-4 rounded-full bg-amber-100 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.28em] text-amber-700">Populer</span>
                                    @endif
                                    <button
                                        class="wishlist-btn absolute right-4 top-4 inline-flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-sm transition hover:scale-110"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        onclick="toggleWishlist(this)"
                                        title="Tambah ke wishlist"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                    </button>
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
                                        <div class="flex items-center gap-2">
                                            <button
                                                class="rounded-full border border-slate-300 bg-white px-3 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50"
                                                onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})"
                                            >Keranjang</button>
                                            <button
                                                class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800"
                                                onclick="buyNow({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})"
                                            >Beli</button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full rounded-[2rem] border border-dashed border-slate-300 bg-white/90 p-12 text-center">
                                <p class="text-lg font-black text-slate-950">Produk habis</p>
                                <p class="mt-3 text-sm text-slate-500">Tidak ada produk tersedia saat ini. Silakan cek kembali nanti.</p>
                            </div>
                        @endforelse

                        {{-- Search empty state (hidden by default, shown by JS) --}}
                        <div id="search-no-results" style="display:none;" class="col-span-full flex flex-col items-center gap-4 rounded-[2rem] border border-dashed border-slate-300 bg-white/90 py-16 text-center">
                            <p class="text-4xl">🔍</p>
                            <p class="text-lg font-black text-slate-950">Tidak ada produk ditemukan</p>
                            <p class="text-sm text-slate-500">Coba kata kunci lain atau hapus pencarian</p>
                            <button onclick="clearSearch()" style="margin-top:4px;padding:8px 20px;border-radius:9999px;background:#0f172a;color:#fff;font-size:13px;font-weight:600;border:none;cursor:pointer;">Hapus Pencarian</button>
                        </div>
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

        <script>
        /* ── State ── */
        var srTimer   = null;
        var srResults = [];
        var srActive  = -1;
        var srOpen    = false;

        /* ── Focus / Blur ── */
        function onSearchFocus() {
            openDropdown();
        }

        document.addEventListener('click', function(e) {
            var wrapper = document.getElementById('search-wrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                closeDropdown();
            }
        });

        document.addEventListener('keydown', function(e) {
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                var inp = document.getElementById('search-input');
                if (inp) { inp.focus(); openDropdown(); }
            }
            if (e.key === 'Escape') closeDropdown();
        });

        /* ── Open / Close Dropdown ── */
        function openDropdown() {
            var dd = document.getElementById('search-dropdown');
            var bar = document.getElementById('search-bar');
            if (!dd) return;
            srOpen = true;
            dd.style.opacity = '1';
            dd.style.transform = 'translateY(0) scale(1)';
            dd.style.pointerEvents = 'auto';
            bar.style.width = '300px';
            bar.style.borderColor = '#94a3b8';
            bar.style.background = '#fff';
            bar.style.boxShadow = '0 4px 20px rgba(15,23,42,0.08)';
        }

        function closeDropdown() {
            var dd = document.getElementById('search-dropdown');
            var bar = document.getElementById('search-bar');
            if (!dd) return;
            srOpen = false;
            dd.style.opacity = '0';
            dd.style.transform = 'translateY(-6px) scale(0.98)';
            dd.style.pointerEvents = 'none';
            var inp = document.getElementById('search-input');
            if (!inp || inp.value === '') {
                bar.style.width = '220px';
                bar.style.borderColor = '#e2e8f0';
                bar.style.background = '#f8fafc';
                bar.style.boxShadow = 'none';
                filterProductGrid('');
            }
        }

        /* ── Input ── */
        function handleSearchInput(value) {
            /* Clear button */
            var clearBtn = document.getElementById('search-clear');
            clearBtn.style.display = value.length > 0 ? 'inline-flex' : 'none';

            /* Query preview badge */
            var preview = document.getElementById('search-query-preview');
            var qText   = document.getElementById('search-query-text');
            if (value.trim().length > 0) {
                preview.style.display = 'flex';
                qText.textContent = value.trim();
            } else {
                preview.style.display = 'none';
            }

            clearTimeout(srTimer);
            srActive = -1;

            /* Filter product grid in real-time */
            filterProductGrid(value.trim());

            if (value.trim().length < 2) {
                showDDState('hint');
                hideSrFooter();
                return;
            }

            showSpinner(true);
            var q = value.trim();
            srTimer = setTimeout(function() { fetchResults(q); }, 320);
        }

        function clearSearch() {
            var inp = document.getElementById('search-input');
            inp.value = '';
            inp.focus();
            handleSearchInput('');
            filterProductGrid('');
        }

        /* ── Fetch ── */
        function fetchResults(query) {
            fetch('/search?q=' + encodeURIComponent(query), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                showSpinner(false);
                srResults = data;
                srActive  = -1;
                if (data.length === 0) {
                    showDDState('empty');
                    hideSrFooter();
                } else {
                    renderResults(data);
                    showDDState('list');
                    showSrFooter(data.length);
                }
            })
            .catch(function() {
                showSpinner(false);
                showDDState('empty');
            });
        }

        /* ── Render ── */
        function renderResults(items) {
            var list = document.getElementById('search-list');
            list.innerHTML = '';
            items.forEach(function(item, idx) {
                var li = document.createElement('li');
                li.setAttribute('role', 'option');
                li.style.cssText = 'display:flex;align-items:center;gap:12px;padding:10px 16px;cursor:pointer;transition:background 0.15s;border-bottom:1px solid #f8fafc;';
                li.addEventListener('mouseenter', function() {
                    li.style.background = '#f8fafc';
                    srActive = idx;
                    updateActive(document.querySelectorAll('.sr-item'));
                });
                li.addEventListener('mouseleave', function() {
                    if (srActive !== idx) li.style.background = '';
                });
                li.classList.add('sr-item');

                var imgHtml = item.image
                    ? '<img src="' + escHtml(item.image) + '" alt="" style="width:100%;height:100%;object-fit:contain;"/>'
                    : '<svg viewBox="0 0 240 140" style="width:32px;height:32px;" fill="none"><ellipse cx="120" cy="128" rx="100" ry="9" fill="#e2e8f0"/><path d="M35 108 Q50 72 100 65 L168 58 Q200 58 205 76 Q210 92 192 100 Q172 108 120 112 Q72 115 35 108Z" fill="#cbd5e1"/><path d="M100 65 Q112 46 136 44 L180 46 Q198 49 202 65 L168 58Z" fill="#94a3b8"/></svg>';

                var badge = '';
                if (item.featured) {
                    badge = '<span style="display:inline-block;border-radius:9999px;background:#0f172a;padding:2px 6px;font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:#fff;margin-top:2px;">Terlaris</span>';
                } else if (item.popular) {
                    badge = '<span style="display:inline-block;border-radius:9999px;background:#fef3c7;padding:2px 6px;font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:#92400e;margin-top:2px;">Populer</span>';
                }

                li.innerHTML =
                    '<div style="width:44px;height:44px;flex-shrink:0;overflow:hidden;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;">' + imgHtml + '</div>' +
                    '<div style="flex:1;min-width:0;">' +
                        '<p style="font-size:13px;font-weight:600;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' + highlightQuery(item.name) + '</p>' +
                        '<p style="font-size:11px;color:#94a3b8;margin-top:1px;">' + escHtml(item.category) + '</p>' +
                    '</div>' +
                    '<div style="flex-shrink:0;text-align:right;">' +
                        '<p style="font-size:13px;font-weight:800;color:#0f172a;">' + escHtml(item.price) + '</p>' +
                        badge +
                    '</div>';

                li.addEventListener('click', function() { selectResult(idx); });
                list.appendChild(li);
            });
        }

        function selectResult(idx) {
            var item = srResults[idx];
            if (!item) return;
            closeDropdown();
            var s = document.getElementById('produk');
            if (s) s.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        /* ── Keyboard ── */
        function handleSearchKeydown(e) {
            if (e.key === 'Escape') { closeDropdown(); return; }
            var items = document.querySelectorAll('.sr-item');
            if (!items.length) return;
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                srActive = Math.min(srActive + 1, items.length - 1);
                updateActive(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                srActive = Math.max(srActive - 1, 0);
                updateActive(items);
            } else if (e.key === 'Enter' && srActive >= 0) {
                e.preventDefault();
                selectResult(srActive);
            }
        }

        function updateActive(items) {
            items.forEach(function(el, i) {
                el.style.background = (i === srActive) ? '#f1f5f9' : '';
                if (i === srActive) el.scrollIntoView({ block: 'nearest' });
            });
        }

        /* ── UI helpers ── */
        function showDDState(state) {
            var hint  = document.getElementById('search-state-hint');
            var empty = document.getElementById('search-state-empty');
            var list  = document.getElementById('search-list');
            hint.style.display  = 'none';
            empty.style.display = 'none';
            list.style.display  = 'none';
            if (state === 'hint')  hint.style.display  = 'flex';
            if (state === 'empty') empty.style.display = 'flex';
            if (state === 'list')  list.style.display  = 'block';
        }

        function showSrFooter(count) {
            var f = document.getElementById('search-footer');
            var c = document.getElementById('search-count');
            f.style.display = 'flex';
            c.textContent = count + ' produk ditemukan';
        }

        function hideSrFooter() {
            document.getElementById('search-footer').style.display = 'none';
        }

        function showSpinner(show) {
            var sp = document.getElementById('search-spinner');
            var ic = document.getElementById('search-icon');
            sp.style.display = show ? 'block' : 'none';
            ic.style.display = show ? 'none'  : 'block';
        }

        /* ── Filter product grid ── */
        function filterProductGrid(query) {
            var cards   = document.querySelectorAll('.product-card');
            var noRes   = document.getElementById('search-no-results');
            var section = document.getElementById('produk');
            var heading = section ? section.querySelector('h2') : null;

            if (!query || query.length < 1) {
                /* Reset — show all */
                cards.forEach(function(c) {
                    c.style.display = '';
                    c.style.opacity = '';
                    c.style.transform = '';
                });
                if (noRes) noRes.style.display = 'none';
                if (heading) heading.textContent = 'Produk unggulan untuk setiap gaya';
                return;
            }

            var q = query.toLowerCase();
            var matched = 0;

            cards.forEach(function(c) {
                var haystack = (c.getAttribute('data-search') || '').toLowerCase();
                var match = haystack.indexOf(q) !== -1;
                if (match) {
                    c.style.display = '';
                    /* Slight pop-in animation */
                    c.style.opacity = '0';
                    c.style.transform = 'scale(0.97)';
                    setTimeout(function() {
                        c.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                        c.style.opacity = '1';
                        c.style.transform = 'scale(1)';
                    }, 10);
                    matched++;
                } else {
                    c.style.display = 'none';
                }
            });

            /* No results state */
            if (noRes) noRes.style.display = (matched === 0) ? 'flex' : 'none';

            /* Update heading */
            if (heading) {
                heading.textContent = matched === 0
                    ? 'Tidak ada produk cocok'
                    : matched + ' produk ditemukan untuk \u201c' + query + '\u201d';
            }
        }

        function highlightQuery(text) {
            var q = (document.getElementById('search-input').value || '').trim();
            if (!q) return escHtml(text);
            var re = new RegExp('(' + q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
            return escHtml(text).replace(re, '<mark style="background:#fef08a;color:#713f12;border-radius:3px;padding:0 2px;">$1</mark>');
        }

        function escHtml(str) {
            var m = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' };
            return String(str).replace(/[&<>"']/g, function(c) { return m[c]; });
        }

        /* ════════════════════════════════════
           WISHLIST
        ════════════════════════════════════ */
        var wishlist = JSON.parse(localStorage.getItem('shoestep_wishlist') || '[]');

        function toggleWishlist(btn) {
            var id   = btn.getAttribute('data-id');
            var name = btn.getAttribute('data-name');
            var svg  = btn.querySelector('svg');
            var idx  = wishlist.findIndex(function(i) { return i.id === id; });
            if (idx === -1) {
                wishlist.push({ id: id, name: name });
                svg.style.fill   = '#ef4444';
                svg.style.stroke = '#ef4444';
                btn.style.color  = '#ef4444';
                showToast('❤️ Ditambahkan ke wishlist: ' + name);
            } else {
                wishlist.splice(idx, 1);
                svg.style.fill   = 'none';
                svg.style.stroke = 'currentColor';
                btn.style.color  = '';
                showToast('💔 Dihapus dari wishlist');
            }
            localStorage.setItem('shoestep_wishlist', JSON.stringify(wishlist));
            updateWishlistBadge();
            renderWishlistPanel();
        }

        function updateWishlistBadge() {
            var badge = document.getElementById('wishlist-badge');
            badge.textContent = wishlist.length;
            badge.style.display = wishlist.length > 0 ? 'block' : 'none';
        }

        function openWishlistPanel() {
            renderWishlistPanel();
            openPanel('wishlist-panel');
        }

        function renderWishlistPanel() {
            var list = document.getElementById('wishlist-list');
            if (!list) return;
            if (wishlist.length === 0) {
                list.innerHTML = '<div style="text-align:center;padding:40px 0;color:#94a3b8;"><p style="font-size:32px;">💔</p><p style="margin-top:8px;font-size:14px;">Wishlist masih kosong</p></div>';
                return;
            }
            list.innerHTML = wishlist.map(function(item) {
                return '<div style="display:flex;align-items:center;justify-content:space-between;padding:14px 0;border-bottom:1px solid #f1f5f9;">' +
                    '<div style="display:flex;align-items:center;gap:12px;">' +
                        '<div style="width:40px;height:40px;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;">' +
                            '<svg viewBox="0 0 24 24" style="width:20px;height:20px;color:#94a3b8;" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>' +
                        '</div>' +
                        '<span style="font-size:13px;font-weight:600;color:#0f172a;">' + escHtml(item.name) + '</span>' +
                    '</div>' +
                    '<button onclick="removeWishlistById(\'' + item.id + '\')" style="width:28px;height:28px;border-radius:50%;border:none;background:#fee2e2;color:#ef4444;cursor:pointer;font-size:14px;">✕</button>' +
                '</div>';
            }).join('');
        }

        function removeWishlistById(id) {
            wishlist = wishlist.filter(function(i) { return i.id !== id; });
            localStorage.setItem('shoestep_wishlist', JSON.stringify(wishlist));
            updateWishlistBadge();
            renderWishlistPanel();
            /* Reset heart icons */
            document.querySelectorAll('.wishlist-btn[data-id="' + id + '"]').forEach(function(btn) {
                var svg = btn.querySelector('svg');
                svg.style.fill = 'none'; svg.style.stroke = 'currentColor'; btn.style.color = '';
            });
        }

        /* ════════════════════════════════════
           CART
        ════════════════════════════════════ */
        var cart = JSON.parse(localStorage.getItem('shoestep_cart') || '[]');

        function addToCart(id, name, price) {
            var idx = cart.findIndex(function(i) { return i.id === id; });
            if (idx !== -1) {
                cart[idx].qty += 1;
            } else {
                cart.push({ id: id, name: name, price: price, qty: 1 });
            }
            localStorage.setItem('shoestep_cart', JSON.stringify(cart));
            updateCartBadge();
            showToast('🛍️ Ditambahkan: ' + name);
        }

        function buyNow(id, name, price) {
            var purchase = [{ id: id, name: name, price: price, qty: 1 }];
            localStorage.setItem('shoestep_checkout', JSON.stringify(purchase));
            window.location.href = '/checkout';
        }

        function updateCartBadge() {
            var badge = document.getElementById('cart-badge');
            var total = cart.reduce(function(s, i) { return s + i.qty; }, 0);
            badge.textContent = total;
            badge.style.display = total > 0 ? 'block' : 'none';
        }

        function openCartPanel() {
            renderCartPanel();
            openPanel('cart-panel');
        }

        function renderCartPanel() {
            var list  = document.getElementById('cart-list');
            var total = document.getElementById('cart-total');
            if (!list) return;
            if (cart.length === 0) {
                list.innerHTML = '<div style="text-align:center;padding:40px 0;color:#94a3b8;"><p style="font-size:32px;">🛍️</p><p style="margin-top:8px;font-size:14px;">Keranjang masih kosong</p></div>';
                if (total) total.style.display = 'none';
                return;
            }
            var sum = 0;
            list.innerHTML = cart.map(function(item) {
                sum += item.price * item.qty;
                return '<div style="display:flex;align-items:center;justify-content:space-between;padding:14px 0;border-bottom:1px solid #f1f5f9;">' +
                    '<div style="flex:1;min-width:0;">' +
                        '<p style="font-size:13px;font-weight:600;color:#0f172a;">' + escHtml(item.name) + '</p>' +
                        '<p style="font-size:12px;color:#64748b;margin-top:2px;">Rp' + Number(item.price).toLocaleString('id-ID') + '</p>' +
                    '</div>' +
                    '<div style="display:flex;align-items:center;gap:8px;">' +
                        '<button onclick="changeQty(' + item.id + ',-1)" style="width:26px;height:26px;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;font-size:16px;line-height:1;color:#475569;">−</button>' +
                        '<span style="font-size:13px;font-weight:700;min-width:20px;text-align:center;">' + item.qty + '</span>' +
                        '<button onclick="changeQty(' + item.id + ',1)" style="width:26px;height:26px;border-radius:50%;border:1px solid #e2e8f0;background:#fff;cursor:pointer;font-size:16px;line-height:1;color:#475569;">+</button>' +
                    '</div>' +
                '</div>';
            }).join('');
            if (total) {
                total.style.display = 'block';
                total.innerHTML = '<div style="display:flex;justify-content:space-between;font-size:14px;font-weight:700;color:#0f172a;margin-bottom:12px;"><span>Total</span><span>Rp' + sum.toLocaleString('id-ID') + '</span></div>' +
                    '<button style="width:100%;padding:12px;border-radius:9999px;background:#0f172a;color:#fff;font-size:14px;font-weight:600;border:none;cursor:pointer;" onclick="localStorage.setItem(\'shoestep_checkout\', JSON.stringify(cart)); window.location.href=\'/checkout\';">Checkout</button>';
            }
        }

        function changeQty(id, delta) {
            var idx = cart.findIndex(function(i) { return i.id === id; });
            if (idx === -1) return;
            cart[idx].qty += delta;
            if (cart[idx].qty <= 0) cart.splice(idx, 1);
            localStorage.setItem('shoestep_cart', JSON.stringify(cart));
            updateCartBadge();
            renderCartPanel();
        }

        /* ════════════════════════════════════
           PROFILE MENU
        ════════════════════════════════════ */
        function toggleProfileMenu() {
            var menu = document.getElementById('profile-menu');
            menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
        }

        document.addEventListener('click', function(e) {
            /* Close profile menu on outside click */
            var profileWrapper = document.getElementById('nav-profile') && document.getElementById('nav-profile').parentElement;
            var menu = document.getElementById('profile-menu');
            if (menu && profileWrapper && !profileWrapper.contains(e.target)) {
                menu.style.display = 'none';
            }
            /* Close sort menu on outside click */
            var sortBtn = document.getElementById('sort-btn');
            var sortMenu = document.getElementById('sort-menu');
            if (sortMenu && sortBtn && !sortBtn.contains(e.target) && !sortMenu.contains(e.target)) {
                sortMenu.style.display = 'none';
            }
            /* Close search dropdown on outside click */
            var wrapper = document.getElementById('search-wrapper');
            if (wrapper && !wrapper.contains(e.target)) closeDropdown();
        });

        /* ════════════════════════════════════
           CATEGORY FILTER
        ════════════════════════════════════ */
        var activeCategory = 'semua';

        function filterByCategory(cat, btn) {
            activeCategory = cat;
            /* Update active button styling */
            document.querySelectorAll('.cat-btn').forEach(function(b) {
                b.style.background = 'transparent';
                b.style.color      = '#475569';
            });
            btn.style.background = '#0f172a';
            btn.style.color      = '#fff';

            var cards = document.querySelectorAll('.product-card');
            var noRes = document.getElementById('search-no-results');
            var heading = document.querySelector('#produk h2');
            var matched = 0;

            cards.forEach(function(c) {
                var cardCat = (c.getAttribute('data-category') || '').trim().toLowerCase();
                var visible = (cat === 'semua' || cardCat === cat);
                if (visible) {
                    c.style.display = '';
                    c.style.opacity = '0'; c.style.transform = 'scale(0.97)';
                    setTimeout(function() {
                        c.style.transition = 'opacity 0.2s, transform 0.2s';
                        c.style.opacity = '1'; c.style.transform = 'scale(1)';
                    }, 10);
                    matched++;
                } else {
                    c.style.display = 'none';
                }
            });

            if (noRes) noRes.style.display = matched === 0 ? 'flex' : 'none';
            if (heading) {
                heading.textContent = cat === 'semua'
                    ? 'Produk unggulan untuk setiap gaya'
                    : matched + ' produk kategori ' + cat.charAt(0).toUpperCase() + cat.slice(1);
            }
        }

        /* ════════════════════════════════════
           SORT
        ════════════════════════════════════ */
        function toggleSortMenu() {
            var m = document.getElementById('sort-menu');
            m.style.display = m.style.display === 'none' ? 'block' : 'none';
        }

        function applySort(mode, btn) {
            var labels = { terbaru:'Terbaru', terlaris:'Terlaris', termurah:'Harga Terendah', termahal:'Harga Tertinggi', nama:'Nama A–Z' };
            document.getElementById('sort-label').textContent = 'Urutkan: ' + labels[mode];
            document.getElementById('sort-menu').style.display = 'none';

            /* Style active sort option */
            document.querySelectorAll('.sort-opt').forEach(function(b) { b.style.fontWeight = ''; });
            btn.style.fontWeight = '700';

            var grid = document.getElementById('product-grid');
            var cards = Array.from(document.querySelectorAll('.product-card'));

            cards.sort(function(a, b) {
                if (mode === 'termurah') return Number(a.getAttribute('data-price')) - Number(b.getAttribute('data-price'));
                if (mode === 'termahal') return Number(b.getAttribute('data-price')) - Number(a.getAttribute('data-price'));
                if (mode === 'terlaris') return Number(b.getAttribute('data-featured')) - Number(a.getAttribute('data-featured'));
                if (mode === 'nama')    return (a.getAttribute('data-name') || '').localeCompare(b.getAttribute('data-name') || '');
                return 0; /* terbaru — keep original order */
            });

            cards.forEach(function(c) { grid.appendChild(c); });
        }

        /* ════════════════════════════════════
           PANELS (Wishlist & Cart)
        ════════════════════════════════════ */
        function openPanel(id) {
            document.getElementById('panel-overlay').style.display = 'block';
            document.getElementById(id).style.transform = 'translateX(0)';
        }

        function closePanel(id) {
            document.getElementById(id).style.transform = 'translateX(100%)';
            /* Hide overlay if no panels open */
            setTimeout(function() {
                var any = ['wishlist-panel','cart-panel'].some(function(p) {
                    var el = document.getElementById(p);
                    return el && el.style.transform !== 'translateX(100%)';
                });
                if (!any) document.getElementById('panel-overlay').style.display = 'none';
            }, 300);
        }

        /* ════════════════════════════════════
           TOAST
        ════════════════════════════════════ */
        function showToast(msg) {
            var t = document.getElementById('toast');
            if (!t) return;
            t.textContent = msg;
            t.style.opacity = '1'; t.style.transform = 'translateY(0)';
            clearTimeout(t._timer);
            t._timer = setTimeout(function() { t.style.opacity = '0'; t.style.transform = 'translateY(10px)'; }, 2500);
        }

        /* Init badges on load */
        updateWishlistBadge();
        updateCartBadge();

        /* Sync wishlist heart icons on page load */
        document.querySelectorAll('.wishlist-btn').forEach(function(btn) {
            var id = btn.getAttribute('data-id');
            if (wishlist.findIndex(function(i) { return i.id === id; }) !== -1) {
                var svg = btn.querySelector('svg');
                svg.style.fill = '#ef4444'; svg.style.stroke = '#ef4444'; btn.style.color = '#ef4444';
            }
        });

        </script>

        {{-- ── Wishlist Panel ── --}}
        <div id="panel-overlay" onclick="closePanel('wishlist-panel');closePanel('cart-panel');" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,0.35);z-index:200;backdrop-filter:blur(2px);"></div>

        <div id="wishlist-panel" style="position:fixed;top:0;right:0;bottom:0;width:360px;max-width:95vw;background:#fff;z-index:201;box-shadow:-4px 0 40px rgba(15,23,42,0.12);transform:translateX(100%);transition:transform 0.3s ease;display:flex;flex-direction:column;">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid #f1f5f9;">
                <div style="display:flex;align-items:center;gap:8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;color:#ef4444;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    <h3 style="font-size:16px;font-weight:800;color:#0f172a;">Wishlist Saya</h3>
                </div>
                <button onclick="closePanel('wishlist-panel')" style="width:32px;height:32px;border-radius:50%;border:none;background:#f1f5f9;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <div id="wishlist-list" style="flex:1;overflow-y:auto;padding:4px 24px;"></div>
        </div>

        {{-- ── Cart Panel ── --}}
        <div id="cart-panel" style="position:fixed;top:0;right:0;bottom:0;width:380px;max-width:95vw;background:#fff;z-index:201;box-shadow:-4px 0 40px rgba(15,23,42,0.12);transform:translateX(100%);transition:transform 0.3s ease;display:flex;flex-direction:column;">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid #f1f5f9;">
                <div style="display:flex;align-items:center;gap:8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;color:#0f172a;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <h3 style="font-size:16px;font-weight:800;color:#0f172a;">Keranjang Belanja</h3>
                </div>
                <button onclick="closePanel('cart-panel')" style="width:32px;height:32px;border-radius:50%;border:none;background:#f1f5f9;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <div id="cart-list" style="flex:1;overflow-y:auto;padding:4px 24px;"></div>
            <div id="cart-total" style="display:none;padding:16px 24px;border-top:1px solid #f1f5f9;"></div>
        </div>

        {{-- ── Toast notification ── --}}
        <div id="toast" style="position:fixed;bottom:28px;left:50%;transform:translateX(-50%) translateY(10px);background:#0f172a;color:#fff;padding:10px 20px;border-radius:9999px;font-size:13px;font-weight:600;opacity:0;transition:opacity 0.3s,transform 0.3s;z-index:999;pointer-events:none;white-space:nowrap;box-shadow:0 4px 20px rgba(0,0,0,0.2);"></div>

    </body>
</html>
