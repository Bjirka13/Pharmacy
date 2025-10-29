<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use App\Models\Obat;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hak_akses === 'admin') {
            $totalSupplier = Supplier::count();
            $totalObat = Obat::count();
            $totalPelanggan = User::where('hak_akses', 'pelanggan')->count();
            $stokMenipis = Obat::where('stok', '<', 10)->count();
            $obatExpired = Obat::where('expired', '<=', now()->addDays(30))->count();

            // kirim semua variabel ke view
            return view('admin.dashboard', compact(
                'totalSupplier',
                'totalObat',
                'totalPelanggan',
                'stokMenipis',
                'obatExpired'
            ));
        }

        if ($user->hak_akses === 'supplier') {
            return view('supplier.dashboard');
        }

        if ($user->hak_akses === 'pelanggan') {
            return view('pelanggan.dashboard');
        }

        abort(403, 'Akses tidak diizinkan');
    }
}
