<?php

namespace Database\Seeders;

use App\Models\Archetype;
use Illuminate\Database\Seeder;

class ArchetypeSeeder extends Seeder
{
    public function run(): void
    {
        $archetypes = [
            [
                'name' => 'Retail & E-Commerce (Kirana / Fashion / Electronics)',
                'code' => 'retail',
                'icon' => 'shopping-bag',
                'description' => 'For physical retail shops selling products with cart, variants, and delivery.',
                'enabled_features' => ['cart', 'whatsapp_checkout', 'variants', 'stock_tracking', 'pincode_check'],
                'default_cta' => 'whatsapp_cart',
                'cta_label' => 'Order on WhatsApp',
                'schema_type' => 'Store',
            ],
            [
                'name' => 'Healthcare & Clinics (Doctors / Dentists / Diagnostics)',
                'code' => 'service',
                'icon' => 'calendar-check',
                'description' => 'For clinics, doctors, and consultants requiring appointment booking slots.',
                'enabled_features' => ['slot_booking', 'practitioner_profile', 'service_duration', 'consultation_fee'],
                'default_cta' => 'book_slot',
                'cta_label' => 'Book Appointment',
                'schema_type' => 'MedicalBusiness',
            ],
            [
                'name' => 'Food & Dining (Restaurants / Cafes / Bakeries)',
                'code' => 'food',
                'icon' => 'utensils',
                'description' => 'For eateries offering digital menus, veg/non-veg tags, and takeaway/dine-in orders.',
                'enabled_features' => ['digital_menu', 'veg_nonveg_toggle', 'dinein_takeaway', 'fast_whatsapp_order'],
                'default_cta' => 'whatsapp_cart',
                'cta_label' => 'Quick Order',
                'schema_type' => 'Restaurant',
            ],
            [
                'name' => 'B2B & Manufacturing (Factories / Wholesalers)',
                'code' => 'b2b',
                'icon' => 'building',
                'description' => 'For manufacturers and bulk distributors requiring quote requests and MOQ.',
                'enabled_features' => ['request_quote', 'moq_checker', 'tiered_pricing', 'catalog_download'],
                'default_cta' => 'request_quote',
                'cta_label' => 'Request a Quote',
                'schema_type' => 'LocalBusiness',
            ],
        ];

        foreach ($archetypes as $data) {
            Archetype::updateOrCreate(['code' => $data['code']], $data);
        }
    }
}
