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
        Schema::create('artikel_beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('isi');
            $table->string('thumbnail')->nullable();
            $table->string('penulis')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_beritas')->onDelete('set null');
            $table->boolean('is_unggulan')->default(false);
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_beritas');
    }
};
