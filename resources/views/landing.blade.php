@extends('layouts.app')

@section('content')
<section class="max-w-7xl mx-auto px-6 lg:px-8 pt-12 pb-16 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
    <div class="space-y-6">
      <span class="inline-flex items-center gap-1.5 bg-blue-50 text-[#0046A0] text-xs font-semibold px-3 py-1.5 rounded-full">
        <span class="w-1.5 h-1.5 bg-[#0046A0] rounded-full animate-pulse"></span>
        Platform Kesehatan #1 di Indonesia
      </span>
      <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-[1.15]">
        Layanan Kesehatan Digital Terpercaya untuk Anda & Keluarga
      </h1>
      <p class="text-gray-500 text-sm lg:text-base leading-relaxed max-w-lg">
        Dapatkan akses instan ke ribuan dokter spesialis, beli obat dengan resep digital, dan jadwalkan tes lab dari kenyamanan rumah Anda.
      </p>
      <div class="flex flex-wrap gap-4 pt-2">
        <button class="bg-[#0046A0] hover:bg-[#003780] text-white px-5 py-3 rounded-xl font-medium text-sm flex items-center gap-2 shadow-md transition-all">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
          Mulai Konsultasi
        </button>
        <button class="bg-[#6366F1] hover:bg-[#4F46E5] text-white px-5 py-3 rounded-xl font-medium text-sm flex items-center gap-2 shadow-md transition-all">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
          Cek Gejala AI
        </button>
      </div>
      <div class="flex items-center gap-3 pt-4">
        <div class="flex -space-x-2">
          <div class="w-8 h-8 rounded-full bg-gray-300 border-2 border-white flex items-center justify-center text-[10px] font-bold">DR</div>
          <div class="w-8 h-8 rounded-full bg-blue-300 border-2 border-white flex items-center justify-center text-[10px] font-bold">AN</div>
          <div class="w-8 h-8 rounded-full bg-indigo-300 border-2 border-white flex items-center justify-center text-[10px] font-bold">SP</div>
        </div>
        <div>
          <div class="flex text-amber-400 text-xs">★★★★★</div>
          <p class="text-xs text-gray-400 font-medium">Dipercaya oleh 1M+ Pasien</p>
        </div>
      </div>
    </div>
    <div class="relative flex justify-center lg:justify-end">
      <div class="relative w-full max-w-[420px] aspect-[4/5] bg-gradient-to-tr from-blue-100 to-indigo-50 rounded-3xl overflow-hidden shadow-xl border border-white">
        <div class="absolute inset-0 flex flex-col justify-end p-8 bg-gradient-to-t from-black/40 via-transparent to-transparent">
          <div class="w-full h-full flex items-center justify-center text-gray-400 font-medium italic text-sm">[ Foto Dokter Utama ]</div>
        </div>
      </div>
      <div class="absolute bottom-6 left-4 lg:-left-6 bg-white/95 backdrop-blur px-4 py-3 rounded-2xl shadow-lg border border-gray-100 flex items-center gap-3">
        <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div>
          <h4 class="text-xs font-bold text-gray-800">Dokter Tersedia</h4>
          <p class="text-[10px] text-gray-400">Konsultasi dalam 3 menit</p>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
      <div><h3 class="text-3xl font-extrabold text-[#0046A0]">500+</h3><p class="text-xs text-gray-400 mt-1 font-medium">Dokter Spesialis</p></div>
      <div><h3 class="text-3xl font-extrabold text-[#0046A0]">1M+</h3><p class="text-xs text-gray-400 mt-1 font-medium">Pasien Terlayani</p></div>
      <div><h3 class="text-3xl font-extrabold text-[#0046A0]">100+</h3><p class="text-xs text-gray-400 mt-1 font-medium">Mitra Apotek</p></div>
      <div><h3 class="text-3xl font-extrabold text-[#0046A0]">4.9/5</h3><p class="text-xs text-gray-400 mt-1 font-medium">Rating Aplikasi</p></div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
    <div class="text-center max-w-xl mx-auto space-y-2 mb-16">
      <h2 class="text-2xl lg:text-3xl font-bold text-gray-900">Layanan Terpadu dalam Satu Genggaman</h2>
      <p class="text-xs lg:text-sm text-gray-400 leading-relaxed">Solusi kesehatan digital yang dirancang untuk kecepatan, akurasi, dan kenyamanan Anda.</p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 bg-white rounded-3xl p-8 border border-gray-100 shadow-sm flex flex-col md:flex-row gap-8 justify-between overflow-hidden relative">
        <div class="space-y-4 max-w-sm flex flex-col justify-between">
          <div class="space-y-4">
            <div class="w-10 h-10 bg-blue-50 text-[#0046A0] rounded-xl flex items-center justify-center">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Konsultasi Online</h3>
            <p class="text-xs text-gray-400 leading-relaxed">Tatap muka langsung dengan dokter umum maupun spesialis melalui video call aman. Diagnosa cepat dan akurat tanpa perlu antre di klinik.</p>
          </div>
          <a href="#" class="text-xs font-semibold text-[#0046A0] flex items-center gap-1.5 hover:gap-2.5 transition-all pt-4">Pelajari lebih lanjut &rarr;</a>
        </div>
        <div class="w-full md:w-56 h-56 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 font-medium text-xs border border-emerald-100 shrink-0">[ Ilustrasi HP ]</div>
      </div>
      <div class="bg-gradient-to-b from-purple-50 to-white rounded-3xl p-8 border border-purple-100 shadow-sm flex flex-col justify-between">
        <div class="space-y-4">
          <div class="w-10 h-10 bg-purple-500 text-white rounded-xl flex items-center justify-center shadow-md shadow-purple-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900">AI Symptom Checker</h3>
          <p class="text-xs text-gray-400 leading-relaxed">Cek gejala awal penyakit Anda dengan bantuan kecerdasan buatan sebelum berkonsultasi.</p>
        </div>
        <button class="w-full mt-8 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-xl text-xs transition-colors">Coba Sekarang</button>
      </div>
      <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm space-y-3">
        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
        </div>
        <h3 class="text-base font-bold text-gray-900">Resep Digital</h3>
        <p class="text-xs text-gray-400 leading-relaxed">Tebus resep obat secara digital dan nikmati pengiriman langsung ke alamat rumah Anda dalam hitungan jam.</p>
      </div>
      <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm space-y-3">
        <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <h3 class="text-base font-bold text-gray-900">Lab Booking</h3>
        <p class="text-xs text-gray-400 leading-relaxed">Jadwalkan pemeriksaan laboratorium di klinik mitra terdekat dengan mudah tanpa antrean panjang.</p>
      </div>
      <div class="bg-[#0046A0] rounded-3xl p-6 text-white shadow-sm flex flex-col justify-between relative overflow-hidden group">
        <div class="space-y-3 z-10">
          <h3 class="text-base font-bold">Integrasi BPJS</h3>
          <p class="text-xs text-blue-100 leading-relaxed opacity-90">Kini Periksa.id mendukung klaim BPJS Kesehatan untuk layanan tertentu di klinik mitra.</p>
        </div>
        <a href="#" class="text-xs font-semibold flex items-center gap-1.5 mt-6 z-10 text-white hover:underline">Cek Ketentuan &rarr;</a>
        <div class="absolute -bottom-6 -right-6 text-blue-800 opacity-20 transform group-hover:scale-110 transition-transform duration-300">
          <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-6 lg:px-8 py-12 bg-gray-50/50 rounded-3xl border border-gray-100">
    <div class="text-center space-y-2 mb-12"><h2 class="text-2xl font-bold text-gray-900">Dipercaya oleh Masyarakat Indonesia</h2></div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-blue-600 rounded-full text-white flex items-center justify-center font-bold text-sm">A</div>
          <div><h4 class="text-xs font-bold text-gray-800">Ahmad S.</h4><div class="text-amber-400 text-[10px]">★★★★★</div></div>
        </div>
        <p class="text-xs text-gray-500 italic leading-relaxed">"Sangat membantu saat anak demam tengah malam. Dokter spesialis anak merespon cepat dan obat langsung diantar 1 jam kemudian."</p>
      </div>
      <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-purple-600 rounded-full text-white flex items-center justify-center font-bold text-sm">R</div>
          <div><h4 class="text-xs font-bold text-gray-800">Rina M.</h4><div class="text-amber-400 text-[10px]">★★★★★</div></div>
        </div>
        <p class="text-xs text-gray-500 italic leading-relaxed">"AI Symptom Checker-nya luar biasa akurat. Memberikan gambaran awal yang jelas sebelum saya memutuskan konsultasi ke dokter kulit."</p>
      </div>
      <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-emerald-600 rounded-full text-white flex items-center justify-center font-bold text-sm">B</div>
          <div><h4 class="text-xs font-bold text-gray-800">Budi T.</h4><div class="text-amber-400 text-[10px]">★★★★★</div></div>
        </div>
        <p class="text-xs text-gray-500 italic leading-relaxed">"UI aplikasinya bersih dan tidak membingungkan untuk orang tua seperti saya. Proses pembayaran juga mendukung bank lokal."</p>
      </div>
    </div>
  </section>
@endsection
