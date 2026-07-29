@extends('admin.layout')

@section('title', 'Detail Produk')

@section('content')
<div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Detail Produk</p>
            <h1 class="mt-3 text-3xl font-black text-slate-950">{{ $product->name }}</h1>
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600">{{ $product->description }}</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.products.index') }}" class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-50">Kembali</a>
            <a href="{{ route('admin.products.edit', $product) }}" class="rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Edit</a>
        </div>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-[1.2fr_auto]">
        <div class="space-y-6">
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Nama</p>
                        <p class="mt-2 text-lg font-semibold text-slate-950">{{ $product->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Slug</p>
                        <p class="mt-2 text-lg text-slate-700">{{ $product->slug }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Kategori</p>
                        <p class="mt-2 text-lg text-slate-700">{{ $product->category?->name ?? 'Tidak ada kategori' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Status</p>
                        <p class="mt-2 text-lg text-slate-700">{{ str_replace('_', ' ', $product->status) }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Harga</p>
                        <p class="mt-2 text-lg font-semibold text-slate-950">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Stok</p>
                        <p class="mt-2 text-lg text-slate-950">{{ $product->stock }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Berat</p>
                        <p class="mt-2 text-lg text-slate-950">{{ $product->weight ?? '0' }} kg</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Jumlah Favorit</p>
                        <p class="mt-2 text-lg text-slate-950">{{ $product->favorites_count ?? 0 }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Terjual</p>
                        <p class="mt-2 text-lg text-slate-950">{{ $product->purchases_count ?? 0 }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Ditambahkan</p>
                        <p class="mt-2 text-lg text-slate-950">{{ $product->created_at?->format('d M Y H:i') ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Gambar Utama</p>
                <div class="mt-4 overflow-hidden rounded-3xl bg-slate-100">
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-full object-cover" />
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Galeri Gambar</p>
                <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($product->images as $image)
                        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-slate-50">
                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->alt_text }}" class="h-48 w-full object-cover" />
                            <div class="border-t border-slate-200 bg-white p-3 text-sm text-slate-600">
                                <p class="font-semibold text-slate-900">Urutan {{ $image->sort_order }}</p>
                                <p>{{ $image->alt_text }}</p>
                                <p class="mt-1 text-xs uppercase tracking-[0.24em] text-slate-500">Primary: {{ $image->is_primary ? 'Ya' : 'Tidak' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-500">Tidak ada gambar tambahan.</div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Ulasan Pelanggan</p>
                <div class="mt-4 space-y-4">
                    @forelse($product->reviews as $review)
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $review->title }}</p>
                                    <p class="text-xs text-slate-500">{{ $review->user?->name ?? 'Pelanggan terhapus' }} · {{ $review->rating }} / 5</p>
                                </div>
                                <p class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase text-emerald-700">{{ $review->status }}</p>
                            </div>
                            <p class="mt-3 text-sm leading-relaxed text-slate-700">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-500">Belum ada ulasan untuk produk ini.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Atribut Produk</p>
                <div class="mt-4 space-y-3 text-sm text-slate-700">
                    <div class="flex items-center justify-between gap-3 rounded-3xl bg-white px-4 py-3">
                        <span>Featured</span>
                        <span>{{ $product->featured ? 'Ya' : 'Tidak' }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 rounded-3xl bg-white px-4 py-3">
                        <span>Popular</span>
                        <span>{{ $product->popular ? 'Ya' : 'Tidak' }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 rounded-3xl bg-white px-4 py-3">
                        <span>ID Produk</span>
                        <span>{{ $product->id }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 rounded-3xl bg-white px-4 py-3">
                        <span>Jumlah Gambar</span>
                        <span>{{ $product->images->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 rounded-3xl bg-white px-4 py-3">
                        <span>Jumlah Ulasan</span>
                        <span>{{ $product->reviews->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 rounded-3xl bg-white px-4 py-3">
                        <span>Dibuat pada</span>
                        <span>{{ $product->created_at?->format('d M Y') ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 rounded-3xl bg-white px-4 py-3">
                        <span>Terakhir diubah</span>
                        <span>{{ $product->updated_at?->format('d M Y') ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Informasi Lain</p>
                <div class="mt-4 space-y-3 text-sm text-slate-700">
                    <div class="flex items-center justify-between gap-3 rounded-3xl bg-slate-50 px-4 py-3">
                        <span>Nama Pengguna</span>
                        <span>{{ $product->created_at?->format('H:i') ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 rounded-3xl bg-slate-50 px-4 py-3">
                        <span>Slug Produk</span>
                        <span>{{ $product->slug }}</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
