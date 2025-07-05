<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

<<<<<<< Updated upstream
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
=======
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
            BarangMasuk::create([
                'produk_id'  => $produk->id,
                'nama_barang' => $produk->nama,
                'jumlah'      => rand(10, 30),
                'satuan'      => $produk->satuan,
                'status'      => 'pending',
            ]);
        }

        // --- Barang Keluar Dummy ---
        foreach ($produkList as $produk) {
            BarangKeluar::create([
                'produk_id'  => $produk->id,
                'nama_barang' => $produk->nama,
                'jumlah'      => rand(5, 20),
                'satuan'      => $produk->satuan,
                'status'      => 'pending',
            ]);
        }
>>>>>>> Stashed changes
    }
}
