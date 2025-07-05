<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
       public function up(): void
    {
    // database/migrations/xxxx_xx_xx_create_barang_masuks_table.php
    Schema::create('barang_masuks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('produk_id')->constrained('products')->onDelete('cascade');
        $table->integer('jumlah');
        $table->date('tanggal')->nullable();
        $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
        $table->enum('status_konfirmasi', ['pending', 'disetujui', 'ditolak'])->default('pending');
        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
