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
        Schema::create('materi_progress', function (Blueprint $table) {
            $table->unsignedBigInteger('materi_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('is_completed', ['done', 'progress']);
            $table->foreign('materi_id')->references('id')->on('materi')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->primary(['materi_id', 'user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_progress');
    }
};
