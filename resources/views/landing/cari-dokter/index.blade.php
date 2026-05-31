@extends('landing.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 pt-12 pb-20 space-y-8">
    <h1 class="text-3xl font-bold text-gray-900">Dokter Tersedia</h1>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @foreach($dokters as $dokter)
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm flex flex-col justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-[#0046A0] font-bold text-xl overflow-hidden shrink-0">
                    @if ($dokter->avatar)
                        <img src="{{ asset('storage/' . $dokter->avatar) }}" alt="{{ $dokter->name }}" class="w-full h-full object-cover">
                    @else
                        <span>{{ strtoupper(substr($dokter->name, 0, 2)) }}</span>
                    @endif
                </div>
                <div>
                    <h4 class="text-base font-bold text-gray-900">{{ $dokter->name }}</h4>
                    <p class="text-xs font-semibold text-[#0046A0]">{{ $dokter->getRoleNames()->first() }}</p>
                </div>
            </div>

         <button onclick="cekDetail({{ $dokter->id }}, '{{ addslashes($dokter->name) }}', '{{ $dokter->getRoleNames()->first() }}', '{{ $dokter->avatar ? asset('storage/' . $dokter->avatar) : '' }}', {{ auth()->check() ? 'true' : 'false' }}, '{{ addslashes($dokter->alamat ?? '') }}', '{{ addslashes($dokter->lulusan ?? '') }}')"
        class="w-full bg-[#0046A0] hover:bg-[#003780] text-white text-xs font-medium py-3 rounded-xl transition-all">
    Lihat Detail
</button>
        </div>
        @endforeach
    </section>

    {{-- MODAL DETAIL (ID: modal-container) --}}
    <div id="modal-container" class="fixed inset-0 z-50 hidden flex">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-xs" onclick="tutupModalDetail()"></div>

        <div class="absolute inset-y-0 right-0 w-full max-w-lg bg-white shadow-2xl flex flex-col h-full">
            <div class="px-6 py-5 border-b flex items-center justify-between">
                <h2 class="text-base font-bold">Detail Profil Dokter</h2>
                <button onclick="tutupModalDetail()" class="text-2xl text-gray-400">&times;</button>
            </div>

            <div class="flex-1 p-6 space-y-6 overflow-y-auto">
                <div class="flex items-center gap-5">
                    <div class="w-20 h-20 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-[#0046A0] font-bold text-3xl overflow-hidden shrink-0">
                        <span id="modal-avatar-initials"></span>
                        <img id="modal-avatar-img" src="" alt="Dokter" class="w-full h-full object-cover hidden">
                    </div>
                    <div>
                        <h3 id="modal-nama" class="text-lg font-bold"></h3>
                        <p id="modal-spesialis" class="text-sm text-gray-600"></p>
                    </div>
                </div>

                <div id="modal-info-section" class="space-y-4 hidden">
                    <div id="modal-lulusan-wrap" class="hidden">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-[#0046A0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            <span class="text-xs font-bold text-gray-700 uppercase">Gelar Kelulusan</span>
                        </div>
                        <p id="modal-lulusan" class="text-sm text-gray-600 bg-blue-50 rounded-xl p-3 border border-blue-100"></p>
                    </div>
                    <div id="modal-alamat-wrap" class="hidden">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-[#0046A0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-xs font-bold text-gray-700 uppercase">Alamat Praktik</span>
                        </div>
                        <p id="modal-alamat" class="text-sm text-gray-600 bg-slate-50 rounded-xl p-3 border border-slate-100"></p>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t shrink-0">
                @auth
                    @if(auth()->user()->hasRole('pasien'))
                        <form action="{{ route('janji.store') }}" method="POST" class="w-full space-y-3">
                            @csrf
                            <input type="hidden" id="modal-dokter-id" name="dokter_id">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Keluhan Anda</label>
                                <textarea name="keluhan" rows="3" placeholder="Tuliskan keluhan atau alasan konsultasi Anda..." class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-[#0046A0] focus:border-[#0046A0] resize-none"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-[#0046A0] text-white py-4 rounded-xl font-bold hover:bg-[#003780] transition-all">📅 Buat Janji Temu</button>
                        </form>
                    @else
                        <p class="text-center text-sm text-gray-500">Anda tidak bisa membuat janji.</p>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="w-full block text-center bg-[#0046A0] text-white py-4 rounded-xl">
                        🔑 Login untuk Buat Janji
                    </a>
                @endauth
            </div>
        </div>
    </div>
    {{-- MODAL PERINGATAN (LOGIN) --}}
<div id="login-warning-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl">
        <div class="w-16 h-16 text-[#0046A0] rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Perlu Login</h3>
        <p class="text-gray-500 mb-6 text-sm">Fitur lihat detail dokter hanya tersedia untuk pasien yang sudah login.</p>
        <div class="space-y-3">
            <a href="{{ route('login') }}" class="block w-full bg-[#0046A0] text-white py-3 rounded-xl font-medium hover:bg-[#003780]">Login Sekarang</a>
            <button onclick="closeWarningModal()" class="block w-full text-gray-400 py-3 rounded-xl font-medium hover:text-gray-600">Nanti Saja</button>
        </div>
    </div>
</div>
</div>
@endsection
