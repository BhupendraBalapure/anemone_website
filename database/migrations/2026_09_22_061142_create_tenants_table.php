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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('slug')->unique(); // used for store URL: /store/{slug}
            $table->string('custom_domain')->unique()->nullable();
            $table->foreignId('archetype_id')->constrained('archetypes')->cascadeOnDelete();
            $table->string('active_theme')->default('modern_clean'); // modern_clean, elegant_dark, minimal_card
            $table->string('phone')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('tagline')->nullable();
            $table->text('about_text')->nullable();
            $table->string('brand_color')->default('#10B981'); // Brand primary accent color
            $table->json('settings')->nullable(); // opening hours, UPI ID, socials, SEO settings
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
