@extends('landing.layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative pt-24 pb-16 lg:pt-32 lg:pb-24 overflow-hidden bg-white">
    <div class="absolute inset-0 bg-blue-50/50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-extrabold text-[#0046A0] tracking-tight mb-6">
            Informasi Kesehatan Terkini
        </h1>
        <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
            Temukan artikel, tips, dan panduan kesehatan terpercaya langsung dari para ahli medis Periksa.id.
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter (Dummy) -->
        <div class="flex flex-wrap justify-center gap-3 mb-12" data-aos="fade-up" data-aos-delay="100">
            <button class="px-6 py-2.5 rounded-full bg-[#0046A0] text-white font-semibold text-sm shadow-md transition-all hover:shadow-lg">Semua</button>
            <button class="px-6 py-2.5 rounded-full bg-white text-gray-600 font-semibold text-sm border border-gray-200 transition-all hover:bg-gray-50 hover:text-[#0046A0]">Tips Sehat</button>
            <button class="px-6 py-2.5 rounded-full bg-white text-gray-600 font-semibold text-sm border border-gray-200 transition-all hover:bg-gray-50 hover:text-[#0046A0]">Gizi & Nutrisi</button>
            <button class="px-6 py-2.5 rounded-full bg-white text-gray-600 font-semibold text-sm border border-gray-200 transition-all hover:bg-gray-50 hover:text-[#0046A0]">Kesehatan Mental</button>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Article 1 -->
            <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group cursor-pointer" data-aos="fade-up" data-aos-delay="150">
                <div class="h-56 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1505576391880-b3f9d713dc4f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kesehatan Jantung" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-[#0046A0]">Tips Sehat</div>
                </div>
                <div class="p-6">
                    <div class="text-xs text-gray-400 font-medium mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        12 Okt 2023
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0046A0] transition-colors line-clamp-2">Cara Menjaga Kesehatan Jantung di Usia Muda</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">Menerapkan pola makan sehat dan berolahraga secara teratur adalah kunci utama untuk mencegah penyakit kardiovaskular sejak dini.</p>
                    <a href="#" class="inline-flex items-center text-[#0046A0] font-bold text-sm hover:underline">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </article>

            <!-- Article 2 -->
            <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                <div class="h-56 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Gizi Seimbang" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-[#0046A0]">Gizi & Nutrisi</div>
                </div>
                <div class="p-6">
                    <div class="text-xs text-gray-400 font-medium mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        10 Okt 2023
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0046A0] transition-colors line-clamp-2">Pentingnya Makanan Berserat untuk Pencernaan</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">Kekurangan serat bisa memicu masalah pencernaan. Ketahui makanan apa saja yang wajib Anda konsumsi setiap hari.</p>
                    <a href="#" class="inline-flex items-center text-[#0046A0] font-bold text-sm hover:underline">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </article>

            <!-- Article 3 -->
            <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group cursor-pointer" data-aos="fade-up" data-aos-delay="250">
                <div class="h-56 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kesehatan Mental" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-[#0046A0]">Kesehatan Mental</div>
                </div>
                <div class="p-6">
                    <div class="text-xs text-gray-400 font-medium mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        05 Okt 2023
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0046A0] transition-colors line-clamp-2">Mengelola Stres di Tengah Pekerjaan yang Padat</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">Stres berkepanjangan bisa berdampak buruk. Lakukan relaksasi dan meditasi sederhana ini di sela-sela jam kantor Anda.</p>
                    <a href="#" class="inline-flex items-center text-[#0046A0] font-bold text-sm hover:underline">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </article>

        </div>

    </div>
</section>
@endsection
