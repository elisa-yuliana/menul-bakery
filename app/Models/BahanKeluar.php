<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanKeluar extends Model
{
    protected $fillable = [
    'bahan_id',
    'jumlah_keluar',
    'tanggal_keluar',
];
public function bahan()
{
    return $this->belongsTo(Bahan::class);
}
}
