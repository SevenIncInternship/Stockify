<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BarangKeluar;
use App\Models\Product;
use Carbon\Carbon;

class BarangKeluarSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            BarangKeluar::create([
                'produk_id' => $product->id,
                'jumlah' => rand(5, 20),
                'tanggal' => Carbon::now()->subDays(rand(1, 30)),
                'status_konfirmasi' => true,
            ]);
        }
    }
}
