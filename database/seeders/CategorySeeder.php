<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['nama' => 'Pupuk', 'deskripsi' => 'Pupuk tanaman']);
        Category::create(['nama' => 'Bibit', 'deskripsi' => 'Bibit unggul']);
        Category::create(['nama' => 'Alat Pertanian', 'deskripsi' => 'Alat untuk bertani']);
    }
}

