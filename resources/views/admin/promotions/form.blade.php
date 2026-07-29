@extends('admin.layout')

@section('title', $mode === 'create' ? 'Tambah Promo' : 'Edit Promo')

@section('content')
<div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
    <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Promo</p>
            <h1 class="mt-3 text-3xl font-black text-slate-950">{{ $mode === 'create' ? 'Tambah Promo Baru' : 'Edit Promo' }}</h1>
        </div>
        <a href="{{ route('admin.promotions.index') }}" class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Kembali ke daftar</a>
    </div>

    <form method="POST" action="{{ $mode === 'create' ? route('admin.promotions.store') : route('admin.promotions.update', $promo) }}" class="mt-8 space-y-6">
        @csrf
        @if($mode === 'edit') @method('PUT') @endif

        <div class="grid gap-6 lg:grid-cols-2">
            <div>
                <label class="block text-sm font-semibold text-slate-700">Kode Promo</label>
                <input name="code" type="text" value="{{ old('code', $promo->code) }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300">
                    <option value="active" {{ old('status', $promo->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $promo->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="expired" {{ old('status', $promo->status) === 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>
            <div class="lg:col-span-2">
                <label class="block text-sm font-semibold text-slate-700">Deskripsi</label>
                <textarea name="description" rows="3" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300">{{ old('description', $promo->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Terapkan ke Produk</label>
                <select name="product_id" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300">
                    <option value="">Semua produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id', $promo->product_id) == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Tipe Diskon</label>
                <select name="discount_type" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300">
                    <option value="percentage" {{ old('discount_type', $promo->discount_type) === 'percentage' ? 'selected' : '' }}>Persentase</option>
                    <option value="fixed" {{ old('discount_type', $promo->discount_type) === 'fixed' ? 'selected' : '' }}>Nominal</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Nilai Diskon</label>
                <input name="discount_value" type="number" step="0.01" value="{{ old('discount_value', $promo->discount_value) }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Minimum Order</label>
                <input name="minimum_order" type="number" step="0.01" value="{{ old('minimum_order', $promo->minimum_order ?? 0) }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Limit Pemakaian</label>
                <input name="usage_limit" type="number" value="{{ old('usage_limit', $promo->usage_limit) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Tanggal Kedaluwarsa</label>
                <input name="expired_at" type="date" value="{{ old('expired_at', $promo->expired_at?->format('Y-m-d')) }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">{{ $mode === 'create' ? 'Simpan Promo' : 'Perbarui Promo' }}</button>
        </div>
    </form>
</div>
@endsection
