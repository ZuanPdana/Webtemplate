{{-- Admin shared navbar. Requires $adminId and $admin in scope. --}}
<header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-6 py-3">
        <a href="{{ route('admin.dashboard') }}" class="text-lg font-black tracking-[0.3em] text-slate-950">SHOESTEP</a>

        <nav class="hidden items-center gap-6 text-sm text-slate-600 md:flex">
            <a href="{{ route('admin.dashboard') }}"
               class="transition hover:text-slate-950 {{ request()->routeIs('admin.dashboard') ? 'font-semibold text-slate-950' : '' }}">Home</a>
            <a href="{{ route('admin.products') }}"
               class="transition hover:text-slate-950 {{ request()->routeIs('admin.products*') ? 'font-semibold text-slate-950' : '' }}">Produk</a>
            <a href="{{ route('admin.users') }}"
               class="transition hover:text-slate-950 {{ request()->routeIs('admin.users*') ? 'font-semibold text-slate-950' : '' }}">User</a>
            <a href="{{ route('admin.coupons') }}"
               class="transition hover:text-slate-950 {{ request()->routeIs('admin.coupons*') ? 'font-semibold text-slate-950' : '' }}">Promo</a>
        </nav>

        {{-- Profile dropdown --}}
        <div class="relative">
            <button id="admin-profile-btn" onclick="toggleAdminMenu()"
                class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-full border border-slate-200 bg-slate-100 transition hover:bg-slate-200">
                @if (!empty($admin?->avatar))
                    <img src="{{ Storage::url($admin->avatar) }}" alt="Avatar" class="h-full w-full object-cover">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                @endif
            </button>

            <div id="admin-profile-menu"
                 style="display:none;"
                 class="absolute right-0 top-[calc(100%+8px)] z-50 min-w-[180px] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/10">
                <div class="border-b border-slate-100 px-4 py-3">
                    <p class="text-xs font-bold text-slate-900">{{ $admin?->name ?? $adminId }}</p>
                    <p class="text-[11px] text-slate-400">@{{ $adminId }}</p>
                </div>
                <a href="{{ route('admin.profile') }}"
                   class="flex items-center gap-2.5 px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                    Profil Saya
                </a>
                <div class="h-px bg-slate-100"></div>
                <a href="{{ route('admin.logout') }}"
                   class="flex items-center gap-2.5 px-4 py-3 text-sm font-medium text-rose-500 transition hover:bg-rose-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </div>
</header>

<script>
function toggleAdminMenu() {
    var m = document.getElementById('admin-profile-menu');
    m.style.display = m.style.display === 'none' ? 'block' : 'none';
}
document.addEventListener('click', function(e) {
    var btn  = document.getElementById('admin-profile-btn');
    var menu = document.getElementById('admin-profile-menu');
    if (menu && btn && !btn.contains(e.target) && !menu.contains(e.target)) {
        menu.style.display = 'none';
    }
});
</script>
