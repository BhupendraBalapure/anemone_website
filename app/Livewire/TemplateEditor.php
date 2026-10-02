<?php

namespace App\Livewire;

use App\Models\Tenant;
use Livewire\Component;
use Livewire\WithFileUploads;

class TemplateEditor extends Component
{
    use WithFileUploads;

    public $slug;

    public Tenant $tenant;

    public $activeTheme;

    // Dual-Mode Editor State ('simple' or 'advance')
    public $editorMode = 'simple';

    // Viewport & Editor State
    public $activeEditorTab = 'branding'; // 'branding', 'sections', 'hero', 'pricing', 'trust', 'inquiry'

    public $deviceMode = 'desktop'; // 'desktop', 'tablet', 'mobile'

    public $flashSuccess = '';

    // Business Identity
    public $businessName = '';

    public $whatsappNumber = '';

    // Branding & Logo
    public $logoUrl = '';

    public $logoFile = null;

    public $brandColor = '#2563EB';

    public $themeMode = 'dark'; // 'dark', 'light'

    // Layout sequence (Order of sections)
    public $sectionsOrder = ['hero', 'trust', 'catalog', 'reviews', 'inquiry', 'footer'];

    // Section active/deactive toggles
    public $sectionsVisibility = [
        'hero' => true,
        'trust' => true,
        'catalog' => true,
        'reviews' => true,
        'inquiry' => true,
        'footer' => true,
    ];

    // Hero Section Custom Content
    public $heroBackgroundImageUrl = '';

    public $heroBackgroundImageFile = null;

    public $heroBgDarkness = 60; // 0 to 100%

    public $heroImageUrl = '';

    public $heroImageFile = null;

    public $heroTickerText = '';

    public $heroBadge = '';

    public $heroSubBadge = '';

    public $heroHeadline = '';

    public $heroHighlight = '';

    public $heroSubheadline = '';

    public $heroStat1Value = '150+';

    public $heroStat1Label = 'Chapter Tests';

    public $heroStat2Value = '35 Full';

    public $heroStat2Label = 'AIR Mock Tests';

    public $heroStat3Value = '100%';

    public $heroStat3Label = 'Video Solutions';

    public $heroStat4Value = 'AIR Radar';

    public $heroStat4Label = 'Instant Rank';

    public $heroPrimaryCtaText = '';

    public $heroPrimaryCtaLink = '#services';

    public $heroSecondaryCtaText = '';

    public $heroSecondaryCtaLink = '';

    // Pricing & Urgency Bar
    public $pricingSalePrice = '';

    public $pricingRegularPrice = '';

    public $pricingDiscountTag = '';

    public $pricingOfferSubtext = '';

    // Trust Highlights (4 Pillars)
    public $trustHeading = 'Why Customers Trust Us';

    public $trustSubheading = '';

    public $trustCards = [];

    // Contact & Quick Inquiry
    public $inquiryTitle = 'Get In Touch';

    public $inquiryHeading = 'Visit Our Location or Message Us';

    public $inquiryButtonText = 'Send Inquiry via WhatsApp';

    public function mount($slug): void
    {
        $this->slug = $slug;
        $this->tenant = Tenant::with(['archetype', 'catalogItems'])->where('slug', $slug)->firstOrFail();
        $this->activeTheme = request()->query('theme', $this->tenant->active_theme ?? 'coaching_ecom_test_series');
        $this->brandColor = $this->tenant->brand_color ?? '#2563EB';

        $this->loadSettings();
    }

