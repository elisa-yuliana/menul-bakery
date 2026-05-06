<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bahan_keluars', function (Blueprint $table) {
            $table->Integer('stok_awal')->after('bahan_id');
            $table->integer('stok_sekarang')->after('jumlah_keluar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bahan_keluars', function (Blueprint $table) {
            $table->dropColumn(['stok_awal','stok_sekarang']);
        });
    }
};
