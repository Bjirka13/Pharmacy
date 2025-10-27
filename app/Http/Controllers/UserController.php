<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function register_store(Request $request)
    {
        $validate  = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'hak_akses' => 'required',
        ]);

        $simpan_user = User::create($validate);

        if ($simpan_user) {
            $id_user = $simpan_user->id;
            $simpan_detailUser = DetailUser::create([
                'id_user' => $id_user,
            ]);
            if ($simpan_detailUser) {
                return redirect('/');
            }else{
                return redirect('/register');
            }
        } else {
            return redirect('/register');
        }
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validate)) {
            return redirect('/dashboard');
        } else {
            return redirect('/');
        }
    }
	
	public function dashboard() 
	{
		$user = Auth::user();
		if($user->hak_akses == 'admin'){
			return view('admin.dashboard');
		} elseif($user->hak_akses == 'supplier') {
			return view('supplier.dashboard');
		} else {
			return redirect('/');
		}
	}
	
	// Supplier
    public function supplier_produk()
    {
        return view('supplier.produk');
    }

    public function supplier_transaksi()
    {
        return view('supplier.transaksi');
    }

    public function supplier_profil()
    {
        return view('supplier.profil');
    }
	
	// Method untuk Pelanggan
    public function pelanggan_pesanan()
    {
        return view('pelanggan.pesanan');
    }

    public function pelanggan_keranjang()
    {
        return view('pelanggan.keranjang');
    }

    public function pelanggan_profil()
    {
        return view('pelanggan.profil');
    }

	
	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect('/');
	}

}
