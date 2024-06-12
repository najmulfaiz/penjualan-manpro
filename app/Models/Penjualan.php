<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'diskon_persen',
        'diskon_rupiah',
        'total',
    ];

    public function penjualan_details()
    {
        return $this->hasMany(PenjualanDetail::class);
    }
}
