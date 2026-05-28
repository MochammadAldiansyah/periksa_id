@extends('dashboard.layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Account Overview</h1>
            <p class="text-sm text-gray-500 mt-1">Manage your personal details, and notification preferences securely.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            <div class="space-y-6">
                <div class="bg-white border border-slate-100 rounded-2xl p-6 text-center space-y-4 shadow-sm">
                    <div
                        class="relative w-24 h-24 mx-auto rounded-full bg-blue-50 border border-blue-100 font-bold text-[#0046A0] text-3xl flex items-center justify-center shadow-inner overflow-hidden">
                        <span>{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                        <p class="text-xs text-gray-400 font-medium uppercase mt-0.5 tracking-wider">
                            {{ auth()->user()->roles->pluck('name')->first() ?? 'User' }} Account
                        </p>
                    </div>
                </div>

                <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4 shadow-sm">
                    <div class="flex items-center justify-between border-b border-slate-50 pb-2">
                        <div class="flex items-center gap-2 font-bold text-gray-900 text-sm">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span>Saved Addresses</span>
                        </div>
                        <button type="button" onclick="openAddressModal()" class="text-xs font-bold text-[#0046A0] hover:underline">Manage</button>
                    </div>

                    <div class="p-3 bg-slate-50/60 rounded-xl border border-slate-100 space-y-1">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-gray-800">Rumah (Home)</span>
                            <span
                                class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase">Default</span>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed">Jl. Sudirman No. 45, Senayan, Kebayoran Baru,
                            Jakarta Selatan 12190</p>
                    </div>

                    <div class="p-3 bg-slate-50/60 rounded-xl border border-slate-100 space-y-1">
                        <span class="text-xs font-bold text-gray-800">Klinik (Office)</span>
                        <p class="text-xs text-gray-500 leading-relaxed">Gedung Medika, Tower B Lt. 3, Jl. MH Thamrin,
                            Jakarta Pusat 10350</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6">
                    <div class="flex items-center justify-between border-b border-slate-50 pb-4 mb-6">
                        <div class="flex items-center gap-2 font-bold text-gray-900">
                            <svg class="w-5 h-5 text-[#0046A0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <h2>Personal Details</h2>
                        </div>
                        <span class="text-xs text-blue-600 font-semibold bg-blue-50 px-2.5 py-1 rounded-lg">Active
                            Session</span>
                    </div>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div
                            class="flex items-center gap-5 p-4 bg-slate-50/50 rounded-xl border border-slate-100 w-full sm:w-max">
                            <div
                                class="relative w-16 h-16 rounded-full bg-slate-200 flex items-center justify-center text-gray-400 shrink-0 overflow-hidden">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Change
                                    Photo</label>
                                <input type="file" name="avatar"
                                    class="block w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-[#0046A0] hover:file:bg-blue-100 transition-all cursor-pointer" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label for="name" class="text-xs font-bold text-gray-700 uppercase">Full Name</label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', auth()->user()->name) }}" required
                                    class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-gray-800 focus:outline-none focus:border-[#0046A0] focus:bg-white transition-all">
                            </div>
                            <div class="space-y-1.5">
                                <label for="email" class="text-xs font-bold text-gray-700 uppercase">Email
                                    Address</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', auth()->user()->email) }}" required
                                    class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-gray-800 focus:outline-none focus:border-[#0046A0] focus:bg-white transition-all">
                            </div>
                        </div>

                        <div class="flex justify-end pt-4 border-t border-slate-50">
                            <button type="submit"
                                class="bg-[#0046A0] hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-xl transition-all shadow-sm shadow-blue-200">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6">
                    <div class="border-b border-slate-50 pb-4 mb-5">
                        <div class="flex items-center gap-2 font-bold text-gray-900">
                            <svg class="w-5 h-5 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            <h2>Security Password</h2>
                        </div>
                    </div>

                    @if ($errors->updatePassword->any())
                        <div class="mb-5 p-4 bg-red-50 border border-red-100 rounded-xl text-sm text-red-600 space-y-1">
                            <div class="flex items-center gap-2 font-bold text-red-700">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                <span>Terjadi Kesalahan Kredensial!</span>
                            </div>
                            <ul class="list-disc pl-5 space-y-0.5 text-xs">
                                @foreach ($errors->updatePassword->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('status') === 'password-updated')
                        <div
                            class="mb-5 p-4 bg-emerald-50 border border-emerald-100 rounded-xl text-sm text-emerald-700 flex items-center gap-2 font-semibold">
                            <svg class="w-4 h-4 shrink-0 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Password berhasil diperbarui secara aman!</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                            <div class="space-y-1.5">
                                <label for="current_password" class="text-xs font-bold text-gray-700 uppercase">Current
                                    Password</label>
                                <div class="relative">
                                    <input type="password" id="current_password" name="current_password" required
                                        class="w-full bg-slate-50/50 border border-slate-200 rounded-xl pl-4 pr-11 py-3 text-sm focus:outline-none focus:border-[#0046A0] focus:bg-white transition-all">
                                    <button type="button" onclick="toggleVisibility('current_password', 'eye-current')"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <span id="eye-current">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label for="password" class="text-xs font-bold text-gray-700 uppercase">New
                                    Password</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" required
                                        class="w-full bg-slate-50/50 border border-slate-200 rounded-xl pl-4 pr-11 py-3 text-sm focus:outline-none focus:border-[#0046A0] focus:bg-white transition-all">
                                    <button type="button" onclick="toggleVisibility('password', 'eye-new')"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <span id="eye-new">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label for="password_confirmation"
                                    class="text-xs font-bold text-gray-700 uppercase">Confirm Password</label>
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        required
                                        class="w-full bg-slate-50/50 border border-slate-200 rounded-xl pl-4 pr-11 py-3 text-sm focus:outline-none focus:border-[#0046A0] focus:bg-white transition-all">
                                    <button type="button"
                                        onclick="toggleVisibility('password_confirmation', 'eye-confirm')"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <span id="eye-confirm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="pt-4 border-t border-slate-50">
                            <button type="submit"
                                class="w-full sm:w-max bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-xl transition-all shadow-sm">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="addressModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all">
        <div class="bg-white rounded-2xl w-full max-w-xl shadow-xl border border-slate-100 flex flex-col max-h-[85vh] transform scale-95 opacity-0 transition-all duration-200" id="modalBox">

            <div class="flex items-center justify-between p-5 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#0046A0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <h3 class="text-base font-bold text-gray-900">Manage Saved Addresses</h3>
                </div>
                <button type="button" onclick="closeAddressModal()" class="p-1.5 rounded-xl text-gray-400 hover:bg-slate-50 hover:text-gray-600 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-5 overflow-y-auto space-y-6">

                <form id="addressForm" class="bg-slate-50/80 p-4 rounded-xl border border-slate-200/60 space-y-4">
                    <div class="font-bold text-xs text-gray-700 uppercase tracking-wider flex items-center gap-1.5">
                        <span class="w-1.5 h-3 bg-[#0046A0] rounded-full"></span>
                        Tambah Alamat Baru
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="sm:col-span-1 space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-600 uppercase tracking-wide">Label Alamat</label>
                            <input type="text" id="addr_label" name="label" placeholder="Rumah / Kantor" required
                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#0046A0] focus:ring-1 focus:ring-[#0046A0] transition-all">
                        </div>
                        <div class="sm:col-span-2 space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-600 uppercase tracking-wide">Alamat Lengkap</label>
                            <input type="text" id="addr_full" name="full_address" placeholder="Nama jalan, nomor rumah, RT/RW..." required
                                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#0046A0] focus:ring-1 focus:ring-[#0046A0] transition-all">
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-1">
                        <label class="flex items-center gap-2 text-xs text-gray-600 cursor-pointer select-none">
                            <input type="checkbox" name="is_default" value="1" class="w-4 h-4 rounded border-slate-300 text-[#0046A0] focus:ring-[#0046A0]">
                            <span class="font-medium">Jadikan Alamat Utama (Default)</span>
                        </label>
                        <button type="submit" class="bg-[#0046A0] hover:bg-blue-700 text-white font-bold text-[11px] uppercase tracking-wider px-5 py-2.5 rounded-xl transition-all shadow-sm">
                            Simpan Alamat
                        </button>
                    </div>
                </form>

                <hr class="border-slate-100">

                <div class="space-y-3">
                    <div class="font-bold text-xs text-gray-400 uppercase tracking-wider">Daftar Alamat Kamu</div>

                    <div id="modal-address-list" class="space-y-2.5">
                        <div class="p-4 bg-blue-50/30 rounded-xl border border-blue-100 flex items-start justify-between gap-4">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-gray-800">Rumah (Home)</span>
                                    <span class="bg-amber-100 text-amber-800 text-[9px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wide">Utama</span>
                                </div>
                                <p class="text-xs text-gray-500 leading-relaxed">Jl. Sudirman No. 45, Senayan, Kebayoran Baru, Jakarta Selatan 12190</p>
                            </div>
                            <button type="button" class="p-2 rounded-xl text-red-500 hover:bg-red-50 shrink-0 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
