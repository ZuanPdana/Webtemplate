<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrasi User</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F7F6F3] text-[#1D1B18] antialiased">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(15,23,42,0.08),transparent_35%),linear-gradient(135deg,_#f8fafc_0%,_#f7f6f3_100%)] px-3 py-4 sm:px-6 sm:py-8 lg:px-8 lg:py-10">
        <div class="mx-auto flex w-full max-w-6xl flex-col overflow-hidden rounded-[1.5rem] border border-slate-200/80 bg-white shadow-[0_25px_80px_rgba(15,23,42,0.08)] lg:flex-row lg:rounded-[2rem]">
            <div class="flex-1 bg-slate-950 p-6 text-white sm:p-8 lg:p-10 xl:p-12">
                <a href="{{ route('portal') }}" class="text-sm font-semibold uppercase tracking-[0.35em] text-slate-300">SHOESTEP</a>
                <h1 class="mt-6 text-2xl font-black sm:mt-8 sm:text-3xl lg:text-4xl">Buat akun baru</h1>
                <p class="mt-3 max-w-md text-sm leading-7 text-slate-300 sm:mt-4">Daftarkan diri Anda untuk menikmati fitur belanja personal, wishlist, dan promo eksklusif.</p>
                <div class="mt-6 rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur sm:mt-8 sm:p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-300">Kenapa daftar?</p>
                    <ul class="mt-3 space-y-2 text-sm text-slate-200 sm:space-y-3">
                        <li>• Pantau order dengan lebih mudah</li>
                        <li>• Simpan produk favorit</li>
                        <li>• Dapatkan penawaran khusus</li>
                    </ul>
                </div>
            </div>

            <div class="flex-1 p-5 sm:p-8 lg:p-10 xl:p-12">
                <div class="mx-auto w-full max-w-md">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Registrasi User</p>
                            <h2 class="mt-2 text-xl font-black text-slate-950 sm:text-2xl">Daftar sekarang</h2>
                        </div>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Login</a>
                    </div>

                    @if ($errors->any())
                        <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">
                            <ul class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.submit') }}" class="mt-6 space-y-4 sm:mt-8 sm:space-y-5">
                        @csrf
                        <div>
                            <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Nama</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                        </div>

                        <div>
                            <label for="username" class="mb-2 block text-sm font-semibold text-slate-700">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                            <input type="password" id="password" name="password" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                        </div>

                        <button type="submit" class="w-full rounded-2xl bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Daftar</button>
                    </form>

                    <div class="mt-6 text-center text-sm text-slate-500">
                        Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-slate-950">Masuk sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
