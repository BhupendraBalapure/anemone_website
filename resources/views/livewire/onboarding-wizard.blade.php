<div class="min-h-screen bg-slate-50 flex flex-col justify-center py-10 px-4 sm:px-6 lg:px-8">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-2xl text-center mb-8">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-tr from-amber-400 via-rose-500 to-purple-600 text-white shadow-lg shadow-purple-500/20 mb-3">
            <i class="fa-solid fa-rocket text-xl"></i>
        </div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Launch Your Digital Presence in 60 Seconds</h2>
        <p class="mt-2 text-sm text-slate-600">Category-aware website, auto local SEO, dynamic WhatsApp CTA, & digital billing.</p>
        
        <!-- Quick Setup Highlight Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-purple-50 text-purple-700 border border-purple-200/80 mb-2 shadow-2xs">
            <i class="fa-solid fa-bolt text-amber-500"></i> Quick 60-Second Setup • Customization in Dashboard
        </div>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
        <div class="bg-white py-8 px-6 shadow-xl rounded-3xl sm:px-10 border border-slate-200/80">
            
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center justify-between">
                    <span>Tell Us About Your Business</span>
                    <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2.5 py-1 rounded-full border border-purple-100">Step 1 of 1</span>
                </h3>

                <!-- 🎯 Website Type / Digital Goal Selection -->
                <div>
                    <label class="block text-xs font-bold text-slate-800 mb-2 flex items-center justify-between">
                        <span>What type of website do you want to build? *</span>
                        <span class="text-[11px] font-semibold text-purple-600">Tailors your layout &amp; templates</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <!-- 1. Complete Business Website -->
                        <button type="button" wire:click="selectWebsiteType('business_website')" class="p-3.5 rounded-2xl border-2 text-left transition cursor-pointer flex flex-col justify-between relative {{ $websiteType === 'business_website' ? 'border-purple-600 bg-purple-50/60 ring-2 ring-purple-600/10 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white' }}">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="w-8 h-8 rounded-xl {{ $websiteType === 'business_website' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-700' }} flex items-center justify-center text-sm shadow-2xs">
                                        <i class="fa-solid fa-globe"></i>
                                    </span>
                                    @if($websiteType === 'business_website')
                                    <i class="fa-solid fa-circle-check text-purple-600 text-sm"></i>
                                    @endif
                                </div>
                                <strong class="block text-xs font-black text-slate-900 mb-0.5">Business Website</strong>
                                <p class="text-[11px] text-slate-500 leading-snug">Full business presence with services, reviews, timings, SEO &amp; contact form.</p>
                            </div>
                            <div class="mt-2.5 pt-2 border-t border-slate-200/60 text-[10px] font-bold {{ $websiteType === 'business_website' ? 'text-purple-700' : 'text-slate-400' }}">
                                Hotels, Clinics, Salons, B2B
                            </div>
                        </button>

                        <!-- 2. E-Commerce Online Store -->
                        <button type="button" wire:click="selectWebsiteType('ecommerce')" class="p-3.5 rounded-2xl border-2 text-left transition cursor-pointer flex flex-col justify-between relative {{ $websiteType === 'ecommerce' ? 'border-purple-600 bg-purple-50/60 ring-2 ring-purple-600/10 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white' }}">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="w-8 h-8 rounded-xl {{ $websiteType === 'ecommerce' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-700' }} flex items-center justify-center text-sm shadow-2xs">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </span>
                                    @if($websiteType === 'ecommerce')
                                    <i class="fa-solid fa-circle-check text-purple-600 text-sm"></i>
                                    @endif
                                </div>
                                <strong class="block text-xs font-black text-slate-900 mb-0.5">E-Commerce Store</strong>
                                <p class="text-[11px] text-slate-500 leading-snug">Product catalog, shopping cart, discounts &amp; instant WhatsApp checkout.</p>
                            </div>
                            <div class="mt-2.5 pt-2 border-t border-slate-200/60 text-[10px] font-bold {{ $websiteType === 'ecommerce' ? 'text-purple-700' : 'text-slate-400' }}">
                                Retail, Grocery, Fashion, Food
                            </div>
                        </button>

                        <!-- 3. High-Converting Landing Page -->
                        <button type="button" wire:click="selectWebsiteType('landing_page')" class="p-3.5 rounded-2xl border-2 text-left transition cursor-pointer flex flex-col justify-between relative {{ $websiteType === 'landing_page' ? 'border-purple-600 bg-purple-50/60 ring-2 ring-purple-600/10 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white' }}">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="w-8 h-8 rounded-xl {{ $websiteType === 'landing_page' ? 'bg-purple-600 text-white' : 'bg-slate-100 text-slate-700' }} flex items-center justify-center text-sm shadow-2xs">
                                        <i class="fa-solid fa-bullhorn"></i>
                                    </span>
                                    @if($websiteType === 'landing_page')
                                    <i class="fa-solid fa-circle-check text-purple-600 text-sm"></i>
                                    @endif
                                </div>
                                <strong class="block text-xs font-black text-slate-900 mb-0.5">Landing Page</strong>
                                <p class="text-[11px] text-slate-500 leading-snug">High-converting 1-page funnel for instant call leads, WhatsApp inquiries &amp; offers.</p>
                            </div>
                            <div class="mt-2.5 pt-2 border-t border-slate-200/60 text-[10px] font-bold {{ $websiteType === 'landing_page' ? 'text-purple-700' : 'text-slate-400' }}">
                                Lead Gen, Promos, Services
                            </div>
                        </button>
                    </div>
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Business / Brand Name *</label>
                    <input wire:model="businessName" type="text" placeholder="e.g. Royal Bakery, Care Dental Clinic, Apex Textiles" class="input-field">
                    @error('businessName') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Business Category *</label>
                    <select wire:model.live="businessCategory" class="input-field cursor-pointer">
                        <option value="">Select your business category</option>
                        <option value="Beauty & Salons">Beauty & Salons</option>
                        <option value="Clinics & Hospitals">Clinics & Hospitals</option>
                        <option value="Coaching & Institutes">Coaching & Institutes</option>
                        <option value="Doctors & Specialists">Doctors & Specialists</option>
                        <option value="Herbal Care">Herbal Care</option>
                        <option value="Hotels & Motels">Hotels & Motels</option>
                        <option value="Manufacturers">Manufacturers</option>
                        <option value="Other Retail">Other Retail</option>
                        <option value="Other Services">Other Services</option>
                        <option value="Real Estate & Properties">Real Estate & Properties</option>
                        <option value="Restaurant & Cafes">Restaurant & Cafes</option>
                    </select>
                    @error('businessCategory') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror

                    <!-- 🎯 Live Category + Website Type Tailored Template Card -->
                    @if($this->recommendedTemplate)
                    <div class="mt-3 p-3.5 sm:p-4 rounded-2xl border-2 border-purple-200 bg-gradient-to-r from-purple-50/80 via-white to-purple-50/50 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-3 animate-fade-in">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 border border-purple-200 shadow-2xs">
                                <img src="{{ $this->recommendedTemplate['image_url'] }}" alt="{{ $this->recommendedTemplate['title'] }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-[10px] font-black uppercase tracking-wider text-purple-700 bg-purple-100/90 px-2 py-0.5 rounded-full flex items-center gap-1">
                                        <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i> Auto-Selected Template
                                    </span>
                                    <span class="text-[10px] font-bold text-slate-800 bg-white border border-slate-200 px-2 py-0.5 rounded-full shadow-2xs">
                                        {{ $this->recommendedTemplate['badge'] }}
                                    </span>
                                </div>
                                <strong class="text-xs font-black text-slate-900 block mt-1">
                                    {{ $this->recommendedTemplate['title'] }}
                                </strong>
                                <p class="text-[11px] text-slate-500 line-clamp-1">
                                    {{ $this->recommendedTemplate['subheadline'] }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 flex-wrap shrink-0">
                            @foreach(array_slice($this->recommendedTemplate['features'], 0, 2) as $feat)
                                <span class="bg-white border border-purple-200 text-purple-700 text-[10px] font-bold px-2 py-0.5 rounded-md shadow-2xs">
                                    {{ $feat }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">City / Town *</label>
                        <input wire:model="city" type="text" placeholder="e.g. Mumbai, Kanpur, Jaipur" class="input-field">
                        @error('city') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp Number *</label>
                        <input wire:model="phone" type="tel" placeholder="e.g. 9876543210" class="input-field">
                        @error('phone') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email Address (For Login)</label>
                        <input wire:model="email" type="email" placeholder="e.g. name@gmail.com" class="input-field">
                        <span class="text-[10px] text-slate-400">Optional: Auto-assigned if blank</span>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Login Password</label>
                        <input wire:model="password" type="text" placeholder="e.g. password123" class="input-field">
                        <span class="text-[10px] text-slate-400">Optional: Default is password123</span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Short Tagline (Optional)</label>
                    <input wire:model="tagline" type="text" placeholder="e.g. Fresh Daily Sweets & Catering Services" class="input-field">
                </div>

                <div class="pt-5 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="text-[11px] text-slate-500 flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-emerald-500"></i>
                        <span>Archetype, themes & colors are customizable in your <strong>Dashboard</strong></span>
                    </div>
                    <button wire:click="createStore" wire:loading.attr="disabled" class="btn-brand-gradient text-white font-bold text-sm px-7 py-3.5 rounded-xl shadow-lg shadow-purple-500/25 transition hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2 cursor-pointer w-full sm:w-auto">
                        <span wire:loading.remove class="flex items-center gap-2">
                            <i class="fa-solid fa-rocket"></i> Launch Store & Open Dashboard
                        </span>
                        <span wire:loading class="flex items-center gap-2">
                            <i class="fa-solid fa-spinner fa-spin"></i> Setting Up Store...
                        </span>
                    </button>
                </div>
            </div>

        </div>

        <!-- Live Demo Links -->
        <div class="mt-8 text-center text-xs text-slate-500">
            <span class="font-bold text-slate-700">Instant Demo Previews:</span>
            <a href="{{ route('store.show', 'sharma-kirana') }}" wire:navigate class="ml-2 text-rose-600 font-bold underline">Sharma Kirana (Retail)</a> |
            <a href="{{ route('store.show', 'care-dental-clinic') }}" wire:navigate class="ml-2 text-purple-600 font-bold underline">Care Dental (Clinic)</a> |
            <a href="{{ route('store.show', 'apex-steel-craft') }}" wire:navigate class="ml-2 text-amber-600 font-bold underline">Apex Steel (B2B Factory)</a>
        </div>
    </div>

</div>
