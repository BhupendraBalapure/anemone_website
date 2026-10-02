<?php

namespace Tests\Feature;

use App\Livewire\TemplateEditor;
use App\Models\Archetype;
use App\Models\Tenant;
use Database\Seeders\ArchetypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class TemplateEditorTest extends TestCase
{
    use RefreshDatabase;

    protected Tenant $tenant;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(ArchetypeSeeder::class);
        $serviceArchetype = Archetype::where('code', 'service')->first();

        $this->tenant = Tenant::create([
            'business_name' => 'Apex Test Academy',
            'slug' => 'apex-test-academy',
            'archetype_id' => $serviceArchetype->id,
            'active_theme' => 'coaching_ecom_test_series',
            'phone' => '9876543210',
            'whatsapp_number' => '9876543210',
            'city' => 'Nagpur',
            'address' => 'Civil Lines, Nagpur',
            'brand_color' => '#2563EB',
            'is_active' => true,
            'settings' => [
                'business_category' => 'Coaching & Institutes',
                'website_type' => 'ecommerce',
            ],
        ]);
    }

    public function test_merchant_can_access_template_editor_page(): void
    {
        $response = $this->get('/store/apex-test-academy/editor');

        $response->assertStatus(200);
        $response->assertSee('Template Editor');
        $response->assertSee('Apex Test Academy');
        $response->assertSee('Save &amp; Publish', false);
    }

    public function test_merchant_can_update_hero_content_and_pricing_via_template_editor(): void
    {
        Livewire::test(TemplateEditor::class, ['slug' => 'apex-test-academy'])
            ->set('heroHeadline', 'Supercharged Kota CBT Simulator')
            ->set('heroHighlight', 'Toppers Edition')
            ->set('pricingSalePrice', '299')
            ->set('pricingDiscountTag', '85% OFF SPECIAL')
            ->set('heroPrimaryCtaText', 'Join Supercharged Batch')
            ->call('saveCustomizations')
            ->assertSee('All template changes saved and published live successfully!');

        $this->tenant->refresh();
        $this->assertEquals('Supercharged Kota CBT Simulator', $this->tenant->settings['template_customizations']['hero']['headline']);
        $this->assertEquals('299', $this->tenant->settings['template_customizations']['pricing']['sale_price']);

        // Verify the live storefront renders the updated custom content
        $storeResponse = $this->get('/store/apex-test-academy?type=ecommerce&theme=coaching_ecom_test_series');
        $storeResponse->assertStatus(200);
        $storeResponse->assertSee('Supercharged Kota CBT Simulator');
        $storeResponse->assertSee('Toppers Edition');
        $storeResponse->assertSee('₹299');
        $storeResponse->assertSee('85% OFF SPECIAL');
        $storeResponse->assertSee('Join Supercharged Batch');
    }

    public function test_merchant_can_exchange_section_order_and_toggle_visibility(): void
    {
        Livewire::test(TemplateEditor::class, ['slug' => 'apex-test-academy'])
            ->call('moveSectionDown', 0) // Hero moves from index 0 to index 1
            ->call('toggleSectionVisibility', 'reviews') // Deactivate reviews
            ->call('saveCustomizations');

        $this->tenant->refresh();
        $order = $this->tenant->settings['template_customizations']['sections_order'];
        $this->assertEquals('trust', $order[0]);
        $this->assertEquals('hero', $order[1]);
        $this->assertFalse($this->tenant->settings['template_customizations']['sections_visibility']['reviews']);

        // Verify reviews section is now hidden from storefront
        $storeResponse = $this->get('/store/apex-test-academy?type=ecommerce&theme=coaching_ecom_test_series');
        $storeResponse->assertStatus(200);
        $storeResponse->assertDontSee('id="reviews"', false);
    }

    public function test_merchant_can_reset_template_to_defaults(): void
    {
        // First apply customization
        Livewire::test(TemplateEditor::class, ['slug' => 'apex-test-academy'])
            ->set('heroHeadline', 'Custom Title')
            ->call('saveCustomizations');

        $this->tenant->refresh();
        $this->assertArrayHasKey('template_customizations', $this->tenant->settings);

        // Reset to defaults
        Livewire::test(TemplateEditor::class, ['slug' => 'apex-test-academy'])
            ->call('resetToDefaults')
            ->assertSee('Template reset to original defaults.');

        $this->tenant->refresh();
        $this->assertArrayNotHasKey('template_customizations', $this->tenant->settings);
    }

    public function test_merchant_can_upload_and_remove_brand_logo(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('brand-logo.png', 300, 300);

        Livewire::test(TemplateEditor::class, ['slug' => 'apex-test-academy'])
            ->set('logoFile', $file)
            ->call('saveCustomizations')
            ->assertSee('All template changes saved and published live successfully!');

        $this->tenant->refresh();
        $this->assertNotNull($this->tenant->settings['logo_url']);
        $this->assertStringContainsString('logos/', $this->tenant->settings['logo_url']);

        // Now test removing the logo
        Livewire::test(TemplateEditor::class, ['slug' => 'apex-test-academy'])
            ->call('removeLogo');

        $this->tenant->refresh();
        $this->assertEmpty($this->tenant->settings['logo_url']);
    }

    public function test_merchant_can_upload_and_toggle_hero_background_image(): void
    {
        Storage::fake('public');

        $imageFile = UploadedFile::fake()->image('coaching-campus.jpg', 1200, 800);

        Livewire::test(TemplateEditor::class, ['slug' => 'apex-test-academy'])
            ->set('heroBackgroundImageFile', $imageFile)
            ->assertSee('Hero background image uploaded and published live!');

        $this->tenant->refresh();
        $heroSettings = $this->tenant->settings['template_customizations']['hero'];
        $this->assertNotEmpty($heroSettings['background_image_url']);
        $this->assertStringContainsString('hero-bg/', $heroSettings['background_image_url']);

        // Verify live storefront displays the background image AND keeps the official CBT simulator console!
        $storeResponse = $this->get('/store/apex-test-academy?type=ecommerce&theme=coaching_ecom_test_series');
        $storeResponse->assertStatus(200);
        $storeResponse->assertSee($heroSettings['background_image_url']);
        $storeResponse->assertSee('NTA-JEE-CBT-SIMULATOR_v4');

        // Test removing custom hero background image (restores default background while keeping simulator)
        Livewire::test(TemplateEditor::class, ['slug' => 'apex-test-academy'])
            ->call('removeHeroBackgroundImage');

        $this->tenant->refresh();
        $heroSettings = $this->tenant->settings['template_customizations']['hero'];
        $this->assertEmpty($heroSettings['background_image_url']);

        // Storefront continues to show CBT simulator console
        $storeResponseAfter = $this->get('/store/apex-test-academy?type=ecommerce&theme=coaching_ecom_test_series');
        $storeResponseAfter->assertStatus(200);
        $storeResponseAfter->assertSee('NTA-JEE-CBT-SIMULATOR_v4');
    }

    public function test_merchant_can_update_hero_ticker_badges_and_stat_chips(): void
    {
        Livewire::test(TemplateEditor::class, ['slug' => 'apex-test-academy'])
            ->set('heroTickerText', 'ADMISSIONS 2026 OPEN • 100% SCHOLARSHIP MOCK LIVE')
            ->set('heroBadge', 'Kota Faculty Online Portal')
            ->set('heroSubBadge', '5,000+ Selections in IIT JEE & NEET')
            ->set('heroStat1Value', '250+')
            ->set('heroStat1Label', 'Mock Tests')
            ->call('saveCustomizations');

        $this->tenant->refresh();
        $hero = $this->tenant->settings['template_customizations']['hero'];
        $this->assertEquals('ADMISSIONS 2026 OPEN • 100% SCHOLARSHIP MOCK LIVE', $hero['ticker_text']);
        $this->assertEquals('5,000+ Selections in IIT JEE & NEET', $hero['sub_badge']);
        $this->assertEquals('250+', $hero['stat1_value']);

        // Verify live storefront renders them
        $storeResponse = $this->get('/store/apex-test-academy?type=ecommerce&theme=coaching_ecom_test_series');
        $storeResponse->assertStatus(200);
        $storeResponse->assertSee('ADMISSIONS 2026 OPEN • 100% SCHOLARSHIP MOCK LIVE');
        $storeResponse->assertSee('Kota Faculty Online Portal');
        $storeResponse->assertSee('5,000+ Selections in IIT JEE & NEET');
        $storeResponse->assertSee('250+');
        $storeResponse->assertSee('Mock Tests');
    }

    public function test_template_editor_loads_tailored_defaults_for_all_business_categories(): void
    {
        $categories = [
            'Beauty & Salons',
            'Clinics & Hospitals',
            'Doctors & Specialists',
            'Restaurant & Cafes',
            'Hotels & Motels',
            'Real Estate & Properties',
            'Manufacturers',
            'Herbal Care',
            'Other Services',
            'Other Retail',
            'Coaching & Institutes',
        ];

        foreach ($categories as $category) {
            $catTenant = Tenant::create([
                'business_name' => "Sample {$category} Biz",
                'slug' => 'sample-'.Str::slug($category),
                'archetype_id' => $this->tenant->archetype_id,
                'active_theme' => 'coaching_ecom_test_series',
                'phone' => '9876543210',
                'brand_color' => '#10B981',
                'is_active' => true,
                'settings' => [
                    'business_category' => $category,
                ],
            ]);

            $component = Livewire::test(TemplateEditor::class, ['slug' => $catTenant->slug]);
            $defaults = $component->instance()->getCategoryDefaults();

            $this->assertNotEmpty($defaults['hero']['headline'], "Category {$category} must have a hero headline");
            $this->assertNotEmpty($defaults['hero']['badge'], "Category {$category} must have a hero badge");
            $this->assertNotEmpty($defaults['trust']['cards'], "Category {$category} must have trust cards");
            $this->assertNotEmpty($defaults['inquiry']['title'], "Category {$category} must have inquiry title");
        }
    }
}