    public function loadSettings(): void
    {
        $settings = $this->tenant->settings ?? [];
        $customizations = $settings['template_customizations'] ?? [];
        $defaults = $this->getCategoryDefaults();

        // Dual-Mode & Identity
        $this->editorMode = $customizations['editor_mode'] ?? 'simple';
        $this->businessName = $this->tenant->business_name ?? '';
        $this->whatsappNumber = $this->tenant->whatsapp_number ?? ($this->tenant->phone ?? '');

        // Branding & Logo
        $this->logoUrl = $customizations['branding']['logo_url'] ?? ($settings['logo_url'] ?? '');
        $this->brandColor = $customizations['branding']['brand_color'] ?? ($customizations['styling']['brand_color'] ?? ($this->tenant->brand_color ?? $defaults['styling']['brand_color']));
        $this->themeMode = $customizations['branding']['theme_mode'] ?? ($customizations['styling']['theme_mode'] ?? $defaults['styling']['theme_mode']);

        // Sections Order
        if (! empty($customizations['sections_order']) && is_array($customizations['sections_order'])) {
            $this->sectionsOrder = $customizations['sections_order'];
        }

        // Sections Visibility
        if (! empty($customizations['sections_visibility']) && is_array($customizations['sections_visibility'])) {
            $this->sectionsVisibility = array_merge($this->sectionsVisibility, $customizations['sections_visibility']);
        }

        // Hero
        $this->heroBackgroundImageUrl = $customizations['hero']['background_image_url'] ?? ($customizations['hero']['image_url'] ?? ($defaults['hero']['background_image_url'] ?? ''));
        $this->heroImageUrl = $this->heroBackgroundImageUrl;
        $this->heroBgDarkness = (int) ($customizations['hero']['bg_darkness'] ?? 60);
        $this->heroTickerText = $customizations['hero']['ticker_text'] ?? ($defaults['hero']['ticker_text'] ?? 'NEET 2026: 42 Days Left • JEE Main All-India Mock 04 Live');
        $this->heroBadge = $customizations['hero']['badge'] ?? $defaults['hero']['badge'];
        $this->heroSubBadge = $customizations['hero']['sub_badge'] ?? ($defaults['hero']['sub_badge'] ?? 'AIR 1 NEET & AIR 16 JEE Adv Toppers Trained Here');
        $this->heroHeadline = $customizations['hero']['headline'] ?? $defaults['hero']['headline'];
        $this->heroHighlight = $customizations['hero']['highlight_text'] ?? $defaults['hero']['highlight_text'];
        $this->heroSubheadline = $customizations['hero']['subheadline'] ?? $defaults['hero']['subheadline'];
        $this->heroStat1Value = $customizations['hero']['stat1_value'] ?? ($defaults['hero']['stat1_value'] ?? '150+');
        $this->heroStat1Label = $customizations['hero']['stat1_label'] ?? ($defaults['hero']['stat1_label'] ?? 'Chapter Tests');
        $this->heroStat2Value = $customizations['hero']['stat2_value'] ?? ($defaults['hero']['stat2_value'] ?? '35 Full');
        $this->heroStat2Label = $customizations['hero']['stat2_label'] ?? ($defaults['hero']['stat2_label'] ?? 'AIR Mock Tests');
        $this->heroStat3Value = $customizations['hero']['stat3_value'] ?? ($defaults['hero']['stat3_value'] ?? '100%');
        $this->heroStat3Label = $customizations['hero']['stat3_label'] ?? ($defaults['hero']['stat3_label'] ?? 'Video Solutions');
        $this->heroStat4Value = $customizations['hero']['stat4_value'] ?? ($defaults['hero']['stat4_label'] ?? 'AIR Radar');
        $this->heroStat4Label = $customizations['hero']['stat4_label'] ?? ($defaults['hero']['stat4_label'] ?? 'Instant Rank');
        $this->heroPrimaryCtaText = $customizations['hero']['cta_primary_text'] ?? $defaults['hero']['cta_primary_text'];
        $this->heroPrimaryCtaLink = $customizations['hero']['cta_primary_link'] ?? $defaults['hero']['cta_primary_link'];
        $this->heroSecondaryCtaText = $customizations['hero']['cta_secondary_text'] ?? $defaults['hero']['cta_secondary_text'];
        $this->heroSecondaryCtaLink = $customizations['hero']['cta_secondary_link'] ?? $defaults['hero']['cta_secondary_link'];

        // Pricing
        $this->pricingSalePrice = $customizations['pricing']['sale_price'] ?? $defaults['pricing']['sale_price'];
        $this->pricingRegularPrice = $customizations['pricing']['regular_price'] ?? $defaults['pricing']['regular_price'];
        $this->pricingDiscountTag = $customizations['pricing']['discount_tag'] ?? $defaults['pricing']['discount_tag'];
        $this->pricingOfferSubtext = $customizations['pricing']['offer_subtext'] ?? $defaults['pricing']['offer_subtext'];

        // Trust
        $this->trustHeading = $customizations['trust']['heading'] ?? $defaults['trust']['heading'];
        $this->trustSubheading = $customizations['trust']['subheading'] ?? $defaults['trust']['subheading'];
        $this->trustCards = (! empty($customizations['trust']['cards']) && is_array($customizations['trust']['cards']))
            ? $customizations['trust']['cards']
            : $defaults['trust']['cards'];

        // Inquiry
        $this->inquiryTitle = $customizations['inquiry']['title'] ?? $defaults['inquiry']['title'];
        $this->inquiryHeading = $customizations['inquiry']['heading'] ?? $defaults['inquiry']['heading'];
        $this->inquiryButtonText = $customizations['inquiry']['button_text'] ?? $defaults['inquiry']['button_text'];
    }

    public function updatedLogoFile(): void
    {
        $this->validate([
            'logoFile' => 'image|max:4096', // 4MB Max
        ]);

        $path = $this->logoFile->store('logos', 'public');
        $this->logoUrl = asset('storage/'.$path);
        $this->saveCustomizations(showNotification: true);
        $this->flashSuccess = '✨ Logo uploaded and published live!';
    }

    public function removeLogo(): void
    {
        $this->logoUrl = '';
        $this->logoFile = null;
        $this->saveCustomizations(showNotification: true);
        $this->flashSuccess = '🗑️ Custom logo removed. Standard brand badge will show.';
    }

    public function updatedHeroBackgroundImageFile(): void
    {
        $this->validate([
            'heroBackgroundImageFile' => 'image|max:8192', // 8MB Max
        ]);

        $path = $this->heroBackgroundImageFile->store('hero-bg', 'public');
        $this->heroBackgroundImageUrl = asset('storage/'.$path);
        $this->heroImageUrl = $this->heroBackgroundImageUrl;
        $this->saveCustomizations(showNotification: false);
        $this->flashSuccess = '✨ Hero background image uploaded and published live!';
    }

    public function removeHeroBackgroundImage(): void
    {
        $this->heroBackgroundImageUrl = '';
        $this->heroImageUrl = '';
        $this->heroBackgroundImageFile = null;
        $this->heroImageFile = null;
        $this->saveCustomizations(showNotification: false);
        $this->flashSuccess = '🗑️ Background image removed. Original live default background restored.';
    }

    public function updatedHeroImageFile(): void
    {
        $this->validate([
            'heroImageFile' => 'image|max:8192', // 8MB Max
        ]);

        $path = $this->heroImageFile->store('hero-bg', 'public');
        $this->heroBackgroundImageUrl = asset('storage/'.$path);
        $this->heroImageUrl = $this->heroBackgroundImageUrl;
        $this->saveCustomizations(showNotification: false);
        $this->flashSuccess = '✨ Hero background image uploaded and published live!';
    }

    public function removeHeroImage(): void
    {
        $this->removeHeroBackgroundImage();
    }

    public function setEditorTab(string $tab): void
    {
        $this->activeEditorTab = $tab;
    }

    public function setEditorMode(string $mode): void
    {
        if (in_array($mode, ['simple', 'advance'], true)) {
            $this->editorMode = $mode;
            $this->saveCustomizations(showNotification: false);
        }
    }

