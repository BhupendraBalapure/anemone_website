<?php

namespace Database\Seeders;

use App\Models\Archetype;
use App\Models\CatalogItem;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class DemoStoreSeeder extends Seeder
{
    public function run(): void
    {
        $retailArchetype = Archetype::where('code', 'retail')->first();
        $serviceArchetype = Archetype::where('code', 'service')->first();
        $b2bArchetype = Archetype::where('code', 'b2b')->first();

        // 1. Retail Store: Sharma Kirana & General Store
        $retailStore = Tenant::updateOrCreate(
            ['slug' => 'sharma-kirana'],
            [
                'business_name' => 'Sharma Kirana & General Store',
                'archetype_id' => $retailArchetype->id,
                'phone' => '9876543210',
                'whatsapp_number' => '9876543210',
                'city' => 'Kanpur',
                'address' => 'Shop #12, Market Road, Swaroop Nagar, Kanpur',
                'tagline' => 'Fresh Groceries & Daily Essentials at Wholesale Rates',
                'about_text' => 'Serving quality groceries, pulses, spices, and household essentials directly to your doorstep since 2012.',
                'brand_color' => '#10B981', // Emerald green
                'active_theme' => 'modern_clean',
                'settings' => [
                    'upi_id' => 'sharmakirana@upi',
                    'delivery_min_order' => 200,
                    'free_delivery_above' => 500,
                ],
            ]
        );

        $retailStore->catalogItems()->delete();
        $retailStore->catalogItems()->createMany([
            [
                'title' => 'Fortune Sunlite Refined Sunflower Oil (1 Litre)',
                'category_name' => 'Cooking Oils',
                'price' => 145.00,
                'compare_at_price' => 165.00,
                'type' => 'product',
                'in_stock' => true,
                'stock_quantity' => 50,
                'image_url' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=500&auto=format&fit=crop&q=60',
                'attributes' => ['weight' => '1L', 'brand' => 'Fortune'],
            ],
            [
                'title' => 'Daawat Rozana Super Basmati Rice (5 Kg)',
                'category_name' => 'Grains & Rice',
                'price' => 380.00,
                'compare_at_price' => 450.00,
                'type' => 'product',
                'in_stock' => true,
                'stock_quantity' => 25,
                'image_url' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=500&auto=format&fit=crop&q=60',
                'attributes' => ['weight' => '5kg', 'brand' => 'Daawat'],
            ],
            [
                'title' => 'Tata Sampann Unpolished Toor Dal (1 Kg)',
                'category_name' => 'Pulses & Dals',
                'price' => 175.00,
                'compare_at_price' => 195.00,
                'type' => 'product',
                'in_stock' => true,
                'stock_quantity' => 40,
                'image_url' => 'https://images.unsplash.com/photo-1599488615731-7e5c2823ff28?w=500&auto=format&fit=crop&q=60',
                'attributes' => ['weight' => '1kg', 'brand' => 'Tata'],
            ],
        ]);

        // 2. Healthcare / Service Clinic: Care Dental Clinic & Implant Centre
        $clinicStore = Tenant::updateOrCreate(
            ['slug' => 'care-dental-clinic'],
            [
                'business_name' => 'Care Dental Clinic & Implant Centre',
                'archetype_id' => $serviceArchetype->id,
                'phone' => '9123456780',
                'whatsapp_number' => '9123456780',
                'city' => 'Lucknow',
                'address' => 'Plot 45, Gomti Nagar Phase 2, Lucknow',
                'tagline' => 'Advanced Laser Dentistry & Painless Smile Makeovers',
                'about_text' => 'Dr. R. K. Verma (MDS - Orthodontics) with 15+ years experience providing painless dental treatments with modern sterilization.',
                'brand_color' => '#0284C7', // Sky blue
                'active_theme' => 'modern_clean',
                'settings' => [
                    'doctor_name' => 'Dr. R. K. Verma, MDS',
                    'timings' => 'Mon-Sat: 10:00 AM - 08:00 PM',
                    'emergency_available' => true,
                ],
            ]
        );

        $clinicStore->catalogItems()->delete();
        $clinicStore->catalogItems()->createMany([
            [
                'title' => 'Comprehensive Dental Consultation & Digital X-Ray',
                'category_name' => 'General Dentistry',
                'price' => 300.00,
                'compare_at_price' => 500.00,
                'type' => 'service',
                'duration_minutes' => 30,
                'in_stock' => true,
                'image_url' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=500&auto=format&fit=crop&q=60',
                'attributes' => ['practitioner' => 'Dr. R.K. Verma', 'includes' => 'Oral Exam + 1 RVG X-Ray'],
            ],
            [
                'title' => 'Advanced Teeth Whitening & Polishing (Single Session)',
                'category_name' => 'Cosmetic Dentistry',
                'price' => 1800.00,
                'compare_at_price' => 2500.00,
                'type' => 'service',
                'duration_minutes' => 45,
                'in_stock' => true,
                'image_url' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=500&auto=format&fit=crop&q=60',
                'attributes' => ['duration' => '45 mins', 'laser_assisted' => true],
            ],
            [
                'title' => 'Painless Root Canal Treatment (RCT with Cap)',
                'category_name' => 'Endodontics',
                'price' => 3500.00,
                'compare_at_price' => 4500.00,
                'type' => 'service',
                'duration_minutes' => 60,
                'in_stock' => true,
                'image_url' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=500&auto=format&fit=crop&q=60',
                'attributes' => ['warranty' => '5 Years Cap Warranty'],
            ],
        ]);

        // 3. B2B Manufacturer: Apex Steel & Industrial Fabrications
        $b2bStore = Tenant::updateOrCreate(
            ['slug' => 'apex-steel-craft'],
            [
                'business_name' => 'Apex Steel & Industrial Fabrications',
                'archetype_id' => $b2bArchetype->id,
                'phone' => '9988776655',
                'whatsapp_number' => '9988776655',
                'city' => 'Noida',
                'address' => 'Plot B-18, Sector 63 Industrial Area, Noida',
                'tagline' => 'Precision Stainless Steel Valves, Pipes & Custom Fabrications',
                'about_text' => 'ISO 9001:2015 certified manufacturer supplying high-grade industrial parts to OEM plants across India with test certificates.',
                'brand_color' => '#D97706', // Industrial Amber
                'active_theme' => 'modern_clean',
                'settings' => [
                    'gstin' => '07AAAAA0000A1Z5',
                    'iso_certified' => true,
                    'export_ready' => true,
                ],
            ]
        );

        $b2bStore->catalogItems()->delete();
        $b2bStore->catalogItems()->createMany([
            [
                'title' => 'SS 304 High-Pressure Industrial Ball Valve (2 Inch)',
                'category_name' => 'Valves & Fittings',
                'price' => 850.00,
                'compare_at_price' => 1100.00,
                'type' => 'quote_item',
                'min_order_qty' => 20,
                'in_stock' => true,
                'image_url' => 'https://images.unsplash.com/photo-1581092335397-9583fe92d232?w=500&auto=format&fit=crop&q=60',
                'attributes' => ['grade' => 'SS 304', 'moq' => '20 Pieces', 'pressure_rating' => '1000 WOG'],
            ],
            [
                'title' => 'Industrial Hydraulic Flange Coupling (Custom CNC Turned)',
                'category_name' => 'Hydraulics',
                'price' => 1250.00,
                'compare_at_price' => 1600.00,
                'type' => 'quote_item',
                'min_order_qty' => 10,
                'in_stock' => true,
                'image_url' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=500&auto=format&fit=crop&q=60',
                'attributes' => ['moq' => '10 Units', 'spec' => 'CNC Precision Standard'],
            ],
        ]);
    }
}
