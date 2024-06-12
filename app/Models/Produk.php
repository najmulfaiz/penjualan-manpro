<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'harga', 'stock', 'satuan_id', 'deskripsi', 'is_active'
    ];

    protected $appends = [
        'sisa_stok'
    ];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function stok()
    {
        return $this->hasMany(Stok::class);
    }

    public function getSisaStokAttribute()
    {
        return $this->stok->sum('masuk') - $this->stok->sum('keluar');
    }
}
