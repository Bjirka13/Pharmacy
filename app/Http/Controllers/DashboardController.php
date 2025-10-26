<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
	{
		$user = auth()->user();

		if ($user->hak_akses == 'admin') {
			return view('admin.dashboard');
		} elseif ($user->hak_akses == 'supplier') {
			return view('supplier.dashboard');
		} elseif ($user->hak_akses == 'pelanggan') {
			return view('pelanggan.dashboard');
		}

		return redirect('/')->with('error', 'Hak akses tidak dikenali');
	}
}
