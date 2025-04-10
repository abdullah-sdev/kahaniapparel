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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable(); // nullable user_id
            $table->foreignId('address_id')->nullable()->constrained()->onDelete('cascade'); // nullable address_id
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('tracking_number')->nullable();
            $table->enum('order_status', ['processing', 'shipped', 'delivered', 'cancelled'])->default('processing');
            $table->enum('payment_type', ['cash', 'credit_card'])->default('cash');
            $table->foreignId('cargo_company_id')->nullable()->constrained()->onDelete('cascade'); // nullable cargo_company_id
            $table->foreignId('discount_id')->nullable()->constrained()->onDelete('set null'); // nullable discount_id
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('delivery_cost', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
