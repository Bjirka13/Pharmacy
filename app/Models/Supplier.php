<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = ['id_user', 'perusahaan', 'alamat', 'telepon'];

   public function obat()
	{
		return $this->hasMany(Obat::class, 'id_supplier', 'id');
	}
	
	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
