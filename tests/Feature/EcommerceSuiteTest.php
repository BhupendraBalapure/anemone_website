<?php

namespace Tests\Feature;

use App\Livewire\MerchantDashboard;
use App\Livewire\StoreHome;
use App\Models\Archetype;
use App\Models\CatalogItem;
use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EcommerceSuiteTest extends TestCase
{
    use RefreshDatabase;

    protected Tenant $tenant;

    protected function setUp(): void
    {
        parent::setUp();

        $archetype = Archetype::firstOrCreate(
            ['code' => 'retail'],
            [
                'name' => 'Retail & Store',
                'description' => 'E-Commerce retail',
                'enabled_features' => ['cart', 'products', 'inventory'],
                'cta_label' => 'Order Online',
                'schema_type' => 'Store',
            ]
        );

        $this->tenant = Tenant::create([
            'business_name' => 'Apex Coaching & Books',
            'slug' => 'apex-books',
            'archetype_id' => $archetype->id,
            'business_category' => 'Coaching & Institutes',
            'phone' => '9876543210',
            'whatsapp_number' => '9876543210',
            'active_theme' => 'coaching_ecom_test_series',
            'settings' => [
                'website_type' => 'ecommerce',
                'coupons' => [
                    [
                        'code' => 'TEST10',
                        'type' => 'percentage',
                        'value' => 10,
                        'min_order' => 100,
                        'description' => '10% OFF on orders above ₹100',
                        'active' => true,
                    ],
                    [
                        'code' => 'FLAT50',
                        'type' => 'fixed',
                        'value' => 50,
                        'min_order' => 500,
                        'description' => 'Flat ₹50 OFF on orders above ₹500',
                        'active' => true,
                    ],
                ],
            ],
        ]);
    }

    public function test_merchant_can_add_product_with_brand_badge_and_stock(): void
    {
        Livewire::test(MerchantDashboard::class, ['slug' => $this->tenant->slug])
            ->call('openNewItemModal')
            ->set('itemTitle', 'Allen Kota Physics Mindmap')
            ->set('itemCategory', 'Study Notes')
            ->set('itemPrice', 499)
            ->set('itemComparePrice', 899)
            ->set('itemBrand', 'Allen Career Institute')
            ->set('itemBadge', 'Bestseller')
            ->set('itemStockQty', 40)
            ->set('itemInStock', true)
            ->call('saveItem')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('catalog_items', [
            'tenant_id' => $this->tenant->id,
            'title' => 'Allen Kota Physics Mindmap',
            'category_name' => 'Study Notes',
            'price' => 499,
            'compare_at_price' => 899,
            'stock_quantity' => 40,
            'in_stock' => true,
        ]);

        $item = CatalogItem::where('title', 'Allen Kota Physics Mindmap')->first();
        $this->assertNotNull($item);
        $this->assertEquals('Allen Career Institute', $item->attributes['brand'] ?? null);
        $this->assertEquals('Bestseller', $item->attributes['badge'] ?? null);
    }

    public function test_merchant_can_manage_promotional_coupons(): void
    {
        Livewire::test(MerchantDashboard::class, ['slug' => $this->tenant->slug])
            ->call('openCouponModal')
            ->set('newCouponCode', 'FESTIVE25')
            ->set('newCouponType', 'percentage')
            ->set('newCouponValue', 25)
            ->set('newCouponMinOrder', 699)
            ->set('newCouponDescription', '25% festive discount')
            ->call('saveCoupon')
            ->assertHasNoErrors();

        $fresh = $this->tenant->fresh();
        $coupons = $fresh->settings['coupons'] ?? [];
        $codes = array_column($coupons, 'code');
        $this->assertContains('FESTIVE25', $codes);

        // Toggle and Delete
        $comp = Livewire::test(MerchantDashboard::class, ['slug' => $this->tenant->slug]);
        $comp->call('toggleCoupon', 0);
        $this->assertFalse($this->tenant->fresh()->settings['coupons'][0]['active']);

        $comp->call('deleteCoupon', 0);
        $this->assertCount(count($coupons) - 1, $this->tenant->fresh()->settings['coupons']);
    }

    public function test_storefront_filters_by_brand_and_category(): void
    {
        CatalogItem::create([
            'tenant_id' => $this->tenant->id,
            'title' => 'Physics Wallah Test Series',
            'category_name' => 'Test Series',
            'price' => 299,
            'type' => 'product',
            'in_stock' => true,
            'attributes' => ['brand' => 'Physics Wallah'],
        ]);

        CatalogItem::create([
            'tenant_id' => $this->tenant->id,
            'title' => 'Resonance Chemistry Booster',
            'category_name' => 'Study Notes',
            'price' => 599,
            'type' => 'product',
            'in_stock' => true,
            'attributes' => ['brand' => 'Resonance'],
        ]);

        // Filter by Brand: Physics Wallah
        $test = Livewire::test(StoreHome::class, ['slug' => $this->tenant->slug])
            ->set('selectedBrand', 'Physics Wallah');

        $items = $test->viewData('items');
        $this->assertCount(1, $items);
        $this->assertEquals('Physics Wallah Test Series', $items->first()->title);

        // Filter by Category: Study Notes
        $testCat = Livewire::test(StoreHome::class, ['slug' => $this->tenant->slug])
            ->set('selectedBrand', 'all')
            ->set('selectedCategory', 'Study Notes');

        $itemsCat = $testCat->viewData('items');
        $this->assertCount(1, $itemsCat);
        $this->assertEquals('Resonance Chemistry Booster', $itemsCat->first()->title);
    }

    public function test_ecommerce_coupon_application_and_discount_calculation(): void
    {
        $item = CatalogItem::create([
            'tenant_id' => $this->tenant->id,
            'title' => 'Complete JEE Test Pass',
            'price' => 600,
            'type' => 'product',
            'in_stock' => true,
        ]);

        $test = Livewire::test(StoreHome::class, ['slug' => $this->tenant->slug])
            ->call('addToCart', $item->id)
            ->assertSet('subtotal', 600.0)
            ->call('applyCoupon', 'TEST10')
            ->assertSet('discountAmount', 60.0)
            ->assertSet('cartTotal', 540.0);

        $this->assertEquals('TEST10', $test->get('appliedCoupon')['code'] ?? null);

        // Test Minimum Order Validation: FLAT50 requires min_order 500
        $cheapItem = CatalogItem::create([
            'tenant_id' => $this->tenant->id,
            'title' => 'Quick Formula Sheet',
            'price' => 200,
            'type' => 'product',
            'in_stock' => true,
        ]);

        $testMin = Livewire::test(StoreHome::class, ['slug' => $this->tenant->slug])
            ->call('addToCart', $cheapItem->id)
            ->call('applyCoupon', 'FLAT50')
            ->assertSet('discountAmount', 0.0);

        $this->assertNotEquals('', $testMin->get('couponError'));
    }

    public function test_direct_web_checkout_places_order_with_coupon_metadata(): void
    {
        $item = CatalogItem::create([
            'tenant_id' => $this->tenant->id,
            'title' => 'NEET Ranker Module',
            'price' => 800,
            'type' => 'product',
            'in_stock' => true,
        ]);

        Livewire::test(StoreHome::class, ['slug' => $this->tenant->slug])
            ->call('addToCart', $item->id)
            ->call('applyCoupon', 'TEST10')
            ->set('customerName', 'Rohan Sharma')
            ->set('customerPhone', '9876543210')
            ->set('customerAddress', 'Flat 402, Kota Vigyan Nagar, Rajasthan')
            ->call('checkoutWebOrder')
            ->assertHasNoErrors()
            ->assertSet('showOrderSuccessModal', true);

        $order = Order::where('customer_name', 'Rohan Sharma')->first();
        $this->assertNotNull($order);
        $this->assertEquals('cod', $order->payment_method);
        $this->assertEquals('new', $order->status);
        $this->assertEquals(720.0, (float) $order->total_amount); // 800 - 80 (10%)
        $this->assertEquals('TEST10', $order->metadata['coupon']['code'] ?? null);
        $this->assertEquals(80.0, (float) ($order->metadata['discount_amount'] ?? 0));
    }

    public function test_merchant_can_update_order_status(): void
    {
        $order = Order::create([
            'tenant_id' => $this->tenant->id,
            'order_number' => 'ORD-TEST12',
            'type' => 'order',
            'customer_name' => 'Aarav Patel',
            'customer_phone' => '9876543210',
            'total_amount' => 500,
            'payment_status' => 'pending',
            'payment_method' => 'cod',
            'status' => 'new',
            'items_payload' => [],
        ]);

        Livewire::test(MerchantDashboard::class, ['slug' => $this->tenant->slug])
            ->call('updateOrderStatus', $order->id, 'dispatched');

        $this->assertEquals('dispatched', $order->fresh()->status);
    }
}
