<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiKesehatanController extends Controller
{
       public function informasiKesehatan()
    {
        return view('landing.informasi-kesehatan');
    }
}
