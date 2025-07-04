<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed database utama untuk aplikasi Stockify.
     */
    public function run(): void
    {
        // Jalankan seeder lain terlebih dahulu
        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            BarangMasukSeeder::class,
            BarangKeluarSeeder::class,
        ]);

        // --- Akun Demo (Multi-role) ---
        $users = [
            [
                'name'     => 'Admin Demo',
                'email'    => 'admin@email.com',
                'password' => 'password',
                'role'     => 'admin',
            ],
            [
                'name'     => 'Manajer Demo',
                'email'    => 'manajer@email.com',
                'password' => 'password',
                'role'     => 'manajer',
            ],
            [
                'name'     => 'Staff Gudang Demo',
                'email'    => 'staff@email.com',
                'password' => 'password',
                'role'     => 'staff',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name'     => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role'     => $user['role'],
                ]
            );
        }

        // --- Produk Dummy (jika belum dibuat di ProductSeeder) ---
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'nama'     => 'Produk ' . $i,
                'kategori' => 'Kategori ' . rand(1, 3), // Gantilah jika relasi kategori_id digunakan
                'stok'     => rand(50, 200),
                'satuan'   => 'pcs',
            ]);
        }

        // --- Barang Masuk Dummy ---
        $produkList = Product::all();
        foreach ($produkList as $produk) {
         foreach ($produkList as $produk) {
    BarangMasuk::create([
        'produk_id'          => $produk->id,
        'jumlah'             => rand(10, 30),
        'satuan'             => $produk->satuan,
        'status_konfirmasi'  => 'pending',          // ✅ ganti status → status_konfirmasi
        'tanggal'            => now(),
        'supplier_id'        => rand(1, 3),          // pastikan supplier_id valid
    ]);
}


        // --- Barang Keluar Dummy ---
     foreach ($produkList as $produk) {
    BarangKeluar::create([
        'produk_id'          => $produk->id,
        'jumlah'             => rand(5, 20),
        'satuan'             => $produk->satuan,
        'status_konfirmasi'  => 'pending',          // ✅ sama, ganti status
        'tanggal'            => now(),
        'supplier_id'        => rand(1, 3),
    ]);
}

}}}