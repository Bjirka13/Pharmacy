<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KeranjangController;

// -----------------------------
// HALAMAN AUTH (LOGIN & REGISTER)
// -----------------------------
Route::get('/', [UserController::class, 'loginForm'])->name('login.form');
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'register_store'])->name('register.store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// -----------------------------
// DASHBOARD UMUM
// -----------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// -----------------------------
// ADMIN
// -----------------------------
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'admin_users'])->name('users');
    Route::get('/pelanggan', [UserController::class, 'admin_pelanggan'])->name('pelanggan');
    Route::get('/produk', [UserController::class, 'admin_produk'])->name('produk');
    Route::get('/laporan', [UserController::class, 'admin_laporan'])->name('laporan');
    Route::get('/profil', [UserController::class, 'admin_profil'])->name('profil');

    // Admin Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

    // Admin Supplier Resource - Ini akan membuat semua route CRUD
    // Ganti dari:
	Route::resource('supplier', SupplierController::class);

	// Jadi pakai nama yang lebih spesifik:
	Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
	Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
	Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
	Route::get('/supplier/{id_supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
	Route::put('/supplier/{id_supplier}', [SupplierController::class, 'update'])->name('supplier.update');
	Route::delete('/supplier/{id_supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
});

// -----------------------------
// SUPPLIER
// -----------------------------
Route::prefix('supplier')->name('supplier.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/produk', [UserController::class, 'supplier_produk'])->name('produk');
    Route::get('/transaksi', [UserController::class, 'supplier_transaksi'])->name('transaksi.index');
    Route::get('/profil', [UserController::class, 'supplier_profil'])->name('profil');
});

// -----------------------------
// PELANGGAN
// -----------------------------
Route::prefix('pelanggan')->name('pelanggan.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pesanan pelanggan
    Route::get('/pesanan', [TransaksiController::class, 'pesananPelanggan'])->name('pesanan');

    // Transaksi pelanggan
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::put('/transaksi/{id}/batal', [TransaksiController::class, 'update'])->name('transaksi.batal');
	Route::post('/transaksi/beli', [TransaksiController::class, 'beli'])->name('transaksi.beli');

    // Keranjang pelanggan
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
	Route::put('/keranjang/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
	Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::post('/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');
    
	
    Route::get('/profil', [UserController::class, 'pelanggan_profil'])->name('profil');
});

// -----------------------------
// RESOURCE CONTROLLERS
// -----------------------------
Route::resource('obat', ObatController::class)->middleware('auth');