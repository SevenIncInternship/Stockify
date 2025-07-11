<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'jumlah',
        'satuan',
        'status',
        'status_konfirmasi',
    ];

    public function produk()
    {
        return $this->belongsTo(Product::class, 'product_id'); // ubah jadi 'product_id'
    }


}