    public function selectPresetHeroBg(string $url): void
    {
        $this->heroBackgroundImageUrl = $url;
        $this->heroImageUrl = $url;
        $this->saveCustomizations(showNotification: false);
        $this->flashSuccess = '🖼️ Background wallpaper applied to your hero section!';
    }

    public function applyContentPreset(string $presetKey): void
    {
        if ($presetKey === 'neet_jee') {
            $this->heroTickerText = '🔥 NEET 2026: 42 Days Left • JEE Main All-India Mock 04 Live Now';
            $this->heroBadge = 'Admissions Open for NEET & JEE 2026';
            $this->heroSubBadge = 'AIR 1 NEET & AIR 16 JEE Adv Toppers Trained Here';
            $this->heroHeadline = 'Master NTA-Pattern CBT Exams With Real-Time AIR Radar';
            $this->heroHighlight = 'Kota Faculty Edition';
            $this->heroSubheadline = 'Experience real examination hall pressure with full-length NTA interface simulator, instant percentile benchmarking, and video solutions.';
            $this->heroStat1Value = '150+';
            $this->heroStat1Label = 'Chapter Tests';
            $this->heroStat2Value = '35 Full';
            $this->heroStat2Label = 'AIR Mock Tests';
            $this->heroStat3Value = '100%';
            $this->heroStat3Label = 'Video Solutions';
            $this->heroStat4Value = 'AIR Radar';
            $this->heroStat4Label = 'Instant Rank';
            $this->heroPrimaryCtaText = 'Start Free Diagnostic Mock';
            $this->heroPrimaryCtaLink = '#services';
            $this->pricingSalePrice = '499';
            $this->pricingRegularPrice = '1999';
            $this->pricingDiscountTag = '75% OFF EARLY BIRD';
            $this->pricingOfferSubtext = 'Includes 150+ chapter tests, 35 AIR full tests & video solutions';
            $this->brandColor = '#2563EB';
        } elseif ($presetKey === 'upsc_foundation') {
            $this->heroTickerText = '🏛️ UPSC CSE 2026: Prelims GS + CSAT Mock Test Series Live';
            $this->heroBadge = 'Curated by Ex-Civil Servants & IAS Mentors';
            $this->heroSubBadge = '12,500+ Aspirants Practicing Nationwide';
            $this->heroHeadline = 'Crack UPSC Civil Services With Standard Examination Mocks';
            $this->heroHighlight = 'GS + CSAT Mastery';
            $this->heroSubheadline = 'Topic-wise NCERT drills, advanced current affairs papers, and comprehensive GS 1 & CSAT mocks aligned with latest UPSC question patterns.';
            $this->heroStat1Value = '60+';
            $this->heroStat1Label = 'GS & CSAT Mocks';
            $this->heroStat2Value = '100%';
            $this->heroStat2Label = 'UPSC Standard';
            $this->heroStat3Value = '12.5k';
            $this->heroStat3Label = 'Civil Aspirants';
            $this->heroStat4Value = '24/7';
            $this->heroStat4Label = 'Doubt Support';
            $this->heroPrimaryCtaText = 'Attempt Free GS Paper 1';
            $this->heroPrimaryCtaLink = '#services';
            $this->pricingSalePrice = '999';
            $this->pricingRegularPrice = '3999';
            $this->pricingDiscountTag = '75% OFF FOUNDATION';
            $this->pricingOfferSubtext = 'Detailed model answers, rank analysis & sectional test access';
            $this->brandColor = '#4F46E5';
        } elseif ($presetKey === 'crash_course') {
            $this->heroTickerText = '⚡ 45-Day High-Yield Revision Sprint: Score Boost Guarantee';
            $this->heroBadge = 'Last-Mile Revision Sprint 2026';
            $this->heroSubBadge = 'Boost 80+ Marks In Final 45 Days';
            $this->heroHeadline = 'High-Yield Most Repeated Concepts & Speed-Test Modules';
            $this->heroHighlight = 'Rapid Score Booster';
            $this->heroSubheadline = 'Focus only on high-probability questions, time-saving tricks, daily formula tests, and rapid error analysis to maximize your score.';
            $this->heroStat1Value = '30';
            $this->heroStat1Label = 'High-Yield Mocks';
            $this->heroStat2Value = '+85';
            $this->heroStat2Label = 'Avg Score Boost';
            $this->heroStat3Value = '25,000+';
            $this->heroStat3Label = 'Active Students';
            $this->heroStat4Value = '10 min';
            $this->heroStat4Label = 'Daily Speed Drill';
            $this->heroPrimaryCtaText = 'Enroll in Revision Sprint';
            $this->heroPrimaryCtaLink = '#services';
            $this->pricingSalePrice = '299';
            $this->pricingRegularPrice = '1199';
            $this->pricingDiscountTag = '75% OFF SPRINT';
            $this->pricingOfferSubtext = 'Instant access to formula sheets, 30 speed mocks & answer keys';
            $this->brandColor = '#059669';
        }

        $this->saveCustomizations(showNotification: true);
        $this->flashSuccess = '✨ Preset applied across your storefront!';
    }

    public function setDeviceMode(string $mode): void
    {
        $this->deviceMode = $mode;
    }

    public function moveSectionUp(int $index): void
    {
        if ($index <= 0 || $index >= count($this->sectionsOrder)) {
            return;
        }

        $temp = $this->sectionsOrder[$index - 1];
        $this->sectionsOrder[$index - 1] = $this->sectionsOrder[$index];
        $this->sectionsOrder[$index] = $temp;
        $this->flashSuccess = 'Layout updated: moved section up.';
        $this->saveCustomizations(showNotification: false);
    }

