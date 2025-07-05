<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BarangMasuk
 *
 * @property int $id
 * @property string $nama_barang
 * @property int $jumlah
 * @property string $satuan
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class BarangMasuk extends Model
{
    protected $fillable = [
        'produk_id',
        'jumlah', 
        'tanggal',
        'supplier_id',
        'status_konfirmasi'
    ];
    
    // Relationship dengan tabel products
    public function produk()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }
    
    // Relationship dengan tabel suppliers
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}