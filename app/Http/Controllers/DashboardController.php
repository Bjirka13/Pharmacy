<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return match($user->hak_akses) {
            'admin' => view('admin.dashboard'),
            'supplier' => view('supplier.dashboard'),
            'pelanggan' => view('pelanggan.dashboard'),
            default => abort(403, 'Akses tidak diizinkan'),
        };
    }
}
