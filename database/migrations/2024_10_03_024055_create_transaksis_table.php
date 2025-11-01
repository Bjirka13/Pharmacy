<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('notransaksi');
            $table->dateTime('tanggal_transaksi'); // UBAH dari date ke dateTime
            $table->enum('status',['pending','proses','selesai','batal'])->default('pending'); // UBAH enum
            $table->integer('total_pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};