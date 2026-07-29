<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SHOESTEP - Edit User</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F7F6F3] text-[#1D1B18] antialiased">
    @include('admin.partials.navbar')

    <main class="mx-auto max-w-4xl px-6 py-10">
        <div class="mb-6">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi User</p>
            <h1 class="mt-2 text-3xl font-black text-slate-950">Edit User <span class="text-slate-500">#{{ $user->id }}</span></h1>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/5">
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="grid gap-0 divide-y divide-slate-100 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
                    {{-- Left column --}}
                    <div class="space-y-5 p-6">
                        <div>
                            <label for="name" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Nama Lengkap *</label>
                            <input id="name" name="name" value="{{ old('name', $user->name) }}" required maxlength="150"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="username" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Username *</label>
                            <input id="username" name="username" value="{{ old('username', $user->username) }}" required maxlength="255"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="email" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Email *</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required maxlength="180"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="phone" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Phone</label>
                            <input id="phone" name="phone" value="{{ old('phone', $user->phone) }}" maxlength="30"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="status" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Status *</label>
                            <select id="status" name="status" required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                                @foreach (['active', 'inactive', 'blocked'] as $s)
                                    <option value="{{ $s }}" @selected(old('status', $user->status) === $s)>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Right column --}}
                    <div class="space-y-5 p-6">
                        <div>
                            <label for="avatar" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Avatar URL</label>
                            <input id="avatar" name="avatar" value="{{ old('avatar', $user->avatar) }}" maxlength="255"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>

                        <div>
                            <label for="bio" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Bio</label>
                            <textarea id="bio" name="bio" rows="4"
                                class="w-full resize-y rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">{{ old('bio', $user->bio) }}</textarea>
                        </div>

                        <div>
                            <label for="password" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Password Baru</label>
                            <input id="password" name="password" type="password" minlength="6"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                            <p class="mt-1 text-[11px] text-slate-400">Kosongkan jika tidak ingin mengubah password.</p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">Konfirmasi Password Baru</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" minlength="6"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:border-slate-400 focus:bg-white focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between border-t border-slate-100 bg-slate-50 px-6 py-4">
                    <a href="{{ route('admin.users') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-900">Batal</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-8 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                        Simpan Perubahan User
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
