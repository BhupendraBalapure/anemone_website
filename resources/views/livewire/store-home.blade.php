<div class="{{ $currentTheme === 'dark_luxury' ? 'bg-zinc-950 text-zinc-100 min-h-screen' : ($currentTheme === 'minimal_card' ? 'bg-neutral-100 text-neutral-900 min-h-screen' : 'bg-slate-50 text-slate-800 min-h-screen') }}">

    <!-- 🌟 Top Demo & Theme Switcher Bar (Zero Data Loss Demonstration) -->
    <div class="bg-slate-950 text-white text-xs py-2 px-4 shadow-md sticky top-0 z-50 flex flex-wrap items-center justify-between gap-2 border-b border-purple-950">
        <div class="flex items-center gap-2">
            <span class="bg-gradient-to-r from-rose-500 to-purple-600 text-white font-bold px-2.5 py-0.5 rounded-full text-[10px] uppercase tracking-wider">
                <i class="fa-solid fa-layer-group text-[9px] mr-1"></i> Archetype: {{ strtoupper($archetype->code) }}
            </span>
            <span class="font-medium text-slate-300 hidden md:inline">Website Live Preview (Zero Data Loss Architecture)</span>
        </div>
        <div class="flex items-center gap-1.5 sm:gap-2">
            <span class="text-slate-400 text-[11px] hidden sm:inline">Theme:</span>
            <button wire:click="switchTheme('modern_clean')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer {{ $currentTheme === 'modern_clean' ? 'bg-gradient-to-r from-rose-500 to-purple-600 text-white shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                Modern Clean
            </button>
            <button wire:click="switchTheme('minimal_card')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer {{ $currentTheme === 'minimal_card' ? 'bg-gradient-to-r from-rose-500 to-purple-600 text-white shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                Minimal Card
            </button>
            <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer {{ $currentTheme === 'dark_luxury' ? 'bg-gradient-to-r from-rose-500 to-purple-600 text-white shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                Dark Luxury
            </button>
            <a href="{{ route('store.dashboard', $tenant->slug) }}" wire:navigate class="ml-2 px-3 py-1 rounded-lg bg-purple-600 hover:bg-purple-500 text-white font-bold text-xs flex items-center gap-1.5 shadow">
                <i class="fa-solid fa-gauge text-[10px]"></i> Dashboard & Theme Studio
            </a>
            <a href="{{ route('onboarding') }}" wire:navigate class="ml-1 btn-brand-gradient text-white px-3 py-1 rounded-lg font-bold text-xs flex items-center gap-1 shadow">
                <i class="fa-solid fa-plus text-[10px]"></i> New Store
            </a>
        </div>
    </div>

    <!-- ⚡ Flash Message Notification -->
    @if($flashMessage)
    <div class="bg-emerald-600 text-white px-4 py-2.5 text-center text-sm font-semibold flex items-center justify-center gap-2 shadow sticky top-9 z-40">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ $flashMessage }}</span>
        <button wire:click="$set('flashMessage', '')" class="ml-3 text-emerald-200 hover:text-white cursor-pointer">&times;</button>
    </div>
    @endif

    <!-- 🧭 Main Website Navbar -->
    <nav class="sticky top-9 z-30 backdrop-blur-md border-b transition-colors {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900/95 border-zinc-800 text-white' : ($currentTheme === 'minimal_card' ? 'bg-white/95 border-neutral-200 text-neutral-900' : 'bg-white/95 border-slate-200 text-slate-900') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between gap-4">
            
            <!-- Brand Logo & Name -->
            <a href="#hero" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-lg shadow-md" style="background: linear-gradient(135deg, {{ $tenant->brand_color }}, #9333ea);">
                    {{ strtoupper(substr($tenant->business_name, 0, 1)) }}
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-black text-lg sm:text-xl tracking-tight leading-tight">{{ $tenant->business_name }}</span>
                        <i class="fa-solid fa-circle-check text-sky-500 text-xs" title="Verified Business"></i>
                    </div>
                    <p class="text-[11px] font-medium opacity-60 flex items-center gap-1">
                        <i class="fa-solid fa-location-dot text-[10px] text-rose-500"></i> {{ $tenant->city }} &bull; {{ $archetype->name }}
                    </p>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden lg:flex items-center gap-6 text-sm font-semibold opacity-80">
                <a href="#services" class="hover:text-purple-600 transition">{{ $archetype->code === 'service' ? 'Services' : ($archetype->code === 'b2b' ? 'Products' : 'Catalog') }}</a>
                <a href="#about" class="hover:text-purple-600 transition">About Us</a>
                <a href="#highlights" class="hover:text-purple-600 transition">Why Us</a>
                <a href="#timings" class="hover:text-purple-600 transition">Hours</a>
                <a href="#reviews" class="hover:text-purple-600 transition">Reviews</a>
                <a href="#contact" class="hover:text-purple-600 transition">Contact</a>
            </div>

            <!-- Navbar Quick Actions -->
            <div class="flex items-center gap-2.5">
                <a href="tel:{{ $tenant->phone }}" class="px-3.5 py-2 rounded-xl border text-xs font-bold transition flex items-center gap-1.5 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-700 hover:bg-zinc-800 text-zinc-200' : 'border-slate-200 hover:bg-slate-100 text-slate-700' }}">
                    <i class="fa-solid fa-phone text-rose-500"></i> <span class="hidden sm:inline">Call</span>
                </a>
                
                <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to inquire about your services/products.') }}" target="_blank" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-sm transition flex items-center gap-1.5">
                    <i class="fa-brands fa-whatsapp text-sm"></i> <span class="hidden sm:inline">WhatsApp</span>
                </a>

                @if($archetype->hasFeature('cart'))
                <button wire:click="$set('showCartModal', true)" class="relative p-2 rounded-xl border transition cursor-pointer {{ $currentTheme === 'dark_luxury' ? 'border-zinc-700 bg-zinc-800 text-zinc-200' : 'border-slate-200 bg-slate-50 text-slate-800' }}">
                    <i class="fa-solid fa-cart-shopping text-base"></i>
                    @if($this->cartCount > 0)
                    <span class="absolute -top-1.5 -right-1.5 bg-rose-500 text-white text-[10px] font-black rounded-full w-5 h-5 flex items-center justify-center shadow">
                        {{ $this->cartCount }}
                    </span>
                    @endif
                </button>
                @endif
            </div>

        </div>
    </nav>

    <!-- 🚀 HERO SECTION (High-Converting, Archetype-Aware) -->
    <section id="hero" class="relative overflow-hidden py-12 md:py-20 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-gradient-to-b from-zinc-900 to-zinc-950 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-gradient-to-b from-purple-50/40 via-white to-slate-50 border-slate-200/80') }}">
        
        <!-- Decorative Glow Orbs -->
        <div class="absolute top-10 left-1/4 w-96 h-96 rounded-full blur-3xl opacity-20 pointer-events-none" style="background-color: {{ $tenant->brand_color }};"></div>
        <div class="absolute -bottom-10 right-10 w-80 h-80 rounded-full blur-3xl opacity-15 pointer-events-none bg-rose-500"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Hero Left: Headline, Value Proposition & Direct CTAs -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    
                    <!-- Trust Pill -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border text-xs font-bold shadow-sm {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800/80 border-zinc-700 text-purple-300' : 'bg-white border-purple-200/80 text-purple-900' }}">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        @if($archetype->code === 'service')
                            🩺 Certified Healthcare & Consultation Clinic
                        @elseif($archetype->code === 'b2b')
                            ⚙️ ISO Certified Industrial Manufacturing & Supply
                        @elseif($archetype->code === 'food')
                            🍽️ Authentic Flavors & Fresh Daily Kitchen
                        @else
                            🛒 Top Rated Daily Essentials & Retail Store
                        @endif
                    </div>

                    <!-- Dynamic Headline -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black tracking-tight leading-[1.1] {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                        @if($archetype->code === 'service')
                            Advanced Care & Trusted Healthcare in <span class="gradient-text-accent">{{ $tenant->city }}</span>
                        @elseif($archetype->code === 'b2b')
                            Precision Engineering & Custom Supply from <span class="gradient-text-accent">{{ $tenant->city }}</span>
                        @elseif($archetype->code === 'food')
                            Delicious Food & Exceptional Hospitality in <span class="gradient-text-accent">{{ $tenant->city }}</span>
                        @else
                            Fresh Groceries & Daily Needs Delivered in <span class="gradient-text-accent">{{ $tenant->city }}</span>
                        @endif
                    </h1>

                    <!-- Tagline & Description -->
                    <p class="text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">
                        {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. We take pride in delivering dependable service, verified quality, and fast WhatsApp order support to our valued patrons in {$tenant->city}." }}
                    </p>

                    <!-- Trust Stats Bar -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 sm:gap-6 pt-2 text-xs font-bold opacity-90">
                        <div class="flex items-center gap-1.5 text-amber-500">
                            <i class="fa-solid fa-star"></i>
                            <span class="{{ $currentTheme === 'dark_luxury' ? 'text-zinc-200' : 'text-slate-800' }}">4.9/5 Rating (120+ Reviews)</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-emerald-500">
                            <i class="fa-solid fa-clock"></i>
                            <span class="{{ $currentTheme === 'dark_luxury' ? 'text-zinc-200' : 'text-slate-800' }}">Open 9 AM – 8:30 PM</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-sky-500">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span class="{{ $currentTheme === 'dark_luxury' ? 'text-zinc-200' : 'text-slate-800' }}">100% Genuine & Verified</span>
                        </div>
                    </div>

                    <!-- Hero Call to Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 pt-4">
                        <a href="#services" class="w-full sm:w-auto px-7 py-3.5 rounded-xl btn-brand-gradient text-white font-extrabold text-sm shadow-xl shadow-purple-500/25 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                            @if($archetype->code === 'service')
                                <i class="fa-regular fa-calendar-check"></i> Book Appointment Slot
                            @elseif($archetype->code === 'b2b')
                                <i class="fa-solid fa-file-invoice-dollar"></i> Request Bulk Quotation
                            @else
                                <i class="fa-solid fa-bag-shopping"></i> Browse Store Catalog
                            @endif
                        </a>

                        <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to ask a question regarding your services.') }}" target="_blank" class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-lg shadow-emerald-600/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i> Chat on WhatsApp
                        </a>
                    </div>

                </div>

                <!-- Hero Right: Archetype Visual Card & Live Status Box -->
                <div class="lg:col-span-5">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border transition group {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-700' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-300' : 'bg-white border-slate-200/80') }}">
                        
                        <!-- Hero Image Tailored by Archetype -->
                        <div class="relative aspect-4/3 overflow-hidden bg-slate-100">
                            @if($archetype->code === 'service')
                                <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&auto=format&fit=crop&q=80" alt="Clinic Interior" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @elseif($archetype->code === 'b2b')
                                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&auto=format&fit=crop&q=80" alt="Industrial Manufacturing" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @elseif($archetype->code === 'food')
                                <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&auto=format&fit=crop&q=80" alt="Restaurant Cuisine" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <img src="https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=800&auto=format&fit=crop&q=80" alt="Grocery Store" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <span class="bg-emerald-500 text-white text-[10px] font-black uppercase px-2.5 py-1 rounded-full shadow inline-block mb-1">
                                    <i class="fa-solid fa-bolt mr-1"></i> Instant Digital Response
                                </span>
                                <h3 class="font-bold text-lg leading-tight">{{ $tenant->business_name }}</h3>
                                <p class="text-xs text-white/80"><i class="fa-solid fa-location-dot"></i> {{ $tenant->address ?: $tenant->city }}</p>
                            </div>
                        </div>

                        <!-- Card Highlights Body -->
                        <div class="p-5 space-y-3">
                            <div class="grid grid-cols-2 gap-3 text-xs">
                                <div class="p-3 rounded-xl {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800' : 'bg-slate-50' }}">
                                    <span class="text-slate-400 block text-[11px]">Primary Action</span>
                                    <strong class="text-purple-600 font-bold">{{ $archetype->cta_label }}</strong>
                                </div>
                                <div class="p-3 rounded-xl {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800' : 'bg-slate-50' }}">
                                    <span class="text-slate-400 block text-[11px]">WhatsApp Booking</span>
                                    <strong class="text-emerald-600 font-bold">Live & Verified</strong>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs pt-1 border-t {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800 text-zinc-400' : 'border-slate-100 text-slate-500' }}">
                                <span><i class="fa-solid fa-phone text-rose-500 mr-1"></i> {{ $tenant->phone }}</span>
                                <span class="text-emerald-600 font-bold"><i class="fa-solid fa-circle text-[8px]"></i> Online Now</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 💎 KEY HIGHLIGHTS / WHY CHOOSE US -->
    <section id="highlights" class="py-14 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900/50 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-neutral-50 border-neutral-200' : 'bg-white border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-xs font-bold uppercase tracking-widest text-purple-600 mb-2">Why Customers Trust Us</h2>
                <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                    Setting The Standard For Excellence in {{ $tenant->city }}
                </h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                @if($archetype->code === 'service')
                <!-- Service / Clinic 4 Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Licensed Specialists</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Experienced doctors dedicated to thorough checkups, honest advice, and empathetic care.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-microscope"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Modern Diagnostics</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Equipped with high-precision instruments to provide accurate treatment in sterile conditions.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Zero Wait Time Slots</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Pick your preferred appointment slot online and get instant WhatsApp confirmation.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Transparent Pricing</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Transparent consultation fees with no surprise hidden bills or unnecessary tests.</p>
                </div>

                @elseif($archetype->code === 'b2b')
                <!-- B2B Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">High Micron Tolerance</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Advanced CNC turning and laser cutting engineered to exacting industrial specifications.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">ISO Certified Quality</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Material test reports (MTR) provided with every batch for 100% compliance.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Bulk Wholesale Capacity</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">High-speed batch runs with tiered volume pricing for contract manufacturers.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">On-Time Dispatch</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Guaranteed shipment schedules with full digital consignment tracking.</p>
                </div>

                @else
                <!-- Retail / Kirana / Food Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">100% Fresh Daily</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Direct farm sourcing and quality inspections ensure genuine fresh groceries.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-motorcycle"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Fast Local Delivery</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Delivered to your doorstep within 60 minutes across {{ $tenant->city }}.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Best Wholesale Prices</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Enjoy daily supermarket discounts and genuine branded staple goods.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Easy WhatsApp Order</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Add items to bag and send directly via WhatsApp. No app installation needed.</p>
                </div>
                @endif

            </div>
        </div>
    </section>

    <!-- 📦 CATALOG & SERVICES SECTION (Intent-Based Dynamic Rendering) -->
    <section id="services" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-950 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-widest text-purple-600 mb-1">
                        @if($archetype->code === 'service')
                            Clinical Specialities & Treatments
                        @elseif($archetype->code === 'b2b')
                            Fabrication & Engineering Line
                        @else
                            Featured Store Items
                        @endif
                    </h2>
                    <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                        @if($archetype->code === 'service')
                            Available Doctor Consultations & Services
                        @elseif($archetype->code === 'b2b')
                            Industrial Products & Custom Components
                        @else
                            Explore Catalog & Order Online
                        @endif
                    </h3>
                </div>

                <!-- Search & Filters -->
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                    <div class="relative w-full sm:w-64">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search catalog..." class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-purple-500 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-700 text-white' : 'bg-white' }}">
                    </div>

                    <div class="flex items-center gap-1.5 overflow-x-auto w-full sm:w-auto pb-1">
                        <button wire:click="$set('selectedCategory', 'all')" class="whitespace-nowrap px-3 py-1.5 rounded-full text-xs font-bold transition cursor-pointer {{ $selectedCategory === 'all' ? 'btn-brand-gradient text-white shadow' : ($currentTheme === 'dark_luxury' ? 'bg-zinc-800 text-zinc-300 hover:bg-zinc-700' : 'bg-slate-200 text-slate-700 hover:bg-slate-300') }}">
                            All ({{ $items->count() }})
                        </button>
                        @foreach($categories as $category)
                        <button wire:click="$set('selectedCategory', '{{ $category }}')" class="whitespace-nowrap px-3 py-1.5 rounded-full text-xs font-bold transition cursor-pointer {{ $selectedCategory === $category ? 'btn-brand-gradient text-white shadow' : ($currentTheme === 'dark_luxury' ? 'bg-zinc-800 text-zinc-300 hover:bg-zinc-700' : 'bg-slate-200 text-slate-700 hover:bg-slate-300') }}">
                            {{ $category }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Items Cards Grid -->
            @if($items->isEmpty())
            <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-200 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800 text-zinc-400' : '' }}">
                <i class="fa-solid fa-box-open text-4xl text-slate-300 mb-3"></i>
                <h4 class="font-bold text-base">No items found matching your filter</h4>
                <p class="text-xs text-slate-500 mt-1">Try clearing your search query or switching categories.</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($items as $item)
                <div class="rounded-3xl overflow-hidden border transition-all duration-300 flex flex-col justify-between group hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800 hover:border-zinc-700' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-300 hover:shadow-xl' : 'bg-white border-slate-200/80 shadow-md hover:shadow-xl') }}">
                    
                    <div>
                        <!-- Image Container -->
                        <div class="relative aspect-16/10 w-full overflow-hidden bg-slate-100">
                            <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=600&auto=format&fit=crop&q=75' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            @if($item->category_name)
                            <span class="absolute top-3 left-3 bg-black/75 backdrop-blur-md text-white text-[10px] font-black uppercase px-2.5 py-1 rounded-md shadow">
                                {{ $item->category_name }}
                            </span>
                            @endif

                            @if($archetype->code === 'service' && $item->duration_minutes)
                            <span class="absolute bottom-3 right-3 bg-sky-600 text-white text-[11px] font-bold px-2.5 py-1 rounded-lg shadow flex items-center gap-1">
                                <i class="fa-regular fa-clock"></i> {{ $item->duration_minutes }} Mins
                            </span>
                            @endif

                            @if($archetype->code === 'b2b' && $item->min_order_qty)
                            <span class="absolute bottom-3 right-3 bg-amber-600 text-white text-[11px] font-bold px-2.5 py-1 rounded-lg shadow flex items-center gap-1">
                                <i class="fa-solid fa-boxes-stacked"></i> MOQ: {{ $item->min_order_qty }} Units
                            </span>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <h3 class="font-bold text-lg mb-2 line-clamp-1 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                                {{ $item->title }}
                            </h3>

                            @if(!empty($item->attributes))
                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach($item->attributes as $key => $val)
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-md {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800 text-zinc-300' : 'bg-slate-100 text-slate-600' }}">
                                    {{ ucfirst($key) }}: {{ is_bool($val) ? ($val ? 'Yes' : 'No') : $val }}
                                </span>
                                @endforeach
                            </div>
                            @endif

                            <!-- Price Display -->
                            <div class="flex items-baseline gap-2 mb-2">
                                <span class="text-2xl font-black {{ $currentTheme === 'dark_luxury' ? 'text-emerald-400' : 'text-slate-900' }}">
                                    ₹{{ number_format($item->price, 2) }}
                                </span>
                                @if($item->compare_at_price && $item->compare_at_price > $item->price)
                                <span class="text-xs text-slate-400 line-through">
                                    ₹{{ number_format($item->compare_at_price, 2) }}
                                </span>
                                <span class="text-xs font-black text-rose-500 bg-rose-50 px-2 py-0.5 rounded">
                                    {{ round((($item->compare_at_price - $item->price) / $item->compare_at_price) * 100) }}% OFF
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Action CTA Button -->
                    <div class="p-6 pt-0">
                        @if($archetype->code === 'service')
                            <!-- Clinic Slot Booking CTA -->
                            <button wire:click="openBookingModal({{ $item->id }})" class="w-full py-3 px-4 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01] active:scale-[0.99]">
                                <i class="fa-regular fa-calendar-check"></i> Book Appointment Slot
                            </button>

                        @elseif($archetype->code === 'b2b')
                            <!-- B2B RFQ Quote CTA -->
                            <button wire:click="openQuoteModal({{ $item->id }})" class="w-full py-3 px-4 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01] active:scale-[0.99]">
                                <i class="fa-solid fa-file-invoice-dollar"></i> Request Bulk Quote
                            </button>

                        @else
                            <!-- Retail / Kirana Cart & WhatsApp CTA -->
                            <div class="flex items-center gap-2">
                                <button wire:click="addToCart({{ $item->id }})" class="flex-1 py-3 px-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition flex items-center justify-center gap-1.5 cursor-pointer">
                                    <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                </button>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi, I want to buy: ' . $item->title . ' (₹' . $item->price . ')') }}" target="_blank" class="p-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold flex items-center justify-center shadow">
                                    <i class="fa-brands fa-whatsapp text-lg"></i>
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
                @endforeach
            </div>
            @endif

        </div>
    </section>

    <!-- 📖 ABOUT OUR BUSINESS / CLINIC / STORE SECTION -->
    <section id="about" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900/40 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-white border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-6 space-y-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-purple-600">About Our Practice</span>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                        Committed To Raising The Bar In {{ $tenant->city }}
                    </h2>
                    
                    <p class="text-sm sm:text-base leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">
                        At <strong>{{ $tenant->business_name }}</strong>, our mission is to provide personalized, transparent, and superior quality solutions to the community of {{ $tenant->city }}. Whether you are scheduling a specialist consultation or ordering essential goods, we guarantee integrity, prompt customer service, and reliable follow-through.
                    </p>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
                        <div class="p-4 rounded-2xl border text-center {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800/60 border-zinc-700' : 'bg-slate-50 border-slate-200' }}">
                            <div class="text-2xl font-black text-purple-600 mb-0.5">15+</div>
                            <div class="text-[11px] font-semibold text-slate-500">Years Trust</div>
                        </div>
                        <div class="p-4 rounded-2xl border text-center {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800/60 border-zinc-700' : 'bg-slate-50 border-slate-200' }}">
                            <div class="text-2xl font-black text-rose-500 mb-0.5">1.5K+</div>
                            <div class="text-[11px] font-semibold text-slate-500">Satisfied Clients</div>
                        </div>
                        <div class="p-4 rounded-2xl border text-center {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800/60 border-zinc-700' : 'bg-slate-50 border-slate-200' }}">
                            <div class="text-2xl font-black text-emerald-500 mb-0.5">100%</div>
                            <div class="text-[11px] font-semibold text-slate-500">Genuine Care</div>
                        </div>
                        <div class="p-4 rounded-2xl border text-center {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800/60 border-zinc-700' : 'bg-slate-50 border-slate-200' }}">
                            <div class="text-2xl font-black text-amber-500 mb-0.5">4.9★</div>
                            <div class="text-[11px] font-semibold text-slate-500">Local Rating</div>
                        </div>
                    </div>

                    <div class="pt-2 flex items-center gap-4">
                        <a href="#contact" class="px-6 py-3 rounded-xl border font-bold text-xs transition {{ $currentTheme === 'dark_luxury' ? 'border-zinc-700 hover:bg-zinc-800 text-white' : 'border-slate-300 hover:bg-slate-100 text-slate-800' }}">
                            Contact Management
                        </a>
                        <a href="tel:{{ $tenant->phone }}" class="text-xs font-bold text-purple-600 hover:underline flex items-center gap-1.5">
                            <i class="fa-solid fa-phone"></i> {{ $tenant->phone }}
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div class="rounded-2xl overflow-hidden aspect-square shadow-lg">
                                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=500&auto=format&fit=crop&q=80" alt="Hospitality" class="w-full h-full object-cover">
                            </div>
                            <div class="p-5 rounded-2xl border {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800 border-zinc-700' : 'bg-purple-50/60 border-purple-100' }}">
                                <i class="fa-solid fa-award text-2xl text-purple-600 mb-2"></i>
                                <h4 class="font-bold text-sm mb-1">Standardized Facility</h4>
                                <p class="text-[11px] text-slate-500">Clean, fully compliant environment adhering to hygiene protocols.</p>
                            </div>
                        </div>
                        <div class="space-y-4 pt-6">
                            <div class="p-5 rounded-2xl border {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800 border-zinc-700' : 'bg-emerald-50/60 border-emerald-100' }}">
                                <i class="fa-solid fa-comments text-2xl text-emerald-600 mb-2"></i>
                                <h4 class="font-bold text-sm mb-1">WhatsApp Direct</h4>
                                <p class="text-[11px] text-slate-500">Real-time status updates and order tracking sent to your mobile.</p>
                            </div>
                            <div class="rounded-2xl overflow-hidden aspect-square shadow-lg">
                                <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=500&auto=format&fit=crop&q=80" alt="Consultation" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 🕒 WORKING HOURS & TIMINGS SECTION -->
    <section id="timings" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-950 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-neutral-50 border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <div class="lg:col-span-5 space-y-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-purple-600">Hours & Availability</span>
                    <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                        Visiting Hours & Clinic Schedule
                    </h3>
                    <p class="text-xs sm:text-sm {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">
                        We are open 6 days a week to serve patients and customers across {{ $tenant->city }}. Emergency inquiries can be routed via WhatsApp 24/7.
                    </p>
                    
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-600 text-xs font-bold border border-emerald-500/20">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                        Open Today Until 8:30 PM
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="rounded-3xl p-6 sm:p-8 border shadow-xl {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-slate-200' }}">
                        <div class="divide-y {{ $currentTheme === 'dark_luxury' ? 'divide-zinc-800' : 'divide-slate-100' }}">
                            
                            <div class="py-3 flex items-center justify-between text-xs sm:text-sm font-semibold">
                                <span class="flex items-center gap-2">
                                    <i class="fa-regular fa-calendar text-purple-600"></i> Monday – Friday
                                </span>
                                <span class="font-bold text-emerald-600">09:00 AM – 08:30 PM (Regular)</span>
                            </div>

                            <div class="py-3 flex items-center justify-between text-xs sm:text-sm font-semibold">
                                <span class="flex items-center gap-2">
                                    <i class="fa-regular fa-calendar text-purple-600"></i> Saturday
                                </span>
                                <span class="font-bold text-emerald-600">09:00 AM – 09:00 PM (Full Day)</span>
                            </div>

                            <div class="py-3 flex items-center justify-between text-xs sm:text-sm font-semibold">
                                <span class="flex items-center gap-2">
                                    <i class="fa-regular fa-calendar text-rose-500"></i> Sunday
                                </span>
                                <span class="font-bold text-amber-600">10:00 AM – 02:00 PM (Half Day / Priority Slots)</span>
                            </div>

                            <div class="py-3 flex items-center justify-between text-xs sm:text-sm font-semibold">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-phone-volume text-sky-500"></i> WhatsApp Helpdesk
                                </span>
                                <span class="font-bold text-sky-600">Available 24/7 for Inquiries</span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 🌟 VERIFIED REVIEWS & TESTIMONIALS -->
    <section id="reviews" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900/60 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-white border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-purple-600">Patient & Customer Feedback</span>
                <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                    What People in {{ $tenant->city }} Say About Us
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-slate-50 border-slate-200/80' }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : 'text-slate-700' }}">
                        "Booking my slot online on their website was effortless. The doctor listened patiently and explained the treatment thoroughly. Highly professional!"
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-purple-600 text-white font-black text-xs flex items-center justify-center">
                            A
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Ananya Deshmukh</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Resident, {{ $tenant->city }}</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-slate-50 border-slate-200/80' }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : 'text-slate-700' }}">
                        "Clean and hygienic premises with prompt WhatsApp notifications. No waiting in long lines. Transparent charges with zero hidden fees."
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-rose-500 text-white font-black text-xs flex items-center justify-center">
                            R
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Rajesh Kulkarni</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Appointment</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-slate-50 border-slate-200/80' }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : 'text-slate-700' }}">
                        "Great experience with {{ $tenant->business_name }}! The staff is courteous and the consultation was top-tier. Wonderful to have this standard in {{ $tenant->city }}."
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-sky-500 text-white font-black text-xs flex items-center justify-center">
                            S
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Sneha Patil</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Patient</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 📍 CONTACT, LOCATION & QUICK INQUIRY FORM -->
    <section id="contact" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-950 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-neutral-50 border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Contact Details -->
                <div class="lg:col-span-5 space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-purple-600">Get In Touch</span>
                        <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                            Visit Our Center or Message Us
                        </h3>
                        <p class="text-xs sm:text-sm mt-2 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">
                            Have a medical or service query? Reach out directly via phone or WhatsApp for quick assistance.
                        </p>
                    </div>

                    <div class="space-y-4 text-xs sm:text-sm">
                        
                        <div class="p-4 rounded-2xl border flex items-start gap-3.5 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-slate-200' }}">
                            <div class="w-9 h-9 rounded-xl bg-rose-500/10 text-rose-500 flex items-center justify-center text-sm shrink-0">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <strong class="block mb-0.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Address & Location</strong>
                                <p class="text-slate-500">{{ $tenant->address ?: 'Main Street Commercial Complex' }}, {{ $tenant->city }}</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl border flex items-start gap-3.5 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-slate-200' }}">
                            <div class="w-9 h-9 rounded-xl bg-purple-500/10 text-purple-600 flex items-center justify-center text-sm shrink-0">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <strong class="block mb-0.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Phone Number</strong>
                                <a href="tel:{{ $tenant->phone }}" class="text-purple-600 font-bold hover:underline">{{ $tenant->phone }}</a>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl border flex items-start gap-3.5 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-slate-200' }}">
                            <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-sm shrink-0">
                                <i class="fa-brands fa-whatsapp text-base"></i>
                            </div>
                            <div>
                                <strong class="block mb-0.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Direct WhatsApp</strong>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I have a question.') }}" target="_blank" class="text-emerald-600 font-bold hover:underline">Chat on WhatsApp (Instant)</a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Quick Message Form -->
                <div class="lg:col-span-7">
                    <div class="p-6 sm:p-8 rounded-3xl border shadow-xl {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-slate-200' }}">
                        <h4 class="text-lg font-bold mb-1 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Send a Quick Inquiry</h4>
                        <p class="text-xs text-slate-500 mb-6">Fill out the form below and our team will get back to you via WhatsApp.</p>

                        <form wire:submit.prevent="submitInquiry" class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Your Full Name *</label>
                                <input wire:model="inquiryName" type="text" placeholder="e.g. Vikas Verma" class="input-field" required>
                                @error('inquiryName') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp Number *</label>
                                <input wire:model="inquiryPhone" type="tel" placeholder="e.g. 9876543210" class="input-field" required>
                                @error('inquiryPhone') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Your Message or Required Service *</label>
                                <textarea wire:model="inquiryMessage" rows="3" placeholder="Tell us what you're looking for or your appointment preferences..." class="input-field" required></textarea>
                                @error('inquiryMessage') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="w-full py-3.5 rounded-xl btn-brand-gradient text-white font-extrabold text-sm shadow-lg shadow-purple-500/25 transition cursor-pointer flex items-center justify-center gap-2">
                                <i class="fa-solid fa-paper-plane"></i> Send Inquiry via WhatsApp
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 🌐 WEBSITE FOOTER -->
    <footer class="py-12 border-t {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-950 border-zinc-800 text-zinc-400' : 'bg-slate-900 border-slate-800 text-slate-400' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-b border-slate-800 pb-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-lg" style="background: linear-gradient(135deg, {{ $tenant->brand_color }}, #9333ea);">
                        {{ strtoupper(substr($tenant->business_name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="text-white font-black text-base">{{ $tenant->business_name }}</h4>
                        <p class="text-xs text-slate-500">&copy; {{ date('Y') }} {{ $tenant->business_name }}. All rights reserved.</p>
                    </div>
                </div>

                <div class="flex items-center gap-6 text-xs font-semibold">
                    <a href="#hero" class="hover:text-white transition">Home</a>
                    <a href="#services" class="hover:text-white transition">{{ $archetype->code === 'service' ? 'Services' : 'Catalog' }}</a>
                    <a href="#about" class="hover:text-white transition">About</a>
                    <a href="#timings" class="hover:text-white transition">Timings</a>
                    <a href="#contact" class="hover:text-white transition">Contact</a>
                </div>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                <p class="text-slate-500">
                    Local Business Profile &bull; {{ $tenant->city }}, India &bull; Phone: {{ $tenant->phone }}
                </p>
                <div class="inline-flex items-center gap-1.5 text-xs text-slate-400">
                    <span>Powered by</span>
                    <span class="font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-purple-400">Anemony</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- 🛍️ Cart Modal for Retail & Food -->
    @if($showCartModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-fade-in">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl flex flex-col max-h-[90vh]">
            <div class="p-5 border-b flex items-center justify-between bg-slate-50">
                <h3 class="font-bold text-base flex items-center gap-2 text-slate-900">
                    <i class="fa-solid fa-bag-shopping text-emerald-600"></i> Your Cart ({{ $this->cartCount }})
                </h3>
                <button wire:click="$set('showCartModal', false)" class="text-slate-400 hover:text-slate-700 text-xl font-bold cursor-pointer">&times;</button>
            </div>

            <div class="p-5 overflow-y-auto flex-1 space-y-3">
                @if(empty($cart))
                <div class="text-center py-8 text-slate-400">
                    <i class="fa-solid fa-basket-shopping text-4xl mb-2 text-slate-200"></i>
                    <p class="text-sm">Your cart is currently empty.</p>
                </div>
                @else
                    @foreach($cart as $cItem)
                    <div class="flex items-center justify-between gap-3 border-b border-slate-100 pb-3">
                        <div class="flex-1">
                            <h4 class="text-xs font-bold text-slate-800 line-clamp-1">{{ $cItem['title'] }}</h4>
                            <span class="text-xs text-slate-500 font-semibold">₹{{ $cItem['price'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button wire:click="updateQty({{ $cItem['id'] }}, -1)" class="w-6 h-6 rounded bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center hover:bg-slate-200 cursor-pointer">-</button>
                            <span class="text-xs font-bold w-4 text-center">{{ $cItem['qty'] }}</span>
                            <button wire:click="updateQty({{ $cItem['id'] }}, 1)" class="w-6 h-6 rounded bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center hover:bg-slate-200 cursor-pointer">+</button>
                            <button wire:click="removeFromCart({{ $cItem['id'] }})" class="text-rose-500 hover:text-rose-700 text-xs ml-1 cursor-pointer"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    @endforeach

                    <!-- Customer Info Form for Quick Checkout -->
                    <div class="pt-2 space-y-2">
                        <label class="block text-xs font-bold text-slate-700">Delivery Details</label>
                        <input wire:model="customerName" type="text" placeholder="Full Name" class="input-field">
                        <input wire:model="customerAddress" type="text" placeholder="Delivery Address / Landmark" class="input-field">
                    </div>
                @endif
            </div>

            @if(!empty($cart))
            <div class="p-5 border-t bg-slate-50 space-y-3">
                <div class="flex items-center justify-between text-sm font-bold text-slate-900">
                    <span>Total:</span>
                    <span class="text-lg text-emerald-700 font-black">₹{{ number_format($this->cartTotal, 2) }}</span>
                </div>
                <button wire:click="checkoutWhatsApp" class="w-full py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm flex items-center justify-center gap-2 shadow-lg shadow-emerald-600/20 transition cursor-pointer">
                    <i class="fa-brands fa-whatsapp text-lg"></i> Complete Order on WhatsApp
                </button>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- 🗓️ Appointment Booking Modal for Healthcare/Clinics -->
    @if($showBookingModal && $selectedService)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl">
            <div class="p-5 border-b flex items-center justify-between bg-sky-50">
                <div>
                    <span class="text-[10px] font-black text-sky-700 uppercase tracking-widest">Clinic Slot Booking</span>
                    <h3 class="font-bold text-base text-slate-900">{{ $selectedService->title }}</h3>
                </div>
                <button wire:click="$set('showBookingModal', false)" class="text-slate-400 hover:text-slate-700 text-xl font-bold cursor-pointer">&times;</button>
            </div>

            <form wire:submit.prevent="confirmBooking" class="p-5 space-y-4">
                <div class="flex items-center justify-between bg-slate-50 p-3.5 rounded-2xl border border-slate-100 text-xs">
                    <div>
                        <span class="text-slate-500 block">Consultation Fee</span>
                        <span class="font-black text-base text-slate-900">₹{{ $selectedService->price }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Expected Duration</span>
                        <span class="font-bold text-sky-700">{{ $selectedService->duration_minutes }} Mins</span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Appointment Date *</label>
                    <input wire:model="bookingDate" type="date" min="{{ date('Y-m-d') }}" class="input-field" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Select Time Slot *</label>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach(['10:00 AM', '11:30 AM', '01:00 PM', '04:30 PM', '06:00 PM', '07:30 PM'] as $slot)
                        <button type="button" wire:click="$set('bookingSlot', '{{ $slot }}')" class="py-2 text-xs font-bold rounded-xl border text-center transition cursor-pointer {{ $bookingSlot === $slot ? 'bg-sky-600 text-white border-sky-600 shadow' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100' }}">
                            {{ $slot }}
                        </button>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Patient Full Name *</label>
                    <input wire:model="patientName" type="text" placeholder="e.g. Ramesh Kumar" class="input-field" required>
                    @error('patientName') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Phone Number (For WhatsApp Confirmation) *</label>
                    <input wire:model="patientPhone" type="tel" placeholder="e.g. 9876543210" class="input-field" required>
                    @error('patientPhone') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-black text-sm shadow-lg shadow-sky-600/25 transition flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-circle-check"></i> Confirm Slot & Receive SMS
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- 🏭 Quote Request Modal for B2B & Manufacturing -->
    @if($showQuoteModal && $selectedQuoteItem)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl">
            <div class="p-5 border-b flex items-center justify-between bg-amber-50">
                <div>
                    <span class="text-[10px] font-black text-amber-700 uppercase tracking-widest">Bulk Quotation Request</span>
                    <h3 class="font-bold text-base text-slate-900">{{ $selectedQuoteItem->title }}</h3>
                </div>
                <button wire:click="$set('showQuoteModal', false)" class="text-slate-400 hover:text-slate-700 text-xl font-bold cursor-pointer">&times;</button>
            </div>

            <form wire:submit.prevent="submitQuoteRequest" class="p-5 space-y-4">
                <div class="bg-amber-50/60 p-3.5 rounded-2xl border border-amber-100 flex items-center justify-between text-xs">
                    <span>Base Unit Rate: <strong>₹{{ $selectedQuoteItem->price }}</strong></span>
                    <span>Min Batch: <strong>{{ $selectedQuoteItem->min_order_qty }} Units</strong></span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Required Quantity *</label>
                    <input wire:model="quoteQty" type="number" min="{{ $selectedQuoteItem->min_order_qty ?: 1 }}" class="input-field" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Company / Organization</label>
                    <input wire:model="quoteCompany" type="text" placeholder="e.g. Acme Industries Ltd" class="input-field">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Contact Person *</label>
                        <input wire:model="customerName" type="text" placeholder="Your Name" class="input-field" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Mobile Number *</label>
                        <input wire:model="customerPhone" type="tel" placeholder="Phone" class="input-field" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Custom Specs / Drawing Notes</label>
                    <textarea wire:model="quoteNotes" rows="2" placeholder="e.g. Surface finish, delivery destination, test certificates..." class="input-field"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-black text-sm shadow-lg shadow-amber-600/25 transition flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-paper-plane"></i> Send Quotation Request
                </button>
            </form>
        </div>
    </div>
    @endif

</div>
