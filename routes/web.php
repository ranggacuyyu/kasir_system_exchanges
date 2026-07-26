<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');

Route::get('/kasir', [KasirController::class, 'cekUser'])->name('login');

Route::get('/kasir/dashboard', [KasirController::class, 'dashboard'])->name('kasir.dashboard');


