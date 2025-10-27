<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $role = auth()->user()->hak_akses;
        $search = $request->input('search');
		
		$obats = Obat::with('supplier')
			->when($search, function ($query) use ($search) {
				$query->where('nama', 'like', "%{$search}%")
					  ->orWhereHas('supplier', function($q) use ($search) {
							$q->where('perusahaan', 'like', "%{$search}%");
					  });
			})
			->get();
        $menu = 'Obat';
        $subMenu = 'Index';

        if ($role == 'admin') {
            return view('admin.obat.index', compact('obats', 'menu', 'subMenu'));
        } elseif ($role == 'supplier') {
            return view('supplier.obat.index', compact('obats', 'menu', 'subMenu'));
        } elseif ($role == 'pelanggan') {
            return view('pelanggan.obat.index', compact('obats', 'menu', 'subMenu'));
        } else {
            abort(403, 'Tidak memiliki akses');
        }
    }

    public function create()
    {
        $role = auth()->user()->hak_akses;

        $suppliers = Supplier::all();
        $menu = 'Obat';
        $subMenu = 'Create';

        if ($role == 'admin') {
            return view('admin.obat.create', compact('suppliers', 'menu', 'subMenu'));
        } elseif ($role == 'supplier') {
            return view('supplier.obat.create', compact('suppliers', 'menu', 'subMenu'));
        } else {
            abort(403, 'Hanya admin dan supplier bisa menambah obat');
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'expired' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'id_supplier' => 'required',
        ]);

        $simpan = Obat::create($validate);

        return response()->json([
            'message' => $simpan 
                ? 'Data Berhasil Ditambahkan' 
                : 'Data Gagal Ditambahkan'
        ]);
    }
	
	public function edit($id)
{
    $obat = Obat::findOrFail($id);
    $suppliers = Supplier::all();

    $menu = 'Obat';
    $subMenu = 'Edit';

    return view('admin.obat.edit', compact('obat', 'suppliers', 'menu', 'subMenu'));
}

	public function update(Request $request, $id)
	{
		$validate = $request->validate([
			'nama' => 'required',
			'expired' => 'required',
			'harga_beli' => 'required',
			'harga_jual' => 'required',
			'stok' => 'required',
			'id_supplier' => 'required',
		]);

		$obat = Obat::findOrFail($id);
		$obat->update($validate);

		// Karena kita pakai AJAX → return json
		return response()->json(['message' => 'Data Berhasil Diperbarui']);
	}

	public function destroy($id)
	{
		$obat = Obat::findOrFail($id);
		$obat->delete();

		return redirect()->route('obat.index')->with('success', 'Data Berhasil Dihapus');
	}

}
