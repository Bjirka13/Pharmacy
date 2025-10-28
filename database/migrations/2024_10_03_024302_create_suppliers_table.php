<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('id_supplier'); // kalau kamu pakai id_supplier sebagai PK
            $table->unsignedBigInteger('id_user'); // relasi ke tabel users
            $table->string('perusahaan');
            $table->string('alamat');
            $table->string('telepon');
            $table->timestamps();

            // relasi ke tabel users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
