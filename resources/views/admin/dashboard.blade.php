@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Selamat datang kembali</p>
                <h1 class="mt-3 text-3xl font-black text-slate-950">Dashboard Admin</h1>
                <p class="mt-2 text-sm leading-7 text-slate-600">Kelola produk, pengguna, dan promo dengan tampilan serupa halaman user.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-500">Tambah Produk</a>
                <a href="{{ route('admin.promotions.create') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Tambah Promo</a>
            </div>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-3">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Produk</p>
            <p class="mt-5 text-4xl font-black text-slate-950">{{ number_format($totalProducts) }}</p>
            <p class="mt-2 text-sm text-slate-600">Total produk yang terdaftar di toko.</p>
        </div>
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Pengguna</p>
            <p class="mt-5 text-4xl font-black text-slate-950">{{ number_format($totalUsers) }}</p>
            <p class="mt-2 text-sm text-slate-600">Total akun terdaftar.</p>
        </div>
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Promo</p>
            <p class="mt-5 text-4xl font-black text-slate-950">{{ number_format($totalPromotions) }}</p>
            <p class="mt-2 text-sm text-slate-600">Kode promo dan kupon aktif/tersimpan.</p>
        </div>
    </div>
</div>
@endsection
