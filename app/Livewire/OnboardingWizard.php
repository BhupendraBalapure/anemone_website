<?php

namespace App\Livewire;

use App\Models\Archetype;
use App\Models\Tenant;
use App\Models\User;
use App\Services\TemplateCatalog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class OnboardingWizard extends Component
{
    public $step = 1;

    // Step 1 Details
    public $businessName = '';

    public $websiteType = 'business_website'; // 'business_website', 'ecommerce', 'landing_page'

    public $businessCategory = '';

    public $city = '';

    public $phone = '';

    public $whatsappNumber = '';

    public $email = '';

    public $password = '';

    public $tagline = '';

    // Step 2 Archetype
    public $selectedArchetypeCode = 'retail';

    // Step 3 Design & Colors
    public $brandColor = '#10B981';

    public $selectedTheme = 'modern_clean';

    public function mount()
    {
        $this->brandColor = '#10B981';
    }

    public function selectWebsiteType($type)
    {
        $this->websiteType = $type;
        $this->applyRecommendedSettings();
    }

    public function updatedBusinessCategory($val)
    {
        $this->applyRecommendedSettings();
    }

    protected function applyRecommendedSettings(): void
    {
        if (empty($this->businessCategory)) {
            return;
        }

        $rec = TemplateCatalog::getRecommended($this->businessCategory, $this->websiteType);
        $this->selectedTheme = $rec['id'];
        $this->brandColor = $rec['suggested_color'];
        $this->selectedArchetypeCode = $rec['archetype'] ?? 'retail';
    }

    public function getRecommendedTemplateProperty(): ?array
    {
        if (empty($this->businessCategory)) {
            return null;
        }

        return TemplateCatalog::getRecommended($this->businessCategory, $this->websiteType);
    }

    public function nextStep()
    {
        return $this->createStore();
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function selectArchetype($code)
    {
        $this->selectedArchetypeCode = $code;
        // Suggest a matching brand color
        if ($code === 'hospitality') {
            $this->brandColor = '#E11D48';
        } elseif ($code === 'service') {
            $this->brandColor = '#0284C7';
        } elseif ($code === 'b2b') {
            $this->brandColor = '#D97706';
        } elseif ($code === 'food') {
            $this->brandColor = '#EF4444';
        } else {
            $this->brandColor = '#10B981';
        }
    }

    public function createStore()
    {
        $this->validate([
            'businessName' => 'required|min:3',
            'businessCategory' => 'required',
            'city' => 'required|min:2',
            'phone' => 'required|min:10',
            'websiteType' => 'required|in:business_website,ecommerce,landing_page',
        ], [
            'businessCategory.required' => 'Please select a business category',
            'websiteType.required' => 'Please choose what you want to create (Website, E-Commerce, or Landing Page)',
        ]);

        $this->whatsappNumber = $this->whatsappNumber ?: $this->phone;

        // Auto map archetype and theme based on business category and website type
        $rec = TemplateCatalog::getRecommended($this->businessCategory, $this->websiteType);
        $this->selectedTheme = $rec['id'];
        $this->brandColor = $rec['suggested_color'];
        $this->selectedArchetypeCode = $rec['archetype'] ?? 'retail';

        $archetype = Archetype::where('code', $this->selectedArchetypeCode)->firstOrFail();
        $slug = Str::slug($this->businessName).'-'.Str::lower(Str::random(4));

        $tenant = Tenant::create([
            'business_name' => $this->businessName,
            'slug' => $slug,
            'archetype_id' => $archetype->id,
            'active_theme' => $this->selectedTheme,
            'phone' => $this->phone,
            'whatsapp_number' => $this->whatsappNumber ?: $this->phone,
            'city' => $this->city,
            'tagline' => $this->tagline ?: "Welcome to {$this->businessName}",
            'brand_color' => $this->brandColor,
            'about_text' => "Serving quality products and services in {$this->city}.",
            'settings' => [
                'currency' => 'INR',
                'created_via' => 'livewire_wizard',
                'business_category' => $this->businessCategory,
                'website_type' => $this->websiteType,
            ],
        ]);

        // Seed 4 rich default items for their chosen archetype
        if ($this->selectedArchetypeCode === 'hospitality') {
            $tenant->catalogItems()->createMany([
                [
                    'title' => 'Deluxe King AC Room',
                    'category_name' => 'Rooms & Suites',
                    'price' => 2499.00,
                    'compare_at_price' => 3500.00,
                    'type' => 'service',
                    'duration_minutes' => 1440,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['room_type' => 'King Bed AC', 'occupancy' => '2 Adults'],
                ],
                [
                    'title' => 'Executive Suite with Private Balcony',
                    'category_name' => 'Rooms & Suites',
                    'price' => 4199.00,
                    'compare_at_price' => 5500.00,
                    'type' => 'service',
                    'duration_minutes' => 1440,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['room_type' => 'Executive Suite', 'occupancy' => '3 Adults'],
                ],
                [
                    'title' => 'Family Interconnected Suite (4 Guests)',
                    'category_name' => 'Family Stays',
                    'price' => 5499.00,
                    'compare_at_price' => 6999.00,
                    'type' => 'service',
                    'duration_minutes' => 1440,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['room_type' => 'Double Master', 'occupancy' => '4 Guests'],
                ],
                [
                    'title' => 'Standard Cozy Double Room',
                    'category_name' => 'Rooms & Suites',
                    'price' => 1799.00,
                    'compare_at_price' => 2200.00,
                    'type' => 'service',
                    'duration_minutes' => 1440,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['room_type' => 'Standard Double', 'occupancy' => '2 Adults'],
                ],
            ]);
        } elseif ($this->selectedArchetypeCode === 'service') {
            $tenant->catalogItems()->createMany([
                [
                    'title' => 'Comprehensive Consultation & Diagnostic Exam',
                    'category_name' => 'Consultations',
                    'price' => 500.00,
                    'compare_at_price' => 700.00,
                    'type' => 'service',
                    'duration_minutes' => 30,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['specialist' => 'Senior Practitioner', 'includes' => 'Diagnostic Assessment'],
                ],
                [
                    'title' => 'Advanced Clinical Scaling & Polishing',
                    'category_name' => 'Hygiene & Care',
                    'price' => 850.00,
                    'compare_at_price' => 1200.00,
                    'type' => 'service',
                    'duration_minutes' => 40,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['technique' => 'Ultrasonic Laser', 'session' => 'Single Sitting'],
                ],
                [
                    'title' => 'Specialized Treatment & Follow-up Session',
                    'category_name' => 'Treatments',
                    'price' => 1500.00,
                    'compare_at_price' => 2000.00,
                    'type' => 'service',
                    'duration_minutes' => 45,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['followup' => 'Included', 'sanitized' => '100% Sterile'],
                ],
                [
                    'title' => 'Comprehensive Rehabilitation & Therapy Session',
                    'category_name' => 'Therapy & Wellness',
                    'price' => 2500.00,
                    'compare_at_price' => 3200.00,
                    'type' => 'service',
                    'duration_minutes' => 60,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['session_type' => 'Full Consultation', 'report' => 'Digital Health Record'],
                ],
            ]);
        } elseif ($this->selectedArchetypeCode === 'b2b') {
            $tenant->catalogItems()->createMany([
                [
                    'title' => 'Industrial Precision CNC Component Batch',
                    'category_name' => 'Machined Parts',
                    'price' => 750.00,
                    'compare_at_price' => 950.00,
                    'type' => 'quote_item',
                    'min_order_qty' => 25,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1581092335397-9583fe92d232?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['material' => 'SS 316L', 'tolerance' => '±0.02 mm'],
                ],
                [
                    'title' => 'Heavy Duty Laser-Cut Sheet Metal Enclosures',
                    'category_name' => 'Fabrication',
                    'price' => 1850.00,
                    'compare_at_price' => 2200.00,
                    'type' => 'quote_item',
                    'min_order_qty' => 10,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['coating' => 'Powder Coated IP65', 'gauge' => '2.5 mm Mild Steel'],
                ],
                [
                    'title' => 'Custom Hydraulic Cylinder Assembly (Tie-Rod)',
                    'category_name' => 'Hydraulics',
                    'price' => 4200.00,
                    'type' => 'quote_item',
                    'min_order_qty' => 5,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['pressure' => '250 Bar', 'seal_kit' => 'Parker / NOK'],
                ],
            ]);
        } else {
            $tenant->catalogItems()->createMany([
                [
                    'title' => 'Premium Royal Basmati Rice (5 Kg Bag)',
                    'category_name' => 'Staples & Grains',
                    'price' => 380.00,
                    'compare_at_price' => 450.00,
                    'type' => 'product',
                    'in_stock' => true,
                    'stock_quantity' => 40,
                    'image_url' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['weight' => '5 Kg', 'origin' => 'Aged Himalayan'],
                ],
                [
                    'title' => 'Cold-Pressed Pure Desi Cow Ghee (1 Litre)',
                    'category_name' => 'Dairy & Oils',
                    'price' => 640.00,
                    'compare_at_price' => 720.00,
                    'type' => 'product',
                    'in_stock' => true,
                    'stock_quantity' => 25,
                    'image_url' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['grade' => 'A2 Bilona Pure', 'packaging' => 'Glass Jar'],
                ],
                [
                    'title' => 'Organic Stone-Ground Whole Wheat Flour (10 Kg)',
                    'category_name' => 'Flours & Grains',
                    'price' => 410.00,
                    'compare_at_price' => 480.00,
                    'type' => 'product',
                    'in_stock' => true,
                    'stock_quantity' => 35,
                    'image_url' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=600&auto=format&fit=crop&q=75',
                    'attributes' => ['fiber' => '100% Whole Grain', 'preservatives' => 'Zero'],
                ],
            ]);
        }

        // 👤 Create Merchant User Account for seamless future logins
        $merchantEmail = $this->email ?: (Str::slug($this->businessName).'-'.Str::lower(Str::random(3)).'@anemony.in');
        $merchantPassword = $this->password ?: 'password123';

        $user = User::firstOrCreate(
            ['email' => $merchantEmail],
            [
                'name' => $this->businessName,
                'phone' => $this->phone,
                'password' => Hash::make($merchantPassword),
                'role' => 'merchant',
                'tenant_id' => $tenant->id,
                'is_active' => true,
            ]
        );

        if (! $user->tenant_id) {
            $user->update(['tenant_id' => $tenant->id]);
        }

        // Auto login merchant session
        Auth::login($user);

        return redirect()->route('store.dashboard', ['slug' => $slug]);
    }

    public function render()
    {
        $archetypes = Archetype::all();
        $selectedArch = $archetypes->firstWhere('code', $this->selectedArchetypeCode);

        return view('livewire.onboarding-wizard', [
            'archetypes' => $archetypes,
            'selectedArch' => $selectedArch,
        ])->layout('components.layouts.app', [
            'title' => 'Launch Your Business Website in 60 Seconds',
        ]);
    }
}
