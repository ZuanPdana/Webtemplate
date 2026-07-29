<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SHOESTEP - Profil Admin</title>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#F7F6F3] text-[#1D1B18] antialiased">
        <div class="min-h-screen">
            @include('admin.partials.navbar')

            <main class="mx-auto max-w-2xl px-6 py-10">
                @if (session('status'))
                    <div class="mb-6 inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-semibold text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Akun Admin</p>
                <h1 class="mt-2 text-3xl font-black text-slate-950">Profil Saya</h1>

                {{-- Avatar preview --}}
                <div class="mt-6 flex flex-col items-center gap-4">
                    <div class="relative">
                        @php
                            $avatarSrc = $admin?->avatar
                                ? (str_starts_with($admin->avatar, 'http')
                                    ? $admin->avatar
                                    : (\Storage::disk('public')->exists($admin->avatar)
                                        ? \Storage::url($admin->avatar)
                                        : asset($admin->avatar)))
                                : null;
                        @endphp
                        <img id="avatar-preview"
                             src="{{ $avatarSrc ?? 'https://ui-avatars.com/api/?name=' . urlencode($admin?->name ?? $adminId) . '&background=1D1B18&color=fff&size=128' }}"
                             alt="Avatar"
                             class="h-28 w-28 rounded-full object-cover border-4 border-white shadow-xl shadow-slate-900/20">
                        <label for="avatar_file"
                               class="absolute bottom-1 right-1 flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-slate-900 text-white shadow hover:bg-slate-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15.232 5.232l3.536 3.536M9 11l6-6 4 4-6 6H9v-4z"/></svg>
                        </label>
                    </div>
                    <p class="text-sm font-semibold text-slate-900">{{ $admin?->name ?? $adminId }}</p>
                    <p class="text-xs text-slate-500">@{{ $adminId }}</p>
                </div>

                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="mt-8 space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Hidden file input triggered by the pencil button above --}}
                    <input type="file" id="avatar_file" name="avatar_file" accept="image/*" class="hidden"
                           onchange="previewAvatar(this)">

                    <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white px-8 py-7 shadow-xl shadow-slate-900/5 space-y-5">

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $admin?->name) }}" placeholder="Nama lengkap"
                                       class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-slate-400 focus:outline-none @error('name') border-rose-400 @enderror">
                                @error('name') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-2">Username</label>
                                <input type="text" name="username" value="{{ old('username', $admin?->username ?? $adminId) }}" placeholder="Username"
                                       class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-slate-400 focus:outline-none @error('username') border-rose-400 @enderror">
                                @error('username') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $admin?->email) }}" placeholder="email@contoh.com"
                                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-slate-400 focus:outline-none @error('email') border-rose-400 @enderror">
                            @error('email') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white px-8 py-7 shadow-xl shadow-slate-900/5 space-y-5">
                        <h2 class="text-sm font-bold text-slate-800">Ganti Password</h2>
                        <p class="text-xs text-slate-500">Kosongkan jika tidak ingin mengganti password.</p>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-2">Password Baru</label>
                            <input type="password" name="password" placeholder="••••••••"
                                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-slate-400 focus:outline-none @error('password') border-rose-400 @enderror">
                            @error('password') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••"
                                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm focus:border-slate-400 focus:outline-none">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a href="{{ route('admin.dashboard') }}"
                           class="rounded-full border border-slate-200 px-6 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Batal</a>
                        <button type="submit"
                                class="rounded-full bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700">Simpan Perubahan</button>
                    </div>
                </form>
            </main>
        </div>

        <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        </script>
    </body>
</html>
