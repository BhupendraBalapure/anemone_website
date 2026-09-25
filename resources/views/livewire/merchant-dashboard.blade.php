<div class="min-h-screen bg-slate-100/70 text-slate-800 flex w-full antialiased font-sans">

    <!-- ======================================================== -->
    <!-- 🧭 LEFT SIDEBAR (Native Flex Sibling, Zero Overlap)       -->
    <!-- ======================================================== -->
    <aside class="w-64 xl:w-72 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0 h-screen sticky top-0 z-30 select-none">
        
        <!-- Top: Store Brand & Navigation -->
        <div class="flex-1 flex flex-col min-h-0 overflow-y-auto">
            
            <!-- Simple & Clean Store Profile Header -->
            <div class="p-4 border-b border-slate-100 bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-extrabold text-base shadow-sm shrink-0" style="background: linear-gradient(135deg, {{ $brandColor }}, #7c3aed);">
                        {{ strtoupper(substr($tenant->business_name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <h2 class="text-sm font-bold text-slate-900 tracking-tight leading-tight truncate" title="{{ $tenant->business_name }}">
                                {{ $tenant->business_name }}
                            </h2>
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1 animate-pulse"></span> Live
                            </span>
                        </div>
                        <div class="flex items-center gap-1.5 text-[11px] text-slate-500 mt-0.5 truncate">
                            <span class="font-medium text-purple-700 font-semibold truncate">{{ $tenant->settings['business_category'] ?? ($tenant->archetype->name ?? 'Store') }}</span>
                            @if($tenant->city)
                            <span class="text-slate-300">&bull;</span>
                            <span class="text-slate-500 truncate">{{ $tenant->city }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <!-- Navigation Links -->
            <nav class="px-3 space-y-5 flex-1 mt-2">
                
                <div>
                    <span class="px-3 text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-1.5">
                        Store Management
                    </span>
                    <div class="space-y-1">
                        
                        <!-- Templates & Theme Studio -->
                        <button wire:click="$set('activeTab', 'templates')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer {{ $activeTab === 'templates' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-palette w-4 text-center {{ $activeTab === 'templates' ? 'text-purple-600' : 'text-slate-400' }}"></i>
                                <span>Templates & Themes</span>
                            </div>
                            <span class="text-[9px] uppercase px-1.5 py-0.5 rounded font-bold {{ $activeTab === 'templates' ? 'bg-purple-200/60 text-purple-800' : 'bg-slate-100 text-slate-500' }}">
                                Studio
                            </span>
                        </button>

                        <!-- Products & Services -->
                        <button wire:click="$set('activeTab', 'catalog')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer {{ $activeTab === 'catalog' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-boxes-stacked w-4 text-center {{ $activeTab === 'catalog' ? 'text-purple-600' : 'text-slate-400' }}"></i>
                                <span>Products & Catalog</span>
                            </div>
                            <span class="text-[10px] px-2 py-0.5 rounded-full font-bold {{ $activeTab === 'catalog' ? 'bg-purple-200/60 text-purple-800' : 'bg-slate-100 text-slate-600' }}">
                                {{ $catalogCount }}
                            </span>
                        </button>

                        <!-- Store Profile & SEO -->
                        <button wire:click="$set('activeTab', 'profile')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer {{ $activeTab === 'profile' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-sliders w-4 text-center {{ $activeTab === 'profile' ? 'text-purple-600' : 'text-slate-400' }}"></i>
                                <span>Profile & Local SEO</span>
                            </div>
                        </button>

                        <!-- Orders & Inquiries -->
                        <button wire:click="$set('activeTab', 'orders')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer {{ $activeTab === 'orders' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-inbox w-4 text-center {{ $activeTab === 'orders' ? 'text-purple-600' : 'text-slate-400' }}"></i>
                                <span>Orders & Inquiries</span>
                            </div>
                            <span class="text-[10px] px-2 py-0.5 rounded-full font-bold {{ $activeTab === 'orders' ? 'bg-purple-200/60 text-purple-800' : 'bg-slate-100 text-slate-600' }}">
                                {{ $ordersCount }}
                            </span>
                        </button>

                        <!-- AI Template Studio -->
                        <button wire:click="$set('activeTab', 'ai_studio')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer {{ $activeTab === 'ai_studio' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-wand-magic-sparkles w-4 text-center text-amber-500"></i>
                                <span>AI Template Studio</span>
                            </div>
                            <span class="text-[9px] uppercase px-1.5 py-0.5 rounded font-black bg-amber-100 text-amber-800">
                                AI
                            </span>
                        </button>

                    </div>
                </div>

                <div>
                    <span class="px-3 text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-1.5">
                        Live Store
                    </span>
                    <div class="space-y-1">
                        <a href="{{ route('store.show', $tenant->slug) }}" target="_blank" class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:text-purple-700 hover:bg-purple-50 transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-arrow-up-right-from-square w-4 text-center text-purple-600"></i>
                                <span>View Live Website</span>
                            </div>
                            <i class="fa-solid fa-external-link text-[10px] text-slate-400"></i>
                        </a>

                        @if(auth()->check() && auth()->user()->isSuperAdmin())
                        <a href="{{ route('admin.dashboard') }}" wire:navigate class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:text-amber-700 hover:bg-amber-50 transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-crown w-4 text-center text-amber-500"></i>
                                <span>Super Admin Panel</span>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>

            </nav>

        </div>

        <!-- Bottom User Profile Card & Sign Out -->
        <div class="p-3 border-t border-slate-100 bg-slate-50/70 shrink-0">
            <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-white border border-slate-200 shadow-2xs">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-purple-600 to-rose-500 flex items-center justify-center text-white font-black text-xs shrink-0 shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? $tenant->business_name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <span class="block text-xs font-bold text-slate-900 truncate leading-tight">
                            {{ auth()->user()->name ?? $tenant->business_name }}
                        </span>
                        <span class="block text-[10px] text-slate-500 truncate">
                            {{ auth()->user()->email ?? $tenant->slug }}
                        </span>
                    </div>
                </div>

                <a href="{{ route('logout') }}" class="h-7 w-7 rounded-lg bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 border border-slate-200 hover:border-rose-200 transition flex items-center justify-center cursor-pointer shrink-0" title="Logout">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                </a>
            </div>
        </div>

    </aside>

    <!-- ======================================================== -->
    <!-- 🖥️ MAIN CONTENT AREA (Native Flex Sibling)                -->
    <!-- ======================================================== -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-100/70">
        
        <!-- Top Sticky Header -->
        <header class="h-16 px-6 lg:px-8 border-b border-slate-200/90 bg-white/90 backdrop-blur-xl flex items-center justify-between sticky top-0 z-20 shrink-0 shadow-2xs">
            
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2.5">
                <span class="text-xs font-bold text-slate-400 truncate max-w-[120px] sm:max-w-none">{{ $tenant->business_name }}</span>
                <span class="text-xs text-slate-300">/</span>
                <div class="flex items-center gap-2">
                    @if($activeTab === 'templates')
                        <i class="fa-solid fa-palette text-purple-600 text-xs"></i>
                        <span class="text-sm font-black text-slate-900">Templates & Theme Studio</span>
                    @elseif($activeTab === 'catalog')
                        <i class="fa-solid fa-boxes-stacked text-purple-600 text-xs"></i>
                        <span class="text-sm font-black text-slate-900">Products & Services</span>
                    @elseif($activeTab === 'profile')
                        <i class="fa-solid fa-sliders text-purple-600 text-xs"></i>
                        <span class="text-sm font-black text-slate-900">Store Profile & Local SEO</span>
                    @elseif($activeTab === 'orders')
                        <i class="fa-solid fa-inbox text-purple-600 text-xs"></i>
                        <span class="text-sm font-black text-slate-900">Orders & Inquiries</span>
                    @elseif($activeTab === 'ai_studio')
                        <i class="fa-solid fa-wand-magic-sparkles text-amber-500 text-xs"></i>
                        <span class="text-sm font-black text-slate-900">AI Template Studio</span>
                    @endif
                </div>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('store.show', $tenant->slug) }}" target="_blank" class="h-9 px-4 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-md transition hover:scale-[1.02] flex items-center gap-2">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    <span>View Live Website</span>
                </a>
            </div>

        </header>

        <!-- ⚡ Flash Message Notification -->
        @if($flashMessage)
        <div class="px-6 lg:px-8 mt-5">
            <div class="bg-emerald-600 text-white px-5 py-3 rounded-2xl text-xs sm:text-sm font-semibold flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <span>{{ $flashMessage }}</span>
                </div>
                <button wire:click="$set('flashMessage', '')" class="text-emerald-200 hover:text-white cursor-pointer text-lg font-bold">&times;</button>
            </div>
        </div>
        @endif

        <!-- 📦 Main Dashboard Workspace -->
        <main class="flex-1 p-6 lg:p-8 space-y-8 overflow-y-auto">

        <!-- ========================================== -->
        <!-- TAB 1: 🎨 TEMPLATES & THEME STUDIO         -->
        <!-- ========================================== -->
        @if($activeTab === 'templates')
        <div class="space-y-8 animate-fade-in">
            
            <!-- Section Header -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[11px] font-black uppercase tracking-wider text-purple-600">Zero Data Loss Theme Engine</span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-purple-50 border border-purple-200 text-[11px] font-bold text-purple-700">
                            {{ $tenant->business_category ?? $tenant->archetype->name }}
                        </span>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Website Templates & Layout Studio</h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Switch visual templates anytime. All your catalog items, services, orders, and Google SEO schemas are preserved 100%.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('store.show', $tenant->slug) }}" target="_blank" class="px-5 py-2.5 rounded-xl border border-slate-300 font-bold text-xs hover:bg-slate-50 transition flex items-center gap-2">
                        <i class="fa-solid fa-eye text-slate-500"></i> Preview Website
                    </a>
                    <button wire:click="saveTemplateLayoutSettings" class="px-5 py-2.5 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-md transition cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-check"></i> Save Changes
                    </button>
                </div>
            </div>

            <!-- 1. Real Industry Business Templates Gallery -->
            <div>
                @php
                    $cat = $tenant->settings['business_category'] ?? ($businessCategory ?: ($tenant->archetype->name ?? 'Hotels & Motels'));
                    $isHotelCategory = stripos($cat, 'Hotel') !== false || stripos($cat, 'Motel') !== false;
                @endphp

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
                    <div>
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-purple-600 text-white flex items-center justify-center text-xs font-black">1</span>
                            Real-World Industry Website Templates
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Industry-crafted templates matching your registered business. Applying a template adapts your live storefront, hero imagery, room tariffs, and booking CTAs with zero data loss.
                        </p>
                    </div>
                </div>

                <!-- 🎯 Category Filter & Industry Switcher Banner -->
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6 bg-purple-50/70 border border-purple-200/80 p-4 rounded-2xl shadow-2xs">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center text-base shadow-sm shrink-0">
                            @if($templateFilterMode === 'ecommerce')
                                <i class="fa-solid fa-cart-shopping"></i>
                            @elseif($templateFilterMode === 'landing_page')
                                <i class="fa-solid fa-bullhorn"></i>
                            @elseif($this->activeCategory === 'Hotels & Motels')
                                <i class="fa-solid fa-hotel"></i>
                            @else
                                <i class="fa-solid fa-globe"></i>
                            @endif
                        </span>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-xs font-black text-slate-900 uppercase tracking-wider">Business Category Filter:</span>
                                <span class="bg-purple-600 text-white text-[11px] font-black px-2.5 py-0.5 rounded-full shadow-xs">
                                    {{ $this->activeCategory }}
                                </span>
                                <span class="text-slate-300">•</span>
                                <span class="text-xs font-black text-slate-700 uppercase tracking-wider">Mode:</span>
                                <span class="bg-slate-200 text-slate-800 text-[11px] font-bold px-2.5 py-0.5 rounded-full shadow-2xs">
                                    {{ $templateFilterMode === 'ecommerce' ? '🛍️ E-Commerce' : ($templateFilterMode === 'landing_page' ? '🚀 Landing Page' : ($templateFilterMode === 'business_website' ? '🌐 Business Website' : '🎯 All Templates')) }}
                                </span>
                            </div>
                            <p class="text-[11px] text-slate-500 mt-0.5">Showing templates exclusively tailored for <strong>{{ $this->activeCategory }}</strong>.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 flex-wrap shrink-0">
                        <!-- Category Quick Dropdown -->
                        <div class="relative">
                            <select wire:model.live="selectedCategoryFilter" class="text-xs font-bold bg-white text-slate-800 border border-slate-300 rounded-xl px-3 py-1.5 cursor-pointer shadow-2xs focus:ring-2 focus:ring-purple-500">
                                @foreach(\App\Services\TemplateCatalog::categories() as $cName)
                                    <option value="{{ $cName }}">{{ $cName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Mode Filter Buttons (Exclusively Scoped to Selected Category) -->
                        <button type="button" wire:click="setTemplateFilterMode('category')" class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer flex items-center gap-1.5 {{ in_array($templateFilterMode, ['category', 'all']) ? 'bg-purple-600 text-white shadow' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                            <i class="fa-solid fa-layer-group text-[10px]"></i> All ({{ count(\App\Services\TemplateCatalog::getForCategory($this->activeCategory, 'category')) }})
                        </button>
                        <button type="button" wire:click="setTemplateFilterMode('business_website')" class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer flex items-center gap-1.5 {{ $templateFilterMode === 'business_website' ? 'bg-purple-600 text-white shadow' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                            <i class="fa-solid fa-globe text-[10px]"></i> Website
                        </button>
                        <button type="button" wire:click="setTemplateFilterMode('ecommerce')" class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer flex items-center gap-1.5 {{ $templateFilterMode === 'ecommerce' ? 'bg-purple-600 text-white shadow' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                            <i class="fa-solid fa-cart-shopping text-[10px]"></i> E-Commerce
                        </button>
                        <button type="button" wire:click="setTemplateFilterMode('landing_page')" class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer flex items-center gap-1.5 {{ $templateFilterMode === 'landing_page' ? 'bg-purple-600 text-white shadow' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}">
                            <i class="fa-solid fa-bullhorn text-[10px]"></i> Landing Page
                        </button>
                    </div>
                </div>

                <!-- Template Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($this->studioTemplates as $tpl)
                    @php
                        $isActive = $activeTheme === $tpl['id'];
                        $isDark = in_array($tpl['id'], ['dark_luxury']);
                    @endphp
                    <div class="p-5 rounded-3xl border-2 transition relative flex flex-col justify-between shadow-xs hover:shadow-md {{ $isDark ? 'bg-slate-900 text-white border-slate-800' : 'bg-white text-slate-900 border-slate-200 hover:border-slate-300' }} {{ $isActive ? 'ring-4' : '' }}" style="{{ $isActive ? 'border-color: ' . ($tpl['suggested_color'] ?? '#9333EA') . '; --tw-ring-color: ' . ($tpl['suggested_color'] ?? '#9333EA') . '33;' : '' }}">
                        <div>
                            <!-- Visual Banner -->
                            <div class="h-44 rounded-2xl relative overflow-hidden mb-4 shadow-inner group border {{ $isDark ? 'border-slate-800' : 'border-slate-100' }}">
                                <img src="{{ $tpl['image_url'] }}" alt="{{ $tpl['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent flex flex-col justify-between p-3.5">
                                    <div class="flex items-center justify-between gap-1 flex-wrap">
                                        <span class="text-white text-[10px] font-black uppercase px-2.5 py-0.5 rounded-full shadow-sm flex items-center gap-1" style="background-color: {{ $tpl['suggested_color'] ?? '#9333EA' }};">
                                            <i class="fa-solid {{ $tpl['icon'] ?? \App\Services\TemplateCatalog::getIconForTheme($tpl['id']) }} text-[9px]"></i>
                                            <span>{{ $tpl['category'] }}</span>
                                        </span>
                                        <span class="bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1">
                                            @if(($tpl['type'] ?? '') === 'ecommerce')
                                                <i class="fa-solid fa-cart-shopping text-emerald-400 text-[9px]"></i> E-Commerce
                                            @elseif(($tpl['type'] ?? '') === 'landing_page')
                                                <i class="fa-solid fa-bullhorn text-amber-400 text-[9px]"></i> Landing Page
                                            @else
                                                <i class="fa-solid fa-globe text-sky-400 text-[9px]"></i> Business Website
                                            @endif
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-white font-black text-sm block leading-tight">{{ $tpl['title'] }}</span>
                                        <span class="text-slate-200 text-[11px] font-semibold">{{ $tpl['subheadline'] ?? '' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-1.5">
                                <h4 class="font-black text-base {{ $isDark ? 'text-white' : 'text-slate-900' }}">{{ $tpl['title'] }}</h4>
                                @if($isActive)
                                <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full flex items-center gap-1" style="background-color: {{ ($tpl['suggested_color'] ?? '#9333EA') }}22; color: {{ $tpl['suggested_color'] ?? '#9333EA' }};">
                                    <i class="fa-solid fa-circle-check text-[10px]"></i> Active
                                </span>
                                @endif
                            </div>

                            <p class="text-xs {{ $isDark ? 'text-slate-400' : 'text-slate-500' }} leading-relaxed mb-3">
                                {{ $tpl['description'] }}
                            </p>

                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach($tpl['features'] as $feat)
                                    <span class="{{ $isDark ? 'bg-slate-800 text-slate-300' : 'bg-slate-100 text-slate-700' }} text-[10px] font-bold px-2 py-0.5 rounded-md">
                                        {{ $feat }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="border-t {{ $isDark ? 'border-slate-800' : 'border-slate-100' }} pt-3 flex items-center justify-between gap-2">
                            <button type="button" wire:click="openTemplatePreview('{{ $tpl['id'] }}')" class="px-3.5 py-2 rounded-xl border {{ $isDark ? 'border-slate-700 text-slate-300 hover:bg-slate-800' : 'border-slate-300 text-slate-700 hover:bg-slate-50' }} text-xs font-bold transition flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-eye" style="color: {{ $tpl['suggested_color'] ?? '#9333EA' }};"></i> Preview
                            </button>
                            <button type="button" wire:click="applyTemplate('{{ $tpl['id'] }}', '{{ $tpl['suggested_color'] }}')" class="px-3.5 py-2 rounded-xl text-white text-xs font-bold shadow-sm transition flex items-center gap-1.5 cursor-pointer hover:scale-[1.02]" style="background-color: {{ $tpl['suggested_color'] ?? '#9333EA' }};">
                                <i class="fa-solid fa-check"></i> Apply Template
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- 2. Brand Color Palette Customizer -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-purple-600 text-white flex items-center justify-center text-xs font-black">2</span>
                    Brand Accent Color Palette
                </h3>
                <p class="text-xs text-slate-500 mb-5">
                    Colors adjust all website badges, headers, gradients, and CTA highlights dynamically across any chosen template.
                </p>

                <div class="flex flex-wrap items-center gap-4">
                    @foreach([
                        '#9333EA' => 'Royal Purple',
                        '#F43F5E' => 'Rose Flame',
                        '#FB923C' => 'Sunrise Amber',
                        '#3B82F6' => 'Ocean Blue',
                        '#10B981' => 'Emerald Green',
                        '#0F172A' => 'Midnight Obsidian'
                    ] as $hex => $label)
                    <button type="button" wire:click="selectBrandColor('{{ $hex }}')" class="flex items-center gap-2.5 px-4 py-2.5 rounded-2xl border-2 transition cursor-pointer {{ $brandColor === $hex ? 'border-purple-600 bg-purple-50/50 shadow-xs font-bold' : 'border-slate-200 hover:border-slate-300' }}">
                        <span class="w-6 h-6 rounded-full shadow-inner border border-white" style="background-color: {{ $hex }};"></span>
                        <span class="text-xs text-slate-800">{{ $label }}</span>
                        @if($brandColor === $hex)
                        <i class="fa-solid fa-circle-check text-purple-600 text-xs"></i>
                        @endif
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- 3. Template Section Visibility Toggles -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-purple-600 text-white flex items-center justify-center text-xs font-black">3</span>
                    Website Section Display Toggles
                </h3>
                <p class="text-xs text-slate-500 mb-5">
                    Control which marketing blocks appear on your public website. You can turn sections on/off according to your business needs.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs font-semibold">
                    
                    <label class="p-4 rounded-2xl border border-slate-200 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition">
                        <div>
                            <strong class="block text-slate-900 mb-0.5">Hero Trust Pills</strong>
                            <span class="text-slate-500 text-[11px]">Rating, timing, and verified badges</span>
                        </div>
                        <input type="checkbox" wire:model="showTrustPills" class="w-4 h-4 text-purple-600 rounded">
                    </label>

                    <label class="p-4 rounded-2xl border border-slate-200 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition">
                        <div>
                            <strong class="block text-slate-900 mb-0.5">Why Choose Us Strip</strong>
                            <span class="text-slate-500 text-[11px]">4 Archetype specialty highlight cards</span>
                        </div>
                        <input type="checkbox" wire:model="showHighlights" class="w-4 h-4 text-purple-600 rounded">
                    </label>

                    <label class="p-4 rounded-2xl border border-slate-200 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition">
                        <div>
                            <strong class="block text-slate-900 mb-0.5">Patient / Client Reviews</strong>
                            <span class="text-slate-500 text-[11px]">5-star testimonials & verified reviews</span>
                        </div>
                        <input type="checkbox" wire:model="showReviews" class="w-4 h-4 text-purple-600 rounded">
                    </label>

                    <label class="p-4 rounded-2xl border border-slate-200 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition">
                        <div>
                            <strong class="block text-slate-900 mb-0.5">Working Hours & Timings</strong>
                            <span class="text-slate-500 text-[11px]">Schedule widget with live open status</span>
                        </div>
                        <input type="checkbox" wire:model="showHours" class="w-4 h-4 text-purple-600 rounded">
                    </label>

                    <label class="p-4 rounded-2xl border border-slate-200 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition">
                        <div>
                            <strong class="block text-slate-900 mb-0.5">WhatsApp Inquiry Box</strong>
                            <span class="text-slate-500 text-[11px]">Quick contact form sending to WhatsApp</span>
                        </div>
                        <input type="checkbox" wire:model="showInquiryForm" class="w-4 h-4 text-purple-600 rounded">
                    </label>

                </div>

                <div class="mt-6 flex justify-end">
                    <button wire:click="saveTemplateLayoutSettings" class="px-6 py-3 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-md transition cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Save Layout Preferences
                    </button>
                </div>
            </div>

        </div>
        @endif


        <!-- ========================================== -->
        <!-- TAB 2: 🏷️ PRODUCTS & SERVICES CATALOG      -->
        <!-- ========================================== -->
        @if($activeTab === 'catalog')
        <div class="space-y-6 animate-fade-in">
            
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                        {{ $tenant->archetype->code === 'service' ? 'Clinical Services & Consultation Rates' : ($tenant->archetype->code === 'b2b' ? 'Industrial Fabrication & Products' : 'Store Products Catalog') }}
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Add, edit, or adjust prices and service durations. Changes reflect on your website instantly.
                    </p>
                </div>

                <button wire:click="openNewItemModal" class="px-5 py-2.5 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-md transition cursor-pointer flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Add New {{ $tenant->archetype->code === 'service' ? 'Service' : 'Item' }}
                </button>
            </div>

            <!-- Items Table -->
            <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-bold uppercase tracking-wider">
                            <tr>
                                <th class="p-4">Item / Service</th>
                                <th class="p-4">Category</th>
                                <th class="p-4">Price</th>
                                @if($tenant->archetype->code === 'service')
                                <th class="p-4">Slot Duration</th>
                                @elseif($tenant->archetype->code === 'b2b')
                                <th class="p-4">Min Order (MOQ)</th>
                                @else
                                <th class="p-4">Stock Status</th>
                                @endif
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($tenant->catalogItems as $item)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=100' }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200">
                                        <div>
                                            <strong class="text-slate-900 block font-bold text-sm">{{ $item->title }}</strong>
                                            <span class="text-[11px] text-slate-400">ID: #{{ $item->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 font-semibold text-slate-600">
                                    <span class="bg-slate-100 text-slate-700 px-2.5 py-1 rounded-md text-[11px]">
                                        {{ $item->category_name ?: 'General' }}
                                    </span>
                                </td>
                                <td class="p-4 font-bold text-slate-900">
                                    ₹{{ number_format($item->price, 2) }}
                                    @if($item->compare_at_price)
                                    <span class="line-through text-slate-400 text-[10px] block">₹{{ number_format($item->compare_at_price, 2) }}</span>
                                    @endif
                                </td>
                                
                                @if($tenant->archetype->code === 'service')
                                <td class="p-4 font-semibold text-sky-700">
                                    <i class="fa-regular fa-clock"></i> {{ $item->duration_minutes ?: 30 }} Mins
                                </td>
                                @elseif($tenant->archetype->code === 'b2b')
                                <td class="p-4 font-semibold text-amber-700">
                                    {{ $item->min_order_qty ?: 10 }} Units
                                </td>
                                @else
                                <td class="p-4 font-semibold text-emerald-600">
                                    <i class="fa-solid fa-circle-check"></i> In Stock
                                </td>
                                @endif

                                <td class="p-4 text-right">
                                    <button wire:click="editItem({{ $item->id }})" class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition mr-1 cursor-pointer" title="Edit Item">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button wire:click="deleteItem({{ $item->id }})" onclick="return confirm('Are you sure you want to remove this item?')" class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition cursor-pointer" title="Delete Item">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400">
                                    No items in catalog yet. Click "Add New Item" above to create your first item!
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        @endif


        <!-- ========================================== -->
        <!-- TAB 3: 🏢 STORE PROFILE & LOCAL SEO        -->
        <!-- ========================================== -->
        @if($activeTab === 'profile')
        <div class="space-y-6 animate-fade-in">
            
            <!-- Page Header -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Store Profile & Google Local SEO</h2>
                    <p class="text-xs text-slate-500 mt-1">
                        View everything configured for your store. Business name, contact, archetype, theme, and SEO settings.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1.5 shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Store Active Online
                    </span>
                    <a href="{{ route('store.show', $tenant->slug) }}" target="_blank" class="px-4 py-2 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-sm flex items-center gap-1.5 hover:scale-[1.02] transition">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> View Website
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Profile Form -->
                <div class="lg:col-span-8 bg-white p-6 rounded-3xl border border-slate-200 shadow-xs space-y-4">
                    
                    <div class="border-b border-slate-100 pb-3">
                        <h4 class="font-black text-base text-slate-900">Edit Store Profile & Business Identity</h4>
                        <p class="text-xs text-slate-500">Update your store details and operating configurations anytime.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Business / Brand Name *</label>
                        <input wire:model="businessName" type="text" class="input-field">
                        @error('businessName') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
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
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Website Mode / Operating Goal *</label>
                            <select wire:model.live="websiteType" wire:change="setWebsiteType($event.target.value)" class="input-field cursor-pointer">
                                <option value="business_website">🌐 Complete Business Website (Services &amp; Company)</option>
                                <option value="ecommerce">🛍️ E-Commerce Store (Products, Cart &amp; WhatsApp Checkout)</option>
                                <option value="landing_page">🚀 High-Converting Landing Page (Direct Leads &amp; Calls)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Marketing Tagline</label>
                        <input wire:model="tagline" type="text" placeholder="e.g. Best healthcare & quality services" class="input-field">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Phone Number *</label>
                            <input wire:model="phone" type="tel" class="input-field">
                            @error('phone') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">WhatsApp Order Number</label>
                            <input wire:model="whatsappNumber" type="tel" class="input-field">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">City / Town *</label>
                            <input wire:model="city" type="text" class="input-field">
                            @error('city') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Full Clinic / Store Address</label>
                            <input wire:model="address" type="text" class="input-field">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">About Us Story (Appears on Website)</label>
                        <textarea wire:model="aboutText" rows="4" class="input-field"></textarea>
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button wire:click="saveProfile" class="px-6 py-3 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-md transition cursor-pointer flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Save Profile Details
                        </button>
                    </div>

                </div>

                <!-- Right Column: Store Identity & Google Search Snippet Preview -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- Clean Store Summary Card -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white font-extrabold text-lg shadow-sm shrink-0" style="background: linear-gradient(135deg, {{ $brandColor }}, #7c3aed);">
                                {{ strtoupper(substr($tenant->business_name, 0, 1)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-bold text-base text-slate-900 truncate leading-tight">{{ $tenant->business_name }}</h4>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-[10px] font-bold text-purple-700 bg-purple-50 px-2 py-0.5 rounded-full border border-purple-200 truncate">
                                        {{ $tenant->settings['business_category'] ?? ($tenant->archetype->name ?? 'Business') }}
                                    </span>
                                    <span class="inline-flex items-center text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200 shrink-0">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1 animate-pulse"></span> Online
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2 text-xs text-slate-600 pt-2 border-t border-slate-100">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">City / Location</span>
                                <span class="font-semibold text-slate-800">{{ $tenant->city ?: 'Not set' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Primary Phone</span>
                                <span class="font-semibold text-slate-800 font-mono">{{ $tenant->phone ?: 'Not set' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Store URL</span>
                                <span class="font-semibold text-purple-600 font-mono text-[11px] truncate max-w-[140px]">/store/{{ $tenant->slug }}</span>
                            </div>
                        </div>

                        <a href="{{ route('store.show', $tenant->slug) }}" target="_blank" class="w-full py-2.5 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-sm flex items-center justify-center gap-2 hover:scale-[1.01] transition">
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Visit Live Website
                        </a>
                    </div>

                    <!-- Google Search Snippet Preview -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-700 mb-3">
                            <i class="fa-brands fa-google text-rose-500 text-base"></i> Google Local SEO Preview
                        </div>
                        
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 font-sans text-xs space-y-1">
                            <div class="text-slate-400 text-[10px] truncate">https://anemony.in/store/{{ $tenant->slug }}</div>
                            <div class="text-blue-700 font-bold text-sm hover:underline cursor-pointer">
                                {{ $businessName }} - {{ $city }} (Verified {{ $tenant->archetype->name }})
                            </div>
                            <div class="text-slate-600 text-[11px] leading-tight line-clamp-2">
                                {{ $tagline ?: "Comprehensive {$tenant->archetype->name} in {$city}. Fast WhatsApp appointment booking & customer service." }}
                            </div>
                            <div class="flex items-center gap-1 text-amber-500 text-[10px] pt-1 font-bold">
                                <span>★★★★★</span> <span>4.9 (120+ Reviews) &bull; Price: ₹₹</span>
                            </div>
                        </div>

                        <div class="mt-4 text-[11px] text-slate-400">
                            <i class="fa-solid fa-circle-check text-emerald-500 mr-1"></i> JSON-LD Schema.org <code>{{ $tenant->archetype->schema_type ?? 'LocalBusiness' }}</code> active on public storefront.
                        </div>
                    </div>
                </div>

            </div>

        </div>
        @endif


        <!-- ========================================== -->
        <!-- TAB 4: 📥 ORDERS & INQUIRIES               -->
        <!-- ========================================== -->
        @if($activeTab === 'orders')
        <div class="space-y-6 animate-fade-in">
            
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Customer Bookings & Orders Inbox</h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Appointments, cart orders, and quote inquiries received through your website.
                    </p>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-bold uppercase tracking-wider">
                            <tr>
                                <th class="p-4">Order / Booking ID</th>
                                <th class="p-4">Customer Name</th>
                                <th class="p-4">Contact Phone</th>
                                <th class="p-4">Type</th>
                                <th class="p-4">Amount</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Direct WhatsApp</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($ordersList as $ord)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="p-4 font-bold text-slate-900">
                                    {{ $ord->order_number }}
                                    <span class="text-[10px] text-slate-400 block">{{ $ord->created_at->format('d M, h:i A') }}</span>
                                </td>
                                <td class="p-4 font-bold text-slate-800">
                                    {{ $ord->customer_name }}
                                </td>
                                <td class="p-4 text-slate-600">
                                    <a href="tel:{{ $ord->customer_phone }}" class="hover:underline">{{ $ord->customer_phone }}</a>
                                </td>
                                <td class="p-4">
                                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded {{ $ord->type === 'booking' ? 'bg-sky-100 text-sky-700' : ($ord->type === 'quote_inquiry' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700') }}">
                                        {{ str_replace('_', ' ', $ord->type) }}
                                    </span>
                                </td>
                                <td class="p-4 font-bold text-slate-900">
                                    ₹{{ number_format($ord->total_amount, 2) }}
                                </td>
                                <td class="p-4">
                                    <select wire:change="updateOrderStatus({{ $ord->id }}, $event.target.value)" class="text-xs font-bold rounded-lg border border-slate-200 px-2 py-1 outline-none cursor-pointer">
                                        <option value="new" {{ $ord->status === 'new' ? 'selected' : '' }}>New</option>
                                        <option value="confirmed" {{ $ord->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="completed" {{ $ord->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="https://wa.me/91{{ preg_replace('/[^0-9]/', '', $ord->customer_phone) }}?text=Hello%20{{ urlencode($ord->customer_name) }},%20regarding%20your%20{{ $ord->type }}%20at%20{{ urlencode($tenant->business_name) }}..." target="_blank" class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs inline-flex items-center gap-1 shadow-xs">
                                        <i class="fa-brands fa-whatsapp"></i> Chat
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400">
                                    No orders or inquiries received yet. When visitors book slots or order on your website, they appear here!
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($ordersList->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $ordersList->links() }}
                </div>
                @endif
            </div>

        </div>
        @endif


        <!-- ========================================== -->
        <!-- TAB 5: 🤖 AI TEMPLATE STUDIO               -->
        <!-- ========================================== -->
        @if($activeTab === 'ai_studio')
        <div class="space-y-6 animate-fade-in">
            
            <div class="bg-gradient-to-r from-purple-900 via-indigo-900 to-slate-900 text-white p-8 rounded-3xl shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <span class="bg-purple-500/30 text-purple-200 text-xs font-bold px-3 py-1 rounded-full border border-purple-400/30 inline-flex items-center gap-1.5">
                        <i class="fa-solid fa-sparkles text-amber-300"></i> AI Website Copywriter
                    </span>
                    <h2 class="text-3xl font-black tracking-tight">AI Content & Catalog Studio</h2>
                    <p class="text-xs text-purple-200/80 max-w-xl">
                        Instantly write persuasive marketing taglines, doctor bios, and high-converting website content tailored to your category archetype.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <button wire:click="generateAiContent('taglines')" class="px-5 py-3 rounded-xl bg-white text-purple-900 font-extrabold text-xs shadow-md hover:bg-purple-50 transition cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-bolt text-amber-500"></i> Auto-Generate Tagline
                    </button>
                    <button wire:click="generateAiContent('about')" class="px-5 py-3 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-extrabold text-xs shadow-md transition cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-wand-magic-sparkles text-amber-300"></i> Auto-Generate About Us
                    </button>
                </div>
            </div>

            <!-- Features Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-lg">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-base text-slate-900">Current AI Tagline</h4>
                            <span class="text-xs text-slate-400">Live on your website hero banner</span>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-purple-50/50 border border-purple-100 text-xs font-semibold text-purple-950">
                        "{{ $tagline ?: 'No tagline set yet. Click Auto-Generate Tagline above!' }}"
                    </div>

                    <button wire:click="generateAiContent('taglines')" class="w-full py-2.5 rounded-xl border border-purple-200 text-purple-700 hover:bg-purple-50 font-bold text-xs transition cursor-pointer">
                        Re-generate New Tagline
                    </button>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-base text-slate-900">Current About Us Story</h4>
                            <span class="text-xs text-slate-400">Displayed in "About Our Practice" section</span>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-700 leading-relaxed max-h-24 overflow-y-auto">
                        {{ $aboutText ?: 'No story written yet. Click Auto-Generate About Us above!' }}
                    </div>

                    <button wire:click="generateAiContent('about')" class="w-full py-2.5 rounded-xl border border-emerald-200 text-emerald-700 hover:bg-emerald-50 font-bold text-xs transition cursor-pointer">
                        Re-generate About Story
                    </button>
                </div>

            </div>

        </div>
        @endif

    </main>

    </div>

    <!-- ➕ ITEM MODAL (Add / Edit Catalog Service / Product) -->
    @if($showItemModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl">
            
            <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <h3 class="font-black text-base text-slate-900">
                    {{ $editingItemId ? 'Edit Item / Service' : 'Add New Item / Service' }}
                </h3>
                <button wire:click="$set('showItemModal', false)" class="text-slate-400 hover:text-slate-700 text-xl font-bold cursor-pointer">&times;</button>
            </div>

            <form wire:submit.prevent="saveItem" class="p-6 space-y-4">
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Title / Name *</label>
                    <input wire:model="itemTitle" type="text" placeholder="e.g. Dental Scaling, Basmati Rice, CNC Component" class="input-field" required>
                    @error('itemTitle') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Category</label>
                        <input wire:model="itemCategory" type="text" placeholder="e.g. Consultations, Treatments" class="input-field">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Selling Price (₹) *</label>
                        <input wire:model="itemPrice" type="number" step="0.01" class="input-field" required>
                        @error('itemPrice') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Original Price (₹ MRP)</label>
                        <input wire:model="itemComparePrice" type="number" step="0.01" placeholder="Optional" class="input-field">
                    </div>

                    @if($tenant->archetype->code === 'service')
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Slot Duration (Mins)</label>
                        <input wire:model="itemDuration" type="number" min="10" step="5" class="input-field">
                    </div>
                    @elseif($tenant->archetype->code === 'b2b')
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Minimum Order Qty</label>
                        <input wire:model="itemMinQty" type="number" min="1" class="input-field">
                    </div>
                    @else
                    <div class="flex items-center pt-6">
                        <label class="flex items-center gap-2 text-xs font-bold text-slate-700 cursor-pointer">
                            <input type="checkbox" wire:model="itemInStock" class="w-4 h-4 text-purple-600 rounded">
                            <span>Currently In Stock</span>
                        </label>
                    </div>
                    @endif
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Image URL</label>
                    <input wire:model="itemImageUrl" type="url" placeholder="https://images.unsplash.com/..." class="input-field">
                </div>

                <div class="pt-2 flex justify-end gap-2">
                    <button type="button" wire:click="$set('showItemModal', false)" class="px-5 py-2.5 rounded-xl border border-slate-300 font-semibold text-xs hover:bg-slate-50 transition cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-md transition cursor-pointer">
                        {{ $editingItemId ? 'Update Item' : 'Add Item' }}
                    </button>
                </div>

            </form>

        </div>
    </div>
    @endif

    <!-- 🌟 Interactive Industry Template Device Preview Modal -->
    @if($showTemplatePreviewModal && $this->previewTemplate)
    <div class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md flex flex-col justify-between overflow-hidden animate-fadeIn">
        
        <!-- Modal Top Control Bar -->
        <div class="bg-slate-900 border-b border-slate-800 px-4 sm:px-6 py-3 flex items-center justify-between gap-4 shrink-0 shadow-lg">
            
            <!-- Left: Template Metadata -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md" style="background-color: {{ $this->previewTemplate['suggested_color'] }};">
                    <i class="fa-solid {{ $this->previewTemplate['icon'] }}"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h3 class="text-white font-black text-sm sm:text-base tracking-tight leading-tight">{{ $this->previewTemplate['title'] }}</h3>
                        <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full text-white hidden sm:inline" style="background-color: {{ $this->previewTemplate['suggested_color'] }};">
                            {{ $this->previewTemplate['category'] }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-400">Live Interactive Architecture Preview &bull; Responsive Multi-Device</p>
                </div>
            </div>

            <!-- Center: Device Switcher (Desktop vs Mobile Phone) -->
            <div class="flex items-center bg-slate-950 border border-slate-800 p-1 rounded-xl shadow-inner">
                <button type="button" wire:click="$set('previewDevice', 'desktop')" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 cursor-pointer {{ $previewDevice === 'desktop' ? 'bg-purple-600 text-white shadow' : 'text-slate-400 hover:text-white' }}">
                    <i class="fa-solid fa-laptop"></i> <span class="hidden md:inline">Desktop</span>
                </button>
                <button type="button" wire:click="$set('previewDevice', 'mobile')" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 cursor-pointer {{ $previewDevice === 'mobile' ? 'bg-purple-600 text-white shadow' : 'text-slate-400 hover:text-white' }}">
                    <i class="fa-solid fa-mobile-screen"></i> <span class="hidden md:inline">Mobile Phone</span>
                </button>
            </div>

            <!-- Right: Apply Action & Close Modal -->
            <div class="flex items-center gap-2">
                <button type="button" wire:click="applyTemplate('{{ $this->previewTemplate['id'] }}', '{{ $this->previewTemplate['suggested_color'] }}')" class="px-4 py-2 rounded-xl text-white font-bold text-xs shadow-md transition flex items-center gap-1.5 cursor-pointer hover:scale-[1.02]" style="background-color: {{ $this->previewTemplate['suggested_color'] }};">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> <span>Apply Template</span>
                </button>
                <button type="button" wire:click="$set('showTemplatePreviewModal', false)" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white flex items-center justify-center transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

        </div>

        <!-- Center: Device Viewport Canvas (Real Live Website) -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 flex justify-center items-start bg-slate-950/70 custom-scrollbar">
            
            @if($previewDevice === 'desktop')
            <!-- 💻 Desktop Device Frame -->
            <div class="w-full max-w-6xl bg-white rounded-2xl shadow-2xl border border-slate-700/60 overflow-hidden flex flex-col transition-all duration-300 text-slate-800">
                
                <!-- Mock Browser Header Bar -->
                <div class="bg-slate-100 border-b border-slate-200 px-4 py-2.5 flex items-center justify-between text-xs text-slate-500 select-none">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-rose-400 inline-block"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-400 inline-block"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-400 inline-block"></span>
                    </div>
                    <div class="bg-white border border-slate-200 rounded-lg px-6 py-1 text-[11px] font-mono text-slate-600 flex items-center gap-2 shadow-xs">
                        <i class="fa-solid fa-lock text-emerald-500 text-[10px]"></i>
                        <span>{{ route('store.show', $tenant->slug) }}?theme={{ $previewTemplateId }}</span>
                    </div>
                    <a href="{{ route('store.show', $tenant->slug) }}?theme={{ $previewTemplateId }}" target="_blank" class="text-[11px] font-bold text-purple-600 hover:text-purple-700 flex items-center gap-1">
                        <span>Open In Full Tab</span> <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    </a>
                </div>

                <!-- REAL LIVE STORE EMBEDDED IFRAME -->
                <div class="w-full bg-white relative" style="height: 750px;">
                    <iframe src="{{ route('store.show', $tenant->slug) }}?theme={{ $previewTemplateId }}" class="w-full h-full border-0" title="Real Live Website Preview"></iframe>
                </div>

            </div>
            @else
            <!-- 📱 Mobile Phone Device Frame -->
            <div class="w-[380px] bg-slate-900 rounded-[44px] shadow-2xl border-4 border-slate-800 p-2.5 flex flex-col transition-all duration-300 relative my-4">
                <!-- Speaker / Camera Notch -->
                <div class="w-32 h-5 bg-slate-900 rounded-b-2xl mx-auto absolute top-2.5 left-1/2 -translate-x-1/2 z-20 flex items-center justify-center">
                    <div class="w-12 h-1 bg-slate-800 rounded-full"></div>
                </div>

                <!-- Real Mobile Website Screen -->
                <div class="w-full h-[680px] bg-white rounded-[34px] overflow-hidden relative shadow-inner">
                    <iframe src="{{ route('store.show', $tenant->slug) }}?theme={{ $previewTemplateId }}" class="w-full h-full border-0" title="Real Live Website Mobile Preview"></iframe>
                </div>
            </div>
            @endif

        </div>

        <!-- Modal Bottom Bar (Apply & Info) -->
        <div class="bg-slate-900 border-t border-slate-800 px-4 sm:px-6 py-3 flex flex-wrap items-center justify-between gap-3 shrink-0">
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <i class="fa-solid fa-shield-halved text-purple-400 text-sm"></i>
                <span><strong class="text-white">Zero Data Loss:</strong> Applying this template retains all your existing products, prices, images, and WhatsApp configuration.</span>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" wire:click="$set('showTemplatePreviewModal', false)" class="px-4 py-2 rounded-xl border border-slate-700 text-slate-300 hover:bg-slate-800 text-xs font-semibold transition cursor-pointer">
                    Close Preview
                </button>
                <button type="button" wire:click="applyTemplate('{{ $this->previewTemplate['id'] }}', '{{ $this->previewTemplate['suggested_color'] }}')" class="px-5 py-2 rounded-xl text-white font-bold text-xs shadow-md transition flex items-center gap-1.5 cursor-pointer hover:scale-[1.02]" style="background-color: {{ $this->previewTemplate['suggested_color'] }};">
                    <i class="fa-solid fa-check"></i> <span>Apply "{{ $this->previewTemplate['title'] }}" Now</span>
                </button>
            </div>
        </div>

    </div>
    @endif

</div>

