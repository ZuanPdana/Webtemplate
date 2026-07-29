<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SHOESTEP - Kelola Promo</title>
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
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Promo</p>
                        <h1 class="mt-2 text-3xl font-black text-slate-950">Kode Promo & Diskon</h1>
                    </div>
                    <a href="{{ route('admin.coupons.create') }}"
                       class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                        Tambah Promo
                    </a>
                </div>

                <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/5">
                    @if ($coupons->isEmpty())
                        <p class="px-6 py-10 text-sm text-slate-500">Belum ada promo. <a href="{{ route('admin.coupons.create') }}" class="font-semibold text-slate-900 underline">Buat sekarang</a>.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm">
                                <thead class="bg-slate-50 text-[11px] uppercase tracking-[0.2em] text-slate-500">
                                    <tr>
                                        <th class="px-4 py-3">Kode</th>
                                        <th class="px-4 py-3">Deskripsi</th>
                                        <th class="px-4 py-3">Tipe</th>
                                        <th class="px-4 py-3">Nilai</th>
                                        <th class="px-4 py-3">Min. Order</th>
                                        <th class="px-4 py-3">Pakai / Limit</th>
                                        <th class="px-4 py-3">Kadaluarsa</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach ($coupons as $coupon)
                                        <tr class="hover:bg-slate-50/60">
                                            <td class="px-4 py-3 font-mono font-semibold text-slate-900">{{ $coupon->code }}</td>
                                            <td class="px-4 py-3 text-slate-600 max-w-[180px] truncate">{{ $coupon->description ?? '—' }}</td>
                                            <td class="px-4 py-3 text-slate-600">{{ $coupon->discount_type === 'percentage' ? 'Persentase' : 'Nominal' }}</td>
                                            <td class="px-4 py-3 font-semibold text-slate-900">
                                                @if ($coupon->discount_type === 'percentage')
                                                    {{ $coupon->discount_value }}%
                                                @else
                                                    Rp{{ number_format((float) $coupon->discount_value, 0, ',', '.') }}
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-slate-600">Rp{{ number_format((float) $coupon->minimum_order, 0, ',', '.') }}</td>
                                            <td class="px-4 py-3 text-slate-600">{{ $coupon->used_count }} / {{ $coupon->usage_limit ?? '∞' }}</td>
                                            <td class="px-4 py-3 text-slate-600">{{ $coupon->expired_at ? $coupon->expired_at->format('d M Y') : '—' }}</td>
                                            <td class="px-4 py-3">
                                                <span @class([
                                                    'inline-flex rounded-full px-2.5 py-1 text-xs font-semibold',
                                                    'bg-emerald-100 text-emerald-700' => $coupon->status === 'active',
                                                    'bg-amber-100 text-amber-700' => $coupon->status === 'inactive',
                                                    'bg-rose-100 text-rose-700' => $coupon->status === 'expired',
                                                ])>{{ $coupon->status }}</span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <a href="{{ route('admin.coupons.edit', $coupon) }}"
                                                   class="inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-700">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </body>
</html>
