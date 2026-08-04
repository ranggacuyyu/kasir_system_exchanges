<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');

/* Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kasir', [KasirController::class, 'cekUser'])->name('login');
}); */

Route::get('/kasir', [KasirController::class, 'cekUser'])->name('login');

Route::get('/kasir/dashboard', [KasirController::class, 'dashboard'])->name('kasir.dashboard');

Route::get('/kasir/hitung', function () {
    return view('kasir.hitung');
})->name('kasir.hitung');

Route::get('/kasir/stok', function () {
    return view('kasir.stok');
})->name('kasir.stok');

Route::get('/kasir/laporan', function () {
    return view('kasir.laporan');
})->name('kasir.laporan');
