<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin Dashboard') - SHOESTEP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <div class="min-h-screen">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex items-center justify-between gap-4 px-4 py-4 sm:px-6 max-w-7xl">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-lg font-black tracking-[0.3em] text-slate-950">SHOESTEP Admin</a>
                </div>

                <nav class="flex items-center gap-6 text-sm text-slate-600 flex-wrap overflow-x-auto">
                    <a href="{{ route('admin.dashboard') }}" class="rounded-2xl px-3 py-2 transition hover:bg-slate-50 {{ request()->routeIs('admin.dashboard') ? 'font-semibold text-slate-950' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="rounded-2xl px-3 py-2 transition hover:bg-slate-50 {{ request()->routeIs('admin.products.*') ? 'font-semibold text-slate-950' : '' }}">Produk</a>
                    <a href="{{ route('admin.users.index') }}" class="rounded-2xl px-3 py-2 transition hover:bg-slate-50 {{ request()->routeIs('admin.users.*') ? 'font-semibold text-slate-950' : '' }}">User</a>
                    <a href="{{ route('admin.promotions.index') }}" class="rounded-2xl px-3 py-2 transition hover:bg-slate-50 {{ request()->routeIs('admin.promotions.*') ? 'font-semibold text-slate-950' : '' }}">Promo</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.logout') }}" class="rounded-full border border-red-100 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100">Keluar</a>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[260px_1fr]">
                <aside class="hidden lg:block rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="space-y-4">
                        <div class="rounded-3xl bg-slate-950 p-5 text-white">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Admin</p>
                            <h2 class="mt-3 text-xl font-black">{{ session('admin_id') ?? 'Admin' }}</h2>
                        </div>
                    </div>
                </aside>

                <section class="space-y-6">
                    @if(session('success'))
                        <div class="rounded-[2rem] border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm font-semibold text-emerald-700 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </section>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.admin-search-form button[type="submit"]').forEach(function (btn) {
                btn.addEventListener('click', function (evt) {
                    var form = btn.closest('form');
                    if (!form) return;
                    evt.preventDefault();
                    form.submit();
                });
            });

            document.querySelectorAll('.admin-search-form input[name="search"]').forEach(function (input) {
                input.addEventListener('keydown', function (evt) {
                    if (evt.key === 'Enter') {
                        evt.preventDefault();
                        var form = input.closest('form');
                        if (form) {
                            form.submit();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
