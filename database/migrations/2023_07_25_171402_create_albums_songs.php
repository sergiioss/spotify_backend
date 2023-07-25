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
        Schema::create('albums_songs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('albums_id');
            $table->foreign('albums_id')->references('id')->on('albums')->onDelete('cascade');

            $table->unsignedBigInteger('songs_id');
            $table->foreign('songs_id')->references('id')->on('songs')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums_songs');
    }
};
