<?php

namespace App\Livewire;

use App\Models\CatalogItem;
use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Livewire\Component;

class StoreHome extends Component
{
    public $slug;
    public Tenant $tenant;
    public $archetype;
    public $selectedCategory = 'all';
    public $search = '';

    // Cart state for Retail & Food
    public $cart = []; // [itemId => ['title' => ..., 'price' => ..., 'qty' => ...]]
    public $showCartModal = false;
    public $customerName = '';
    public $customerPhone = '';
    public $customerAddress = '';

    // Booking state for Healthcare & Services
    public $showBookingModal = false;
    public $selectedService = null;
    public $bookingDate = '';
    public $bookingSlot = '11:00 AM';
    public $patientName = '';
    public $patientPhone = '';

    // Quote state for B2B
    public $showQuoteModal = false;
    public $selectedQuoteItem = null;
    public $quoteQty = 10;
    public $quoteCompany = '';
    public $quoteNotes = '';

    // Quick Contact & Message Inquiry State
    public $inquiryName = '';
    public $inquiryPhone = '';
    public $inquiryMessage = '';

    // Live Theme Switcher (Zero Data Loss Demonstration)
    public $currentTheme = 'modern_clean'; // modern_clean, minimal_card, dark_luxury

    public $flashMessage = '';

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->tenant = Tenant::with(['archetype', 'catalogItems'])->where('slug', $slug)->firstOrFail();
        $this->archetype = $this->tenant->archetype;
        $this->currentTheme = $this->tenant->active_theme ?? 'modern_clean';
        $this->bookingDate = now()->addDay()->format('Y-m-d');
    }

    // --- CART ACTIONS (Retail & Food) ---
    public function addToCart($itemId)
    {
        $item = $this->tenant->catalogItems->firstWhere('id', $itemId);
        if (!$item) return;

        if (isset($this->cart[$itemId])) {
            $this->cart[$itemId]['qty'] += 1;
        } else {
            $this->cart[$itemId] = [
                'id' => $item->id,
                'title' => $item->title,
                'price' => (float)$item->price,
                'qty' => 1,
                'image' => $item->image_url,
            ];
        }

        $this->flashMessage = "Added {$item->title} to cart!";
    }

    public function updateQty($itemId, $delta)
    {
        if (!isset($this->cart[$itemId])) return;

        $this->cart[$itemId]['qty'] += $delta;
        if ($this->cart[$itemId]['qty'] <= 0) {
            unset($this->cart[$itemId]);
        }
    }

    public function removeFromCart($itemId)
    {
        unset($this->cart[$itemId]);
    }

    public function getCartTotalProperty(): float
    {
        return array_reduce($this->cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['qty']);
        }, 0.0);
    }

    public function getCartCountProperty(): int
    {
        return array_reduce($this->cart, function ($carry, $item) {
            return $carry + $item['qty'];
        }, 0);
    }

    public function checkoutWhatsApp()
    {
        if (empty($this->cart)) return;

        $lines = ["🛍️ *New Order from {$this->tenant->business_name}*"];
        $lines[] = "---------------------------";
        foreach ($this->cart as $item) {
            $lines[] = "• {$item['title']} x {$item['qty']} = ₹" . ($item['price'] * $item['qty']);
        }
        $lines[] = "---------------------------";
        $lines[] = "*Total Amount:* ₹" . $this->cartTotal;

        if ($this->customerName) {
            $lines[] = "*Customer:* {$this->customerName}";
        }
        if ($this->customerAddress) {
            $lines[] = "*Delivery Address:* {$this->customerAddress}";
        }

        // Save into Orders Table
        Order::create([
            'tenant_id' => $this->tenant->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(6)),
            'type' => 'order',
            'customer_name' => $this->customerName ?: 'WhatsApp Customer',
            'customer_phone' => $this->customerPhone ?: 'Via WhatsApp',
            'customer_address' => $this->customerAddress,
            'total_amount' => $this->cartTotal,
            'payment_status' => 'unpaid',
            'payment_method' => 'whatsapp',
            'status' => 'new',
            'items_payload' => array_values($this->cart),
        ]);

        $text = implode("\n", $lines);
        $url = $this->tenant->getWhatsAppUrl($text);

        $this->cart = [];
        $this->showCartModal = false;

        return redirect()->away($url);
    }

    // --- BOOKING ACTIONS (Healthcare & Services) ---
    public function openBookingModal($serviceId)
    {
        $this->selectedService = $this->tenant->catalogItems->firstWhere('id', $serviceId);
        $this->showBookingModal = true;
    }

    public function confirmBooking()
    {
        $this->validate([
            'patientName' => 'required|min:2',
            'patientPhone' => 'required|min:10',
            'bookingDate' => 'required|date',
            'bookingSlot' => 'required',
        ]);

        Order::create([
            'tenant_id' => $this->tenant->id,
            'order_number' => 'BKG-' . strtoupper(Str::random(6)),
            'type' => 'booking',
            'customer_name' => $this->patientName,
            'customer_phone' => $this->patientPhone,
            'total_amount' => (float)$this->selectedService->price,
            'payment_status' => 'unpaid',
            'payment_method' => 'pay_at_clinic',
            'status' => 'confirmed',
            'items_payload' => [[
                'id' => $this->selectedService->id,
                'title' => $this->selectedService->title,
                'price' => $this->selectedService->price,
                'duration' => $this->selectedService->duration_minutes,
            ]],
            'metadata' => [
                'appointment_date' => $this->bookingDate,
                'appointment_slot' => $this->bookingSlot,
            ],
        ]);

        $this->showBookingModal = false;
        $this->flashMessage = "Appointment confirmed for {$this->patientName} on {$this->bookingDate} at {$this->bookingSlot}!";
    }

    // --- QUOTE ACTIONS (B2B & Manufacturing) ---
    public function openQuoteModal($itemId)
    {
        $this->selectedQuoteItem = $this->tenant->catalogItems->firstWhere('id', $itemId);
        $this->quoteQty = $this->selectedQuoteItem->min_order_qty ?: 10;
        $this->showQuoteModal = true;
    }

    public function submitQuoteRequest()
    {
        $this->validate([
            'customerName' => 'required|min:2',
            'customerPhone' => 'required|min:10',
            'quoteQty' => 'required|numeric|min:1',
        ]);

        Order::create([
            'tenant_id' => $this->tenant->id,
            'order_number' => 'QUO-' . strtoupper(Str::random(6)),
            'type' => 'quote_inquiry',
            'customer_name' => $this->customerName,
            'customer_phone' => $this->customerPhone,
            'total_amount' => (float)($this->selectedQuoteItem->price * $this->quoteQty),
            'payment_status' => 'unpaid',
            'status' => 'new',
            'items_payload' => [[
                'id' => $this->selectedQuoteItem->id,
                'title' => $this->selectedQuoteItem->title,
                'requested_qty' => $this->quoteQty,
                'unit_price' => $this->selectedQuoteItem->price,
            ]],
            'metadata' => [
                'company' => $this->quoteCompany,
                'notes' => $this->quoteNotes,
            ],
        ]);

        $this->showQuoteModal = false;
        $this->flashMessage = "Quote inquiry received! Our representative will contact {$this->customerPhone} shortly.";
    }

    // --- QUICK CONTACT & INQUIRY ---
    public function submitInquiry()
    {
        $this->validate([
            'inquiryName' => 'required|min:2',
            'inquiryPhone' => 'required|min:10',
            'inquiryMessage' => 'required|min:5',
        ]);

        Order::create([
            'tenant_id' => $this->tenant->id,
            'order_number' => 'INQ-' . strtoupper(Str::random(6)),
            'type' => 'inquiry',
            'customer_name' => $this->inquiryName,
            'customer_phone' => $this->inquiryPhone,
            'total_amount' => 0,
            'payment_status' => 'unpaid',
            'status' => 'new',
            'metadata' => [
                'message' => $this->inquiryMessage,
            ],
        ]);

        $text = "👋 Hello {$this->tenant->business_name}, I have an inquiry:\n\n*From:* {$this->inquiryName} ({$this->inquiryPhone})\n*Message:* {$this->inquiryMessage}";
        $url = $this->tenant->getWhatsAppUrl($text);

        $this->inquiryName = '';
        $this->inquiryPhone = '';
        $this->inquiryMessage = '';
        $this->flashMessage = "Thank you! Your inquiry was sent successfully.";

        return redirect()->away($url);
    }

    // --- THEME SWITCHER (Zero Data Loss) ---
    public function switchTheme($themeName)
    {
        $this->currentTheme = $themeName;
        $this->tenant->update(['active_theme' => $themeName]);
        $this->flashMessage = "Theme switched to " . ucfirst(str_replace('_', ' ', $themeName)) . " instantly without data loss!";
    }

    public function render()
    {
        $query = $this->tenant->catalogItems();

        if ($this->selectedCategory !== 'all') {
            $query->where('category_name', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%");
        }

        $items = $query->get();
        $categories = $this->tenant->catalogItems()->pluck('category_name')->unique()->filter()->values();

        return view('livewire.store-home', [
            'items' => $items,
            'categories' => $categories,
        ])->layout('components.layouts.app', [
            'title' => $this->tenant->business_name . ' - ' . $this->tenant->tagline,
            'tenant' => $this->tenant,
        ]);
    }
}
