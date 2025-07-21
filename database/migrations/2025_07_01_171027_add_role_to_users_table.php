<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Menambahkan kolom 'role' ke tabel 'users' dengan nilai default 'staff'.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->after('email')->default('staff');
        });
    }

    /**
     * Balikkan migrasi.
     * Menghapus kolom 'role' dari tabel 'users'.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom 'role' jika migrasi di-rollback.
            $table->dropColumn('role');
        });
    }
};
