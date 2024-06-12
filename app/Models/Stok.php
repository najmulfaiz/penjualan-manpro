<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'transaksi',
        'produk_id',
        'masuk',
        'keluar',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
