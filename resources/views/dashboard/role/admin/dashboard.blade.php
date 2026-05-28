@extends('dashboard.layouts.app')

@section('content')
    <div class="space-y-8">

        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Dashboard Administrator</h1>
                <p class="text-sm text-gray-500 mt-1">Ringkasan sistem dan aktivitas terkini Periksa.id.</p>
            </div>
        </div>

        {{-- Notifikasi Sukses Setelah Aksi Edit / Delete --}}
        @if (session('success'))
            <div
                class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl text-emerald-800 text-sm font-semibold flex items-center gap-2">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Users</span>
                    <span class="p-2 bg-blue-50 text-[#0046A0] rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4">
                    {{-- Menampilkan jumlah riil user aktif non-admin dari DB --}}
                    <h3 class="text-3xl font-bold text-gray-900 tracking-tight">{{ number_format($totalUsers) }}</h3>
                    <p class="text-xs font-semibold text-emerald-600 mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25">
                            </path>
                        </svg>
                        +12% vs bulan lalu
                    </p>
                </div>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Dokter</span>
                    <span class="p-2 bg-amber-50 text-amber-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4">
                    <h3 class="text-3xl font-bold text-gray-900 tracking-tight">48</h3>
                    <p class="text-xs text-amber-700 bg-amber-50 rounded-lg px-2 py-0.5 mt-1 inline-block font-medium">
                        Menunggu verifikasi STR</p>
                </div>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">System Health</span>
                    <span class="p-2 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4">
                    <h3 class="text-3xl font-bold text-gray-900 tracking-tight">99.9%</h3>
                    <p class="text-xs text-emerald-600 font-semibold mt-1 flex items-center gap-1.5">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Semua layanan normal
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div
                class="lg:col-span-2 bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-gray-900">User Management</h2>
                        <a href="{{ route('admin.users.index') }}"
                            class="text-sm font-semibold text-[#0046A0] hover:underline flex items-center gap-1">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    <th class="py-4 px-6">User</th>
                                    <th class="py-4 px-6">Role</th>
                                    <th class="py-4 px-6">Status</th>
                                    <th class="py-4 px-6 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-sm text-gray-700">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="py-4 px-6 flex items-center gap-3">
                                            <div
                                                class="w-9 h-9 rounded-full bg-blue-50 text-[#0046A0] font-bold text-xs flex items-center justify-center shrink-0">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-400 font-medium">{{ $user->email }}</div>
                                            </div>
                                        </td>

                                        <td class="py-4 px-6 font-medium text-gray-600">
                                            @if ($user->roles->isNotEmpty())
                                                {{ ucfirst($user->roles->first()->name) }}
                                            @else
                                                <span class="text-gray-400 text-xs italic">No Role</span>
                                            @endif
                                        </td>

                                        <td class="py-4 px-6">
                                            <span
                                                class="px-2.5 py-1 text-xs font-semibold bg-emerald-50 text-emerald-700 rounded-lg">
                                                Active
                                            </span>
                                        </td>

                                        {{-- Kolom Aksi yang Sudah Berfungsi --}}
                                        <td class="py-4 px-6 text-right space-x-1 flex justify-end items-center">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="p-1.5 bg-slate-50 text-gray-600 rounded-lg hover:bg-slate-100 transition-colors inline-block"
                                                title="Edit User">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125">
                                                    </path>
                                                </svg>
                                            </a>

                                            <!-- Delete Form dengan Modal Custom -->
                                            <form id="delete-form-{{ $user->id }}"
                                                action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="openDeleteModal({{ $user->id }}, '{{ $user->name }}')"
                                                    class="p-1.5 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100 transition-colors"
                                                    title="Delete User">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="py-8 px-6 text-center text-sm text-gray-400 font-medium">
                                            Belum ada pengguna yang mendaftar di database.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-6 bg-white h-32"></div>
            </div>

                <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-base font-bold text-gray-900">Moderasi Konten</h2>
                        <span class="px-2 py-0.5 bg-rose-50 text-rose-600 text-xs font-bold rounded-md">3</span>
                    </div>
                    <div class="bg-slate-50/50 border border-slate-100 rounded-xl p-4">
                        <div
                            class="flex justify-between text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                            <span class="text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded">Forum Post</span>
                            <span>10m yang lalu</span>
                        </div>
                        <p class="text-xs text-gray-700 font-medium leading-relaxed">
                            "Adakah rekomendasi obat tidur yang ampuh tanpa resep dokter?..."
                        </p>
                        <div class="flex gap-2 mt-4">
                            <button
                                class="flex-1 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold py-2 rounded-lg transition-colors">
                                Hapus
                            </button>
                            <button
                                class="flex-1 bg-white border border-slate-200 hover:bg-slate-50 text-gray-600 text-xs font-semibold py-2 rounded-lg transition-colors">
                                Abaikan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Card Melayang / Custom Confirmation Modal --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        {{-- Backdrop Latar Belakang Blur --}}
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

        {{-- Kotak Modal Melayang --}}
        <div
            class="relative bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-100 transform transition-all flex flex-col items-center text-center">
            {{-- Icon Warning / Hapus --}}
            <div class="w-12 h-12 text-rose-600 rounded-full flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                </svg>
            </div>

            {{-- Teks Informasi --}}
            <h3 class="text-lg font-bold text-gray-900 tracking-tight">Hapus Pengguna?</h3>
            <p class="text-sm text-gray-500 mt-2">
                Apakah Anda yakin ingin menghapus akun <span id="modalUserName"
                    class="font-semibold text-gray-800"></span>? Tindakan ini tidak dapat dibatalkan.
            </p>

            {{-- Tombol Aksi --}}
            <div class="flex gap-3 w-full mt-6">
                <button type="button" onclick="closeDeleteModal()"
                    class="flex-1 bg-white border border-slate-200 hover:bg-slate-50 text-gray-600 text-sm font-semibold py-2.5 rounded-xl transition-colors">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn"
                    class="flex-1 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors shadow-sm shadow-rose-100">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
@endsection
