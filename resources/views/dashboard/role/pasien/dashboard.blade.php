@extends('dashboard.layouts.app')

@section('content')
  <!-- MAIN CONTENT CONTAINER -->
<div class="flex-1 p-8 md:p-10 space-y-8 overflow-y-auto">
    
    <!-- Welcome Header -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Halo, Budi! Bagaimana kesehatanmu hari ini?</h1>
        <p class="text-sm text-gray-500 mt-1.5 font-medium">Berikut adalah ringkasan aktivitas dan informasi kesehatan Anda.</p>
    </div>

    <!-- 2 Column Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- LEFT AREA: Medical Cards (Spans 2 columns) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card: Konsultasi Mendatang (Tanpa Video Call) -->
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5 font-bold text-gray-900 text-sm">
                        <svg class="w-5 h-5 text-[#0046A0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Konsultasi Mendatang</span>
                    </div>
                    <span class="bg-blue-50 text-[#0046A0] text-xs font-bold px-3 py-1 rounded-full">Hari Ini</span>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-1">
                    <div class="flex items-center gap-4">
                        <!-- Avatar Dokter -->
                        <div class="w-14 h-14 rounded-full bg-slate-200 border border-slate-100 overflow-hidden shrink-0">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=150&auto=format&fit=crop&q=80" alt="Dokter" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-0.5">
                            <h3 class="text-base font-bold text-gray-900">dr. Andi Hermawan</h3>
                            <p class="text-xs text-gray-500 font-medium">Spesialis Jantung & Pembuluh Darah</p>
                            <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium pt-0.5">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>14:00 - 14:30 WIB</span>
                            </div>
                        </div>
                    </div>
                    <!-- Ganti Tombol ke Detail Konsultasi (Sesuai Screenshot/Offline) -->
                    <button type="button" class="border-2 border-[#0046A0] text-[#0046A0] hover:bg-blue-50 font-bold text-xs uppercase tracking-wider px-5 py-3 rounded-xl transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Detail Konsultasi
                    </button>
                </div>
            </div>

            <!-- Quick Action 3 Grid Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Action 1 -->
                <div class="bg-white border border-slate-100 rounded-2xl p-5 text-center flex flex-col items-center justify-center space-y-3 cursor-pointer hover:shadow-md hover:border-blue-100 transition-all group">
                    <div class="w-11 h-11 rounded-full bg-blue-50 text-[#0046A0] flex items-center justify-center transition-all group-hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-gray-800 leading-tight">Booking Konsultasi Baru</span>
                </div>
                <!-- Action 2 -->
                <div class="bg-white border border-slate-100 rounded-2xl p-5 text-center flex flex-col items-center justify-center space-y-3 cursor-pointer hover:shadow-md hover:border-indigo-100 transition-all group">
                    <div class="w-11 h-11 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center transition-all group-hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-gray-800 leading-tight">Cek Gejala (AI)</span>
                </div>
                <!-- Action 3 -->
                <div class="bg-white border border-slate-100 rounded-2xl p-5 text-center flex flex-col items-center justify-center space-y-3 cursor-pointer hover:shadow-md hover:border-amber-100 transition-all group">
                    <div class="w-11 h-11 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center transition-all group-hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-gray-800 leading-tight">Pesan Obat</span>
                </div>
            </div>

            <!-- Section: Ringkasan Rekam Medis -->
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <h2 class="text-base font-bold text-gray-900">Ringkasan Rekam Medis</h2>
                    <a href="#" class="text-xs font-bold text-[#0046A0] hover:underline">Lihat Semua</a>
                </div>
                
                <div class="divide-y divide-slate-100">
                    <!-- List Item 1 -->
                    <div class="p-5 flex items-center justify-between gap-4 hover:bg-slate-50/50 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-slate-100 text-gray-500 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="text-sm font-bold text-gray-900">Hasil Lab: Cek Darah Lengkap</h4>
                                <p class="text-xs text-gray-400 font-medium">12 Okt 2023 • Lab Klinik Prodia</p>
                            </div>
                        </div>
                        <span class="bg-red-50 text-red-600 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wide">Perlu Perhatian</span>
                    </div>

                    <!-- List Item 2 -->
                    <div class="p-5 flex items-center justify-between gap-4 hover:bg-slate-50/50 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-slate-100 text-gray-500 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="text-sm font-bold text-gray-900">Resep: Amlodipine 5mg</h4>
                                <p class="text-xs text-gray-400 font-medium">10 Okt 2023 • dr. Andi Hermawan</p>
                            </div>
                        </div>
                        <span class="bg-emerald-50 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wide">Aktif</span>
                    </div>
                </div>
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
@endsection
