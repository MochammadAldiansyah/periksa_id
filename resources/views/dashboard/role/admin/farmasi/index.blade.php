@extends('dashboard.layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Farmasi</h1>
            <p class="text-sm text-gray-500">Kelola daftar obat, harga, stok, dan gambar.</p>
        </div>
        <a href="{{ route('admin.farmasi.create') }}" class="bg-[#0046A0] hover:bg-blue-800 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition-all">
            + Tambah Obat
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm flex items-center shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Obat</th>
                        <th class="py-4 px-4">Harga</th>
                        <th class="py-4 px-4">Stok</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 text-sm">
                    @forelse($medicines as $med)
                        <tr class="hover:bg-slate-50/40 transition-all">
                            <td class="py-4 px-6 flex items-center gap-4">
                                @if($med->image)
                                    <img src="{{ asset('storage/' . $med->image) }}" class="w-12 h-12 rounded object-cover border">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-gray-400 border">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-bold text-gray-900">{{ $med->name }}</div>
                                    <div class="text-xs text-gray-500 truncate w-48">{{ $med->description }}</div>
                                </div>
                            </td>
                            <td class="py-4 px-4 font-medium text-gray-900">Rp {{ number_format($med->price, 0, ',', '.') }}</td>
                            <td class="py-4 px-4">{{ $med->stock }}</td>
                            <td class="py-4 px-6 text-right flex items-center justify-end gap-3">
                                <a href="{{ route('admin.farmasi.edit', $med->id) }}" class="text-[#0046A0] font-bold hover:underline">Edit</a>
                                <form action="{{ route('admin.farmasi.destroy', $med->id) }}" method="POST" onsubmit="return confirm('Hapus obat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 font-bold hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-400">Tidak ada obat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-5 border-t border-slate-50">
            {{ $medicines->links() }}
        </div>
    </div>
</div>
@endsection
