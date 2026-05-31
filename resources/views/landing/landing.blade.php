@extends('landing.layouts.app')

@section('content')
  {{-- HERO SECTION --}}
  <section class="max-w-7xl mx-auto px-6 lg:px-8 pt-16 pb-20 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
    <div class="space-y-7">
      <span class="inline-flex items-center gap-2  text-[#0046A0] text-xs font-bold px-4 py-2 rounded-full tracking-wide">
        <span class="w-2 h-2 bg-[#0046A0] rounded-full animate-pulse"></span>
        Platform Kesehatan #1 di Indonesia
      </span>
      <h1 class="text-4xl lg:text-[3.25rem] font-extrabold text-gray-900 leading-[1.1] tracking-tight">
        Layanan Kesehatan <span class="text-[#0046A0]">Digital</span> Terpercaya untuk Anda & Keluarga
      </h1>
      <p class="text-gray-500 text-sm lg:text-base leading-relaxed max-w-lg">
        Dapatkan akses instan ke dokter spesialis, beli obat dengan resep digital, dan cek gejala menggunakan AI — semua dari kenyamanan rumah Anda.
      </p>
      <div class="flex flex-wrap gap-4 pt-1">
        @auth
          <a href="{{ route('dashboard') }}" class="bg-[#0046A0] hover:bg-[#003780] text-white px-6 py-3.5 rounded-2xl font-semibold text-sm flex items-center gap-2.5 shadow-lg shadow-blue-200/50 transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            Mulai Konsultasi
          </a>
        @else
          <a href="{{ route('register') }}" class="bg-[#0046A0] hover:bg-[#003780] text-white px-6 py-3.5 rounded-2xl font-semibold text-sm flex items-center gap-2.5 shadow-lg shadow-blue-200/50 transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            Mulai Konsultasi
          </a>
        @endauth
        <a href="{{ route('cari-dokter.index') }}" class="bg-white border-2 border-slate-200 hover:border-[#0046A0] text-gray-700 hover:text-[#0046A0] px-6 py-3.5 rounded-2xl font-semibold text-sm flex items-center gap-2.5 transition-all hover:-translate-y-0.5">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
          Cari Dokter
        </a>
      </div>
      <div class="flex items-center gap-4 pt-3">
        <div class="flex -space-x-2.5">
          <div class="w-9 h-9 rounded-full bg-blue-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-blue-700">DR</div>
          <div class="w-9 h-9 rounded-full bg-indigo-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-indigo-700">AN</div>
          <div class="w-9 h-9 rounded-full bg-emerald-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-emerald-700">SP</div>
          <div class="w-9 h-9 rounded-full bg-amber-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-amber-700">+</div>
        </div>
        <div>
          <div class="flex text-amber-400 text-xs gap-0.5">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
          </div>
          <p class="text-xs text-gray-400 font-medium mt-0.5">Dipercaya oleh <span class="font-bold text-gray-600">1 Juta+</span> Pasien</p>
        </div>
      </div>
      </div>
    </div>
  </section>

  {{-- STATS BAR --}}
  <section class=" border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
      <div class="space-y-1">
        <div class="w-12 h-12  text-[#0046A0] rounded-2xl flex items-center justify-center mx-auto mb-2">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </div>
        <h3 class="text-3xl font-extrabold text-gray-900">500+</h3>
        <p class="text-xs text-gray-400 font-semibold">Dokter Spesialis</p>
      </div>
      <div class="space-y-1">
        <div class="w-12 h-12 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-2">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
        </div>
        <h3 class="text-3xl font-extrabold text-gray-900">1M+</h3>
        <p class="text-xs text-gray-400 font-semibold">Pasien Terlayani</p>
      </div>
      <div class="space-y-1">
        <div class="w-12 h-12  text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-2">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
        <h3 class="text-3xl font-extrabold text-gray-900">100+</h3>
        <p class="text-xs text-gray-400 font-semibold">Mitra Apotek</p>
      </div>
      <div class="space-y-1">
        <div class="w-12 h-12  text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-2">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
        </div>
        <h3 class="text-3xl font-extrabold text-gray-900">4.9/5</h3>
        <p class="text-xs text-gray-400 font-semibold">Rating Aplikasi</p>
      </div>
    </div>
  </section>

  {{-- SERVICES SECTION --}}
  <section class="max-w-7xl mx-auto px-6 lg:px-8 py-24">
    <div class="text-center max-w-xl mx-auto space-y-3 mb-16">
      <span class="inline-flex items-center gap-1.5 text-indigo-600 text-[11px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Fitur Unggulan</span>
      <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 tracking-tight">Layanan Terpadu dalam Satu Genggaman</h2>
      <p class="text-sm text-gray-400 leading-relaxed">Solusi kesehatan digital yang dirancang untuk kecepatan, akurasi, dan kenyamanan Anda.</p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      {{-- Card 1: Chat Dokter 24/7 (Large) --}}
      <div class="lg:col-span-2 bg-white rounded-3xl p-8 border border-gray-100 shadow-sm flex flex-col md:flex-row gap-8 justify-between overflow-hidden relative group hover:shadow-lg transition-shadow">
        <div class="space-y-5 max-w-sm flex flex-col justify-between">
          <div class="space-y-4">
            <div class="w-12 h-12 text-[#0046A0] rounded-2xl flex items-center justify-center">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900">Chat Dokter 24/7</h3>
            <p class="text-sm text-gray-400 leading-relaxed"> Konsultasi kesehatan langsung dengan dokter umum atau spesialis lewat pesan teks aman. Kirim foto gejala atau hasil laboratorium tanpa perlu keluar rumah. </p>
          </div>
          <a href="{{ route('cari-dokter.index') }}" class="text-sm font-bold text-[#0046A0] flex items-center gap-2 hover:gap-3 transition-all pt-2 group/link">
            Cari Dokter Sekarang
            <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path></svg>
          </a>
        </div>
        {{-- Phone Mockup --}}
        <div class="w-full md:w-[300px] shrink-0 flex items-center justify-center p-4">
          <img src="{{ asset('assets/images/mockup.png') }}" alt="Aplikasi Periksa.id" class="w-full h-auto drop-shadow-2xl group-hover:scale-105 transition-transform duration-500 object-contain">
        </div>
      </div>

      {{-- Card 2: AI Symptom Checker --}}
      <div class="bg-gradient-to-b from-indigo-50 to-white rounded-3xl p-8 border border-indigo-100/80 shadow-sm flex flex-col justify-between group hover:shadow-lg transition-shadow">
        <div class="space-y-4">
          <div class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
          </div>
          <h3 class="text-xl font-extrabold text-gray-900">AI Symptom Checker</h3>
          <p class="text-sm text-gray-400 leading-relaxed">Cek gejala awal penyakit Anda dengan bantuan kecerdasan buatan sebelum berkonsultasi dengan dokter.</p>
        </div>
        @auth
          <a href="{{ route('pasien.ai.index') }}" class="block w-full mt-8 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-2xl text-sm transition-colors text-center shadow-sm">Coba Sekarang</a>
        @else
          <a href="{{ route('login') }}" class="block w-full mt-8 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-2xl text-sm transition-colors text-center shadow-sm">Coba Sekarang</a>
        @endauth
      </div>

      {{-- Card 3: Resep Digital --}}
      <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm space-y-4 group hover:shadow-lg transition-shadow">
        <div class="w-12 h-12  text-emerald-600 rounded-2xl flex items-center justify-center">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
        </div>
        <h3 class="text-lg font-extrabold text-gray-900">Resep & Obat Digital</h3>
        <p class="text-sm text-gray-400 leading-relaxed">Tebus resep obat secara digital dan nikmati pengiriman langsung ke alamat rumah Anda dalam hitungan jam.</p>
      </div>

      {{-- Card 4: Forum Kesehatan --}}
      <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm space-y-4 group hover:shadow-lg transition-shadow">
        <div class="w-12 h-12  text-amber-600 rounded-2xl flex items-center justify-center">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
        </div>
        <h3 class="text-lg font-extrabold text-gray-900">Forum Kesehatan</h3>
        <p class="text-sm text-gray-400 leading-relaxed">Diskusikan topik kesehatan dengan komunitas dan dapatkan wawasan dari dokter profesional.</p>
      </div>

      {{-- Card 5: Integrasi Peta --}}
      <div class="bg-[#0046A0] rounded-3xl p-7 text-white shadow-sm flex flex-col justify-between relative overflow-hidden group hover:shadow-lg transition-shadow">
        <div class="space-y-4 z-10">
        <div class="w-12 h-12 bg-white/15 backdrop-blur-sm rounded-2xl flex items-center justify-center">
  <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0z" />
  </svg>
