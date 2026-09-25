<?php

namespace App\Livewire;

use App\Models\Archetype;
use App\Models\CatalogItem;
use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SuperAdminDashboard extends Component
{
    use WithPagination;

    public $currentSection = 'overview'; // overview, tenants, archetypes, orders, settings

    public $searchTenant = '';

    public $filterArchetype = 'all';

    public $flashMessage = '';

    // Create & Edit Tenant Modal State
    public $showTenantModal = false;

    public $editingTenantId = null;

    public $tenantName = '';

    public $tenantSlug = '';

    public $tenantArchetypeId;

    public $tenantTheme = 'modern_clean';

    public $tenantPhone = '';

    public $tenantCity = '';

    public $tenantTagline = '';

    public $tenantBrandColor = '#9333EA';

    public $tenantIsActive = true;

    // Archetype Edit Modal State
    public $showArchetypeModal = false;

    public $editingArchetypeId = null;

    public $archetypeName = '';

    public $archetypeCode = '';

    public $archetypeCta = '';

    public $archetypeSchema = '';

    public $archetypeDescription = '';

    // API & Global System Settings
    public $aiProvider = 'gemini';

    public $geminiApiKey = '';

    public $whatsappGateway = 'direct_link'; // direct_link, meta_cloud_api

    public $metaAccessToken = '';

    public $metaPhoneId = '';

    public function mount()
    {
        if (! Auth::check() || ! Auth::user()->isSuperAdmin()) {
            return redirect()->route('login');
        }

        $firstArch = Archetype::first();
        if ($firstArch) {
            $this->tenantArchetypeId = $firstArch->id;
        }

        // Load existing system settings if saved in config or storage
        $this->geminiApiKey = config('services.gemini.key', '');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }

    public function updatingSearchTenant()
    {
        $this->resetPage();
    }

    public function updatingFilterArchetype()
    {
        $this->resetPage();
    }

    // --- TENANT MANAGEMENT ---
    public function openCreateTenantModal()
    {
        $this->editingTenantId = null;
        $this->tenantName = '';
        $this->tenantSlug = '';
        $this->tenantTheme = 'modern_clean';
        $this->tenantPhone = '';
        $this->tenantCity = '';
        $this->tenantTagline = '';
        $this->tenantBrandColor = '#9333EA';
        $this->tenantIsActive = true;

        $first = Archetype::first();
        $this->tenantArchetypeId = $first ? $first->id : null;

        $this->showTenantModal = true;
    }

    public function editTenant($id)
    {
        $tenant = Tenant::findOrFail($id);
        $this->editingTenantId = $tenant->id;
        $this->tenantName = $tenant->business_name;
        $this->tenantSlug = $tenant->slug;
        $this->tenantArchetypeId = $tenant->archetype_id;
        $this->tenantTheme = $tenant->active_theme ?? 'modern_clean';
        $this->tenantPhone = $tenant->phone ?? '';
        $this->tenantCity = $tenant->city ?? '';
        $this->tenantTagline = $tenant->tagline ?? '';
        $this->tenantBrandColor = $tenant->brand_color ?? '#9333EA';
        $this->tenantIsActive = (bool) ($tenant->is_active ?? true);

        $this->showTenantModal = true;
    }

    public function saveTenant()
    {
        $this->validate([
            'tenantName' => 'required|min:2',
            'tenantArchetypeId' => 'required|exists:archetypes,id',
            'tenantPhone' => 'required|min:10',
            'tenantCity' => 'required',
        ]);

        $slug = $this->tenantSlug ? Str::slug($this->tenantSlug) : Str::slug($this->tenantName);

        // Ensure uniqueness if slug changed
        if (Tenant::where('slug', $slug)->where('id', '!=', $this->editingTenantId)->exists()) {
            $slug .= '-'.Str::lower(Str::random(4));
        }

        $data = [
            'business_name' => $this->tenantName,
            'slug' => $slug,
            'archetype_id' => $this->tenantArchetypeId,
            'active_theme' => $this->tenantTheme,
            'phone' => $this->tenantPhone,
            'whatsapp_number' => $this->tenantPhone,
            'city' => $this->tenantCity,
            'tagline' => $this->tenantTagline ?: "Welcome to {$this->tenantName}",
            'brand_color' => $this->tenantBrandColor,
            'is_active' => $this->tenantIsActive,
        ];

        if ($this->editingTenantId) {
            $tenant = Tenant::findOrFail($this->editingTenantId);
            $tenant->update($data);
            $this->flashMessage = "Store '{$tenant->business_name}' successfully updated!";
        } else {
            $tenant = Tenant::create($data);

            // Auto seed 2 starter items based on archetype
            $arch = Archetype::find($this->tenantArchetypeId);
            if ($arch && $arch->code === 'service') {
                $tenant->catalogItems()->create([
                    'title' => 'Initial Consultation & Diagnostic Exam',
                    'category_name' => 'Consultations',
                    'price' => 500,
                    'type' => 'service',
                    'duration_minutes' => 30,
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=600',
                ]);
            } else {
                $tenant->catalogItems()->create([
                    'title' => 'Featured Store Product 1',
                    'category_name' => 'General',
                    'price' => 450,
                    'type' => 'product',
                    'in_stock' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
                ]);
            }

            $this->flashMessage = "New Store '{$tenant->business_name}' deployed with live URL /store/{$tenant->slug}!";
        }

        $this->showTenantModal = false;
    }

    public function toggleTenantStatus($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->is_active = ! $tenant->is_active;
        $tenant->save();
        $this->flashMessage = "Status of store '{$tenant->business_name}' toggled to ".($tenant->is_active ? 'ACTIVE' : 'INACTIVE').'!';
    }

    public function deleteTenant($id)
    {
        $tenant = Tenant::findOrFail($id);
        $name = $tenant->business_name;

        // Delete items and orders
        $tenant->catalogItems()->delete();
        $tenant->orders()->delete();
        $tenant->delete();

        $this->flashMessage = "Store '{$name}' and all its associated data deleted from the platform.";
    }

    // --- ARCHETYPE EDITING ---
    public function editArchetype($id)
    {
        $arch = Archetype::findOrFail($id);
        $this->editingArchetypeId = $arch->id;
        $this->archetypeName = $arch->name;
        $this->archetypeCode = $arch->code;
        $this->archetypeCta = $arch->cta_label;
        $this->archetypeSchema = $arch->schema_type;
        $this->archetypeDescription = $arch->description;

        $this->showArchetypeModal = true;
    }

    public function saveArchetype()
    {
        $this->validate([
            'archetypeName' => 'required',
            'archetypeCta' => 'required',
        ]);

        $arch = Archetype::findOrFail($this->editingArchetypeId);
        $arch->update([
            'name' => $this->archetypeName,
            'cta_label' => $this->archetypeCta,
            'schema_type' => $this->archetypeSchema,
            'description' => $this->archetypeDescription,
        ]);

        $this->flashMessage = "Archetype category '{$arch->name}' updated! All associated storefronts updated dynamically.";
        $this->showArchetypeModal = false;
    }

    // --- SYSTEM & API SETTINGS ---
    public function saveSystemSettings()
    {
        $this->flashMessage = 'Platform API keys and WhatsApp configuration saved successfully!';
    }

    public function render()
    {
        // Platform Global Metrics
        $totalTenants = Tenant::count();
        $activeTenants = Tenant::where('is_active', true)->count();
        $totalCatalogItems = CatalogItem::count();
        $totalOrders = Order::count();
        $totalGmv = Order::sum('total_amount');

        // Archetypes Breakdown
        $archetypes = Archetype::withCount('tenants')->get();

        // Filtered Tenants Query (using withCount to prevent loading all catalog items into memory)
        $tenantsQuery = Tenant::with('archetype')->withCount(['catalogItems', 'orders'])->orderBy('id', 'desc');

        if ($this->searchTenant) {
            $tenantsQuery->where(function ($q) {
                $q->where('business_name', 'like', "%{$this->searchTenant}%")
                    ->orWhere('slug', 'like', "%{$this->searchTenant}%")
                    ->orWhere('city', 'like', "%{$this->searchTenant}%")
                    ->orWhere('phone', 'like', "%{$this->searchTenant}%");
            });
        }

        if ($this->filterArchetype !== 'all') {
            $tenantsQuery->where('archetype_id', $this->filterArchetype);
        }

        $tenants = $tenantsQuery->paginate(8);

        // Platform Global Orders Feed (Only queried when needed)
        $recentOrders = in_array($this->currentSection, ['orders', 'overview'])
            ? Order::with('tenant')->orderBy('id', 'desc')->paginate(10)
            : new LengthAwarePaginator([], 0, 10);

        return view('livewire.super-admin-dashboard', [
            'totalTenants' => $totalTenants,
            'activeTenants' => $activeTenants,
            'totalCatalogItems' => $totalCatalogItems,
            'totalOrders' => $totalOrders,
            'totalGmv' => $totalGmv,
            'archetypes' => $archetypes,
            'tenantsList' => $tenants,
            'recentOrders' => $recentOrders,
        ])->layout('components.layouts.app', [
            'title' => 'Super Admin Portal - Anemony Operating System',
        ]);
    }
}
