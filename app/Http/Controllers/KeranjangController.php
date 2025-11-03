<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Obat;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KeranjangController extends Controller
{
    // =============================
    // TAMPILKAN KERANJANG
    // =============================
    public function index()
    {
        $keranjang = Keranjang::with('obat')
            ->where('id_pelanggan', Auth::id())
            ->get();

        return view('pelanggan.keranjang.index', compact('keranjang'));
    }

    // =============================
    // TAMBAH KE KERANJANG
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|exists:obats,id',
            'jumlah'  => 'required|numeric|min:1',
        ]);

        $existing = Keranjang::where('id_pelanggan', Auth::id())
            ->where('obat_id', $request->obat_id)
            ->first();

        if ($existing) {
            // Kalau sudah ada, tambah jumlahnya
            $existing->update([
                'jumlah' => $existing->jumlah + $request->jumlah,
            ]);
        } else {
            Keranjang::create([
                'id_pelanggan' => Auth::id(),
                'obat_id' => $request->obat_id,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // =============================
    // UBAH JUMLAH PRODUK
    // =============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
        ]);

        $item = Keranjang::where('id', $id)
            ->where('id_pelanggan', Auth::id())
            ->firstOrFail();

        $item->update(['jumlah' => $request->jumlah]);

        return redirect()->back()->with('success', 'Jumlah produk diperbarui!');
    }

    // =============================
    // HAPUS PRODUK DARI KERANJANG
    // =============================
    public function destroy($id)
    {
        $item = Keranjang::where('id', $id)
            ->where('id_pelanggan', Auth::id())
            ->firstOrFail();

        $item->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
    }

    // =============================
    // CHECKOUT
    // =============================
    public function checkout()
    {
        $keranjang = Keranjang::with('obat')
            ->where('id_pelanggan', Auth::id())
            ->get();

        if ($keranjang->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong!');
        }

        $total = 0;
        foreach ($keranjang as $item) {
            $total += $item->obat->harga_jual * $item->jumlah;
        }

        // Buat transaksi baru
        $transaksi = Transaksi::create([
            'id_pelanggan' => Auth::id(),
            'notransaksi' => 'TRX-' . strtoupper(Str::random(6)),
            'tanggal_transaksi' => Carbon::now(),
            'status' => 'pending',
            'total_pembayaran' => $total,
        ]);

        // Pindahkan item dari keranjang ke detail_transaksi
        foreach ($keranjang as $item) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'obat_id' => $item->obat_id,
                'jumlah' => $item->jumlah,
                'subtotal' => $item->obat->harga_jual * $item->jumlah,
            ]);
        }

        // Hapus isi keranjang setelah checkout
        Keranjang::where('id_pelanggan', Auth::id())->delete();

        return redirect()->route('pelanggan.pesanan')->with('success', 'Pesanan Anda berhasil dibuat!');
    }
}
