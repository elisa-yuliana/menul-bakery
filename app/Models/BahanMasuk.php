<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanMasuk extends Model
{
protected $fillable = [
    'bahan_id',
    'stok_awal',
    'jumlah_masuk',
    'stok_sekarang',
    'tanggal_masuk',
];

public function bahan()
{
    return $this->belongsTo(Bahan::class);
}}
