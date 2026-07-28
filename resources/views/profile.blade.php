<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SHOESTEP - Profil</title>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#F7F6F3] text-[#1D1B18] antialiased">
        <div class="min-h-screen">
            <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 backdrop-blur">
                <div class="mx-auto flex flex-wrap items-center justify-between gap-4 px-6 py-4 max-w-7xl">
                    <a href="/" class="text-lg font-black tracking-[0.3em] text-slate-950">SHOESTEP</a>
                    <nav class="hidden items-center gap-8 text-sm text-slate-600 md:flex">
                        <a href="/" class="transition hover:text-slate-950">Beranda</a>
                        <a href="/profile" class="font-semibold text-slate-950">Profil</a>
                        <a href="/" class="transition hover:text-slate-950">Produk</a>
                        <a href="/" class="transition hover:text-slate-950">Kontak</a>
                    </nav>
                    <a href="/" class="rounded-full bg-slate-950 px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-slate-200/20 transition hover:bg-slate-800">Belanja</a>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-6 py-10 lg:py-16">
                <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm lg:p-10">
                    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-2xl space-y-6">
                            <div class="inline-flex items-center rounded-full bg-slate-100 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-600">
                                Profil Saya
                            </div>
                            <div>
                                <h1 class="text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">Halo, Mia! Selamat datang kembali.</h1>
                                <p class="mt-4 text-lg leading-8 text-slate-600">
                                    Kelola akun, alamat, dan preferensi belanja Anda di satu tempat. Semua kebutuhan sepatu Anda kini lebih praktis dan personal.
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="/" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Kembali ke Toko</a>
                                <a href="#akun" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Edit Profil</a>
                            </div>
                        </div>

                        <div class="w-full max-w-sm rounded-[2rem] bg-slate-950 p-8 text-white shadow-xl">
                            <div class="flex items-center gap-4">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/10 text-2xl font-black">M</div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Member Premium</p>
                                    <h2 class="mt-1 text-2xl font-black">Mia Ardelia</h2>
                                </div>
                            </div>
                            <div class="mt-8 grid grid-cols-2 gap-4">
                                <div class="rounded-2xl bg-white/10 p-4 text-center">
                                    <p class="text-2xl font-black">12</p>
                                    <p class="mt-2 text-[10px] uppercase tracking-[0.25em] text-slate-400">Pesanan</p>
                                </div>
                                <div class="rounded-2xl bg-white/10 p-4 text-center">
                                    <p class="text-2xl font-black">4.9</p>
                                    <p class="mt-2 text-[10px] uppercase tracking-[0.25em] text-slate-400">Rating</p>
                                </div>
                            </div>
                            <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-4 text-sm text-slate-300">
                                Bonus member Anda siap digunakan untuk pembelian berikutnya.
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mt-8 grid gap-6 lg:grid-cols-[1.3fr_0.7fr]">
                    <div class="grid gap-6">
                        <div id="akun" class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Informasi Akun</p>
                                    <h3 class="mt-2 text-2xl font-black text-slate-950">Data pribadi</h3>
                                </div>
                                <a href="#" class="text-sm font-semibold text-slate-600 transition hover:text-slate-950">Ubah</a>
                            </div>

                            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Nama Lengkap</p>
                                    <p class="mt-2 font-semibold text-slate-900">Mia Ardelia</p>
                                </div>
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Email</p>
                                    <p class="mt-2 font-semibold text-slate-900">mia@example.com</p>
                                </div>
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Nomor HP</p>
                                    <p class="mt-2 font-semibold text-slate-900">+62 812 3456 7890</p>
                                </div>
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Tanggal Lahir</p>
                                    <p class="mt-2 font-semibold text-slate-900">14 Agustus 1998</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Alamat & Preferensi</p>
                                    <h3 class="mt-2 text-2xl font-black text-slate-950">Pengiriman dan gaya favorit</h3>
                                </div>
                            </div>

                            <div class="mt-6 grid gap-4 md:grid-cols-2">
                                <div class="rounded-2xl border border-slate-200 p-4">
                                    <p class="text-sm font-semibold text-slate-900">Alamat utama</p>
                                    <p class="mt-3 text-sm leading-7 text-slate-600">Jl. Merdeka No. 12, Bandung, Jawa Barat</p>
                                </div>
                                <div class="rounded-2xl border border-slate-200 p-4">
                                    <p class="text-sm font-semibold text-slate-900">Preferensi</p>
                                    <p class="mt-3 text-sm leading-7 text-slate-600">Casual, warna hitam, ukuran 38, pengiriman siang.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Riwayat Belanja</p>
                            <div class="mt-6 space-y-3">
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="font-semibold text-slate-900">Runner X</p>
                                        <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Selesai</span>
                                    </div>
                                    <p class="mt-2 text-sm text-slate-500">1 item • 20 Juli 2026</p>
                                </div>
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="font-semibold text-slate-900">Classic Court</p>
                                        <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">Dalam Proses</span>
                                    </div>
                                    <p class="mt-2 text-sm text-slate-500">2 item • 12 Juli 2026</p>
                                </div>
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="font-semibold text-slate-900">Air Max Lite</p>
                                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">Dikemas</span>
                                    </div>
                                    <p class="mt-2 text-sm text-slate-500">1 item • 2 Juli 2026</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-[2rem] border border-slate-200 bg-slate-950 p-8 text-white shadow-sm">
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Keuntungan Member</p>
                            <ul class="mt-6 space-y-3 text-sm text-slate-300">
                                <li class="flex gap-2"><span>•</span><span>Gratis ongkir untuk pembelian di atas Rp500.000</span></li>
                                <li class="flex gap-2"><span>•</span><span>Prioritas layanan pelanggan 24 jam</span></li>
                                <li class="flex gap-2"><span>•</span><span>Voucher khusus setiap bulan untuk member premium</span></li>
                            </ul>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
