@extends('dashboard.layouts.app')

@section('content')
  <!-- MAIN CONTENT CONTAINER -->
<div class="flex-1 p-4 md:p-10 space-y-6 md:space-y-8 overflow-y-auto">
    
    <!-- Welcome Header -->
    <div>
        <h1 class="text-xl md:text-3xl font-bold text-gray-900 tracking-tight">Halo, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-xs md:text-sm text-gray-500 mt-1 md:mt-1.5 font-medium">Berikut adalah ringkasan aktivitas dan informasi kesehatan Anda.</p>
    </div>

    <!-- 2 Column Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 md:gap-8 items-start">
        
        <!-- LEFT AREA: Medical Cards (Spans 2 columns) -->
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Card: Konsultasi Mendatang --}}
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-5">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div class="flex items-center gap-2.5 font-bold text-gray-900 text-sm">
                        <svg class="w-5 h-5 text-[#0046A0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Konsultasi Mendatang</span>
                    </div>
                </div>

                @if(isset($janjiTemus) && $janjiTemus->count() > 0)
                    <div class="space-y-4">
                        @foreach($janjiTemus as $janjiTemu)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 rounded-xl border border-slate-100 hover:border-blue-100 bg-slate-50/50 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-full bg-blue-50 border border-blue-100 overflow-hidden shrink-0 flex items-center justify-center text-[#0046A0] font-bold text-xl">
                                        @if($janjiTemu->dokter->avatar)
                                            <img src="{{ asset('storage/' . $janjiTemu->dokter->avatar) }}" alt="Dokter" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($janjiTemu->dokter->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div class="space-y-0.5">
                                        <div class="flex items-center gap-2">
                                            <h3 class="text-base font-bold text-gray-900">{{ $janjiTemu->dokter->name }}</h3>
                                            <span class="bg-blue-50 text-[#0046A0] text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">
                                                @if($janjiTemu->scheduled_date->isToday())
                                                    Hari Ini
                                                @else
                                                    {{ $janjiTemu->scheduled_date->translatedFormat('d M Y') }}
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-xs text-gray-500 font-medium">{{ $janjiTemu->dokter->getRoleNames()->first() }}</p>
                                        <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium pt-0.5">
                                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ \Carbon\Carbon::parse($janjiTemu->scheduled_time)->format('H:i') }} WIB</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('konsultasi.chat', $janjiTemu->id) }}" class="border-2 border-[#0046A0] bg-[#0046A0] text-white hover:bg-blue-800 font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-xl transition-all flex items-center justify-center gap-2 shrink-0 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    Mulai Konsultasi
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <p class="text-sm text-gray-400 font-medium">Belum ada konsultasi yang dijadwalkan.</p>
                        <a href="{{ route('cari-dokter.index') }}" class="text-xs text-[#0046A0] font-bold hover:underline mt-2 inline-block">Cari Dokter →</a>
                    </div>
                @endif
            </div>

            {{-- Card: Pesanan Obat Aktif --}}
            @if(isset($activeOrders) && $activeOrders->count() > 0)
                <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-5">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div class="flex items-center gap-2.5 font-bold text-gray-900 text-sm">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span>Pesanan Obat Aktif</span>
                        </div>
                    </div>
                    
                    <div class="space-y-4" id="orders-container">
                        @foreach($activeOrders as $order)
                            <div class="border border-slate-100 rounded-xl p-4 bg-slate-50 order-item" data-id="{{ $order->id }}" data-status="{{ $order->status }}" data-lat="{{ $order->latitude }}" data-lng="{{ $order->longitude }}">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-white overflow-hidden shadow-sm shrink-0">
                                            @if($order->medicine->image)
                                                <img src="{{ asset('storage/' . $order->medicine->image) }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-sm text-gray-900">{{ $order->medicine->name }} (x{{ $order->quantity }})</h4>
                                            <p class="text-[10px] text-gray-500 font-bold uppercase mt-0.5">Metode: {{ $order->payment_method }}</p>
                                        </div>
                                    </div>
                                    <div class="status-badge">
                                        @if($order->status === 'pending')
                                            <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full animate-pulse">Menunggu Dikirim</span>
                                        @else
                                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">Sedang Dikirim</span>
                                        @endif
                                    </div>
                                </div>
                                
                                {{-- Map Container (Hidden when pending) --}}
                                <div id="map-container-{{ $order->id }}" class="mt-4 rounded-xl overflow-hidden shadow-inner border border-slate-200 {{ $order->status === 'dikirim' ? 'block' : 'hidden' }}">
                                    <div class="bg-blue-50 px-3 py-2 text-xs font-bold text-[#0046A0] flex justify-between items-center border-b border-blue-100">
                                        <span>📍 Live Tracking Kurir</span>
                                        <span class="animate-pulse">● Live</span>
                                    </div>
                                    <div id="map-{{ $order->id }}" class="h-[200px] w-full z-0"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quick Action 3 Grid Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6">
                <!-- Action 1 -->
                <a href="{{ route('pasien.cari-dokter.index') }}" class="bg-white border border-slate-100 rounded-3xl p-8 text-center flex flex-col items-center justify-center space-y-4 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-[#0046A0] flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-gray-800 leading-tight">Booking Konsultasi Baru</span>
                </a>
                <!-- Action 2 -->
                <a href="{{ route('pasien.ai.index') }}" class="bg-white border border-slate-100 rounded-3xl p-8 text-center flex flex-col items-center justify-center space-y-4 shadow-sm hover:shadow-lg hover:border-indigo-200 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-gray-800 leading-tight">Cek Gejala (AI)</span>
                </a>
                <!-- Action 3 -->
                <a href="{{ route('farmasi.index') }}" class="bg-white border border-slate-100 rounded-3xl p-8 text-center flex flex-col items-center justify-center space-y-4 shadow-sm hover:shadow-lg hover:border-amber-200 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-gray-800 leading-tight">Pesan Obat</span>
                </a>
            </div>

        </div>

        <!-- RIGHT AREA: Health Tips Banner -->
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden flex flex-col h-full">
            <!-- Image Header -->
            <div class="relative h-44 bg-slate-200 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1511556532299-8f662fc26c06?w=400&auto=format&fit=crop&q=80" alt="Tips Kesehatan" class="w-full h-full object-cover">
                <span class="absolute bottom-4 left-4 bg-white/95 backdrop-blur-sm text-gray-800 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider shadow-sm">
                    Tips Kesehatan
                </span>
            </div>
            
            <!-- Content Body -->
            <div class="p-6 flex-1 flex flex-col justify-between space-y-6">
                <div class="space-y-2">
                    <h3 class="text-lg font-bold text-gray-900 leading-snug">Pentingnya Check-up Rutin</h3>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">
                        Pemeriksaan kesehatan rutin sangat penting untuk mendeteksi potensi masalah sebelum menjadi serius. Ketahui jadwal ideal untuk profil usia Anda.
                    </p>
                </div>

                <a href="#" class="w-full text-center bg-slate-50 border border-slate-100 text-[#0046A0] font-bold text-xs py-3 rounded-xl hover:bg-slate-100/70 transition-all block">
                    Baca Selengkapnya
                </a>
            </div>
        </div>

    </div>
</div>

@if(isset($activeOrders) && $activeOrders->count() > 0)
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="{{ asset('js/pasien-dashboard.js') }}"></script>
@endif

@endsection
