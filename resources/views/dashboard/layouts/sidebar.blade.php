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
                    Dashboard Dokter
                </a>
           @endhasrole

          @hasrole('admin')
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 {{ request()->routeIs('dashboard') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold text-sm transition-all">
                    Ringkasan
                </a>
                <a href="{{ route('admin.dokter.create') }}" class="flex items-center gap-3 text-slate-500 hover:text-[#0046A0] hover:bg-slate-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                    Tambah Dokter
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 text-slate-500 hover:text-[#0046A0] hover:bg-slate-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">Manajemen User</a>
          @endhasrole

          @hasrole('pasien')
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 {{ request()->routeIs('dashboard') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold text-sm transition-all">
                    Dashboard Pasien
                </a>
          @endhasrole
        </nav>
    </div>

   <div class="space-y-1.5 pt-6 border-t border-slate-100">
    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 {{ request()->routeIs('admin.profile.edit') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-medium text-sm transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Edit Profil
    </a>

    <a href="#" class="flex items-center gap-3 text-slate-500 hover:text-[#0046A0] hover:bg-slate-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.43l-1.003.767c-.31.236-.48.604-.48.996s.17.76.48.996l1.003.767a1.125 1.125 0 01.26 1.43l-1.296 2.247a1.125 1.125 0 01-1.37.49l-1.216-.456a1.125 1.125 0 00-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281a1.125 1.125 0 00-.646-.87a6.521 6.521 0 01-.22-.127a1.125 1.125 0 00-1.074-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.43l1.004-.767c.31-.236.48-.604.48-.996s-.17-.76-.48-.996L3.344 11.23a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.49l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128c.332-.183.582-.495.644-.869l.214-1.28z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Pengaturan
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


