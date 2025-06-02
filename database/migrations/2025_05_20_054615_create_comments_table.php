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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->text('content');
            $table->timestamps();

            $table->foreign('article_id')
                ->references('id')
                ->on('artikel_beritas')
                ->onDelete('cascade');

            $table->foreign('parent_id')
                    ->references('id')
                    ->on('comments')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
