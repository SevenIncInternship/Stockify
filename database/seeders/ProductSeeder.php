<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriPertama = Category::first();
        $supplierPertama = Supplier::first();

        if (!$kategoriPertama || !$supplierPertama) {
            $this->command->warn('Kategori atau Supplier belum tersedia. Seeder Product dilewati.');
            return;
        }

        $productsData = [
            ['nama' => 'Pupuk NPK Mutiara', 'kategori_id' => 1, 'supplier_id' => $supplierPertama->id, 'stock' => 100, 'satuan' => 'kg'],
            ['nama' => 'Bibit Jagung Bisi-18', 'kategori_id' => 2, 'supplier_id' => $supplierPertama->id, 'stock' => 50, 'satuan' => 'kg'],
            ['nama' => 'Fungisida Dithane M-45', 'kategori_id' => 3, 'supplier_id' => $supplierPertama->id, 'stock' => 30, 'satuan' => 'liter'],
        ];

        foreach ($productsData as $product) {
            Product::create($product);
        }

        // Tambahan fallback jika ID kategori di atas tidak valid
        Product::create([
            'nama' => 'Contoh Produk Umum',
            'kategori_id' => $kategoriPertama->id,
            'supplier_id' => $supplierPertama->id,
            'stock' => 150,
            'satuan' => 'pcs',
        ]);
    }
}
