<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $fillable = [
        'id_pelanggan', 'notransaksi', 'tanggal_transaksi', 'status', 'total_pembayaran'
    ];

    // FIX: Ganti dari Pelanggan ke User
    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'id_pelanggan');
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
}