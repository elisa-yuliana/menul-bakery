<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BahanMasukController;
use App\Http\Controllers\BahanKeluarController;
use App\Http\Controllers\LaporanController;

// dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// list bahan
Route::get('/bahan', [BahanController::class, 'index'])->name('bahan.index');
// tambah bahan
Route::get('/bahan/create', [BahanController::class, 'create']);
Route::post('/bahan/store', [BahanController::class, 'store']);
// edit bahan (FORM)
Route::get('/bahan/{id}/edit', [BahanController::class, 'edit']);
// update bahan (INI YANG FIX)
Route::put('/bahan/{id}', [BahanController::class, 'update']);

// delete bahan
Route::post('/bahan/{id}/delete', [BahanController::class, 'destroy']);

// bahan masuk
Route::get('/bahan-masuk', [BahanMasukController::class,'index'])->name('bahan_masuk.index');
Route::get('/bahan-masuk/create', [BahanMasukController::class, 'create']);
Route::post('/bahan-masuk/store', [BahanMasukController::class, 'store']);

// bahan keluar
Route::get('/bahan-keluar', [BahanKeluarController::class,'index'])->name('bahan_keluar.index');
Route::get('/bahan-keluar/create', [BahanKeluarController::class, 'create']);
Route::post('/bahan-keluar/store', [BahanKeluarController::class, 'store']);

// laporan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/pdf', [LaporanController::class, 'exportPDF']);

// =====================
// BAHAN (SUDAH FIX FULL)
// =====================

