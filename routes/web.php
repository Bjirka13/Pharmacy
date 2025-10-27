<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\DashboardController;

// Halaman Utama / Login
Route::view('/', 'auth.login');

// Auth
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'register_store'])->name('register.store');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

// ADMIN
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [UserController::class, 'admin_users'])->name('users');
    Route::get('/supplier', [UserController::class, 'admin_supplier'])->name('supplier');
    Route::get('/pelanggan', [UserController::class, 'admin_pelanggan'])->name('pelanggan');
    Route::get('/produk', [UserController::class, 'admin_produk'])->name('produk');
    Route::get('/transaksi', [UserController::class, 'admin_transaksi'])->name('transaksi');
    Route::get('/laporan', [UserController::class, 'admin_laporan'])->name('laporan');
    Route::get('/profil', [UserController::class, 'admin_profil'])->name('profil');
});

// SUPPLIER
Route::prefix('supplier')->name('supplier.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/produk', [UserController::class, 'supplier_produk'])->name('produk');
    Route::get('/transaksi', [UserController::class, 'supplier_transaksi'])->name('transaksi');
    Route::get('/profil', [UserController::class, 'supplier_profil'])->name('profil');
});

// ========== PELANGGAN ==========
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/pesanan', [UserController::class, 'pelanggan_pesanan'])->name('pesanan');
    Route::get('/keranjang', [UserController::class, 'pelanggan_keranjang'])->name('keranjang');
    Route::get('/profil', [UserController::class, 'pelanggan_profil'])->name('profil');
});

Route::resource('obat', ObatController::class);
Route::resource('supplier', SupplierController::class);