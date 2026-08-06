<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');

/* Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kasir', [KasirController::class, 'cekUser'])->name('login');
}); */

// bagian kasir
Route::get('/kasir', [KasirController::class, 'cekUser'])->name('login');

Route::get('/kasir/dashboard', [KasirController::class, 'dashboard'])->name('kasir.dashboard');

Route::get('/kasir/hitung', function () {
    return view('kasir.hitung');
})->name('kasir.hitung');

Route::get('/kasir/stok', function () {
    return view('kasir.stok');
})->name('kasir.stok');

Route::get('/kasir/absensi', function () {
    return view('kasir.absensi');
})->name('kasir.absensi');

Route::get('/kasir/laporan', function () {
    return view('kasir.laporan');
})->name('kasir.laporan');

// bagian non-user

Route::get('/profile-page', function() {
    return view('nonuser.profile-page');
})->name('nonuser.profile-page');

// bagian admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/laporan-shift', function () {
    return view('admin.laporan-shift');
})->name('admin.laporan-shift');

Route::get('/admin/absensi', function () {
    return view('admin.absensi');
})->name('admin.absensi');

Route::get('/admin/audit-kas', function () {
    return view('admin.audit-kas');
})->name('admin.audit-kas');

Route::get('/admin/stok', function () {
    return view('admin.stok');
})->name('admin.stok');


Route::get('/admin/kelola-kasir', function () {
    return view('admin.kelola-kasir');
})->name('admin.kelola-kasir');

Route::get('/admin/diskon-promo', function () {
    return view('admin.diskon-promo');
})->name('admin.diskon-promo');

Route::get('/admin/audit-void', function () {
    return view('admin.audit-void');
})->name('admin.audit-void');

Route::get('/admin/audit-qris', function () {
    return view('admin.audit-qris');
})->name('admin.audit-qris');

Route::get('/admin/kas-out', function () {
    return view('admin.kas-out');
})->name('admin.kas-out');

Route::get('/admin/pelanggan', function () {
    return view('admin.pelanggan');
})->name('admin.pelanggan');

Route::get('/admin/pengaturan', function () {
    return view('admin.pengaturan');
})->name('admin.pengaturan');

Route::get('/admin/log-aktivitas', function () {
    return view('admin.log-aktivitas');
})->name('admin.log-aktivitas');

Route::get('/admin/backup-data', function () {
    return view('admin.backup-data');
})->name('admin.backup-data');