<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;  
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TransaksiController; 

// HALAMAN AUTH (LOGIN & REGISTER)
Route::get('/', [UserController::class, 'loginForm'])->name('login.form');
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'register_store'])->name('register.store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// DASHBOARD (SEMUA ROLE MASUK SINI DULU)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// ADMIN 
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'admin_users'])->name('users');
    Route::get('/supplier', [UserController::class, 'admin_supplier'])->name('supplier');
    Route::get('/pelanggan', [UserController::class, 'admin_pelanggan'])->name('pelanggan');
    Route::get('/produk', [UserController::class, 'admin_produk'])->name('produk');
    Route::get('/laporan', [UserController::class, 'admin_laporan'])->name('laporan');
    Route::get('/profil', [UserController::class, 'admin_profil'])->name('profil');
    
    // Admin Transaksi Routes
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});

// SUPPLIER
Route::prefix('supplier')->name('supplier.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/produk', [UserController::class, 'supplier_produk'])->name('produk');
    Route::get('/transaksi', [UserController::class, 'supplier_transaksi'])->name('transaksi');
    Route::get('/profil', [UserController::class, 'supplier_profil'])->name('profil');
});

// PELANGGAN 
Route::prefix('pelanggan')->name('pelanggan.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // FIX: Route pesanan sekarang mengarah ke TransaksiController
    Route::get('/pesanan', [TransaksiController::class, 'pesananPelanggan'])->name('pesanan');
    
    // Transaksi routes untuk pelanggan
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::put('/transaksi/{id}/batal', [TransaksiController::class, 'update'])->name('transaksi.batal');
    
    Route::get('/keranjang', [UserController::class, 'pelanggan_keranjang'])->name('keranjang');
    Route::get('/profil', [UserController::class, 'pelanggan_profil'])->name('profil');
});

// RESOURCE CONTROLLERS
Route::resource('obat', ObatController::class)->middleware('auth');
Route::resource('supplier', SupplierController::class)->middleware('auth');