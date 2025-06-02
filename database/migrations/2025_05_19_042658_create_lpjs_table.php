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
        Schema::create('lpjs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_kerja_id')->constrained('program_kerjas')->onDelete('cascade');
            $table->string('nama_kegiatan');
            $table->date('tanggal_pelaksanaan');
            $table->foreignId('ketua_pelaksana_id')->constrained('members')->onDelete('cascade');
            $table->decimal('anggaran_dana', 15, 2)->default(0);
            $table->decimal('dana_terealisasi', 15, 2)->default(0);
            $table->text('ringkasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpjs');
    }
};
