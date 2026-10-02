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
        $this->assertEquals('retail_ecom_modern_fashion_apparel', $ecommerceTenant->active_theme);
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

    public function test_clinics_and_hospitals_templates_catalog_and_modes(): void
    {
        $websites = TemplateCatalog::getForCategory('Clinics & Hospitals', 'business_website');
        $ecommerces = TemplateCatalog::getForCategory('Clinics & Hospitals', 'ecommerce');
        $landings = TemplateCatalog::getForCategory('Clinics & Hospitals', 'landing_page');
        $all = TemplateCatalog::getForCategory('Clinics & Hospitals', 'all');

        $this->assertCount(6, $websites);
        $this->assertCount(6, $ecommerces);
        $this->assertCount(6, $landings);
        $this->assertCount(18, $all);

        // Verify that every single template has its own unique image
        $images = array_column($all, 'image_url');
        $this->assertCount(18, array_unique($images));

        $this->seed([ArchetypeSeeder::class]);
        $serviceArchetype = Archetype::where('code', 'service')->first();

        $clinicTenant = Tenant::create([
            'business_name' => 'Metro Life Care Hospital',
            'slug' => 'metro-life-care-hospital',
            'archetype_id' => $serviceArchetype->id,
            'phone' => '9988776655',
            'city' => 'Nagpur',
            'active_theme' => 'clinic_multispecialty_hospital',
            'settings' => [
                'business_category' => 'Clinics & Hospitals',
                'website_type' => 'business_website',
            ],
        ]);

        // Test MerchantDashboard template discovery for Clinics & Hospitals
        Livewire::test(MerchantDashboard::class, ['slug' => $clinicTenant->slug])
            ->call('openTemplatePreview', 'clinic_multispecialty_hospital')
            ->assertSee('Metro Multi-Specialty Hospital &amp; 24/7 Trauma Center', false)
            ->call('openTemplatePreview', 'clinic_ecom_pharmacy_rx')
            ->assertSee('Express Chemist &amp; Online Prescription Pharmacy', false)
            ->call('openTemplatePreview', 'clinic_landing_urgent_opd')
            ->assertSee('Same-Day Specialist Doctor OPD Consultation Funnel', false);

        // Test Website Storefront Rendering
        $responseWeb = $this->get('/store/metro-life-care-hospital?type=business_website&theme=clinic_multispecialty_hospital');
        $responseWeb->assertStatus(200);
        $responseWeb->assertSee('NABH Accredited Multi-Specialty Hospital');
        $responseWeb->assertSee('24/7 Emergency &amp; ICU', false);

        // Test E-Commerce Storefront Rendering
        $responseEcom = $this->get('/store/metro-life-care-hospital?type=ecommerce&theme=clinic_ecom_pharmacy_rx');
        $responseEcom->assertStatus(200);
        $responseEcom->assertSee('24/7 Express Online Prescription Pharmacy');

        // Test Landing Page Storefront Rendering
        $responseLanding = $this->get('/store/metro-life-care-hospital?type=landing_page&theme=clinic_landing_urgent_opd');
        $responseLanding->assertStatus(200);
        $responseLanding->assertSee('SAME-DAY SPECIALIST DOCTOR CONSULTATION');
    }

    public function test_coaching_and_institutes_templates_catalog_and_modes(): void
    {
        $websites = TemplateCatalog::getForCategory('Coaching & Institutes', 'business_website');
        $ecommerces = TemplateCatalog::getForCategory('Coaching & Institutes', 'ecommerce');
        $landings = TemplateCatalog::getForCategory('Coaching & Institutes', 'landing_page');
        $all = TemplateCatalog::getForCategory('Coaching & Institutes', 'all');

        $this->assertCount(6, $websites);
        $this->assertCount(6, $ecommerces);
        $this->assertCount(6, $landings);
        $this->assertCount(18, $all);

        // Verify that every single template has its own unique image
        $images = array_column($all, 'image_url');
        $this->assertCount(18, array_unique($images));

        $this->seed([ArchetypeSeeder::class]);
        $serviceArchetype = Archetype::where('code', 'service')->first();

        $coachingTenant = Tenant::create([
            'business_name' => 'Apex Entrance Academy',
            'slug' => 'apex-entrance-academy',
            'archetype_id' => $serviceArchetype->id,
            'phone' => '9876500001',
            'city' => 'Nagpur',
            'active_theme' => 'coaching_web_iit_jee_neet',
            'settings' => [
                'business_category' => 'Coaching & Institutes',
                'website_type' => 'business_website',
            ],
        ]);

        $coachingTenant->catalogItems()->create([
            'title' => 'Comprehensive 2-Year Target Batch',
            'price' => 75000,
            'category_name' => 'Target Batch',
        ]);

        // Test MerchantDashboard template discovery for Coaching & Institutes
        Livewire::test(MerchantDashboard::class, ['slug' => $coachingTenant->slug])
            ->call('openTemplatePreview', 'coaching_web_iit_jee_neet')
            ->assertSee('Apex IIT-JEE &amp; NEET Premier Academy', false)
            ->call('openTemplatePreview', 'coaching_ecom_test_series')
            ->assertSee('EduTest All-India Mock Test Series &amp; CBT Portal', false)
            ->call('openTemplatePreview', 'coaching_landing_scholarship_admission')
            ->assertSee('National Talent Scholarship Test', false);

        // Test Website Storefront Rendering (All 6 Distinct Layouts)
        $responseWeb1 = $this->get('/store/apex-entrance-academy?type=business_website&theme=coaching_web_iit_jee_neet');
        $responseWeb1->assertStatus(200);
        $responseWeb1->assertSee('Apex IIT-JEE &amp; NEET Premier Academy', false);
        $responseWeb1->assertSee('Kota Classroom System', false);
        $responseWeb1->assertSee('4 Pillars That Produce All-India Rankers', false);
        $responseWeb1->assertSee('Enroll in Kota Batch', false);

        $responseWeb2 = $this->get('/store/apex-entrance-academy?type=business_website&theme=coaching_web_upsc_ias');
        $responseWeb2->assertStatus(200);
        $responseWeb2->assertSee('Master Prelims, Mains &amp; Personality Test with', false);
        $responseWeb2->assertSee('EDITORIAL ANALYSIS', false);
        $responseWeb2->assertSee('DAILY MAINS QUESTION OF THE DAY', false);
        $responseWeb2->assertSee('Enroll in UPSC Batch', false);

        $responseWeb3 = $this->get('/store/apex-entrance-academy?type=business_website&theme=coaching_web_commerce_ca');
        $responseWeb3->assertStatus(200);
        $responseWeb3->assertSee('CA Foundation, Inter &amp; Final with', false);
        $responseWeb3->assertSee('ICAI SUCCESS BENCHMARK', false);
        $responseWeb3->assertSee('Our Students Doing Articleship At:', false);
        $responseWeb3->assertSee('Register for CA Batch', false);

        $responseWeb4 = $this->get('/store/apex-entrance-academy?type=business_website&theme=coaching_web_ielts_abroad');
        $responseWeb4->assertStatus(200);
        $responseWeb4->assertSee('Select Your Dream Destination:', false);
        $responseWeb4->assertSee('Guaranteed <span class="text-sky-600">Band 8+ IELTS</span>', false);
        $responseWeb4->assertSee('VISA SUCCESS STORIES', false);
        $responseWeb4->assertSee('Book Free Diagnostic Test', false);

        $responseWeb5 = $this->get('/store/apex-entrance-academy?type=business_website&theme=coaching_web_coding_tech');
        $responseWeb5->assertStatus(200);
        $responseWeb5->assertSee('Zero to Job-Ready Software Engineer with', false);
        $responseWeb5->assertSee('career-launch.ts', false);
        $responseWeb5->assertSee('Apply for Bootcamp Cohort', false);

        $responseWeb6 = $this->get('/store/apex-entrance-academy?type=business_website&theme=coaching_web_school_tuition');
        $responseWeb6->assertStatus(200);
        $responseWeb6->assertSee('Personalized <span class="text-amber-600">K-12 Tuitions</span>', false);
        $responseWeb6->assertSee('Strict Limit: Maximum 15 Students per Batch', false);
        $responseWeb6->assertSee('Weekly Student Analytics', false);
        $responseWeb6->assertSee('Book 1-Week Trial Class', false);

        // Test E-Commerce Storefront Rendering (All 6 Distinct Layouts)
        $responseEcom1 = $this->get('/store/apex-entrance-academy?type=ecommerce&theme=coaching_ecom_test_series');
        $responseEcom1->assertStatus(200);
        $responseEcom1->assertSee('All-India Mock Test Series &amp; CBT Examination Portal', false);
        $responseEcom1->assertSee('Real NTA CBT Interface', false);

        $responseEcom2 = $this->get('/store/apex-entrance-academy?type=ecommerce&theme=coaching_ecom_study_notes');
        $responseEcom2->assertStatus(200);
        $responseEcom2->assertSee('Formula Cheat Sheets', false);
        $responseEcom2->assertSee('100 GSM Opaque', false);

        $responseEcom3 = $this->get('/store/apex-entrance-academy?type=ecommerce&theme=coaching_ecom_recorded_lectures');
        $responseEcom3->assertStatus(200);
        $responseEcom3->assertSee('Offline Pen-Drive Kits', false);
        $responseEcom3->assertSee('Encrypted Pen-Drive', false);

        $responseEcom4 = $this->get('/store/apex-entrance-academy?type=ecommerce&theme=coaching_ecom_pyq_question_banks');
        $responseEcom4->assertStatus(200);
        $responseEcom4->assertSee('Topic-Wise Categorized Previous Year Questions', false);
        $responseEcom4->assertSee('25 YEARS SOLVED', false);

        $responseEcom5 = $this->get('/store/apex-entrance-academy?type=ecommerce&theme=coaching_ecom_language_kits');
        $responseEcom5->assertStatus(200);
        $responseEcom5->assertSee('German, French &amp; Spoken English', false);
        $responseEcom5->assertSee('Waterproof Lexicon', false);

        $responseEcom6 = $this->get('/store/apex-entrance-academy?type=ecommerce&theme=coaching_ecom_school_stationery');
        $responseEcom6->assertStatus(200);
        $responseEcom6->assertSee('Original Scientific Calculators', false);
        $responseEcom6->assertSee('500-Sheet OMR Bundle', false);

        // Test Landing Page Storefront Rendering (All 6 Distinct Layouts)
        $responseLanding1 = $this->get('/store/apex-entrance-academy?type=landing_page&theme=coaching_landing_scholarship_admission');
        $responseLanding1->assertStatus(200);
        $responseLanding1->assertSee('NATIONAL SCHOLARSHIP ADMISSION TEST');
        $responseLanding1->assertSee('UP TO 100% SCHOLARSHIP');

        $responseLanding2 = $this->get('/store/apex-entrance-academy?type=landing_page&theme=coaching_landing_crash_course_neet_jee');
        $responseLanding2->assertStatus(200);
        $responseLanding2->assertSee('90-Day Rank-Booster Intensive Crash Program', false);
        $responseLanding2->assertSee('Final Exam Countdown', false);

        $responseLanding3 = $this->get('/store/apex-entrance-academy?type=landing_page&theme=coaching_landing_free_demo_class');
        $responseLanding3->assertStatus(200);
        $responseLanding3->assertSee('Flat ₹0 Cost', false);
        $responseLanding3->assertSee('OFFICIAL VIP TRIAL PASS', false);

        $responseLanding4 = $this->get('/store/apex-entrance-academy?type=landing_page&theme=coaching_landing_upsc_foundation_batch');
        $responseLanding4->assertStatus(200);
        $responseLanding4->assertSee('UPSC Civil Services 1-Year Integrated GS Foundation Program', false);

        $responseLanding5 = $this->get('/store/apex-entrance-academy?type=landing_page&theme=coaching_landing_coding_placement_bootcamp');
        $responseLanding5->assertStatus(200);
        $responseLanding5->assertSee('Min ₹8 LPA Job Guarantee', false);

        $responseLanding6 = $this->get('/store/apex-entrance-academy?type=landing_page&theme=coaching_landing_study_abroad_visa');
        $responseLanding6->assertStatus(200);
        $responseLanding6->assertSee('100% Visa Approval Track Record', false);
    }

    public function test_doctors_and_specialists_templates_catalog_and_modes(): void
    {
        $websites = TemplateCatalog::getForCategory('Doctors & Specialists', 'business_website');
        $ecommerces = TemplateCatalog::getForCategory('Doctors & Specialists', 'ecommerce');
        $landings = TemplateCatalog::getForCategory('Doctors & Specialists', 'landing_page');
        $all = TemplateCatalog::getForCategory('Doctors & Specialists', 'all');

        $this->assertCount(6, $websites);
        $this->assertCount(6, $ecommerces);
        $this->assertCount(6, $landings);
        $this->assertCount(18, $all);

        // Verify that every single template has its own unique image
        $images = array_column($all, 'image_url');
        $this->assertCount(18, array_unique($images));

        $this->seed([ArchetypeSeeder::class]);
        $serviceArchetype = Archetype::where('code', 'service')->first();

        $doctorTenant = Tenant::create([
            'business_name' => 'Dr. Sharma Specialty Clinic',
            'slug' => 'dr-sharma-specialty-clinic',
            'archetype_id' => $serviceArchetype->id,
            'phone' => '9822001122',
            'city' => 'Nagpur',
            'active_theme' => 'doctor_web_consultant_physician',
            'settings' => [
                'business_category' => 'Doctors & Specialists',
                'website_type' => 'business_website',
            ],
        ]);

        // Test MerchantDashboard template discovery for Doctors & Specialists
        Livewire::test(MerchantDashboard::class, ['slug' => $doctorTenant->slug])
            ->call('openTemplatePreview', 'doctor_web_consultant_physician')
            ->assertSee('Senior Consultant Physician &amp; Diabetologist', false)
            ->call('openTemplatePreview', 'doctor_ecom_prescription_refills')
            ->assertSee('Dr. Care 24/7 Prescription Refill', false)
            ->call('openTemplatePreview', 'doctor_landing_second_opinion')
            ->assertSee('Expert Super-Specialist Second Opinion', false);

        // Test Website Storefront Rendering
        $responseWeb = $this->get('/store/dr-sharma-specialty-clinic?type=business_website&theme=doctor_web_consultant_physician');
        $responseWeb->assertStatus(200);
        $responseWeb->assertSee('Senior Consultant Physician &amp; Diabetologist', false);
        $responseWeb->assertSee('MD General Medicine', false);
        $responseWeb->assertSee('Verified Specialist MD/MS', false);

        // Test E-Commerce Storefront Rendering
        $responseEcom = $this->get('/store/dr-sharma-specialty-clinic?type=ecommerce&theme=doctor_ecom_prescription_refills');
        $responseEcom->assertStatus(200);
        $responseEcom->assertSee('Doctor-Verified Prescription Refills &amp; Pharmacy', false);
        $responseEcom->assertSee('Doctor Rx Verified', false);

        // Test Landing Page Storefront Rendering
        $responseLanding = $this->get('/store/dr-sharma-specialty-clinic?type=landing_page&theme=doctor_landing_second_opinion');
        $responseLanding->assertStatus(200);
        $responseLanding->assertSee('CLINICAL SECOND OPINION', false);
        $responseLanding->assertSee('CONFIRM YOUR DIAGNOSIS WITH SENIOR SUPER-SPECIALISTS', false);
    }

    public function test_herbal_care_templates_catalog_and_modes(): void
    {
        $websites = TemplateCatalog::getForCategory('Herbal Care', 'business_website');
        $ecommerces = TemplateCatalog::getForCategory('Herbal Care', 'ecommerce');
        $landings = TemplateCatalog::getForCategory('Herbal Care', 'landing_page');
        $all = TemplateCatalog::getForCategory('Herbal Care', 'all');

        $this->assertCount(6, $websites);
        $this->assertCount(6, $ecommerces);
        $this->assertCount(6, $landings);
        $this->assertCount(18, $all);

        // Verify that every single template has its own unique image
        $images = array_column($all, 'image_url');
        $this->assertCount(18, array_unique($images));

        $this->seed([ArchetypeSeeder::class]);
        $serviceArchetype = Archetype::where('code', 'service')->first();

        $herbalTenant = Tenant::create([
            'business_name' => 'AyurVeda Sanctuary & Herbal Care',
            'slug' => 'ayurveda-sanctuary',
            'archetype_id' => $serviceArchetype->id,
            'phone' => '9822334455',
            'city' => 'Nagpur',
            'active_theme' => 'herbal_web_panchakarma_sanctuary',
            'settings' => [
                'business_category' => 'Herbal Care',
                'website_type' => 'business_website',
            ],
        ]);

        // Test MerchantDashboard template discovery for Herbal Care
        Livewire::test(MerchantDashboard::class, ['slug' => $herbalTenant->slug])
            ->call('openTemplatePreview', 'herbal_web_panchakarma_sanctuary')
            ->assertSee('Panchakarma Detox &amp; Classical Ayurvedic Wellness Sanctuary', false)
            ->call('openTemplatePreview', 'herbal_ecom_cold_pressed_oils')
            ->assertSee('Wood Cold-Pressed Herbal Hair &amp; Body Tailam Apothecary', false)
            ->call('openTemplatePreview', 'herbal_landing_hair_fall_oil')
            ->assertSee('100-Day Ayurvedic Hair Regrowth &amp; Anti-Hairfall Oil Funnel', false);

        // Test Website Storefront Rendering
        $responseWeb = $this->get('/store/ayurveda-sanctuary?type=business_website&theme=herbal_web_panchakarma_sanctuary');
        $responseWeb->assertStatus(200);
        $responseWeb->assertSee('Authentic Classical Panchakarma Sanctuary', false);
        $responseWeb->assertSee('BAMS Senior Vaidyas', false);
        $responseWeb->assertSee('Shirodhara', false);

        // Test E-Commerce Storefront Rendering
        $responseEcom = $this->get('/store/ayurveda-sanctuary?type=ecommerce&theme=herbal_ecom_cold_pressed_oils');
        $responseEcom->assertStatus(200);
        $responseEcom->assertSee('Cold-Pressed Herbal Oils &amp; Tailam Apothecary', false);
        $responseEcom->assertSee('Traditional Ghani Pressed', false);

        // Test Landing Page Storefront Rendering
        $responseLanding = $this->get('/store/ayurveda-sanctuary?type=landing_page&theme=herbal_landing_hair_fall_oil');
        $responseLanding->assertStatus(200);
        $responseLanding->assertSee('100-DAY HAIR REGROWTH PROTOCOL', false);
        $responseLanding->assertSee('STOP SEVERE HAIR FALL', false);
    }

    public function test_manufacturers_templates_catalog_and_modes(): void
    {
        $websites = TemplateCatalog::getForCategory('Manufacturers', 'business_website');
        $ecommerces = TemplateCatalog::getForCategory('Manufacturers', 'ecommerce');
        $landings = TemplateCatalog::getForCategory('Manufacturers', 'landing_page');
        $all = TemplateCatalog::getForCategory('Manufacturers', 'all');

        $this->assertCount(6, $websites);
        $this->assertCount(6, $ecommerces);
        $this->assertCount(6, $landings);
        $this->assertCount(18, $all);

        // Verify that every single template has its own unique image
        $images = array_column($all, 'image_url');
        $this->assertCount(18, array_unique($images));

        $this->seed([ArchetypeSeeder::class]);
        $b2bArchetype = Archetype::where('code', 'b2b')->first();

        $mfgTenant = Tenant::create([
            'business_name' => 'Apex Precision Engineering Works',
            'slug' => 'apex-precision-engineering',
            'archetype_id' => $b2bArchetype->id,
            'phone' => '9822998877',
            'city' => 'Nagpur',
            'active_theme' => 'mfg_web_precision_machining_plant',
            'settings' => [
                'business_category' => 'Manufacturers',
                'website_type' => 'business_website',
            ],
        ]);

        // Test MerchantDashboard template discovery for Manufacturers
        Livewire::test(MerchantDashboard::class, ['slug' => $mfgTenant->slug])
            ->call('openTemplatePreview', 'mfg_web_precision_machining_plant')
            ->assertSee('Precision CNC Machining, Heavy Engineering &amp; Component Plant', false)
            ->call('openTemplatePreview', 'mfg_ecom_industrial_fasteners_hardware')
            ->assertSee('High-Tensile Industrial Fasteners, Bolts &amp; Stainless Hardware Mart', false)
            ->call('openTemplatePreview', 'mfg_landing_custom_oem_rfq')
            ->assertSee('Custom OEM Part Manufacturing &amp; 24-Hour Blueprint RFQ Funnel', false);

        // Test Website Storefront Rendering
        $responseWeb = $this->get('/store/apex-precision-engineering?type=business_website&theme=mfg_web_precision_machining_plant');
        $responseWeb->assertStatus(200);
        $responseWeb->assertSee('Precision CNC &amp; Engineering Plant', false);
        $responseWeb->assertSee('5-Axis VMC Machining', false);
        $responseWeb->assertSee('ISO 9001:2015 Plant', false);

        // Test E-Commerce Storefront Rendering
        $responseEcom = $this->get('/store/apex-precision-engineering?type=ecommerce&theme=mfg_ecom_industrial_fasteners_hardware');
        $responseEcom->assertStatus(200);
        $responseEcom->assertSee('High-Tensile Industrial Fasteners, Bolts &amp; Hardware', false);
        $responseEcom->assertSee('Grade 8.8 &amp; 10.9 Steel', false);

        // Test Landing Page Storefront Rendering
        $responseLanding = $this->get('/store/apex-precision-engineering?type=landing_page&theme=mfg_landing_custom_oem_rfq');
        $responseLanding->assertStatus(200);
        $responseLanding->assertSee('INSTANT BLUEPRINT RFQ', false);
        $responseLanding->assertSee('CUSTOM PRECISION OEM MANUFACTURING', false);
    }

    public function test_other_retail_templates_catalog_and_modes(): void
    {
        $websites = TemplateCatalog::getForCategory('Other Retail', 'business_website');
        $ecommerces = TemplateCatalog::getForCategory('Other Retail', 'ecommerce');
        $landings = TemplateCatalog::getForCategory('Other Retail', 'landing_page');
        $all = TemplateCatalog::getForCategory('Other Retail', 'all');

        $this->assertCount(6, $websites);
        $this->assertCount(6, $ecommerces);
        $this->assertCount(6, $landings);
        $this->assertCount(18, $all);

        // Verify that every single template has its own unique image
        $images = array_column($all, 'image_url');
        $this->assertCount(18, array_unique($images));

        $this->seed([ArchetypeSeeder::class]);
        $retailArchetype = Archetype::where('code', 'retail')->first();

        $retailTenant = Tenant::create([
            'business_name' => 'Apex Lifestyle & Retail Showroom',
            'slug' => 'apex-lifestyle-retail',
            'archetype_id' => $retailArchetype->id,
            'phone' => '9822114455',
            'city' => 'Nagpur',
            'active_theme' => 'retail_web_luxury_jewelry_showroom',
            'settings' => [
                'business_category' => 'Other Retail',
                'website_type' => 'business_website',
            ],
        ]);

        // Test MerchantDashboard template discovery for Other Retail
        Livewire::test(MerchantDashboard::class, ['slug' => $retailTenant->slug])
            ->call('openTemplatePreview', 'retail_web_luxury_jewelry_showroom')
            ->assertSee('Heritage Gold, Solitaire Diamond &amp; Bridal Jewelry Showroom', false)
            ->call('openTemplatePreview', 'retail_ecom_modern_fashion_apparel')
            ->assertSee('Everyday Minimalist Streetwear &amp; Contemporary Casuals Store', false)
            ->call('openTemplatePreview', 'retail_landing_mega_clearance_sale')
            ->assertSee('Annual Clearance Blowout &amp; Midnight Mega Sale Funnel', false);

        // Test Website Storefront Rendering
        $responseWeb = $this->get('/store/apex-lifestyle-retail?type=business_website&theme=retail_web_luxury_jewelry_showroom');
        $responseWeb->assertStatus(200);
        $responseWeb->assertSee('Heritage Gold, Solitaire Diamond &amp; Bridal Jewelry Showroom', false);
        $responseWeb->assertSee('BIS 916 Hallmark Certified', false);
        $responseWeb->assertSee('Private Bridal Lounge', false);

        // Test E-Commerce Storefront Rendering
        $responseEcom = $this->get('/store/apex-lifestyle-retail?type=ecommerce&theme=retail_ecom_modern_fashion_apparel');
        $responseEcom->assertStatus(200);
        $responseEcom->assertSee('Minimalist Streetwear &amp; Everyday Essentials Mart', false);
        $responseEcom->assertSee('100% Pima Cotton', false);

        // Test Landing Page Storefront Rendering
        $responseLanding = $this->get('/store/apex-lifestyle-retail?type=landing_page&theme=retail_landing_mega_clearance_sale');
        $responseLanding->assertStatus(200);
        $responseLanding->assertSee('MIDNIGHT MEGA CLEARANCE SALE &amp; DOORBUSTER DEALS', false);
        $responseLanding->assertSee('ANNUAL MEGA CLEARANCE', false);
    }

    public function test_restaurant_and_cafes_templates_catalog_and_modes(): void
    {
        $websites = TemplateCatalog::getForCategory('Restaurant & Cafes', 'business_website');
        $ecommerces = TemplateCatalog::getForCategory('Restaurant & Cafes', 'ecommerce');
        $landings = TemplateCatalog::getForCategory('Restaurant & Cafes', 'landing_page');
        $all = TemplateCatalog::getForCategory('Restaurant & Cafes', 'all');

        $this->assertCount(6, $websites);
        $this->assertCount(6, $ecommerces);
        $this->assertCount(6, $landings);
        $this->assertCount(18, $all);

        // Verify that every single template has its own unique image
        $images = array_column($all, 'image_url');
        $this->assertCount(18, array_unique($images));

        $this->seed([ArchetypeSeeder::class]);
        $foodArchetype = Archetype::where('code', 'food')->first();

        $restTenant = Tenant::create([
            'business_name' => 'Dawat Royal Heritage Restaurant & Cafe',
            'slug' => 'dawat-royal-heritage',
            'archetype_id' => $foodArchetype->id,
            'phone' => '9822338899',
            'city' => 'Nagpur',
            'active_theme' => 'rest_web_fine_dining_royal_awadh',
            'settings' => [
                'business_category' => 'Restaurant & Cafes',
                'website_type' => 'business_website',
            ],
        ]);

        // Test MerchantDashboard template discovery for Restaurant & Cafes
        Livewire::test(MerchantDashboard::class, ['slug' => $restTenant->slug])
            ->call('openTemplatePreview', 'rest_web_fine_dining_royal_awadh')
            ->assertSee('Royal Awadh Dastarkhwan &amp; Mughlai Dum Pukht Fine Dining', false)
            ->call('openTemplatePreview', 'rest_ecom_cloud_kitchen_biryani_box')
            ->assertSee('Dum Handi Biryani, Galawati Kebabs &amp; Curries Express Delivery', false)
            ->call('openTemplatePreview', 'rest_landing_unlimited_grand_buffet')
            ->assertSee('Sunday Grand Royal Feast: 50-Item Unlimited Buffet at Flat ₹599', false);

        // Test Website Storefront Rendering
        $responseWeb = $this->get('/store/dawat-royal-heritage?type=business_website&theme=rest_web_fine_dining_royal_awadh');
        $responseWeb->assertStatus(200);
        $responseWeb->assertSee('Centuries-Old Dum Pukht Recipes &amp; Silken Galawati Kebabs', false);
        $responseWeb->assertSee('Slow-Cooked Dum Pukht', false);
        $responseWeb->assertSee('Live Classical Sitar', false);

        // Test E-Commerce Storefront Rendering
        $responseEcom = $this->get('/store/dawat-royal-heritage?type=ecommerce&theme=rest_ecom_cloud_kitchen_biryani_box');
        $responseEcom->assertStatus(200);
        $responseEcom->assertSee('Sealed Earthen Clay Handi Biryanis &amp; Charcoal Kebabs Delivery', false);
        $responseEcom->assertSee('Sealed Earthen Matka', false);

        // Test Landing Page Storefront Rendering
        $responseLanding = $this->get('/store/dawat-royal-heritage?type=landing_page&theme=rest_landing_unlimited_grand_buffet');
        $responseLanding->assertStatus(200);
        $responseLanding->assertSee('UNLIMITED ROYAL BUFFET FEAST &amp; LIVE BARBEQUE', false);
        $responseLanding->assertSee('Claim ₹599 Buffet Pass', false);
    }

    public function test_other_services_templates_catalog_and_modes(): void
    {
        $websites = TemplateCatalog::getForCategory('Other Services', 'business_website');
        $ecommerces = TemplateCatalog::getForCategory('Other Services', 'ecommerce');
        $landings = TemplateCatalog::getForCategory('Other Services', 'landing_page');
        $all = TemplateCatalog::getForCategory('Other Services', 'all');

        $this->assertCount(6, $websites);
        $this->assertCount(6, $ecommerces);
        $this->assertCount(6, $landings);
        $this->assertCount(18, $all);

        // Verify that every single template has its own unique image
        $images = array_column($all, 'image_url');
        $this->assertCount(18, array_unique($images));

        $this->seed([ArchetypeSeeder::class]);
        $serviceArchetype = Archetype::where('code', 'service')->first();

        $serviceTenant = Tenant::create([
            'business_name' => 'Apex Premier Legal & Corporate Advisory Chambers',
            'slug' => 'apex-premier-advisory',
            'archetype_id' => $serviceArchetype->id,
            'phone' => '9822998877',
            'city' => 'Nagpur',
            'active_theme' => 'service_web_corporate_law_legal_firm',
            'settings' => [
                'business_category' => 'Other Services',
                'website_type' => 'business_website',
            ],
        ]);

        // Test MerchantDashboard template discovery for Other Services
        Livewire::test(MerchantDashboard::class, ['slug' => $serviceTenant->slug])
            ->call('openTemplatePreview', 'service_web_corporate_law_legal_firm')
            ->assertSee('Corporate Law, Mergers, IPR &amp; High Court Litigation Firm', false)
            ->call('openTemplatePreview', 'service_ecom_home_deep_cleaning_pest_control')
            ->assertSee('Full-Home Deep Cleaning, Sanitization &amp; Odorless Pest Control Mart', false)
            ->call('openTemplatePreview', 'service_landing_emergency_plumbing_electrical')
            ->assertSee('24/7 Emergency Plumbing, Burst Pipe &amp; Electrical Breakdown Dispatch', false);

        // Test Website Storefront Rendering
        $responseWeb = $this->get('/store/apex-premier-advisory?type=business_website&theme=service_web_corporate_law_legal_firm');
        $responseWeb->assertStatus(200);
        $responseWeb->assertSee('Corporate Law, Contract Due Diligence &amp; Commercial Arbitration', false);
        $responseWeb->assertSee('Corporate Due Diligence', false);
        $responseWeb->assertSee('High Court Litigation', false);

        // Test E-Commerce Storefront Rendering
        $responseEcom = $this->get('/store/apex-premier-advisory?type=ecommerce&theme=service_ecom_home_deep_cleaning_pest_control');
        $responseEcom->assertStatus(200);
        $responseEcom->assertSee('Hospital-Grade Home Sanitization &amp; Odorless Pest Control Mart', false);
        $responseEcom->assertSee('Mechanized Deep Scrubbing', false);

        // Test Landing Page Storefront Rendering
        $responseLanding = $this->get('/store/apex-premier-advisory?type=landing_page&theme=service_landing_emergency_plumbing_electrical');
        $responseLanding->assertStatus(200);
        $responseLanding->assertSee('EMERGENCY PLUMBING, BURST PIPES &amp; ELECTRICAL BREAKDOWN IN', false);
        $responseLanding->assertSee('Dispatch Emergency Technician', false);
    }
}