    public function moveSectionDown(int $index): void
    {
        if ($index < 0 || $index >= count($this->sectionsOrder) - 1) {
            return;
        }

        $temp = $this->sectionsOrder[$index + 1];
        $this->sectionsOrder[$index + 1] = $this->sectionsOrder[$index];
        $this->sectionsOrder[$index] = $temp;
        $this->flashSuccess = 'Layout updated: moved section down.';
        $this->saveCustomizations(showNotification: false);
    }

    public function toggleSectionVisibility(string $sectionKey): void
    {
        if (isset($this->sectionsVisibility[$sectionKey])) {
            $this->sectionsVisibility[$sectionKey] = ! $this->sectionsVisibility[$sectionKey];
            $status = $this->sectionsVisibility[$sectionKey] ? 'Activated' : 'Deactivated';
            $this->flashSuccess = "Section {$sectionKey} is now {$status}.";
            $this->saveCustomizations(showNotification: false);
        }
    }

    public function updated(string $propertyName): void
    {
        if (in_array($propertyName, ['activeEditorTab', 'deviceMode', 'flashSuccess', 'logoFile', 'heroImageFile', 'heroBackgroundImageFile'])) {
            return;
        }

        $this->saveCustomizations(showNotification: false);
    }

    public function saveCustomizations(bool $showNotification = true): void
    {
        $settings = $this->tenant->settings ?? [];

        $settings['logo_url'] = $this->logoUrl;

        $bgUrl = $this->heroBackgroundImageUrl ?: $this->heroImageUrl;

        $settings['template_customizations'] = [
            'editor_mode' => $this->editorMode,
            'branding' => [
                'logo_url' => $this->logoUrl,
                'brand_color' => $this->brandColor,
                'theme_mode' => $this->themeMode,
            ],
            'styling' => [
                'brand_color' => $this->brandColor,
                'theme_mode' => $this->themeMode,
            ],
            'sections_order' => $this->sectionsOrder,
            'sections_visibility' => $this->sectionsVisibility,
            'hero' => [
                'background_image_url' => $bgUrl,
                'image_url' => $bgUrl,
                'bg_darkness' => (int) $this->heroBgDarkness,
                'ticker_text' => $this->heroTickerText,
                'badge' => $this->heroBadge,
                'sub_badge' => $this->heroSubBadge,
                'headline' => $this->heroHeadline,
                'highlight_text' => $this->heroHighlight,
                'subheadline' => $this->heroSubheadline,
                'stat1_value' => $this->heroStat1Value,
                'stat1_label' => $this->heroStat1Label,
                'stat2_value' => $this->heroStat2Value,
                'stat2_label' => $this->heroStat2Label,
                'stat3_value' => $this->heroStat3Value,
                'stat3_label' => $this->heroStat3Label,
                'stat4_value' => $this->heroStat4Value,
                'stat4_label' => $this->heroStat4Label,
                'cta_primary_text' => $this->heroPrimaryCtaText,
                'cta_primary_link' => $this->heroPrimaryCtaLink,
                'cta_secondary_text' => $this->heroSecondaryCtaText,
                'cta_secondary_link' => $this->heroSecondaryCtaLink,
            ],
            'pricing' => [
                'sale_price' => $this->pricingSalePrice,
                'regular_price' => $this->pricingRegularPrice,
                'discount_tag' => $this->pricingDiscountTag,
                'offer_subtext' => $this->pricingOfferSubtext,
            ],
            'trust' => [
                'heading' => $this->trustHeading,
                'subheading' => $this->trustSubheading,
                'cards' => $this->trustCards,
            ],
            'inquiry' => [
                'title' => $this->inquiryTitle,
                'heading' => $this->inquiryHeading,
                'button_text' => $this->inquiryButtonText,
            ],
        ];

        $tenantData = [
            'settings' => $settings,
            'brand_color' => $this->brandColor,
        ];
        if (! empty($this->businessName)) {
            $tenantData['business_name'] = $this->businessName;
        }
        if (! empty($this->whatsappNumber)) {
            $tenantData['whatsapp_number'] = $this->whatsappNumber;
        }

        $this->tenant->update($tenantData);

        if ($showNotification) {
            $this->flashSuccess = '✅ All template changes saved and published live successfully!';
        }

        $this->dispatch('refresh-preview');
    }

    public function resetToDefaults(): void
    {
        $settings = $this->tenant->settings ?? [];
        unset($settings['template_customizations']);
        unset($settings['logo_url']);
        $this->tenant->update(['settings' => $settings]);

        $this->sectionsOrder = ['hero', 'trust', 'catalog', 'reviews', 'inquiry', 'footer'];
        $this->sectionsVisibility = [
            'hero' => true,
            'trust' => true,
            'catalog' => true,
            'reviews' => true,
            'inquiry' => true,
            'footer' => true,
        ];
        $this->loadSettings();

        $this->flashSuccess = '🔄 Template reset to original defaults.';
        $this->dispatch('refresh-preview');
    }

