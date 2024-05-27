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
        Schema::create('site_details', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->text('keywords')->nullable();
            $table->text('footer_text')->nullable();
            $table->foreignId('main_logo_id')->constrained('images');
            $table->foreignId('second_logo_id')->constrained('images');
            $table->foreignId('favicon_id')->nullable()->constrained('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header');
    }
};
