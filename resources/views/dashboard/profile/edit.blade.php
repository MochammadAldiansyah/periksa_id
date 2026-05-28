@extends('dashboard.layouts.app')

@section('content')
    <div class="space-y-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Pengaturan Profil</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui data personal akun admin dan amankan kredensial lu di sini.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- FORM INFORMASI PRIBADI --}}
            <div class="lg:col-span-2 bg-white border border-slate-100 rounded-2xl shadow-sm p-6 space-y-6">
                <div class="border-b border-slate-50 pb-4">
                    <h2 class="text-lg font-bold text-gray-900">Informasi Pribadi</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Kelola informasi dasar akun administrator lu.</p>
                </div>

                {{-- FIX: Action diarahkan ke profile.update --}}
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    {{-- Notifikasi Sukses Profil --}}
                    @if (session('status') === 'profile-updated')
                        <div class="p-3 text-sm text-emerald-700 bg-emerald-50 rounded-xl border border-emerald-100 font-semibold mb-2">
                            ✓ Informasi pribadi berhasil diperbarui!
                        </div>
                    @endif

                    <div class="flex items-center gap-6 p-4 bg-slate-50/50 rounded-xl border border-slate-100 w-full sm:w-max">
                        <div class="relative w-20 h-20 rounded-full bg-blue-50 border border-blue-100 font-bold text-[#0046A0] text-2xl flex items-center justify-center shadow-sm shrink-0 overflow-hidden">
                            <span>AS</span>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Foto Profil Admin</label>
                            <input type="file" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-[#0046A0] hover:file:bg-blue-100 file:cursor-pointer transition-all" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="name" class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:border-[#0046A0] focus:bg-white transition-all">
                            @if ($errors->has('name'))
                                <span class="text-xs text-rose-500 mt-1 block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label for="email" class="text-sm font-semibold text-gray-700">Alamat Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:border-[#0046A0] focus:bg-white transition-all">
                            @if ($errors->has('email'))
                                <span class="text-xs text-rose-500 mt-1 block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-slate-50">
                        <button type="submit" class="bg-[#0046A0] hover:bg-blue-700 text-white font-semibold text-sm px-5 py-3 rounded-xl transition-all shadow-sm shadow-blue-200">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            {{-- FORM KEAMANAN SANDI --}}
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 space-y-6">
                <div class="border-b border-slate-50 pb-4">
                    <h2 class="text-lg font-bold text-gray-900">Keamanan Sandi</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Pastikan sandi menggunakan kombinasi yang kuat.</p>
                </div>

                <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Notifikasi Sukses Password --}}
                    @if (session('status') === 'password-updated')
                        <div class="p-3 text-sm text-emerald-700 bg-emerald-50 rounded-xl border border-emerald-100 font-semibold mb-2">
                            ✓ Password berhasil diperbarui!
                        </div>
                    @endif

                    {{-- 1. Password Sekarang --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Password Sekarang</label>
                        <div class="relative">
                            <input type="password" id="current_password" name="current_password"
                                class="w-full bg-slate-50 border {{ $errors->updatePassword->has('current_password') ? 'border-rose-400 focus:border-rose-500 bg-rose-50/30' : 'border-slate-200 focus:border-[#0046A0]' }} rounded-xl pl-4 pr-11 py-2.5 text-sm text-gray-700 focus:outline-none transition-all"
                                placeholder="••••••••">

                            {{-- FIX: ID dilempar ke span di dalam button agar struktur DOM tombol tidak rusak saat diklik --}}
                            <button type="button" onclick="window.toggleVisibility('current_password', 'icon_current')"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <span id="icon_current" class="flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        @if ($errors->updatePassword->has('current_password'))
                            <span class="text-xs text-rose-500 font-medium mt-1 block">⚠️ {{ $errors->updatePassword->first('current_password') }}</span>
                        @endif
                    </div>

                    {{-- 2. Password Baru --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Password Baru (Minimal 8 Karakter)</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full bg-slate-50 border {{ $errors->updatePassword->has('password') ? 'border-rose-400 focus:border-rose-500 bg-rose-50/30' : 'border-slate-200 focus:border-[#0046A0]' }} rounded-xl pl-4 pr-11 py-2.5 text-sm text-gray-700 focus:outline-none transition-all"
                                placeholder="••••••••">

                            <button type="button" onclick="window.toggleVisibility('password', 'icon_new')"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <span id="icon_new" class="flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        @if ($errors->updatePassword->has('password'))
                            <span class="text-xs text-rose-500 font-medium mt-1 block">⚠️ {{ $errors->updatePassword->first('password') }}</span>
                        @endif
                    </div>

                    {{-- 3. Konfirmasi Password Baru --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full bg-slate-50 border border-slate-200 focus:border-[#0046A0] rounded-xl pl-4 pr-11 py-2.5 text-sm text-gray-700 focus:outline-none transition-all"
                                placeholder="••••••••">

                            <button type="button" onclick="window.toggleVisibility('password_confirmation', 'icon_confirm')"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <span id="icon_confirm" class="flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-[#0046A0] hover:bg-blue-700 text-white text-sm font-semibold py-3 rounded-xl transition-all shadow-sm shadow-blue-100">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
