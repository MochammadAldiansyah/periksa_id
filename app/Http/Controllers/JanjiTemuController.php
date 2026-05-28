<?php
namespace App\Http\Controllers;
use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JanjiTemuController extends Controller {

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:users,id',
            'keluhan' => 'nullable|string|max:500',
        ]);

        if (!auth()->user()->hasRole('pasien')) {
            return back()->with('error', 'Hanya pasien yang bisa membuat janji temu.');
        }

        JanjiTemu::create([
            'user_id' => auth()->id(),
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Janji temu berhasil dibuat! Menunggu persetujuan dokter.');
    }

    // Dokter approves appointment and sets date/time
    public function approve(Request $request, JanjiTemu $janjiTemu)
    {
        if (auth()->id() !== $janjiTemu->dokter_id) {
            abort(403);
        }

        $request->validate([
            'scheduled_date' => 'required|date|after_or_equal:today',
            'scheduled_time' => 'required',
            'catatan_dokter' => 'nullable|string|max:500',
        ]);

        $janjiTemu->update([
            'status' => 'approved',
            'scheduled_date' => $request->scheduled_date,
            'scheduled_time' => $request->scheduled_time,
            'catatan_dokter' => $request->catatan_dokter,
        ]);

        return back()->with('success', 'Janji temu berhasil disetujui.');
    }

    // Dokter rejects appointment
    public function reject(JanjiTemu $janjiTemu)
    {
        if (auth()->id() !== $janjiTemu->dokter_id) {
            abort(403);
        }

        $janjiTemu->update(['status' => 'rejected']);

        return back()->with('success', 'Janji temu ditolak.');
    }
}