<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $nama
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products Relasi ke model Product
 * @property-read int|null $products_count
 */
class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nama'];

    /**
     * Get the products for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        // Asumsi: kolom foreign key di tabel 'products' yang merujuk ke 'categories' adalah 'kategori_id'.
        // Jika Anda menggunakan konvensi Laravel standar (category_id),
        // maka Anda bisa menghapus 'kategori_id' dari argumen.
        return $this->hasMany(Product::class, 'kategori_id');
    }
}
