<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanMasuk extends Model
{
    // Kolom yang diizinkan untuk mass-assignment
    protected $fillable = [
        'bahan_id',
        'stok_awal',
        'jumlah_masuk',
        'stok_sekarang',
        'tanggal_masuk',
        'tanggal_expired'
    ];

    /**
     * Booted method untuk menangani model events.
     */
    protected static function booted()
    {
        // Logika ini berjalan otomatis SETELAH data BahanMasuk berhasil disimpan ke database
        static::saved(function ($bahanMasuk) {
            // Ambil data bahan yang terkait menggunakan relasi
            $bahan = $bahanMasuk->bahan; 

            if ($bahan) {
                // Update tanggal_expired di tabel bahans
                $bahan->update([
                    'tanggal_expired' => $bahanMasuk->tanggal_expired
                ]);
            }
        });
    }

    /**
     * Relasi Kebalikan (Inverse Relationship) ke Model Bahan
     */
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'bahan_id');
    }
}
