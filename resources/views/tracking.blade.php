<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Pesanan | SHOESTEP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-6xl px-6 py-16">
        <a href="/" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900">← Kembali ke beranda</a>

        <div class="mt-8 grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Nomor Pesanan</p>
                        <h1 class="mt-2 text-3xl font-black">#SHOESTEP-1024</h1>
                    </div>
                    <span class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-700">Pesanan Diproses</span>
                </div>

                <div class="mt-8 grid gap-3 sm:grid-cols-4">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Pesanan Dibuat</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900">28 Jul 2026</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Pembayaran</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900">Lunas</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Pengemasan</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900">Sedang disiapkan</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Pengiriman</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900">Estimasi 1-2 hari</p>
                    </div>
                </div>

                <div class="mt-8">
                    <h2 class="text-lg font-black">Riwayat Status</h2>
                    <div class="mt-5 space-y-4">
                        <div class="flex gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                            <div class="mt-1 h-3 w-3 rounded-full bg-emerald-500"></div>
                            <div>
                                <p class="font-semibold text-emerald-700">Pesanan diterima</p>
                                <p class="text-sm text-emerald-600">Pembelian Anda telah berhasil masuk ke sistem.</p>
                            </div>
                        </div>
                        <div class="flex gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="mt-1 h-3 w-3 rounded-full bg-slate-400"></div>
                            <div>
                                <p class="font-semibold text-slate-700">Diproses penjual</p>
                                <p class="text-sm text-slate-500">Produk sedang disiapkan untuk pengemasan.</p>
                            </div>
                        </div>
                        <div class="flex gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="mt-1 h-3 w-3 rounded-full bg-slate-300"></div>
                            <div>
                                <p class="font-semibold text-slate-700">Sedang dikirim</p>
                                <p class="text-sm text-slate-500">Pesanan akan segera diteruskan ke kurir dan menuju alamat Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <h2 class="text-lg font-black">Detail Pesanan</h2>
                <div class="mt-6 space-y-4">
                    <div class="flex items-center justify-between rounded-2xl border border-slate-200 p-4">
                        <div>
                            <p class="font-semibold text-slate-900">Nike Air Max</p>
                            <p class="text-sm text-slate-500">Ukuran: 41 • Qty: 1</p>
                        </div>
                        <p class="font-semibold text-slate-900">Rp1.250.000</p>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl border border-slate-200 p-4">
                        <div>
                            <p class="font-semibold text-slate-900">Kaus Premium</p>
                            <p class="text-sm text-slate-500">Qty: 1</p>
                        </div>
                        <p class="font-semibold text-slate-900">Rp150.000</p>
                    </div>
                </div>

                <div class="mt-8 border-t border-slate-200 pt-5">
                    <div class="flex items-center justify-between text-sm text-slate-600">
                        <span>Subtotal</span>
                        <span>Rp1.400.000</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-slate-600 mt-2">
                        <span>Ongkir</span>
                        <span>Gratis</span>
                    </div>
                    <div class="flex items-center justify-between text-base font-black text-slate-900 mt-4">
                        <span>Total</span>
                        <span>Rp1.400.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
