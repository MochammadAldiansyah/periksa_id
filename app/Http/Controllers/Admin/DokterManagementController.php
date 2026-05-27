<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterManagementController extends Controller
{
    // Menampilkan halaman daftar & form tambah dokter
    public function create()
    {
        return view('admin.dokter.create');
    }

    // Memproses data dokter baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // 1. Buat user baru
        $dokter = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2. Langsung berikan role dokter
        $dokter->assignRole('dokter');

        return redirect()->back()->with('success', 'Akun Dokter Berhasil Dibuat!');
    }
}
