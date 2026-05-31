@extends('dashboard.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    {{-- Top Header & Search --}}
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900">Pencarian Farmasi</h1>
            <p class="text-gray-500 mt-1">Cari obat, kelola resep digital, dan temukan apotek terdekat.</p>
        </div>
        <div class="relative w-full md:w-96 mt-2 md:mt-0">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" placeholder="Cari nama obat atau kandungan..." class="block w-full pl-10 pr-12 py-3 border border-gray-200 rounded-full bg-white focus:ring-[#0046A0] focus:border-[#0046A0] text-sm transition-all shadow-sm">
            <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                <button class="p-1.5 bg-gray-50 rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Filter Pills --}}
    <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
        <button class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-sm font-bold transition-colors whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            Filter
        </button>
        <button class="px-5 py-2 bg-[#0046A0] text-white rounded-full text-sm font-bold transition-colors whitespace-nowrap shadow-sm">Semua Obat</button>
        <button class="px-5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-full text-sm font-bold transition-colors whitespace-nowrap">Obat Resep</button>
        <button class="px-5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-full text-sm font-bold transition-colors whitespace-nowrap">Obat Bebas</button>
        <button class="px-5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-full text-sm font-bold transition-colors whitespace-nowrap">Vitamin & Suplemen</button>
        <button class="px-5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-full text-sm font-bold transition-colors whitespace-nowrap">Alat Kesehatan</button>
    </div>

    {{-- Main Content 2 Columns --}}
    <div class="flex flex-col lg:flex-row gap-8">
        
        {{-- Kolom Kiri: Katalog Obat --}}
        <div class="flex-grow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Katalog Obat
                </h2>
            </div>
            
            @if($medicines->isEmpty())
                <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
                    <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 text-[#0046A0]">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Katalog Kosong</h3>
                    <p class="text-gray-500 mt-1">Belum ada daftar obat yang ditambahkan.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
                    @foreach($medicines as $index => $med)
                        @php
                            // Simulasi kategori random untuk desain baru
                            $isResep = $index % 2 == 0; 
                            $badgeClass = $isResep ? 'bg-[#986E3C] text-white' : 'bg-gray-200 text-gray-700';
                            $badgeText = $isResep ? 'RESEP' : 'BEBAS';
                            $stock = $med->stock;
                            $isHabis = $stock <= 0;
                            $isMenipis = $stock > 0 && $stock < 10;
                            
                            if ($isHabis) {
                                $stockText = 'Stok Habis';
                                $stockIconColor = 'text-red-600';
                            } elseif ($isMenipis) {
                                $stockText = 'Menipis (Sisa ' . $stock . ')';
                                $stockIconColor = 'text-orange-500';
                            } else {
                                $stockText = 'Tersedia (Sisa ' . $stock . ')';
                                $stockIconColor = 'text-[#0046A0]';
                            }
                        @endphp
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-lg transition-all group flex flex-col">
                            <div class="aspect-[4/3] bg-gray-50 relative overflow-hidden flex items-center justify-center p-4">
                                @if($med->image)
                                    <img src="{{ asset('storage/' . $med->image) }}" alt="{{ $med->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                
                                {{-- Overlay Badge Resep/Bebas --}}
                                <div class="absolute top-3 right-3 {{ $badgeClass }} px-2.5 py-0.5 rounded text-[10px] font-bold shadow-sm tracking-wider">
                                    {{ $badgeText }}
                                </div>

                                {{-- Peringatan Stok jika tipis/habis --}}
                                @if($isHabis)
                                <div class="absolute inset-0 bg-white/60 flex items-center justify-center backdrop-blur-[2px]">
                                    <div class="bg-red-50 px-4 py-1.5 rounded-full text-red-600 text-xs font-bold shadow-sm border border-red-200 flex items-center gap-1.5">
                                        Stok Habis
                                    </div>
                                </div>
                                @elseif($isMenipis)
                                <div class="absolute inset-0 bg-white/40 flex items-center justify-center backdrop-blur-[1px]">
                                    <div class="bg-white px-4 py-1.5 rounded-full text-orange-500 text-xs font-bold shadow-sm border border-orange-100 flex items-center gap-1.5">
                                        Stok Menipis (Sisa {{ $stock }})
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="font-bold text-gray-900 leading-tight mb-1" title="{{ $med->name }}">{{ $med->name }}</h3>
                                <p class="text-[11px] text-gray-500 mb-3 truncate">Generik &bull; Deskripsi/Strip</p>
                                
                                <div class="flex items-center justify-between mb-4 mt-auto">
                                    <div class="font-extrabold text-gray-900 text-lg">
                                        Rp {{ number_format($med->price, 0, ',', '.') }}
                                    </div>
                                    <div class="flex items-center gap-1 text-xs font-bold {{ $stockIconColor }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        {{ $stockText }}
                                    </div>
                                </div>
                                
                                @hasrole('pasien')
                                    @if($med->stock > 0)
                                        <button onclick="openBuyModal({{ $med->id }}, '{{ addslashes($med->name) }}', {{ $med->price }}, {{ $med->stock }})" class="w-full bg-white border-2 border-[#0046A0] text-[#0046A0] hover:bg-blue-50 py-2 rounded-xl text-sm font-bold transition-colors text-center">
                                            Cari Apotek
                                        </button>
                                    @else
                                        <button onclick="openOutOfStockModal('{{ addslashes($med->name) }}')" class="w-full bg-gray-100 text-gray-500 py-2 rounded-xl text-sm font-bold cursor-not-allowed text-center">
                                            Cek Ketersediaan
                                        </button>
                                    @endif
                                @endhasrole
                                
                                @hasrole('dokter')
                                    <button class="w-full bg-emerald-50 border-2 border-emerald-500 text-emerald-600 hover:bg-emerald-100 py-2 rounded-xl text-sm font-bold transition-colors text-center">
                                        Rekomendasikan
                                    </button>
                                @endhasrole
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        {{-- Kolom Kanan: Apotek Terdekat --}}
        <div class="w-full lg:w-[22rem] xl:w-[26rem] flex-shrink-0 space-y-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Apotek Terdekat
                </h2>
                <a href="#" class="text-sm font-bold text-[#0046A0] hover:underline">Lihat Peta</a>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-bold text-gray-900">Lokasi Saat Ini</h3>
                    <button onclick="requestGeolocation()" class="text-[#0046A0] hover:bg-blue-50 p-1.5 rounded-full transition-colors" title="Perbarui Lokasi">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </button>
                </div>
                {{-- Map Container --}}
                <div id="apotek-map" class="w-full h-48 bg-gray-100 relative z-0 flex items-center justify-center">
                    <div class="text-center p-4">
                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-2 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <p class="text-sm text-gray-500 font-medium" id="map-status-text">Meminta izin lokasi...</p>
                        <button onclick="requestGeolocation()" id="btn-request-location" class="mt-2 text-xs font-bold text-[#0046A0] hidden border border-[#0046A0] px-3 py-1 rounded-full">Izinkan Akses Lokasi</button>
                    </div>
                </div>
                <div class="p-3 bg-gray-50 flex items-center gap-2 text-xs text-gray-500">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span id="user-address-text" class="truncate line-clamp-1">Menunggu izin lokasi...</span>
                </div>
            </div>

            {{-- Dynamic List Apotek --}}
            <div id="apotek-list-container" class="space-y-3">
                <!-- Skeleton Loading -->
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm flex gap-4 animate-pulse">
                    <div class="w-12 h-12 bg-gray-200 rounded-xl flex-shrink-0"></div>
                    <div class="flex-grow space-y-2">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

{{-- MODAL: Beli Obat (Lama dipertahankan) --}}
<div id="buyModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl space-y-5 my-8">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">Cari Apotek & Pesan</h2>
            <button onclick="closeBuyModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>

        <p class="text-sm text-gray-500">Pesan <strong id="modalMedName"></strong> dari apotek terdekat.</p>

        <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="medicine_id" id="modalMedId">
            <input type="hidden" name="latitude" id="modalLat">
            <input type="hidden" name="longitude" id="modalLng">
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Jumlah Obat</label>
                <input type="number" name="quantity" id="modalQuantity" min="1" value="1" onchange="updateTotal()" class="w-full border border-gray-200 rounded-xl p-2.5 text-sm focus:ring-[#0046A0] focus:border-[#0046A0]" required>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Lokasi Anda (Pengiriman)</label>
                <div id="picker-map" class="w-full h-40 rounded-xl border border-gray-200 mb-2 z-0"></div>
                <textarea name="address" id="modalAddress" rows="2" class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50 focus:ring-[#0046A0] focus:border-[#0046A0] resize-none" required readonly></textarea>
            </div>

            <div class="pt-3 border-t border-slate-100 flex justify-between items-center">
                <span class="text-sm font-bold text-gray-500">Total Harga:</span>
                <span id="modalTotalLabel" class="text-lg font-extrabold text-[#0046A0]">Rp 0</span>
            </div>

            <button type="submit" class="w-full bg-[#0046A0] text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition-all">
                Konfirmasi Pesanan
            </button>
        </form>
    </div>
</div>

{{-- MODAL: Peringatan Stok Habis --}}
<div id="outOfStockModal" class="fixed inset-0 z-[60] hidden flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl w-full max-w-sm p-6 shadow-2xl text-center space-y-4">
        <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900">Stok Obat Terbatas</h2>
        <p class="text-sm text-gray-500">Maaf, <strong id="warningMedName"></strong> saat ini sedang terbatas di apotek rekanan. Silakan hubungi admin.</p>
        <button onclick="closeOutOfStockModal()" class="w-full bg-red-500 text-white py-3 rounded-xl font-bold hover:bg-red-600 transition-all mt-4">
            Mengerti
        </button>
    </div>
</div>

{{-- Original Farmasi JS (untuk picker map & modal) --}}
<script src="{{ asset('js/farmasi.js') }}"></script>
{{-- Script Baru untuk Apotek Locator --}}
<script src="{{ asset('js/apotek-locator.js') }}"></script>

@endsection
