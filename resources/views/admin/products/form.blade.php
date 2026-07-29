@extends('admin.layout')

@section('title', $mode === 'create' ? 'Tambah Produk' : 'Edit Produk')

@section('content')
<div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
    <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Produk</p>
            <h1 class="mt-3 text-3xl font-black text-slate-950">{{ $mode === 'create' ? 'Tambah Produk Baru' : 'Edit Produk' }}</h1>
        </div>
        <a href="{{ route('admin.products.index') }}" class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Kembali ke daftar</a>
    </div>

    <form method="POST" action="{{ $mode === 'create' ? route('admin.products.store') : route('admin.products.update', $product) }}" enctype="multipart/form-data" class="mt-8 space-y-6">
        @csrf
        @if($mode === 'edit') @method('PUT') @endif

        <div class="grid gap-6 lg:grid-cols-2">
            <div>
                <label class="block text-sm font-semibold text-slate-700">Nama Produk</label>
                <input name="name" type="text" value="{{ old('name', $product->name) }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Kategori</label>
                <select name="category_id" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300">
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="lg:col-span-2">
                <label class="block text-sm font-semibold text-slate-700">Deskripsi</label>
                <textarea name="description" rows="4" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300">{{ old('description', $product->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Harga</label>
                <input name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Stok</label>
                <input name="stock" type="number" value="{{ old('stock', $product->stock) }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Berat (kg)</label>
                <input name="weight" type="number" step="0.01" value="{{ old('weight', $product->weight) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300">
                    <option value="draft" {{ old('status', $product->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $product->status) === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="out_of_stock" {{ old('status', $product->status) === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    <option value="archived" {{ old('status', $product->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="flex items-center gap-3 rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-950" />
                    <span class="text-sm text-slate-700">Terlaris</span>
                </label>
                <label class="flex items-center gap-3 rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <input type="checkbox" name="popular" value="1" {{ old('popular', $product->popular) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-950" />
                    <span class="text-sm text-slate-700">Populer</span>
                </label>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Thumbnail</label>
                <input name="thumbnail" type="file" accept="image/*" {{ $mode === 'create' ? 'required' : '' }} class="mt-2 w-full text-sm text-slate-700" />
                @if($mode === 'edit' && $product->thumbnail)
                    <p class="mt-3 text-xs text-slate-500">Thumbnail saat ini:</p>
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail" class="mt-2 h-24 w-24 rounded-3xl object-cover" />
                @endif
            </div>
            <div class="lg:col-span-2">
                <label class="block text-sm font-semibold text-slate-700">Gambar Produk Tambahan</label>
                <input name="images[]" type="file" accept="image/*" multiple class="mt-2 w-full text-sm text-slate-700" />
                <p class="mt-2 text-xs text-slate-500">Unggah beberapa gambar untuk galeri produk.</p>
                @if($mode === 'edit' && $product->images->isNotEmpty())
                    <div class="mt-4 grid gap-3 sm:grid-cols-3">
                        @foreach($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->alt_text }}" class="h-24 w-full rounded-3xl object-cover" />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">{{ $mode === 'create' ? 'Simpan Produk' : 'Perbarui Produk' }}</button>
        </div>
    </form>
</div>
@endsection
