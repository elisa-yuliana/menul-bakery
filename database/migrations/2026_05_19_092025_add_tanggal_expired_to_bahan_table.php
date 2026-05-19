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
    Schema::table('bahans', function (Blueprint $table) {
        // Menambahkan kolom tanggal yang boleh kosong (opsional)
        $table->date('tanggal_expired')->nullable()->after('nama_bahan'); 
    });
}

public function down(): void
{
    Schema::table('bahans', function (Blueprint $table) {
        // Menghapus kolom jika migration di-rollback
        $table->dropColumn('tanggal_expired');
    });
}

};
