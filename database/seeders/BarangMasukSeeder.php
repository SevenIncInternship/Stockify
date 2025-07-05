<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BarangMasuk;
use App\Models\Product;
use Carbon\Carbon;

class BarangMasukSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            BarangMasuk::create([
                'produk_id' => $product->id,
                'jumlah' => rand(10, 50),
                'satuan' => $product->satuan ?? 'pcs', // fallback jika satuan tidak tersedia
                'status_konfirmasi' => 'pending',
                'tanggal' => Carbon::now()->subDays(rand(1, 30)),
                'supplier_id' => rand(1, 3), // asumsikan ada supplier dengan id 1–3
            ]);
        }
    }
}