<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Category;

    class CategorySeeder extends Seeder
    {
        public function run(): void
        {
            Category::create(['nama' => 'Pupuk']);
            Category::create(['nama' => 'Bibit']);
            Category::create(['nama' => 'Alat Pertanian']);
        }
    }

