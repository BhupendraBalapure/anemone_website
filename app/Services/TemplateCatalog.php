<?php

namespace App\Services;

class TemplateCatalog
{
    /**
     * Complete list of supported business categories.
     *
     * @return array<string>
     */
    public static function categories(): array
    {
        return [
            'Beauty & Salons',
            'Clinics & Hospitals',
            'Coaching & Institutes',
            'Doctors & Specialists',
            'Herbal Care',
            'Hotels & Motels',
            'Manufacturers',
            'Other Retail',
            'Other Services',
            'Real Estate & Properties',
            'Restaurant & Cafes',
        ];
    }

    public static function getIconForTheme(string $themeId): string
    {
        return match ($themeId) {
            'salon_wellness' => 'fa-spa',
            'doctor_clinic' => 'fa-stethoscope',
            'minimal_card' => 'fa-graduation-cap',
            'wellness_sanctuary' => 'fa-leaf',
            'hotel_business' => 'fa-briefcase',
            'motel_highway' => 'fa-car',
            'hotel_boutique' => 'fa-martini-glass-citrus',
            'hotel_resort' => 'fa-hotel',
            'hotel_budget' => 'fa-bed',
            'hotel_family' => 'fa-people-roof',
            'b2b_industrial' => 'fa-industry',
            'modern_clean' => 'fa-store',
            'retail_supermarket' => 'fa-cart-shopping',
            'dark_luxury' => 'fa-gem',
            'real_estate' => 'fa-building',
            'restaurant_cafe' => 'fa-utensils',
            default => 'fa-globe',
        };
    }

    /**
     * Get the recommended template definition for a specific category and website type.
     *
     * @param  string  $websiteType  'business_website' | 'ecommerce' | 'landing_page'
     * @return array<string, mixed>
     */
    public static function getRecommended(string $category, string $websiteType = 'business_website'): array
    {
        $all = self::catalog();
        $catData = $all[$category] ?? $all['Other Retail'];

        return $catData[$websiteType] ?? $catData['business_website'];
    }

    /**
     * Get templates tailored for a category, optionally filtered by mode.
     *
     * @param  string  $filterMode  'category' | 'ecommerce' | 'landing_page' | 'all'
     * @return array<int, array<string, mixed>>
     */
    public static function getForCategory(string $category, string $filterMode = 'category'): array
    {
        $all = self::catalog();
        $catData = $all[$category] ?? $all['Other Retail'];

        if ($category === 'Hotels & Motels') {
            if (in_array($filterMode, ['category', 'business_website'])) {
                return self::getHotelWebsiteTemplates();
            }
            if ($filterMode === 'all') {
                return array_merge(self::getHotelWebsiteTemplates(), [$catData['ecommerce'], $catData['landing_page']]);
            }
        }

        if ($filterMode === 'ecommerce') {
            return [$catData['ecommerce']];
        }

        if ($filterMode === 'landing_page') {
            return [$catData['landing_page']];
        }

        if ($filterMode === 'business_website') {
            return [$catData['business_website']];
        }

        // Default 'category' or 'all': return Website, E-Commerce, and Landing Page for this category
        return [
            $catData['business_website'],
            $catData['ecommerce'],
            $catData['landing_page'],
        ];
    }

    /**
     * Get all templates across all categories for a specific mode.
     *
     * @param  string  $mode  'ecommerce' | 'landing_page' | 'business_website'
     * @return array<int, array<string, mixed>>
     */
    public static function getByMode(string $mode): array
    {
        $results = [];
        foreach (self::catalog() as $category => $types) {
            if (isset($types[$mode])) {
                $results[] = $types[$mode];
            }
        }

        return $results;
    }

