<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bahan_masuks', function (Blueprint $table) {
            // Menambahkan kolom tanggal_expired setelah kolom tanggal_masuk
            $table->date('tanggal_expired')->nullable()->after('tanggal_masuk');
        });
    }

    public function down(): void
    {
        Schema::table('bahan_masuks', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn('tanggal_expired');
        });
    }
};