    public function getCategoryDefaults(): array
    {
        $cat = $this->tenant->business_category ?? ($this->tenant->settings['business_category'] ?? 'Coaching & Institutes');
        $city = $this->tenant->city ?: 'Your Area';

        return match ($cat) {
            'Beauty & Salons' => [
                'hero' => [
                    'badge' => '⭐ 5-Star Rated Luxury Beauty & Hair Lounge',
                    'headline' => 'Transform Your Style with Signature Beauty',
                    'highlight_text' => 'Glow & Glamour',
                    'subheadline' => 'Award-winning certified hair stylists, organic skincare rituals, precision balayage, and luxurious bridal lounge in '.$city.'.',
                    'cta_primary_text' => 'Book Appointment Slot',
                    'cta_primary_link' => '#services',
                    'cta_secondary_text' => 'WhatsApp Consultation',
                    'cta_secondary_link' => $this->tenant->getWhatsAppUrl('Hi, I want to book a beauty appointment.'),
                ],
                'pricing' => [
                    'sale_price' => '1499',
                    'regular_price' => '3999',
                    'discount_tag' => '60% OFF FIRST VISIT',
                    'offer_subtext' => 'Includes Free Scalp Analysis & Hair Spa Ritual',
                ],
                'trust' => [
                    'heading' => 'Why Clients Love Our Salon Lounge',
                    'subheading' => 'Setting The Standard For Luxury Styling in '.$city,
                    'cards' => [
                        ['title' => 'Master Stylists & Artists', 'desc' => 'Internationally certified beauty artists specializing in precision haircuts and HD makeup.', 'icon' => 'fa-scissors'],
                        ['title' => 'Organic & Cruelty-Free', 'desc' => 'Dermatologist-tested, 100% vegan, and toxin-free luxury products used on your hair & skin.', 'icon' => 'fa-leaf'],
                        ['title' => 'Private VIP Lounges', 'desc' => 'Peaceful ambient lighting, acoustic privacy, recliner chairs, and aromatherapy.', 'icon' => 'fa-couch'],
                        ['title' => 'Autoclaved Hygiene', 'desc' => 'Individually sealed and autoclaved instruments, sanitized linens, and single-use kits.', 'icon' => 'fa-shield-halved'],
                    ],
                ],
                'inquiry' => [
                    'title' => 'Book Your Appointment',
                    'heading' => 'Visit Our Salon or Book Slot',
                    'button_text' => 'Confirm Slot via WhatsApp',
                ],
                'styling' => [
                    'brand_color' => '#DB2777',
                    'theme_mode' => 'dark',
                ],
            ],

            'Clinics & Hospitals', 'Doctors & Specialists' => [
                'hero' => [
                    'badge' => '🏥 NABH Accredited & Verified Specialists',
                    'headline' => 'Advanced Multispecialty Patient Care & Consultations',
                    'highlight_text' => 'Compassionate Healing',
                    'subheadline' => 'State-of-the-art diagnostic facilities, senior specialist doctors, zero-wait OPD scheduling, and 24/7 emergency support in '.$city.'.',
                    'cta_primary_text' => 'Book OPD Consultation',
                    'cta_primary_link' => '#services',
                    'cta_secondary_text' => 'Direct WhatsApp Desk',
                    'cta_secondary_link' => $this->tenant->getWhatsAppUrl('Hi Doctor, I need to book a clinical consultation.'),
                ],
                'pricing' => [
                    'sale_price' => '499',
                    'regular_price' => '1200',
                    'discount_tag' => 'SPECIAL OPD PASS',
                    'offer_subtext' => 'Includes Full Vitals Checkup & Digital Prescription',
                ],
                'trust' => [
                    'heading' => 'Why Patients Trust Our Medical Care',
                    'subheading' => 'Advanced Clinical Excellence in '.$city,
                    'cards' => [
                        ['title' => 'Licensed Super-Specialists', 'desc' => 'Experienced MD/MS doctors dedicated to accurate diagnosis and empathetic patient care.', 'icon' => 'fa-user-doctor'],
                        ['title' => 'Digital Diagnostic Labs', 'desc' => 'Equipped with computer-calibrated analyzers for rapid and accurate health reports.', 'icon' => 'fa-microscope'],
                        ['title' => 'Zero-Wait OPD Scheduling', 'desc' => 'Guaranteed queue reservation to ensure you are attended on time without stress.', 'icon' => 'fa-calendar-check'],
                        ['title' => '24/7 Emergency Care', 'desc' => 'Immediate triage and dedicated staff for round-the-clock critical medical assistance.', 'icon' => 'fa-truck-medical'],
                    ],
                ],
                'inquiry' => [
                    'title' => 'Quick Medical Inquiry',
                    'heading' => 'Connect With Our Health Desk',
                    'button_text' => 'Message Doctor on WhatsApp',
                ],
                'styling' => [
                    'brand_color' => '#0284C7',
                    'theme_mode' => 'light',
                ],
            ],

            'Restaurant & Cafes' => [
                'hero' => [
                    'badge' => '🍽️ Pure Ingredients & Wood-Fired Delights',
                    'headline' => 'Authentic Handcrafted Flavors & Gourmet Dining',
                    'highlight_text' => 'Fresh & Piping Hot',
                    'subheadline' => 'Secret family recipes, slow-cooked royal delicacies, open kitchen standards, and instant 30-minute delivery across '.$city.'.',
                    'cta_primary_text' => 'Explore Food Menu',
                    'cta_primary_link' => '#services',
                    'cta_secondary_text' => 'Order Food on WhatsApp',
                    'cta_secondary_link' => $this->tenant->getWhatsAppUrl('Hi, I want to order food for delivery.'),
                ],
                'pricing' => [
                    'sale_price' => '599',
                    'regular_price' => '1299',
                    'discount_tag' => 'COMBO FEAST 50% OFF',
                    'offer_subtext' => 'Free Dessert & Express Doorstep Delivery Included',
                ],
                'trust' => [
                    'heading' => 'Why Foodies Love Dining With Us',
                    'subheading' => 'Uncompromising Taste & Hygiene in '.$city,
                    'cards' => [
                        ['title' => 'Farm-Fresh Produce', 'desc' => 'Daily sourced organic vegetables, cold-pressed spices, and non-GMO pantry staples.', 'icon' => 'fa-carrot'],
                        ['title' => 'Live Open Kitchen', 'desc' => 'Cooked in sparkling clean, sanitized, and temperature-controlled stainless kitchens.', 'icon' => 'fa-utensils'],
                        ['title' => '30-Min Fast Delivery', 'desc' => 'Piping hot, leak-proof food containers with insulated delivery bags.', 'icon' => 'fa-motorcycle'],
                        ['title' => 'Master Chef Curations', 'desc' => 'Crafted by seasoned culinary masters with deep heritage and distinctive flavors.', 'icon' => 'fa-hat-chef'],
                    ],
                ],
                'inquiry' => [
                    'title' => 'Table Reservations & Party Orders',
                    'heading' => 'Reserve A Table or Order Catering',
                    'button_text' => 'Reserve via WhatsApp',
                ],
                'styling' => [
                    'brand_color' => '#EA580C',
                    'theme_mode' => 'dark',
                ],
            ],

            'Hotels & Motels' => [
                'hero' => [
                    'badge' => '🌟 4.98 Superhost Rated Boutique Stay',
                    'headline' => 'Luxury Boutique Suites & Scenic Heritage Resort',
                    'highlight_text' => 'Serene Hospitality',
                    'subheadline' => 'Spacious sunlit suites, mountain and garden views, infinity pool access, and authentic royal hospitality in '.$city.'.',
                    'cta_primary_text' => 'Check Room Availability',
                    'cta_primary_link' => '#services',
                    'cta_secondary_text' => 'WhatsApp Concierge Desk',
                    'cta_secondary_link' => $this->tenant->getWhatsAppUrl('Hi, I want to inquire about room booking dates.'),
                ],
                'pricing' => [
                    'sale_price' => '2499',
                    'regular_price' => '5999',
                    'discount_tag' => 'DIRECT BOOKING 55% OFF',
                    'offer_subtext' => 'Complimentary Buffet Breakfast & Early Check-in',
                ],
                'trust' => [
                    'heading' => 'Why Guests Choose Our Property',
                    'subheading' => 'Premier Stay Experience in '.$city,
                    'cards' => [
                        ['title' => '24/7 Room Service', 'desc' => 'Dedicated floor butler, express laundry, and multi-cuisine in-room dining.', 'icon' => 'fa-bell-concierge'],
                        ['title' => 'High-Speed Fiber Wi-Fi', 'desc' => '300 Mbps uninterrupted internet across every suite and business lounge.', 'icon' => 'fa-wifi'],
                        ['title' => 'Complimentary Breakfast', 'desc' => 'Chef-curated live counters with fresh juices, bakery, and regional delicacies.', 'icon' => 'fa-mug-hot'],
                        ['title' => 'Prime Central Location', 'desc' => 'Minutes away from prime transit hubs, commercial centers, and scenic vistas.', 'icon' => 'fa-map-location-dot'],
                    ],
                ],
                'inquiry' => [
                    'title' => 'Concierge & Booking Inquiry',
                    'heading' => 'Plan Your Stay or Group Event',
                    'button_text' => 'Inquire via WhatsApp',
                ],
                'styling' => [
                    'brand_color' => '#D97706',
                    'theme_mode' => 'light',
                ],
            ],

            'Real Estate & Properties' => [
                'hero' => [
                    'badge' => '🏛️ RERA Approved & Bank Pre-Sanctioned',
                    'headline' => 'Ultra-Luxury High-Rise Residences & Villas',
                    'highlight_text' => 'Prime Locations',
                    'subheadline' => 'Smart homes with Italian marble, clubhouse amenities, 70% open green landscapes, and direct developer pricing in '.$city.'.',
                    'cta_primary_text' => 'Download Floor Plan & Brochure',
                    'cta_primary_link' => '#services',
                    'cta_secondary_text' => 'Schedule Site Visit',
                    'cta_secondary_link' => $this->tenant->getWhatsAppUrl('Hi, I want to schedule a site visit for property viewing.'),
                ],
                'pricing' => [
                    'sale_price' => '45 Lakh',
                    'regular_price' => '55 Lakh',
                    'discount_tag' => 'PRE-LAUNCH BENEFIT',
                    'offer_subtext' => 'Zero Stamp Duty & Free Modular Kitchen Voucher',
                ],
                'trust' => [
                    'heading' => 'Why Homebuyers Invest With Us',
                    'subheading' => 'Trusted Real Estate Landmark in '.$city,
                    'cards' => [
                        ['title' => '100% RERA Approved', 'desc' => 'Clear land titles, transparent documentation, and bank escrow safety.', 'icon' => 'fa-stamp'],
                        ['title' => 'Prime High-Growth Corridors', 'desc' => 'Located near upcoming metro routes, top international schools, and tech parks.', 'icon' => 'fa-city'],
                        ['title' => 'Zero Brokerage', 'desc' => 'Direct developer inventory without hidden charges or middleman commissions.', 'icon' => 'fa-handshake'],
                        ['title' => 'Flexible Payment Plans', 'desc' => '10:90 construction-linked milestones with all leading bank home loan tie-ups.', 'icon' => 'fa-credit-card'],
                    ],
                ],
                'inquiry' => [
                    'title' => 'Property Consultation Desk',
                    'heading' => 'Book Free Site Visit Cab or Callback',
                    'button_text' => 'Connect With Sales Manager',
                ],
                'styling' => [
                    'brand_color' => '#0F766E',
                    'theme_mode' => 'dark',
                ],
            ],

            'Manufacturers' => [
                'hero' => [
                    'badge' => '🏭 Direct OEM Factory Supply & ISO Certified',
                    'headline' => 'Precision Industrial Engineering, Spares & Fasteners',
                    'highlight_text' => 'B2B Wholesale MOQ',
                    'subheadline' => 'Bulk supply of precision parts, mill test certificates, GST tax invoicing, and pan-India freight logistics from '.$city.'.',
                    'cta_primary_text' => 'Request Bulk Quotation',
                    'cta_primary_link' => '#services',
                    'cta_secondary_text' => 'WhatsApp B2B Desk',
                    'cta_secondary_link' => $this->tenant->getWhatsAppUrl('Hi, I need a bulk quote for manufacturing supplies.'),
                ],
                'pricing' => [
                    'sale_price' => '99',
                    'regular_price' => '250',
                    'discount_tag' => 'TIER 1 WHOLESALE RATE',
                    'offer_subtext' => 'Minimum Order: 50 Units • 100% GST Invoiced',
                ],
                'trust' => [
                    'heading' => 'Why Industrial Clients Rely On Our Mills',
                    'subheading' => 'High-Precision Manufacturing Infrastructure in '.$city,
                    'cards' => [
                        ['title' => 'Direct Factory Pricing', 'desc' => 'Eliminate distributor markups with transparent factory gate volume pricing.', 'icon' => 'fa-industry'],
                        ['title' => 'Mill Test Certified', 'desc' => 'Every batch tested for tensile strength, metallurgy grade, and dimensional tolerance.', 'icon' => 'fa-certificate'],
                        ['title' => '100% GST Invoicing', 'desc' => 'Seamless B2B tax compliance with full input tax credit (ITC) support.', 'icon' => 'fa-file-invoice'],
                        ['title' => 'Pan-India Freight', 'desc' => 'Tie-ups with surface express cargo for safe and punctual doorstep unloading.', 'icon' => 'fa-truck'],
                    ],
                ],
                'inquiry' => [
                    'title' => 'B2B Commercial Inquiry',
                    'heading' => 'Submit Technical Specs & RFQ',
                    'button_text' => 'Send RFQ via WhatsApp',
                ],
                'styling' => [
                    'brand_color' => '#475569',
                    'theme_mode' => 'dark',
                ],
            ],

            'Herbal Care' => [
                'hero' => [
                    'badge' => '🌿 100% Forest Sourced & AYUSH Certified',
                    'headline' => 'Pure Ayurvedic Tailams, Churnas & Immunity Rasayanas',
                    'highlight_text' => 'Ancient Vedic Healing',
                    'subheadline' => 'Cold-pressed medicated oils, certified organic herbs, classical wellness remedies, and express doorstep delivery across '.$city.'.',
                    'cta_primary_text' => 'Shop Herbal Catalog',
                    'cta_primary_link' => '#services',
                    'cta_secondary_text' => 'Consult Vaidya on WhatsApp',
                    'cta_secondary_link' => $this->tenant->getWhatsAppUrl('Hi Vaidya Ji, I want to consult for Ayurvedic wellness.'),
                ],
                'pricing' => [
                    'sale_price' => '399',
                    'regular_price' => '999',
                    'discount_tag' => '60% AYURVEDA PASS',
                    'offer_subtext' => 'Free Dosha Consultation & Herbal Tea Sample Included',
                ],
                'trust' => [
                    'heading' => 'Why Customers Trust Our Herbal Remedies',
                    'subheading' => 'Authentic Holistic Health in '.$city,
                    'cards' => [
                        ['title' => '100% Forest Harvested', 'desc' => 'Sourced directly from native tribal cooperatives and organic botanical gardens.', 'icon' => 'fa-spa'],
                        ['title' => 'Vedic Classical Shastras', 'desc' => 'Prepared strictly following authentic Charaka & Sushruta Samhita methods.', 'icon' => 'fa-mortar-pestle'],
                        ['title' => 'AYUSH & GMP Certified', 'desc' => 'Zero parabens, artificial fragrance, or heavy metals; third-party lab verified.', 'icon' => 'fa-award'],
                        ['title' => 'Free Expert Advice', 'desc' => 'Qualified Ayurvedic doctors available for personalized Prakriti consultation.', 'icon' => 'fa-hand-holding-heart'],
                    ],
                ],
                'inquiry' => [
                    'title' => 'Vaidya Consultation Desk',
                    'heading' => 'Discuss Your Health Condition',
                    'button_text' => 'Chat with Vaidya on WhatsApp',
                ],
                'styling' => [
                    'brand_color' => '#16A34A',
                    'theme_mode' => 'light',
                ],
            ],

            'Other Services' => [
                'hero' => [
                    'badge' => '⚡ 60-Minute Rapid Doorstep Assistance',
                    'headline' => 'Professional Doorstep Repairs, Deep Cleaning & AMC',
                    'highlight_text' => 'Verified Technicians',
                    'subheadline' => 'Transparent fixed pricing, background-checked certified specialists, genuine spare parts, and 30-day service warranty in '.$city.'.',
                    'cta_primary_text' => 'Book Home Service',
                    'cta_primary_link' => '#services',
                    'cta_secondary_text' => 'Quick WhatsApp Booking',
                    'cta_secondary_link' => $this->tenant->getWhatsAppUrl('Hi, I need urgent doorstep service assistance.'),
                ],
                'pricing' => [
                    'sale_price' => '299',
                    'regular_price' => '799',
                    'discount_tag' => 'INSPECTION PASS 60% OFF',
                    'offer_subtext' => 'Includes Complete Diagnostic Check & 30-Day Warranty',
                ],
                'trust' => [
                    'heading' => 'Why Families Count On Our Services',
                    'subheading' => 'Reliable & Guaranteed Doorstep Solutions in '.$city,
                    'cards' => [
                        ['title' => 'Background-Checked Pros', 'desc' => 'Police-verified, skill-tested, and experienced technicians in uniform.', 'icon' => 'fa-user-shield'],
                        ['title' => 'Upfront Rate Cards', 'desc' => 'Zero surprises; rate card shared beforehand with itemized GST invoices.', 'icon' => 'fa-receipt'],
                        ['title' => '30-Day Service Warranty', 'desc' => 'Complete peace of mind; free revisit if anything isn’t working 100%.', 'icon' => 'fa-shield-heart'],
                        ['title' => 'On-Time Arrival Guarantee', 'desc' => 'We reach your doorstep at the chosen time slot without endless delays.', 'icon' => 'fa-clock'],
                    ],
                ],
                'inquiry' => [
                    'title' => 'Urgent Service Booking',
                    'heading' => 'Book Service Slot or Ask Query',
                    'button_text' => 'Book via WhatsApp',
                ],
                'styling' => [
                    'brand_color' => '#7C3AED',
                    'theme_mode' => 'light',
                ],
            ],

            'Other Retail' => [
                'hero' => [
                    'badge' => '🛍️ 100% Genuine Certified & Express Delivery',
                    'headline' => 'Trending Everyday Essentials, Fashion & Tech Store',
                    'highlight_text' => 'Best Value Deals',
                    'subheadline' => 'Handpicked premium lifestyle items, manufacturer warranty, easy 7-day exchange, and instant WhatsApp ordering in '.$city.'.',
                    'cta_primary_text' => 'Explore Product Catalog',
                    'cta_primary_link' => '#services',
                    'cta_secondary_text' => 'Order via WhatsApp',
                    'cta_secondary_link' => $this->tenant->getWhatsAppUrl('Hi, I want to inquire about product ordering.'),
                ],
                'pricing' => [
                    'sale_price' => '699',
                    'regular_price' => '1799',
                    'discount_tag' => 'SPECIAL LAUNCH 60% OFF',
                    'offer_subtext' => 'Free Doorstep Courier Dispatch on Orders Above ₹499',
                ],
                'trust' => [
                    'heading' => 'Why Customers Shop With Us',
                    'subheading' => 'Your Trusted Retail Hub in '.$city,
                    'cards' => [
                        ['title' => '100% Genuine Guarantee', 'desc' => 'Direct from verified distributors with brand seals and warranty cards.', 'icon' => 'fa-badge-check'],
                        ['title' => 'Instant WhatsApp Checkout', 'desc' => 'Order with a single tap on WhatsApp; pay via UPI or Cash on Delivery.', 'icon' => 'fa-brands fa-whatsapp'],
                        ['title' => 'Express Courier Dispatch', 'desc' => 'Packaged carefully and shipped within 24 hours with tracking updates.', 'icon' => 'fa-truck-fast'],
                        ['title' => 'Hassle-Free 7-Day Exchange', 'desc' => 'Not satisfied? Quick replacement or store credit without long arguments.', 'icon' => 'fa-arrow-rotate-left'],
                    ],
                ],
                'inquiry' => [
                    'title' => 'Retail Customer Support',
                    'heading' => 'Ask About Stock, Sizes or Orders',
                    'button_text' => 'Chat on WhatsApp',
                ],
                'styling' => [
                    'brand_color' => '#2563EB',
                    'theme_mode' => 'light',
                ],
            ],

            default => [ // Coaching & Institutes
                'hero' => [
                    'media_type' => 'simulator',
                    'image_url' => '',
                    'ticker_text' => 'NEET 2026: 42 Days Left • JEE Main All-India Mock 04 Live',
                    'badge' => 'All-India Mock Test Series & CBT Examination Portal',
                    'sub_badge' => '🏆 AIR 1 NEET & AIR 16 JEE Adv Toppers Trained Here',
                    'headline' => 'Real NTA/UPSC CBT Test Series & Mentorship',
                    'highlight_text' => 'Rank Predictor',
                    'subheadline' => 'Experience the exact NTA computer screen interface with real-time countdown timers, question palettes, and instant percentile benchmarks in '.$city.'.',
                    'stat1_value' => '150+',
                    'stat1_label' => 'Chapter Tests',
                    'stat2_value' => '35 Full',
                    'stat2_label' => 'AIR Mock Tests',
                    'stat3_value' => '100%',
                    'stat3_label' => 'Video Solutions',
                    'stat4_value' => 'AIR Radar',
                    'stat4_label' => 'Instant Rank',
                    'cta_primary_text' => 'Enroll in Test Series',
                    'cta_primary_link' => '#services',
                    'cta_secondary_text' => 'Free Diagnostic Test',
                    'cta_secondary_link' => $this->tenant->getWhatsAppUrl('Hi, I want to attempt a free diagnostic mock test.'),
                ],
                'pricing' => [
                    'sale_price' => '499',
                    'regular_price' => '1999',
                    'discount_tag' => '75% OFF TODAY',
                    'offer_subtext' => 'Includes Free Express Courier Home Delivery in 48 Hours',
                ],
                'trust' => [
                    'heading' => 'Why Students & Parents Trust Us',
                    'subheading' => 'Setting The Standard For Educational Excellence in '.$city,
                    'cards' => [
                        ['title' => 'Kota & Ex-IITian Master Mentors', 'desc' => 'Learn directly from star faculties with 15+ years of experience producing AIR 1-100 ranks.', 'icon' => 'fa-trophy'],
                        ['title' => 'NTA Pattern CBT Engine', 'desc' => 'Exact test simulation with negative marking radar and instant All-India percentile benchmark.', 'icon' => 'fa-crosshairs'],
                        ['title' => '24/7 WhatsApp Doubt Desk', 'desc' => 'Instant step-by-step doubt resolution with average turnaround under 15 minutes by mentors.', 'icon' => 'fa-brands fa-whatsapp'],
                        ['title' => 'Pan-India 48-Hr Express Courier', 'desc' => 'Spiral notes, hardbound question banks, and pen-drives dispatched in waterproof packaging.', 'icon' => 'fa-truck-fast'],
                    ],
                ],
                'inquiry' => [
                    'title' => 'Admission & Course Inquiry',
                    'heading' => 'Visit Our Center or Message Us',
                    'button_text' => 'Send Inquiry via WhatsApp',
                ],
                'styling' => [
                    'brand_color' => '#2563EB',
                    'theme_mode' => 'dark',
                ],
            ],
        };
    }

    public function render()
    {
        return view('livewire.template-editor')->layout('layouts.app');
    }
}