</div>

          <h3 class="text-lg font-extrabold">Integrasi Peta Rumah Sakit</h3>
          <p class="text-sm text-blue-100 leading-relaxed opacity-90">Kini Periksa.id mendukung Map Rumah Sakit Di Sekitar Anda Secara Realtime.</p>
        </div>
        <a href="{{ route('rumah-sakit') }}" class="text-sm font-bold flex items-center gap-2 mt-6 z-10 text-white hover:underline group/link">
          Cek Sekarang
          <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path></svg>
        </a>
        <div class="absolute -bottom-8 -right-8 text-blue-800 opacity-10 transform group-hover:scale-110 transition-transform duration-500">
          <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
      </div>
    </div>
  </section>

  {{-- TESTIMONIALS --}}
  <section class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
    <div class="bg-gradient-to-br from-slate-50 to-white rounded-3xl border border-gray-100 px-8 py-14">
      <div class="text-center space-y-3 mb-12">
        <span class="inline-flex items-center gap-1.5 text-emerald-600 text-[11px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Testimoni</span>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dipercaya oleh Masyarakat Indonesia</h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Testimonial 1 --}}
        <div class="bg-white p-7 rounded-2xl border border-gray-100 shadow-sm space-y-5 hover:shadow-md transition-shadow">
          <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl text-blue-700 flex items-center justify-center font-bold text-sm">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
              <h4 class="text-sm font-bold text-gray-800">Ahmad S.</h4>
              <div class="flex text-amber-400 gap-0.5 mt-0.5">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
              </div>
            </div>
          </div>
          <p class="text-sm text-gray-500 italic leading-relaxed">"Sangat membantu saat anak demam tengah malam. Dokter spesialis anak merespon cepat dan obat langsung diantar 1 jam kemudian."</p>
        </div>

        {{-- Testimonial 2 --}}
        <div class="bg-white p-7 rounded-2xl border border-gray-100 shadow-sm space-y-5 hover:shadow-md transition-shadow">
          <div class="flex items-center gap-3">
            <div class="w-11 h-11  rounded-xl text-purple-700 flex items-center justify-center font-bold text-sm">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
              <h4 class="text-sm font-bold text-gray-800">Rina M.</h4>
              <div class="flex text-amber-400 gap-0.5 mt-0.5">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
              </div>
            </div>
          </div>
          <p class="text-sm text-gray-500 italic leading-relaxed">"AI Symptom Checker-nya luar biasa akurat. Memberikan gambaran awal yang jelas sebelum saya memutuskan konsultasi ke dokter kulit."</p>
        </div>

        {{-- Testimonial 3 --}}
        <div class="bg-white p-7 rounded-2xl border border-gray-100 shadow-sm space-y-5 hover:shadow-md transition-shadow">
          <div class="flex items-center gap-3">
            <div class="w-11 h-11  rounded-xl text-emerald-700 flex items-center justify-center font-bold text-sm">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
              <h4 class="text-sm font-bold text-gray-800">Budi T.</h4>
              <div class="flex text-amber-400 gap-0.5 mt-0.5">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
              </div>
            </div>
          </div>
          <p class="text-sm text-gray-500 italic leading-relaxed">"UI aplikasinya bersih dan tidak membingungkan untuk orang tua seperti saya. Proses pembayaran juga mendukung bank lokal."</p>
        </div>
      </div>
    </div>
  </section>

  {{-- CTA SECTION --}}
  <section class="max-w-7xl mx-auto px-6 lg:px-8 pb-24">
    <div class="bg-gradient-to-r from-[#0046A0] to-indigo-600 rounded-3xl p-10 md:p-16 flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">
      <div class="space-y-4 z-10">
        <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Mulai Perjalanan Kesehatan Digital Anda</h2>
        <p class="text-sm text-blue-100 leading-relaxed max-w-lg">Daftar sekarang dan dapatkan konsultasi pertama Anda secara gratis bersama dokter spesialis pilihan.</p>
      </div>
      <a href="{{ route('register') }}" class="bg-white text-[#0046A0] font-bold px-8 py-4 rounded-2xl text-sm hover:bg-blue-50 transition-colors shadow-lg z-10 whitespace-nowrap shrink-0">
        Daftar Gratis Sekarang
      </a>
      {{-- Background Decoration --}}
      <div class="absolute -top-12 -right-12 opacity-10">
        <svg class="w-64 h-64" fill="white" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      </div>
      <div class="absolute -bottom-16 -left-16 opacity-10">
        <svg class="w-48 h-48" fill="white" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
      </div>
    </div>
  </section>
@endsection
