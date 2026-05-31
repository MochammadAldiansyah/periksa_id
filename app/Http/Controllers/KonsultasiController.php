<?php

namespace App\Http\Controllers;

use App\Models\JanjiTemu;
use App\Models\Message;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    /**
     * Tampilkan halaman daftar konsultasi
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('dokter')) {
            $konsultasis = JanjiTemu::where('dokter_id', $user->id)
                ->where('status', 'approved')
                ->with('user')
                ->latest('scheduled_date')
                ->get();
        } else {
            $konsultasis = JanjiTemu::where('user_id', $user->id)
                ->where('status', 'approved')
                ->with('dokter')
                ->latest('scheduled_date')
                ->get();
        }

        return view('dashboard.konsultasi.index', compact('konsultasis'));
    }
    /**
     * Tampilkan halaman chat untuk janji temu tertentu
     */
    public function chat(JanjiTemu $janjiTemu)
    {
        // Pastikan hanya pasien terkait atau dokter terkait yang bisa akses
        if (auth()->id() !== $janjiTemu->user_id && auth()->id() !== $janjiTemu->dokter_id) {
            abort(403, 'Akses ditolak.');
        }

        // Pastikan status janji temu sudah disetujui (approved)
        if ($janjiTemu->status !== 'approved') {
            return redirect()->back()->with('error', 'Konsultasi belum bisa dimulai karena jadwal belum disetujui.');
        }

        $medicines = collect();
        if (auth()->user()->hasRole('dokter')) {
            $medicines = \App\Models\Medicine::all();
        }

        return view('dashboard.konsultasi.chat', compact('janjiTemu', 'medicines'));
    }

    /**
     * Ambil data pesan terbaru (AJAX)
     */
    public function fetch(JanjiTemu $janjiTemu)
    {
        if (auth()->id() !== $janjiTemu->user_id && auth()->id() !== $janjiTemu->dokter_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = $janjiTemu->messages()->with(['sender', 'medicine'])->orderBy('created_at', 'asc')->get();

        // Tandai pesan sebagai dibaca (is_read) jika penerima yang mem-fetch
        $unreadMessages = $janjiTemu->messages()
            ->where('sender_id', '!=', auth()->id())
            ->where('is_read', false)
            ->get();
            
        foreach ($unreadMessages as $msg) {
            $msg->update(['is_read' => true]);
        }

        return response()->json($messages);
    }

    /**
     * Kirim pesan baru (AJAX)
     */
    public function send(Request $request, JanjiTemu $janjiTemu)
    {
        if (auth()->id() !== $janjiTemu->user_id && auth()->id() !== $janjiTemu->dokter_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
            'medicine_id' => 'nullable|exists:medicines,id'
        ]);

        $message = Message::create([
            'janji_temu_id' => $janjiTemu->id,
            'sender_id' => auth()->id(),
            'message' => $request->message,
            'medicine_id' => $request->medicine_id,
            'is_read' => false
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $message->load(['sender', 'medicine'])
        ]);
    }

    /**
     * Edit pesan
     */
    public function updateMessage(Request $request, Message $message)
    {
        if (auth()->id() !== $message->sender_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $message->update([
            'message' => $request->message,
            'is_edited' => true
        ]);

        return response()->json(['status' => 'success']);
    }

    /**
     * Hapus pesan
     */
    public function deleteMessage(Message $message)
    {
        if (auth()->id() !== $message->sender_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message->delete();

        return response()->json(['status' => 'success']);
    }
}
