<?php

use App\Livewire\OnboardingWizard;
use App\Livewire\StoreHome;
use Illuminate\Support\Facades\Route;

// Main SaaS Platform Welcome & Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Merchant Onboarding Wizard (Instant Store Creator)
Route::get('/onboarding', OnboardingWizard::class)->name('onboarding');

// Dynamic Livewire Storefront (Archetype-Aware)
Route::get('/store/{slug}', StoreHome::class)->name('store.show');
