<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
{
    // Mengambil semua user dengan role 'dokter'
    $dokters = \App\Models\User::role('dokter')->get();
    return view('landing.cari-dokter.index', compact('dokters'));
}
}
