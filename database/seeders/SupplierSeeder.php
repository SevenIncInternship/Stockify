<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
    [
        'nama' => 'PT Agro Tani Sejahtera',
        'alamat' => 'Jl. Pertanian No. 12, Purwokerto',
        'telepon' => '082234567890',
    ],
    [
        'nama' => 'CV Tumbuh Bersama',
        'alamat' => 'Jl. Raya Sawah, Banyumas',
        'telepon' => '081212345678',
    ],
    [
        'nama' => 'Supplier Nusantara',
        'alamat' => 'Jl. Nasional 3, Kebumen',
        'telepon' => '085678123456',
    ],
];


        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
