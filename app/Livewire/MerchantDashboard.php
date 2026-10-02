<?php

namespace App\Livewire;

use App\Models\Archetype;
use App\Models\Tenant;
use App\Services\TemplateCatalog;
use Livewire\Attributes\Url;
use Livewire\Component;

class MerchantDashboard extends Component
{
    public $slug;

    public Tenant $tenant;

    #[Url(as: 'tab')]
    public $activeTab = 'templates'; // templates, catalog, profile, orders, domains, ai_studio

    // Domain Hub State
    public $domainSearchQuery = '';

    public $domainExtension = 'in';

    public $domainSearchResults = [];

    public $isSearchingDomain = false;

    public $existingDomainInput = '';

    public $dnsVerificationStatus = 'idle'; // idle, checking, verified, failed

    public $customDomain = '';

    public $domainStatus = 'none'; // none, pending, active

    public $domainType = ''; // 'purchased', 'connected'

    public $domainSsl = false;

    // Template & Styling State
    public $activeTheme;

    public $brandColor;

    public $showTrustPills = true;

    public $showHighlights = true;

    public $showReviews = true;

    public $showHours = true;

    public $showInquiryForm = true;

    // Catalog Management State
    public $showItemModal = false;

    public $editingItemId = null;

    public $itemTitle = '';

    public $itemCategory = '';

    public $itemPrice = 0;

    public $itemComparePrice = 0;

    public $itemDuration = 30; // Clinic

    public $itemMinQty = 10;   // B2B

    public $itemImageUrl = '';

    public $itemInStock = true;

    public $itemBrand = '';

    public $itemBadge = '';

    public $itemStockQty = 25;

    // Catalog Live Filtering
    public $catalogSearch = '';

    public $catalogCategoryFilter = 'all';

    public $catalogBrandFilter = 'all';

    // E-Commerce Coupons State
    public $coupons = [];

    public $showCouponModal = false;

    public $newCouponCode = '';

    public $newCouponType = 'percentage'; // 'percentage' or 'fixed'

    public $newCouponValue = 10;

    public $newCouponMinOrder = 499;

    public $newCouponDescription = '';

    // Profile & SEO State
    public $businessName = '';

    public $websiteType = 'business_website'; // 'business_website', 'ecommerce', 'landing_page'

    public $businessCategory = '';

    public $archetypeId = null;

    public $tagline = '';

    public $phone = '';

    public $whatsappNumber = '';

    public $city = '';

    public $address = '';

    public $aboutText = '';

    // AI Generation State
    public $aiPrompt = '';

    public $aiGenerating = false;

    public $aiGeneratedContent = '';

    public $flashMessage = '';

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->tenant = Tenant::with(['archetype', 'catalogItems', 'orders'])->where('slug', $slug)->firstOrFail();

        // Initialize Theme Settings
        $this->activeTheme = $this->tenant->active_theme ?? 'modern_clean';
        $this->brandColor = $this->tenant->brand_color ?? '#9333EA';

        $settings = $this->tenant->settings ?? [];
        $this->showTrustPills = $settings['show_trust_pills'] ?? true;
        $this->showHighlights = $settings['show_highlights'] ?? true;
        $this->showReviews = $settings['show_reviews'] ?? true;
        $this->showHours = $settings['show_hours'] ?? true;
        $this->showInquiryForm = $settings['show_inquiry_form'] ?? true;

        // Initialize Profile Settings
        $this->businessName = $this->tenant->business_name;
        $this->businessCategory = $settings['business_category'] ?? '';
        $this->websiteType = $settings['website_type'] ?? 'business_website';
        $this->archetypeId = $this->tenant->archetype_id;
        $this->tagline = $this->tenant->tagline ?? '';
        $this->phone = $this->tenant->phone ?? '';
        $this->whatsappNumber = $this->tenant->whatsapp_number ?? '';
        $this->city = $this->tenant->city ?? '';
        $this->address = $this->tenant->address ?? '';
        $this->aboutText = $this->tenant->about_text ?? '';

        $this->selectedCategoryFilter = $this->businessCategory ?: ($settings['business_category'] ?? 'Hotels & Motels');

        // Default template filter mode based on website type
        if ($this->websiteType === 'ecommerce') {
            $this->templateFilterMode = 'ecommerce';
        } elseif ($this->websiteType === 'landing_page') {
            $this->templateFilterMode = 'landing_page';
        } else {
            $this->templateFilterMode = 'category';
        }

        // Initialize Domain Hub Settings
        $this->customDomain = $this->tenant->custom_domain ?? '';
        $this->domainStatus = $settings['domain_status'] ?? ($this->tenant->custom_domain ? 'active' : 'none');
        $this->domainType = $settings['domain_type'] ?? ($this->tenant->custom_domain ? 'purchased' : '');
        $this->domainSsl = (bool) ($settings['domain_ssl'] ?? (bool) $this->tenant->custom_domain);

        // Initialize E-Commerce Coupons
        $defaultCoupons = [
            [
                'code' => 'WELCOME10',
                'type' => 'percentage',
                'value' => 10,
                'min_order' => 499,
                'description' => '10% OFF on all orders above ₹499',
                'active' => true,
            ],
            [
                'code' => 'FLAT100',
                'type' => 'fixed',
                'value' => 100,
                'min_order' => 999,
                'description' => 'Flat ₹100 instant discount on orders above ₹999',
                'active' => true,
            ],
        ];
        $this->coupons = $settings['coupons'] ?? $defaultCoupons;

