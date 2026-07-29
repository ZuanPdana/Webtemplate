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
                @if(session('success'))
                <div id="profile-toast" class="mb-6 rounded-2xl bg-emerald-50 px-6 py-4 text-sm font-semibold text-emerald-600 border border-emerald-200 flex justify-between items-center">
                    {{ session('success') }}
                    <button onclick="document.getElementById('profile-toast').style.display='none'">✕</button>
                </div>
                @endif
                <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm lg:p-10">
                    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                        <div class="max-w-2xl space-y-6">
                            <div class="inline-flex items-center rounded-full bg-slate-100 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-600">
                                Profil Saya
                            </div>
                            <div>
                                <h1 class="text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">Halo, {{ explode(' ', auth()->user()->name)[0] }}! Selamat datang kembali.</h1>
                                <p class="mt-4 text-lg leading-8 text-slate-600">
                                    Kelola akun, alamat, dan preferensi belanja Anda di satu tempat. Semua kebutuhan sepatu Anda kini lebih praktis dan personal.
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="/" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Kembali ke Toko</a>
                                <button onclick="document.getElementById('edit-modal').style.display='flex'" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Edit Profil</button>
                            </div>
                        </div>

                        <div class="w-full max-w-sm rounded-[2rem] bg-slate-950 p-8 text-white shadow-xl">
                            <div class="flex items-center gap-4">
                                <div class="relative h-16 w-16 overflow-hidden rounded-full bg-white/10 border border-white/20">
                                    @if(auth()->user()->avatar)
                                        <img src="{{ str_starts_with(auth()->user()->avatar, 'http') ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar) }}" alt="Avatar {{ auth()->user()->name }}" class="h-full w-full object-cover" />
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-2xl font-black text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Member Premium</p>
                                    <h2 class="mt-1 text-2xl font-black">{{ auth()->user()->name }}</h2>
                                </div>
                            </div>
                            <div class="mt-8 grid grid-cols-2 gap-4">
                                <div class="rounded-2xl bg-white/10 p-4 text-center">
                                    <p class="text-2xl font-black">{{ auth()->user()->orders()->count() }}</p>
                                    <p class="mt-2 text-[10px] uppercase tracking-[0.25em] text-slate-400">Pesanan</p>
                                </div>
                                <div class="rounded-2xl bg-white/10 p-4 text-center flex flex-col items-center justify-center overflow-hidden">
                                    <p class="text-lg font-black truncate w-full" title="{{ auth()->user()->username }}">{{ auth()->user()->username }}</p>
                                    <p class="mt-2 text-[10px] uppercase tracking-[0.25em] text-slate-400">Username</p>
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
                                    <p class="mt-2 font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                                </div>
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Email</p>
                                    <p class="mt-2 font-semibold text-slate-900">{{ auth()->user()->email }}</p>
                                </div>
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Nomor HP</p>
                                    <p class="mt-2 font-semibold text-slate-900">{{ auth()->user()->phone ?? 'Belum ditambahkan' }}</p>
                                </div>
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Username</p>
                                    <p class="mt-2 font-semibold text-slate-900">{{ auth()->user()->username }}</p>
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
                                    <p class="mt-3 text-sm leading-7 text-slate-600">{{ auth()->user()->addresses()->where('is_default', true)->first()->line_one ?? 'Belum ditambahkan.' }}</p>
                                </div>
                                <div class="rounded-2xl border border-slate-200 p-4">
                                    <p class="text-sm font-semibold text-slate-900">Bergabung Sejak</p>
                                    <p class="mt-3 text-sm leading-7 text-slate-600">{{ auth()->user()->created_at->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Riwayat Belanja</p>
                            <div class="mt-6 space-y-3">
                                @forelse(auth()->user()->orders()->latest()->take(3)->get() as $order)
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="font-semibold text-slate-900">Order #{{ $order->order_number }}</p>
                                        <span class="rounded-full bg-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-700">{{ ucfirst($order->status) }}</span>
                                    </div>
                                    <p class="mt-2 text-sm text-slate-500">Rp{{ number_format($order->total_amount, 0, ',', '.') }} • {{ $order->created_at->format('d M Y') }}</p>
                                </div>
                                @empty
                                <div class="rounded-2xl bg-slate-50 p-4 text-center text-sm text-slate-500">
                                    Belum ada riwayat pesanan.
                                </div>
                                @endforelse
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

        <div id="edit-modal" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,0.5);z-index:999;align-items:center;justify-content:center;backdrop-filter:blur(4px);">
            <div class="bg-white rounded-[2rem] p-8 w-full max-w-lg shadow-2xl relative" style="max-height:90vh;overflow-y:auto;">
                <button onclick="document.getElementById('edit-modal').style.display='none'" class="absolute top-6 right-6 text-slate-400 hover:text-slate-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
                <h2 class="text-2xl font-black text-slate-950 mb-6">Edit Profil</h2>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Username</label>
                        <input type="text" name="username" value="{{ auth()->user()->username }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor HP</label>
                        <input type="text" name="phone" value="{{ auth()->user()->phone }}" placeholder="Contoh: 08123456789" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Alamat Utama</label>
                        <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white">{{ auth()->user()->addresses()->where('is_default', true)->first()->line_one ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Foto Profil</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                        <p class="mt-2 text-xs text-slate-500">Unggah foto profil baru (JPEG, PNG, GIF, WEBP, max 2MB).</p>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="w-full rounded-xl bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
