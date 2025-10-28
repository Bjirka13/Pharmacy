<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'hak_akses' => 'required|in:admin,supplier,pelanggan',
        ]);

        // Enkripsi password
        $validate['password'] = Hash::make($validate['password']);

        // Simpan user
        $user = User::create($validate);

        // Kalau yang daftar supplier, buat record di tabel supplier
        if ($validate['hak_akses'] === 'supplier') {
            Supplier::create([
                'id_user' => $user->id,
                'perusahaan' => $request->input('perusahaan', 'Belum diisi'),
                'alamat' => $request->input('alamat', 'Belum diisi'),
                'telepon' => $request->input('telepon', 'Belum diisi'),
            ]);
        }

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
    }
}
