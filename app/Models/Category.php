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

    protected $fillable = [
        'nama'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
