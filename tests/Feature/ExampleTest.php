<?php

namespace Tests\Feature;

use App\Livewire\Auth\Login;
use App\Livewire\MerchantDashboard;
use App\Livewire\OnboardingWizard;
use App\Livewire\StoreHome;
use App\Models\Archetype;
use App\Models\Tenant;
use App\Models\User;
use App\Services\TemplateCatalog;
use Database\Seeders\ArchetypeSeeder;
use Database\Seeders\DemoStoreSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
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

    public function test_the_login_page_renders_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Sign in to your account');
        $response->assertSee('Super Admin');
        $response->assertSee('admin@anemony.in');
    }

    public function test_guest_is_redirected_to_login_from_admin_dashboard(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class]);

        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_the_super_admin_can_access_dashboard(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class, UserSeeder::class]);

        $admin = User::where('role', 'super_admin')->first();

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Super Admin');
        $response->assertSee('Platform Overview');
        $response->assertSee('Merchants');
    }

    public function test_the_merchant_dashboard_renders_successfully(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class]);

        $response = $this->get('/store/sharma-kirana/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Theme Studio');
    }

    public function test_customer_can_submit_inquiry_without_sql_error(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class]);

        $tenant = Tenant::where('slug', 'sharma-kirana')->first();

        Livewire::test(StoreHome::class, ['slug' => $tenant->slug])
            ->set('inquiryName', 'Rahul Kumar')
            ->set('inquiryPhone', '9876543210')
            ->set('inquiryMessage', 'Do you have home delivery available?')
            ->call('submitInquiry')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('orders', [
            'tenant_id' => $tenant->id,
            'type' => 'inquiry',
            'customer_name' => 'Rahul Kumar',
        ]);
    }

    public function test_the_1step_onboarding_wizard_creates_store_and_redirects_to_dashboard(): void
    {
        $this->seed([ArchetypeSeeder::class]);

        Livewire::test(OnboardingWizard::class)
            ->set('businessName', 'Gourmet Cloud Kitchen')
            ->set('businessCategory', 'Restaurant & Cafes')
            ->set('city', 'Pune')
            ->set('phone', '9811223344')
            ->call('createStore')
            ->assertHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas('tenants', [
            'business_name' => 'Gourmet Cloud Kitchen',
            'city' => 'Pune',
        ]);
    }

    public function test_merchant_can_switch_category_archetype_in_dashboard(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class]);

        Livewire::test(MerchantDashboard::class, ['slug' => 'sharma-kirana'])
            ->call('selectArchetype', 'service')
            ->assertHasNoErrors();

        $tenant = Tenant::where('slug', 'sharma-kirana')->first();
        $this->assertEquals('service', $tenant->archetype->code);
    }

    public function test_merchant_can_login_using_phone_number(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class, UserSeeder::class]);

        Livewire::test(Login::class)
            ->set('email', '98765 43210')
            ->set('password', 'password')
            ->call('login')
            ->assertHasNoErrors()
            ->assertRedirect('/store/sharma-kirana/dashboard');

        $this->assertAuthenticated();
    }

    public function test_hospitality_storefront_renders_all_luxury_themes(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class]);
        $hospitalityArchetype = Archetype::where('code', 'hospitality')->first();

        $hotel = Tenant::create([
            'business_name' => 'Royal Heritage Resort & Spa',
            'slug' => 'royal-heritage-resort',
            'archetype_id' => $hospitalityArchetype->id,
            'phone' => '9888877777',
            'city' => 'Udaipur',
            'active_theme' => 'minimal_card',
        ]);

        $hotel->catalogItems()->create([
            'title' => 'Caldera Cliffside Suite',
            'category_name' => 'Suites',
            'price' => 15000,
            'type' => 'room',
        ]);

        // Test Santorini Minimalist
        $response = $this->get('/store/royal-heritage-resort?theme=minimal_card');
        $response->assertStatus(200);
        $response->assertSee('Santorini &amp; Cycladic Cliffside', false);
        $response->assertSee('Caldera Cliffside Suite');

        // Test Safari Glamping
        $response = $this->get('/store/royal-heritage-resort?theme=nature_retreat');
        $response->assertStatus(200);
        $response->assertSee('Aman-Inspired Eco-Forest Glamping');

        // Test Maldives Overwater
        $response = $this->get('/store/royal-heritage-resort?theme=coastal_beach');
        $response->assertStatus(200);
        $response->assertSee('Maldives Overwater Bungalows');

        // Test Royal Haveli
        $response = $this->get('/store/royal-heritage-resort?theme=heritage_haveli');
        $response->assertStatus(200);
        $response->assertSee('300-Year Heritage Rajputana Haveli');

        // Test Alpine Snow Chalet
        $response = $this->get('/store/royal-heritage-resort?theme=mountain_chalet');
        $response->assertStatus(200);
        $response->assertSee('Alpine Cedarwood Retreat');

        // Test Ayurveda Sanctuary
        $response = $this->get('/store/royal-heritage-resort?theme=wellness_sanctuary');
        $response->assertStatus(200);
        $response->assertSee('Authentic Himalayan Ayurveda, Panchakarma &amp; Yoga Sanctuary', false);
    }

    public function test_hotel_and_motel_business_category_shows_filtered_templates_and_renders_storefront(): void
    {
        $this->seed([ArchetypeSeeder::class, DemoStoreSeeder::class]);
        $hospitalityArchetype = Archetype::where('code', 'hospitality')->first();

        $hotel = Tenant::create([
            'business_name' => 'Nagpur City Executive Hotel',
            'slug' => 'nagpur-city-hotel',
            'archetype_id' => $hospitalityArchetype->id,
            'phone' => '9888877777',
            'city' => 'Nagpur',
            'active_theme' => 'hotel_business',
            'settings' => [
                'business_category' => 'Hotels & Motels',
            ],
        ]);

        $hotel->catalogItems()->create([
            'title' => 'Executive Club Room',
            'category_name' => 'Rooms',
            'price' => 3500,
            'type' => 'room',
        ]);

        // Dashboard shows Hotel & Motel category filter and specific hotel templates
        Livewire::test(MerchantDashboard::class, ['slug' => 'nagpur-city-hotel'])
            ->assertSee('Business Category Filter:')
            ->assertSee('Hotels &amp; Motels', false)
            ->assertSee('City Business &amp; Executive Hotel', false)
            ->assertSee('Highway Express Motel &amp; 24/7 Lodge', false)
            ->assertSee('Urban Boutique Hotel &amp; Rooftop', false)
            ->assertSee('Grand 5-Star Luxury Star Hotel', false)
            ->assertSee('Smart Budget Express Hotel &amp; Lodge', false)
            ->assertSee('Family Hotel &amp; Garden Banquet Lawn', false)
            ->assertDontSee('Santorini &amp; Mediterranean', false)
            ->assertDontSee('Maldives Overwater', false);

        // Storefront tests for hotel themes
        $resBusiness = $this->get('/store/nagpur-city-hotel?theme=hotel_business');
        $resBusiness->assertStatus(200);
        $resBusiness->assertSee('Executive Stays, Fast Wi-Fi &amp; Boardrooms', false);
        $resBusiness->assertSee('Executive Club Room');

        $resMotel = $this->get('/store/nagpur-city-hotel?theme=motel_highway');
        $resMotel->assertStatus(200);
        $resMotel->assertSee('Drive-In Parking, Clean AC Rooms &amp; 24-Hour Roadside Check-In', false);

        $resBoutique = $this->get('/store/nagpur-city-hotel?theme=hotel_boutique');
        $resBoutique->assertStatus(200);
        $resBoutique->assertSee('Designer AC Suites, Ambient Moods &amp; Rooftop Dining', false);

        $resBudget = $this->get('/store/nagpur-city-hotel?theme=hotel_budget');
        $resBudget->assertStatus(200);
        $resBudget->assertSee('Clean Sanitized AC Rooms, Free Breakfast &amp; Best Rate Guarantee', false);

        $resFamily = $this->get('/store/nagpur-city-hotel?theme=hotel_family');
        $resFamily->assertStatus(200);
        $resFamily->assertSee('Spacious Family Suites, Green Party Lawns &amp; Celebrations', false);
    }

    public function test_onboarding_wizard_supports_ecommerce_and_landing_page_modes(): void
    {
        $this->seed([ArchetypeSeeder::class]);

        // E-commerce creation
        Livewire::test(OnboardingWizard::class)
            ->call('selectWebsiteType', 'ecommerce')
            ->set('businessName', 'Apex Fashion Mart')
            ->set('businessCategory', 'Other Retail')
            ->set('city', 'Mumbai')
            ->set('phone', '9811002233')
            ->call('createStore')
            ->assertHasNoErrors()
            ->assertRedirect();

        $ecommerceTenant = Tenant::where('business_name', 'Apex Fashion Mart')->first();
        $this->assertNotNull($ecommerceTenant);
        $this->assertEquals('retail_supermarket', $ecommerceTenant->active_theme);
        $this->assertEquals('retail', $ecommerceTenant->archetype->code);
        $this->assertEquals('ecommerce', $ecommerceTenant->settings['website_type']);

        // Landing Page creation
        Livewire::test(OnboardingWizard::class)
            ->call('selectWebsiteType', 'landing_page')
            ->set('businessName', 'Skyline Real Estate Launch')
            ->set('businessCategory', 'Real Estate & Properties')
            ->set('city', 'Bengaluru')
            ->set('phone', '9811445566')
            ->call('createStore')
            ->assertHasNoErrors()
            ->assertRedirect();

        $landingTenant = Tenant::where('business_name', 'Skyline Real Estate Launch')->first();
        $this->assertNotNull($landingTenant);
        $this->assertEquals('real_estate', $landingTenant->active_theme);
        $this->assertEquals('landing_page', $landingTenant->settings['website_type']);
    }

    public function test_template_catalog_covers_all_categories_and_modes(): void
    {
        $this->seed([ArchetypeSeeder::class]);

        $categories = TemplateCatalog::categories();
        $this->assertCount(11, $categories);

        $modes = ['business_website', 'ecommerce', 'landing_page'];
        foreach ($categories as $category) {
            foreach ($modes as $mode) {
                $template = TemplateCatalog::getRecommended($category, $mode);
                $this->assertNotEmpty($template['id']);
                $this->assertNotEmpty($template['title']);
                $this->assertNotEmpty($template['description']);
                $this->assertNotEmpty($template['features']);
                $this->assertNotEmpty($template['suggested_color']);
            }
        }

        // Test dashboard template filtering and category switching
        $serviceArchetype = Archetype::where('code', 'service')->first();
        $tenant = Tenant::create([
            'business_name' => 'Glow Salon & Wellness',
            'slug' => 'glow-salon-wellness',
            'archetype_id' => $serviceArchetype->id,
            'phone' => '9988776655',
            'city' => 'Pune',
            'active_theme' => 'salon_spa',
            'settings' => [
                'business_category' => 'Beauty & Salons',
                'website_type' => 'business_website',
            ],
        ]);

        Livewire::test(MerchantDashboard::class, ['slug' => 'glow-salon-wellness'])
            ->assertSee('Beauty &amp; Salons', false)
            ->call('setTemplateFilterMode', 'ecommerce')
            ->assertSee('Beauty &amp; Cosmetics Online Store', false)
            ->assertDontSee('Online Pharmacy', false)
            ->call('setTemplateFilterMode', 'landing_page')
            ->assertSee('Bridal HD Makeover &amp; Spa Lead Funnel', false)
            ->assertDontSee('Emergency Care &amp; Fast OPD Slot', false)
            ->assertDontSee('Free Demo Class &amp; Scholarship', false)
            ->set('selectedCategoryFilter', 'Restaurant & Cafes')
            ->call('setTemplateFilterMode', 'category')
            ->assertSee('Restaurant &amp; Cafes', false)
            ->assertDontSee('Bridal HD Makeover', false);
    }

    public function test_website_ecommerce_and_landing_page_modes_have_distinct_layouts_and_cart_visibility(): void
    {
        $this->seed([ArchetypeSeeder::class]);
        $serviceArchetype = Archetype::where('code', 'service')->first();

        $salonTenant = Tenant::create([
            'business_name' => 'Rose Glamour Salon',
            'slug' => 'rose-glamour-salon',
            'archetype_id' => $serviceArchetype->id,
            'phone' => '9888877777',
            'city' => 'Nagpur',
            'active_theme' => 'salon_wellness',
            'settings' => [
                'business_category' => 'Beauty & Salons',
                'website_type' => 'business_website',
            ],
        ]);

        $salonTenant->catalogItems()->createMany([
            [
                'title' => 'Keratin Hair Spa Treatment',
                'category_name' => 'Services',
                'price' => 1500,
                'type' => 'service',
                'duration_minutes' => 60,
                'in_stock' => true,
            ],
            [
                'title' => 'Argan Smooth Hair Serum',
                'category_name' => 'Products',
                'price' => 599,
                'type' => 'product',
                'in_stock' => true,
            ],
        ]);

        // 1. Business Website Mode: Should show Book Appointment Slot, NO Add to Cart
        $responseWebsite = $this->get('/store/rose-glamour-salon?type=business_website');
        $responseWebsite->assertStatus(200);
        $responseWebsite->assertSee('Book Appointment Slot');
        $responseWebsite->assertDontSee('Add to Cart');
        $responseWebsite->assertDontSee('fa-cart-shopping');

        // 2. E-Commerce Mode: Should show Add to Cart and Cart Icon, NO Book Appointment Slot
        $responseEcom = $this->get('/store/rose-glamour-salon?theme=salon_ecom_organic_skincare&type=ecommerce');
        $responseEcom->assertStatus(200);
        $responseEcom->assertSee('Add to Cart');
        $responseEcom->assertSee('fa-cart-shopping');
        $responseEcom->assertDontSee('Book Appointment Slot');

        // 3. Landing Page Mode: Should show Claim Offer / Voucher Hook, NO Add to Cart, NO Cart Icon
        $responseLanding = $this->get('/store/rose-glamour-salon?theme=salon_landing_hair_botox&type=landing_page');
        $responseLanding->assertStatus(200);
        $responseLanding->assertSee('Claim Limited Offer');
        $responseLanding->assertSee('Claim Your Offer Voucher');
        $responseLanding->assertDontSee('Add to Cart');
        $responseLanding->assertDontSee('fa-cart-shopping');
    }

    public function test_beauty_salon_has_six_templates_each_for_website_ecommerce_and_landing_page(): void
    {
        $websites = TemplateCatalog::getForCategory('Beauty & Salons', 'business_website');
        $ecommerces = TemplateCatalog::getForCategory('Beauty & Salons', 'ecommerce');
        $landings = TemplateCatalog::getForCategory('Beauty & Salons', 'landing_page');
        $all = TemplateCatalog::getForCategory('Beauty & Salons', 'all');

        $this->assertCount(6, $websites);
        $this->assertCount(6, $ecommerces);
        $this->assertCount(6, $landings);
        $this->assertCount(18, $all);

        // Verify that every single template has its own unique image (zero duplicates)
        $images = array_column($all, 'image_url');
        $this->assertCount(18, array_unique($images));

        $this->seed([ArchetypeSeeder::class]);
        $serviceArchetype = Archetype::where('code', 'service')->first();

        $salonTenant = Tenant::create([
            'business_name' => 'Rose Glamour Salon',
            'slug' => 'rose-glamour-salon-2',
            'archetype_id' => $serviceArchetype->id,
            'phone' => '9888877777',
            'city' => 'Nagpur',
            'active_theme' => 'salon_luxury_hair_studio',
            'settings' => [
                'business_category' => 'Beauty & Salons',
                'website_type' => 'business_website',
            ],
        ]);

        Livewire::test(MerchantDashboard::class, ['slug' => $salonTenant->slug])
            ->call('openTemplatePreview', 'salon_luxury_hair_studio')
            ->assertSee('Celebrity Hair Studio &amp; Balayage Color Bar', false)
            ->call('openTemplatePreview', 'salon_ecom_perfume_bath_body')
            ->assertSee('Artisanal Luxury Perfumes &amp; Bath Boutique', false);

        // Verify that the website layout renders salon content and NOT clinic or hotel content
        $response = $this->get('/store/rose-glamour-salon-2?type=business_website&theme=salon_luxury_hair_studio');
        $response->assertStatus(200);
        $response->assertSee('French Balayage');
        $response->assertSee('Master Stylists &amp; Artists', false);
        $response->assertDontSee('Certified Healthcare &amp; Consultation Clinic', false);
        $response->assertDontSee('Self Check-In Smart Lock');
    }
}
