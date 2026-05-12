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
    Schema::create('login_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link ke tabel users
        $table->string('name');         // Nama staff saat login
        $table->string('ip_address');   // IP Lokal (Offline)
        $table->string('user_agent');   // Perangkat (HP/Laptop)
        $table->timestamp('login_at');  // Waktu login
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_histories');
    }
};
