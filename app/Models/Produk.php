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

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
}
