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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable()->index();
            $table->decimal('actual_price', 10, 2);
            $table->decimal('discounted_price', 10, 2);
            $table->text('description')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('thumbnail_image1')->nullable();
            $table->integer('clicks')->default(0);
            $table->boolean('is_in_stock')->default(true);
            $table->boolean('is_enable')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
