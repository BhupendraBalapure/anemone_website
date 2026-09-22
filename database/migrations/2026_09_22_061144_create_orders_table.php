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
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('order_number')->unique();
            $table->string('type')->default('order'); // order, booking, quote_inquiry
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->text('customer_address')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->string('payment_status')->default('unpaid'); // unpaid, paid, cod
            $table->string('payment_method')->nullable(); // upi, cod, card, whatsapp
            $table->string('status')->default('new'); // new, confirmed, completed, cancelled
            $table->json('items_payload'); // Snapshot of cart/service items
            $table->json('metadata')->nullable(); // appointment slot time, custom notes, MOQ details
            $table->timestamps();
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
