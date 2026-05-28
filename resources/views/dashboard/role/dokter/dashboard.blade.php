@extends('dashboard.layouts.app')

@section('content')
<div class="flex-1 p-8 md:p-10 space-y-8 overflow-y-auto">

    {{-- Welcome Header --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Selamat Datang, {{ auth()->user()->name }}</h1>
        <p class="text-sm text-gray-500 mt-1.5 font-medium">Ringkasan aktivitas hari ini, {{ now()->translatedFormat('d F Y') }}</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        {{-- Total Pasien --}}
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-11 h-11 rounded-xl bg-blue-50 text-[#0046A0] flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="bg-blue-50 text-[#0046A0] text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Hari Ini</span>
            </div>
            <p class="text-xs text-gray-500 font-medium">Total Pasien</p>
            <p class="text-3xl font-extrabold text-gray-900">{{ $totalPasien }}</p>
        </div>

        {{-- Pending Requests --}}
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                @if($pendingRequests->count() > 0)
                    <span class="flex items-center gap-1 bg-red-50 text-red-600 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">
                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Urgent
                    </span>
                @endif
            </div>
            <p class="text-xs text-gray-500 font-medium">Pending Requests</p>
            <p class="text-3xl font-extrabold text-gray-900">{{ $pendingRequests->count() }}</p>
        </div>

        {{-- Konsultasi Selesai --}}
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 font-medium">Konsultasi Selesai</p>
            <p class="text-3xl font-extrabold text-gray-900">{{ $completedCount }}</p>
        </div>
    </div>

    {{-- Main Grid: Jadwal + Pending --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        {{-- LEFT: Jadwal Hari Ini --}}
        <div class="lg:col-span-2 bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900">Jadwal Hari Ini</h2>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($jadwalHariIni as $jadwal)
                    <div class="p-5 flex items-center justify-between gap-4 hover:bg-slate-50/50 transition-all">
                        <div class="flex items-center gap-4">
                            {{-- Avatar Initials --}}
                            <div class="w-11 h-11 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-sm font-bold text-gray-600 shrink-0">
                                {{ strtoupper(substr($jadwal->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">{{ $jadwal->user->name }}</h4>
                                <div class="flex items-center gap-2 text-xs text-gray-400 mt-0.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>
                                        @if($jadwal->scheduled_date->isToday())
                                            Hari ini,
                                        @else
                                            {{ $jadwal->scheduled_date->translatedFormat('d M Y') }},
                                        @endif
                                        {{ \Carbon\Carbon::parse($jadwal->scheduled_time)->format('H:i') }} WIB
                                    </span>
                                    <span class="bg-emerald-50 text-emerald-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Approved</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <div class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-400 font-medium">Tidak ada jadwal hari ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- RIGHT: Permintaan Pending --}}
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-900">Permintaan Janji Temu</h2>
                @if($pendingRequests->count() > 0)
                    <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingRequests->count() }} Baru</span>
                @endif
            </div>
            <div class="divide-y divide-slate-100 max-h-[400px] overflow-y-auto">
                @forelse($pendingRequests as $req)
                    <div class="p-4 hover:bg-slate-50/50 transition-all">
                        <div class="flex items-start gap-3 mb-3">
                            <div class="w-9 h-9 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-gray-900">{{ $req->user->name }}</h4>
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">{{ $req->keluhan ?: 'Tidak ada keluhan spesifik' }}</p>
                                <p class="text-[10px] text-gray-400 mt-1">{{ $req->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="openApproveModal({{ $req->id }}, '{{ addslashes($req->user->name) }}')" class="flex-1 bg-[#0046A0] text-white text-xs font-bold py-2 rounded-lg hover:bg-blue-800 transition-all">
                                Setujui
                            </button>
                            <form action="{{ route('dokter.janji.reject', $req->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Tolak permintaan janji ini?')">
                                @csrf
                                <button type="submit" class="w-full bg-red-50 text-red-600 text-xs font-bold py-2 rounded-lg hover:bg-red-100 transition-all">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center">
                        <p class="text-xs text-gray-400 font-medium">Tidak ada permintaan pending.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- MODAL: Approve Janji Temu (Set Date/Time) --}}
<div id="approveModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl space-y-5">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">Setujui Janji Temu</h2>
            <button onclick="closeApproveModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>

        <p class="text-sm text-gray-500">Tentukan jadwal untuk pasien: <strong id="approvePatientName"></strong></p>

        <form id="approveForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="scheduled_date" min="{{ now()->format('Y-m-d') }}" class="w-full border border-gray-200 rounded-xl p-2.5 text-sm focus:ring-[#0046A0] focus:border-[#0046A0]" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Jam</label>
                <input type="time" name="scheduled_time" class="w-full border border-gray-200 rounded-xl p-2.5 text-sm focus:ring-[#0046A0] focus:border-[#0046A0]" required>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Catatan (Opsional)</label>
                <textarea name="catatan_dokter" rows="2" placeholder="Catatan tambahan untuk pasien..." class="w-full border border-gray-200 rounded-xl p-2.5 text-sm focus:ring-[#0046A0] focus:border-[#0046A0] resize-none"></textarea>
            </div>
            <button type="submit" class="w-full bg-[#0046A0] text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition-all">
                Konfirmasi Jadwal
            </button>
        </form>
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

<script>
function openApproveModal(id, patientName) {
    document.getElementById('approvePatientName').innerText = patientName;
    document.getElementById('approveForm').action = '/dokter/janji-temu/' + id + '/approve';
    document.getElementById('approveModal').classList.remove('hidden');
    document.getElementById('approveModal').classList.add('flex');
}
function closeApproveModal() {
    document.getElementById('approveModal').classList.add('hidden');
    document.getElementById('approveModal').classList.remove('flex');
}
</script>
@endsection
