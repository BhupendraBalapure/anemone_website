<?php

namespace App\Console\Commands;

use App\Models\CatalogItem;
use App\Models\Tenant;
use Illuminate\Console\Command;

class EnrichTenantCatalog extends Command
{
    protected $signature = 'app:enrich-tenant-catalog {slug=bbb-lcug}';

    protected $description = 'Enrich tenant products with live brands, compare prices, badges, and promo coupons';

    public function handle(): int
    {
        $slug = $this->argument('slug');
        $tenant = Tenant::where('slug', $slug)->first();

        if (! $tenant) {
            $this->error("Tenant '{$slug}' not found.");

            return 1;
        }

        // 1. Update Tenant Settings with Active Coupons
        $settings = $tenant->settings ?? [];
        $settings['coupons'] = [
            [
                'code' => 'WELCOME10',
                'type' => 'percentage',
                'value' => 10,
                'min_order' => 299,
                'description' => '10% instant discount on orders above ₹299',
                'active' => true,
            ],
            [
                'code' => 'FLAT100',
                'type' => 'fixed',
                'value' => 100,
                'min_order' => 799,
                'description' => 'Flat ₹100 OFF on full course passes above ₹799',
                'active' => true,
            ],
            [
                'code' => 'SUPERKOTA',
                'type' => 'percentage',
                'value' => 15,
                'min_order' => 999,
                'description' => '15% Mega Discount for Kota Ranker Series',
                'active' => true,
            ],
        ];
        $tenant->update(['settings' => $settings]);
        $this->info("Coupons updated for {$tenant->business_name}.");

        // 2. Sample products data with Brands & Badges
        $itemsData = [
            [
                'title' => 'NTA JEE Main 2026 Full CBT Mock Pass',
                'category_name' => 'Test Series Passes',
                'price' => 499,
                'compare_at_price' => 999,
                'brand' => 'Allen Career Institute',
                'badge' => 'Bestseller',
                'stock_quantity' => 45,
                'image_url' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=700&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'NEET UG 2026 All-India Simulator Pass',
                'category_name' => 'Test Series Passes',
                'price' => 599,
                'compare_at_price' => 1199,
                'brand' => 'Physics Wallah',
                'badge' => 'Trending',
                'stock_quantity' => 38,
                'image_url' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=700&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Kota AIR 1 Handwritten Physics Spiral Notes',
                'category_name' => 'Printed Notes',
                'price' => 799,
                'compare_at_price' => 1499,
                'brand' => 'Resonance Kota',
                'badge' => 'AIR 1 Choice',
                'stock_quantity' => 20,
                'image_url' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=700&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Complete Chemistry Reaction Charts & Formula Book',
                'category_name' => 'Formula Kits',
                'price' => 349,
                'compare_at_price' => 599,
                'brand' => 'Disha Publication',
                'badge' => 'Hot Deal',
                'stock_quantity' => 60,
                'image_url' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=700&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Casio fx-991CW Scientific Exam Calculator Kit',
                'category_name' => 'Exam Gear',
                'price' => 1299,
                'compare_at_price' => 1695,
                'brand' => 'Casio India',
                'badge' => 'NTA Verified',
                'stock_quantity' => 15,
                'image_url' => 'https://images.unsplash.com/photo-1594980596870-8aa52a78d8cd?w=700&auto=format&fit=crop&q=80',
            ],
            [
                'title' => 'Kota 25-Year Chapterwise Solved PYQ Hardbound',
                'category_name' => 'Printed Notes',
                'price' => 899,
                'compare_at_price' => 1399,
                'brand' => 'Allen Career Institute',
                'badge' => 'Bestseller',
                'stock_quantity' => 28,
                'image_url' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=700&auto=format&fit=crop&q=80',
            ],
        ];

        foreach ($itemsData as $data) {
            $brand = $data['brand'];
            $badge = $data['badge'];
            unset($data['brand'], $data['badge']);

            $existing = CatalogItem::where('tenant_id', $tenant->id)
                ->where('title', $data['title'])
                ->first();

            $attrs = $existing ? ($existing->attributes ?? []) : [];
            $attrs['brand'] = $brand;
            $attrs['badge'] = $badge;

            $data['attributes'] = $attrs;
            $data['type'] = 'product';
            $data['in_stock'] = true;

            if ($existing) {
                $existing->update($data);
                $this->line("Updated: {$data['title']} (Brand: {$brand})");
            } else {
                CatalogItem::create(array_merge($data, ['tenant_id' => $tenant->id]));
                $this->line("Created: {$data['title']} (Brand: {$brand})");
            }
        }

        $this->info("Catalog enrichment completed successfully for '{$slug}'!");

        return 0;
    }
}
