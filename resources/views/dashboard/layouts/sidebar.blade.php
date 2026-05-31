<button id="btnOpenSidebar" class="fixed top-4 left-4 z-30 lg:hidden bg-white text-slate-500 hover:text-[#0046A0] p-3 focus:outline-none border border-slate-200/80 rounded-xl shadow-sm hover:bg-slate-50 transition-all flex items-center justify-center">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>


<div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/40 z-40 lg:hidden hidden transition-opacity duration-300 opacity-0"></div>


<aside id="mainSidebar" class="fixed top-0 bottom-0 left-0 z-50 flex flex-col w-64 bg-white border-r border-slate-100 shrink-0 justify-between p-6 h-screen transition-transform duration-300 ease-in-out transform -translate-x-full lg:translate-x-0">

    <div class="space-y-8">
        <div class="flex items-center justify-between px-2">
            <a href="{{ url('/') }}" class="text-2xl font-extrabold text-[#0046A0] tracking-tight block">
                Periksa<span class="text-[#0046A0]">.id</span>  
            </a>
            <button id="btnCloseSidebar" class="text-slate-400 hover:text-slate-600 lg:hidden p-1 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

   <nav class="space-y-1.5">
    @hasrole('dokter')
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 {{ request()->routeIs('dashboard') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold text-sm transition-all">
            <!-- Icon Dashboard Dokter -->
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span>Dashboard Dokter</span>
        </a>

        <!-- Konsultasi -->
        <a href="{{ route('konsultasi.index') }}" class="flex items-center gap-3 {{ request()->routeIs('konsultasi.*') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-medium text-sm transition-all">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <span>Konsultasi</span>
        </a>

        <!-- Forum -->
        <a href="{{ route('forum.index') }}" class="flex items-center gap-3 {{ request()->routeIs('forum.*') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-medium text-sm transition-all">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
            </svg>
            <span>Forum</span>
        </a>

        <!-- Katalog Farmasi -->
        <a href="{{ route('farmasi.index') }}" class="flex items-center gap-3 {{ request()->routeIs('farmasi.*') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-medium text-sm transition-all">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
            </svg>
            <span>Katalog Farmasi</span>
        </a>
    @endhasrole

    @hasrole('admin')
        <!-- Ringkasan / Dashboard Admin -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 {{ request()->routeIs('admin.dashboard') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold text-sm transition-all">
            <!-- Icon Ringkasan -->
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span>Ringkasan</span>
        </a>
        
        <!-- Tambah Dokter -->
        <a href="{{ route('admin.dokter.create') }}" class="flex items-center gap-3 {{ request()->routeIs('admin.dokter.*') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-medium text-sm transition-all">
            <!-- Icon Tambah Dokter -->
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            <span>Tambah Dokter</span>
        </a>
        
        <!-- Manajemen User -->
        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 {{ request()->routeIs('admin.users.*') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-medium text-sm transition-all">
            <!-- Icon Manajemen User -->
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span>Manajemen User</span>
        </a>
        
        <!-- Forum -->
        <a href="{{ route('forum.index') }}" class="flex items-center gap-3 {{ request()->routeIs('forum.*') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-medium text-sm transition-all">
            <!-- Icon Forum -->
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
            </svg>
            <span>Forum</span>
        </a>

        <!-- Admin Farmasi -->
        <a href="{{ route('admin.farmasi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.farmasi.*') ? 'bg-[#0046A0] text-white shadow-md shadow-blue-500/20 font-bold' : 'text-gray-500 hover:bg-blue-50 hover:text-[#0046A0] font-medium' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <span class="text-[15px]">Data Farmasi</span>
        </a>

        <!-- Katalog Farmasi (Publik + Peta) -->
        <a href="{{ route('farmasi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('farmasi.index') ? 'bg-[#0046A0] text-white shadow-md shadow-blue-500/20 font-bold' : 'text-gray-500 hover:bg-blue-50 hover:text-[#0046A0] font-medium' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="text-[15px]">Katalog & Apotek</span>
        </a>
        
        <!-- Admin Pesanan Obat -->
        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.orders.*') ? 'bg-[#0046A0] text-white shadow-md shadow-blue-500/20 font-bold' : 'text-gray-500 hover:bg-blue-50 hover:text-[#0046A0] font-medium' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <span class="text-[15px]">Pesanan Obat</span>
        </a>
    @endhasrole

    @hasrole('pasien')
        <!-- Dashboard Pasien -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('dashboard') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span>Dashboard Pasien</span>
        </a>

        <!-- Konsultasi -->
        <a href="{{ route('konsultasi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('konsultasi.*') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <span>Konsultasi</span>
        </a>

        <!-- Cari Dokter -->
        <a href="{{ route('pasien.cari-dokter.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('pasien.cari-dokter.*') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span>Cari Dokter</span>
        </a>

        <!-- Farmasi -->
        <a href="{{ route('farmasi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('farmasi.*') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
            </svg>
            <span>Farmasi</span>
        </a>

        <!-- Forum -->
        <a href="{{ route('forum.index') }}" class="flex items-center gap-3 {{ request()->routeIs('forum.*') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-medium text-sm transition-all">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
            </svg>
            <span>Forum</span>
        </a>
    @endhasrole
</nav>
    </div>

   <div class="space-y-1.5 pt-6 border-t border-slate-100">
    <div class="flex items-center gap-3 px-4 py-3 mb-2 rounded-xl bg-slate-50 border border-slate-100">
        <div class="relative w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-[#0046A0] font-bold overflow-hidden shrink-0">
            @if (auth()->user()->avatar)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Profile Photo" class="w-full h-full object-cover">
            @else
                <span>{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
            @endif
        </div>
        <div class="overflow-hidden">
            <p class="text-sm font-bold text-slate-800 truncate">{{ auth()->user()->name }}</p>
            <p class="text-xs text-slate-500 truncate">{{ auth()->user()->roles->pluck('name')->first() ?? 'User' }}</p>
        </div>
    </div>

    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 {{ request()->routeIs('profile.edit') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-medium text-sm transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Edit Profil
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            Keluar
        </button>
    </form>
</div>
</aside>


