<?php

namespace App\Livewire;

use App\Models\Archetype;
use App\Models\Tenant;
use App\Services\TemplateCatalog;
use Livewire\Component;

class MerchantDashboard extends Component
{
    public $slug;

    public Tenant $tenant;

    public $activeTab = 'templates'; // templates, catalog, profile, orders, ai_studio

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
        ];

        return $templates[$this->previewTemplateId] ?? $templates['doctor_clinic'];
    }

    public function applyTemplate($themeName, $suggestedColor = null)
    {
        $this->activeTheme = $themeName;
        $updateData = ['active_theme' => $themeName];
        if ($suggestedColor) {
            $this->brandColor = $suggestedColor;
            $updateData['brand_color'] = $suggestedColor;
        }

        $themeToArchetype = [
            'hotel_business' => 'hospitality',
            'motel_highway' => 'hospitality',
            'hotel_boutique' => 'hospitality',
            'hotel_grand_luxury' => 'hospitality',
            'hotel_resort' => 'hospitality',
            'hotel_budget' => 'hospitality',
            'hotel_family' => 'hospitality',
            'modern_clean' => 'hospitality',
            'dark_luxury' => 'hospitality',
            'minimal_card' => 'hospitality',
            'nature_retreat' => 'hospitality',
            'coastal_beach' => 'hospitality',
            'heritage_haveli' => 'hospitality',
            'mountain_chalet' => 'hospitality',
            'wellness_sanctuary' => 'hospitality',
            'doctor_clinic' => 'service',
            'salon_wellness' => 'service',
            'real_estate' => 'service',
            'food_restaurant' => 'food',
            'restaurant_cafe' => 'food',
            'retail_store' => 'retail',
            'retail_supermarket' => 'retail',
            'b2b_industrial' => 'b2b',
            'b2b_wholesale' => 'b2b',
        ];

        if (isset($themeToArchetype[$themeName])) {
            $arch = Archetype::where('code', $themeToArchetype[$themeName])->first();
            if ($arch) {
                $updateData['archetype_id'] = $arch->id;
            }
        }

        $this->tenant->update($updateData);
        $this->tenant->load('archetype');
        $this->showTemplatePreviewModal = false;
        $this->flashMessage = "Template '".ucwords(str_replace('_', ' ', $themeName))."' applied successfully to your live website with zero data loss!";
    }

    public function selectTheme($themeName)
    {
        $this->activeTheme = $themeName;
        $this->tenant->update(['active_theme' => $themeName]);
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
