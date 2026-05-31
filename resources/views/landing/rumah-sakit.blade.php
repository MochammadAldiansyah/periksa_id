@extends('landing.layouts.app')

@section('content')
<div class="bg-slate-50 pt-24 min-h-screen">
    <div class="container mx-auto px-6 py-8 h-[calc(100vh-6rem)]">

        <div class="flex flex-col lg:flex-row h-full gap-6">

            {{-- Sidebar List --}}
            <div class="w-full lg:w-1/3 bg-white rounded-2xl shadow-sm border border-slate-100 flex flex-col overflow-hidden h-[50vh] lg:h-full shrink-0">
                <div class="p-5 border-b border-slate-100 shrink-0">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">Rumah Sakit Terdekat</h2>
                    <p class="text-sm text-gray-500 mb-4" id="location-status">Mendeteksi lokasi Anda...</p>

                    <div class="relative">
                        <input type="text" id="hospital-search" placeholder="Cari nama fasilitas..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-[#0046A0] focus:border-[#0046A0]">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-3" id="hospitals-list">
                    {{-- Skeleton Loader --}}
                    <div class="animate-pulse space-y-4" id="skeleton-loader">
                        @for($i = 0; $i < 4; $i++)
                        <div class="flex gap-3">
                            <div class="w-12 h-12 bg-slate-200 rounded-xl shrink-0"></div>
                            <div class="flex-1 space-y-2 py-1">
                                <div class="h-4 bg-slate-200 rounded w-3/4"></div>
                                <div class="h-3 bg-slate-200 rounded w-1/2"></div>
                            </div>
                        </div>
                        @endfor
                    </div>

                    {{-- Dynamic content will be loaded here via JS --}}
                </div>
            </div>

            {{-- Map Area --}}
            <div class="w-full lg:w-2/3 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden h-[50vh] lg:h-full relative">

                {{-- Permission Overlay --}}
                <div id="permission-overlay" class="absolute inset-0 z-[1000] bg-white/90 backdrop-blur-sm flex flex-col items-center justify-center text-center p-6 transition-opacity duration-300">
                    <div class="w-16 h-16 bg-blue-100 text-[#0046A0] rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Akses Lokasi Diperlukan</h3>
                    <p class="text-gray-500 max-w-sm mb-6">Kami butuh izin akses lokasi GPS (Location) Anda untuk mencari rumah sakit atau fasilitas kesehatan terdekat.</p>
                    <button id="btn-grant-location" class="bg-[#0046A0] hover:bg-blue-800 text-white px-6 py-2.5 rounded-xl font-semibold transition-all">
                        Izinkan Akses Lokasi
                    </button>
                </div>

                {{-- The Map --}}
                <div id="hospital-map" class="w-full h-full z-0"></div>

            </div>

        </div>
    </div>
</div>

{{-- Leaflet CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('js/rumah-sakit.js') }}"></script>
@endpush
