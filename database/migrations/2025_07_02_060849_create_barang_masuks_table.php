<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();

            // Foreign key harus tidak nullable kalau memang required
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');

            $table->integer('jumlah');
            $table->string('satuan');
            $table->date('tanggal');
            $table->string('status_konfirmasi')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('barang_masuks');
    }
};
