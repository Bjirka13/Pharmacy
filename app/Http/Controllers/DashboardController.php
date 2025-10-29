<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use App\Models\Obat;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Untuk admin, tampilkan jumlah data
        if ($user->hak_akses === 'admin') {
            $totalSupplier = Supplier::count();
            $totalObat = Obat::count();

            return view('admin.dashboard', compact('totalSupplier', 'totalObat'));
        }

        return match ($user->hak_akses) {
            'supplier' => view('supplier.dashboard'),
            'pelanggan' => view('pelanggan.dashboard'),
            default => abort(403, 'Akses tidak diizinkan'),
        };
    }
}
