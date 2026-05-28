@extends('dashboard.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Manajemen Dokter</h1>
        <p class="text-sm text-gray-500 mt-1">Daftarkan akun dokter baru ke dalam ekosistem Periksa.id</p>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8 md:p-10 transition-all">

        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-slate-100">
            <div class="w-12 h-12 bg-blue-50 text-[#0046A0] rounded-2xl flex items-center justify-center shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900">Tambah Dokter Baru</h2>
                <p class="text-xs text-gray-400">Pastikan alamat email unik dan belum terdaftar</p>
            </div>
        </div>

        {{-- Alert jika sukses menyimpan data --}}
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-800 px-4 py-3.5 rounded-xl text-sm" role="alert">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <strong class="font-semibold">Sukses!</strong> {{ session('success') }}
                </div>
            </div>
        @endif

        {{-- Alert jika ada error validasi input global --}}
        @if ($errors->any())
            <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-800 px-5 py-4 rounded-xl text-sm">
                <div class="flex items-center gap-2 mb-2 font-semibold text-rose-900">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span>Periksa Kembali Isian Anda:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-rose-700 ml-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.dokter.store') }}">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Dokter</label>
                    <input type="text" name="name" id="name"
                        class="w-full bg-slate-50/50 border @error('name') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @else border-slate-200 focus:border-[#0046A0] focus:ring-blue-100 @enderror focus:bg-white focus:ring-4 rounded-xl px-4 py-3 text-sm text-gray-800 font-medium placeholder-gray-400 transition-all outline-none"
                        value="{{ old('name') }}" placeholder="Masukkan nama lengkap dokter beserta gelar" required>
                    @error('name')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full bg-slate-50/50 border @error('email') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @else border-slate-200 focus:border-[#0046A0] focus:ring-blue-100 @enderror focus:bg-white focus:ring-4 rounded-xl px-4 py-3 text-sm text-gray-800 font-medium placeholder-gray-400 transition-all outline-none"
                        value="{{ old('email') }}" placeholder="contoh: dokter@periksa.id" required>
                    @error('email')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Password Awal</label>
                    <input type="password" name="password" id="password"
                        class="w-full bg-slate-50/50 border @error('password') border-rose-400 focus:border-rose-500 focus:ring-rose-100 @else border-slate-200 focus:border-[#0046A0] focus:ring-blue-100 @enderror focus:bg-white focus:ring-4 rounded-xl px-4 py-3 text-sm text-gray-800 font-medium placeholder-gray-400 transition-all outline-none"
                        placeholder="Minimal 8 karakter" required>
                    <p class="text-xs text-gray-400 mt-2 leading-relaxed">Berikan password sementara ini kepada dokter yang bersangkutan untuk login pertama kali.</p>
                    @error('password')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end pt-4 border-t border-slate-100 mt-8">
                    <button type="submit" class="w-full md:w-auto bg-[#0046A0] hover:bg-[#003780] text-white px-6 py-3 rounded-xl font-semibold text-sm shadow-md shadow-blue-100 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        Simpan Dokter
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
