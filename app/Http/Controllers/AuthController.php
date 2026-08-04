<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // fungsi untuk mengarahkan user jika sudah login dan memiliki session maka
    // tidak perlu lagi login, akan langsung diarahkan ke dashboard sesuai role
    // return view : Halaman login di folder auth
    public function login()
    {
        // logic melakukan pegecekan dan mengarahkan user ke dashboard
        /* if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role == 'kasir') {
                return redirect()->route('kasir.dashboard');
            } elseif ($role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
        } */

        /* $auth_status = Session::get('auth_status');
        if ($auth_status == true) {
            $role = Session::get('role');
            if ($role == 'kasir') {
                return redirect()->route('kasir.dashboard');
            } elseif ($role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
        } */

        // jika user tidak login maka akan diarahkan ke halaman login
        return view('layouts.nonuser.index');
    }
}
