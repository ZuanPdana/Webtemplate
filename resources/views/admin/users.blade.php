<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SHOESTEP - Kelola User</title>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#F7F6F3] text-[#1D1B18] antialiased">
        <div class="min-h-screen">
            @include('admin.partials.navbar')

            <main class="mx-auto max-w-7xl px-6 py-10">
                @if (session('status'))
                    <div class="mb-6 inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-semibold text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Administrasi User</p>
                        <h1 class="mt-2 text-3xl font-black text-slate-950">Kelola semua user</h1>
                        <p class="mt-1 text-sm text-slate-500">
                            {{ $userStats['total'] }} user ·
                            {{ $userStats['active'] }} aktif ·
                            {{ $userStats['blocked'] }} diblokir
                        </p>
                    </div>
                    <div class="flex gap-2 text-xs font-semibold text-slate-500">
                        <span class="rounded-full bg-amber-100 px-3 py-1 text-amber-700">{{ $userStats['inactive'] }} Inactive</span>
                        <span class="rounded-full bg-rose-100 px-3 py-1 text-rose-700">{{ $userStats['blocked'] }} Blocked</span>
                    </div>
                </div>

                <div class="mb-4 flex flex-wrap items-center gap-3">
                    <input id="user-search" type="text" placeholder="Cari nama, username, atau email…"
                        oninput="filterUsers()"
                        class="flex-1 min-w-[200px] rounded-full border border-slate-200 bg-white px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                    <select id="user-sort" onchange="sortUsers()"
                        class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="name_asc">Nama A–Z</option>
                        <option value="name_desc">Nama Z–A</option>
                        <option value="status">Status</option>
                    </select>
                </div>

                <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-900/5">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-slate-50 text-[11px] uppercase tracking-[0.2em] text-slate-500">
                                <tr>
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">Username</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Phone</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Bergabung</th>
                                    <th class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="user-tbody" class="divide-y divide-slate-100">
                                @foreach ($users as $user)
                                    <tr class="user-row hover:bg-slate-50/60"
                                        data-name="{{ strtolower($user->name) }}"
                                        data-username="{{ strtolower($user->username ?? '') }}"
                                        data-email="{{ strtolower($user->email) }}"
                                        data-status="{{ $user->status }}"
                                        data-created="{{ $user->created_at?->timestamp ?? 0 }}">
                                        <td class="px-4 py-3 font-semibold text-slate-600">#{{ $user->id }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-900">{{ $user->name }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $user->username }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $user->email }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $user->phone ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            <span @class([
                                                'inline-flex rounded-full px-2.5 py-1 text-xs font-semibold',
                                                'bg-emerald-100 text-emerald-700' => $user->status === 'active',
                                                'bg-amber-100 text-amber-700' => $user->status === 'inactive',
                                                'bg-rose-100 text-rose-700' => $user->status === 'blocked',
                                            ])>{{ $user->status }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-slate-500 text-xs">{{ $user->created_at?->format('d M Y') ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                               class="inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-700">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3 text-sm text-slate-500">
                        <span>Menampilkan <strong id="user-showing">0</strong> dari <strong id="user-total">{{ $users->count() }}</strong> user</span>
                        <div class="flex items-center gap-2">
                            <button onclick="userPage(-1)" class="rounded-full border border-slate-200 px-3 py-1 text-xs hover:bg-slate-100">&#8592; Prev</button>
                            <span id="user-page-label" class="text-xs font-semibold">Hal 1</span>
                            <button onclick="userPage(1)" class="rounded-full border border-slate-200 px-3 py-1 text-xs hover:bg-slate-100">Next &#8594;</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script>
        var USER_PAGE_SIZE = 10;
        var userCurrentPage = 1;
        var userFilteredRows = [];

        function getAllUserRows() { return Array.from(document.querySelectorAll('#user-tbody .user-row')); }

        function filterUsers() {
            var q = document.getElementById('user-search').value.toLowerCase().trim();
            userCurrentPage = 1;
            userFilteredRows = getAllUserRows().filter(function(r) {
                return !q || r.dataset.name.includes(q) || r.dataset.username.includes(q) || r.dataset.email.includes(q);
            });
            sortUsers(true);
        }

        function sortUsers(fromFilter) {
            if (!fromFilter) { userCurrentPage = 1; if (!userFilteredRows.length) userFilteredRows = getAllUserRows(); }
            var key = document.getElementById('user-sort').value;
            userFilteredRows.sort(function(a, b) {
                if (key === 'newest')    return b.dataset.created - a.dataset.created;
                if (key === 'oldest')    return a.dataset.created - b.dataset.created;
                if (key === 'name_asc')  return a.dataset.name.localeCompare(b.dataset.name);
                if (key === 'name_desc') return b.dataset.name.localeCompare(a.dataset.name);
                if (key === 'status')    return a.dataset.status.localeCompare(b.dataset.status);
                return 0;
            });
            renderUserPage();
        }

        function userPage(delta) {
            var max = Math.max(1, Math.ceil(userFilteredRows.length / USER_PAGE_SIZE));
            userCurrentPage = Math.min(max, Math.max(1, userCurrentPage + delta));
            renderUserPage();
        }

        function renderUserPage() {
            getAllUserRows().forEach(function(r) { r.style.display = 'none'; });
            var start = (userCurrentPage - 1) * USER_PAGE_SIZE;
            var slice = userFilteredRows.slice(start, start + USER_PAGE_SIZE);
            var tbody = document.getElementById('user-tbody');
            slice.forEach(function(r) { tbody.appendChild(r); r.style.display = ''; });
            document.getElementById('user-showing').textContent = slice.length;
            document.getElementById('user-total').textContent = userFilteredRows.length;
            var max = Math.max(1, Math.ceil(userFilteredRows.length / USER_PAGE_SIZE));
            document.getElementById('user-page-label').textContent = 'Hal ' + userCurrentPage + ' / ' + max;
        }

        document.addEventListener('DOMContentLoaded', function() {
            userFilteredRows = getAllUserRows();
            sortUsers(true);
        });
        </script>
    </body>
</html>
