<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;  // ← TAMBAHKAN
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ObatController;

// HALAMAN AUTH (LOGIN & REGISTER)
Route::get('/', [UserController::class, 'loginForm'])->name('login.form');
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'register_store'])->name('register.store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// DASHBOARD (SEMUA ROLE MASUK SINI DULU)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');  // ← UBAH

// ADMIN
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');  // ← UBAH
    Route::get('/users', [UserController::class, 'admin_users'])->name('users');
    Route::get('/supplier', [UserController::class, 'admin_supplier'])->name('supplier');
    Route::get('/pelanggan', [UserController::class, 'admin_pelanggan'])->name('pelanggan');
    Route::get('/produk', [UserController::class, 'admin_produk'])->name('produk');
    Route::get('/transaksi', [UserController::class, 'admin_transaksi'])->name('transaksi');
    Route::get('/laporan', [UserController::class, 'admin_laporan'])->name('laporan');
    Route::get('/profil', [UserController::class, 'admin_profil'])->name('profil');
});

// SUPPLIER
Route::prefix('supplier')->name('supplier.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');  // ← UBAH
    Route::get('/produk', [UserController::class, 'supplier_produk'])->name('produk');
    Route::get('/transaksi', [UserController::class, 'supplier_transaksi'])->name('transaksi');
    Route::get('/profil', [UserController::class, 'supplier_profil'])->name('profil');
});

// PELANGGAN
Route::prefix('pelanggan')->name('pelanggan.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');  // ← UBAH
    Route::get('/pesanan', [UserController::class, 'pelanggan_pesanan'])->name('pesanan');
    Route::get('/keranjang', [UserController::class, 'pelanggan_keranjang'])->name('keranjang');
    Route::get('/profil', [UserController::class, 'pelanggan_profil'])->name('profil');
});

// RESOURCE CONTROLLERS
Route::resource('obat', ObatController::class)->middleware('auth');
Route::resource('supplier', SupplierController::class)->middleware('auth');