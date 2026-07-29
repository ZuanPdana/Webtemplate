<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SHOESTEP - Edit Produk</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F7F6F3] text-[#1D1B18] antialiased">
    @include('admin.partials.navbar')

    <main class="mx-auto max-w-4xl px-6 py-10">
        <div class="mb-6">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Produk</p>
            <h1 class="mt-2 text-3xl font-black text-slate-950">Edit Produk <span class="text-slate-500">#{{ $product->id }}</span></h1>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/5">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid gap-0 divide-y divide-slate-100 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                    {{-- Left column --}}
                    <div class="space-y-5 p-6">
                        <div>
                            <label for="name" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Nama Produk *</label>
                            <input id="name" name="name" value="{{ old('name', $product->name) }}" required maxlength="150"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="slug" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Slug *</label>
                            <input id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required maxlength="180"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="category_id" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Kategori *</label>
                            <select id="category_id" name="category_id" required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id) === (string) $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="price" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Harga (Rp) *</label>
                                <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price) }}" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                            </div>
                            <div>
                                <label for="stock" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Stok *</label>
                                <input id="stock" name="stock" type="number" min="0" step="1" value="{{ old('stock', $product->stock) }}" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="weight" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Berat (kg)</label>
                                <input id="weight" name="weight" type="number" min="0" step="0.01" value="{{ old('weight', $product->weight) }}"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                            </div>
                            <div>
                                <label for="status" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Status *</label>
                                <select id="status" name="status" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                                    @foreach (['draft', 'published', 'out_of_stock', 'archived'] as $s)
                                        <option value="{{ $s }}" @selected(old('status', $product->status) === $s)>{{ $s }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Right column --}}
                    <div class="space-y-5 p-6">
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Thumbnail</label>
                            @php
                                $thumb = $product->thumbnail;
                                $currentThumbSrc = $thumb
                                    ? (str_starts_with($thumb, 'http')
                                        ? $thumb
                                        : (\Storage::disk('public')->exists($thumb)
                                            ? \Storage::url($thumb)
                                            : asset($thumb)))
                                    : null;
                            @endphp
                            <div id="drop-zone"
                                 onclick="document.getElementById('thumbnail_file').click()"
                                 class="flex cursor-pointer flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed border-slate-300 bg-slate-50 px-4 py-4 text-sm text-slate-500 transition hover:border-slate-400 hover:bg-white">
                                <img id="thumb-preview"
                                     src="{{ $currentThumbSrc ?? '' }}"
                                     alt=""
                                     class="{{ $currentThumbSrc ? '' : 'hidden' }} h-24 w-24 rounded-xl object-cover mb-1">
                                <svg id="thumb-icon" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400 {{ $currentThumbSrc ? 'hidden' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                <span id="thumb-label">{{ $currentThumbSrc ? 'Klik untuk ganti gambar' : 'Klik untuk pilih gambar' }}</span>
                                <span class="text-[11px] text-slate-400">PNG, JPG, WEBP — maks 2MB</span>
                            </div>
                            <input id="thumbnail_file" name="thumbnail_file" type="file" accept="image/*" class="hidden"
                                   onchange="previewThumb(this)">
                            <p class="mt-2 text-[11px] text-slate-400">Atau isi path manual:</p>
                            <input id="thumbnail" name="thumbnail" value="{{ old('thumbnail', $product->thumbnail) }}" maxlength="255"
                                class="mt-1 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="description" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Deskripsi *</label>
                            <textarea id="description" name="description" required rows="7"
                                class="w-full resize-y rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="flex gap-6">
                            <label class="inline-flex cursor-pointer items-center gap-2 text-sm font-semibold text-slate-700">
                                <input type="checkbox" name="featured" value="1" @checked(old('featured', $product->featured))
                                    class="h-4 w-4 rounded border-slate-300 accent-slate-900">
                                Featured
                            </label>
                            <label class="inline-flex cursor-pointer items-center gap-2 text-sm font-semibold text-slate-700">
                                <input type="checkbox" name="popular" value="1" @checked(old('popular', $product->popular))
                                    class="h-4 w-4 rounded border-slate-300 accent-slate-900">
                                Popular
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between border-t border-slate-100 bg-slate-50 px-6 py-4">
                    <a href="{{ route('admin.products') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-900">Batal</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-8 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                        Simpan Perubahan Produk
                    </button>
                </div>
            </form>
        </div>
    </main>
    <script>
        function previewThumb(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = document.getElementById('thumb-preview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    document.getElementById('thumb-icon').classList.add('hidden');
                    document.getElementById('thumb-label').textContent = input.files[0].name;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>

