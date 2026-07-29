@extends('admin.layout')

@section('title', 'Administrasi Promo')

@section('content')
<div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi Promo</p>
            <h1 class="mt-3 text-3xl font-black text-slate-950">Daftar Promo</h1>
        </div>
        <a href="{{ route('admin.promotions.create') }}" class="rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Tambah Promo</a>
    </div>

    <form method="GET" action="{{ route('admin.promotions.index') }}" class="admin-search-form mt-6 grid gap-3 sm:grid-cols-[1fr_auto]">
        <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari promo..." autocomplete="off" class="relative z-10 rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 outline-none focus:border-slate-300 focus:ring-2 focus:ring-emerald-200 focus:ring-offset-0 focus:text-slate-900 w-full" />
        <button type="submit" class="rounded-3xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-500">Cari</button>
    </form>

    <div class="mt-6">
        {{-- Table for md+ --}}
        <div class="hidden md:block overflow-hidden rounded-xl border border-slate-200 shadow-sm">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-900">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Kode</th>
                        <th class="px-6 py-3 font-semibold">Deskripsi</th>
                        <th class="px-6 py-3 font-semibold">Promo untuk</th>
                        <th class="px-6 py-3 font-semibold">Diskon</th>
                        <th class="px-6 py-3 font-semibold">Masa Berlaku</th>
                        <th class="px-6 py-3 font-semibold">Status</th>
                        <th class="px-6 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($promotions as $promo)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $promo->code }}</td>
                            <td class="px-6 py-4">{{ $promo->description ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $promo->product?->name ?? 'Semua produk' }}</td>
                            <td class="px-6 py-4">{{ $promo->discount_type === 'percentage' ? $promo->discount_value . '%' : 'Rp' . number_format($promo->discount_value, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $promo->expired_at ? $promo->expired_at->format('d M Y') : 'Tanpa batas' }}</td>
                            <td class="px-6 py-4 uppercase text-slate-600">{{ $promo->status }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.promotions.edit', $promo) }}" class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-sm text-slate-500">Tidak ada promo ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Card list for mobile --}}
        <div class="flex flex-col gap-4 md:hidden">
            @forelse($promotions as $promo)
                <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3">
                                <span class="inline-block rounded-md bg-slate-900 px-3 py-1 text-xs font-semibold text-white">{{ $promo->code }}</span>
                                <h3 class="text-sm font-semibold text-slate-900">{{ $promo->description ?? 'Promo tanpa deskripsi' }}</h3>
                            </div>
                            <p class="mt-2 text-sm text-slate-600">{{ $promo->product?->name ?? 'Semua produk' }} • {{ $promo->discount_type === 'percentage' ? $promo->discount_value . '%' : 'Rp' . number_format($promo->discount_value, 0, ',', '.') }}</p>
                            <p class="mt-1 text-xs text-slate-400">Berlaku: {{ $promo->expired_at ? $promo->expired_at->format('d M Y') : 'Tanpa batas' }} — Status: <span class="uppercase text-slate-600">{{ $promo->status }}</span></p>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.promotions.edit', $promo) }}" class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">Edit</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-xl border border-slate-200 bg-white p-6 text-center text-sm text-slate-500">Tidak ada promo ditemukan.</div>
            @endforelse
        </div>
    </div>

    @if(method_exists($promotions, 'links'))
        <div class="mt-4">{{ $promotions->links() }}</div>
    @endif
</div>
@endsection
