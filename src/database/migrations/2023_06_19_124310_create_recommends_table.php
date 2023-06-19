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
        Schema::create('recommends', function (Blueprint $table) {
            $table->id();
            $table->string('wine_name', 50);
            $table->string('english_wine_name', 50);
            $table->string('winery', 20);
            $table->string('wine_type', 10);
            $table->string('wine_image', 500);
            $table->string('wine_country', 20);
            $table->string('wine_url', 500);
            $table->integer('years');
            $table->string('producer', 30);
            $table->string('breed', 50);
            $table->integer('capacity');
            $table->string('one_word', 100);
            $table->string('comment', 500);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommends');
    }
};
