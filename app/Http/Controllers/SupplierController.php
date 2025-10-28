<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    public function index()
    {
		$menu = 'Supplier';
		$subMenu = 'Data Supplier';
        $suppliers = Supplier::with('user')->get();
        return view('admin.supplier.index', compact('suppliers', 'menu', 'subMenu'));
    }

    public function create()
    {
		$menu = 'Supplier';
		$subMenu = 'Tambah Supplier';
        return view('admin.supplier.create', compact('menu', 'subMenu'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'perusahaan' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        // Buat user supplier
        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
            'hak_akses' => 'supplier',
        ]);

        // Buat record di tabel supplier
        Supplier::create([
            'id_user' => $user->id,
            'perusahaan' => $validate['perusahaan'],
            'alamat' => $validate['alamat'],
            'telepon' => $validate['telepon'],
        ]);

        return response()->json(['message' => 'Supplier berhasil ditambahkan']);
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->user()->delete(); // hapus juga usernya
        $supplier->delete();

        return response()->json(['message' => 'Supplier berhasil dihapus']);
    }
}
