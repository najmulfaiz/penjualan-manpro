<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'faktur',
        'tanggal_faktur',
        'supplier',
        'jatuh_tempo',
        'ppn',
        'diskon_persen',
        'diskon_rupiah',
        'total',
    ];

    public function pembelian_details()
    {
        return $this->hasMany(PembelianDetail::class);
    }
}
