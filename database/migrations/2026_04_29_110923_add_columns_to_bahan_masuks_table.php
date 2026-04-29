<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bahan_masuks', function (Blueprint $table) {
            $table->integer('stok_awal')->after('bahan_id');
            $table->integer('stok_sekarang')->after('jumlah_masuk');
        });
    }

    public function down(): void
    {
        Schema::table('bahan_masuks', function (Blueprint $table) {
            $table->dropColumn(['stok_awal', 'stok_sekarang']);
        });
    }
};
