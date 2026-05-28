@extends('dashboard.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    {{-- Header --}}
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden">
        <div class="relative z-10 max-w-2xl">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Pesan Obat & Farmasi</h1>
            <p class="text-gray-500">Temukan dan pesan obat sesuai kebutuhan resep medis Anda dengan mudah.</p>
        </div>
        <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-gradient-to-l from-blue-50 to-transparent hidden md:block"></div>
    </div>

    {{-- Daftar Obat / Katalog --}}
    <div>
        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-[#0046A0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            Katalog Obat
        </h2>

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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($medicines as $med)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-lg transition-all group flex flex-col">
                        <div class="aspect-[4/3] bg-gray-50 relative overflow-hidden">
                            @if($med->image)
                                <img src="{{ asset('storage/' . $med->image) }}" alt="{{ $med->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-700 shadow-sm">
                                Stok: {{ $med->stock }}
                            </div>
                        </div>
                        
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-bold text-lg text-gray-900 mb-1 truncate" title="{{ $med->name }}">{{ $med->name }}</h3>
                            <p class="text-xs text-gray-500 line-clamp-2 mb-4 flex-grow">{{ $med->description }}</p>
                            
                            <div class="flex items-center justify-between mt-auto">
                                <div class="font-extrabold text-[#0046A0] text-lg">
                                    Rp {{ number_format($med->price, 0, ',', '.') }}
                                </div>
                                
                                @hasrole('pasien')
                                    <button onclick="openBuyModal({{ $med->id }}, '{{ addslashes($med->name) }}', {{ $med->price }}, {{ $med->stock }})" class="bg-[#0046A0] hover:bg-blue-800 text-white px-4 py-2 rounded-xl text-sm font-bold transition-colors">
                                        Beli
                                    </button>
                                @endhasrole
                                
                                @hasrole('dokter')
                                    <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-bold transition-colors">
                                        Rekomendasikan
                                    </button>
                                @endhasrole
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

{{-- MODAL: Beli Obat --}}
<div id="buyModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl space-y-5 my-8">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">Konfirmasi Pembelian</h2>
            <button onclick="closeBuyModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>

        <p class="text-sm text-gray-500">Beli <strong id="modalMedName"></strong></p>

        <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="medicine_id" id="modalMedId">
            <input type="hidden" name="latitude" id="modalLat">
            <input type="hidden" name="longitude" id="modalLng">
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Jumlah</label>
                <input type="number" name="quantity" id="modalQuantity" min="1" value="1" onchange="updateTotal()" class="w-full border border-gray-200 rounded-xl p-2.5 text-sm focus:ring-[#0046A0] focus:border-[#0046A0]" required>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Pilih Lokasi Pengiriman</label>
                <p class="text-xs text-gray-500 mb-2">Geser atau klik peta untuk menentukan lokasi tujuan pengiriman Anda.</p>
                <div id="picker-map" class="w-full h-48 rounded-xl border border-gray-200 mb-2 z-0"></div>
                <textarea name="address" id="modalAddress" rows="2" placeholder="Alamat akan terisi otomatis dari peta..." class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50 focus:ring-[#0046A0] focus:border-[#0046A0] resize-none" required readonly></textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Metode Pembayaran</label>
                <div class="w-full border border-gray-200 bg-gray-50 rounded-xl p-3 text-sm font-bold text-gray-700">
                    COD (Cash on Delivery)
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 flex justify-between items-center">
                <span class="text-sm font-bold text-gray-500">Total Harga:</span>
                <span id="modalTotalLabel" class="text-lg font-extrabold text-[#0046A0]">Rp 0</span>
            </div>

            <button type="submit" class="w-full bg-[#0046A0] text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition-all">
                Pesan Sekarang
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
        <h2 class="text-xl font-bold text-gray-900">Stok Obat Habis</h2>
        <p class="text-sm text-gray-500">Maaf, <strong id="warningMedName"></strong> saat ini sedang tidak tersedia. Silakan cek kembali nanti atau hubungi apoteker.</p>
        <button onclick="closeOutOfStockModal()" class="w-full bg-red-500 text-white py-3 rounded-xl font-bold hover:bg-red-600 transition-all mt-4">
            Mengerti
        </button>
    </div>
</div>

<script src="{{ asset('js/farmasi.js') }}"></script>

@endsection
