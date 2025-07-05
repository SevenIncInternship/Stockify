<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $nama
 * @property string|null $kategori // Ini mungkin perlu diubah menjadi $kategori_id jika menggunakan FK
 * @property int $stok
 * @property string $satuan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Category|null $category Relasi ke model Category
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'kategori', // Jika ini adalah kategori_id, pastikan nama kolom di DB sesuai
        'stok',
        'satuan',
    ];


     protected $casts = [
        'stok' => 'integer',
    ];

    /**
     * Get the category that owns the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() // Nama metode relasi sebaiknya singular: category()
    {
        // Asumsi: kolom foreign key di tabel 'products' adalah 'kategori_id'
        // dan merujuk ke 'id' di tabel 'categories'.
        // Jika kolom di tabel 'products' Anda benar-benar bernama 'kategori'
        // dan menyimpan ID kategori, maka gunakan 'kategori' sebagai FK.
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}
