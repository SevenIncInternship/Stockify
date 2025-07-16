<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Kolom yang bisa diisi mass-assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'kategori_id',
        'supplier_id',
        'stock',
        'satuan',
    ];

    /**
     * Relasi: Produk memiliki satu kategori.
     */
    public function category()
{
    return $this->belongsTo(Category::class, 'kategori_id');
}

public function supplier()
{
    return $this->belongsTo(Supplier::class, 'supplier_id');
}
}
