@extends('landing.layouts.app')
@section('content')
<div class="min-h-screen w-full flex flex-col md:flex-row bg-[#FAFAFA] font-sans antialiased">

    <div class="hidden md:flex md:w-1/2 bg-[#0046A0] relative items-center justify-center p-12 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-cover bg-center mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=1000');"></div>

        <div class="relative z-10 max-w-md text-center space-y-6 flex flex-col items-center">
            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-9 h-9 text-[#0046A0]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 6h-3V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h15c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-8-2h4v2h-4V4zm8 15H4V8h15v11z"/>
                    <path d="M10 11h4v2h-4zm2-2v6h-2v-6h2z"/>
                </svg>
            </div>

            <div class="space-y-2">
                <h2 class="text-4xl font-bold tracking-tight">Periksa.id</h2>
                <p class="text-lg text-blue-100 font-light tracking-wide">
                    Akses Kesehatan dalam Genggaman.
                </p>
            </div>

            <div class="pt-12 flex items-center gap-2 text-xs text-blue-200/90 font-medium">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                Sistem Rekam Medis Terintegrasi & Aman
            </div>
        </div>
    </div>

    <div class="w-full md:w-1/2 flex items-center justify-center p-8 sm:p-12 md:p-16 bg-white overflow-y-auto">
        <div class="w-full max-w-md space-y-6 py-8">

            <div class="space-y-2">
                <h3 class="text-3xl font-bold text-gray-900 tracking-tight">Daftar Akun Baru</h3>
                <p class="text-sm text-gray-400 font-medium">Lengkapi data diri Anda untuk membuat akun Periksa.id.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="space-y-1.5">
                    <label for="name" class="text-xs font-bold text-gray-700 tracking-wide">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border @error('name') border-red-500 focus:ring-red-200 focus:border-red-500 @else border-gray-200 focus:ring-[#0046A0]/20 focus:border-[#0046A0] @enderror rounded-xl text-sm focus:outline-none focus:ring-2 transition-all placeholder-gray-400 text-gray-700"
                            placeholder="Masukkan nama lengkap Anda">
                    </div>
                    @error('name')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-bold text-gray-700 tracking-wide">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border @error('email') border-red-500 focus:ring-red-200 focus:border-red-500 @else border-gray-200 focus:ring-[#0046A0]/20 focus:border-[#0046A0] @enderror rounded-xl text-sm focus:outline-none focus:ring-2 transition-all placeholder-gray-400 text-gray-700"
                            placeholder="Masukkan email aktif Anda">
                    </div>
                    @error('email')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="password" class="text-xs font-bold text-gray-700 tracking-wide">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="block w-full pl-11 pr-12 py-3 bg-gray-50 border @error('password') border-red-500 focus:ring-red-200 focus:border-red-500 @else border-gray-200 focus:ring-[#0046A0]/20 focus:border-[#0046A0] @enderror rounded-xl text-sm focus:outline-none focus:ring-2 transition-all placeholder-gray-400 text-gray-700"
                            placeholder="Buat kata sandi minimal 8 karakter">

                        <button type="button" onclick="toggleVisibility('password', 'eye-icon-pass')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-[#0046A0]">
                            <svg id="eye-icon-pass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="password_confirmation" class="text-xs font-bold text-gray-700 tracking-wide">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="block w-full pl-11 pr-12 py-3 bg-gray-50 border border-gray-200 focus:ring-[#0046A0]/20 focus:border-[#0046A0] rounded-xl text-sm focus:outline-none focus:ring-2 transition-all placeholder-gray-400 text-gray-700"
                            placeholder="Ulangi kata sandi Anda">

                        <button type="button" onclick="toggleVisibility('password_confirmation', 'eye-icon-confirm')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-[#0046A0]">
                            <svg id="eye-icon-confirm" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#0046A0] hover:bg-[#003780] text-white py-3 rounded-xl text-sm font-semibold tracking-wide shadow-md transition-all flex items-center justify-center gap-2 pt-2 mt-4">
                    Daftar Sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <div class="relative flex py-1 items-center">
                <div class="flex-grow border-t border-gray-100"></div>
                <span class="flex-shrink mx-4 text-xs text-gray-400 font-medium">Atau daftar dengan</span>
                <div class="flex-grow border-t border-gray-100"></div>
            </div>

            <p class="text-center text-xs text-gray-400 font-medium pt-2">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-[#0046A0] font-bold hover:underline">Masuk di sini</a>
            </p>

        </div>
    </div>
</div>


@endsection
