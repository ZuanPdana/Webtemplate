@extends('admin.layout')

@section('title', $mode === 'create' ? 'Tambah User' : 'Edit User')

@section('content')
<div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
    <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi User</p>
            <h1 class="mt-3 text-3xl font-black text-slate-950">{{ $mode === 'create' ? 'Tambah Pengguna' : 'Edit Pengguna' }}</h1>
        </div>
        <a href="{{ route('admin.users.index') }}" class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Kembali ke daftar</a>
    </div>

    <form method="POST" action="{{ $mode === 'create' ? route('admin.users.store') : route('admin.users.update', $user) }}" class="mt-8 space-y-6">
        @csrf
        @if($mode === 'edit') @method('PUT') @endif

        <div class="grid gap-6 lg:grid-cols-2">
            <div>
                <label class="block text-sm font-semibold text-slate-700">Nama</label>
                <input name="name" type="text" value="{{ old('name', $user->name) }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Username</label>
                <input name="username" type="text" value="{{ old('username', $user->username) }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Email</label>
                <input name="email" type="email" value="{{ old('email', $user->email) }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300">
                    <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="blocked" {{ old('status', $user->status) === 'blocked' ? 'selected' : '' }}>Blocked</option>
                </select>
            </div>
            <div class="lg:col-span-2">
                <label class="block text-sm font-semibold text-slate-700">Password</label>
                <input name="password" type="password" {{ $mode === 'create' ? 'required' : '' }} class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
                <p class="mt-2 text-xs text-slate-500">{{ $mode === 'edit' ? 'Biarkan kosong jika tidak ingin mengubah password.' : '' }}</p>
            </div>
            <div class="lg:col-span-2">
                <label class="block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                <input name="password_confirmation" type="password" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-slate-300" />
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">{{ $mode === 'create' ? 'Simpan User' : 'Perbarui User' }}</button>
        </div>
    </form>
</div>
@endsection
