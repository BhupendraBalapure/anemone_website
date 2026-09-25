<div class="min-h-screen bg-slate-950 text-slate-100 selection:bg-purple-600 selection:text-white flex w-full antialiased font-sans" style="background-color: #020617; color: #f8fafc;">

    <!-- ======================================================== -->
    <!-- 🧭 LEFT SIDEBAR (In Normal Flex Flow - ZERO OVERLAP)      -->
    <!-- ======================================================== -->
    <aside class="w-64 xl:w-72 bg-slate-900 border-r border-slate-800 flex flex-col justify-between shrink-0 h-screen sticky top-0 z-30 select-none" style="background-color: #0f172a; border-color: #1e293b;">
        
        <!-- Top Section: Brand + Menu -->
        <div class="flex-1 flex flex-col min-h-0 overflow-y-auto">
            
            <!-- 👑 Platform Brand Header -->
            <div class="h-18 px-5 border-b border-slate-800/80 flex items-center justify-between shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl gradient-logo-swirl flex items-center justify-center text-white shadow-md shadow-purple-500/25 group-hover:scale-105 transition-transform shrink-0">
                        <i class="fa-solid fa-crown text-amber-300 text-sm"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-base font-black tracking-tight text-white">Anemony<span class="text-rose-500">.</span></span>
                            <span class="bg-purple-500/20 text-purple-300 border border-purple-500/30 text-[9px] font-black uppercase tracking-wider px-1.5 py-0.5 rounded">
                                ADMIN
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-400 font-medium">Command Center</p>
                    </div>
                </a>
            </div>

            <!-- 🟢 Engine Live Status Pill -->
            <div class="p-3 mx-4 my-3 rounded-xl bg-slate-900/90 border border-slate-800/80 flex items-center justify-between text-xs">
                <div class="flex items-center gap-2 text-slate-300">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-[11px] font-semibold text-slate-300">Live Operating System</span>
                </div>
                <span class="text-[10px] font-black text-emerald-400 bg-emerald-950/80 border border-emerald-800/60 px-2 py-0.5 rounded-full">
                    {{ $activeTenants }}/{{ $totalTenants }} Live
                </span>
            </div>

            <!-- 🧭 Categorized Navigation Items -->
            <nav class="px-3 space-y-5 flex-1 mt-2">
                
                <!-- Group 1: CORE PLATFORM -->
                <div>
                    <span class="px-3 text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-1.5">
                        Core Platform
                    </span>
                    <div class="space-y-1">
                        
                        <!-- Overview -->
                        <button wire:click="$set('currentSection', 'overview')" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer {{ $currentSection === 'overview' ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-chart-pie w-4 text-center {{ $currentSection === 'overview' ? 'text-purple-400' : 'text-slate-400' }}"></i>
                                <span>Platform Overview</span>
                            </div>
                            <span class="text-[9px] uppercase px-1.5 py-0.5 rounded font-extrabold {{ $currentSection === 'overview' ? 'bg-purple-500/30 text-purple-200' : 'bg-slate-800 text-slate-400' }}">
                                Live
                            </span>
                        </button>

                        <!-- Stores & Merchants -->
                        <button wire:click="$set('currentSection', 'tenants')" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer {{ $currentSection === 'tenants' ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-store w-4 text-center {{ $currentSection === 'tenants' ? 'text-purple-400' : 'text-slate-400' }}"></i>
                                <span>Stores & Merchants</span>
                            </div>
                            <span class="text-[10px] px-2 py-0.5 rounded-full font-bold {{ $currentSection === 'tenants' ? 'bg-purple-500/30 text-purple-200' : 'bg-slate-800 text-slate-400' }}">
                                {{ $totalTenants }}
                            </span>
                        </button>

                        <!-- Category Archetypes -->
                        <button wire:click="$set('currentSection', 'archetypes')" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer {{ $currentSection === 'archetypes' ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-layer-group w-4 text-center {{ $currentSection === 'archetypes' ? 'text-purple-400' : 'text-slate-400' }}"></i>
                                <span>Category Archetypes</span>
                            </div>
                            <span class="text-[10px] px-2 py-0.5 rounded-full font-bold {{ $currentSection === 'archetypes' ? 'bg-purple-500/30 text-purple-200' : 'bg-slate-800 text-slate-400' }}">
                                {{ $archetypes->count() }}
                            </span>
                        </button>

                        <!-- Global Orders Feed -->
                        <button wire:click="$set('currentSection', 'orders')" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer {{ $currentSection === 'orders' ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-inbox w-4 text-center {{ $currentSection === 'orders' ? 'text-purple-400' : 'text-slate-400' }}"></i>
                                <span>Global Orders Feed</span>
                            </div>
                            <span class="text-[10px] px-2 py-0.5 rounded-full font-bold {{ $currentSection === 'orders' ? 'bg-purple-500/30 text-purple-200' : 'bg-slate-800 text-slate-400' }}">
                                {{ $totalOrders }}
                            </span>
                        </button>

                    </div>
                </div>

                <!-- Group 2: CONFIGURATION -->
                <div>
                    <span class="px-3 text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-1.5">
                        Configuration
                    </span>
                    <div class="space-y-1">
                        
                        <!-- System & AI Settings -->
                        <button wire:click="$set('currentSection', 'settings')" 
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer {{ $currentSection === 'settings' ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-sliders w-4 text-center {{ $currentSection === 'settings' ? 'text-purple-400' : 'text-slate-400' }}"></i>
                                <span>System & AI Settings</span>
                            </div>
                            <i class="fa-solid fa-circle text-[6px] {{ config('services.gemini.key') ? 'text-emerald-400' : 'text-amber-400' }}"></i>
                        </button>

                    </div>
                </div>

                <!-- Group 3: PUBLIC SHORTCUTS -->
                <div>
                    <span class="px-3 text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-1.5">
                        Public Links
                    </span>
                    <div class="space-y-1">
                        
                        <!-- Landing Page -->
                        <a href="{{ route('home') }}" wire:navigate class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-globe w-4 text-center text-rose-400"></i>
                                <span>Landing Page</span>
                            </div>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-600"></i>
                        </a>

                        <!-- Onboarding Wizard -->
                        <a href="{{ route('onboarding') }}" wire:navigate class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-wand-magic-sparkles w-4 text-center text-amber-400"></i>
                                <span>Store Wizard</span>
                            </div>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-600"></i>
                        </a>

                    </div>
                </div>

            </nav>

        </div>

        <!-- 👤 Bottom: Admin User Profile Card & Sign Out -->
        <div class="p-3 border-t border-slate-800/80 bg-slate-900/60 shrink-0">
            <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-slate-900 border border-slate-800">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-purple-600 to-rose-500 flex items-center justify-center text-white font-black text-xs shrink-0 shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <span class="block text-xs font-bold text-white truncate leading-tight">
                            {{ auth()->user()->name ?? 'Super Admin' }}
                        </span>
                        <span class="block text-[10px] text-slate-400 truncate">
                            {{ auth()->user()->email ?? 'admin@anemony.in' }}
                        </span>
                    </div>
                </div>

                <!-- Sign Out -->
                <button wire:click="logout" 
                        class="h-7 w-7 rounded-lg bg-slate-800 hover:bg-rose-950/80 text-slate-400 hover:text-rose-300 border border-slate-700/60 hover:border-rose-800 transition flex items-center justify-center cursor-pointer shrink-0" 
                        title="Sign Out">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                </button>
            </div>
        </div>

    </aside>

    <!-- ======================================================== -->
    <!-- 🖥️ MAIN CONTENT CANVAS (Clean Sibling, Zero Overlap)      -->
    <!-- ======================================================== -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-950" style="background-color: #020617;">
        
        <!-- 🧭 Top Sticky Header Bar -->
        <header class="h-16 px-6 lg:px-8 border-b border-slate-800/80 bg-slate-900/80 backdrop-blur-xl flex items-center justify-between sticky top-0 z-20 shrink-0">
            
            <!-- Left: Dynamic Breadcrumb -->
            <div class="flex items-center gap-2.5">
                <span class="text-xs font-bold text-slate-400">Admin</span>
                <span class="text-xs text-slate-600">/</span>
                <div class="flex items-center gap-2">
                    @if($currentSection === 'overview')
                        <i class="fa-solid fa-chart-pie text-purple-400 text-xs"></i>
                        <span class="text-sm font-black text-white">Platform Overview</span>
                    @elseif($currentSection === 'tenants')
                        <i class="fa-solid fa-store text-pink-400 text-xs"></i>
                        <span class="text-sm font-black text-white">Stores & Merchants</span>
                    @elseif($currentSection === 'archetypes')
                        <i class="fa-solid fa-layer-group text-amber-400 text-xs"></i>
                        <span class="text-sm font-black text-white">Category Archetypes</span>
                    @elseif($currentSection === 'orders')
                        <i class="fa-solid fa-inbox text-emerald-400 text-xs"></i>
                        <span class="text-sm font-black text-white">Global Orders Feed</span>
                    @elseif($currentSection === 'settings')
                        <i class="fa-solid fa-sliders text-sky-400 text-xs"></i>
                        <span class="text-sm font-black text-white">System & AI Settings</span>
                    @endif
                </div>
            </div>

            <!-- Right: Search, Deploy Button, Public Website Link -->
            <div class="flex items-center gap-3">
                
                <!-- Deploy New Store Button -->
                <button wire:click="openCreateTenantModal" class="h-9 px-4 rounded-xl btn-brand-gradient text-white text-xs font-bold shadow-md shadow-purple-500/20 hover:brightness-105 transition flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Deploy New Store</span>
                </button>

                <!-- Visit Public Website -->
                <a href="{{ route('home') }}" wire:navigate class="h-9 px-3.5 rounded-xl bg-slate-800/80 hover:bg-slate-700 text-slate-200 text-xs font-bold border border-slate-700/60 transition inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-globe text-xs text-purple-400"></i>
                    <span>Website</span>
                </a>

            </div>

        </header>

        <!-- ⚡ Flash Message Notification -->
        @if($flashMessage)
        <div class="px-6 lg:px-8 mt-5">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-5 py-3 rounded-2xl text-xs sm:text-sm font-semibold flex items-center justify-between shadow-lg shadow-emerald-950/40 border border-emerald-500/30">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-base text-emerald-200"></i>
                    <span>{{ $flashMessage }}</span>
                </div>
                <button wire:click="$set('flashMessage', '')" class="text-emerald-200 hover:text-white cursor-pointer text-lg font-bold">&times;</button>
            </div>
        </div>
        @endif

        <!-- 📦 Main Content Body -->
        <main class="flex-1 p-6 lg:p-8 space-y-8 overflow-y-auto">

            <!-- ======================================================== -->
            <!-- SECTION 1: 📊 PLATFORM OVERVIEW                          -->
            <!-- ======================================================== -->
            @if($currentSection === 'overview')
            <div class="space-y-8 animate-fade-in">
                
                <!-- 4 KPI Metrics Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
                    
                    <!-- Card 1: Total Stores -->
                    <div class="bg-slate-900 p-5 rounded-2xl border border-slate-800/80 shadow-md relative overflow-hidden group hover:border-purple-500/40 transition">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-slate-400">Total Stores / Tenants</span>
                            <div class="w-9 h-9 rounded-xl bg-purple-500/10 text-purple-400 border border-purple-500/20 flex items-center justify-center text-sm">
                                <i class="fa-solid fa-store"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-black text-white tracking-tight">{{ $totalTenants }}</h3>
                        <div class="flex items-center gap-1.5 text-[11px] text-emerald-400 font-semibold mt-2">
                            <i class="fa-solid fa-circle-check text-[10px]"></i>
                            <span>{{ $activeTenants }} Live & Active</span>
                        </div>
                    </div>

                    <!-- Card 2: Catalog Items -->
                    <div class="bg-slate-900 p-5 rounded-2xl border border-slate-800/80 shadow-md relative overflow-hidden group hover:border-sky-500/40 transition">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-slate-400">Catalog Items & Services</span>
                            <div class="w-9 h-9 rounded-xl bg-sky-500/10 text-sky-400 border border-sky-500/20 flex items-center justify-center text-sm">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-black text-white tracking-tight">{{ $totalCatalogItems }}</h3>
                        <div class="flex items-center gap-1.5 text-[11px] text-sky-400 font-semibold mt-2">
                            <i class="fa-solid fa-database text-[10px]"></i>
                            <span>Across all live businesses</span>
                        </div>
                    </div>

                    <!-- Card 3: Orders & Bookings -->
                    <div class="bg-slate-900 p-5 rounded-2xl border border-slate-800/80 shadow-md relative overflow-hidden group hover:border-emerald-500/40 transition">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-slate-400">Orders & Slot Bookings</span>
                            <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center text-sm">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-black text-white tracking-tight">{{ $totalOrders }}</h3>
                        <div class="flex items-center gap-1.5 text-[11px] text-emerald-400 font-semibold mt-2">
                            <i class="fa-brands fa-whatsapp text-xs"></i>
                            <span>WhatsApp & Web checkout</span>
                        </div>
                    </div>

                    <!-- Card 4: Platform GMV -->
                    <div class="bg-slate-900 p-5 rounded-2xl border border-slate-800/80 shadow-md relative overflow-hidden group hover:border-rose-500/40 transition">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-slate-400">Platform Volume (GMV)</span>
                            <div class="w-9 h-9 rounded-xl bg-rose-500/10 text-rose-400 border border-rose-500/20 flex items-center justify-center text-sm">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-black text-white tracking-tight">₹{{ number_format($totalGmv, 2) }}</h3>
                        <div class="flex items-center gap-1.5 text-[11px] text-rose-400 font-semibold mt-2">
                            <i class="fa-solid fa-arrow-trend-up text-[10px]"></i>
                            <span>Gross Platform Value</span>
                        </div>
                    </div>

                </div>

                <!-- Category Archetype Distribution -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-black text-slate-200 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-layer-group text-purple-400"></i> Category Archetype Distribution
                        </h3>
                        <button wire:click="$set('currentSection', 'archetypes')" class="text-xs font-bold text-purple-400 hover:text-purple-300 transition cursor-pointer">
                            Manage Rules &rarr;
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                        @foreach($archetypes as $arch)
                        <div class="bg-slate-900 p-5 rounded-2xl border border-slate-800/80 hover:border-purple-500/40 transition shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[10px] font-black uppercase text-purple-400 tracking-wider bg-purple-950/80 border border-purple-800/60 px-2 py-0.5 rounded-md">
                                        {{ $arch->code }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-400">
                                        {{ $arch->tenants_count }} Stores
                                    </span>
                                </div>
                                <h4 class="font-bold text-sm text-white mb-1">{{ $arch->name }}</h4>
                            </div>
                            <div class="pt-3 border-t border-slate-800/60 flex items-center justify-between text-xs">
                                <span class="text-slate-400 text-[11px]">Primary CTA:</span>
                                <span class="font-bold text-emerald-400 text-xs">{{ $arch->cta_label }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Deployed Stores (Quick Overview Table) -->
                <div class="bg-slate-900 rounded-2xl border border-slate-800/80 overflow-hidden shadow-lg">
                    <div class="p-5 border-b border-slate-800/80 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-base text-white">Deployed Stores (Quick Overview)</h3>
                            <p class="text-xs text-slate-400">Inspect active merchant storefronts and launch their management dashboards.</p>
                        </div>
                        <button wire:click="$set('currentSection', 'tenants')" class="text-xs font-bold text-purple-400 hover:text-purple-300 transition cursor-pointer">
                            View All {{ $totalTenants }} Stores &rarr;
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-900/60 border-b border-slate-800/80 text-slate-400 font-bold uppercase tracking-wider">
                                <tr>
                                    <th class="p-4">Business / Store</th>
                                    <th class="p-4">Archetype</th>
                                    <th class="p-4">City</th>
                                    <th class="p-4">Catalog</th>
                                    <th class="p-4">Active Theme</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-right">Quick Links</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/70">
                                @foreach($tenantsList as $t)
                                <tr class="hover:bg-slate-800/40 transition">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl flex items-center justify-center font-black text-white text-sm shrink-0 shadow-sm" style="background-color: {{ $t->brand_color ?: '#9333ea' }};">
                                                {{ strtoupper(substr($t->business_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong class="font-bold text-white block text-sm">{{ $t->business_name }}</strong>
                                                <span class="text-slate-400 text-[11px] font-mono">/store/{{ $t->slug }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-purple-950 text-purple-300 border border-purple-800/80 text-[10px] font-black uppercase px-2 py-0.5 rounded-full">
                                            {{ $t->archetype->code }}
                                        </span>
                                    </td>
                                    <td class="p-4 font-medium text-slate-300">{{ $t->city }}</td>
                                    <td class="p-4 font-bold text-slate-200">{{ $t->catalog_items_count ?? $t->catalogItems->count() }} items</td>
                                    <td class="p-4">
                                        <span class="text-slate-300 font-semibold capitalize">{{ str_replace('_', ' ', $t->active_theme ?? 'modern_clean') }}</span>
                                    </td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-1.5 text-[11px] font-bold {{ $t->is_active ? 'text-emerald-400' : 'text-rose-400' }}">
                                            <i class="fa-solid fa-circle text-[7px]"></i> {{ $t->is_active ? 'Active' : 'Disabled' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-right space-x-1.5 whitespace-nowrap">
                                        <a href="{{ route('store.show', $t->slug) }}" target="_blank" class="p-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs inline-block transition" title="View Store Website">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                        <a href="{{ route('store.dashboard', $t->slug) }}" wire:navigate class="p-2 rounded-xl bg-purple-900/60 hover:bg-purple-800 text-purple-200 text-xs inline-block transition" title="Open Merchant Dashboard">
                                            <i class="fa-solid fa-gauge"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            @endif

            <!-- ======================================================== -->
            <!-- SECTION 2: 🏪 ALL STORES & MERCHANTS                     -->
            <!-- ======================================================== -->
            @if($currentSection === 'tenants')
            <div class="space-y-6 animate-fade-in">
                
                <!-- Action Header Card -->
                <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800/80 shadow-md flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight">Merchant Stores & Businesses</h2>
                        <p class="text-xs text-slate-400 mt-1">
                            Deploy new digital stores, assign archetypes, toggle active states, or adjust themes and branding.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-3">
                        <!-- Search Input -->
                        <div class="relative w-full sm:w-64">
                            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-500 text-xs"></i>
                            <input wire:model.live.debounce.300ms="searchTenant" type="text" placeholder="Search by name, slug, city..." class="w-full pl-9 pr-3 py-2 text-xs rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <!-- Archetype Filter -->
                        <select wire:model.live="filterArchetype" class="w-full sm:w-auto text-xs font-bold bg-slate-800/80 border border-slate-700 text-slate-200 rounded-xl px-3 py-2 outline-none cursor-pointer">
                            <option value="all">All Archetypes</option>
                            @foreach($archetypes as $a)
                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>

                        <button wire:click="openCreateTenantModal" class="w-full sm:w-auto px-4 py-2 rounded-xl btn-brand-gradient text-white text-xs font-bold shadow-md transition flex items-center justify-center gap-1.5 cursor-pointer whitespace-nowrap">
                            <i class="fa-solid fa-plus"></i> Deploy Store
                        </button>
                    </div>
                </div>

                <!-- Stores Table -->
                <div class="bg-slate-900 rounded-2xl border border-slate-800/80 overflow-hidden shadow-lg">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-900/60 border-b border-slate-800/80 text-slate-400 font-bold uppercase tracking-wider">
                                <tr>
                                    <th class="p-4">Store Name & Slug</th>
                                    <th class="p-4">Archetype</th>
                                    <th class="p-4">City & Phone</th>
                                    <th class="p-4">Active Theme</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/70">
                                @forelse($tenantsList as $t)
                                <tr class="hover:bg-slate-800/40 transition">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-white text-base shadow-sm shrink-0" style="background-color: {{ $t->brand_color ?: '#9333ea' }};">
                                                {{ strtoupper(substr($t->business_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong class="font-bold text-white block text-sm">{{ $t->business_name }}</strong>
                                                <span class="text-purple-400 font-mono text-[11px]">/store/{{ $t->slug }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-purple-950 text-purple-300 border border-purple-800/80 text-[10px] font-black uppercase px-2.5 py-1 rounded-full">
                                            {{ $t->archetype->name }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-slate-300">
                                        <strong class="block text-white font-semibold">{{ $t->city }}</strong>
                                        <span class="text-slate-400 text-[11px]">{{ $t->phone }}</span>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-2">
                                            <span class="w-3 h-3 rounded-full shrink-0" style="background-color: {{ $t->brand_color ?: '#9333ea' }};"></span>
                                            <span class="text-slate-200 font-semibold capitalize">{{ str_replace('_', ' ', $t->active_theme ?? 'modern_clean') }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <button wire:click="toggleTenantStatus({{ $t->id }})" class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider transition cursor-pointer {{ $t->is_active ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : 'bg-rose-950 text-rose-300 border border-rose-800' }}">
                                            {{ $t->is_active ? 'Active' : 'Disabled' }}
                                        </button>
                                    </td>
                                    <td class="p-4 text-right space-x-1.5 whitespace-nowrap">
                                        <a href="{{ route('store.show', $t->slug) }}" target="_blank" class="p-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs inline-block transition" title="View Public Website">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('store.dashboard', $t->slug) }}" wire:navigate class="p-2 rounded-xl bg-purple-900/60 hover:bg-purple-800 text-purple-200 text-xs inline-block transition" title="Open Merchant Dashboard">
                                            <i class="fa-solid fa-gauge"></i>
                                        </a>
                                        <button wire:click="editTenant({{ $t->id }})" class="p-2 rounded-xl bg-sky-900/60 hover:bg-sky-800 text-sky-200 text-xs inline-block transition cursor-pointer" title="Edit Store Details">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button wire:click="deleteTenant({{ $t->id }})" onclick="return confirm('Are you sure you want to completely remove this store and its catalog?')" class="p-2 rounded-xl bg-rose-900/60 hover:bg-rose-800 text-rose-200 text-xs inline-block transition cursor-pointer" title="Delete Store">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-slate-400">
                                        No stores match your search query. Click "Deploy Store" above to launch one!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($tenantsList->hasPages())
                    <div class="p-4 border-t border-slate-800">
                        {{ $tenantsList->links() }}
                    </div>
                    @endif
                </div>

            </div>
            @endif

            <!-- ======================================================== -->
            <!-- SECTION 3: 🎛️ CATEGORY ARCHETYPES                       -->
            <!-- ======================================================== -->
            @if($currentSection === 'archetypes')
            <div class="space-y-6 animate-fade-in">
                
                <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800/80 shadow-md">
                    <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight">Category Archetypes & Industry Engine</h2>
                    <p class="text-xs text-slate-400 mt-1">
                        Archetypes control how storefronts adapt their user experiences, CTA buttons, forms, and Google Local SEO Schema.org structured data automatically.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($archetypes as $arch)
                    <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800/80 shadow-md flex flex-col justify-between hover:border-purple-500/40 transition">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="bg-gradient-to-r from-rose-500 to-purple-600 text-white font-black text-xs uppercase tracking-wider px-3 py-1 rounded-full shadow-xs">
                                    Code: {{ $arch->code }}
                                </span>
                                <span class="text-xs font-bold text-slate-400">
                                    {{ $arch->tenants_count }} Live Stores
                                </span>
                            </div>

                            <h3 class="font-black text-xl text-white mb-2">{{ $arch->name }}</h3>
                            <p class="text-xs text-slate-400 leading-relaxed mb-4">{{ $arch->description }}</p>

                            <div class="space-y-2 text-xs bg-slate-900/60 p-4 rounded-xl border border-slate-800/80">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400">Primary CTA Label:</span>
                                    <strong class="text-emerald-400 font-bold">{{ $arch->cta_label }}</strong>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400">Default Action Type:</span>
                                    <span class="font-mono text-purple-300 font-semibold">{{ $arch->default_cta }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400">Schema.org SEO Type:</span>
                                    <span class="font-mono text-sky-300 font-semibold">{{ $arch->schema_type }}</span>
                                </div>
                                <div class="pt-2 border-t border-slate-800">
                                    <span class="text-slate-400 block mb-1">Enabled Features:</span>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($arch->enabled_features ?? [] as $feat)
                                        <span class="bg-slate-800 text-slate-200 text-[10px] font-bold px-2 py-0.5 rounded">
                                            {{ $feat }}
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5 flex justify-end">
                            <button wire:click="editArchetype({{ $arch->id }})" class="px-5 py-2.5 rounded-xl bg-purple-900/70 hover:bg-purple-800 text-purple-200 font-bold text-xs transition cursor-pointer flex items-center gap-2">
                                <i class="fa-solid fa-pen-to-square"></i> Edit Archetype Settings
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            @endif

            <!-- ======================================================== -->
            <!-- SECTION 4: 📥 GLOBAL ORDERS & BOOKINGS                  -->
            <!-- ======================================================== -->
            @if($currentSection === 'orders')
            <div class="space-y-6 animate-fade-in">
                
                <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800/80 shadow-md">
                    <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight">Global Orders & Appointments Stream</h2>
                    <p class="text-xs text-slate-400 mt-1">
                        Real-time stream of all customer checkouts, clinic appointment bookings, and B2B quote inquiries across the platform.
                    </p>
                </div>

                <!-- Orders Table -->
                <div class="bg-slate-900 rounded-2xl border border-slate-800/80 overflow-hidden shadow-lg">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-900/60 border-b border-slate-800/80 text-slate-400 font-bold uppercase tracking-wider">
                                <tr>
                                    <th class="p-4">Order ID & Date</th>
                                    <th class="p-4">Store Name</th>
                                    <th class="p-4">Customer Name</th>
                                    <th class="p-4">Phone</th>
                                    <th class="p-4">Type</th>
                                    <th class="p-4">Total Amount</th>
                                    <th class="p-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/70">
                                @forelse($recentOrders as $ord)
                                <tr class="hover:bg-slate-800/40 transition">
                                    <td class="p-4 font-bold text-white">
                                        {{ $ord->order_number }}
                                        <span class="text-[10px] text-slate-500 block">{{ $ord->created_at->format('d M, h:i A') }}</span>
                                    </td>
                                    <td class="p-4 font-bold text-purple-400">
                                        {{ $ord->tenant->business_name ?? 'Unknown Store' }}
                                    </td>
                                    <td class="p-4 font-semibold text-slate-200">{{ $ord->customer_name }}</td>
                                    <td class="p-4 text-slate-400">{{ $ord->customer_phone }}</td>
                                    <td class="p-4">
                                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded {{ $ord->type === 'booking' ? 'bg-sky-950 text-sky-300' : ($ord->type === 'quote_inquiry' ? 'bg-amber-950 text-amber-300' : 'bg-emerald-950 text-emerald-300') }}">
                                            {{ str_replace('_', ' ', $ord->type) }}
                                        </span>
                                    </td>
                                    <td class="p-4 font-black text-white">₹{{ number_format($ord->total_amount, 2) }}</td>
                                    <td class="p-4">
                                        <span class="bg-slate-800 text-slate-300 text-[10px] font-bold px-2 py-0.5 rounded capitalize">
                                            {{ $ord->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-slate-400">
                                        No customer orders placed yet across the platform.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($recentOrders->hasPages())
                    <div class="p-4 border-t border-slate-800">
                        {{ $recentOrders->links() }}
                    </div>
                    @endif
                </div>

            </div>
            @endif

            <!-- ======================================================== -->
            <!-- SECTION 5: ⚙️ SYSTEM & AI SETTINGS                      -->
            <!-- ======================================================== -->
            @if($currentSection === 'settings')
            <div class="space-y-6 animate-fade-in">
                
                <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800/80 shadow-md">
                    <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight">Platform System & AI Integrations</h2>
                    <p class="text-xs text-slate-400 mt-1">
                        Connect Google Gemini or OpenAI APIs for auto-generating storefront content and review server and database health.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- AI Engine Settings -->
                    <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800/80 shadow-md space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center font-bold text-lg border border-purple-500/20">
                                <i class="fa-solid fa-robot"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-white">AI Content Generator Engine</h3>
                                <p class="text-xs text-slate-400">Powers automated tagline, bio, and catalog writing for merchants.</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">AI Model Provider</label>
                            <select wire:model="aiProvider" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none">
                                <option value="gemini">Google Gemini 1.5 Pro / Flash</option>
                                <option value="openai">OpenAI GPT-4o / GPT-3.5</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">API Key</label>
                            <input wire:model="geminiApiKey" type="password" placeholder="AIzaSy... or sk-..." class="w-full px-3 py-2 text-xs rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none focus:ring-2 focus:ring-purple-500">
                            <span class="text-[11px] text-slate-500 mt-1 block">API keys are securely stored in server environment.</span>
                        </div>

                        <div class="pt-2 flex justify-end">
                            <button wire:click="saveSystemSettings" class="px-5 py-2.5 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-md transition cursor-pointer flex items-center gap-2">
                                <i class="fa-solid fa-floppy-disk"></i> Save AI Credentials
                            </button>
                        </div>
                    </div>

                    <!-- Database & Environment Health -->
                    <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800/80 shadow-md space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold text-lg border border-emerald-500/20">
                                <i class="fa-solid fa-server"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-white">Infrastructure & DB Status</h3>
                                <p class="text-xs text-slate-400">Live health check of services, drivers and database engine.</p>
                            </div>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800/80 flex items-center justify-between">
                                <span class="text-slate-400">Database Engine:</span>
                                <span class="font-bold text-emerald-400"><i class="fa-solid fa-circle text-[8px]"></i> MySQL (Port 3306 - Active)</span>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800/80 flex items-center justify-between">
                                <span class="text-slate-400">Reactive Frontend:</span>
                                <span class="font-bold text-purple-400">Livewire v4.4.6 (SPA wire:navigate active)</span>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800/80 flex items-center justify-between">
                                <span class="text-slate-400">Asset Compiler:</span>
                                <span class="font-bold text-sky-400">Vite 8 & Tailwind CSS v4</span>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-800/80 flex items-center justify-between">
                                <span class="text-slate-400">Multi-Tenant Routing:</span>
                                <span class="font-bold text-amber-400">Dynamic Slug & Polymorphic Archetypes</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            @endif

        </main>

    </div>

    <!-- ======================================================== -->
    <!-- ➕ DEPLOY / EDIT TENANT MODAL                            -->
    <!-- ======================================================== -->
    @if($showTenantModal)
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl text-slate-100">
            
            <div class="p-5 border-b border-slate-800 flex items-center justify-between bg-slate-900/50">
                <h3 class="font-black text-base text-white">
                    {{ $editingTenantId ? 'Edit Store: ' . $tenantName : 'Deploy New Merchant Store' }}
                </h3>
                <button wire:click="$set('showTenantModal', false)" class="text-slate-400 hover:text-white text-xl font-bold cursor-pointer">&times;</button>
            </div>

            <form wire:submit.prevent="saveTenant" class="p-6 space-y-4 text-xs">
                
                <div>
                    <label class="block font-bold text-slate-300 mb-1">Business / Brand Name *</label>
                    <input wire:model="tenantName" type="text" placeholder="e.g. Apex Medical Care, Sharma Kirana" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none focus:ring-2 focus:ring-purple-500" required>
                    @error('tenantName') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-300 mb-1">URL Slug</label>
                        <input wire:model="tenantSlug" type="text" placeholder="auto-generated from name" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-300 mb-1">Industry Archetype *</label>
                        <select wire:model="tenantArchetypeId" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none">
                            @foreach($archetypes as $arch)
                            <option value="{{ $arch->id }}">{{ $arch->name }} ({{ $arch->code }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-300 mb-1">Mobile / WhatsApp *</label>
                        <input wire:model="tenantPhone" type="tel" placeholder="9876543210" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none" required>
                        @error('tenantPhone') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-bold text-slate-300 mb-1">City / Town *</label>
                        <input wire:model="tenantCity" type="text" placeholder="Mumbai, Nagpur, Kanpur" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none" required>
                        @error('tenantCity') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold text-slate-300 mb-1">Initial Theme</label>
                        <select wire:model="tenantTheme" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none">
                            <option value="modern_clean">Modern Clean</option>
                            <option value="minimal_card">Minimal Card</option>
                            <option value="dark_luxury">Dark Luxury</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-300 mb-1">Brand Color</label>
                        <div class="flex items-center gap-2">
                            <input wire:model="tenantBrandColor" type="color" class="w-10 h-9 p-1 rounded-xl bg-slate-800 border border-slate-700 cursor-pointer">
                            <input wire:model="tenantBrandColor" type="text" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white font-mono text-xs">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-300 mb-1">Tagline (Optional)</label>
                    <input wire:model="tenantTagline" type="text" placeholder="e.g. Advanced Care & Painless Treatment in Nagpur" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none">
                </div>

                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" wire:click="$set('showTenantModal', false)" class="px-5 py-2.5 rounded-xl border border-slate-700 font-semibold text-xs hover:bg-slate-800 transition cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-md transition cursor-pointer">
                        {{ $editingTenantId ? 'Save Changes' : 'Deploy Store' }}
                    </button>
                </div>

            </form>

        </div>
    </div>
    @endif

    <!-- ======================================================== -->
    <!-- ✏️ EDIT ARCHETYPE MODAL                                 -->
    <!-- ======================================================== -->
    @if($showArchetypeModal)
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl max-w-md w-full overflow-hidden shadow-2xl text-slate-100">
            
            <div class="p-5 border-b border-slate-800 flex items-center justify-between bg-slate-900/50">
                <h3 class="font-black text-base text-white">
                    Edit Archetype: {{ $archetypeCode }}
                </h3>
                <button wire:click="$set('showArchetypeModal', false)" class="text-slate-400 hover:text-white text-xl font-bold cursor-pointer">&times;</button>
            </div>

            <form wire:submit.prevent="saveArchetype" class="p-6 space-y-4 text-xs">
                
                <div>
                    <label class="block font-bold text-slate-300 mb-1">Category Name *</label>
                    <input wire:model="archetypeName" type="text" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none" required>
                </div>

                <div>
                    <label class="block font-bold text-slate-300 mb-1">Button CTA Label *</label>
                    <input wire:model="archetypeCta" type="text" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none" required>
                    <span class="text-[11px] text-slate-500">e.g. "Book Appointment Slot", "Add to Cart", "Request a Quote"</span>
                </div>

                <div>
                    <label class="block font-bold text-slate-300 mb-1">Schema.org Type</label>
                    <input wire:model="archetypeSchema" type="text" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none font-mono">
                    <span class="text-[11px] text-slate-500">Used for automated Google Local SEO structured data</span>
                </div>

                <div>
                    <label class="block font-bold text-slate-300 mb-1">Description</label>
                    <textarea wire:model="archetypeDescription" rows="3" class="w-full px-3 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white outline-none"></textarea>
                </div>

                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" wire:click="$set('showArchetypeModal', false)" class="px-5 py-2.5 rounded-xl border border-slate-700 font-semibold text-xs hover:bg-slate-800 transition cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-md transition cursor-pointer">
                        Update Archetype
                    </button>
                </div>

            </form>

        </div>
    </div>
    @endif

</div>
