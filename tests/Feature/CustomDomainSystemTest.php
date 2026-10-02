<?php

namespace Tests\Feature;

use App\Livewire\MerchantDashboard;
use App\Models\Archetype;
use App\Models\Tenant;
use App\Models\User;
use Database\Seeders\ArchetypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CustomDomainSystemTest extends TestCase
{
    use RefreshDatabase;

    protected Tenant $tenant;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(ArchetypeSeeder::class);
        $serviceArchetype = Archetype::where('code', 'service')->first();

        $this->tenant = Tenant::create([
            'business_name' => 'Toppers NEET Academy',
            'slug' => 'toppers-neet',
            'archetype_id' => $serviceArchetype->id,
            'active_theme' => 'coaching_ecom_test_series',
            'phone' => '9876543210',
            'whatsapp_number' => '9876543210',
            'city' => 'Kota',
            'brand_color' => '#2563EB',
            'is_active' => true,
            'settings' => [
                'business_category' => 'Coaching & Institutes',
                'website_type' => 'ecommerce',
            ],
        ]);
    }

    public function test_tenant_model_has_working_domain_helpers(): void
    {
        $this->assertFalse($this->tenant->hasCustomDomain());
        $this->assertEquals('none', $this->tenant->domain_status);
        $this->assertEquals($this->tenant->local_domain_url, $this->tenant->primary_domain_url);
        $this->assertStringStartsWith('http://toppers-neet.localhost', $this->tenant->primary_domain_url);

        // When custom domain is set
        $this->tenant->update(['custom_domain' => 'toppersneet.in']);
        $this->assertTrue($this->tenant->hasCustomDomain());
        $this->assertEquals('https://toppersneet.in', $this->tenant->production_domain_url);
    }

    public function test_merchant_can_access_domains_tab_in_dashboard(): void
    {
        Livewire::test(MerchantDashboard::class, ['slug' => 'toppers-neet'])
            ->set('activeTab', 'domains')
            ->assertSee('Domains &amp; URLs', false)
            ->assertSee('Current Primary Store URL')
            ->assertSee('Buy a New Domain')
            ->assertSee('Connect Existing Domain')
            ->assertSee('domains.anemony.in');
    }

    public function test_merchant_can_search_domain_availability_and_pricing(): void
    {
        Livewire::test(MerchantDashboard::class, ['slug' => 'toppers-neet'])
            ->set('activeTab', 'domains')
            ->set('domainSearchQuery', 'targetneet')
            ->call('searchDomainAvailability')
            ->assertSet('isSearchingDomain', false)
            ->assertSee('targetneet.in')
            ->assertSee('targetneet.com')
            ->assertSee('₹499')
            ->assertSee('₹899');
    }

    public function test_merchant_can_purchase_and_auto_activate_custom_domain(): void
    {
        Livewire::test(MerchantDashboard::class, ['slug' => 'toppers-neet'])
            ->set('activeTab', 'domains')
            ->call('purchaseDomain', 'targetneet.in')
            ->assertSet('customDomain', 'targetneet.in')
            ->assertSet('domainStatus', 'active')
            ->assertSet('domainSsl', true)
            ->assertSee('Congratulations! targetneet.in has been registered and connected live');

        $this->tenant->refresh();
        $this->assertEquals('targetneet.in', $this->tenant->custom_domain);
        $this->assertEquals('active', $this->tenant->settings['domain_status']);
        $this->assertEquals('purchased', $this->tenant->settings['domain_type']);
        $this->assertTrue($this->tenant->settings['domain_ssl']);
    }

    public function test_merchant_can_connect_existing_domain_and_verify_dns(): void
    {
        // 1. Link existing domain
        Livewire::test(MerchantDashboard::class, ['slug' => 'toppers-neet'])
            ->set('activeTab', 'domains')
            ->set('existingDomainInput', 'https://mykotaacademy.com/')
            ->call('connectExistingDomain')
            ->assertSet('customDomain', 'mykotaacademy.com')
            ->assertSet('domainStatus', 'pending')
            ->assertSet('domainSsl', false)
            ->assertSee('Domain mykotaacademy.com linked!');

        $this->tenant->refresh();
        $this->assertEquals('mykotaacademy.com', $this->tenant->custom_domain);
        $this->assertEquals('pending', $this->tenant->settings['domain_status']);

        // 2. Verify DNS
        Livewire::test(MerchantDashboard::class, ['slug' => 'toppers-neet'])
            ->set('activeTab', 'domains')
            ->call('verifyDomainDns')
            ->assertSet('domainStatus', 'active')
            ->assertSet('domainSsl', true)
            ->assertSee('DNS records verified successfully!');

        $this->tenant->refresh();
        $this->assertEquals('active', $this->tenant->settings['domain_status']);
        $this->assertTrue($this->tenant->settings['domain_ssl']);
    }

    public function test_merchant_can_remove_custom_domain_and_revert_to_test_url(): void
    {
        $this->tenant->update([
            'custom_domain' => 'toppersneet.in',
            'settings' => array_merge($this->tenant->settings, ['domain_status' => 'active']),
        ]);

        Livewire::test(MerchantDashboard::class, ['slug' => 'toppers-neet'])
            ->set('activeTab', 'domains')
            ->call('removeCustomDomain')
            ->assertSet('customDomain', '')
            ->assertSet('domainStatus', 'none')
            ->assertSee('Custom domain removed. Free test subdomain is now your primary live store URL.');

        $this->tenant->refresh();
        $this->assertNull($this->tenant->custom_domain);
    }

    public function test_storefront_resolves_via_custom_domain_at_root(): void
    {
        $this->tenant->update([
            'custom_domain' => 'kota-toppers.test',
            'settings' => array_merge($this->tenant->settings, ['domain_status' => 'active']),
        ]);

        // Request directly to custom domain host
        $response = $this->get('http://kota-toppers.test/');

        $response->assertStatus(200);
        $response->assertSee('Toppers NEET Academy');
    }

    public function test_dashboard_displays_store_domain_banner_and_respects_tab_query_param(): void
    {
        // 1. Direct GET request with ?tab=domains should render Domain Hub
        $response = $this->get('/store/toppers-neet/dashboard?tab=domains');
        $response->assertStatus(200);
        $response->assertSee('Domains &amp; URLs', false);
        $response->assertSee('Buy a New Domain');

        // 2. Default dashboard view should also display the live website address banner
        $responseDefault = $this->get('/store/toppers-neet/dashboard');
        $responseDefault->assertStatus(200);
        $responseDefault->assertSee('Live Website Address');
        $responseDefault->assertSee('toppers-neet.localhost');
    }

    public function test_subdomain_resolves_to_storefront_directly(): void
    {
        // 1. Production-style tenant subdomain (toppers-neet.anemony.in)
        $responseProdSubdomain = $this->get('http://toppers-neet.anemony.in/');
        $responseProdSubdomain->assertStatus(200);
        $responseProdSubdomain->assertSee('Toppers NEET Academy');

        // 2. Localhost development tenant subdomain (toppers-neet.localhost)
        $responseDevSubdomain = $this->get('http://toppers-neet.localhost:8000/');
        $responseDevSubdomain->assertStatus(200);
        $responseDevSubdomain->assertSee('Toppers NEET Academy');
    }

    public function test_central_domain_serves_saas_platform_welcome(): void
    {
        $response = $this->get('http://localhost:8000/');
        $response->assertStatus(200);
        $response->assertSee('Anemony');
    }

    public function test_login_and_dashboard_on_subdomain(): void
    {
        $responseLogin = $this->get('http://toppers-neet.localhost:8000/login');
        $responseLogin->assertStatus(200);

        $responseDashboardGuest = $this->get('http://toppers-neet.localhost:8000/dashboard');
        $responseDashboardGuest->assertRedirect();

        $user = User::factory()->create([
            'role' => 'merchant',
            'tenant_id' => $this->tenant->id,
        ]);

        $responseDashboardAuth = $this->actingAs($user)->get('http://toppers-neet.localhost:8000/dashboard');
        $responseDashboardAuth->assertRedirect('http://toppers-neet.localhost:8000/store/toppers-neet/dashboard');

        $responseDashboardPage = $this->actingAs($user)->get('http://toppers-neet.localhost:8000/store/toppers-neet/dashboard');
        $responseDashboardPage->assertStatus(200);
        $responseDashboardPage->assertSee('Toppers NEET Academy');
    }
}
