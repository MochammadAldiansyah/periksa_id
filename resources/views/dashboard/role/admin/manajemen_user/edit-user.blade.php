@extends('dashboard.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white border border-slate-100 rounded-2xl p-8 shadow-sm">
    <h2 class="text-2xl font-bold text-gray-900 mb-1">Edit Pengguna</h2>
    <p class="text-sm text-gray-500 mb-6">Perbarui data informasi akun {{ $user->name }}</p>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-600" required>
            @error('name') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-600" required>
            @error('email') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-3 pt-4 justify-end">
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 bg-slate-50 border border-slate-200 hover:bg-slate-100 text-gray-600 rounded-xl text-sm font-semibold transition-colors">
                Batal
            </a>
            <button type="submit" class="px-5 py-2.5 bg-[#0046A0] hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
