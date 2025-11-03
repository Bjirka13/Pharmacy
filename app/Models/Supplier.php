<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    
    // PENTING! Karena migration pakai id_supplier, bukan id
    protected $primaryKey = 'id_supplier';
    
    protected $fillable = [
        'id_user',
        'perusahaan',
        'alamat',
        'telepon',
    ];
    
    // Relationship ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    
    // Relationship ke Obat (jika ada)
    public function obats()
    {
        return $this->hasMany(Obat::class, 'id_supplier', 'id_supplier');
    }
}