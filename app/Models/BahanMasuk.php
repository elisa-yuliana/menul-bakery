<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanMasuk extends Model
{
protected $fillable = [
    'bahan_id',
    'jumlah_masuk',
    'tanggal_masuk',
];

public function bahan()
{
    return $this->belongsTo(Bahan::class);
}}
