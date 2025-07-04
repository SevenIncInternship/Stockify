<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BarangMasuk
 *
 * @property int $id
 * @property int $produk_id
 * @property int $jumlah
 * @property string $satuan
 * @property string $status_konfirmasi
 * @property \Illuminate\Support\Carbon|null $tanggal
 * @property int|null $supplier_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
    'produk_id',
    'jumlah',
    'satuan',
    'status_konfirmasi',
    'tanggal',
    'supplier_id',
];
}
