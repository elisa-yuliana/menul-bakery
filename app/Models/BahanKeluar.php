<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanKeluar extends Model
{
    protected $fillable = [
    'bahan_id',
    'stok_awal',
    'jumlah_keluar',
    'stok_sekarang',
    'tanggal_keluar',
];
public function bahan()
{
    return $this->belongsTo(Bahan::class);
}
}
