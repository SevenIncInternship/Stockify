<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Category;
use App\Models\Supplier;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            BarangMasukSeeder::class,
            BarangKeluarSeeder::class,
        ]);

        // --- Akun Demo ---
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

        // --- Tambahan Produk Dummy ---
        $categories = Category::all();
        $suppliers = Supplier::all();

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'nama'        => 'Produk ' . $i,
                'kategori_id' => $categories->random()->id,
                'supplier_id' => $suppliers->random()->id,
                'stock'       => rand(50, 200),
                'satuan'      => 'pcs',
            ]);
        }

        // --- Barang Masuk Dummy ---
        $produkList = Product::all();
        foreach ($produkList as $produk) {
            BarangMasuk::create([
                'produk_id'       => $produk->id,
                'jumlah'          => rand(10, 30),
                'tanggal'         => Carbon::now()->subDays(rand(1, 15)),
                'supplier_id'     => $produk->supplier_id,
                'status_konfirmasi' => true,
            ]);
        }

        // --- Barang Keluar Dummy ---
        foreach ($produkList as $produk) {
            BarangKeluar::create([
                'produk_id'       => $produk->id,
                'jumlah'          => rand(5, 20),
                'tanggal'         => Carbon::now()->subDays(rand(1, 10)),
                'status_konfirmasi' => true,
            ]);
        }
    }
}
