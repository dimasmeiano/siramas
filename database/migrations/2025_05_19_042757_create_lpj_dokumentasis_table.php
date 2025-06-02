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
        Schema::create('lpj_dokumentasis', function (Blueprint $table) {
             $table->id();
            $table->foreignId('lpj_id')->constrained('lpjs')->onDelete('cascade');
            $table->string('file_path'); // Path file dokumentasi (gambar, PDF, dsb)
            $table->string('keterangan')->nullable(); // opsional, bisa isi seperti “Banner Kegiatan”, “Foto Peserta”
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpj_dokumentasis');
    }
};
