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
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // nullable user_id
            $table->foreignId('address_id')->nullable()->constrained()->onDelete('cascade'); // nullable address_id
            $table->string('payment_status')->nullable(); // PaymentStatusENUM
            $table->string('tracking_number')->nullable();
            $table->string('order_status')->nullable(); // OrderStatusENUM
            $table->string('payment_type')->nullable(); // PaymentTypeENUM
            $table->foreignId('cargo_company_id')->nullable()->constrained()->onDelete('cascade'); // nullable cargo_company_id
            $table->foreignId('discount_id')->nullable()->constrained()->onDelete('set null'); // nullable discount_id
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
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
