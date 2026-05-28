@extends('dashboard.layouts.app')

@section('content')
<div class="flex-1 p-8 md:p-10 space-y-8 overflow-y-auto">
    
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Pesanan Obat</h1>
            <p class="text-sm text-gray-500 mt-1.5 font-medium">Kelola semua pesanan farmasi dari pasien</p>
        </div>
    </div>

    {{-- Pesanan Table --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Pasien</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Obat (Qty)</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Alamat & Pembayaran</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-bold text-sm text-gray-900">{{ $order->user->name }}</div>
                                <div class="text-xs text-gray-400 mt-0.5">{{ $order->created_at->format('d M Y, H:i') }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden shrink-0">
                                        @if($order->medicine->image)
                                            <img src="{{ asset('storage/' . $order->medicine->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-sm text-gray-900">{{ $order->medicine->name }}</div>
                                        <div class="text-xs text-gray-500 font-medium">Qty: {{ $order->quantity }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm text-gray-900 line-clamp-2 max-w-xs">{{ $order->address }}</div>
                                <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase mt-1 inline-block">{{ $order->payment_method }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-sm text-[#0046A0]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                            </td>
                            <td class="py-4 px-6">
                                @if($order->status === 'pending')
                                    <span class="bg-amber-50 text-amber-600 text-xs font-bold px-3 py-1 rounded-full border border-amber-100">Pending</span>
                                @elseif($order->status === 'dikirim')
                                    <span class="bg-blue-50 text-blue-600 text-xs font-bold px-3 py-1 rounded-full border border-blue-100">Dikirim</span>
                                @else
                                    <span class="bg-emerald-50 text-emerald-600 text-xs font-bold px-3 py-1 rounded-full border border-emerald-100">Selesai</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="inline-flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    
                                    <select name="status" class="border border-gray-200 rounded-lg text-xs font-bold px-2 py-1.5 focus:ring-[#0046A0] focus:border-[#0046A0]" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="dikirim" {{ $order->status === 'dikirim' ? 'selected' : '' }}>Kirim Obat</option>
                                        <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-400">Belum ada pesanan obat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $orders->links() }}
        </div>
    </div>
</div>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const msg = @json(session('success'));
        if (msg) alert(msg);
    });
</script>
@endif

@endsection
