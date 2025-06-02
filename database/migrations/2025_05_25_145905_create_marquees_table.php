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
        Schema::create('marquees', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->enum('direction', ['left', 'right'])->default('left');
            $table->integer('speed')->default(60); // angka lebih kecil = lebih cepat
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marquees');
    }
};
