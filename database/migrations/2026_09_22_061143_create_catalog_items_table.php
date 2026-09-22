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
        Schema::create('catalog_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category_name')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('compare_at_price', 10, 2)->nullable();
            $table->string('type')->default('product'); // product, service, food_item, quote_item
            $table->integer('duration_minutes')->nullable(); // For services: 30 mins, 60 mins
            $table->integer('min_order_qty')->nullable()->default(1); // For B2B MOQ
            $table->boolean('in_stock')->default(true);
            $table->integer('stock_quantity')->nullable();
            $table->string('image_url')->nullable();
            $table->json('attributes')->nullable(); // variants (size/color), veg/non-veg, specs
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_items');
    }
};
