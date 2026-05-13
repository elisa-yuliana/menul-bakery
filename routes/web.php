<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BahanMasukController;
use App\Http\Controllers\BahanKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;

// --- GUEST: Hanya bisa diakses jika BELUM login ---
Route::middleware('guest')->group(function () {
    // Login dan Register STAFF
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    // Login dan Register ADMIN
    Route::get('/admin-login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/admin-login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');
    Route::get('/admin-register', [AuthController::class, 'showAdminRegisterForm'])->name('admin.register');
    Route::post('/admin-register', [AuthController::class, 'adminRegister'])->name('admin.register.submit');
});

// --- AUTH: Harus login untuk akses fitur ini ---
Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard (Home)
    // Saya arahkan '/' langsung ke dashboard jika sudah login
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index']); 

    // Fitur Bahan (Sama-sama bisa diakses Staff & Admin)
    Route::prefix('bahan')->name('bahan.')->group(function() {
        Route::get('/', [BahanController::class, 'index'])->name('index');
        Route::post('/store', [BahanController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BahanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BahanController::class, 'update'])->name('update');
        Route::delete('/{id}', [BahanController::class, 'destroy'])->name('destroy');
        Route::post('/lunas/{id}', [DashboardController::class, 'tandaiLunas'])->name('lunas');
    });

    // Bahan Masuk
    Route::get('/bahan-masuk', [BahanMasukController::class,'index'])->name('bahan_masuk.index');
    Route::post('/bahan-masuk/store', [BahanMasukController::class, 'store'])->name('bahan_masuk.store');

    // Bahan Keluar
    Route::get('/bahan-keluar', [BahanKeluarController::class,'index'])->name('bahan_keluar.index');
    Route::post('/bahan-keluar/store', [BahanKeluarController::class, 'store'])->name('bahan_keluar.store');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPDF'])->name('laporan.pdf');

    // Fitur Khusus ADMIN (Jika ingin tambah list user nanti)
    Route::middleware(['admin'])->group(function () {
    Route::get('/admin/kelola-staff', [AuthController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/tambah-staff', [AuthController::class, 'showRegisterForm'])->name('admin.staff.create');
    
    // Proses hapus staff
    Route::delete('/admin/kelola-staff/{id}', [AuthController::class, 'destroyStaff'])->name('admin.users.destroy');
    });
});