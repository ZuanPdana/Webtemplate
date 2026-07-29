@extends('admin.layout')

@section('title', 'Administrasi User')

@section('content')
<div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi User</p>
            <h1 class="mt-3 text-3xl font-black text-slate-950">Daftar Pengguna</h1>
        </div>
        <a href="{{ route('admin.users.create') }}" class="rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Tambah User</a>
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}" class="admin-search-form mt-6 grid gap-3 sm:grid-cols-[1fr_auto]">
        <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari pengguna..." autocomplete="off" class="relative z-10 rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 outline-none focus:border-slate-300 focus:ring-2 focus:ring-emerald-200 focus:ring-offset-0 focus:text-slate-900 w-full" />
        <button type="submit" class="rounded-3xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-500">Cari</button>
    </form>

    <div class="mt-6">
        <div class="hidden md:block overflow-hidden rounded-xl border border-slate-200 shadow-sm">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-900">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Nama</th>
                        <th class="px-6 py-3 font-semibold">Email</th>
                        <th class="px-6 py-3 font-semibold">Username</th>
                        <th class="px-6 py-3 font-semibold">Status</th>
                        <th class="px-6 py-3 font-semibold">Bergabung</th>
                        <th class="px-6 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->username ?? '-' }}</td>
                            <td class="px-6 py-4 uppercase text-slate-600">{{ $user->status }}</td>
                            <td class="px-6 py-4">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-slate-500">Tidak ada pengguna ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-4 md:hidden">
            @forelse($users as $user)
                <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <p class="font-semibold text-slate-900">{{ $user->name }}</p>
                            <p class="text-xs text-slate-500">{{ $user->email }}</p>
                            <p class="mt-2 text-xs text-slate-400">Bergabung: {{ $user->created_at->format('d M Y') }} • <span class="uppercase text-slate-600">{{ $user->status }}</span></p>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">Edit</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-xl border border-slate-200 bg-white p-6 text-center text-sm text-slate-500">Tidak ada pengguna ditemukan.</div>
            @endforelse
        </div>
    </div>

    @if(method_exists($users, 'links'))
        <div class="mt-4">{{ $users->links() }}</div>
    @endif
</div>
@endsection
