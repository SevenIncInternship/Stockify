<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori_id', 
        'supplier_id', 
        'stock',
        'satuan',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'product_id');
    }

    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class, 'product_id');
    }
}
