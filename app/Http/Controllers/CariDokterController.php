<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan import model User

class CariDokterController extends Controller
{
    public function index()
    {
        $dokters = User::role('dokter')->get();

        return view('landing.cari-dokter.index', compact('dokters'));
    }

    public function dashboardIndex()
    {
        $dokters = User::role('dokter')->get();

        return view('dashboard.role.pasien.cari-dokter', compact('dokters'));
    }
}
