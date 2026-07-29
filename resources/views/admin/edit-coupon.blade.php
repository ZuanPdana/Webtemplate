<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SHOESTEP - Edit Promo</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F7F6F3] text-[#1D1B18] antialiased">
    @include('admin.partials.navbar')

    <main class="mx-auto max-w-3xl px-6 py-10">
        <div class="mb-6">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Promo</p>
            <h1 class="mt-2 text-3xl font-black text-slate-950">Edit Promo: <span class="font-mono text-slate-600">{{ $coupon->code }}</span></h1>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/5">
            <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}">
                @csrf
                @method('PUT')

                <div class="space-y-5 p-6">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="code" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Kode Kupon *</label>
                            <input id="code" name="code" value="{{ old('code', $coupon->code) }}" required maxlength="50"
                                oninput="this.value=this.value.toUpperCase()"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-mono font-semibold tracking-widest focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="status" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Status *</label>
                            <select id="status" name="status" required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                                @foreach (['active', 'inactive', 'expired'] as $s)
                                    <option value="{{ $s }}" @selected(old('status', $coupon->status) === $s)>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="discount_type" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Tipe Diskon *</label>
                            <select id="discount_type" name="discount_type" required onchange="updateDiscountLabel()"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                                <option value="percentage" @selected(old('discount_type', $coupon->discount_type) === 'percentage')>Persentase (%)</option>
                                <option value="fixed" @selected(old('discount_type', $coupon->discount_type) === 'fixed')>Nominal Tetap (Rp)</option>
                            </select>
                        </div>

                        <div>
                            <label for="discount_value" id="discount_value_label" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Nilai Diskon *</label>
                            <input id="discount_value" name="discount_value" type="number" min="0" step="0.01" value="{{ old('discount_value', $coupon->discount_value) }}" required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="minimum_order" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Minimum Order (Rp) *</label>
                            <input id="minimum_order" name="minimum_order" type="number" min="0" step="0.01" value="{{ old('minimum_order', $coupon->minimum_order) }}" required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="usage_limit" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Batas Penggunaan</label>
                            <input id="usage_limit" name="usage_limit" type="number" min="1" step="1" value="{{ old('usage_limit', $coupon->usage_limit) }}"
                                placeholder="Kosongkan = tidak terbatas"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                            <p class="mt-1 text-[11px] text-slate-400">Terpakai: {{ $coupon->used_count }} kali</p>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="expired_at" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Tanggal Kadaluarsa</label>
                            <input id="expired_at" name="expired_at" type="datetime-local"
                                value="{{ old('expired_at', $coupon->expired_at?->format('Y-m-d\TH:i')) }}"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="description" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Deskripsi Promo</label>
                            <textarea id="description" name="description" rows="3"
                                class="w-full resize-y rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">{{ old('description', $coupon->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between border-t border-slate-100 bg-slate-50 px-6 py-4">
                    <a href="{{ route('admin.coupons') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-900">Batal</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-8 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                        Simpan Perubahan Promo
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function updateDiscountLabel() {
            var type = document.getElementById('discount_type').value;
            document.getElementById('discount_value_label').textContent =
                type === 'percentage' ? 'Nilai Diskon (%) *' : 'Nilai Diskon (Rp) *';
        }
        updateDiscountLabel();
    </script>
</body>
</html>
