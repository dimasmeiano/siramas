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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
             // Foreign key ke kegiatans
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');

            // Foreign key ke members
            $table->foreignId('anggota_id')->constrained('members')->onDelete('cascade');

            $table->timestamp('waktu_absen');
            $table->string('status')->default('hadir'); // misal hadir, izin, alfa
            $table->timestamps();
            $table->unique(['kegiatan_id', 'anggota_id']); // supaya satu anggota satu kali absen per kegiatan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
