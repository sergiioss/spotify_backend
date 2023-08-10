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
        Schema::create('playlist_songs', function (Blueprint $table) {
            $table->id();
            $table->string('photo');

            $table->unsignedBigInteger('playlist_songs');
            $table->foreign('playlist_songs')->references('id')->on('playlist')->onDelete('cascade');

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
        Schema::dropIfExists('playlist_songs');
    }
};
