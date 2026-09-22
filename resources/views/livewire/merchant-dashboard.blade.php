<div class="min-h-screen bg-slate-100/70 text-slate-800 pb-16">

    <!-- 🌟 Top Merchant Bar -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between gap-4">
            
            <!-- Left: Brand and Store Selector -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-lg shadow-sm" style="background: linear-gradient(135deg, {{ $brandColor }}, #9333ea);">
                    {{ strtoupper(substr($tenant->business_name, 0, 1)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-base sm:text-lg font-black text-slate-900 tracking-tight leading-tight">{{ $tenant->business_name }}</h1>
                        <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded-full text-white bg-gradient-to-r from-rose-500 to-purple-600 shadow-xs">
                            {{ $tenant->archetype->code }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 font-medium">
                        Theme Studio & Digital Operating System &bull; {{ $tenant->city }}
                    </p>
                </div>
            </div>

            <!-- Right: Actions & Switch Stores -->
            <div class="flex items-center gap-2.5">
                <!-- Store Switcher Dropdown -->
                <div class="hidden md:flex items-center gap-1.5 text-xs text-slate-500 border border-slate-200 rounded-xl px-2.5 py-1.5 bg-slate-50">
                    <i class="fa-solid fa-store text-purple-600"></i>
                    <select onchange="window.location.href='/store/' + this.value + '/dashboard'" class="bg-transparent font-bold text-slate-700 outline-none cursor-pointer">
                        @foreach($allTenants as $t)
                        <option value="{{ $t->slug }}" {{ $t->slug === $tenant->slug ? 'selected' : '' }}>
                            {{ $t->business_name }} ({{ $t->city }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- View Live Storefront Button -->
                <a href="{{ route('store.show', $tenant->slug) }}" wire:navigate target="_blank" class="px-4 py-2 rounded-xl btn-brand-gradient text-white font-bold text-xs shadow-md transition hover:scale-[1.02] flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> <span class="hidden sm:inline">View Live Website</span>
                </a>
            </div>

        </div>

        <!-- 🧭 Dashboard Navigation Tabs -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-1 sm:gap-2 overflow-x-auto text-xs font-bold border-t border-slate-100">
            <button wire:click="$set('activeTab', 'templates')" class="py-3 px-4 border-b-2 transition flex items-center gap-2 whitespace-nowrap cursor-pointer {{ $activeTab === 'templates' ? 'border-purple-600 text-purple-700' : 'border-transparent text-slate-500 hover:text-slate-900' }}">
                <i class="fa-solid fa-palette text-sm"></i> Templates & Theme Studio
            </button>
            <button wire:click="$set('activeTab', 'catalog')" class="py-3 px-4 border-b-2 transition flex items-center gap-2 whitespace-nowrap cursor-pointer {{ $activeTab === 'catalog' ? 'border-purple-600 text-purple-700' : 'border-transparent text-slate-500 hover:text-slate-900' }}">
                <i class="fa-solid fa-boxes-stacked text-sm"></i> Products & Services ({{ $catalogCount }})
            </button>
            <button wire:click="$set('activeTab', 'profile')" class="py-3 px-4 border-b-2 transition flex items-center gap-2 whitespace-nowrap cursor-pointer {{ $activeTab === 'profile' ? 'border-purple-600 text-purple-700' : 'border-transparent text-slate-500 hover:text-slate-900' }}">
                <i class="fa-solid fa-sliders text-sm"></i> Store Profile & Local SEO
            </button>
            <button wire:click="$set('activeTab', 'orders')" class="py-3 px-4 border-b-2 transition flex items-center gap-2 whitespace-nowrap cursor-pointer {{ $activeTab === 'orders' ? 'border-purple-600 text-purple-700' : 'border-transparent text-slate-500 hover:text-slate-900' }}">
                <i class="fa-solid fa-inbox text-sm"></i> Orders & Inquiries ({{ $ordersCount }})
            </button>
            <button wire:click="$set('activeTab', 'ai_studio')" class="py-3 px-4 border-b-2 transition flex items-center gap-2 whitespace-nowrap cursor-pointer {{ $activeTab === 'ai_studio' ? 'border-purple-600 text-purple-700' : 'border-transparent text-slate-500 hover:text-slate-900' }}">
                <i class="fa-solid fa-wand-magic-sparkles text-sm text-amber-500"></i> AI Template Studio
            </button>
        </div>
    </header>

    <!-- ⚡ Flash Message Notification -->
    @if($flashMessage)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-emerald-600 text-white px-4 py-2.5 rounded-2xl text-xs sm:text-sm font-semibold flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-base"></i>
                <span>{{ $flashMessage }}</span>
            </div>
            <button wire:click="$set('flashMessage', '')" class="text-emerald-200 hover:text-white cursor-pointer text-lg font-bold">&times;</button>
        </div>
    </div>
    @endif

    <!-- 📦 Main Dashboard Workspace -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">

        <!-- ========================================== -->
        <!-- TAB 1: 🎨 TEMPLATES & THEME STUDIO         -->
        <!-- ========================================== -->
        @if($activeTab === 'templates')
        <div class="space-y-8 animate-fade-in">
            
            <!-- Section Header -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <span class="text-[11px] font-black uppercase tracking-wider text-purple-600">Zero Data Loss Theme Engine</span>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Website Templates & Layout Studio</h2>
                    <p class="text-xs text-slate-500 mt-1">
                        Switch visual templates anytime. All your catalog items, doctor services, orders, and Google SEO schemas are preserved 100%.
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

            <!-- 1. Choose Active Visual Template -->
            <div>
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-purple-600 text-white flex items-center justify-center text-xs">1</span>
                    Select Visual Architecture Template
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Template 1: Modern Clean -->
                    <div wire:click="selectTheme('modern_clean')" class="p-5 rounded-3xl border-2 cursor-pointer transition relative flex flex-col justify-between {{ $activeTheme === 'modern_clean' ? 'border-purple-600 bg-purple-50/30 ring-4 ring-purple-500/10 shadow-lg' : 'border-slate-200 bg-white hover:border-slate-300 shadow-xs' }}">
                        <div>
                            <!-- Mockup Header -->
                            <div class="h-28 rounded-2xl bg-gradient-to-tr from-slate-100 to-purple-50 border border-slate-200/80 p-3 mb-4 flex flex-col justify-between overflow-hidden">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-4 h-4 rounded-md bg-purple-600"></div>
                                        <div class="w-16 h-2 bg-slate-300 rounded"></div>
                                    </div>
                                    <div class="w-8 h-3 rounded-full bg-emerald-500/20"></div>
                                </div>
                                <div class="space-y-1">
                                    <div class="w-3/4 h-3 bg-slate-800 rounded font-bold"></div>
                                    <div class="w-1/2 h-2 bg-slate-300 rounded"></div>
                                </div>
                                <div class="flex gap-2">
                                    <div class="w-14 h-4 rounded bg-purple-600"></div>
                                    <div class="w-12 h-4 rounded bg-slate-200"></div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-black text-base text-slate-900">Modern Clean</h4>
                                @if($activeTheme === 'modern_clean')
                                <span class="text-xs font-bold text-purple-700 bg-purple-100 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fa-solid fa-check text-[10px]"></i> Active
                                </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                Vibrant light layout with crisp rounded cards, hero trust badges, and energetic gradient action buttons. Best for Clinics & Retail.
                            </p>
                        </div>
                        <div class="text-[11px] font-bold text-purple-700 border-t border-slate-100 pt-3 flex items-center justify-between">
                            <span>Recommended for: {{ $tenant->archetype->name }}</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Template 2: Minimal Card -->
                    <div wire:click="selectTheme('minimal_card')" class="p-5 rounded-3xl border-2 cursor-pointer transition relative flex flex-col justify-between {{ $activeTheme === 'minimal_card' ? 'border-purple-600 bg-purple-50/30 ring-4 ring-purple-500/10 shadow-lg' : 'border-slate-200 bg-white hover:border-slate-300 shadow-xs' }}">
                        <div>
                            <!-- Mockup Header -->
                            <div class="h-28 rounded-2xl bg-neutral-100 border border-neutral-300 p-3 mb-4 flex flex-col justify-between overflow-hidden">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-3 h-3 rounded-full bg-black"></div>
                                        <div class="w-14 h-2 bg-neutral-400 rounded"></div>
                                    </div>
                                    <div class="w-6 h-2 bg-neutral-300 rounded"></div>
                                </div>
                                <div class="space-y-1">
                                    <div class="w-2/3 h-3 bg-neutral-900 rounded"></div>
                                    <div class="w-1/3 h-2 bg-neutral-400 rounded"></div>
                                </div>
                                <div class="flex gap-2">
                                    <div class="w-16 h-4 border border-black rounded"></div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-black text-base text-slate-900">Minimal Card</h4>
                                @if($activeTheme === 'minimal_card')
                                <span class="text-xs font-bold text-purple-700 bg-purple-100 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fa-solid fa-check text-[10px]"></i> Active
                                </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                Understated editorial design with sharp monochrome borders, clean spacing, and calm readability. Ideal for Doctors & Consultancies.
                            </p>
                        </div>
                        <div class="text-[11px] font-bold text-slate-700 border-t border-slate-100 pt-3 flex items-center justify-between">
                            <span>High Contrast & Minimalist</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Template 3: Dark Luxury -->
                    <div wire:click="selectTheme('dark_luxury')" class="p-5 rounded-3xl border-2 cursor-pointer transition relative flex flex-col justify-between {{ $activeTheme === 'dark_luxury' ? 'border-purple-600 bg-purple-50/30 ring-4 ring-purple-500/10 shadow-lg' : 'border-slate-200 bg-white hover:border-slate-300 shadow-xs' }}">
                        <div>
                            <!-- Mockup Header -->
                            <div class="h-28 rounded-2xl bg-zinc-950 border border-zinc-800 p-3 mb-4 flex flex-col justify-between overflow-hidden">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-4 h-4 rounded-md bg-purple-500 shadow"></div>
                                        <div class="w-14 h-2 bg-zinc-700 rounded"></div>
                                    </div>
                                    <div class="w-10 h-3 rounded-full bg-emerald-950 border border-emerald-500/40"></div>
                                </div>
                                <div class="space-y-1">
                                    <div class="w-3/4 h-3 bg-white rounded"></div>
                                    <div class="w-1/2 h-2 bg-zinc-600 rounded"></div>
                                </div>
                                <div class="flex gap-2">
                                    <div class="w-16 h-4 rounded bg-purple-600 text-[8px] text-white"></div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-black text-base text-slate-900">Dark Luxury</h4>
                                @if($activeTheme === 'dark_luxury')
                                <span class="text-xs font-bold text-purple-700 bg-purple-100 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fa-solid fa-check text-[10px]"></i> Active
                                </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                Night-mode obsidian palette with metallic neon gradients and glowing cards. High perceived value for High-end Clinics & Factories.
                            </p>
                        </div>
                        <div class="text-[11px] font-bold text-purple-700 border-t border-slate-100 pt-3 flex items-center justify-between">
                            <span>Sleek Night Mode</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                </div>
            </div>

            <!-- 2. Brand Color Palette Customizer -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-purple-600 text-white flex items-center justify-center text-xs">2</span>
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
                    <span class="w-6 h-6 rounded-full bg-purple-600 text-white flex items-center justify-center text-xs">3</span>
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
            
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Store Profile & Google Local SEO</h2>
                <p class="text-xs text-slate-500 mt-1">
                    Keep your business name, WhatsApp contact, and clinic timings updated. We auto-generate Google JSON-LD LocalBusiness schema for search rankings.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Profile Form -->
                <div class="lg:col-span-8 bg-white p-6 rounded-3xl border border-slate-200 shadow-xs space-y-4">
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Business Name *</label>
                        <input wire:model="businessName" type="text" class="input-field">
                        @error('businessName') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Marketing Tagline</label>
                        <input wire:model="tagline" type="text" class="input-field">
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

                <!-- Google Search Snippet Preview -->
                <div class="lg:col-span-4 space-y-6">
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

</div>
