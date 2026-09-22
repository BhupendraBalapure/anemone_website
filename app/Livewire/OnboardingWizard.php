<?php

namespace App\Livewire;

use App\Models\Archetype;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Livewire\Component;

class OnboardingWizard extends Component
{
    public $step = 1;

    // Step 1 Details
    public $businessName = '';
    public $city = '';
    public $phone = '';
    public $whatsappNumber = '';
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

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'businessName' => 'required|min:3',
                'city' => 'required|min:2',
                'phone' => 'required|min:10',
            ]);
            $this->whatsappNumber = $this->whatsappNumber ?: $this->phone;
            $this->step = 2;
        } elseif ($this->step === 2) {
            $this->step = 3;
        }
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
        if ($code === 'service') $this->brandColor = '#0284C7';
        elseif ($code === 'b2b') $this->brandColor = '#D97706';
        elseif ($code === 'food') $this->brandColor = '#EF4444';
        else $this->brandColor = '#10B981';
    }

    public function createStore()
    {
        $this->validate([
            'businessName' => 'required|min:3',
            'city' => 'required',
            'phone' => 'required',
        ]);

        $archetype = Archetype::where('code', $this->selectedArchetypeCode)->firstOrFail();
        $slug = Str::slug($this->businessName) . '-' . Str::lower(Str::random(4));

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
            ],
        ]);

        // Seed 4 rich default items for their chosen archetype
        if ($this->selectedArchetypeCode === 'service') {
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

        return redirect()->route('store.show', ['slug' => $slug]);
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
