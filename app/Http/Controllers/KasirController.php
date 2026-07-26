<?php

namespace App\Http\Controllers;

class KasirController extends Controller
{
    public function dashboard()
    {
        return view('components.kasir.pesanan');
    }
}
