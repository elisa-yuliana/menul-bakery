<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_bahan',
        'jenis_bahan',
        'kategori',
        'jumlah_stok',
        'satuan',
        'harga',
        'stok_minimum',
        'metode_pembayaran',
        'tanggal_jatuh_tempo',
    ];

    protected $casts = [
        'tanggal_jatuh_tempo' => 'date',
    ];

    public function keluars()
    {
        return $this->hasMany(BahanKeluar::class);
    }
    public function scopeJatuhTempoKritis($query)
{
    // Mengambil data yang tidak null, tanggalnya <= besok, dan statusnya bukan lunas
    return $query->whereNotNull('tanggal_jatuh_tempo')
                 ->where('tanggal_jatuh_tempo', '<=', now()->addDay()->toDateString())
                 ->where('metode_pembayaran', '!=', 'cash'); // Sesuaikan dengan logika 'lunas' Anda
}

}
