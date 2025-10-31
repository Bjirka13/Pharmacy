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
		try {
			$validate = $request->validate([
				'name' => 'required|string|max:255',
				'email' => 'required|email|unique:users',
				'password' => 'required|min:6',
				'perusahaan' => 'required|string|max:255',
				'alamat' => 'required|string',
				'telepon' => 'required|string|max:20',
			]);
			
			// Buat user supplier
			$user = User::create([
				'name' => $validate['name'],
				'email' => $validate['email'],
				'password' => Hash::make($validate['password']),
				'hak_akses' => 'supplier',
			]);
			
			// Buat record di tabel supplier
			$supplier = Supplier::create([
				'id_user' => $user->id,
				'perusahaan' => $validate['perusahaan'],
				'alamat' => $validate['alamat'],
				'telepon' => $validate['telepon'],
			]);
			
			// RETURN JSON UNTUK AJAX
			if ($request->ajax() || $request->wantsJson()) {
				return response()->json([
					'success' => true,
					'message' => 'Supplier berhasil ditambahkan!',
					'data' => $supplier
				]);
			}
			
			return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
			
		} catch (\Illuminate\Validation\ValidationException $e) {
			// VALIDATION ERRORS
			if ($request->ajax() || $request->wantsJson()) {
				return response()->json([
					'success' => false,
					'message' => 'Validasi gagal',
					'errors' => $e->errors()
				], 422);
			}
			return redirect()->back()->withErrors($e->errors())->withInput();
			
		} catch (\Exception $e) {
			// OTHER ERRORS
			if ($request->ajax() || $request->wantsJson()) {
				return response()->json([
					'success' => false,
					'message' => 'Gagal menambahkan supplier: ' . $e->getMessage()
				], 500);
			}
			return redirect()->route('supplier.index')->with('error', 'Gagal menambahkan supplier: ' . $e->getMessage());
		}
	}
	
	public function edit($id) 
	{
		$supplier = Supplier::findOrFail($id); $menu = 'Supplier'; $subMenu = 'Edit'; return view('admin.supplier.edit', compact('supplier', 'menu', 'subMenu')); 
		
	} 
	
	public function update(Request $request, $id) 
	{ 
		$validate = $request->validate([ 'perusahaan' => 'required', 'alamat' => 'required', 'telepon' => 'required', ]); 
		$supplier = Supplier::findOrFail($id); 
		
		$supplier->update($validate); return response()->json(['message' => 'Data Berhasil Diperbarui']); 	
	}
	
    public function destroy(Request $request, $id)
	{
		try {
			$supplier = Supplier::findOrFail($id);
			$user = User::findOrFail($supplier->id_user);
			
			// Hapus supplier dulu
			$supplier->delete();
			
			// Hapus user
			$user->delete();
			
			// PASTI RETURN JSON UNTUK AJAX
			if ($request->ajax() || $request->wantsJson()) {
				return response()->json([
					'success' => true,
					'message' => 'Supplier berhasil dihapus!'  // ← INI YANG DIPANGGIL response.message
				]);
			}
			
			return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
			
		} catch (\Exception $e) {
			if ($request->ajax() || $request->wantsJson()) {
				return response()->json([
					'success' => false,
					'message' => 'Gagal menghapus supplier: ' . $e->getMessage()
				], 500);
			}
			return redirect()->route('supplier.index')->with('error', 'Gagal menghapus supplier: ' . $e->getMessage());
		}
	}
}
