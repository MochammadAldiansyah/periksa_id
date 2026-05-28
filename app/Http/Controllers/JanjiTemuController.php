<?php
namespace App\Http\Controllers;
use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JanjiTemuController extends Controller {
 public function store(Request $request)
{
    // Validasi
    $request->validate(['dokter_id' => 'required|exists:users,id']);

    // Cek apakah yang login adalah 'pasien' (menggunakan Spatie)
    if (!auth()->user()->hasRole('pasien')) {
        return back()->with('error', 'Hanya pasien yang bisa membuat janji temu.');
    }

    \App\Models\JanjiTemu::create([
        'user_id' => auth()->id(),
        'dokter_id' => $request->dokter_id,
        'status' => 'pending'
    ]);

    return back()->with('success', 'Janji temu berhasil dibuat!');
}
}