    /**
     * 6 Authentic Hotel & Motel Website Templates.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getHotelWebsiteTemplates(): array
    {
        return [
            [
                'id' => 'hotel_business',
                'type' => 'business_website',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-briefcase',
                'title' => 'City Business & Executive Hotel',
                'badge' => '🏢 Business Hotel',
                'subheadline' => 'Corporate Stays • Boardrooms • Shuttle • Wi-Fi',
                'description' => 'Radisson & Lemon Tree style corporate lodging. Features in-room workstations, 150 Mbps Wi-Fi, conference boardrooms, 24/7 express check-in, and airport/station shuttle cabs.',
                'suggested_color' => '#1E3A8A',
                'features' => ['Workstation & Wi-Fi', 'Conference Boardroom', 'Airport Shuttle', 'Corporate GST'],
                'image_url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=700&auto=format&fit=crop&q=80',
                'archetype' => 'hospitality',
            ],
            [
                'id' => 'motel_highway',
                'type' => 'business_website',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-car',
                'title' => 'Highway Express Motel & 24/7 Lodge',
                'badge' => '🚗 Highway Motel',
                'subheadline' => 'Drive-In Parking • 24/7 Front Desk • Highway Dhaba Diner',
                'description' => 'National highway stopover for road travelers and transit tourists. Drive vehicle right outside clean AC rooms with 24-hr check-in, hot water, and delicious highway diner meals.',
                'suggested_color' => '#DC2626',
                'features' => ['Drive-In Parking', '24/7 Late Check-In', 'Highway Diner', 'Hot Water Geyser'],
                'image_url' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=700&auto=format&fit=crop&q=80',
                'archetype' => 'hospitality',
            ],
            [
                'id' => 'hotel_boutique',
                'type' => 'business_website',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-martini-glass-citrus',
                'title' => 'Urban Boutique Hotel & Rooftop Lounge',
                'badge' => '🏨 Urban Boutique',
                'subheadline' => 'Designer Suites • Rooftop Sunset Cafe • Balconies',
                'description' => 'Chic city center hotel with designer mood lighting, welcoming couple-friendly stays, private balcony rooms, and a scenic rooftop sunset cafe & grill.',
                'suggested_color' => '#7C3AED',
                'features' => ['Rooftop Lounge Cafe', 'Couple-Friendly Safe', 'Designer Balconies', 'City Center'],
                'image_url' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=700&auto=format&fit=crop&q=80',
                'archetype' => 'hospitality',
            ],
            [
                'id' => 'hotel_resort',
                'type' => 'business_website',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-hotel',
                'title' => 'Grand 5-Star Luxury Star Hotel & Suites',
                'badge' => '⭐ Grand 5-Star',
                'subheadline' => 'Royal Suites • Wedding Banquet Lawn • Fine Dining',
                'description' => 'Classic 5-star grand luxury hotel featuring opulent royal suites, grand marriage banquet hall and lawn, in-room multi-cuisine fine dining, valet parking, and luxury swimming pool.',
                'suggested_color' => '#E11D48',
                'features' => ['Royal Suites', 'Marriage Banquet Lawn', '24/7 Fine Dining', 'Swimming Pool'],
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=700&auto=format&fit=crop&q=80',
                'archetype' => 'hospitality',
            ],
            [
                'id' => 'hotel_budget',
                'type' => 'business_website',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-bed',
                'title' => 'Smart Budget Express Hotel & Lodge',
                'badge' => '🛏️ Smart Budget',
                'subheadline' => 'Ginger & OYO Style • Free Breakfast • Clean Linen',
                'description' => 'Transparent economy lodging for solo travelers, backpackers, and smart families. Spotless sanitized rooms, free breakfast buffet, fast Wi-Fi, and 1-tap WhatsApp booking.',
                'suggested_color' => '#0D9488',
                'features' => ['100% Sanitized', 'Free Hot Breakfast', 'Transparent Rates', 'WhatsApp Booking'],
                'image_url' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=700&auto=format&fit=crop&q=80',
                'archetype' => 'hospitality',
            ],
            [
                'id' => 'hotel_family',
                'type' => 'business_website',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-people-roof',
                'title' => 'Family Hotel & Garden Banquet Lawn',
                'badge' => '🌴 Family & Banquet',
                'subheadline' => 'Interconnected Suites • Party Lawns • Kids Zone',
                'description' => 'Ideal family staycation & event hotel. Features interconnected family suites for 4-6 guests, expansive lush party lawn for weddings and birthday receptions, pure veg family dining, and kids play area.',
                'suggested_color' => '#D97706',
                'features' => ['Interconnected Suites', '500+ Party Lawn', 'Kids Splash Pool', 'Pure Veg Dining'],
                'image_url' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=700&auto=format&fit=crop&q=80',
                'archetype' => 'hospitality',
            ],
        ];
    }

    /**
     * Master Category-Aware Templates Catalog for all 11 Business Categories.
     *
     * @return array<string, array<string, array<string, mixed>>>
     */
    public static function catalog(): array
    {
        return [
            'Beauty & Salons' => [
                'business_website' => [
                    'id' => 'salon_wellness',
                    'type' => 'business_website',
                    'category' => 'Beauty & Salons',
                    'title' => 'Luxury Unisex Salon & Spa Studio',
                    'badge' => '✂️ Luxury Salon & Spa',
                    'subheadline' => 'Hair Styling • Therapeutic Spa • Bridal Lounge',
                    'description' => 'Complete beauty salon presence with treatment duration badges (30m, 60m, 90m), certified stylist portfolio, bridal packages, and direct appointment booking.',
                    'suggested_color' => '#EC4899',
                    'features' => ['Stylist Specialist Selector', 'Treatment Duration Badges', 'Bridal HD Packages', 'Instant WhatsApp Booking'],
                    'image_url' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
                'ecommerce' => [
                    'id' => 'retail_supermarket',
                    'type' => 'ecommerce',
                    'category' => 'Beauty & Salons',
                    'title' => 'Beauty & Cosmetics Online Store',
                    'badge' => '🛍️ Beauty Online Store',
                    'subheadline' => 'Hair Serums • Organic Skincare • Nail Care • Cart',
                    'description' => 'Online beauty and cosmetics store with interactive cart drawer, product categories (Hair, Skin, Essentials), MRP discounts, and direct WhatsApp delivery checkout.',
                    'suggested_color' => '#EC4899',
                    'features' => ['Slide Cart Drawer', 'Cosmetics Catalog', 'WhatsApp Delivery Bill', 'Stock Indicators'],
                    'image_url' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'retail',
                ],
                'landing_page' => [
                    'id' => 'dark_luxury',
                    'type' => 'landing_page',
                    'category' => 'Beauty & Salons',
                    'title' => 'Bridal HD Makeover & Spa Lead Funnel',
                    'badge' => '🚀 Bridal Lead Funnel',
                    'subheadline' => 'Flat 50% Off First Visit • Limited Slots • Lead Capture',
                    'description' => 'High-converting single-page bridal makeover funnel with obsidian aesthetics, before/after makeover portfolio, client ratings, and instant WhatsApp booking lead form.',
                    'suggested_color' => '#EC4899',
                    'features' => ['50% Off Promo Hook', 'Bridal Portfolio Gallery', 'Instant WhatsApp Lead Form', 'Direct Stylist Call'],
                    'image_url' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
            ],

            'Clinics & Hospitals' => [
                'business_website' => [
                    'id' => 'doctor_clinic',
                    'type' => 'business_website',
                    'category' => 'Clinics & Hospitals',
                    'title' => 'Multi-Specialty Hospital & Diagnostics',
                    'badge' => '🏥 Hospital & OPD Clinic',
                    'subheadline' => 'NABH Accredited • Specialist MD Profiles • OPD Timings',
                    'description' => 'Medical hospital website featuring OPD schedules, specialist doctor directories, lab test diagnostic packages, and zero-wait digital appointment booking.',
                    'suggested_color' => '#0284C7',
                    'features' => ['Digital OPD Slot Booking', 'Specialist Doctor Profiles', 'Lab Diagnostic Packages', 'NABH Accreditation'],
                    'image_url' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
                'ecommerce' => [
                    'id' => 'retail_supermarket',
                    'type' => 'ecommerce',
                    'category' => 'Clinics & Hospitals',
                    'title' => 'Online Pharmacy, Meds & Health Supplies',
                    'badge' => '🛍️ Pharmacy & MedStore',
                    'subheadline' => 'Prescription Upload • Diagnostics • Supplements • Cart',
                    'description' => 'Online pharmacy and medical supplies store with prescription upload hooks, immunity boosters, home medical equipment, and WhatsApp order checkout.',
                    'suggested_color' => '#0284C7',
                    'features' => ['Prescription Upload', 'Health Supplements', 'Instant WhatsApp Checkout', 'Emergency Home Delivery'],
                    'image_url' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'retail',
                ],
                'landing_page' => [
                    'id' => 'doctor_clinic',
                    'type' => 'landing_page',
                    'category' => 'Clinics & Hospitals',
                    'title' => 'Emergency Care & Fast OPD Slot Funnel',
                    'badge' => '🚀 Urgent OPD Funnel',
                    'subheadline' => 'Zero Waiting Time • Verified MD Doctors • Instant Slot',
                    'description' => 'Laser-focused patient conversion page with doctor availability timer, patient ratings, one-click WhatsApp appointment, and emergency hotline button.',
                    'suggested_color' => '#0284C7',
                    'features' => ['Zero Waiting Promise', 'Instant Slot Booking', 'Direct Call Hotline', 'Patient Ratings'],
                    'image_url' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
            ],

            'Coaching & Institutes' => [
                'business_website' => [
                    'id' => 'minimal_card',
                    'type' => 'business_website',
                    'category' => 'Coaching & Institutes',
                    'title' => 'Premier Academy & Entrance Coaching',
                    'badge' => '🎓 Coaching Academy',
                    'subheadline' => 'NEET • JEE • UPSC • Faculty Profiles • Top Rankers',
                    'description' => 'Academic institute website highlighting classroom infrastructure, topper hall of fame, course curriculum PDFs, and admission counselling forms.',
                    'suggested_color' => '#2563EB',
                    'features' => ['Course Syllabus PDFs', 'Toppers Hall of Fame', 'Batch Timetables', 'Scholarship Registration'],
                    'image_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
                'ecommerce' => [
                    'id' => 'retail_supermarket',
                    'type' => 'ecommerce',
                    'category' => 'Coaching & Institutes',
                    'title' => 'Test Series, Books & Study Material Store',
                    'badge' => '🛍️ Study Materials Store',
                    'subheadline' => 'Mock Test Papers • Handwritten Notes • Book Bundles',
                    'description' => 'E-Commerce store for students to buy mock test series, solved question banks, and physical study materials with instant payment & WhatsApp dispatch.',
                    'suggested_color' => '#2563EB',
                    'features' => ['Test Series Packages', 'Study Material Bundles', 'Instant PDF Access', 'WhatsApp Book Order'],
                    'image_url' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'retail',
                ],
                'landing_page' => [
                    'id' => 'dark_luxury',
                    'type' => 'landing_page',
                    'category' => 'Coaching & Institutes',
                    'title' => 'Free Demo Class & Scholarship Admission Funnel',
                    'badge' => '🚀 Admission Lead Funnel',
                    'subheadline' => 'Up to 90% Scholarship Test • Limited 30 Seats • Demo Class',
                    'description' => 'High-urgency student enrollment landing page with countdown timer for upcoming batch, free demo session registration, and direct academic counselor WhatsApp chat.',
                    'suggested_color' => '#2563EB',
                    'features' => ['Scholarship Test Pass', 'Free Demo Booking', 'Counselor Direct Call', 'Limited Batch Seats'],
                    'image_url' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
            ],

            'Doctors & Specialists' => [
                'business_website' => [
                    'id' => 'doctor_clinic',
                    'type' => 'business_website',
                    'category' => 'Doctors & Specialists',
                    'title' => 'Specialist Practitioner & Consultant Clinic',
                    'badge' => '🩺 Specialist Doctor Clinic',
                    'subheadline' => 'Super-Specialty Care • Verified MD Credentials • Timings',
                    'description' => 'Doctor practice website showcasing clinical expertise (Cardiology, Ortho, Dental, Pediatrics), clinic hours, consultation fees, and appointment slot booking.',
                    'suggested_color' => '#0284C7',
                    'features' => ['Specialist MD Profile', 'Clinic OPD Hours', 'Pre-Book Consultation', 'Google Map Navigation'],
                    'image_url' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
                'ecommerce' => [
                    'id' => 'retail_supermarket',
                    'type' => 'ecommerce',
                    'category' => 'Doctors & Specialists',
                    'title' => 'Doctor-Curated Healthcare & Wellness Care',
                    'badge' => '🛍️ Doctor Curated Store',
                    'subheadline' => 'Prescribed Supplements • Care Kits • Therapeutic Products',
                    'description' => 'Online healthcare store curated by doctors for patients to purchase authentic supplements, orthopedic supports, dental hygiene kits, and wellness supplies.',
                    'suggested_color' => '#0284C7',
                    'features' => ['Doctor Curated Items', 'Direct Patient Cart', 'WhatsApp Order', 'Safe Home Delivery'],
                    'image_url' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'retail',
                ],
                'landing_page' => [
                    'id' => 'doctor_clinic',
                    'type' => 'landing_page',
                    'category' => 'Doctors & Specialists',
                    'title' => 'Direct Doctor Consultation & Second Opinion Funnel',
                    'badge' => '🚀 Doctor Lead Funnel',
                    'subheadline' => '15-Min Quick Consultation • WhatsApp OPD Slip • Direct Call',
                    'description' => 'High-trust single-page doctor funnel with verified credentials, patient recovery stories, instant appointment booking form, and emergency WhatsApp hotline.',
                    'suggested_color' => '#0284C7',
                    'features' => ['Instant Slot Picker', 'Verified MD Badge', 'Direct Phone Tap', 'Zero Wait Guarantee'],
                    'image_url' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
            ],

            'Herbal Care' => [
                'business_website' => [
                    'id' => 'wellness_sanctuary',
                    'type' => 'business_website',
                    'category' => 'Herbal Care',
                    'title' => 'Ayurvedic & Panchakarma Wellness Sanctuary',
                    'badge' => '🌿 Ayurvedic Sanctuary',
                    'subheadline' => 'Authentic Vaidya Therapies • Organic Herbs • Natural Detox',
                    'description' => 'Serene natural wellness website featuring Panchakarma detoxification treatments, Nadi Pariksha consultations, organic garden herbs, and appointment scheduling.',
                    'suggested_color' => '#059669',
                    'features' => ['Panchakarma Therapies', 'Nadi Pariksha Consult', 'Organic Herb Sourcing', 'WhatsApp Appointment'],
                    'image_url' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
                'ecommerce' => [
                    'id' => 'retail_supermarket',
                    'type' => 'ecommerce',
                    'category' => 'Herbal Care',
                    'title' => 'Organic Herbal Oils, Teas & Supplements Store',
                    'badge' => '🛍️ Herbal E-Commerce Store',
                    'subheadline' => 'Cold-Pressed Oils • Herbal Powders • Immunity Boosters • Cart',
                    'description' => 'Ayurvedic e-commerce store with rich herbal product catalog, ingredients purity badges, customer reviews, shopping cart drawer, and WhatsApp checkout.',
                    'suggested_color' => '#059669',
                    'features' => ['100% Pure Organic Badges', 'Slide Cart Drawer', 'Wholesale Discounts', 'WhatsApp Delivery Bill'],
                    'image_url' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'retail',
                ],
                'landing_page' => [
                    'id' => 'dark_luxury',
                    'type' => 'landing_page',
                    'category' => 'Herbal Care',
                    'title' => 'Herbal Hair Fall & Wellness Transformation Funnel',
                    'badge' => '🚀 Herbal Product Funnel',
                    'subheadline' => '100% Natural Ayurvedic Formula • 90-Day Regrowth Results',
                    'description' => 'High-converting herbal product funnel featuring clinical before/after results, money-back guarantee, customer video reviews, and 1-tap WhatsApp order button.',
                    'suggested_color' => '#059669',
                    'features' => ['90-Day Results Proof', 'Flat 40% Off Offer', 'Direct WhatsApp Order', 'Free Vaidya Consult'],
                    'image_url' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'retail',
                ],
            ],

            'Hotels & Motels' => [
                'business_website' => [
                    'id' => 'hotel_resort',
                    'type' => 'business_website',
                    'category' => 'Hotels & Motels',
                    'title' => 'Grand 5-Star Luxury Star Hotel & Suites',
                    'badge' => '⭐ Grand 5-Star Luxury',
                    'subheadline' => 'Royal Suites • Banquet Lawn • 24/7 Room Service',
                    'description' => 'Opulent hospitality website with deluxe room categories, tariff per night, wedding banquet lawns, and direct WhatsApp room booking.',
                    'suggested_color' => '#E11D48',
                    'features' => ['Deluxe & Royal Suites', 'Banquet & Wedding Lawn', '24/7 Room Dining', 'Direct WhatsApp Booking'],
                    'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'hospitality',
                ],
                'ecommerce' => [
                    'id' => 'hotel_budget',
                    'type' => 'ecommerce',
                    'category' => 'Hotels & Motels',
                    'title' => 'Stay Vouchers, Dining Passes & Gift Store',
                    'badge' => '🛍️ Stay Packages & Vouchers',
                    'subheadline' => 'Weekend Getaway Passes • Buffet Vouchers • Room Night Gifting',
                    'description' => 'Online hospitality store allowing guests to purchase prepaid room stay vouchers, discounted holiday packages, and dining passes directly with instant cart.',
                    'suggested_color' => '#E11D48',
                    'features' => ['Prepaid Stay Vouchers', 'Buffet Pass Packages', 'WhatsApp Voucher SMS', 'Zero Commission'],
                    'image_url' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'hospitality',
                ],
                'landing_page' => [
                    'id' => 'hotel_resort',
                    'type' => 'landing_page',
                    'category' => 'Hotels & Motels',
                    'title' => 'Weekend Holiday & Monsoon Discount Stay Funnel',
                    'badge' => '🚀 Hotel Booking Funnel',
                    'subheadline' => 'Flat 40% Off Deluxe Rooms • Free Breakfast • Instant Room Hold',
                    'description' => 'High-converting holiday booking landing page with room video previews, discount countdown timer, guest amenity badges, and direct WhatsApp room hold.',
                    'suggested_color' => '#E11D48',
                    'features' => ['40% Off Promo Hook', 'Deluxe Room Preview', 'Free Breakfast Included', 'WhatsApp Room Hold'],
                    'image_url' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'hospitality',
                ],
            ],

            'Manufacturers' => [
                'business_website' => [
                    'id' => 'b2b_industrial',
                    'type' => 'business_website',
                    'category' => 'Manufacturers',
                    'title' => 'Industrial Manufacturing & CNC Engineering Plant',
                    'badge' => '🏭 Manufacturing Plant',
                    'subheadline' => 'ISO 9001:2015 Plant • Heavy Machinery • Precision Engineering',
                    'description' => 'Engineered for factories, fabricators, and OEMs. Displays manufacturing equipment, production capacity, ISO compliance, technical specs, and plant tour.',
                    'suggested_color' => '#4F46E5',
                    'features' => ['ISO 9001 Certification', 'Plant & Machinery Specs', 'Download Catalog PDF', 'Pan-India Freight'],
                    'image_url' => 'https://images.unsplash.com/photo-1581092335397-9583fe92d232?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'b2b',
                ],
                'ecommerce' => [
                    'id' => 'b2b_industrial',
                    'type' => 'ecommerce',
                    'category' => 'Manufacturers',
                    'title' => 'B2B Wholesale Parts, Spares & MOQ Store',
                    'badge' => '🛍️ Wholesale Spares Store',
                    'subheadline' => 'Tiered Volume Pricing • Minimum Order Qty • Industrial Spares',
                    'description' => 'Wholesale industrial e-commerce catalog featuring Minimum Order Quantity (MOQ) controls, volume price slabs, technical data sheets, and wholesale cart checkout.',
                    'suggested_color' => '#4F46E5',
                    'features' => ['MOQ Quantity Sliders', 'Volume Tier Discounts', 'Technical Spec Sheets', 'Wholesale Cart'],
                    'image_url' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'b2b',
                ],
                'landing_page' => [
                    'id' => 'b2b_industrial',
                    'type' => 'landing_page',
                    'category' => 'Manufacturers',
                    'title' => 'Custom OEM Manufacturing & RFQ Quotation Funnel',
                    'badge' => '🚀 B2B RFQ Lead Funnel',
                    'subheadline' => 'Instant Blueprint/CAD Upload • Factory Direct Quote in 24 Hrs',
                    'description' => 'Dedicated B2B conversion page engineered to capture high-value RFQ leads. Features CAD file upload hook, material specification matrix, and instant WhatsApp RFQ.',
                    'suggested_color' => '#4F46E5',
                    'features' => ['Instant RFQ Form', 'CAD/Drawing Hook', 'Direct Factory Price', 'Confidentiality NDA'],
                    'image_url' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'b2b',
                ],
            ],

            'Other Retail' => [
                'business_website' => [
                    'id' => 'modern_clean',
                    'type' => 'business_website',
                    'category' => 'Other Retail',
                    'title' => 'Modern Retail Storefront & Brand Presence',
                    'badge' => '🏬 Modern Retail Store',
                    'subheadline' => 'Store Tour • Top Brands • Store Timings • Customer Trust',
                    'description' => 'Clean, professional retail storefront website showcasing product departments, brand story, physical store location, timings, and local customer ratings.',
                    'suggested_color' => '#9333EA',
                    'features' => ['Store Tour & Timings', 'Department Categories', 'Customer Testimonials', 'Google Map Directions'],
                    'image_url' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'retail',
                ],
                'ecommerce' => [
                    'id' => 'retail_supermarket',
                    'type' => 'ecommerce',
                    'category' => 'Other Retail',
                    'title' => 'Supermarket, Kirana & Daily Essentials Store',
                    'badge' => '🛍️ Supermarket & Kirana',
                    'subheadline' => 'Farm Fresh • Daily Groceries • Slide Cart • WhatsApp Checkout',
                    'description' => 'High-performance online grocery and retail store with instant product search, quantity adjustments, MRP savings calculation, and WhatsApp delivery bill.',
                    'suggested_color' => '#9333EA',
                    'features' => ['Slide Cart Drawer', 'Instant Stock Indicators', 'MRP Discount Badges', 'WhatsApp Delivery Bill'],
                    'image_url' => 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'retail',
                ],
                'landing_page' => [
                    'id' => 'dark_luxury',
                    'type' => 'landing_page',
                    'category' => 'Other Retail',
                    'title' => 'Mega Festive Sale & 24-Hr Flash Discount Funnel',
                    'badge' => '🚀 Flash Sale Lead Funnel',
                    'subheadline' => 'Flat 50% Off • Clearance Deals • 1-Click WhatsApp Order',
                    'description' => 'High-energy flash sale landing page with live countdown clock, doorbuster discount cards, stock countdown counter, and instant WhatsApp ordering.',
                    'suggested_color' => '#9333EA',
                    'features' => ['Live Countdown Timer', 'Flat 50% Off Deals', 'Limited Stock Alert', 'WhatsApp Flash Order'],
                    'image_url' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'retail',
                ],
            ],

            'Other Services' => [
                'business_website' => [
                    'id' => 'minimal_card',
                    'type' => 'business_website',
                    'category' => 'Other Services',
                    'title' => 'Corporate Consulting & Professional Services',
                    'badge' => '💼 Professional Services',
                    'subheadline' => 'Business Advisory • Legal • Financial • Case Studies',
                    'description' => 'Sophisticated editorial website for consulting agencies, chartered accountants, legal firms, and corporate consultants with client portfolio and booking.',
                    'suggested_color' => '#18181B',
                    'features' => ['Client Case Studies', 'Scope of Engagement', 'Direct Strategy Consult', 'Verified Credentials'],
                    'image_url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
                'ecommerce' => [
                    'id' => 'retail_supermarket',
                    'type' => 'ecommerce',
                    'category' => 'Other Services',
                    'title' => 'Service Packages & Monthly Retainer Store',
                    'badge' => '🛍️ Service Packages Store',
                    'subheadline' => 'Fixed-Scope Plans • Monthly Maintenance • Instant Checkout',
                    'description' => 'Sell fixed-scope service packages, AMC maintenance contracts, and digital retainers online with structured deliverables and instant billing checkout.',
                    'suggested_color' => '#18181B',
                    'features' => ['Tiered Package Pricing', 'Scope Checklist', 'Instant Payment Checkout', 'WhatsApp Onboarding'],
                    'image_url' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'retail',
                ],
                'landing_page' => [
                    'id' => 'dark_luxury',
                    'type' => 'landing_page',
                    'category' => 'Other Services',
                    'title' => 'High-Ticket Client Acquisition Lead Funnel',
                    'badge' => '🚀 Client Acquisition Funnel',
                    'subheadline' => 'Book 1-on-1 Growth Consultation • Proven ROI Framework',
                    'description' => 'Executive conversion funnel designed to attract high-ticket B2B clients with client video testimonials, case study metrics, and calendar booking hook.',
                    'suggested_color' => '#7C3AED',
                    'features' => ['High-Ticket Pitch', 'Client Video Testimonials', 'Calendar Booking Hook', 'WhatsApp Lead Inquiries'],
                    'image_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
            ],

            'Real Estate & Properties' => [
                'business_website' => [
                    'id' => 'real_estate',
                    'type' => 'business_website',
                    'category' => 'Real Estate & Properties',
                    'title' => 'Luxury Township & Commercial Developers',
                    'badge' => '🏢 Real Estate Township',
                    'subheadline' => '2 & 3 BHK Homes • RERA Approved • 3D Virtual Walkthrough',
                    'description' => 'Premier real estate developer website showcasing master township layouts, carpet area specifications, RERA bank approvals, and free site visit booking.',
                    'suggested_color' => '#0D9488',
                    'features' => ['RERA Verification Badge', '3D Virtual Walkthrough', 'Download Floor Plans', 'Free Site Visit Cab'],
                    'image_url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
                'ecommerce' => [
                    'id' => 'real_estate',
                    'type' => 'ecommerce',
                    'category' => 'Real Estate & Properties',
                    'title' => 'Token Advance & Unit Reservation Store',
                    'badge' => '🛍️ Property Token Booking',
                    'subheadline' => 'Online Token Booking • Lock Launch Pricing • Unit Selection',
                    'description' => 'Digital real estate booking storefront allowing buyers to reserve residential flats or commercial retail shops online with instant token advance.',
                    'suggested_color' => '#0D9488',
                    'features' => ['Token Advance Amount', 'Unit Floor Selection', 'Instant Receipt PDF', 'WhatsApp Relationship Manager'],
                    'image_url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
                'landing_page' => [
                    'id' => 'real_estate',
                    'type' => 'landing_page',
                    'category' => 'Real Estate & Properties',
                    'title' => 'Pre-Launch Flat Booking & Free Cab Site Visit Funnel',
                    'badge' => '🚀 Pre-Launch Lead Funnel',
                    'subheadline' => 'Save Up to ₹10 Lakhs on Pre-Launch • Free Pick & Drop Cab',
                    'description' => 'High-converting property launch funnel with floor plan brochure download gate, pre-launch pricing countdown, and free doorstep site visit cab booking form.',
                    'suggested_color' => '#0D9488',
                    'features' => ['Pre-Launch Price Hook', 'Free Site Visit Cab', 'Instant Brochure Download', 'WhatsApp Unit Hold'],
                    'image_url' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'service',
                ],
            ],

            'Restaurant & Cafes' => [
                'business_website' => [
                    'id' => 'restaurant_cafe',
                    'type' => 'business_website',
                    'category' => 'Restaurant & Cafes',
                    'title' => 'Gourmet Dine-In & Fine Dining Restaurant',
                    'badge' => '🍽️ Gourmet Restaurant & Bar',
                    'subheadline' => 'Artisanal Recipes • Chef Specials • Table Reservation • QR Menu',
                    'description' => 'Gastronomic dining website with ambient photo gallery, chef signature dishes, contactless QR menu, and table reservation booking system.',
                    'suggested_color' => '#F43F5E',
                    'features' => ['Digital QR Menu', 'Veg / Non-Veg Dots', 'Table Reservation Form', 'Chef Signature Dishes'],
                    'image_url' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'food',
                ],
                'ecommerce' => [
                    'id' => 'restaurant_cafe',
                    'type' => 'ecommerce',
                    'category' => 'Restaurant & Cafes',
                    'title' => 'Online Food Delivery & Cloud Kitchen Store',
                    'badge' => '🛍️ Food Delivery & Kitchen',
                    'subheadline' => 'Fresh Hot Food • Cart Slide-Over • WhatsApp Kitchen Dispatch',
                    'description' => 'Fast online food ordering experience with Veg/Non-Veg filters, dish customize options, live cart slide-over, and instant WhatsApp kitchen dispatch.',
                    'suggested_color' => '#F43F5E',
                    'features' => ['Interactive Food Cart', 'Veg & Non-Veg Filters', 'MRP Discounts', 'WhatsApp Kitchen Order'],
                    'image_url' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'food',
                ],
                'landing_page' => [
                    'id' => 'restaurant_cafe',
                    'type' => 'landing_page',
                    'category' => 'Restaurant & Cafes',
                    'title' => 'Weekend Grand Buffet & Party Hall Booking Funnel',
                    'badge' => '🚀 Buffet Deal Lead Funnel',
                    'subheadline' => 'Unlimited 40-Dish Buffet at ₹499 • Birthday & Party Discounts',
                    'description' => 'High-converting dining deal funnel with unlimited buffet discount passes, banquet party hall inquiries, photo menu preview, and direct WhatsApp booking.',
                    'suggested_color' => '#F43F5E',
                    'features' => ['₹499 Buffet Pass Hook', 'Party Hall Packages', 'Direct WhatsApp Hold', 'Live Seating Counter'],
                    'image_url' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=700&auto=format&fit=crop&q=80',
                    'archetype' => 'food',
                ],
            ],
        ];
    }
}
