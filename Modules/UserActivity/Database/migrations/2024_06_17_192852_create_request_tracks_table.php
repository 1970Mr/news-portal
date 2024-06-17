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
        Schema::create('request_tracks', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('referer')->nullable();
            $table->foreignId('user_track_id')->constrained('user_tracks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_tracks');
    }
};
