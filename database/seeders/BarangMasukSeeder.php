<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BarangMasuk;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;

class BarangMasukSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $suppliers = Supplier::all();

        foreach ($products as $product) {
            BarangMasuk::create([
                'produk_id' => $product->id,
                'jumlah' => rand(10, 50),
                'tanggal' => Carbon::now()->subDays(rand(1, 30)),
                'supplier_id' => $suppliers->random()->id,
                'status_konfirmasi' => true,
            ]);
        }
    }
}
