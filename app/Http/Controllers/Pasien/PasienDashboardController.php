<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasienDashboardController extends Controller
{
    public function index()
    {
        return view('pasien.dashboard');
    }
}
