<?php

namespace App\Livewire;

use App\Models\CatalogItem;
use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Support\Str;
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
        $this->tagline = $this->tenant->tagline ?? '';
        $this->phone = $this->tenant->phone ?? '';
        $this->whatsappNumber = $this->tenant->whatsapp_number ?? '';
        $this->city = $this->tenant->city ?? '';
        $this->address = $this->tenant->address ?? '';
        $this->aboutText = $this->tenant->about_text ?? '';
    }

    // --- TEMPLATE & THEME ACTIONS ---
    public function selectTheme($themeName)
    {
        $this->activeTheme = $themeName;
        $this->tenant->update(['active_theme' => $themeName]);
        $this->flashMessage = "Theme updated to " . ucfirst(str_replace('_', ' ', $themeName)) . "! Content preserved (Zero Data Loss).";
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

        $this->flashMessage = "Template layout and design preferences saved successfully!";
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
        $this->itemPrice = (float)$item->price;
        $this->itemComparePrice = (float)$item->compare_at_price;
        $this->itemDuration = $item->duration_minutes ?? 30;
        $this->itemMinQty = $item->min_order_qty ?? 10;
        $this->itemImageUrl = $item->image_url ?? '';
        $this->itemInStock = (bool)$item->in_stock;
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

    // --- PROFILE & SETTINGS ACTIONS ---
    public function saveProfile()
    {
        $this->validate([
            'businessName' => 'required|min:2',
            'phone' => 'required|min:10',
            'city' => 'required',
        ]);

        $this->tenant->update([
            'business_name' => $this->businessName,
            'tagline' => $this->tagline,
            'phone' => $this->phone,
            'whatsapp_number' => $this->whatsappNumber ?: $this->phone,
            'city' => $this->city,
            'address' => $this->address,
            'about_text' => $this->aboutText,
        ]);

        $this->flashMessage = "Store business details and Google SEO information updated!";
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
            if ($archetypeCode === 'service') {
                $this->tagline = "Leading Clinical Excellence & Compassionate Healthcare in {$city}";
            } elseif ($archetypeCode === 'b2b') {
                $this->tagline = "ISO Certified High-Precision Industrial Fabrication & Bulk Supply";
            } elseif ($archetypeCode === 'food') {
                $this->tagline = "Fresh Authentic Gourmet Delights & Express Delivery in {$city}";
            } else {
                $this->tagline = "Your Trusted Neighborhood Store for Daily Fresh Groceries in {$city}";
            }
            $this->tenant->update(['tagline' => $this->tagline]);
            $this->flashMessage = "AI generated high-converting tagline applied to your template!";
        } elseif ($type === 'about') {
            if ($archetypeCode === 'service') {
                $this->aboutText = "Welcome to {$name}, {$city}'s premier clinical practice. We combine modern diagnostic equipment with personalized, ethical medical consultation. Our mission is to provide transparent, painless, and dependable healthcare for every family in {$city}.";
            } elseif ($archetypeCode === 'b2b') {
                $this->aboutText = "At {$name}, we engineer high-tolerance mechanical components and custom metal fabrication for heavy industry and OEM partners. Operating out of {$city}, we maintain strict ISO quality controls, on-time batch dispatch, and full material certifications.";
            } else {
                $this->aboutText = "For years, {$name} has been the preferred destination for households in {$city}. We take pride in sourcing pure, farm-fresh produce and everyday staples at the best wholesale rates with express doorstep delivery.";
            }
            $this->tenant->update(['about_text' => $this->aboutText]);
            $this->flashMessage = "AI generated professional About Us story saved!";
        }

        $this->aiGenerating = false;
    }

    public function render()
    {
        $allTenants = Tenant::select('id', 'business_name', 'slug', 'city')->orderBy('id', 'desc')->get();
        $orders = $this->tenant->orders()->orderBy('id', 'desc')->paginate(10);

        return view('livewire.merchant-dashboard', [
            'allTenants' => $allTenants,
            'ordersList' => $orders,
            'catalogCount' => $this->tenant->catalogItems->count(),
            'ordersCount' => $this->tenant->orders->count(),
        ])->layout('components.layouts.app', [
            'title' => $this->tenant->business_name . ' - Merchant Dashboard & Theme Studio',
            'tenant' => $this->tenant,
        ]);
    }
}
