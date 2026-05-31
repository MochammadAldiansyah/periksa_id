@extends('dashboard.layouts.app')

@section('content')
<div class="flex-1 p-4 md:p-10 space-y-6 md:space-y-8 overflow-y-auto">
    
    {{-- Header --}}
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">Daftar Konsultasi</h1>
        <p class="text-xs md:text-sm text-gray-500 mt-1 md:mt-1.5 font-medium">Lanjutkan percakapan dengan {{ auth()->user()->hasRole('pasien') ? 'dokter Anda' : 'pasien Anda' }}.</p>
    </div>

    {{-- Daftar Konsultasi --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        @if($konsultasis->count() > 0)
            <div class="divide-y divide-slate-100">
                @foreach($konsultasis as $konsultasi)
                    @php
                        $lawanBicara = auth()->user()->hasRole('pasien') ? $konsultasi->dokter : $konsultasi->user;
                        // Ambil pesan terakhir jika ada
                        $lastMessage = $konsultasi->messages()->latest()->first();
                    @endphp
                    <div class="p-4 md:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4 hover:bg-slate-50/50 transition-all">
                        <div class="flex items-center gap-3 md:gap-4 min-w-0">
                            <div class="relative w-11 h-11 md:w-14 md:h-14 rounded-full bg-blue-50 border border-blue-100 overflow-hidden shrink-0 flex items-center justify-center text-[#0046A0] font-bold text-base md:text-xl">
                                @if($lawanBicara->avatar)
                                    <img src="{{ asset('storage/' . $lawanBicara->avatar) }}" alt="{{ $lawanBicara->name }}" class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($lawanBicara->name, 0, 2)) }}
                                @endif
                                <div class="absolute bottom-0 right-0.5 md:right-1 w-2.5 md:w-3 h-2.5 md:h-3 bg-emerald-400 border-2 border-white rounded-full"></div>
                            </div>
                            
                            <div class="min-w-0 space-y-0.5 md:space-y-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-sm md:text-base font-bold text-gray-900 truncate">{{ $lawanBicara->name }}</h3>
                                    @if($lastMessage)
                                        <span class="text-[10px] md:text-xs font-medium text-gray-400 shrink-0 sm:hidden">{{ $lastMessage->created_at->diffForHumans(null, true, true) }}</span>
                                    @endif
                                </div>
                                
                                @if($lastMessage)
                                    <p class="text-xs md:text-sm text-gray-500 line-clamp-1">
                                        @if($lastMessage->sender_id === auth()->id())
                                            <span class="text-gray-400">Anda:</span> 
                                        @endif
                                        {{ $lastMessage->message }}
                                    </p>
                                @else
                                    <p class="text-xs md:text-sm text-gray-400 italic">Belum ada pesan.</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center sm:flex-col sm:items-end gap-2 shrink-0">
                            @if($lastMessage)
                                <span class="text-xs font-medium text-gray-400 hidden sm:block">{{ $lastMessage->created_at->diffForHumans(null, true, true) }}</span>
                            @endif
                            <a href="{{ route('konsultasi.chat', $konsultasi->id) }}" class="flex-1 sm:flex-initial border-2 border-[#0046A0] bg-[#0046A0] text-white hover:bg-blue-800 font-bold text-xs uppercase tracking-wider px-5 py-2.5 rounded-xl transition-all flex items-center justify-center shadow-sm">
                                Chat
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Belum ada jadwal konsultasi</h3>
                <p class="text-sm text-gray-500 mt-1 max-w-sm">Anda belum memiliki jadwal konsultasi yang disetujui saat ini.</p>
                
                @hasrole('pasien')
                    <a href="{{ route('cari-dokter.index') }}" class="mt-6 bg-[#0046A0] text-white font-bold px-6 py-3 rounded-xl hover:bg-blue-800 transition-colors">
                        Cari Dokter Sekarang
                    </a>
                @endhasrole
            </div>
        @endif
    </div>

</div>
@endsection
