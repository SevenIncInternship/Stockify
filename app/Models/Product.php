<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'kategori_id', 
        'supplier_id', 
        'stock',
        'satuan',
    ];

    /**
     * Relasi ke kategori (Category)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    /**
     * Relasi ke supplier (Supplier)
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
