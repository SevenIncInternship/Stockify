<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BarangKeluar
 *
 * @property int $id
 * @property string $nama_barang
 * @property int $jumlah
 * @property string $satuan
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class BarangKeluar extends Model
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
        'tanggal' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }


}
