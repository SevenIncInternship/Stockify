<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'stok_fisik',
        'stok_sistem',
        'keterangan',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
