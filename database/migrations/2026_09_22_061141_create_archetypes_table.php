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
        Schema::create('archetypes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique(); // retail, service, food, b2b
            $table->string('icon')->default('store');
            $table->text('description')->nullable();
            $table->json('enabled_features'); // ['cart', 'whatsapp_checkout', 'variants', 'stock']
            $table->string('default_cta')->default('whatsapp_cart'); // whatsapp_cart, book_slot, request_quote, buy_now
            $table->string('cta_label')->default('Order on WhatsApp');
            $table->string('schema_type')->default('LocalBusiness'); // Store, MedicalBusiness, Restaurant, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archetypes');
    }
};