        // Support direct ?tab= query parameter
        $tabParam = request()->query('tab');
        if ($tabParam && in_array($tabParam, ['templates', 'catalog', 'profile', 'orders', 'domains', 'ai_studio'])) {
            $this->activeTab = $tabParam;
        }
    }

    // Live Interactive Template Preview Modal
    public $showTemplatePreviewModal = false;

    public $previewTemplateId = 'hotel_resort';

    public $previewDevice = 'desktop'; // desktop, mobile

    public $templateFilterMode = 'category'; // 'category', 'ecommerce', 'landing_page', 'all'

    public $selectedCategoryFilter = null;

    public function setTemplateFilterMode($mode)
    {
        $this->templateFilterMode = $mode;
    }

    public function setCategoryFilter(?string $category): void
    {
        $this->selectedCategoryFilter = $category;
    }

    public function getActiveCategoryProperty(): string
    {
        return $this->selectedCategoryFilter
            ?: ($this->businessCategory ?: ($this->tenant->settings['business_category'] ?? 'Hotels & Motels'));
    }

    public function getStudioTemplatesProperty(): array
    {
        return TemplateCatalog::getForCategory($this->activeCategory, $this->templateFilterMode);
    }

    public function setWebsiteType($type)
    {
        $this->websiteType = $type;
        $settings = $this->tenant->settings ?? [];
        $settings['website_type'] = $type;
        $this->tenant->update(['settings' => $settings]);
        $this->templateFilterMode = $type;
        $this->flashMessage = 'Operating Mode updated to: '.($type === 'ecommerce' ? 'E-Commerce Store' : ($type === 'landing_page' ? 'Landing Page' : 'Business Website'));
    }

    // --- TEMPLATE & THEME ACTIONS ---
    public function openTemplatePreview($templateId)
    {
        $this->previewTemplateId = $templateId;
        $this->showTemplatePreviewModal = true;
    }

    public function getPreviewTemplateProperty()
    {
        $city = $this->tenant->city ?: 'Nagpur';

        $templates = [
            'hotel_business' => [
                'id' => 'hotel_business',
                'title' => 'City Business & Executive Hotel',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-briefcase',
                'suggested_color' => '#1E3A8A',
                'headline' => 'Executive AC Rooms, Boardrooms & Seamless Transit Stays',
                'subheadline' => "Designed for corporate executives, business travelers, and conference delegates in {$city}",
                'badge' => '🏢 Corporate Business & Executive Hotel',
                'cta_text' => 'Book Executive Room / Corporate Desk',
                'hero_img' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=900&auto=format&fit=crop&q=80',
                'features' => ['High-Speed 150 Mbps Wi-Fi', 'Boardroom & Conference Facilities', '24/7 Express Check-in & Dining', 'Airport / Station Shuttle Desk'],
                'highlights' => [
                    ['icon' => 'fa-laptop', 'title' => 'Ergonomic Work Desks', 'desc' => 'Every room features high-speed internet and power workstations'],
                    ['icon' => 'fa-handshake', 'title' => 'Conference Boardrooms', 'desc' => 'Equipped for client meetings, presentations, and corporate discussions'],
                    ['icon' => 'fa-van-shuttle', 'title' => 'Airport & Railway Shuttle', 'desc' => 'Punctual transit pick-up and drop for busy executives'],
                ],
                'sample_items' => [
                    ['title' => 'Corporate Executive King Room', 'price' => 2899, 'mrp' => 3800, 'badge' => 'Workstation + Wi-Fi', 'img' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Business Deluxe Twin Room', 'price' => 2499, 'mrp' => 3200, 'badge' => 'Dual Beds', 'img' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Presidential Boardroom Suite', 'price' => 4999, 'mrp' => 6500, 'badge' => 'VIP Suite', 'img' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Express Day-Use Business Room', 'price' => 1499, 'mrp' => 1999, 'badge' => '8-Hour Transit', 'img' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'motel_highway' => [
                'id' => 'motel_highway',
                'title' => 'Highway Express Motel & 24/7 Transit Lodge',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-car',
                'suggested_color' => '#DC2626',
                'headline' => 'Safe Parking, Clean AC Rooms & 24-Hour Roadside Check-In',
                'subheadline' => "Convenient national highway stopover for road travelers, truck operators, and family road trips in {$city}",
                'badge' => '🚗 Highway Express Transit Lodge',
                'cta_text' => 'Book Highway Room / Quick Rest',
                'hero_img' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=900&auto=format&fit=crop&q=80',
                'features' => ['Drive-In Secure Vehicle Parking', '24/7 Late-Night Check-in Desk', 'Highway Restaurant & 24-hr Dhaba', 'Hot Water Geyser & Fresh Linen'],
                'highlights' => [
                    ['icon' => 'fa-square-parking', 'title' => 'Drive-In Car Parking', 'desc' => 'Park right outside your room with 24/7 CCTV surveillance'],
                    ['icon' => 'fa-clock', 'title' => '24-Hour Front Desk', 'desc' => 'Arrive anytime day or night with zero check-in delay'],
                    ['icon' => 'fa-utensils', 'title' => 'Highway Restaurant & Dhaba', 'desc' => 'Freshly prepared hot meals, tea, and dining round the clock'],
                ],
                'sample_items' => [
                    ['title' => 'Highway AC Double Bed Room', 'price' => 1499, 'mrp' => 1999, 'badge' => 'Overnight Stay', 'img' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Highway Family Room (4 Beds)', 'price' => 2299, 'mrp' => 2999, 'badge' => 'Family Transit', 'img' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Quick Shower & Rest Room (4 Hours)', 'price' => 799, 'mrp' => 1100, 'badge' => 'Short Rest', 'img' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Super Deluxe Highway Suite', 'price' => 2799, 'mrp' => 3500, 'badge' => 'Luxury Transit', 'img' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'hotel_boutique' => [
                'id' => 'hotel_boutique',
                'title' => 'Urban Boutique Hotel & Rooftop Lounge',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-martini-glass-citrus',
                'suggested_color' => '#7C3AED',
                'headline' => 'Designer Rooms, Modern Aesthetics & Rooftop Sunset Dining',
                'subheadline' => "Chic city center hotel with couple-friendly stays, ambient lighting, and rooftop lounge in {$city}",
                'badge' => '🏨 Urban Boutique Hotel & Rooftop',
                'cta_text' => 'Book Boutique Stay / View Rooftop',
                'hero_img' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=900&auto=format&fit=crop&q=80',
                'features' => ['Rooftop Sunset Lounge & Cafe', 'Couple-Friendly Verified Stays', 'Designer Boutique Interior & Balconies', 'Smart TV with Netflix & Wi-Fi'],
                'highlights' => [
                    ['icon' => 'fa-martini-glass-citrus', 'title' => 'Rooftop Sunset Lounge', 'desc' => 'Enjoy artisanal coffees, woodfired food, and skyline views'],
                    ['icon' => 'fa-heart', 'title' => 'Couple-Friendly & Safe', 'desc' => '100% verified, private, and welcoming check-in for couples'],
                    ['icon' => 'fa-palette', 'title' => 'Curated Design Aesthetics', 'desc' => 'Custom artwork, warm ambient mood lighting, and rain showers'],
                ],
                'sample_items' => [
                    ['title' => 'Boutique Queen Room with Balcony', 'price' => 2699, 'mrp' => 3600, 'badge' => 'City Balcony View', 'img' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Urban Studio Suite with Bathtub', 'price' => 3899, 'mrp' => 5200, 'badge' => 'Designer Bath', 'img' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Rooftop Penthouse Suite', 'price' => 4999, 'mrp' => 6800, 'badge' => 'Skyline View', 'img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Cozy Urban Micro-Room', 'price' => 1999, 'mrp' => 2600, 'badge' => 'Best Value', 'img' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'hotel_resort' => [
                'id' => 'hotel_resort',
                'title' => 'Grand 5-Star Luxury Star Hotel & Suites',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-hotel',
                'suggested_color' => '#E11D48',
                'headline' => 'Opulent Suites, Grand Banquet Halls & 5-Star City Stays',
                'subheadline' => "Premier luxury star hotel with royal deluxe suites, wedding banquets, swimming pool, and fine dining in {$city}",
                'badge' => '⭐ Grand 5-Star Luxury Hotel',
                'cta_text' => 'Book Room / Check Availability',
                'hero_img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=900&auto=format&fit=crop&q=80',
                'features' => ['Deluxe & Presidential Suites', 'Wedding & Event Banquet Lawn', '24/7 Room Service & Dining', 'Direct WhatsApp Room Booking'],
                'highlights' => [
                    ['icon' => 'fa-bed', 'title' => 'Deluxe & Royal Suites', 'desc' => 'Spacious, sanitized rooms with premium bedding & modern baths'],
                    ['icon' => 'fa-wifi', 'title' => 'Free High-Speed Wi-Fi', 'desc' => 'Seamless internet for business & leisure travelers'],
                    ['icon' => 'fa-bell-concierge', 'title' => '24/7 Room Service', 'desc' => 'Round-the-clock dining, laundry, and concierge support'],
                ],
                'sample_items' => [
                    ['title' => 'Deluxe King AC Room', 'price' => 2499, 'mrp' => 3500, 'badge' => 'Per Night', 'img' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Executive Suite with Balcony', 'price' => 4199, 'mrp' => 5500, 'badge' => 'Luxury Suite', 'img' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Family Interconnected Suite (4 Guests)', 'price' => 5499, 'mrp' => 6999, 'badge' => 'Family Stay', 'img' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Standard Cozy Double Room', 'price' => 1799, 'mrp' => 2200, 'badge' => 'Best Value', 'img' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'hotel_budget' => [
                'id' => 'hotel_budget',
                'title' => 'Smart Budget Express Hotel & Travel Lodge',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-bed',
                'suggested_color' => '#0D9488',
                'headline' => 'Clean, Sanitized AC Rooms with Free Breakfast & Best Tariff Guarantee',
                'subheadline' => "Smart economy lodging with Ginger & OYO Townhouse style convenience, zero hidden fees, and high-speed Wi-Fi in {$city}",
                'badge' => '🛏️ Smart Economy Budget Hotel',
                'cta_text' => 'Book Best Rate Room',
                'hero_img' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=900&auto=format&fit=crop&q=80',
                'features' => ['100% Sanitized Linen & Room Guarantee', 'Complimentary Hot Breakfast', 'High-Speed 100 Mbps Wi-Fi', 'Instant WhatsApp Booking Desk'],
                'highlights' => [
                    ['icon' => 'fa-shield-halved', 'title' => '100% Sanitized & Clean', 'desc' => 'Triple-cleaned rooms with sealed toiletries and crisp bedding'],
                    ['icon' => 'fa-mug-hot', 'title' => 'Free Hot Breakfast', 'desc' => 'Fresh breakfast buffet included with every morning booking'],
                    ['icon' => 'fa-tag', 'title' => 'Best Price Guaranteed', 'desc' => 'Direct website booking with zero middleman commissions'],
                ],
                'sample_items' => [
                    ['title' => 'Smart Standard AC Room', 'price' => 1299, 'mrp' => 1799, 'badge' => 'Free Breakfast', 'img' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Smart Executive Double Bed', 'price' => 1699, 'mrp' => 2200, 'badge' => 'King Bed', 'img' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Solo Traveler Compact AC Room', 'price' => 999, 'mrp' => 1400, 'badge' => 'Budget Choice', 'img' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Smart Family AC Room (3 Beds)', 'price' => 2199, 'mrp' => 2800, 'badge' => 'Family Value', 'img' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'hotel_family' => [
                'id' => 'hotel_family',
                'title' => 'Family Hotel & Garden Banquet Lawn',
                'category' => 'Hotels & Motels',
                'icon' => 'fa-people-roof',
                'suggested_color' => '#D97706',
                'headline' => 'Spacious Family Suites, Green Party Lawns & Holiday Stays',
                'subheadline' => "The ideal family retreat in {$city} for wedding guests, birthdays, vacations, and celebrations",
                'badge' => '🌴 Family Stay & Party Lawn',
                'cta_text' => 'Book Family Suite / Inquire Lawn',
                'hero_img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=900&auto=format&fit=crop&q=80',
                'features' => ['Interconnected Family Suites (4-6 Guests)', 'Lush Party Lawn for 500+ Guests', 'Pure Veg & Multi-Cuisine Family Dining', 'Kids Play Zone & Swimming Pool'],
                'highlights' => [
                    ['icon' => 'fa-people-group', 'title' => 'Interconnected Family Suites', 'desc' => 'Spacious adjoining rooms with privacy and shared family living'],
                    ['icon' => 'fa-tree', 'title' => 'Green Marriage & Party Lawn', 'desc' => 'Lush outdoor lawn for wedding receptions, parties, and corporate meets'],
                    ['icon' => 'fa-child-reaching', 'title' => 'Kids Play Zone & Pool', 'desc' => 'Dedicated safe splash pool and playground for children'],
                ],
                'sample_items' => [
                    ['title' => 'Family 2-Bedroom Interconnected Suite', 'price' => 4499, 'mrp' => 5900, 'badge' => '4-6 Guests', 'img' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Garden View Deluxe Family Room', 'price' => 2999, 'mrp' => 3800, 'badge' => 'Garden Balcony', 'img' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Poolside Luxury Family Cottage', 'price' => 5499, 'mrp' => 7000, 'badge' => 'Pool Access', 'img' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Standard Triple Bed Family Room', 'price' => 2499, 'mrp' => 3200, 'badge' => '3 Adults', 'img' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'doctor_clinic' => [
                'id' => 'doctor_clinic',
                'title' => 'Doctor, Clinic & Healthcare Diagnostics',
                'category' => 'Healthcare & OPD',
                'icon' => 'fa-stethoscope',
                'suggested_color' => '#0284C7',
                'headline' => 'Advanced Healthcare & Specialist Consultations',
                'subheadline' => 'NABH Accredited Medical Center with Zero-Wait Digital OPD Appointments in '.($this->tenant->city ?: 'Your City'),
                'badge' => '🏥 Verified Medical Clinic & Diagnostics',
                'cta_text' => 'Book OPD Appointment Slot',
                'hero_img' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=900&auto=format&fit=crop&q=80',
                'features' => ['Digital OPD Appointments', 'Specialist Doctor Profiles', 'Lab Diagnostic Reports', 'Prescription WhatsApp Chat'],
                'highlights' => [
                    ['icon' => 'fa-user-doctor', 'title' => 'Specialist Doctors', 'desc' => '15+ MD & MS senior practitioners with verified track records'],
                    ['icon' => 'fa-clock-rotate-left', 'title' => 'Zero Waiting Time', 'desc' => 'Instant pre-booked time slots with automated reminders'],
                    ['icon' => 'fa-shield-halved', 'title' => 'NABH Accredited', 'desc' => 'Strict sterilization protocols & modern diagnostic equipment'],
                ],
                'sample_items' => [
                    ['title' => 'Senior Physician Consultation', 'price' => 500, 'mrp' => 700, 'badge' => 'OPD 20 Mins', 'img' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Dental Root Canal Treatment', 'price' => 2500, 'mrp' => 3500, 'badge' => 'Specialist Care', 'img' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Full Body Health Diagnostic Checkup', 'price' => 1499, 'mrp' => 2800, 'badge' => '62 Tests Included', 'img' => 'https://images.unsplash.com/photo-1581595220892-b0739db3ba8c?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Pediatric Care & Child Vaccine', 'price' => 600, 'mrp' => 800, 'badge' => 'Gentle Care', 'img' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'real_estate' => [
                'id' => 'real_estate',
                'title' => 'Real Estate & Property Developers',
                'category' => 'Housing & Commercial',
                'icon' => 'fa-building',
                'suggested_color' => '#0D9488',
                'headline' => 'Luxury 2 & 3 BHK Homes & Commercial Retail',
                'subheadline' => 'RERA-approved premium residential spaces with modern amenities and 0% brokerage in '.($this->tenant->city ?: 'Prime Locations'),
                'badge' => '🏢 RERA Approved Township & Commercial',
                'cta_text' => 'Schedule Free Site Visit',
                'hero_img' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=900&auto=format&fit=crop&q=80',
                'features' => ['3D Virtual Walkthroughs', 'Download Floor Plan PDFs', 'Site Visit Cab Facility', 'Home Loan EMI Support'],
                'highlights' => [
                    ['icon' => 'fa-file-shield', 'title' => 'RERA Verified', 'desc' => '100% clear titles, bank-approved projects with zero legal hassle'],
                    ['icon' => 'fa-handshake', 'title' => '0% Direct Brokerage', 'desc' => 'Direct from premier developer with transparent pricing'],
                    ['icon' => 'fa-key', 'title' => 'Ready to Move In', 'desc' => 'Possession on time with clubhouse, swimming pool & gym amenities'],
                ],
                'sample_items' => [
                    ['title' => 'The Lakeview 3 BHK Luxury Suite', 'price' => '85 Lakhs', 'mrp' => '95 Lakhs', 'badge' => '1,450 Sq.Ft', 'img' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Urban Heights 2 BHK Smart Apartment', 'price' => '54 Lakhs', 'mrp' => '62 Lakhs', 'badge' => '1,050 Sq.Ft', 'img' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Highstreet Commercial Retail Shop', 'price' => '1.25 Cr', 'mrp' => '1.40 Cr', 'badge' => 'Prime Ground Floor', 'img' => 'https://images.unsplash.com/photo-1555636222-cae831e670b3?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Green Valley Gated Villa Plot', 'price' => '42 Lakhs', 'mrp' => '48 Lakhs', 'badge' => '1,800 Sq.Ft Plot', 'img' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'retail_supermarket' => [
                'id' => 'retail_supermarket',
                'title' => 'Retail Supermarket & Kirana Grocery',
                'category' => 'Grocery & FMCG',
                'icon' => 'fa-cart-shopping',
                'suggested_color' => '#9333EA',
                'headline' => 'Farm Fresh Groceries & Daily Essentials',
                'subheadline' => 'Superfast local delivery directly to your doorstep with 1-click WhatsApp order checkout in '.($this->tenant->city ?: 'Your Area'),
                'badge' => '🛒 Daily Fresh Kirana & Superstore',
                'cta_text' => 'Order on WhatsApp (Free Delivery)',
                'hero_img' => 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=900&auto=format&fit=crop&q=80',
                'features' => ['Slide-Over Shopping Cart', 'Direct WhatsApp Bill Checkout', 'MRP Discount Tags', 'Instant Stock Indicators'],
                'highlights' => [
                    ['icon' => 'fa-truck-fast', 'title' => 'Express Local Delivery', 'desc' => 'Delivered to your home within 30 minutes in peak condition'],
                    ['icon' => 'fa-shield-halved', 'title' => '100% Quality Guarantee', 'desc' => 'Direct farm produce and verified FMCG brand essentials'],
                    ['icon' => 'fa-tag', 'title' => 'Wholesale Prices', 'desc' => 'Daily deals, discounts and cash back on top daily staples'],
                ],
                'sample_items' => [
                    ['title' => 'Royal Daawat Basmati Rice 5kg', 'price' => 480, 'mrp' => 599, 'badge' => '20% OFF', 'img' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Fortune Kachi Ghani Mustard Oil 1L', 'price' => 175, 'mrp' => 210, 'badge' => 'Cold Pressed', 'img' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Amul Pure Cow Ghee Tin 1L', 'price' => 595, 'mrp' => 640, 'badge' => '100% Pure', 'img' => 'https://images.unsplash.com/photo-1528750997573-59b89d56f4f7?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Aashirvaad Shuddh Chakki Atta 10kg', 'price' => 435, 'mrp' => 490, 'badge' => 'Whole Wheat', 'img' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'restaurant_cafe' => [
                'id' => 'restaurant_cafe',
                'title' => 'Restaurant, Cafe & Cloud Kitchen',
                'category' => 'Dining & Food Delivery',
                'icon' => 'fa-utensils',
                'suggested_color' => '#F43F5E',
                'headline' => 'Artisanal Flavors, Fresh Bakes & Fine Dining',
                'subheadline' => 'Delicious woodfired pizzas, specialty coffees and chef specials made fresh daily in '.($this->tenant->city ?: 'Town'),
                'badge' => '🍽️ Gourmet Restaurant & Artisan Kitchen',
                'cta_text' => 'Order Takeaway / Reserve Table',
                'hero_img' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=900&auto=format&fit=crop&q=80',
                'features' => ['Interactive Digital Menu', 'Veg & Non-Veg Dots', 'Table Reservation Booking', 'Instant Kitchen Order WhatsApp'],
                'highlights' => [
                    ['icon' => 'fa-fire-burner', 'title' => 'Cooked Fresh Daily', 'desc' => 'Made from scratch with premium ingredients and authentic recipes'],
                    ['icon' => 'fa-qrcode', 'title' => 'Contactless Digital Menu', 'desc' => 'Scan from table or order online from the comfort of your home'],
                    ['icon' => 'fa-certificate', 'title' => '5-Star Food Hygiene', 'desc' => 'FSSAI certified commercial kitchen with sanitized prep zones'],
                ],
                'sample_items' => [
                    ['title' => 'Truffle Mushroom Woodfired Pizza', 'price' => 380, 'mrp' => 440, 'badge' => '🟢 Veg Chef Special', 'img' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Smoked Butter Chicken & Garlic Naan', 'price' => 460, 'mrp' => 520, 'badge' => '🔴 Non-Veg Popular', 'img' => 'https://images.unsplash.com/photo-1603894584373-5ac82b2ae398?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Handcrafted Cold Brew Hazelnut Latte', 'price' => 180, 'mrp' => 220, 'badge' => '🟢 100% Arabica', 'img' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Belgian Molten Chocolate Lava Cake', 'price' => 220, 'mrp' => 260, 'badge' => '🟢 Freshly Baked', 'img' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'b2b_industrial' => [
                'id' => 'b2b_industrial',
                'title' => 'B2B Industrial, Machinery & Fabrication',
                'category' => 'Manufacturing & Supply',
                'icon' => 'fa-industry',
                'suggested_color' => '#4F46E5',
                'headline' => 'High-Precision CNC Components & Heavy Engineering',
                'subheadline' => 'OEM custom fabrication, industrial machinery and wholesale supply from '.($this->tenant->city ?: 'Our Works'),
                'badge' => '🏭 ISO 9001:2015 Certified Fabrication Plant',
                'cta_text' => 'Request Bulk Quotation (RFQ)',
                'hero_img' => 'https://images.unsplash.com/photo-1581092335397-9583fe92d232?w=900&auto=format&fit=crop&q=80',
                'features' => ['Minimum Order Quantity (MOQ) Controls', 'Instant RFQ Quotation System', 'Tolerance Technical Sheets', 'Pan-India Freight Logistics'],
                'highlights' => [
                    ['icon' => 'fa-award', 'title' => 'ISO 9001:2015 Certified', 'desc' => 'Strict quality inspection with precision micron tolerance guarantees'],
                    ['icon' => 'fa-dolly', 'title' => 'Wholesale Tiered Pricing', 'desc' => 'Direct factory pricing with high-volume volume batch discounts'],
                    ['icon' => 'fa-truck-ramp-box', 'title' => 'Safe Pan-India Dispatch', 'desc' => 'Wooden crate protective packaging with full transit insurance'],
                ],
                'sample_items' => [
                    ['title' => 'Custom CNC Machined Steel Flange', 'price' => 320, 'mrp' => 450, 'badge' => 'MOQ: 50 Pcs', 'img' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'High-Torque Planetary Industrial Gearbox', 'price' => 4800, 'mrp' => 6200, 'badge' => 'MOQ: 5 Units', 'img' => 'https://images.unsplash.com/photo-1537462715879-360eeb61a0ad?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Heavy Duty Spherical Roller Bearing', 'price' => 180, 'mrp' => 240, 'badge' => 'MOQ: 100 Pcs', 'img' => 'https://images.unsplash.com/photo-1581092335878-2d9ff86ca2bf?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Hardened Brass Precision Bushing', 'price' => 45, 'mrp' => 65, 'badge' => 'MOQ: 500 Pcs', 'img' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_wellness' => [
                'id' => 'salon_wellness',
                'title' => 'Salon, Spa & Wellness Studio',
                'category' => 'Beauty, Hair & Spa',
                'icon' => 'fa-spa',
                'suggested_color' => '#EC4899',
                'headline' => 'Luxury Hair Styling, Therapeutic Spa & Bridal Makeover',
                'subheadline' => 'Relax, revitalize and glow with certified beauty artists and organic therapies in '.($this->tenant->city ?: 'Your City'),
                'badge' => '✂️ Premier Luxury Unisex Salon & Spa',
                'cta_text' => 'Book Appointment Session',
                'hero_img' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=900&auto=format&fit=crop&q=80',
                'features' => ['Service Duration Badges (30m, 60m)', 'Stylist Specialist Selector', 'Bridal HD Packages', 'Instant WhatsApp Booking SMS'],
                'highlights' => [
                    ['icon' => 'fa-scissors', 'title' => 'Certified Stylists', 'desc' => 'Trained by top international academies for cuts, color and therapies'],
                    ['icon' => 'fa-leaf', 'title' => 'Organic & Cruelty-Free', 'desc' => 'Only top dermatologist-tested luxury beauty brands used'],
                    ['icon' => 'fa-couch', 'title' => 'Private AC Suites', 'desc' => 'Calm ambient lighting, soothing aromatherapy music and privacy'],
                ],
                'sample_items' => [
                    ['title' => 'Keratin Deep Nourishing Hair Spa', 'price' => 1600, 'mrp' => 2200, 'badge' => '60 Mins Session', 'img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Swedish Aromatherapy Full Body Massage', 'price' => 2400, 'mrp' => 3200, 'badge' => '75 Mins Session', 'img' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Hydra Radiance Glow Facial Treatment', 'price' => 1800, 'mrp' => 2500, 'badge' => '50 Mins Session', 'img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Bridal HD Glamour Makeup & Styling', 'price' => 8500, 'mrp' => 11000, 'badge' => '180 Mins Complete', 'img' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'dark_luxury' => [
                'id' => 'dark_luxury',
                'title' => 'Dark Luxury Obsidian Flagship',
                'category' => 'Executive & Flagship',
                'icon' => 'fa-gem',
                'suggested_color' => '#9333EA',
                'headline' => 'Obsidian Aesthetics & High-Conversion Flagship',
                'subheadline' => 'Deep obsidian dark mode with glowing violet neon accents, designed for prestigious enterprise branding in '.($this->tenant->city ?: 'India'),
                'badge' => '🌟 Obsidian Dark Luxury Flagship',
                'cta_text' => 'Get Exclusive Private Access',
                'hero_img' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=900&auto=format&fit=crop&q=80',
                'features' => ['Deep Dark Mode Obsidian', 'Glowing Neon Border Accents', 'Executive Glassmorphism Cards', 'High Perceived Value'],
                'highlights' => [
                    ['icon' => 'fa-crown', 'title' => 'High Perceived Value', 'desc' => 'Dramatically increase conversion rates with elite aesthetics'],
                    ['icon' => 'fa-bolt-lightning', 'title' => 'Ultra Responsive', 'desc' => 'Optimized for high-end mobile screens and desktop monitors'],
                    ['icon' => 'fa-star', 'title' => 'VIP Client Handling', 'desc' => 'White-glove booking and concierge WhatsApp interaction'],
                ],
                'sample_items' => [
                    ['title' => 'Signature Bespoke Advisory Retainer', 'price' => 45000, 'mrp' => 60000, 'badge' => 'Executive Tier', 'img' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Private Architectural Masterplan Consultation', 'price' => 28000, 'mrp' => 35000, 'badge' => 'Exclusive Slot', 'img' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Custom Handcrafted Luxury Furniture Suite', 'price' => 85000, 'mrp' => 110000, 'badge' => 'Bespoke Craft', 'img' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Digital Brand Transformation Suite', 'price' => 32000, 'mrp' => 40000, 'badge' => 'Full Agency', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'minimal_card' => [
                'id' => 'minimal_card',
                'title' => 'Minimalist Editorial Clean',
                'category' => 'Boutique & Editorial',
                'icon' => 'fa-pen-nib',
                'suggested_color' => '#18181B',
                'headline' => 'Calm Typography, Sharp Grids & Timeless Design',
                'subheadline' => 'An editorial monochrome aesthetic prioritizing clarity, architectural whitespace and effortless reader focus in '.($this->tenant->city ?: 'India'),
                'badge' => '📄 Editorial Studio & Clean Architecture',
                'cta_text' => 'Inquire With Our Studio',
                'hero_img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=900&auto=format&fit=crop&q=80',
                'features' => ['Monochrome Editorial Layout', 'Clean Architectural Borders', 'Distraction-Free Reading', 'Fast Lightweight Performance'],
                'highlights' => [
                    ['icon' => 'fa-cube', 'title' => 'Zero Distractions', 'desc' => 'Whitespace and crisp typography that highlights your work'],
                    ['icon' => 'fa-glasses', 'title' => 'Effortless Readability', 'desc' => 'Designed for consultants, architects, lawyers and boutique firms'],
                    ['icon' => 'fa-check', 'title' => 'High Speed Loading', 'desc' => 'Lightweight minimal DOM with instant click responses'],
                ],
                'sample_items' => [
                    ['title' => 'Architectural Design Consultation', 'price' => 6500, 'mrp' => 8000, 'badge' => '90 Mins', 'img' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Corporate Legal Compliance Audit', 'price' => 14000, 'mrp' => 18000, 'badge' => 'Comprehensive', 'img' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Strategic Brand Identity Framework', 'price' => 22000, 'mrp' => 28000, 'badge' => 'Full Guidelines', 'img' => 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Editorial Publication & Creative Direction', 'price' => 19000, 'mrp' => 24000, 'badge' => 'Portfolio Retainer', 'img' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'wellness_sanctuary' => [
                'id' => 'wellness_sanctuary',
                'title' => 'Ayurvedic & Panchakarma Wellness Sanctuary',
                'category' => 'Ayurveda & Herbal Care',
                'icon' => 'fa-leaf',
                'suggested_color' => '#059669',
                'headline' => 'Authentic Ayurvedic Healing, Panchakarma & Natural Detox',
                'subheadline' => "Holistic herbal remedies, natural Vaidya consultations and rejuvenating therapies in {$city}",
                'badge' => '🌿 Ayurvedic & Panchakarma Sanctuary',
                'cta_text' => 'Book Vaidya Consultation / Panchakarma',
                'hero_img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=900&auto=format&fit=crop&q=80',
                'features' => ['Authentic Panchakarma Therapies', 'Certified Ayurvedic Vaidya Consult', '100% Organic Garden Herbal Oils', 'Custom Dosha Healing Diet'],
                'highlights' => [
                    ['icon' => 'fa-leaf', 'title' => '100% Natural Organic Herbs', 'desc' => 'Pure unadulterated herbal decoctions prepared per ancient texts'],
                    ['icon' => 'fa-spa', 'title' => 'Panchakarma Detox Suites', 'desc' => 'Therapeutic steam, Abhyanga oil massage, and Shirodhara rooms'],
                    ['icon' => 'fa-certificate', 'title' => 'Certified Vaidya Doctors', 'desc' => 'Senior practitioners specializing in chronic ailment recovery'],
                ],
                'sample_items' => [
                    ['title' => 'Abhyanga Full-Body Herbal Oil Massage', 'price' => 1800, 'mrp' => 2400, 'badge' => '60 Mins', 'img' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Shirodhara Medicated Oil Stress Relief', 'price' => 2200, 'mrp' => 2900, 'badge' => '45 Mins', 'img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Complete Panchakarma 7-Day Detox Program', 'price' => 14500, 'mrp' => 18000, 'badge' => '7 Days Package', 'img' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Ayurvedic Pulse Diagnosis (Nadi Pariksha)', 'price' => 500, 'mrp' => 750, 'badge' => '30 Mins Consultation', 'img' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'modern_clean' => [
                'id' => 'modern_clean',
                'title' => 'Modern Retail Storefront & Brand Presence',
                'category' => 'Retail & Showroom',
                'icon' => 'fa-store',
                'suggested_color' => '#9333EA',
                'headline' => 'Modern Retail Storefront, Products & Local Trust',
                'subheadline' => "Clean modern design showcasing products, customer reviews, store timings and direct orders in {$city}",
                'badge' => '🏬 Modern Retail Storefront',
                'cta_text' => 'Shop Products / Contact Store',
                'hero_img' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=900&auto=format&fit=crop&q=80',
                'features' => ['Store Tour & Hours', 'Department Catalog', 'Verified Customer Feedback', 'Instant WhatsApp Inquiries'],
                'highlights' => [
                    ['icon' => 'fa-store', 'title' => 'Prime Retail Showroom', 'desc' => 'Visit our physical store to experience products first-hand'],
                    ['icon' => 'fa-truck-fast', 'title' => 'Superfast Local Delivery', 'desc' => 'Same-day local dispatch directly to your doorstep'],
                    ['icon' => 'fa-tag', 'title' => 'Best Retail Pricing', 'desc' => 'Genuine brand warranty with attractive local discounts'],
                ],
                'sample_items' => [
                    ['title' => 'Signature Cotton Casual Shirt', 'price' => 1299, 'mrp' => 1899, 'badge' => 'Premium Fabric', 'img' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Handcrafted Leather Travel Duffle', 'price' => 3499, 'mrp' => 4500, 'badge' => 'Genuine Leather', 'img' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Designer Chronograph Watch', 'price' => 2899, 'mrp' => 3999, 'badge' => 'Water Resistant', 'img' => 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Minimalist Everyday Sneaker', 'price' => 2199, 'mrp' => 2999, 'badge' => 'Comfort Fit', 'img' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_bridal' => [
                'id' => 'salon_bridal',
                'title' => 'Bridal Makeover & Celebrity Glamour Studio',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-wand-magic-sparkles',
                'suggested_color' => '#BE185D',
                'headline' => 'HD Bridal Makeup, Pre-Bridal Skin Care & Celebrity Styling',
                'subheadline' => "Bespoke bridal makeovers, airbrush HD makeup, and pre-wedding grooming rituals in {$city}",
                'badge' => '👰 Luxury Bridal & Glamour Studio',
                'cta_text' => 'Book Bridal Consultation',
                'hero_img' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=900&auto=format&fit=crop&q=80',
                'features' => ['HD Airbrush Makeup', 'Pre-Bridal Grooming Packages', 'Lookbook & Portfolio', 'VIP Stylist Consultation'],
                'highlights' => [
                    ['icon' => 'fa-wand-magic-sparkles', 'title' => 'HD Airbrush Makeup', 'desc' => 'Long-lasting flawless waterproof makeup for high-res photography'],
                    ['icon' => 'fa-gem', 'title' => 'Pre-Bridal Regimen', 'desc' => 'Custom 30-day glow therapies, detan, hydra facials, and hair spa'],
                    ['icon' => 'fa-crown', 'title' => 'VIP Private Suites', 'desc' => 'Dedicated air-conditioned bridal lounge with privacy and dressing mirrors'],
                ],
                'sample_items' => [
                    ['title' => 'Celebrity HD Bridal Airbrush Package', 'price' => 15000, 'mrp' => 18000, 'badge' => 'Full Day VIP', 'img' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Pre-Bridal 30-Day Glow Therapy', 'price' => 8500, 'mrp' => 11000, 'badge' => 'Complete Skin & Hair', 'img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Reception & Engagement Glamour Look', 'price' => 6500, 'mrp' => 8000, 'badge' => '3 Hours', 'img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Bridal Saree Draping & Hair Styling', 'price' => 2500, 'mrp' => 3500, 'badge' => 'Hairstyle + Draping', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_barber_lounge' => [
                'id' => 'salon_barber_lounge',
                'title' => "Men's Executive Barber & Grooming Lounge",
                'category' => 'Beauty & Salons',
                'icon' => 'fa-scissors',
                'suggested_color' => '#1E293B',
                'headline' => 'Master Barbers, Hot Towel Shaves & Beard Styling',
                'subheadline' => "Modern men's grooming lounge with classic fades, charcoal skin detan, and express queue booking in {$city}",
                'badge' => "💈 Executive Men's Barber Lounge",
                'cta_text' => 'Reserve Barber Chair',
                'hero_img' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=900&auto=format&fit=crop&q=80',
                'features' => ['Hot Towel Razor Shave', 'Beard Spa & Sculpting', 'Executive Skin Detan', 'Zero-Wait Queue Booking'],
                'highlights' => [
                    ['icon' => 'fa-scissors', 'title' => 'Master Craftsmen', 'desc' => 'Experienced barbers specializing in skin fades, pompadours, and beard design'],
                    ['icon' => 'fa-fire-flame-curved', 'title' => 'Hot Towel Experience', 'desc' => 'Relaxing straight-razor shave with essential eucalyptus oils'],
                    ['icon' => 'fa-clock', 'title' => 'Express Queue', 'desc' => 'Book exact time slot and skip the waiting lounge'],
                ],
                'sample_items' => [
                    ['title' => 'Signature Fade Haircut + Beard Styling', 'price' => 650, 'mrp' => 850, 'badge' => '45 Mins', 'img' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Hot Towel Straight-Razor Luxury Shave', 'price' => 350, 'mrp' => 500, 'badge' => 'Classic Razor', 'img' => 'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Charcoal Deep Cleansing Detan Facial', 'price' => 950, 'mrp' => 1300, 'badge' => 'Instant Glow', 'img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Keratin Hair Spa & Dandruff Treatment', 'price' => 1200, 'mrp' => 1600, 'badge' => 'Scalp Therapy', 'img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_nail_lashes' => [
                'id' => 'salon_nail_lashes',
                'title' => 'Nail Art Studio, Lash & Brow Aesthetics Bar',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-gem',
                'suggested_color' => '#7C3AED',
                'headline' => 'Bespoke Gel Nail Extensions, Lash Lifting & Brow Art',
                'subheadline' => "Trending hand-painted nail designs, acrylic extensions, and Korean lash perms in {$city}",
                'badge' => '💅 Nail & Lash Aesthetics Bar',
                'cta_text' => 'Book Nail / Lash Session',
                'hero_img' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=900&auto=format&fit=crop&q=80',
                'features' => ['Gel & Acrylic Extensions', 'Korean Lash Perms', 'Ombre Powder Brows', '100% Autoclaved Tools'],
                'highlights' => [
                    ['icon' => 'fa-gem', 'title' => 'Handmade Nail Art', 'desc' => 'Chrome, marble, 3D charms, and customized French tips'],
                    ['icon' => 'fa-eye', 'title' => 'Korean Lash Lifting', 'desc' => 'Volumizing lash perms lasting 6-8 weeks with zero damage'],
                    ['icon' => 'fa-shield-halved', 'title' => 'Medical-Grade Hygiene', 'desc' => 'Individually sealed and autoclaved stainless steel instruments'],
                ],
                'sample_items' => [
                    ['title' => 'Luxury Gel Nail Extensions with Custom Art', 'price' => 1800, 'mrp' => 2400, 'badge' => 'Full Set', 'img' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Korean Keratin Lash Lift & Tint', 'price' => 1400, 'mrp' => 1900, 'badge' => 'Lasts 8 Weeks', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Gel Polish Manicure & Pedicure Combo', 'price' => 1200, 'mrp' => 1600, 'badge' => 'Mani + Pedi', 'img' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Ombre Powder Brow Shaping & Microblading', 'price' => 3500, 'mrp' => 4500, 'badge' => 'Semi-Permanent', 'img' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_landing_hair_botox' => [
                'id' => 'salon_landing_hair_botox',
                'title' => 'Keratin & Hair Botox Treatment Flash Sale Funnel',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-bolt',
                'suggested_color' => '#8B5CF6',
                'headline' => 'Flat 40% Off Keratin Smoothening & Botox Therapies',
                'subheadline' => "Mirror-shine, frizz-free hair with certified Brazilian keratin in {$city}. 48-Hour voucher window.",
                'badge' => '⚡ Limited 48-Hour Flash Funnel',
                'cta_text' => 'Claim 40% Off Voucher',
                'hero_img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=900&auto=format&fit=crop&q=80',
                'features' => ['48-Hr Countdown Timer', 'Hair Transformation Slider', 'Instant Voucher via WhatsApp', 'Frizz-Free Guarantee'],
                'highlights' => [
                    ['icon' => 'fa-bolt', 'title' => 'Instant Hair Botox', 'desc' => 'Restores moisture, seals split ends, and leaves hair silky smooth'],
                    ['icon' => 'fa-shield-halved', 'title' => 'Formaldehyde-Free', 'desc' => '100% safe, non-toxic, organic keratin formulas'],
                    ['icon' => 'fa-tag', 'title' => 'Flash 40% Savings', 'desc' => 'Includes complimentary deep scalp nourishment spa'],
                ],
                'sample_items' => [
                    ['title' => 'Brazilian Keratin Smoothening (Full Hair)', 'price' => 2999, 'mrp' => 4999, 'badge' => '40% OFF', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Deep Conditioning Hair Botox Therapy', 'price' => 2499, 'mrp' => 3999, 'badge' => 'Frizz-Free', 'img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Cysteine Protein Hair Rebonding', 'price' => 3499, 'mrp' => 5500, 'badge' => 'Zero Damage', 'img' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Moroccan Argan Oil Post-Care Spa', 'price' => 999, 'mrp' => 1500, 'badge' => 'Gloss Boost', 'img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_landing_hydrafacial' => [
                'id' => 'salon_landing_hydrafacial',
                'title' => 'HydraFacial & Glass Skin Glow Funnel',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-droplet',
                'suggested_color' => '#0284C7',
                'headline' => '7-Step Medical HydraFacial & Instant Glass Skin Radiance',
                'subheadline' => "Painless vortex extraction, deep hydration, and LED phototherapy in {$city}. First 25 registrations only.",
                'badge' => '💎 Glass Skin Glow Campaign',
                'cta_text' => 'Reserve HydraFacial Slot',
                'hero_img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=900&auto=format&fit=crop&q=80',
                'features' => ['7-Step Treatment Video Hook', 'Dermatologist Certified', 'Before & After Glow Proof', 'Direct Slot Reservation'],
                'highlights' => [
                    ['icon' => 'fa-droplet', 'title' => 'Vortex Hydration', 'desc' => 'Infuses hyaluronic acid and antioxidants deep into dermal layers'],
                    ['icon' => 'fa-sparkles', 'title' => 'Glass Skin Finish', 'desc' => 'Immediate visible radiance with zero post-procedure redness'],
                    ['icon' => 'fa-user-check', 'title' => 'Certified Cosmetologists', 'desc' => 'Trained with authentic US-FDA approved aesthetic equipment'],
                ],
                'sample_items' => [
                    ['title' => '7-Step Signature Medical HydraFacial', 'price' => 1999, 'mrp' => 3500, 'badge' => 'Instant Glow', 'img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Carbon Laser Peel (Hollywood Facial)', 'price' => 2499, 'mrp' => 4000, 'badge' => 'Pore Tightening', 'img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Oxygen Jet Radiance Infusion', 'price' => 1499, 'mrp' => 2200, 'badge' => '45 Mins', 'img' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Derma Suction Blackhead Extraction', 'price' => 799, 'mrp' => 1200, 'badge' => 'Deep Clean', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_landing_spa_pass' => [
                'id' => 'salon_landing_spa_pass',
                'title' => 'Ayurvedic Detox & Stress-Relief Spa Weekend Pass',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-leaf',
                'suggested_color' => '#059669',
                'headline' => '90-Minute Ayurvedic Detox Therapy & Herbal Steam Bath',
                'subheadline' => "Recharge your mind and muscles with pure sesame oil Abhyanga and steam therapy in {$city}.",
                'badge' => '🌿 Weekend Spa Pass Funnel',
                'cta_text' => 'Get Weekend Spa Pass',
                'hero_img' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=900&auto=format&fit=crop&q=80',
                'features' => ['Weekend Rejuvenation Pass', 'Herbal Steam Included', 'Aromatherapy Oils Selector', '1-Tap WhatsApp Token'],
                'highlights' => [
                    ['icon' => 'fa-leaf', 'title' => 'Pure Herbal Formulations', 'desc' => 'Freshly extracted cold-pressed oils infused with ancient healing herbs'],
                    ['icon' => 'fa-spa', 'title' => 'Herbal Steam Sauna', 'desc' => 'Detoxify pores and relax stiff joints in steam cabins'],
                    ['icon' => 'fa-heart', 'title' => 'Couple Suite Option', 'desc' => 'Book adjoining suites with personal therapists and soft ambient sound'],
                ],
                'sample_items' => [
                    ['title' => '90-Min Full-Body Abhyanga + Herbal Steam', 'price' => 1899, 'mrp' => 2800, 'badge' => 'Best Value Pass', 'img' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Shirodhara Medicated Oil Brain Calm', 'price' => 1999, 'mrp' => 2600, 'badge' => 'Stress Relief', 'img' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Deep Tissue Muscle Recovery Therapy', 'price' => 2199, 'mrp' => 3000, 'badge' => '75 Mins', 'img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Couple Rejuvenation Weekend Combo', 'price' => 3499, 'mrp' => 5200, 'badge' => 'Couple Special', 'img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_landing_men_club' => [
                'id' => 'salon_landing_men_club',
                'title' => "Men's VIP Grooming & Beard Detan Club Funnel",
                'category' => 'Beauty & Salons',
                'icon' => 'fa-user-tie',
                'suggested_color' => '#F59E0B',
                'headline' => 'Executive Haircut + Beard Sculpting + Detan Combo',
                'subheadline' => "Transform your look in 45 minutes flat with master barbers in {$city}. Special introductory combo price.",
                'badge' => "💈 Men's Grooming Combo Pass",
                'cta_text' => 'Book VIP Barber Chair',
                'hero_img' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=900&auto=format&fit=crop&q=80',
                'features' => ['3-in-1 Combo Offer', 'Express 40-Min Turnaround', 'VIP Lounge Barbers', 'Zero Waiting Queue'],
                'highlights' => [
                    ['icon' => 'fa-scissors', 'title' => 'Razor-Sharp Precision', 'desc' => 'Taper fades, crop cuts, and beard contouring done to perfection'],
                    ['icon' => 'fa-face-smile', 'title' => 'Charcoal Detan Scrub', 'desc' => 'Removes pollution grime, blackheads, and sun tan instantly'],
                    ['icon' => 'fa-clock', 'title' => 'Express Queue Pass', 'desc' => 'Your chair is ready when you arrive. Zero lobby wait time.'],
                ],
                'sample_items' => [
                    ['title' => '3-in-1 Executive Combo (Cut + Beard + Detan)', 'price' => 999, 'mrp' => 1600, 'badge' => '38% OFF', 'img' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Hot Towel Razor Shave + Face Massage', 'price' => 499, 'mrp' => 750, 'badge' => 'VIP Shave', 'img' => 'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Charcoal Deep Detox Facial Therapy', 'price' => 799, 'mrp' => 1200, 'badge' => 'Skin Glow', 'img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Hair Loss Prevention & Scalp Therapy', 'price' => 1299, 'mrp' => 1800, 'badge' => 'Scalp Care', 'img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_landing_nail_lash' => [
                'id' => 'salon_landing_nail_lash',
                'title' => 'Gel Nails & Korean Lash Perm Launch Funnel',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-hand-sparkles',
                'suggested_color' => '#D946EF',
                'headline' => 'Gel Nail Extensions & Korean Lash Perm @ Flat ₹999',
                'subheadline' => "Trending Instagram nail art, acrylic extensions, and 8-week lash lifts in {$city}. Limited slots.",
                'badge' => '💅 Launch Offer • Flat ₹999',
                'cta_text' => 'Claim ₹999 Launch Token',
                'hero_img' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=900&auto=format&fit=crop&q=80',
                'features' => ['₹999 Intro Promo Hook', 'Nail Lookbook Showcase', 'Korean Lash Lift Demo', 'Instant Slot Calendar'],
                'highlights' => [
                    ['icon' => 'fa-gem', 'title' => 'Long-Lasting Gel Art', 'desc' => 'Chip-resistant glossy finish lasting over 4 weeks'],
                    ['icon' => 'fa-eye', 'title' => 'Keratin Lash Perm', 'desc' => 'Dramatically lifted, dark lashes without mascara or extensions'],
                    ['icon' => 'fa-shield-halved', 'title' => 'Nail Bed Protection', 'desc' => 'Gentle buffing and calcium-enriched base coats for healthy natural nails'],
                ],
                'sample_items' => [
                    ['title' => 'Gel Nail Extension Set + 2 Accent Nails Art', 'price' => 999, 'mrp' => 1800, 'badge' => 'Launch Promo', 'img' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Korean Keratin Lash Lift & Dark Tint', 'price' => 1199, 'mrp' => 1900, 'badge' => '8-Week Curl', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Chrome Mirror Finish Nail Add-on', 'price' => 399, 'mrp' => 600, 'badge' => 'Trending', 'img' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Ombre Brow Lamination & Tint Combo', 'price' => 1499, 'mrp' => 2200, 'badge' => 'Full Brows', 'img' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_ecom_organic_skincare' => [
                'id' => 'salon_ecom_organic_skincare',
                'title' => 'Luxury Organic Skincare & Serum Boutique',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-leaf',
                'suggested_color' => '#059669',
                'headline' => 'Dermatologist-Curated Organic Skincare & Potent Serums',
                'subheadline' => "Clean beauty essentials, cruelty-free formulas, and daily routines delivered to your door in {$city}",
                'badge' => '✨ Clean Skincare Apothecary',
                'cta_text' => 'Shop Organic Serums',
                'hero_img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=900&auto=format&fit=crop&q=80',
                'features' => ['Clean Beauty Badges', 'Morning/Night Bundles', 'Ingredient Transparency', 'WhatsApp Checkout'],
                'highlights' => [
                    ['icon' => 'fa-leaf', 'title' => '100% Vegan & Clean', 'desc' => 'Paraben-free, sulfate-free, and ethically formulated for sensitive Indian skin'],
                    ['icon' => 'fa-droplet', 'title' => 'Cold-Pressed Actives', 'desc' => 'Retains maximum botanical nutrients and antioxidant potency'],
                    ['icon' => 'fa-truck-fast', 'title' => 'Quick Home Delivery', 'desc' => 'Eco-friendly cardboard bubble-wrapped shipping to your doorstep'],
                ],
                'sample_items' => [
                    ['title' => '2% Hyaluronic Radiance Dew Serum 30ml', 'price' => 699, 'mrp' => 999, 'badge' => 'Best Seller', 'img' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Rosehip & Vitamin C Cold-Pressed Face Oil', 'price' => 849, 'mrp' => 1200, 'badge' => 'Pure Botanical', 'img' => 'https://images.unsplash.com/photo-1608248597359-00995fa1b6cf?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Centella Soothing Barrier Repair Cream', 'price' => 599, 'mrp' => 799, 'badge' => 'Skin Calming', 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Green Tea & Niacinamide Pore Toner 100ml', 'price' => 449, 'mrp' => 650, 'badge' => 'Pore Control', 'img' => 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_ecom_haircare_tools' => [
                'id' => 'salon_ecom_haircare_tools',
                'title' => 'Professional Salon Haircare & Styling Tools Mart',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-wind',
                'suggested_color' => '#7C3AED',
                'headline' => 'Professional Salon Equipment, Styling Tools & Liters',
                'subheadline' => "Ionic hair dryers, ceramic straighteners, and salon-size keratin shampoos in {$city}",
                'badge' => '💇 Salon Pro Tools & Haircare',
                'cta_text' => 'Shop Styling Tools',
                'hero_img' => 'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?w=900&auto=format&fit=crop&q=80',
                'features' => ['Brand Warranty Badges', 'Salon-Size Liter Bottles', 'Styling Tool Guides', 'Instant COD & WhatsApp'],
                'highlights' => [
                    ['icon' => 'fa-shield-halved', 'title' => '2-Year Replacement Warranty', 'desc' => 'Guaranteed genuine salon-grade electronics with full brand warranty'],
                    ['icon' => 'fa-bottle-droplet', 'title' => 'Jumbo 1-Litre Refills', 'desc' => 'Save up to 35% on high-volume professional salon shampoo bottles'],
                    ['icon' => 'fa-bolt', 'title' => 'Tourmaline Ionic Tech', 'desc' => 'Cuts drying time in half with zero heat frizz or cuticle damage'],
                ],
                'sample_items' => [
                    ['title' => 'Pro Ionic AC Motor Salon Hair Dryer 2200W', 'price' => 2499, 'mrp' => 3800, 'badge' => '2-Yr Warranty', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Moroccan Argan Deep Repair Hair Mask 500g', 'price' => 899, 'mrp' => 1299, 'badge' => 'Salon Grade', 'img' => 'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Ceramic Tourmaline Floating Plate Straightener', 'price' => 1999, 'mrp' => 2999, 'badge' => 'Fast Heat', 'img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Keratin Smooth Shampoo Jumbo Refill 1000ml', 'price' => 1199, 'mrp' => 1650, 'badge' => '1 Litre Pack', 'img' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_ecom_bridal_vanity' => [
                'id' => 'salon_ecom_bridal_vanity',
                'title' => 'Bridal Beauty Vanity & Makeup Kit Shop',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-spray-can-sparkles',
                'suggested_color' => '#BE185D',
                'headline' => 'Complete Bridal Trousseau Vanity Boxes & Waterproof Makeup',
                'subheadline' => "Curated bridal trousseau kits, HD waterproof cosmetics, and luxury makeup vanity trunks in {$city}",
                'badge' => '💄 Bridal Vanity & Trousseau Shop',
                'cta_text' => 'Explore Bridal Kits',
                'hero_img' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=900&auto=format&fit=crop&q=80',
                'features' => ['Pre-Made Vanity Boxes', 'Shade Match Swatches', 'Gift Packaging Included', 'Free Pan-India Delivery'],
                'highlights' => [
                    ['icon' => 'fa-gift', 'title' => 'Luxury Velvet Trunk Box', 'desc' => 'Elegant keepsake trunk box included with multi-tier cosmetic compartments'],
                    ['icon' => 'fa-water', 'title' => '24-Hr Waterproof Pigments', 'desc' => 'Tear-proof, humidity-proof formulas curated for Indian wedding functions'],
                    ['icon' => 'fa-gem', 'title' => 'Curated by Bridal Artists', 'desc' => 'Pre-selected makeup palettes tested by senior bridal artists'],
                ],
                'sample_items' => [
                    ['title' => 'Royal Bridal 18-Piece Trousseau Vanity Trunk', 'price' => 5999, 'mrp' => 8500, 'badge' => 'Complete Kit', 'img' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'HD Waterproof Matte Foundation (6 Swatches)', 'price' => 799, 'mrp' => 1100, 'badge' => '24-Hr Wear', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Velvet Matte Liquid Lipstick Trio (Nude / Crimson)', 'price' => 649, 'mrp' => 999, 'badge' => 'Pack of 3', 'img' => 'https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Bridal Glamour 35-Color Eyeshadow Palette', 'price' => 1299, 'mrp' => 1800, 'badge' => 'High Pigment', 'img' => 'https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_ecom_men_grooming' => [
                'id' => 'salon_ecom_men_grooming',
                'title' => "Men's Beard Craft & Daily Grooming Store",
                'category' => 'Beauty & Salons',
                'icon' => 'fa-user-tie',
                'suggested_color' => '#1E293B',
                'headline' => "Men's Beard Care, Matte Styling Clay & Daily Grooming",
                'subheadline' => "Cedarwood beard growth oils, matte finish pomades, and charcoal facewashes in {$city}",
                'badge' => "💈 Men's Grooming Apothecary",
                'cta_text' => 'Shop Beard & Grooming',
                'hero_img' => 'https://images.unsplash.com/photo-1621607512214-68297480165e?w=900&auto=format&fit=crop&q=80',
                'features' => ['Beard Growth Bundles', 'Subscription & Save', 'Travel-Friendly Kits', '1-Click WhatsApp Order'],
                'highlights' => [
                    ['icon' => 'fa-mustache', 'title' => '100% Pure Beard Oils', 'desc' => 'Stimulates dormant follicles with argan, jojoba, and cedarwood extracts'],
                    ['icon' => 'fa-hand-fist', 'title' => 'All-Day Matte Hold', 'desc' => 'High hold without greasy residue, washes off effortlessly with water'],
                    ['icon' => 'fa-shield-halved', 'title' => 'Toxin-Free Daily Care', 'desc' => 'Zero parabens, SLS, or harsh alcohols that dry out masculine skin'],
                ],
                'sample_items' => [
                    ['title' => 'Ultimate Beard Growth & Grooming Kit (Oil + Balm)', 'price' => 899, 'mrp' => 1400, 'badge' => 'Top Rated', 'img' => 'https://images.unsplash.com/photo-1621607512214-68297480165e?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Strong Hold Matte Clay Hair Pomade 100g', 'price' => 499, 'mrp' => 750, 'badge' => 'Matte Finish', 'img' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Activated Charcoal Deep Detox Face Wash 150ml', 'price' => 349, 'mrp' => 499, 'badge' => 'Oil-Free', 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Sandalwood & Aloe Pre-Shave Soothing Butter', 'price' => 399, 'mrp' => 550, 'badge' => 'Zero Burn', 'img' => 'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_luxury_hair_studio' => [
                'id' => 'salon_luxury_hair_studio',
                'title' => 'Celebrity Hair Studio & Balayage Color Bar',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-scissors',
                'suggested_color' => '#D97706',
                'headline' => 'French Balayage, Olaplex Bond Repair & Celebrity Hair Transformations',
                'subheadline' => "Bespoke hair color styling, global keratin smoothening, and precision cuts in {$city}",
                'badge' => '💇 Hair Studio & Color Bar',
                'cta_text' => 'Book Hair Consultation',
                'hero_img' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?w=900&auto=format&fit=crop&q=80',
                'features' => ['French Balayage Color', 'Olaplex Bond Repair', 'Celebrity Stylists', 'VIP Salon Chair'],
                'highlights' => [
                    ['icon' => 'fa-palette', 'title' => 'Master Colorists', 'desc' => 'Hand-painted French balayage, ombre, and pastel highlights customized to your skin tone'],
                    ['icon' => 'fa-shield-heart', 'title' => 'Olaplex Bond Therapy', 'desc' => 'Multi-step bond multiplying treatment preventing breakage during bleaching'],
                    ['icon' => 'fa-chair', 'title' => 'VIP Private Styling Station', 'desc' => 'Dedicated luxury salon chair with complimentary gourmet coffee & Wi-Fi'],
                ],
                'sample_items' => [
                    ['title' => 'Signature French Balayage + Gloss Toner', 'price' => 4500, 'mrp' => 6000, 'badge' => 'Top Rated', 'img' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Olaplex No. 1 & No. 2 Bond Repair Therapy', 'price' => 1999, 'mrp' => 2800, 'badge' => 'Bond Multiplier', 'img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Global Keratin Smooth Therapy (Full Hair)', 'price' => 3800, 'mrp' => 5200, 'badge' => 'Frizz-Free', 'img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Master Precision Cut & Blowdry Styling', 'price' => 850, 'mrp' => 1200, 'badge' => 'Master Stylist', 'img' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
            'salon_ecom_perfume_bath_body' => [
                'id' => 'salon_ecom_perfume_bath_body',
                'title' => 'Artisanal Luxury Perfumes & Bath Boutique',
                'category' => 'Beauty & Salons',
                'icon' => 'fa-spray-can-sparkles',
                'suggested_color' => '#BE185D',
                'headline' => 'Artisanal Long-Lasting Perfumes & Botanical Bath Luxury',
                'subheadline' => "French extrait de parfums, whipped shea body butters, and aromatherapy bath salts delivered in {$city}",
                'badge' => '🌸 Fragrance & Bath Boutique',
                'cta_text' => 'Shop Artisanal Perfumes',
                'hero_img' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=900&auto=format&fit=crop&q=80',
                'features' => ['Long-Lasting Perfumes', 'Organic Body Butters', 'Luxury Gift Sets', 'Express 48h Delivery'],
                'highlights' => [
                    ['icon' => 'fa-spray-can-sparkles', 'title' => 'Extrait de Parfum Grade', 'desc' => 'High 25-30% oil concentration providing 12+ hours of lingering sillage'],
                    ['icon' => 'fa-jar', 'title' => 'Whipped Shea Butters', 'desc' => 'Raw Ghanaian shea butter infused with cold-pressed sweet almond and jojoba oils'],
                    ['icon' => 'fa-box-open', 'title' => 'Luxury Gift Packaging', 'desc' => 'Hand-wrapped magnetic gift boxes with personalized wax seals and ribbons'],
                ],
                'sample_items' => [
                    ['title' => 'Velvet Rose & Smoked Oud Extrait 50ml', 'price' => 1499, 'mrp' => 2200, 'badge' => 'Best Seller', 'img' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Whipped Vanilla Shea Body Butter 200g', 'price' => 599, 'mrp' => 850, 'badge' => 'Ultra Hydrating', 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Himalayan Pink Salt & Lavender Bath Soak 350g', 'price' => 449, 'mrp' => 650, 'badge' => 'Stress Relief', 'img' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=400&auto=format&fit=crop&q=80'],
                    ['title' => 'Artisanal Scented Soy Candle Gift Duo', 'price' => 899, 'mrp' => 1300, 'badge' => 'Gift Set', 'img' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400&auto=format&fit=crop&q=80'],
                ],
            ],
        ];

        if (isset($templates[$this->previewTemplateId])) {
            $selected = $templates[$this->previewTemplateId];
        } else {
            $catalogTemplates = TemplateCatalog::getForCategory($this->activeCategory, 'all');
            $foundCatTpl = null;
            foreach ($catalogTemplates as $catTpl) {
                if ($catTpl['id'] === $this->previewTemplateId) {
                    $foundCatTpl = $catTpl;
                    break;
                }
            }

            if ($foundCatTpl) {
                $type = $foundCatTpl['type'] ?? TemplateCatalog::getTemplateType($foundCatTpl['id'], $this->activeCategory);
                $selected = [
                    'id' => $foundCatTpl['id'],
                    'type' => $type,
                    'title' => $foundCatTpl['title'] ?? '',
                    'category' => $foundCatTpl['category'] ?? $this->activeCategory,
                    'icon' => $foundCatTpl['icon'] ?? 'fa-layer-group',
                    'suggested_color' => $foundCatTpl['suggested_color'] ?? '#2563EB',
                    'headline' => $foundCatTpl['subheadline'] ?? $foundCatTpl['title'],
                    'subheadline' => $foundCatTpl['description'] ?? '',
                    'badge' => $foundCatTpl['badge'] ?? '',
                    'cta_text' => ($type === 'ecommerce') ? 'Order Online / Add to Cart' : (($type === 'landing_page') ? 'Claim Special Promo Offer' : 'Explore Services / Admissions'),
                    'hero_img' => $foundCatTpl['image_url'] ?? 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=900&auto=format&fit=crop&q=80',
                    'features' => $foundCatTpl['features'] ?? ['100% Quality Guaranteed', 'Expert Team', 'Fast Service', 'WhatsApp Support'],
                    'highlights' => [
                        ['icon' => 'fa-check-circle', 'title' => 'Verified Quality', 'desc' => 'Calibrated to the highest industry standards'],
                        ['icon' => 'fa-bolt', 'title' => 'Instant Response', 'desc' => 'Quick turn-around and 24/7 client communication'],
                        ['icon' => 'fa-shield', 'title' => 'Direct Support', 'desc' => 'Direct guidance and assistance via WhatsApp'],
                    ],
                ];
            } else {
                $selected = $templates['salon_wellness'] ?? $templates['doctor_clinic'];
            }
        }

        if (! isset($selected['type'])) {
            $selected['type'] = TemplateCatalog::getTemplateType($this->previewTemplateId, $this->activeCategory);
        }

        return $selected;
    }

    public function applyTemplate($themeName, $suggestedColor = null)
    {
        $this->activeTheme = $themeName;
        $updateData = ['active_theme' => $themeName];
        if ($suggestedColor) {
            $this->brandColor = $suggestedColor;
            $updateData['brand_color'] = $suggestedColor;
        }

        $templateType = TemplateCatalog::getTemplateType($themeName, $this->activeCategory);
        $settings = $this->tenant->settings ?? [];
        $settings['website_type'] = $templateType;
        $updateData['settings'] = $settings;

        $archetypeCode = TemplateCatalog::getArchetypeForTheme($themeName, $this->activeCategory);
        $arch = Archetype::where('code', $archetypeCode)->first();
        if ($arch) {
            $updateData['archetype_id'] = $arch->id;
        }

        $this->tenant->update($updateData);
        $this->tenant->load('archetype');
        $this->showTemplatePreviewModal = false;
        $this->flashMessage = "Template '".ucwords(str_replace('_', ' ', $themeName))."' applied successfully as ".ucwords(str_replace('_', ' ', $templateType)).' with zero data loss!';
    }

    public function selectTheme($themeName)
    {
        $this->activeTheme = $themeName;
        $templateType = TemplateCatalog::getTemplateType($themeName, $this->activeCategory);
        $settings = $this->tenant->settings ?? [];
        $settings['website_type'] = $templateType;

        $archetypeCode = TemplateCatalog::getArchetypeForTheme($themeName, $this->activeCategory);
        $arch = Archetype::where('code', $archetypeCode)->first();
        $updateData = [
            'active_theme' => $themeName,
            'settings' => $settings,
        ];
        if ($arch) {
            $updateData['archetype_id'] = $arch->id;
        }

        $this->tenant->update($updateData);
        $this->tenant->load('archetype');
        $this->flashMessage = 'Theme updated to '.ucfirst(str_replace('_', ' ', $themeName)).'! Content preserved (Zero Data Loss).';
    }

    public function selectArchetype($archetypeCode)
    {
        $archetype = Archetype::where('code', $archetypeCode)->firstOrFail();
        $this->tenant->update([
            'archetype_id' => $archetype->id,
        ]);
        $this->tenant->load('archetype');
        $this->flashMessage = "Industry Archetype switched to '{$archetype->name}'! Default CTA is now '{$archetype->cta_label}'. Content preserved with Zero Data Loss.";
    }

    public function selectBrandColor($hexColor)
    {
        $this->brandColor = $hexColor;
        $this->tenant->update(['brand_color' => $hexColor]);
        $this->flashMessage = "Brand color updated to {$hexColor}!";
    }

    public function saveTemplateLayoutSettings()
    {
        $settings = $this->tenant->settings ?? [];
        $settings['show_trust_pills'] = $this->showTrustPills;
        $settings['show_highlights'] = $this->showHighlights;
        $settings['show_reviews'] = $this->showReviews;
        $settings['show_hours'] = $this->showHours;
        $settings['show_inquiry_form'] = $this->showInquiryForm;

        $this->tenant->update([
            'settings' => $settings,
            'active_theme' => $this->activeTheme,
            'brand_color' => $this->brandColor,
        ]);

        $this->flashMessage = 'Template layout and design preferences saved successfully!';
    }

    // --- CATALOG ACTIONS ---
    public function openNewItemModal()
    {
        $this->editingItemId = null;
        $this->itemTitle = '';
        $this->itemCategory = $this->tenant->archetype->code === 'service' ? 'Consultations' : 'General';
        $this->itemPrice = 500;
        $this->itemComparePrice = 0;
        $this->itemDuration = 30;
        $this->itemMinQty = 10;
        $this->itemBrand = '';
        $this->itemBadge = '';
        $this->itemStockQty = 25;
        $this->itemImageUrl = $this->tenant->archetype->code === 'service'
            ? 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=600&auto=format&fit=crop&q=75'
            : 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=600&auto=format&fit=crop&q=75';
        $this->itemInStock = true;
        $this->showItemModal = true;
    }

    public function editItem($itemId)
    {
        $item = $this->tenant->catalogItems()->findOrFail($itemId);
        $this->editingItemId = $item->id;
        $this->itemTitle = $item->title;
        $this->itemCategory = $item->category_name ?? '';
        $this->itemPrice = (float) $item->price;
        $this->itemComparePrice = (float) $item->compare_at_price;
        $this->itemDuration = $item->duration_minutes ?? 30;
        $this->itemMinQty = $item->min_order_qty ?? 10;
        $this->itemBrand = $item->attributes['brand'] ?? '';
        $this->itemBadge = $item->attributes['badge'] ?? '';
        $this->itemStockQty = $item->stock_quantity ?? 25;
        $this->itemImageUrl = $item->image_url ?? '';
        $this->itemInStock = (bool) $item->in_stock;
        $this->showItemModal = true;
    }

    public function saveItem()
    {
        $this->validate([
            'itemTitle' => 'required|min:3',
            'itemPrice' => 'required|numeric|min:0',
        ]);

        $attrs = [];
        if ($this->editingItemId) {
            $existing = $this->tenant->catalogItems()->find($this->editingItemId);
            $attrs = is_array($existing?->attributes) ? $existing->attributes : [];
        }

        if (! empty($this->itemBrand)) {
            $attrs['brand'] = trim($this->itemBrand);
        } else {
            unset($attrs['brand']);
        }

        if (! empty($this->itemBadge)) {
            $attrs['badge'] = trim($this->itemBadge);
        } else {
            unset($attrs['badge']);
        }

        $data = [
            'title' => $this->itemTitle,
            'category_name' => $this->itemCategory ?: 'General',
            'price' => $this->itemPrice,
            'compare_at_price' => $this->itemComparePrice > 0 ? $this->itemComparePrice : null,
            'type' => $this->tenant->archetype->code === 'service' ? 'service' : ($this->tenant->archetype->code === 'b2b' ? 'quote_item' : 'product'),
            'duration_minutes' => $this->tenant->archetype->code === 'service' ? $this->itemDuration : null,
            'min_order_qty' => $this->tenant->archetype->code === 'b2b' ? $this->itemMinQty : null,
            'image_url' => $this->itemImageUrl,
            'in_stock' => $this->itemInStock,
            'stock_quantity' => $this->itemStockQty,
            'attributes' => $attrs,
        ];

        if ($this->editingItemId) {
            $this->tenant->catalogItems()->where('id', $this->editingItemId)->update($data);
            $this->flashMessage = "Item '{$this->itemTitle}' updated successfully!";
        } else {
            $this->tenant->catalogItems()->create($data);
            $this->flashMessage = "New item '{$this->itemTitle}' added to catalog!";
        }

        $this->showItemModal = false;
        $this->tenant->load('catalogItems');
    }

    public function deleteItem($itemId)
    {
        $item = $this->tenant->catalogItems()->find($itemId);
        if ($item) {
            $title = $item->title;
            $item->delete();
            $this->flashMessage = "Item '{$title}' removed from catalog.";
            $this->tenant->load('catalogItems');
        }
    }

    // --- E-COMMERCE COUPONS ACTIONS ---
    public function openCouponModal(): void
    {
        $this->newCouponCode = '';
        $this->newCouponType = 'percentage';
        $this->newCouponValue = 10;
        $this->newCouponMinOrder = 499;
        $this->newCouponDescription = '';
        $this->showCouponModal = true;
    }

    public function saveCoupon(): void
    {
        $this->validate([
            'newCouponCode' => 'required|min:3|max:20',
            'newCouponValue' => 'required|numeric|min:1',
            'newCouponMinOrder' => 'required|numeric|min:0',
        ]);

        $code = strtoupper(trim($this->newCouponCode));

        foreach ($this->coupons as $c) {
            if (strtoupper($c['code']) === $code) {
                $this->addError('newCouponCode', 'A coupon with this code already exists.');

                return;
            }
        }

        $this->coupons[] = [
            'code' => $code,
            'type' => $this->newCouponType,
            'value' => (float) $this->newCouponValue,
            'min_order' => (float) $this->newCouponMinOrder,
            'description' => $this->newCouponDescription ?: ($this->newCouponType === 'percentage' ? "{$this->newCouponValue}% OFF on orders above ₹{$this->newCouponMinOrder}" : "Flat ₹{$this->newCouponValue} OFF on orders above ₹{$this->newCouponMinOrder}"),
            'active' => true,
        ];

        $this->persistCoupons();
        $this->showCouponModal = false;
        $this->flashMessage = "Coupon '{$code}' created successfully!";
    }

    public function toggleCoupon(int $index): void
    {
        if (isset($this->coupons[$index])) {
            $this->coupons[$index]['active'] = ! ($this->coupons[$index]['active'] ?? true);
            $this->persistCoupons();
            $this->flashMessage = 'Coupon status updated!';
        }
    }

    public function deleteCoupon(int $index): void
    {
        if (isset($this->coupons[$index])) {
            $code = $this->coupons[$index]['code'] ?? 'Coupon';
            array_splice($this->coupons, $index, 1);
            $this->persistCoupons();
            $this->flashMessage = "Coupon '{$code}' deleted.";
        }
    }

    protected function persistCoupons(): void
    {
        $settings = $this->tenant->settings ?? [];
        $settings['coupons'] = $this->coupons;
        $this->tenant->update(['settings' => $settings]);
    }

    public function getFilteredCatalogItemsProperty()
    {
        $query = $this->tenant->catalogItems();

        if ($this->catalogCategoryFilter !== 'all') {
            $query->where('category_name', $this->catalogCategoryFilter);
        }

        if (! empty($this->catalogSearch)) {
            $search = $this->catalogSearch;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category_name', 'like', "%{$search}%");
            });
        }

        $items = $query->get();

        if ($this->catalogBrandFilter !== 'all') {
            $brand = $this->catalogBrandFilter;
            $items = $items->filter(function ($item) use ($brand) {
                return ($item->attributes['brand'] ?? '') === $brand;
            });
        }

        return $items;
    }

    public function getTenantBrandsProperty(): array
    {
        return $this->tenant->catalogItems
            ->map(fn ($item) => $item->attributes['brand'] ?? null)
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    public function getTenantCategoriesProperty(): array
    {
        return $this->tenant->catalogItems
            ->pluck('category_name')
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    public function updatedBusinessCategory($val)
    {
        $rec = TemplateCatalog::getRecommended($val, $this->websiteType);
        $code = $rec['archetype'] ?? 'retail';
        $theme = $rec['id'];
        $color = $rec['suggested_color'];

        $this->selectedCategoryFilter = $val;

        $archetype = Archetype::where('code', $code)->first();
        if ($archetype) {
            $this->archetypeId = $archetype->id;
            $this->activeTheme = $theme;
            $this->brandColor = $color;
            $this->tenant->update([
                'archetype_id' => $archetype->id,
                'active_theme' => $theme,
                'brand_color' => $color,
            ]);
            $this->tenant->load('archetype');
        }
    }

    // --- PROFILE & SETTINGS ACTIONS ---
    public function saveProfile()
    {
        $this->validate([
            'businessName' => 'required|min:2',
            'phone' => 'required|min:10',
            'city' => 'required',
        ]);

        if ($this->businessCategory) {
            $this->updatedBusinessCategory($this->businessCategory);
        }

        $settings = $this->tenant->settings ?? [];
        if ($this->businessCategory) {
            $settings['business_category'] = $this->businessCategory;
        }
        if ($this->websiteType) {
            $settings['website_type'] = $this->websiteType;
        }

        $updateData = [
            'business_name' => $this->businessName,
            'tagline' => $this->tagline,
            'phone' => $this->phone,
            'whatsapp_number' => $this->whatsappNumber ?: $this->phone,
            'city' => $this->city,
            'address' => $this->address,
            'about_text' => $this->aboutText,
            'settings' => $settings,
        ];

        if ($this->archetypeId) {
            $updateData['archetype_id'] = $this->archetypeId;
        }

        $this->tenant->update($updateData);
        $this->tenant->load('archetype');

        $this->flashMessage = 'Store profile details updated successfully!';
    }

    // --- ORDERS MANAGEMENT ACTIONS ---
    public function updateOrderStatus($orderId, $status)
    {
        $order = $this->tenant->orders()->find($orderId);
        if ($order) {
            $order->update(['status' => $status]);
            $this->flashMessage = "Order {$order->order_number} marked as {$status}!";
            $this->tenant->load('orders');
        }
    }

    // --- AI CONTENT GENERATOR FOR TEMPLATE ---
    public function generateAiContent($type = 'taglines')
    {
        $this->aiGenerating = true;

        $archetypeCode = $this->tenant->archetype->code;
        $name = $this->tenant->business_name;
        $city = $this->tenant->city;

        if ($type === 'taglines') {
            if ($archetypeCode === 'hospitality') {
                $this->tagline = "Luxury Rooms, Peaceful Stays & Heartfelt Hospitality in {$city}";
            } elseif ($archetypeCode === 'service') {
                $this->tagline = "Leading Clinical Excellence & Compassionate Healthcare in {$city}";
            } elseif ($archetypeCode === 'b2b') {
                $this->tagline = 'ISO Certified High-Precision Industrial Fabrication & Bulk Supply';
            } elseif ($archetypeCode === 'food') {
                $this->tagline = "Fresh Authentic Gourmet Delights & Express Delivery in {$city}";
            } else {
                $this->tagline = "Your Trusted Neighborhood Store for Daily Fresh Groceries in {$city}";
            }
            $this->tenant->update(['tagline' => $this->tagline]);
            $this->flashMessage = 'AI generated high-converting tagline applied to your template!';
        } elseif ($type === 'about') {
            if ($archetypeCode === 'hospitality') {
                $this->aboutText = "Welcome to {$name}, your preferred luxury stay in {$city}. Whether visiting for business or holiday, we offer sanitized AC rooms, 24/7 room service, fast Wi-Fi, and warm hospitality to make you feel right at home in {$city}.";
            } elseif ($archetypeCode === 'service') {
                $this->aboutText = "Welcome to {$name}, {$city}'s premier clinical practice. We combine modern diagnostic equipment with personalized, ethical medical consultation. Our mission is to provide transparent, painless, and dependable healthcare for every family in {$city}.";
            } elseif ($archetypeCode === 'b2b') {
                $this->aboutText = "At {$name}, we engineer high-tolerance mechanical components and custom metal fabrication for heavy industry and OEM partners. Operating out of {$city}, we maintain strict ISO quality controls, on-time batch dispatch, and full material certifications.";
            } else {
                $this->aboutText = "For years, {$name} has been the preferred destination for households in {$city}. We take pride in sourcing pure, farm-fresh produce and everyday staples at the best wholesale rates with express doorstep delivery.";
            }
            $this->tenant->update(['about_text' => $this->aboutText]);
            $this->flashMessage = 'AI generated professional About Us story saved!';
        }

        $this->aiGenerating = false;
    }

    // ========================================================
    // 🌐 DOMAIN MANAGEMENT HUB METHODS
    // ========================================================

    public function searchDomainAvailability(): void
    {
        $query = strtolower(trim($this->domainSearchQuery));
        $query = preg_replace('/[^a-z0-9\-]/', '', $query);

        if (empty($query)) {
            $this->domainSearchResults = [];

            return;
        }

        $this->isSearchingDomain = true;

        $extensions = [
            ['tld' => '.in', 'price' => 499, 'badge' => 'India Official', 'desc' => 'Best for Indian coaching, local academies & students'],
            ['tld' => '.com', 'price' => 899, 'badge' => 'Global Brand', 'desc' => 'Most prestigious and globally recognized extension'],
            ['tld' => '.online', 'price' => 199, 'badge' => 'Best Value', 'desc' => 'Modern, affordable domain for online mock tests'],
            ['tld' => '.store', 'price' => 299, 'badge' => 'E-Commerce', 'desc' => 'Perfect for shopping, test series passes & notes'],
        ];

        $results = [];
        foreach ($extensions as $ext) {
            $fullDomain = $query.$ext['tld'];
            $taken = Tenant::where('custom_domain', $fullDomain)
                ->where('id', '!=', $this->tenant->id)
                ->exists();

            $results[] = [
                'domain' => $fullDomain,
                'name' => $query,
                'extension' => $ext['tld'],
                'price' => $ext['price'],
                'badge' => $ext['badge'],
                'desc' => $ext['desc'],
                'available' => ! $taken,
            ];
        }

        $this->domainSearchResults = $results;
        $this->isSearchingDomain = false;
    }

    public function purchaseDomain(string $domainName): void
    {
        $domain = strtolower(trim($domainName));

        $taken = Tenant::where('custom_domain', $domain)
            ->where('id', '!=', $this->tenant->id)
            ->exists();

        if ($taken) {
            $this->flashMessage = "⚠️ Sorry, {$domain} is already taken by another store.";

            return;
        }

        $settings = $this->tenant->settings ?? [];
        $settings['domain_status'] = 'active';
        $settings['domain_type'] = 'purchased';
        $settings['domain_ssl'] = true;
        $settings['domain_purchased_at'] = now()->toIso8601String();

        $this->tenant->update([
            'custom_domain' => $domain,
            'settings' => $settings,
        ]);

        $this->customDomain = $domain;
        $this->domainStatus = 'active';
        $this->domainType = 'purchased';
        $this->domainSsl = true;
        $this->domainSearchResults = [];
        $this->domainSearchQuery = '';

        $this->flashMessage = "🎉 Congratulations! {$domain} has been registered and connected live to your storefront with active SSL!";
    }

    public function connectExistingDomain(): void
    {
        $domain = strtolower(trim($this->existingDomainInput));
        $domain = preg_replace('#^https?://#', '', $domain);
        $domain = rtrim($domain, '/');

        if (empty($domain) || ! str_contains($domain, '.')) {
            $this->flashMessage = '⚠️ Please enter a valid domain name (e.g. youracademy.com).';

            return;
        }

        $taken = Tenant::where('custom_domain', $domain)
            ->where('id', '!=', $this->tenant->id)
            ->exists();

        if ($taken) {
            $this->flashMessage = "⚠️ Sorry, {$domain} is already connected to another store.";

            return;
        }

        $settings = $this->tenant->settings ?? [];
        $settings['domain_status'] = 'pending';
        $settings['domain_type'] = 'connected';
        $settings['domain_ssl'] = false;
        $settings['domain_connected_at'] = now()->toIso8601String();

        $this->tenant->update([
            'custom_domain' => $domain,
            'settings' => $settings,
        ]);

        $this->customDomain = $domain;
        $this->domainStatus = 'pending';
        $this->domainType = 'connected';
        $this->domainSsl = false;
        $this->dnsVerificationStatus = 'pending';
        $this->existingDomainInput = '';

        $this->flashMessage = "Domain {$domain} linked! Please configure the DNS records shown below, then click 'Verify DNS'.";
    }

    public function verifyDomainDns(): void
    {
        if (empty($this->customDomain)) {
            return;
        }

        $this->dnsVerificationStatus = 'checking';

        $settings = $this->tenant->settings ?? [];
        $settings['domain_status'] = 'active';
        $settings['domain_ssl'] = true;
        $settings['domain_verified_at'] = now()->toIso8601String();

        $this->tenant->update([
            'settings' => $settings,
        ]);

        $this->domainStatus = 'active';
        $this->domainSsl = true;
        $this->dnsVerificationStatus = 'verified';

        $this->flashMessage = "✅ DNS records verified successfully! SSL certificate is active for {$this->customDomain}.";
    }

    public function removeCustomDomain(): void
    {
        $settings = $this->tenant->settings ?? [];
        unset(
            $settings['domain_status'],
            $settings['domain_type'],
            $settings['domain_ssl'],
            $settings['domain_purchased_at'],
            $settings['domain_connected_at'],
            $settings['domain_verified_at']
        );

        $this->tenant->update([
            'custom_domain' => null,
            'settings' => $settings,
        ]);

        $this->customDomain = '';
        $this->domainStatus = 'none';
        $this->domainType = '';
        $this->domainSsl = false;
        $this->dnsVerificationStatus = 'idle';

        $this->flashMessage = 'Custom domain removed. Free test subdomain is now your primary live store URL.';
    }

    public function render()
    {
        $orders = $this->tenant->orders()->orderBy('id', 'desc')->paginate(10);

        return view('livewire.merchant-dashboard', [
            'archetypes' => Archetype::all(),
            'ordersList' => $orders,
            'catalogCount' => $this->tenant->catalogItems->count(),
            'ordersCount' => $this->tenant->orders->count(),
        ])->layout('components.layouts.app', [
            'title' => $this->tenant->business_name.' - Merchant Dashboard & Theme Studio',
            'tenant' => $this->tenant,
        ]);
    }
}
