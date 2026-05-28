<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    public function index()
    {
        return view('landing.rumah-sakit');
    }
}
