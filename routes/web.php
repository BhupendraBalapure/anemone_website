<?php

use App\Livewire\Auth\Login;
use App\Livewire\MerchantDashboard;
use App\Livewire\OnboardingWizard;
use App\Livewire\StoreHome;
use App\Livewire\SuperAdminDashboard;
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

// Main SaaS Platform Welcome & Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Merchant Onboarding Wizard (Instant Store Creator)
Route::get('/onboarding', OnboardingWizard::class)->name('onboarding');

// Dynamic Livewire Storefront (Archetype-Aware)
Route::get('/store/{slug}', StoreHome::class)->name('store.show');

// Merchant Template Studio & Store Management Dashboard
Route::get('/store/{slug}/dashboard', MerchantDashboard::class)->name('store.dashboard');

// 🧭 Dynamic Multi-Tenant Role-Based Dashboard Router
Route::get('/dashboard', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    // 👑 1. Platform Super Admin -> Admin Command Center
    if ($user->isSuperAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    // 🏪 2. Merchant Store Owner -> Their Specific Store Studio Dashboard
    if ($user->tenant) {
        return redirect()->route('store.dashboard', $user->tenant->slug);
    }

    // 🚀 3. Authenticated user without an active store -> Onboarding Wizard
    return redirect()->route('onboarding');
})->name('dashboard');
