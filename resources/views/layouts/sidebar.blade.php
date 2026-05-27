<aside class="hidden lg:flex flex-col w-64 bg-white border-r border-slate-100 shrink-0 justify-between p-6 fixed h-screen top-0 left-0 z-40">
    <div class="space-y-8">
        <a href="{{ url('/') }}" class="text-2xl font-extrabold text-[#0046A0] tracking-tight block px-2">
            Periksa<span class="text-[#0046A0]">.id</span>
        </a>

        <nav class="space-y-1.5">

           @hasrole('dokter')
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 {{ request()->routeIs('dashboard') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                    Dashboard Dokter
                </a>
                <a href="#" class="flex items-center gap-3 text-slate-500 hover:text-[#0046A0] hover:bg-slate-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Jadwal Praktek & Pasien
                </a>
                <a href="#" class="flex items-center gap-3 text-slate-500 hover:text-[#0046A0] hover:bg-slate-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Isi Rekam Medis
                </a>
                @endhasrole

          @hasrole('admin')
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 {{ request()->routeIs('dashboard') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                    Ringkasan
                </a>
                <a href="#" class="flex items-center gap-3 text-slate-500 hover:text-[#0046A0] hover:bg-slate-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Manajemen User
                </a>
                <a href="{{ route('admin.dokter.create') }}" class="flex items-center gap-3 text-slate-500 hover:text-[#0046A0] hover:bg-slate-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Tambah Dokter
                </a>
                @endhasrole

         @hasrole('pasien')
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 {{ request()->routeIs('dashboard') ? 'bg-[#0046A0] text-white shadow-sm shadow-blue-200' : 'text-slate-500 hover:text-[#0046A0] hover:bg-slate-50' }} px-4 py-3 rounded-xl font-semibold text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                    Dashboard Pasien
                </a>
                <a href="#" class="flex items-center gap-3 text-slate-500 hover:text-[#0046A0] hover:bg-slate-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    Konsultasi Saya
                </a>
                <a href="#" class="flex items-center gap-3 text-slate-500 hover:text-[#0046A0] hover:bg-slate-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                    Rekam Medis
                </a>
            @endhasrole

        </nav>
    </div>

    <div class="space-y-1.5 pt-6 border-t border-slate-100">
        <a href="#" class="flex items-center gap-3 text-slate-500 hover:text-[#0046A0] hover:bg-slate-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Pengaturan
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-3 rounded-xl font-medium text-sm transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
