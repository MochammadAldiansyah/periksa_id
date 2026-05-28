@extends('dashboard.layouts.app')

@section('content')
<div class="space-y-8">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Manajemen User</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola semua akun pengguna terdaftar yang ada di sistem Periksa.id.</p>
        </div>
    </div>

    {{-- Form Filter & Search Section --}}
    <form action="{{ url()->current() }}" method="GET" class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="relative w-full md:w-80">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            {{-- Input Search Berfungsi Mengirimkan Data --}}
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="w-full bg-slate-50/50 border border-slate-200 rounded-xl pl-11 pr-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:border-[#0046A0] focus:bg-white transition-all placeholder-gray-400">
        </div>

        <div class="flex gap-3 w-full md:w-auto justify-end">
            {{-- Filter Berdasarkan Role --}}
            <select name="role" onchange="this.form.submit()" class="bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-gray-600 focus:outline-none focus:border-[#0046A0] transition-all cursor-pointer">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                <option value="dokter" {{ request('role') == 'dokter' ? 'selected' : '' }}>Dokter</option>
                <option value="pasien" {{ request('role') == 'pasien' ? 'selected' : '' }}>Pasien</option>
            </select>
        </div>
    </form>

    {{-- Data Table Section --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Pengguna</th>
                        <th class="py-4 px-6">Kontak / Keterangan</th>
                        <th class="py-4 px-6">Role</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6">Tanggal Bergabung</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-sm text-gray-700">

                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50/40 transition-colors">
                            {{-- Pengguna Avatar & Nama --}}
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-50 text-[#0046A0] font-bold text-sm flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-400 font-medium mt-0.5">ID Akun: #UID-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </td>

                            {{-- Kontak & Detail Spesifik (STR untuk Dokter) --}}
                            <td class="py-4 px-6">
                                <div class="font-medium text-gray-800">{{ $user->email }}</div>
                                @if($user->hasRole('dokter') && isset($user->str_number))
                                    <div class="text-xs text-amber-600 font-semibold mt-0.5">STR: {{ $user->str_number }}</div>
                                @else
                                    <div class="text-xs text-gray-400 font-medium mt-0.5">Terverifikasi</div>
                                @endif
                            </td>

                            {{-- Badge Role Dinamis --}}
                            <td class="py-4 px-6">
                                @if ($user->roles->isNotEmpty())
                                    @php $roleName = $user->roles->first()->name; @endphp
                                    <span class="px-2.5 py-0.5 text-xs font-semibold rounded-md
                                        {{ $roleName == 'admin' ? 'bg-purple-50 text-purple-600' : '' }}
                                        {{ $roleName == 'dokter' ? 'bg-blue-50 text-[#0046A0]' : '' }}
                                        {{ $roleName == 'pasien' ? 'bg-indigo-50 text-indigo-600' : '' }}">
                                        {{ ucfirst($roleName) }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic text-xs">No Role</span>
                                @endif
                            </td>

                            {{-- Status Badge Dinamis --}}
                            <td class="py-4 px-6">
                                @php $status = $user->status ?? 'active'; @endphp
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-lg
                                    {{ $status == 'active' ? 'bg-emerald-50 text-emerald-700' : '' }}
                                    {{ $status == 'pending' ? 'bg-amber-50 text-amber-700' : '' }}
                                    {{ $status == 'suspended' ? 'bg-rose-50 text-rose-700' : '' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            {{-- Tanggal Join Terformat --}}
                            <td class="py-4 px-6 text-gray-400 font-medium">
                                {{ $user->created_at ? $user->created_at->translatedFormat('d F Y') : '-' }}
                            </td>

                            {{-- Tombol Aksi Sesuai Keadaan User --}}
                            <td class="py-4 px-6 text-center">
                                <div class="flex justify-center items-center gap-1.5">
                                    @if($status == 'pending')
                                        <button title="Verifikasi" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                                        </button>
                                    @endif

                                    <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit Akun" class="p-2 bg-slate-50 text-gray-600 rounded-xl hover:bg-slate-100 transition-colors inline-block">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path></svg>
                                    </a>

                                    @if(!$user->hasRole('admin'))
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="openDeleteModal({{ $user->id }}, '{{ $user->name }}')" title="Hapus Akun" class="p-2 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-100 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-400 font-medium">
                                Tidak ada data pengguna yang ditemukan.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Laravel Dynamic Pagination Footer --}}
        <div class="p-5 border-t border-slate-100 bg-slate-50/40 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs font-semibold text-gray-500">
            <div>
                Menampilkan <span class="text-gray-800 font-bold">{{ $users->firstItem() ?? 0 }}</span> sampai <span class="text-gray-800 font-bold">{{ $users->lastItem() ?? 0 }}</span> dari <span class="text-gray-800 font-bold">{{ $users->total() }}</span> pengguna
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>

    </div>

</div>

{{--n Modal Hapus Custom Melayang --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
    <div class="relative bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-100 transform transition-all flex flex-col items-center text-center">
        <div class="w-12 h-12  text-rose-600 rounded-full flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 tracking-tight">Hapus Pengguna?</h3>
        <p class="text-sm text-gray-500 mt-2">
            Apakah Anda yakin ingin menghapus akun <span id="modalUserName" class="font-semibold text-gray-800"></span>? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="flex gap-3 w-full mt-6">
            <button type="button" onclick="closeDeleteModal()" class="flex-1 bg-white border border-slate-200 hover:bg-slate-50 text-gray-600 text-sm font-semibold py-2.5 rounded-xl transition-colors">Batal</button>
            <button type="button" id="confirmDeleteBtn" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors shadow-sm">Ya, Hapus</button>
        </div>
    </div>
</div>


@endsection
