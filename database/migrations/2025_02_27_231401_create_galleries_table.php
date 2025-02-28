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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            // Reference: https://medium.com/@asia.joumaa/polymorphic-relationship-in-laravel-2384bc63e9ef
            $table->morphs('imageable');  // Creates `imageable_id` and `imageable_type`
            $table->string('image_path');  // Path of the gallery image
            $table->integer('sort_order')->default(0); // Order of the gallery image
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
