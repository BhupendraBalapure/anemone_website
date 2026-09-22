<?php

use App\Livewire\MerchantDashboard;
use App\Livewire\OnboardingWizard;
use App\Livewire\StoreHome;
use App\Models\Tenant;
use Illuminate\Support\Facades\Route;

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

// Global Dashboard Shortcut (Redirects to latest store)
Route::get('/dashboard', function () {
    $latest = Tenant::latest('id')->first();
    return redirect()->route('store.dashboard', $latest ? $latest->slug : 'sharma-kirana');
})->name('dashboard');
