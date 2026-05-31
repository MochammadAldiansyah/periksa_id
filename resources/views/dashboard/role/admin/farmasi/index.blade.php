@extends('dashboard.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    {{-- ===== SECTION 1: Manajemen Obat (Admin CRUD) ===== --}}
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Farmasi</h1>
                <p class="text-sm text-gray-500">Kelola daftar obat, harga, stok, dan gambar.</p>
            </div>
            <a href="{{ route('admin.farmasi.create') }}" class="bg-[#0046A0] hover:bg-blue-800 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition-all">
                + Tambah Obat
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm flex items-center shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            <th class="py-4 px-6">Obat</th>
                            <th class="py-4 px-4">Harga</th>
                            <th class="py-4 px-4">Stok</th>
                            <th class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-sm">
                        @forelse($medicines as $med)
                            <tr class="hover:bg-slate-50/40 transition-all">
                                <td class="py-4 px-6 flex items-center gap-4">
                                    @if($med->image)
                                        <img src="{{ asset('storage/' . $med->image) }}" class="w-12 h-12 rounded object-cover border">
                                    @else
                                        <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-gray-400 border">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $med->name }}</div>
                                        <div class="text-xs text-gray-500 truncate w-48">{{ $med->description }}</div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 font-medium text-gray-900">Rp {{ number_format($med->price, 0, ',', '.') }}</td>
                                <td class="py-4 px-4">{{ $med->stock }}</td>
                                <td class="py-4 px-6 text-right flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.farmasi.edit', $med->id) }}" class="text-[#0046A0] font-bold hover:underline">Edit</a>
                                    <form action="{{ route('admin.farmasi.destroy', $med->id) }}" method="POST" onsubmit="return confirm('Hapus obat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 font-bold hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-400">Tidak ada obat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-5 border-t border-slate-50">
                {{ $medicines->links() }}
            </div>
        </div>
    </div>

    {{-- ===== SECTION 2: Katalog Obat + Apotek Terdekat (Desain Baru) ===== --}}
    <div class="border-t-2 border-dashed border-slate-200 pt-8">
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900">Pencarian Farmasi</h2>
                <p class="text-gray-500 mt-1">Lihat katalog obat publik dan cari apotek terdekat.</p>
            </div>
            <div class="relative w-full md:w-80">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <input type="text" placeholder="Cari nama obat..." class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-full bg-white focus:ring-[#0046A0] focus:border-[#0046A0] text-sm">
            </div>
        </div>

        {{-- Filter Pills --}}
        <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide mb-6">
            <button class="px-5 py-2 bg-[#0046A0] text-white rounded-full text-sm font-bold shadow-sm whitespace-nowrap">Semua Obat</button>
            <button class="px-5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-full text-sm font-bold whitespace-nowrap">Obat Resep</button>
            <button class="px-5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-full text-sm font-bold whitespace-nowrap">Obat Bebas</button>
            <button class="px-5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-full text-sm font-bold whitespace-nowrap">Vitamin & Suplemen</button>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Katalog Obat --}}
            <div class="flex-grow">
                <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2 mb-4">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Katalog Obat
                </h3>
                @if($medicines->isEmpty())
                    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
                        <h4 class="text-lg font-bold text-gray-900">Katalog Kosong</h4>
                        <p class="text-gray-500 mt-1">Belum ada daftar obat yang ditambahkan.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($medicines as $med)
                            @php
                                $stock = $med->stock;
                                $isHabis = $stock <= 0;
                                $isMenipis = $stock > 0 && $stock < 10;
                                
                                if ($isHabis) {
                                    $stockText = 'Stok Habis';
                                    $stockColor = 'text-red-600';
                                } elseif ($isMenipis) {
                                    $stockText = 'Menipis (Sisa ' . $stock . ')';
                                    $stockColor = 'text-orange-500';
                                } else {
                                    $stockText = 'Tersedia (Sisa ' . $stock . ')';
                                    $stockColor = 'text-[#0046A0]';
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
                                    @if($isHabis)
                                    <div class="absolute inset-0 bg-white/60 flex items-center justify-center backdrop-blur-[2px]">
                                        <span class="bg-red-50 px-4 py-1.5 rounded-full text-red-600 text-xs font-bold shadow-sm border border-red-200">Stok Habis</span>
                                    </div>
                                    @elseif($isMenipis)
                                    <div class="absolute inset-0 bg-white/40 flex items-center justify-center backdrop-blur-[1px]">
                                        <span class="bg-white px-4 py-1.5 rounded-full text-orange-500 text-xs font-bold shadow-sm border border-orange-100">Stok Menipis (Sisa {{ $stock }})</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="p-4 flex flex-col flex-grow">
                                    <h4 class="font-bold text-gray-900 leading-tight mb-1">{{ $med->name }}</h4>
                                    <p class="text-[11px] text-gray-500 mb-3 truncate">{{ $med->description ?: 'Generik' }}</p>
                                    <div class="flex items-center justify-between mt-auto">
                                        <span class="font-extrabold text-gray-900 text-lg">Rp {{ number_format($med->price, 0, ',', '.') }}</span>
                                        <span class="flex items-center gap-1 text-xs font-bold {{ $stockColor }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                            {{ $stockText }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Apotek Terdekat --}}
            <div class="w-full lg:w-[22rem] xl:w-[26rem] flex-shrink-0 space-y-5">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Apotek Terdekat
                    </h3>
                    <a href="#" class="text-sm font-bold text-[#0046A0] hover:underline">Lihat Peta</a>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                        <h4 class="font-bold text-gray-900">Lokasi Saat Ini</h4>
                        <button onclick="requestGeolocation()" class="text-[#0046A0] hover:bg-blue-50 p-1.5 rounded-full transition-colors" title="Perbarui Lokasi">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </button>
                    </div>
                    <div id="apotek-map" class="w-full h-48 bg-gray-100 relative z-0 flex items-center justify-center">
                        <div class="text-center p-4">
                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <p class="text-sm text-gray-500 font-medium" id="map-status-text">Meminta izin lokasi...</p>
                            <button onclick="requestGeolocation()" id="btn-request-location" class="mt-2 text-xs font-bold text-[#0046A0] hidden border border-[#0046A0] px-3 py-1 rounded-full">Izinkan Akses Lokasi</button>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-50 flex items-center gap-2 text-xs text-gray-500">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span id="user-address-text" class="truncate">Menunggu izin lokasi...</span>
                    </div>
                </div>
                <div id="apotek-list-container" class="space-y-3">
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

</div>

{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('js/apotek-locator.js') }}"></script>

@endsection
