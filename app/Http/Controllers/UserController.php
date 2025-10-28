<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // REGISTER
    public function register()
    {
        return view('auth.register');
    }

    public function register_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6', 
            'hak_akses' => 'required|in:admin,supplier,pelanggan',
        ]);

        // Simpan user dengan password hash
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'hak_akses' => $validated['hak_akses'],
        ]);

        // Simpan detail user
        DetailUser::create([
            'id_user' => $user->id,
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        // Arahkan ke dashboard sesuai role
        return $this->redirectToDashboard($user);
    }


    // LOGIN
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return $this->redirectToDashboard($user);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }


    // DASHBOARD
    public function dashboard()
	{
		$user = Auth::user();
		if (!$user) {
			return redirect()->route('login');
		}

		if ($user->hak_akses === 'admin') {
			return view('admin.dashboard');
		} elseif ($user->hak_akses === 'supplier') {
			return view('supplier.dashboard');
		} elseif ($user->hak_akses === 'pelanggan') {
			return view('pelanggan.dashboard');
		}

		return redirect()->route('login');
	}


    private function redirectToDashboard($user)
    {
        if ($user->hak_akses === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hak_akses === 'supplier') {
            return redirect()->route('supplier.dashboard');
        } elseif ($user->hak_akses === 'pelanggan') {
            return redirect()->route('pelanggan.dashboard');
        }

        return redirect('/');
    }


    // SUPPLIER VIEWS
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


    // PELANGGAN VIEWS
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


    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
