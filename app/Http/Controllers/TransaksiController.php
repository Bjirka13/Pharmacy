<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Obat;
use App\Models\Keranjang;
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
    // PESANAN PELANGGAN (INDEX)
    // =============================
    public function pesananPelanggan()
    {
        $transaksi = Transaksi::with('detail.obat')
            ->where('id_pelanggan', Auth::id())
            ->latest()
            ->get();

        return view('pelanggan.pesanan.index', compact('transaksi'));
    }

    // =============================
    // CHECKOUT dari KERANJANG
    // =============================
    public function checkout(Request $request)
    {
        $keranjang = Keranjang::with('obat')
            ->where('user_id', Auth::id())
            ->get();

        if ($keranjang->isEmpty()) {
            return redirect()->route('pelanggan.keranjang')->with('error', 'Keranjang Anda kosong!');
        }

        $total = $keranjang->sum(fn($item) => $item->obat->harga * $item->jumlah);

        $transaksi = Transaksi::create([
            'id_pelanggan' => Auth::id(),
            'notransaksi' => 'TRX-' . strtoupper(Str::random(6)),
            'tanggal_transaksi' => Carbon::now(),
            'status' => 'pending',
            'total_pembayaran' => $total,
        ]);

        foreach ($keranjang as $item) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'obat_id' => $item->obat_id,
                'jumlah' => $item->jumlah,
                'subtotal' => $item->obat->harga * $item->jumlah,
            ]);
        }

        // Kosongkan keranjang setelah checkout
        Keranjang::where('user_id', Auth::id())->delete();

        return redirect()
            ->route('pelanggan.pesanan')
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    // =============================
    // PEMBATALAN PESANAN (PELANGGAN)
    // =============================
    public function batal(Request $request, $id)
    {
        $transaksi = Transaksi::where('id', $id)
            ->where('id_pelanggan', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        $transaksi->update(['status' => 'batal']);

        return response()->json(['success' => true]);
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
    // UPDATE (ADMIN)
    // =============================
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,proses,selesai,batal',
        ]);

        $transaksi->update(['status' => $request->status]);

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

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
