<?php

namespace Tests\Feature;

use Database\Seeders\ArchetypeSeeder;
use Database\Seeders\DemoStoreSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_welcome_landing_page_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Anemony');
        $response->assertSee('Digital Superpower');
        $response->assertSee('Sharma Kirana');
        $response->assertSee('Care Dental');
        $response->assertSee('Apex Steel');
    }

    public function test_the_onboarding_page_renders_successfully(): void
    {
        $this->seed(ArchetypeSeeder::class);

        $response = $this->get('/onboarding');
        $response->assertStatus(200);
        $response->assertSee('Launch Your Digital Presence');
    }

    public function test_the_retail_storefront_renders_with_retail_cta(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class]);

        $response = $this->get('/store/sharma-kirana');
        $response->assertStatus(200);
        $response->assertSee('Sharma Kirana');
        $response->assertSee('Add to Cart');
        $response->assertSee('WhatsApp');
    }

    public function test_the_clinic_storefront_renders_with_appointment_cta(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class]);

        $response = $this->get('/store/care-dental-clinic');
        $response->assertStatus(200);
        $response->assertSee('Care Dental Clinic');
        $response->assertSee('Book Appointment Slot');
    }

    public function test_the_b2b_storefront_renders_with_quote_cta(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class]);

        $response = $this->get('/store/apex-steel-craft');
        $response->assertStatus(200);
        $response->assertSee('Apex Steel & Industrial Fabrications');
        $response->assertSee('Request a Quote');
    }
}
