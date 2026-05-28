@extends('dashboard.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.farmasi.index') }}" class="text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-2xl font-bold">Tambah Obat Baru</h1>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.farmasi.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-2xl border shadow-sm space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-bold mb-2">Nama Obat</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded-xl p-2.5 focus:ring-[#0046A0] focus:border-[#0046A0]" required>
        </div>
        <div>
            <label class="block text-sm font-bold mb-2">Deskripsi Lengkap</label>
            <textarea name="description" rows="4" class="w-full border rounded-xl p-2.5 focus:ring-[#0046A0] focus:border-[#0046A0]">{{ old('description') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold mb-2">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', 0) }}" min="0" class="w-full border rounded-xl p-2.5 focus:ring-[#0046A0] focus:border-[#0046A0]" required>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" class="w-full border rounded-xl p-2.5 focus:ring-[#0046A0] focus:border-[#0046A0]" required>
            </div>
        </div>
        <div>
            <label class="block text-sm font-bold mb-2">Gambar Obat</label>
            <input type="file" name="image" accept="image/*" class="w-full border rounded-xl p-2.5 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-[#0046A0] hover:file:bg-blue-100">
        </div>
        <div class="pt-4">
            <button type="submit" class="bg-[#0046A0] text-white px-6 py-2.5 rounded-xl font-bold w-full md:w-auto">Simpan Obat</button>
        </div>
    </form>
</div>
@endsection
