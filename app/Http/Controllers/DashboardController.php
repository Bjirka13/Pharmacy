<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use App\Models\Obat;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ADMIN Dashboard
        if ($user->hak_akses === 'admin') {
            $totalSupplier = Supplier::count();
            $totalObat = Obat::count();
            $totalPelanggan = User::where('hak_akses', 'pelanggan')->count();
            $stokMenipis = Obat::where('stok', '<', 10)->count();
            $obatExpired = Obat::where('expired', '<=', now()->addDays(30))->count();

            $totalNotifikasi = $stokMenipis + $obatExpired;

            return view('admin.dashboard', compact(
                'totalSupplier',
                'totalObat',
                'totalPelanggan',
                'stokMenipis',
                'obatExpired',
                'totalNotifikasi'
            ));
        }

        // SUPPLIER Dashboard
        if ($user->hak_akses === 'supplier') {
            $totalPesanan = Transaksi::count();
            $pesananAktif = Obat::count(); // ini bisa disesuaikan nanti
            $totalPelanggan = User::where('hak_akses', 'pelanggan')->count();
            $stokMenipis = Obat::where('stok', '<', 10)->count();
            $obatExpired = Obat::where('expired', '<=', now()->addDays(30))->count();

            return view('supplier.dashboard', compact(
                'totalPesanan',
                'pesananAktif',
                'totalPelanggan',
                'stokMenipis',
                'obatExpired'
            ));
        }

        // 🧩 PELANGGAN Dashboard
        if ($user->hak_akses === 'pelanggan') {
            // Ambil semua transaksi user login
            $transaksi = Transaksi::where('id_pelanggan', $user->id)->get();

            // Hitung data statistik
            $totalPesanan = $transaksi->count();
            $pesananAktif = $transaksi->whereIn('status', ['pending', 'proses'])->count();
            $sedangDikirim = $transaksi->where('status', 'proses')->count();
            $totalBelanja = $transaksi->sum('total_harga');

            // 3 pesanan terbaru
            $pesananTerbaru = Transaksi::where('id_pelanggan', $user->id)
                ->latest()
                ->take(3)
                ->get();

            // Produk populer → ambil 5 obat terbaru
            $produkPopuler = Obat::latest()->take(5)->get();

            return view('pelanggan.dashboard', compact(
                'totalPesanan',
                'pesananAktif',
                'sedangDikirim',
                'totalBelanja',
                'pesananTerbaru',
                'produkPopuler'
            ));
        }

        // Jika hak_akses tidak dikenali, redirect ke login
        return redirect('/')->with('error', 'Hak akses tidak valid');
    }
}
