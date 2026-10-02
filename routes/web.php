<?php

use App\Livewire\Auth\Login;
use App\Livewire\MerchantDashboard;
use App\Livewire\OnboardingWizard;
use App\Livewire\StoreHome;
use App\Livewire\SuperAdminDashboard;
use App\Livewire\TemplateEditor;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', Login::class)->name('login');
Route::match(['get', 'post'], '/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

// Super Admin Platform Command Center
Route::get('/admin', SuperAdminDashboard::class)->name('admin.dashboard');

// Main SaaS Platform Welcome & Landing Page (or Custom Domain Storefront)
Route::get('/', function () {
    $tenant = app()->bound('current_tenant') ? app('current_tenant') : null;

    if ($tenant) {
        request()->route()->setParameter('slug', $tenant->slug);
        $instance = app('livewire')->new(StoreHome::class);

        return app()->call([$instance, '__invoke'], ['slug' => $tenant->slug]);
    }

    return view('welcome');
})->name('home');

// Merchant Onboarding Wizard (Instant Store Creator)
Route::get('/onboarding', OnboardingWizard::class)->name('onboarding');

// Dynamic Livewire Storefront (Archetype-Aware)
Route::get('/store/{slug}', StoreHome::class)->name('store.show');

// Merchant Template Studio & Store Management Dashboard
Route::get('/store/{slug}/dashboard', MerchantDashboard::class)->name('store.dashboard');

// Visual Template Editor (Shopify / Webflow Style Customizer)
Route::get('/store/{slug}/editor', TemplateEditor::class)->name('store.editor');

// 🧭 Dynamic Multi-Tenant Role-Based Dashboard Router
Route::get('/dashboard', function () {
    $currentTenant = app()->bound('current_tenant') ? app('current_tenant') : null;

    if (! Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    // 👑 1. Platform Super Admin -> Admin Command Center
    if ($user->isSuperAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    // 🏪 2. Merchant Store Owner -> Their Specific Store Studio Dashboard
    $targetTenant = $user->tenant ?: $currentTenant;
    if ($targetTenant) {
        return redirect()->route('store.dashboard', $targetTenant->slug);
    }

    // 🚀 3. Authenticated user without an active store -> Onboarding Wizard
    return redirect()->route('onboarding');
})->name('dashboard');
