<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;

    // Tentukan kolom mana saja yang boleh diisi secara massal
    protected $fillable = [
        'user_id',
        'name',
        'ip_address',
        'user_agent',
        'login_at',
    ];

    // Beritahu Laravel bahwa 'login_at' adalah sebuah tanggal (Carbon instance)
    // agar Anda bisa melakukan format tanggal di view nanti (misal: ->format('H:i'))
    protected $casts = [
        'login_at' => 'datetime',
    ];

    /**
     * Relasi ke model User
     * Menghubungkan setiap histori login dengan user yang memilikinya.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}