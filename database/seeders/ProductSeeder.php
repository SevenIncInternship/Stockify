<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category; // Pastikan model Category diimpor

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Pastikan ada kategori yang sudah ada di database.
        // Jika CategorySeeder dipanggil sebelum ini, ini akan aman.
        $kategoriPertama = Category::first();

        // Data produk dummy yang lebih spesifik
        $productsData = [
            // Pastikan kategori_id sesuai dengan ID kategori yang ada di database Anda
            ['nama' => 'Pupuk NPK Mutiara', 'kategori_id' => 1, 'stok' => 100, 'satuan' => 'kg'],
            ['nama' => 'Bibit Jagung Bisi-18', 'kategori_id' => 2, 'stok' => 50, 'satuan' => 'kg'],
            ['nama' => 'Fungisida Dithane M-45', 'kategori_id' => 3, 'stok' => 30, 'satuan' => 'liter'],
        ];

        foreach ($productsData as $product) {
            Product::create($product);
        }

        // Tambahkan contoh produk menggunakan kategori pertama yang ditemukan
        // Ini berguna sebagai fallback atau untuk memastikan setidaknya ada satu produk
        // yang terkait dengan kategori yang ada jika ID di atas tidak valid.
        if ($kategoriPertama) {
            Product::create([
                'nama' => 'Contoh Produk Umum',
                'kategori_id' => $kategoriPertama->id,
                'stok' => 150,
                'satuan' => 'pcs',
            ]);
        } else {
            // Jika tidak ada kategori, Anda bisa membuat produk tanpa kategori_id
            // atau log peringatan.
            Product::create([
                'nama' => 'Contoh Produk Tanpa Kategori',
                'stok' => 75,
                'satuan' => 'unit',
            ]);
            // Atau tampilkan pesan di console saat seeding
            $this->command->info('Tidak ada kategori ditemukan. Produk "Contoh Produk Tanpa Kategori" dibuat tanpa kategori_id.');
        }

        // Anda juga bisa menambahkan lebih banyak produk dummy di sini
        // Product::factory()->count(20)->create(); // Jika Anda menggunakan factory
    }
}
