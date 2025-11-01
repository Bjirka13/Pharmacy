<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // =============================
    // INDEX (ADMIN)
    // =============================
    public function index()
    {
        $transaksi = Transaksi::with(['pelanggan', 'detail.obat'])
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksi'));
    }

    // =============================
    // CREATE (PELANGGAN)
    // =============================
    public function create()
    {
        $obat = Obat::all();
        return view('pelanggan.transaksi.create', compact('obat'));
    }

    // =============================
    // STORE (PELANGGAN BUAT PESANAN)
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'obat_id.*' => 'required|exists:obats,id',
            'jumlah.*'  => 'required|numeric|min:1',
        ]);

        $total = 0;
        $items = [];

        foreach ($request->obat_id as $index => $id) {
            $obat = Obat::findOrFail($id);
            $jumlah = $request->jumlah[$index];
            $subtotal = $obat->harga * $jumlah;

            $total += $subtotal;

            $items[] = [
                'obat_id' => $obat->id,
                'jumlah'  => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        $transaksi = Transaksi::create([
            'id_pelanggan' => Auth::id(),
            'notransaksi' => 'TRX-' . strtoupper(Str::random(6)),
            'tanggal_transaksi' => Carbon::now(),
            'status' => 'pending',
            'total_pembayaran' => $total,
        ]);

        foreach ($items as $item) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'obat_id' => $item['obat_id'],
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        return redirect()
            ->route('pelanggan.pesanan')
            ->with('success', 'Pesanan Anda berhasil dibuat!');
    }

    // =============================
    // PELANGGAN: LIHAT PESANAN SENDIRI
    // =============================
    public function pesananPelanggan()
    {
        $transaksi = Transaksi::with('detail.obat')
            ->where('id_pelanggan', Auth::id())
            ->latest()
            ->get();

        return view('pelanggan.pesanan', compact('transaksi'));
    }

    // =============================
    // EDIT (ADMIN)
    // =============================
    public function edit($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'detail.obat'])->findOrFail($id);
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    // =============================
    // UPDATE (ADMIN & PELANGGAN)
    // =============================
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // ADMIN ubah status secara bebas
        if (Auth::user()->hak_akses === 'admin') {
            $request->validate([
                'status' => 'required|in:pending,proses,selesai,batal',
            ]);
            $transaksi->update([
                'status' => $request->status,
            ]);
        } 
        // PELANGGAN hanya bisa batalkan
        elseif (Auth::user()->hak_akses === 'pelanggan') {
            if ($transaksi->id_pelanggan != Auth::id()) {
                abort(403, 'Anda tidak memiliki akses untuk pesanan ini.');
            }
            $transaksi->update([
                'status' => 'batal',
            ]);
        }

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui!');
    }

    // =============================
    // DESTROY (ADMIN)
    // =============================
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->detail()->delete();
        $transaksi->delete();

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
