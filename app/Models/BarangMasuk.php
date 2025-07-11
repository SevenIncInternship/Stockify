<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'jumlah',
        'satuan',
        'tanggal',
        'status_konfirmasi',
    ];

    protected $casts = [
        'tanggal' => 'date', // Sudah benar untuk format() langsung
    ];

    public function produk()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }


    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
