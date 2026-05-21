<?php
namespace App\Http\Controllers;

class AuthController extends Controller {

    /*
    * Method untuk memproses login penggunaParameter


    *alidasi data pengguna yang dikirim melalui form login, seperti email dan password.
    Jika validasi berhasil, maka pengguna akan diarahkan ke halaman dashboard atau halaman utama aplikasi. Jika validasi gagal, maka pengguna akan tetap berada di halaman login dengan pesan error yang sesuai.

    *@param  $id : id barang yang dikirim dari URL
    *@return View Halaman login di folder auth
    */
    public function login()
    {
        return view('layouts.nonuser.index');
    }
}
