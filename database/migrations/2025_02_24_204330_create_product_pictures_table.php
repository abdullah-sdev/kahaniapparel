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
        Schema::create('product_pictures', function (Blueprint $table) {
            $table->id();
            // Reference: https://medium.com/@asia.joumaa/polymorphic-relationship-in-laravel-2384bc63e9ef
            $table->string('url');
            $table->string('image_type');
            $table->morphs('parentable');
            $table->integer('sort_order');
            // $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_pictures');
    }
};
