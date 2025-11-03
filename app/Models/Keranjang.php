<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = ['id_pelanggan', 'obat_id', 'jumlah'];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'id_pelanggan');
    }
}
