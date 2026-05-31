@extends('dashboard.layouts.app')

@section('content')
<div class="flex-1 p-4 md:p-10 space-y-6 md:space-y-8 overflow-y-auto w-full max-w-full lg:ml-64 relative">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">Cari Dokter</h1>
            <p class="text-xs md:text-sm text-gray-500 mt-1 md:mt-1.5 font-medium">Lihat daftar dokter spesialis dan buat janji temu.</p>
        </div>
    </div>

    <section class="grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-6">
        @foreach($dokters as $dokter)
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm flex flex-col justify-between gap-5 hover:shadow-md transition-shadow">
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

    {{-- MODAL DETAIL --}}
    <div id="modal-container" class="fixed inset-0 z-50 hidden flex">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="tutupModalDetail()"></div>
        
        <div class="absolute inset-y-0 right-0 w-full max-w-md bg-white shadow-2xl flex flex-col h-full transform transition-transform translate-x-0">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-white">
                <h2 class="text-base font-bold text-gray-900">Buat Janji Temu</h2>
                <button onclick="tutupModalDetail()" class="text-2xl text-gray-400 hover:text-gray-600 transition-colors">&times;</button>
            </div>

            <div class="flex-1 p-6 space-y-6 overflow-y-auto">
                <div class="flex items-center gap-5">
                    <div class="w-20 h-20 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-[#0046A0] font-bold text-3xl overflow-hidden shrink-0">
                        <span id="modal-avatar-initials"></span>
                        <img id="modal-avatar-img" src="" alt="Dokter" class="w-full h-full object-cover hidden">
                    </div>
                    <div>
                        <h3 id="modal-nama" class="text-lg font-bold text-gray-900"></h3>
                        <p id="modal-spesialis" class="text-sm font-semibold text-[#0046A0]"></p>
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

                <div class="pt-4 border-t border-slate-100">
                    <form action="{{ route('janji.store') }}" method="POST" class="w-full space-y-4">
                        @csrf
                        <input type="hidden" id="modal-dokter-id" name="dokter_id">
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Keluhan / Alasan Konsultasi</label>
                            <textarea name="keluhan" rows="4" required placeholder="Tuliskan keluhan atau tujuan Anda berkonsultasi dengan dokter ini secara detail..." class="w-full border border-gray-200 bg-slate-50 rounded-2xl p-4 text-sm focus:ring-[#0046A0] focus:border-[#0046A0] resize-none"></textarea>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                            <p class="text-xs text-[#0046A0] leading-relaxed font-medium">
                                <span class="font-bold block mb-1">Informasi:</span>
                                Jadwal konsultasi akan ditentukan oleh dokter setelah menyetujui permintaan Anda. Anda akan menerima notifikasi jika janji disetujui.
                            </p>
                        </div>
                        
                        <button type="submit" class="w-full bg-[#0046A0] text-white py-4 rounded-xl font-bold hover:bg-[#003780] transition-all shadow-sm">
                            Kirim Permintaan Janji
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function cekDetail(id, nama, spesialis, avatarUrl, isLogin, alamat, lulusan) {
        document.getElementById('modal-dokter-id').value = id;
        document.getElementById('modal-nama').innerText = nama;
        document.getElementById('modal-spesialis').innerText = spesialis;

        const imgEl = document.getElementById('modal-avatar-img');
        const initialsEl = document.getElementById('modal-avatar-initials');

        if (avatarUrl && avatarUrl.trim() !== '') {
            imgEl.src = avatarUrl;
            imgEl.classList.remove('hidden');
            initialsEl.classList.add('hidden');
        } else {
            imgEl.classList.add('hidden');
            initialsEl.classList.remove('hidden');
            initialsEl.innerText = nama.substring(0, 2).toUpperCase();
        }

        // Show/hide info sections
        const infoSection = document.getElementById('modal-info-section');
        const lulusanWrap = document.getElementById('modal-lulusan-wrap');
        const alamatWrap = document.getElementById('modal-alamat-wrap');
        const lulusanEl = document.getElementById('modal-lulusan');
        const alamatEl = document.getElementById('modal-alamat');

        let hasInfo = false;
        if (lulusan && lulusan.trim() !== '') {
            lulusanEl.innerText = lulusan;
            lulusanWrap.classList.remove('hidden');
            hasInfo = true;
        } else {
            lulusanWrap.classList.add('hidden');
        }
        if (alamat && alamat.trim() !== '') {
            alamatEl.innerText = alamat;
            alamatWrap.classList.remove('hidden');
            hasInfo = true;
        } else {
            alamatWrap.classList.add('hidden');
        }
        infoSection.classList.toggle('hidden', !hasInfo);

        document.getElementById('modal-container').classList.remove('hidden');
    }

    function tutupModalDetail() {
        document.getElementById('modal-container').classList.add('hidden');
    }
</script>
@endsection
