<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login SHOESTEP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F7F6F3] text-[#1D1B18] antialiased">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(15,23,42,0.12),transparent_35%),linear-gradient(135deg,_#f8fafc_0%,_#f7f6f3_100%)] px-3 py-4 sm:px-6 sm:py-8 lg:px-8 lg:py-10">
        <div class="mx-auto flex min-h-[calc(100vh-2rem)] w-full max-w-7xl flex-col overflow-hidden rounded-[1.75rem] border border-slate-200/80 bg-white shadow-[0_30px_90px_rgba(15,23,42,0.1)] lg:flex-row lg:rounded-[2rem]">
            <div class="flex w-full flex-col justify-between bg-slate-950 p-6 text-white sm:p-8 lg:w-[46%] lg:p-10 xl:p-12">
                <div>
                    <a href="{{ route('portal') }}" class="text-sm font-semibold uppercase tracking-[0.35em] text-slate-300">SHOESTEP</a>
                    <h1 class="mt-6 text-3xl font-black leading-tight sm:text-4xl lg:text-5xl">Masuk ke akun Anda</h1>
                    <p class="mt-4 max-w-md text-sm leading-7 text-slate-300 sm:text-base">Nikmati pengalaman belanja yang cepat, aman, dan personal dari mana saja.</p>
                </div>

                <div class="mt-8 rounded-[1.5rem] border border-white/10 bg-white/10 p-5 backdrop-blur sm:p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-300">Pilih akses</p>
                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <a href="{{ route('login') }}" class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-sm font-semibold text-white transition hover:bg-white/20">Login User</a>
                        <a href="#admin-login" class="block w-full rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-white/20">Login Admin</a>
                    </div>
                </div>
            </div>

            <div class="flex w-full items-center justify-center p-5 sm:p-8 lg:w-[54%] lg:p-10 xl:p-12">
                <div class="w-full max-w-md">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Login User</p>
                            <h2 class="mt-2 text-2xl font-black text-slate-950 sm:text-3xl">Selamat datang kembali</h2>
                        </div>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Daftar</a>
                    </div>

                    @if ($errors->any())
                        <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">
                            {{ $errors->first('login') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.submit') }}" class="mt-6 space-y-4 sm:mt-8 sm:space-y-5">
                        @csrf
                        <div>
                            <label for="login" class="mb-2 block text-sm font-semibold text-slate-700">Username atau Email</label>
                            <input type="text" id="login" name="login" value="{{ old('login') }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                            <input type="password" id="password" name="password" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white" />
                        </div>

                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-slate-950 focus:ring-slate-400" />
                            Ingat saya
                        </label>

                        <button type="submit" class="w-full rounded-2xl bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Masuk</button>
                    </form>

                    <div class="mt-8 rounded-[1.5rem] border border-amber-200 bg-amber-50/80 p-5 shadow-sm">
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-amber-700">Catatan</p>
                        <p class="mt-2 text-sm leading-6 text-slate-700">Gunakan username/email yang sama untuk login user, atau username admin untuk masuk ke panel administrator.</p>
                    </div>

                    <div class="mt-6 text-center text-sm text-slate-500">
                        Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-slate-950">Daftar sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
