<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bahans', function (Blueprint $table) {
            $table->string('satuan')->after('jumlah_stok');
        
        });
    }
    public function down(): void
    {
        Schema::table('bahans', function (Blueprint $table) {
            $table->dropColumn('satuan');
        });
    }
};
