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

    <div class="w-full md:w-1/2 flex items-center justify-center p-8 sm:p-12 md:p-16 bg-white">
        <div class="w-full max-w-md space-y-8">

            <div class="space-y-2">
                <h3 class="text-3xl font-bold text-gray-900 tracking-tight">Selamat Datang</h3>
                <p class="text-sm text-gray-400 font-medium">Silakan masuk ke akun Anda untuk melanjutkan.</p>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="text-xs font-bold text-gray-700 tracking-wide">Email atau Nomor BPJS</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border @error('email') border-red-500 focus:ring-red-200 focus:border-red-500 @else border-gray-200 focus:ring-[#0046A0]/20 focus:border-[#0046A0] @enderror rounded-xl text-sm focus:outline-none focus:ring-2 transition-all placeholder-gray-400 text-gray-700"
                            placeholder="Masukkan email atau no BPJS">
                    </div>
                    @error('email')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-xs font-bold text-gray-700 tracking-wide">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full pl-11 pr-12 py-3 bg-gray-50 border @error('password') border-red-500 focus:ring-red-200 focus:border-red-500 @else border-gray-200 focus:ring-[#0046A0]/20 focus:border-[#0046A0] @enderror rounded-xl text-sm focus:outline-none focus:ring-2 transition-all placeholder-gray-400 text-gray-700"
                            placeholder="Masukkan kata sandi">

                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-[#0046A0]">
                            <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="flex items-center gap-2 cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 text-[#0046A0] border-gray-300 rounded focus:ring-[#0046A0] bg-gray-50">
                        <span class="text-xs font-semibold text-gray-500">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-bold text-[#0046A0] hover:underline">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-[#0046A0] hover:bg-[#003780] text-white py-3 rounded-xl text-sm font-semibold tracking-wide shadow-md transition-all flex items-center justify-center gap-2 mt-2">
                    Masuk
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-gray-100"></div>
                <span class="flex-shrink mx-4 text-xs text-gray-400 font-medium">Atau masuk dengan</span>
                <div class="flex-grow border-t border-gray-100"></div>
            </div>

            <button type="button" class="w-full border border-gray-200 hover:bg-gray-50 text-gray-700 py-3 rounded-xl text-sm font-semibold transition-all flex items-center justify-center gap-3 bg-white shadow-sm">
                <svg class="w-4 h-4" viewBox="0 0 24 24">
                    <path fill="#EA4335" d="M12.24 10.285V14.4h6.887c-.275 1.565-1.88 4.604-6.887 4.604-4.33 0-7.866-3.577-7.866-8s3.536-8 7.866-8c2.46 0 4.105 1.025 5.047 1.926l3.256-3.133C18.444 1.155 15.567 0 12.24 0c-6.63 0-12 5.37-12 12s5.37 12 12 12c6.923 0 11.52-4.874 11.52-11.72 0-.788-.085-1.39-.189-1.995H12.24z"/>
                </svg>
                Lanjutkan dengan Google
            </button>

            <p class="text-center text-xs text-gray-400 font-medium">
                Belum punya akun? <a href="{{ route('register') }}" class="text-[#0046A0] font-bold hover:underline">Daftar di sini</a>
            </p>

            <div class="pt-4 text-center flex items-center justify-center gap-1.5 text-[10px] text-gray-400 font-medium">
                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m0 0v3m0-3h3m-3 0H9m12-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Enkripsi 256-bit Aman
            </div>

        </div>
    </div>
</div>


@endsection
