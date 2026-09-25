<div class="{{ match($currentTheme) {
    'dark_luxury' => 'bg-[#090D16] text-zinc-100 min-h-screen',
    'hotel_business' => 'bg-[#0B132B] text-slate-100 min-h-screen',
    'motel_highway' => 'bg-[#18181B] text-slate-100 min-h-screen',
    'hotel_boutique' => 'bg-[#120E24] text-slate-100 min-h-screen',
    'hotel_budget' => 'bg-[#F0FDFA] text-slate-900 min-h-screen',
    'hotel_family' => 'bg-[#FFFBEB] text-stone-900 min-h-screen',
    'minimal_card', 'hotel_resort' => 'bg-[#FDFBF7] text-stone-900 min-h-screen',
    'nature_retreat' => 'bg-[#F4F7F4] text-emerald-950 min-h-screen',
    'coastal_beach' => 'bg-[#F0FDFB] text-slate-900 min-h-screen',
    'heritage_haveli' => 'bg-[#FCF8F2] text-stone-900 min-h-screen',
    'mountain_chalet' => 'bg-[#F8F6F2] text-stone-900 min-h-screen',
    'wellness_sanctuary' => 'bg-[#F5F8F6] text-emerald-950 min-h-screen',
    default => 'bg-slate-50 text-slate-800 min-h-screen',
} }}">


    <!-- 🌟 Top Demo & Theme Switcher Bar (Zero Data Loss Demonstration) -->
    <div class="bg-slate-950 text-white text-xs py-2 px-4 shadow-md sticky top-0 z-50 flex flex-wrap items-center justify-between gap-2 border-b border-purple-950">
        <div class="flex items-center gap-2 flex-wrap">
            <span class="bg-gradient-to-r from-rose-500 to-purple-600 text-white font-bold px-2.5 py-0.5 rounded-full text-[10px] uppercase tracking-wider">
                <i class="fa-solid fa-layer-group text-[9px] mr-1"></i> Archetype: {{ strtoupper($archetype->code) }}
            </span>
            @php
                $wType = $tenant->settings['website_type'] ?? 'business_website';
            @endphp
            <span class="bg-purple-900/60 border border-purple-700/60 text-purple-200 font-bold px-2 py-0.5 rounded-full text-[10px] uppercase tracking-wider">
                @if($wType === 'ecommerce')
                    <i class="fa-solid fa-cart-shopping text-[9px] mr-1"></i> Mode: E-Commerce
                @elseif($wType === 'landing_page')
                    <i class="fa-solid fa-bullhorn text-[9px] mr-1"></i> Mode: Landing Page
                @else
                    <i class="fa-solid fa-globe text-[9px] mr-1"></i> Mode: Business Website
                @endif
            </span>
            <span class="font-medium text-slate-300 hidden md:inline">Website Live Preview</span>
        </div>
        <div class="flex items-center gap-1.5 sm:gap-2 overflow-x-auto max-w-full pb-1 sm:pb-0">
            <span class="text-slate-400 text-[11px] hidden sm:inline shrink-0">Theme:</span>
            
            @php
                $bizCat = $tenant->settings['business_category'] ?? '';
                $isHotelCategory = stripos($bizCat, 'Hotel') !== false || stripos($bizCat, 'Motel') !== false || $archetype->code === 'hospitality';
            @endphp

            @if($isHotelCategory)
                <button wire:click="switchTheme('hotel_business')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'hotel_business' ? 'bg-blue-600 text-white font-bold shadow ring-2 ring-blue-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🏢 City Business
                </button>
                <button wire:click="switchTheme('motel_highway')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'motel_highway' ? 'bg-red-600 text-white font-bold shadow ring-2 ring-red-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🚗 Highway Motel
                </button>
                <button wire:click="switchTheme('hotel_boutique')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'hotel_boutique' ? 'bg-purple-600 text-white font-bold shadow ring-2 ring-purple-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🏨 Urban Boutique
                </button>
                <button wire:click="switchTheme('hotel_resort')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'hotel_resort' ? 'bg-rose-600 text-white font-bold shadow ring-2 ring-rose-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    ✨ Grand 5-Star
                </button>
                <button wire:click="switchTheme('hotel_budget')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'hotel_budget' ? 'bg-teal-600 text-white font-bold shadow ring-2 ring-teal-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🛏️ Smart Budget
                </button>
                <button wire:click="switchTheme('hotel_family')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'hotel_family' ? 'bg-amber-600 text-white font-bold shadow ring-2 ring-amber-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🌴 Family &amp; Lawn
                </button>
            @elseif($bizCat === 'Beauty & Salons')
                <button wire:click="switchTheme('salon_spa')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['salon_spa', 'salon_wellness']) ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    ✂️ Salon &amp; Spa
                </button>
                <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    👑 VIP Bridal Funnel
                </button>
                <button wire:click="switchTheme('minimal_card')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'minimal_card' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    ✨ Boutique Studio
                </button>
            @elseif(in_array($bizCat, ['Clinics & Hospitals', 'Doctors & Specialists']))
                <button wire:click="switchTheme('doctor_clinic')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_clinic' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🩺 Hospital &amp; OPD
                </button>
                <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🚀 Urgent OPD Funnel
                </button>
                <button wire:click="switchTheme('modern_clean')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'modern_clean' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🏥 Polyclinic
                </button>
            @elseif($bizCat === 'Coaching & Institutes')
                <button wire:click="switchTheme('coaching_institute')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_institute' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🎓 Exam Academy
                </button>
                <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🚀 Admission Funnel
                </button>
                <button wire:click="switchTheme('modern_clean')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'modern_clean' ? 'bg-indigo-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    📄 Study Center
                </button>
            @elseif($bizCat === 'Herbal Care')
                <button wire:click="switchTheme('wellness_sanctuary')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'wellness_sanctuary' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🌿 Ayurvedic Sanctuary
                </button>
                <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    ✨ Herbal Funnel
                </button>
                <button wire:click="switchTheme('nature_retreat')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'nature_retreat' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🍃 Holistic Care
                </button>
            @elseif($bizCat === 'Manufacturers')
                <button wire:click="switchTheme('b2b_industrial')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['b2b_industrial', 'b2b_manufacturing']) ? 'bg-indigo-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🏭 CNC Plant
                </button>
                <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    ⚡ OEM Funnel
                </button>
                <button wire:click="switchTheme('modern_clean')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'modern_clean' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🌐 Global Exports
                </button>
            @elseif($bizCat === 'Real Estate & Properties')
                <button wire:click="switchTheme('real_estate')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'real_estate' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🏢 Township &amp; RERA
                </button>
                <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🚀 Pre-Launch Funnel
                </button>
                <button wire:click="switchTheme('nature_retreat')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'nature_retreat' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🏡 Villa Plots
                </button>
            @elseif($bizCat === 'Restaurant & Cafes')
                <button wire:click="switchTheme('restaurant_cafe')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'restaurant_cafe' ? 'bg-rose-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🍽️ Gourmet Dining
                </button>
                <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🍷 Lounge &amp; Buffet
                </button>
                <button wire:click="switchTheme('minimal_card')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'minimal_card' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    ☕ Artisan Cafe
                </button>
            @elseif($bizCat === 'Other Services')
                <button wire:click="switchTheme('minimal_card')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'minimal_card' ? 'bg-slate-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    💼 Corporate Consulting
                </button>
                <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🚀 Acquisition Funnel
                </button>
                <button wire:click="switchTheme('modern_clean')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'modern_clean' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🌐 Advisory Agency
                </button>
            @else
                <!-- Other Retail / General Superstore -->
                <button wire:click="switchTheme('retail_supermarket')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_supermarket' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🛒 Supermarket
                </button>
                <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    ⚡ Flash Sale Funnel
                </button>
                <button wire:click="switchTheme('minimal_card')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'minimal_card' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    ✨ Boutique Store
                </button>
            @endif


            <a href="{{ route('store.dashboard', $tenant->slug) }}" wire:navigate class="ml-2 px-3 py-1 rounded-lg bg-purple-600 hover:bg-purple-500 text-white font-bold text-xs flex items-center gap-1.5 shadow shrink-0">
                <i class="fa-solid fa-gauge text-[10px]"></i> Dashboard &amp; Studio
            </a>
            <a href="{{ route('onboarding') }}" wire:navigate class="ml-1 btn-brand-gradient text-white px-3 py-1 rounded-lg font-bold text-xs flex items-center gap-1 shadow shrink-0">
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
    <nav class="sticky top-9 z-30 backdrop-blur-md border-b transition-colors {{ 
        $currentTheme === 'dark_luxury' ? 'bg-[#090D16]/95 border-zinc-800 text-white' : (
        $currentTheme === 'hotel_resort' ? 'bg-[#181614]/95 border-amber-500/20 text-stone-100' : (
        $currentTheme === 'nature_retreat' ? 'bg-[#0B1E15]/95 border-emerald-800/40 text-emerald-50' : (
        $currentTheme === 'heritage_haveli' ? 'bg-[#1F1710]/95 border-amber-600/30 text-amber-50' : (
        $currentTheme === 'mountain_chalet' ? 'bg-[#1C1613]/95 border-orange-900/40 text-stone-100' : (
        $currentTheme === 'wellness_sanctuary' ? 'bg-[#0D241C]/95 border-teal-800/40 text-teal-50' : (
        $currentTheme === 'coastal_beach' ? 'bg-white/95 border-cyan-100 text-slate-900' : (
        $currentTheme === 'minimal_card' ? 'bg-[#FDFBF7]/95 border-sky-100 text-slate-900' : 
        'bg-white/95 border-slate-200 text-slate-900'))))))) }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between gap-4">
            
            <!-- Brand Logo & Name -->
            <a href="#hero" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-lg shadow-md {{ 
                    $currentTheme === 'hotel_resort' ? 'bg-gradient-to-br from-rose-700 via-amber-600 to-amber-700 ring-2 ring-amber-400/30' : (
                    $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border border-amber-500/40 text-amber-400' : (
                    $currentTheme === 'minimal_card' ? 'bg-gradient-to-br from-sky-500 to-blue-600 text-white rounded-2xl shadow-sky-200' : (
                    $currentTheme === 'nature_retreat' ? 'bg-gradient-to-br from-emerald-600 to-teal-800 text-white rounded-2xl ring-2 ring-emerald-400/30' : (
                    $currentTheme === 'coastal_beach' ? 'bg-gradient-to-br from-cyan-400 to-blue-600 text-white rounded-2xl shadow-cyan-200' : (
                    $currentTheme === 'heritage_haveli' ? 'bg-gradient-to-br from-amber-600 via-rose-700 to-amber-800 text-amber-200 rounded-2xl ring-2 ring-amber-400/40' : (
                    $currentTheme === 'mountain_chalet' ? 'bg-gradient-to-br from-orange-700 to-amber-900 text-orange-100 rounded-2xl ring-2 ring-orange-400/30' : (
                    $currentTheme === 'wellness_sanctuary' ? 'bg-gradient-to-br from-teal-700 to-emerald-800 text-teal-100 rounded-2xl ring-2 ring-teal-400/30' : ''))))))) }}" style="{{ !in_array($currentTheme, ['hotel_resort', 'minimal_card', 'dark_luxury', 'nature_retreat', 'coastal_beach', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'background: linear-gradient(135deg, ' . $tenant->brand_color . ', #9333ea);' : '' }}">
                    {{ strtoupper(substr($tenant->business_name, 0, 1)) }}
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-black text-lg sm:text-xl tracking-tight leading-tight {{ in_array($currentTheme, ['hotel_resort', 'minimal_card', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'font-serif' : '' }}">{{ $tenant->business_name }}</span>
                        @if($currentTheme === 'hotel_business')
                            <i class="fa-solid fa-briefcase text-blue-400 text-xs" title="Corporate Business Hotel"></i>
                        @elseif($currentTheme === 'motel_highway')
                            <i class="fa-solid fa-car text-red-400 text-xs" title="Highway Express Motel"></i>
                        @elseif($currentTheme === 'hotel_boutique')
                            <i class="fa-solid fa-martini-glass-citrus text-purple-400 text-xs" title="Urban Boutique Hotel"></i>
                        @elseif($currentTheme === 'hotel_budget')
                            <i class="fa-solid fa-bed text-teal-400 text-xs" title="Smart Economy Hotel"></i>
                        @elseif($currentTheme === 'hotel_family')
                            <i class="fa-solid fa-people-roof text-amber-400 text-xs" title="Family Hotel &amp; Lawn"></i>
                        @elseif($currentTheme === 'hotel_resort')
                            <i class="fa-solid fa-crown text-amber-400 text-xs" title="5-Star Verified Resort"></i>
                        @elseif($currentTheme === 'dark_luxury')
                            <i class="fa-solid fa-star text-amber-400 text-xs" title="VIP Privilege"></i>
                        @elseif($currentTheme === 'minimal_card')
                            <i class="fa-solid fa-water text-sky-400 text-xs" title="Santorini Cliffside Stay"></i>
                        @elseif($currentTheme === 'nature_retreat')
                            <i class="fa-solid fa-tree text-emerald-400 text-xs" title="Safari Eco-Resort"></i>
                        @elseif($currentTheme === 'coastal_beach')
                            <i class="fa-solid fa-water-ladder text-cyan-400 text-xs" title="Maldives Overwater Resort"></i>
                        @elseif($currentTheme === 'heritage_haveli')
                            <i class="fa-solid fa-chess-rook text-amber-400 text-xs" title="Heritage Fort Haveli"></i>
                        @elseif($currentTheme === 'mountain_chalet')
                            <i class="fa-solid fa-mountain text-orange-400 text-xs" title="Alpine Snow Chalet"></i>
                        @elseif($currentTheme === 'wellness_sanctuary')
                            <i class="fa-solid fa-spa text-teal-400 text-xs" title="Ayurveda Healing Sanctuary"></i>
                        @else
                            <i class="fa-solid fa-circle-check text-sky-500 text-xs" title="Verified Business"></i>
                        @endif
                    </div>
                    <p class="text-[11px] font-medium opacity-70 flex items-center gap-1">
                        <i class="fa-solid fa-location-dot text-[10px] {{ in_array($currentTheme, ['hotel_resort', 'dark_luxury', 'heritage_haveli', 'hotel_family']) ? 'text-amber-400' : ($currentTheme === 'hotel_business' ? 'text-blue-400' : ($currentTheme === 'motel_highway' ? 'text-red-400' : ($currentTheme === 'hotel_boutique' ? 'text-purple-400' : ($currentTheme === 'hotel_budget' ? 'text-teal-400' : ($currentTheme === 'nature_retreat' ? 'text-emerald-400' : ($currentTheme === 'wellness_sanctuary' ? 'text-teal-400' : ($currentTheme === 'mountain_chalet' ? 'text-orange-400' : ($currentTheme === 'coastal_beach' || $currentTheme === 'minimal_card' ? 'text-sky-400' : 'text-rose-500')))))))) }}"></i> {{ $tenant->city }} &bull; {{ $tenant->archetype->code === 'hospitality' ? ($tenant->settings['business_category'] ?? 'Hotels & Motels') : $archetype->name }}
                    </p>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden lg:flex items-center gap-6 text-sm font-semibold opacity-85">
                <a href="#services" class="hover:text-amber-400 transition">{{ $archetype->code === 'hospitality' ? 'Suites & Rooms' : ($archetype->code === 'service' ? 'Services' : ($archetype->code === 'b2b' ? 'Products' : 'Catalog')) }}</a>
                <a href="#about" class="hover:text-amber-400 transition">About</a>
                <a href="#highlights" class="hover:text-amber-400 transition">Why Us</a>
                <a href="#timings" class="hover:text-amber-400 transition">{{ $archetype->code === 'hospitality' ? 'Check-in Desk' : 'Hours' }}</a>
                <a href="#reviews" class="hover:text-amber-400 transition">Reviews</a>
                <a href="#contact" class="hover:text-amber-400 transition">Contact</a>
            </div>

            <!-- Navbar Quick Actions -->
            <div class="flex items-center gap-2.5">
                <a href="tel:{{ $tenant->phone }}" class="px-3.5 py-2 rounded-xl border text-xs font-bold transition flex items-center gap-1.5 {{ 
                    in_array($currentTheme, ['dark_luxury', 'hotel_resort', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'border-white/20 hover:bg-white/10 text-white' : 'border-slate-200 hover:bg-slate-100 text-slate-700' }}">
                    <i class="fa-solid fa-phone {{ in_array($currentTheme, ['hotel_resort', 'dark_luxury', 'heritage_haveli']) ? 'text-amber-400' : ($currentTheme === 'nature_retreat' ? 'text-emerald-400' : ($currentTheme === 'mountain_chalet' ? 'text-orange-400' : ($currentTheme === 'wellness_sanctuary' ? 'text-teal-400' : 'text-sky-500'))) }}"></i> <span class="hidden sm:inline">Call</span>
                </a>
                
                <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to inquire about reservations.') }}" target="_blank" class="px-4 py-2 rounded-xl text-xs font-bold shadow-sm transition flex items-center gap-1.5 {{ 
                    $currentTheme === 'hotel_resort' ? 'bg-gradient-to-r from-rose-700 to-amber-700 hover:from-rose-600 hover:to-amber-600 text-white' : (
                    $currentTheme === 'dark_luxury' ? 'bg-amber-500 hover:bg-amber-400 text-slate-950 font-black' : (
                    $currentTheme === 'minimal_card' ? 'bg-sky-600 hover:bg-sky-500 text-white' : (
                    $currentTheme === 'nature_retreat' ? 'bg-emerald-600 hover:bg-emerald-500 text-white' : (
                    $currentTheme === 'coastal_beach' ? 'bg-cyan-600 hover:bg-cyan-500 text-white' : (
                    $currentTheme === 'heritage_haveli' ? 'bg-amber-600 hover:bg-amber-500 text-white' : (
                    $currentTheme === 'mountain_chalet' ? 'bg-orange-600 hover:bg-orange-500 text-white' : (
                    $currentTheme === 'wellness_sanctuary' ? 'bg-teal-700 hover:bg-teal-600 text-white' : 
                    'bg-emerald-600 hover:bg-emerald-700 text-white'))))))) }}">
                    <i class="fa-brands fa-whatsapp text-sm"></i> <span class="hidden sm:inline">{{ $currentTheme === 'dark_luxury' ? 'VIP WhatsApp' : (in_array($currentTheme, ['hotel_resort', 'minimal_card', 'nature_retreat', 'coastal_beach', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'Concierge' : 'WhatsApp') }}</span>
                </a>

                @if($archetype->hasFeature('cart'))
                <button wire:click="$set('showCartModal', true)" class="relative p-2 rounded-xl border transition cursor-pointer {{ in_array($currentTheme, ['dark_luxury', 'hotel_resort', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'border-white/20 bg-white/10 text-white' : 'border-slate-200 bg-slate-50 text-slate-800' }}">
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

    <!-- 🚀 HERO SECTION: REAL-WORLD INDUSTRY ARCHITECTURAL LAYOUTS -->
    @if($currentTheme === 'hotel_business')
    <!-- ======================================================== -->
    <!-- 🏢 LAYOUT: CITY BUSINESS & EXECUTIVE HOTEL                -->
    <!-- Executive Slate/Navy Palette + Corporate Booking Engine  -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-blue-900/40">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1600&auto=format&fit=crop&q=85" alt="City Business Hotel" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0B132B] via-[#0B132B]/75 to-[#0B132B]/85"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/20 border border-blue-400/50 text-blue-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-briefcase text-blue-400"></i> Corporate Business &amp; Executive Hotel &bull; {{ $tenant->city ?: 'Nagpur' }}
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] mb-5 text-slate-100">
                Executive Stays, Fast Wi-Fi &amp; Boardrooms in <span class="bg-gradient-to-r from-blue-400 via-sky-300 to-indigo-300 bg-clip-text text-transparent">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Tailored for corporate executives, business travelers, and conference delegates. Featuring ergonomic work suites, high-speed 150 Mbps fiber Wi-Fi, 24/7 room service, and airport shuttle." }}
            </p>

            <!-- Floating Corporate Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-blue-200/60 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-blue-600 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-blue-600 mr-1"></i> Check-Out Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-file-invoice text-blue-600 mr-1"></i> Corporate Rate
                        </span>
                        <div class="text-xs font-bold text-slate-800 truncate">Executive AC &bull; GST Invoice</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-500 hover:to-indigo-600 text-white font-extrabold text-xs shadow-lg shadow-blue-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-bed"></i> Book Executive Room
                    </a>
                </div>
            </div>

            <!-- Business Trust Badges -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-slate-300">
                <span class="flex items-center gap-2"><i class="fa-solid fa-wifi text-blue-400 text-sm"></i> 150 Mbps Fiber Wi-Fi</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-handshake text-blue-400 text-sm"></i> Conference Boardrooms</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-clock text-blue-400 text-sm"></i> 24/7 Express Check-In</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-van-shuttle text-blue-400 text-sm"></i> Airport / Station Shuttle</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'motel_highway')
    <!-- ======================================================== -->
    <!-- 🚗 LAYOUT: HIGHWAY EXPRESS MOTEL & TRANSIT LODGE          -->
    <!-- Drive-In Parking + 24/7 Check-in + Highway Dhaba Diner   -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-red-900/40">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=1600&auto=format&fit=crop&q=85" alt="Highway Motel" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#18181B] via-[#18181B]/75 to-[#18181B]/85"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-500/20 border border-red-400/50 text-red-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-car text-red-400"></i> Highway Express Motel &bull; 24/7 Transit Lodging &bull; {{ $tenant->city ?: 'Highway Corridor' }}
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] mb-5 text-slate-100">
                Drive-In Parking, Clean AC Rooms &amp; 24-Hour Roadside Check-In
            </h1>

            <p class="text-base sm:text-lg text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. The trusted national highway stopover for long-distance drivers, tourists, and road-trip families. Park directly outside your room with 24/7 CCTV surveillance, piping hot water, and delicious 24-hr highway dhaba dining." }}
            </p>

            <!-- Highway Quick Stopover Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-red-200/60 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-red-600 mr-1"></i> Arrival Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-bed text-red-600 mr-1"></i> Stay Plan
                        </span>
                        <div class="text-xs font-bold text-slate-800">Night Stay (12 Hours)</div>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-car-side text-red-600 mr-1"></i> Vehicle Parking
                        </span>
                        <div class="text-xs font-bold text-slate-800">Car / SUV In-Front</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-red-600 to-amber-700 hover:from-red-500 hover:to-amber-600 text-white font-extrabold text-xs shadow-lg shadow-red-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-key"></i> Quick Room Check-In
                    </a>
                </div>
            </div>

            <!-- Motel Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-slate-300">
                <span class="flex items-center gap-2"><i class="fa-solid fa-square-parking text-red-400 text-sm"></i> Drive-In Safe Parking</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-clock text-red-400 text-sm"></i> 24/7 Late-Night Check-in</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-utensils text-amber-400 text-sm"></i> 24-Hour Highway Dhaba</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-faucet-drip text-sky-400 text-sm"></i> 24/7 Hot Water Geyser</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'hotel_boutique')
    <!-- ======================================================== -->
    <!-- 🏨 LAYOUT: URBAN BOUTIQUE HOTEL & ROOFTOP LOUNGE          -->
    <!-- Designer Modern Interiors + Couple-Friendly + Rooftop Cafe -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-purple-900/40">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1600&auto=format&fit=crop&q=85" alt="Urban Boutique Hotel" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#120E24] via-[#120E24]/75 to-[#120E24]/85"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-purple-500/20 border border-purple-400/50 text-purple-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-martini-glass-citrus text-purple-400"></i> Urban Boutique Hotel &bull; Sunset Rooftop Lounge &bull; {{ $tenant->city ?: 'Nagpur' }}
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] mb-5 text-slate-100">
                Designer AC Suites, Ambient Moods &amp; Rooftop Dining in <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-rose-300 bg-clip-text text-transparent">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. A vibrant boutique haven in the city center. Featuring curated designer rooms, private balconies, welcoming couple-friendly check-in, and our signature panoramic rooftop cafe & lounge." }}
            </p>

            <!-- Boutique Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-purple-200/60 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-purple-600 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-purple-600 mr-1"></i> Check-Out Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-heart text-purple-600 mr-1"></i> Suite Type
                        </span>
                        <div class="text-xs font-bold text-slate-800">Balcony Suite &bull; Couple Safe</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-extrabold text-xs shadow-lg shadow-purple-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-couch"></i> Reserve Boutique Room
                    </a>
                </div>
            </div>

            <!-- Boutique Trust Badges -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-slate-300">
                <span class="flex items-center gap-2"><i class="fa-solid fa-martini-glass-citrus text-purple-400 text-sm"></i> Rooftop Sunset Lounge</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-heart text-pink-400 text-sm"></i> Couple-Friendly Verified</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-palette text-purple-400 text-sm"></i> Designer Interior Art</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-rose-400 text-sm"></i> Prime City Center</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'hotel_budget')
    <!-- ======================================================== -->
    <!-- 🛏️ LAYOUT: SMART BUDGET EXPRESS HOTEL & TRAVEL LODGE      -->
    <!-- Ginger & OYO Townhouse Style • Free Breakfast • Best Tariff-->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-teal-200">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=1600&auto=format&fit=crop&q=85" alt="Smart Budget Hotel" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-teal-950 via-slate-900/80 to-slate-900/75"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal-500/20 border border-teal-400/50 text-teal-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-bed text-teal-400"></i> Smart Economy Hotel &bull; Best Price Guarantee &bull; {{ $tenant->city ?: 'Nagpur' }}
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] mb-5 text-slate-100">
                Clean Sanitized AC Rooms, Free Breakfast &amp; Best Rate Guarantee
            </h1>

            <p class="text-base sm:text-lg text-slate-200 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Smart economy lodging with Ginger & OYO Townhouse convenience. Spotless AC rooms, sealed toiletries, free morning breakfast buffet, and 100 Mbps Wi-Fi with transparent tariffs." }}
            </p>

            <!-- Smart Budget Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-teal-200 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-teal-600 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-moon text-teal-600 mr-1"></i> Duration
                        </span>
                        <div class="text-xs font-bold text-slate-800">1 Night &bull; 2 Guests</div>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-tag text-teal-600 mr-1"></i> Tariff Plan
                        </span>
                        <div class="text-xs font-bold text-teal-700">Best Rate ₹1,299/Night</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-500 hover:to-emerald-500 text-white font-extrabold text-xs shadow-lg shadow-teal-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-shield-halved"></i> Book Sanitized Room
                    </a>
                </div>
            </div>

            <!-- Smart Budget Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-slate-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-shield-halved text-teal-400 text-sm"></i> 100% Sanitized Guarantee</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-mug-hot text-amber-300 text-sm"></i> Free Hot Breakfast Buffet</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-wifi text-teal-400 text-sm"></i> 100 Mbps Fast Internet</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-receipt text-teal-400 text-sm"></i> Zero Hidden Charges</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'hotel_family')
    <!-- ======================================================== -->
    <!-- 🌴 LAYOUT: FAMILY HOTEL & GARDEN BANQUET LAWN             -->
    <!-- Interconnected Suites • 500+ Guest Lawn • Kids Zone      -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-amber-900/30">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=1600&auto=format&fit=crop&q=85" alt="Family Hotel & Lawn" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/70 to-stone-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/20 border border-amber-400/50 text-amber-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-people-roof text-amber-400"></i> Family Staycation Hotel &bull; Marriage Party Lawn &bull; {{ $tenant->city ?: 'Nagpur' }}
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] mb-5 text-amber-50">
                Spacious Family Suites, Green Party Lawns &amp; Celebrations
            </h1>

            <p class="text-base sm:text-lg text-amber-100/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. The top choice for family getaways, wedding guests, birthday parties, and group celebrations in {$tenant->city}. Interconnected family suites, 500+ capacity open marriage lawn, pure veg restaurant, and kids splash pool." }}
            </p>

            <!-- Family & Banquet Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-amber-200 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-amber-600 mr-1"></i> Event / Stay Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-solid fa-tree text-amber-600 mr-1"></i> Purpose
                        </span>
                        <div class="text-xs font-bold text-slate-800">Family Stay / Lawn Event</div>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-solid fa-users text-amber-600 mr-1"></i> Guests
                        </span>
                        <div class="text-xs font-bold text-slate-800">4-6 Family Suite / 100+ Lawn</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-600 to-rose-600 hover:from-amber-500 hover:to-rose-500 text-white font-extrabold text-xs shadow-lg shadow-amber-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-champagne-glasses"></i> Inquire Suite &amp; Lawn
                    </a>
                </div>
            </div>

            <!-- Family Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-amber-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-people-group text-amber-400 text-sm"></i> Interconnected Family Suites</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-tree text-emerald-400 text-sm"></i> 500+ Capacity Green Lawn</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-water-ladder text-sky-400 text-sm"></i> Kids Splash Pool</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-bowl-rice text-amber-400 text-sm"></i> Pure Veg Family Dining</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'hotel_resort')
    <!-- ======================================================== -->
    <!-- 🏨 LAYOUT 1: GRAND PALACE & 5-STAR HERITAGE RESORT       -->
    <!-- Full-Bleed Cinematic Hero + Floating Horizontal Booking Bar -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-amber-900/30">
        <!-- Cinematic Full-Bleed Background Image with Vignette -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600&auto=format&fit=crop&q=85" alt="Grand Luxury Palace Resort" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/60 to-stone-950/80"></div>
        </div>

        <!-- Centered Regal Content -->
        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <!-- Heritage Gold Pill -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/15 border border-amber-400/40 text-amber-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-crown text-[10px] text-amber-400"></i> Five-Star Heritage Luxury Resort &amp; Palace
            </div>

            <!-- Regal Serif Headline -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-stone-100">
                Experience Timeless Grandeur &amp; Royal Stays in <span class="text-amber-400 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-stone-300 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. An oasis of refined hospitality, opulent AC suites, award-winning multi-cuisine dining, and 24/7 personal butler care." }}
            </p>

            <!-- 🏨 Floating Horizontal Hotel Booking Bar (Classic 5-Star Hotel Engine) -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-amber-200/50 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <!-- Check-In -->
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-rose-500 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <!-- Check-Out -->
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-rose-500 mr-1"></i> Check-Out Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <!-- Guests -->
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-0.5">
                            <i class="fa-solid fa-user-group text-purple-600 mr-1"></i> Guests &amp; Suites
                        </span>
                        <div class="text-xs font-bold text-slate-800">2 Adults &bull; 1 Suite</div>
                    </div>

                    <!-- Action Button -->
                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-rose-600 via-rose-700 to-amber-600 hover:from-rose-500 hover:to-amber-500 text-white font-extrabold text-xs shadow-lg shadow-rose-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-bed"></i> Check Rates &amp; Book
                    </a>
                </div>
            </div>

            <!-- Heritage Trust Badges -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-stone-300">
                <span class="flex items-center gap-2"><i class="fa-solid fa-award text-amber-400 text-sm"></i> 5-Star Heritage Architecture</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-bell-concierge text-amber-400 text-sm"></i> 24/7 Butler &amp; Dining</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-water-ladder text-amber-400 text-sm"></i> Infinity Pool &amp; Spa</span>
                <span class="flex items-center gap-2"><i class="fa-brands fa-whatsapp text-emerald-400 text-sm"></i> Instant WhatsApp Desk</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'dark_luxury')
    <!-- ======================================================== -->
    <!-- 🌙 THEME: OBSIDIAN DARK LUXURY / HIGH-CONVERTING FUNNEL  -->
    <!-- Adapts automatically to Business Category with Dark VIP  -->
    <!-- ======================================================== -->
    @php
        $bizCat = $tenant->settings['business_category'] ?? ($tenant->archetype->name ?? 'Other Retail');
        $cityUpper = strtoupper($tenant->city ?: 'YOUR CITY');
        $isHotelCategory = stripos($bizCat, 'Hotel') !== false || stripos($bizCat, 'Motel') !== false || $archetype->code === 'hospitality';
    @endphp

    <section id="hero" class="relative overflow-hidden py-16 md:py-24 bg-gradient-to-b from-[#090D16] via-[#0D121F] to-[#090D16] text-white border-b border-zinc-800">
        <!-- Golden Ambient Glow Orbs -->
        <div class="absolute top-1/4 left-1/3 w-96 h-96 rounded-full blur-3xl opacity-20 pointer-events-none bg-amber-500"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 rounded-full blur-3xl opacity-15 pointer-events-none bg-purple-600"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left 7 Cols: Narrative -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    @if($bizCat === 'Beauty & Salons')
                        <!-- Glowing VIP Badge -->
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-pink-500/40 text-pink-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-pink-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-crown text-pink-400"></i> LUXURY BRIDAL &amp; BEAUTY STUDIO &bull; VIP APPOINTMENTS
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            THE OBSIDIAN BEAUTY EXPERIENCE — BESPOKE SALON &amp; BRIDAL LOUNGE IN <span class="bg-gradient-to-r from-pink-400 via-rose-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Flawless bridal HD makeovers, premium hair therapies, and personalized luxury aesthetics. Experience celebrity stylist appointments in private VIP suites with organic care.
                        </p>

                        <!-- Glassmorphic Perks Box -->
                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-wand-magic-sparkles text-pink-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Bridal HD Makeup</span>
                                <span class="text-[9px] text-zinc-500">Airbrush Glamour</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-scissors text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Master Stylists</span>
                                <span class="text-[9px] text-zinc-500">10+ Yrs Experience</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-sparkles text-rose-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Private VIP Booth</span>
                                <span class="text-[9px] text-zinc-500">100% Sanitized</span>
                            </div>
                        </div>

                        <!-- CTAs -->
                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-pink-500 via-rose-500 to-purple-600 hover:from-pink-400 hover:to-purple-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-pink-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-calendar-check"></i> Book VIP Stylist Slot
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a VIP Bridal / Salon Appointment.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> VIP Salon WhatsApp
                            </a>
                        </div>

                    @elseif(in_array($bizCat, ['Clinics & Hospitals', 'Doctors & Specialists']))
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-sky-500/40 text-sky-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-sky-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-stethoscope text-sky-400"></i> SPECIALIST OPD CLINIC &bull; ZERO-WAIT DIGITAL CARE
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            EXPERT MEDICAL CONSULTATIONS &amp; CLINICAL CARE IN <span class="bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Skip the long OPD queues. Consult certified specialist MD doctors with guaranteed time slots, digital prescriptions, comprehensive diagnostics, and emergency support.
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-user-doctor text-sky-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Verified MDs</span>
                                <span class="text-[9px] text-zinc-500">Senior Specialists</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-clock text-emerald-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Zero Waiting</span>
                                <span class="text-[9px] text-zinc-500">Guaranteed Slot</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-notes-medical text-blue-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Digital Token</span>
                                <span class="text-[9px] text-zinc-500">Instant WhatsApp</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-sky-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-calendar-check"></i> Book Instant OPD Slot
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book an urgent OPD consultation slot.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Helpline
                            </a>
                        </div>

                    @elseif($bizCat === 'Coaching & Institutes')
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-blue-500/40 text-blue-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-blue-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-graduation-cap text-blue-400"></i> JEE, NEET &amp; BOARD EXAM ACADEMY &bull; SCHOLARSHIP BATCH
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            CRACK COMPETITIVE EXAMS WITH TOP RANKERS IN <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Join intensive rank-booster batches mentored by IITian &amp; Medical alumni. Comprehensive test series, daily 1-on-1 doubt solving, and up to 90% scholarship test pass.
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-award text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">90% Scholarship</span>
                                <span class="text-[9px] text-zinc-500">Aptitude Test</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-chalkboard-user text-blue-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Free Demo Class</span>
                                <span class="text-[9px] text-zinc-500">3 Days Access</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-users text-emerald-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Small Batches</span>
                                <span class="text-[9px] text-zinc-500">1-on-1 Doubts</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-pencil"></i> Register Free Demo Class
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like admission details and free demo pass.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Academic Counselor
                            </a>
                        </div>

                    @elseif($bizCat === 'Manufacturers')
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-industry text-amber-400"></i> ISO 9001:2015 CERTIFIED OEM PLANT &bull; B2B WHOLESALE
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            PRECISION INDUSTRIAL MANUFACTURING &amp; SUPPLY IN <span class="bg-gradient-to-r from-amber-400 via-orange-400 to-amber-500 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            High-precision CNC machining, metal fabrication, and turnkey contract component manufacturing with direct factory pricing and certified Mill Test Reports (MTR).
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-tags text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Factory Rates</span>
                                <span class="text-[9px] text-zinc-500">Direct Wholesale</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-certificate text-emerald-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">MTR Quality</span>
                                <span class="text-[9px] text-zinc-500">100% Inspected</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-truck-fast text-blue-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Pan-India</span>
                                <span class="text-[9px] text-zinc-500">Fast Dispatch</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-400 hover:to-orange-500 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-file-invoice"></i> Request Instant RFQ Quote
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I need an urgent B2B quotation for manufacturing.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Engineering Desk
                            </a>
                        </div>

                    @elseif($bizCat === 'Real Estate & Properties')
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-teal-500/40 text-teal-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-teal-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-building-circle-check text-teal-400"></i> RERA REGISTERED LUXURY TOWNSHIP &bull; FREE CAB VISIT
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            PRE-LAUNCH LUXURY 2 &amp; 3 BHK RESIDENCES IN <span class="bg-gradient-to-r from-teal-400 via-emerald-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Save up to ₹10 Lakhs with early-bird pre-launch pricing. RERA-approved gated township with 25+ modern amenities and complimentary doorstep AC cab for site visits.
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-shield-halved text-teal-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">RERA Approved</span>
                                <span class="text-[9px] text-zinc-500">100% Clear Title</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-car text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Free Cab Visit</span>
                                <span class="text-[9px] text-zinc-500">Doorstep Pick &amp; Drop</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-building-columns text-emerald-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">80% Bank Loan</span>
                                <span class="text-[9px] text-zinc-500">Pre-Sanctioned</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-400 hover:to-emerald-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-teal-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-car"></i> Book Free Site Visit Cab
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a site visit cab and download brochure.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Download Brochure
                            </a>
                        </div>

                    @elseif($bizCat === 'Restaurant & Cafes')
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-rose-500/40 text-rose-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-rose-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-utensils text-rose-400"></i> GOURMET DINING &bull; LIVE KITCHEN &amp; PRIVATE BOOTHS
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            EXQUISITE FLAVORS &amp; HANDCRAFTED DELICACIES IN <span class="bg-gradient-to-r from-rose-400 via-amber-400 to-orange-400 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Handcrafted multi-cuisine delicacies prepared by master chefs using farm-fresh ingredients. Experience intimate dining atmospheres, weekend buffets, and quick WhatsApp takeaways.
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-fire-burner text-rose-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Live Kitchen</span>
                                <span class="text-[9px] text-zinc-500">100% Fresh Food</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-chair text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">VIP Booths</span>
                                <span class="text-[9px] text-zinc-500">Table Booking</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-percent text-emerald-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Flat 20% Off</span>
                                <span class="text-[9px] text-zinc-500">Takeaway Orders</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-rose-600 to-amber-600 hover:from-rose-500 hover:to-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-rose-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-chair"></i> Reserve Dining Table Now
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to order food takeaway / reserve a table.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Order on WhatsApp
                            </a>
                        </div>

                    @elseif($bizCat === 'Herbal Care')
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-emerald-500/40 text-emerald-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-emerald-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-leaf text-emerald-400"></i> 100% ORGANIC AYURVEDA &bull; ZERO CHEMICALS
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            AUTHENTIC AYURVEDIC HEALING &amp; FORMULATIONS IN <span class="bg-gradient-to-r from-emerald-400 via-teal-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Pure cold-pressed herbal oils, organic immunity formulations, and holistic healing backed by centuries-old Ayurvedic traditions with free certified Vaidya consultations.
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-seedling text-emerald-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">100% Organic</span>
                                <span class="text-[9px] text-zinc-500">GMP Certified</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-user-nurse text-teal-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Free Vaidya Call</span>
                                <span class="text-[9px] text-zinc-500">Nadi Pariksha</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-truck-fast text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Fast Dispatch</span>
                                <span class="text-[9px] text-zinc-500">Doorstep Delivery</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-emerald-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-bag-shopping"></i> Order Herbal Formulations
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like a free Vaidya consultation on WhatsApp.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Free Doctor Call
                            </a>
                        </div>

                    @elseif($bizCat === 'Other Services')
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-purple-500/40 text-purple-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-purple-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-briefcase text-purple-400"></i> CORPORATE ADVISORY, TAX &amp; COMPLIANCE &bull; PROVEN RESULTS
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            EXECUTIVE STRATEGIC BUSINESS ADVISORY IN <span class="bg-gradient-to-r from-purple-400 via-indigo-400 to-blue-400 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Empowering enterprises and professionals with strategic financial consulting, corporate taxation, and regulatory legal compliance with dedicated relationship managers.
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-award text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">15+ Yrs Practice</span>
                                <span class="text-[9px] text-zinc-500">Certified CA/CS</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-handshake text-purple-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Fixed Retainers</span>
                                <span class="text-[9px] text-zinc-500">Zero Hidden Cost</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-chart-line text-emerald-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">500+ Clients</span>
                                <span class="text-[9px] text-zinc-500">Proven ROI</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-purple-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-calendar-check"></i> Book 1-on-1 Strategy Session
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to discuss corporate consulting advisory.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Advisory
                            </a>
                        </div>

                    @elseif($isHotelCategory)
                        <!-- EXACT ORIGINAL HOTEL & MOTEL VIP PENTHOUSE -->
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-400 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-crown text-amber-400"></i> EXCLUSIVE VIP RETREAT &bull; PRIVATE MEMBERS &amp; GUESTS
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            THE OBSIDIAN EXPERIENCE — PRIVATE PENTHOUSES IN <span class="bg-gradient-to-r from-amber-300 via-amber-400 to-amber-600 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-400 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Designed for executive privacy, discreet celebrations, and midnight skyline views. Indulge in bespoke penthouse suites, private mixology, and 24/7 VIP concierge butler service.
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-shield-halved text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">100% Privacy</span>
                                <span class="text-[9px] text-zinc-500">Discreet Keycard</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-car text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">VIP Transfer</span>
                                <span class="text-[9px] text-zinc-500">Chauffeur Ready</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-martini-glass-citrus text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Skyline Lounge</span>
                                <span class="text-[9px] text-zinc-500">Rooftop Access</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-crown"></i> Reserve VIP Penthouse
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve a VIP Suite.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> VIP Concierge WhatsApp
                            </a>
                        </div>

                    @else
                        <!-- Other Retail / General Flash Sale Funnel -->
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-bolt text-amber-400"></i> MEGA FLASH SALE &bull; FLAT 40% OFF TODAY ONLY
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            EXCLUSIVE RETAIL OFFERS &amp; NEW ARRIVALS IN <span class="bg-gradient-to-r from-amber-400 via-orange-400 to-rose-400 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Shop premium collections, everyday essentials, and exclusive brand deals at unbeatable prices. Guaranteed quality and superfast WhatsApp ordering with direct doorstep delivery.
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-tags text-rose-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Flat 40% Off</span>
                                <span class="text-[9px] text-zinc-500">Today's Deals</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-truck-fast text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Fast Delivery</span>
                                <span class="text-[9px] text-zinc-500">At Doorstep</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-shield-halved text-emerald-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">100% Genuine</span>
                                <span class="text-[9px] text-zinc-500">Verified Products</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 via-orange-500 to-rose-600 hover:from-amber-400 hover:to-rose-500 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-bag-shopping"></i> Claim Flash Discount Now
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to order products from today\'s flash sale.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Order on WhatsApp
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Right 5 Cols: Photo matching category -->
                <div class="lg:col-span-5">
                    @php
                        if ($bizCat === 'Beauty & Salons') {
                            $heroImg = 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 LUXURY SALON';
                            $imgBadge = 'Flagship Beauty Lounge';
                        } elseif (in_array($bizCat, ['Clinics & Hospitals', 'Doctors & Specialists'])) {
                            $heroImg = 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 PATIENT RATING';
                            $imgBadge = 'Multi-Specialty Clinic';
                        } elseif ($bizCat === 'Coaching & Institutes') {
                            $heroImg = 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 98% SUCCESS RATE';
                            $imgBadge = 'Premier Coaching Academy';
                        } elseif ($bizCat === 'Manufacturers') {
                            $heroImg = 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ ISO 9001:2015';
                            $imgBadge = 'Certified OEM Plant';
                        } elseif ($bizCat === 'Real Estate & Properties') {
                            $heroImg = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ RERA APPROVED';
                            $imgBadge = 'Flagship Township';
                        } elseif ($bizCat === 'Restaurant & Cafes') {
                            $heroImg = 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 FOODIE RATING';
                            $imgBadge = 'Gourmet Dining Lounge';
                        } elseif ($bizCat === 'Herbal Care') {
                            $heroImg = 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 100% AYURVEDIC';
                            $imgBadge = 'Ayurvedic Sanctuary';
                        } elseif ($bizCat === 'Other Services') {
                            $heroImg = 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 ADVISORY RATING';
                            $imgBadge = 'Corporate Advisory';
                        } elseif ($isHotelCategory) {
                            $heroImg = 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 VIP RATING';
                            $imgBadge = 'Flagship Residence';
                        } else {
                            $heroImg = 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 STORE RATING';
                            $imgBadge = 'Flagship Superstore';
                        }
                    @endphp

                    <div class="relative rounded-3xl overflow-hidden border-2 border-amber-500/30 shadow-2xl shadow-amber-500/10 group aspect-4/3">
                        <img src="{{ $heroImg }}" alt="{{ $tenant->business_name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent"></div>
                        <div class="absolute top-4 right-4 bg-amber-500 text-slate-950 font-black text-[10px] px-3 py-1 rounded-full uppercase tracking-wider shadow">
                            {{ $imgRating }}
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="text-amber-400 text-[10px] font-black uppercase tracking-widest block mb-0.5">{{ $imgBadge }}</span>
                            <h3 class="text-white font-black text-xl">{{ $tenant->business_name }}</h3>
                            <p class="text-xs text-zinc-400"><i class="fa-solid fa-location-dot text-amber-500"></i> {{ $tenant->address ?: $tenant->city }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif($currentTheme === 'minimal_card')
    <!-- ======================================================== -->
    <!-- 🏛️ LAYOUT 4: SANTORINI & MEDITERRANEAN CLIFFSIDE MINIMALIST -->
    <!-- Whitewashed Stucco + Sea-Facing Plunge Pools & Sunset Terraces -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-sky-100">
        <!-- Cinematic Santorini Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=1600&auto=format&fit=crop&q=85" alt="Santorini Cliffside Stay" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-slate-950/70"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <!-- Mediterranean Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md border border-white/40 text-sky-200 text-xs font-bold tracking-widest uppercase mb-6">
                <i class="fa-solid fa-water text-sky-300"></i> Santorini &amp; Cycladic Cliffside Minimalist Stays
            </div>

            <!-- Headline -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-white">
                Sun-Drenched Serenity &amp; Sea-Facing Plunge Pools in <span class="text-sky-300 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-200 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Stripped of noise, immersed in Aegean light. Organic whitewashed curves, private cliffside plunge pools, and uninterrupted sunset views over {$tenant->city}." }}
            </p>

            <!-- Floating Mediterranean Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-sky-100 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-sky-50/60 border border-sky-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-sky-700 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-sky-600 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-sky-50/60 border border-sky-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-sky-700 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-sky-600 mr-1"></i> Check-Out Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-sky-50/60 border border-sky-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-sky-700 mb-0.5">
                            <i class="fa-solid fa-water text-sky-600 mr-1"></i> Cliffside Suite
                        </span>
                        <div class="text-xs font-bold text-slate-800">Caldera Suite &bull; Plunge Pool</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-xs shadow-lg shadow-sky-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-water"></i> Check Plunge Pools
                    </a>
                </div>
            </div>

            <!-- Santorini Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-slate-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-water-ladder text-sky-400 text-sm"></i> Private Sea-Facing Plunge Pools</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-sun text-amber-300 text-sm"></i> Sunset Caldera Terraces</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-utensils text-sky-400 text-sm"></i> Organic Mediterranean Breakfast</span>
                <span class="flex items-center gap-2"><i class="fa-brands fa-whatsapp text-emerald-400 text-sm"></i> Instant Concierge Desk</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'nature_retreat')
    <!-- ======================================================== -->
    <!-- 🌿 LAYOUT 5: WILDERNESS SAFARI CAMP & TREEHOUSE LODGE    -->
    <!-- Canopy Rainforest Atmosphere + 4x4 Jeep Safari Planner   -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-emerald-900/40">
        <!-- Deep Rainforest Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1510312305653-8ed496efae75?w=1600&auto=format&fit=crop&q=85" alt="Safari Glamping Camp" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-emerald-950/70 to-stone-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-campground text-emerald-400"></i> Aman-Inspired Eco-Forest Glamping &amp; Safari Reserve
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-emerald-50">
                Untamed Wilderness, Elevated Luxury in the Forests of <span class="text-emerald-400 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-emerald-200/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Reconnect with the living earth beneath towering forest canopies. Custom teakwood canvas suites, morning 4x4 open jeep game drives, and starlit campfire dining under clear night skies." }}
            </p>

            <!-- Safari Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-emerald-100 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-emerald-50/70 border border-emerald-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-emerald-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-emerald-600 mr-1"></i> Safari Check-In
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-emerald-50/70 border border-emerald-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-emerald-800 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-emerald-600 mr-1"></i> Safari Check-Out
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-emerald-50/70 border border-emerald-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-emerald-800 mb-0.5">
                            <i class="fa-solid fa-tree text-emerald-600 mr-1"></i> Lodging Choice
                        </span>
                        <div class="text-xs font-bold text-slate-800">Canopy Treehouse Villa</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-emerald-700 to-green-600 hover:from-emerald-600 hover:to-green-500 text-white font-extrabold text-xs shadow-lg shadow-emerald-700/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-compass"></i> Reserve Safari Tent
                    </a>
                </div>
            </div>

            <!-- Safari Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-emerald-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-truck-monster text-emerald-400 text-sm"></i> Open 4x4 Jeep Safaris</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-tree text-emerald-400 text-sm"></i> Canopy Teakwood Treehouses</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-fire text-amber-400 text-sm"></i> Starlit Campfire &amp; BBQ</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-binoculars text-emerald-400 text-sm"></i> Guided Naturalist Treks</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'coastal_beach')
    <!-- ======================================================== -->
    <!-- 🌊 LAYOUT 6: MALDIVES OVERWATER VILLA & OCEAN SANCTUARY  -->
    <!-- Crystal Lagoon Atmosphere + Overwater Stilt Bungalow Bar -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-cyan-100">
        <!-- Ocean Lagoon Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=1600&auto=format&fit=crop&q=85" alt="Maldives Overwater Resort" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/35 to-slate-950/60"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-500/20 border border-cyan-400/40 text-cyan-200 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-water-ladder text-cyan-400"></i> Maldives Overwater Bungalows &amp; Ocean Sanctuary
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.1] mb-5 text-white">
                Where Crystal Waters Meet Private Solitude in <span class="text-cyan-300 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-cyan-100/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Step directly from your private bedroom ladder into crystal turquoise ocean waters. Featuring glass floor ocean view panels, private overwater plunge pools, and beach cabana dining." }}
            </p>

            <!-- Lagoon Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-cyan-100 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-cyan-50/70 border border-cyan-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-cyan-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-cyan-600 mr-1"></i> Arrival Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-cyan-50/70 border border-cyan-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-cyan-800 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-cyan-600 mr-1"></i> Departure Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-cyan-50/70 border border-cyan-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-cyan-800 mb-0.5">
                            <i class="fa-solid fa-water text-cyan-600 mr-1"></i> Villa Type
                        </span>
                        <div class="text-xs font-bold text-slate-800">Overwater Glass-Floor Villa</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white font-extrabold text-xs shadow-lg shadow-cyan-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-fish-fins"></i> Book Overwater Villa
                    </a>
                </div>
            </div>

            <!-- Coastal Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-cyan-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-water-ladder text-cyan-400 text-sm"></i> Direct Lagoon Ladder Access</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-umbrella-beach text-cyan-400 text-sm"></i> Private Beachfront Cabanas</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-ship text-cyan-400 text-sm"></i> Sunset Catamaran Sailing</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-champagne-glasses text-cyan-400 text-sm"></i> Candlelight Beach BBQ</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'heritage_haveli')
    <!-- ======================================================== -->
    <!-- 👑 LAYOUT 7: RAJASTHAN ROYAL HAVELI & HERITAGE FORT STAY -->
    <!-- Rajputana Courtyard + Jharokha Arches & Royal Thali Bar  -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-amber-900/40">
        <!-- Royal Haveli Courtyard Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1599661046289-e31897846e41?w=1600&auto=format&fit=crop&q=85" alt="Royal Haveli Rajasthan" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/65 to-stone-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/20 border border-amber-400/50 text-amber-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-chess-rook text-amber-400"></i> 300-Year Heritage Rajputana Haveli &amp; Royal Fort
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-amber-50">
                Live Like Royalty Amidst Carved Jharokhas in <span class="text-amber-400 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-amber-200/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Step into an era of regal splendor. Greeted by traditional Dhol Nagada and fragrant rose petals, relax in hand-painted Maharaja suites with antique four-poster brass beds and courtyards." }}
            </p>

            <!-- Royal Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-amber-200 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-amber-50/70 border border-amber-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-amber-600 mr-1"></i> Royal Arrival
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-amber-50/70 border border-amber-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-amber-600 mr-1"></i> Royal Departure
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-amber-50/70 border border-amber-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-solid fa-crown text-amber-600 mr-1"></i> Suite Choice
                        </span>
                        <div class="text-xs font-bold text-slate-800">Maharaja Jharokha Suite</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-amber-600 via-rose-700 to-amber-700 hover:from-amber-500 hover:to-rose-600 text-white font-extrabold text-xs shadow-lg shadow-amber-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-chess-rook"></i> Reserve Royal Suite
                    </a>
                </div>
            </div>

            <!-- Haveli Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-amber-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-bell text-amber-400 text-sm"></i> Dhol &amp; Tilak Royal Swagat</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-masks-theater text-amber-400 text-sm"></i> Live Kathputli &amp; Folk Dance</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-utensils text-amber-400 text-sm"></i> 36-Dish Rajasthani Darbar Thali</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-bed text-amber-400 text-sm"></i> Hand-Carved Brass Four-Poster Beds</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'mountain_chalet')
    <!-- ======================================================== -->
    <!-- 🏔️ LAYOUT 8: HIMALAYAN PINE CHALET & ALPINE SNOW RESORT -->
    <!-- Alpine Cedar Wood + Stone Fireplaces & Heated Jacuzzis   -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-orange-950/40">
        <!-- Mountain Snow Chalet Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1502784444187-359ac186c5bb?w=1600&auto=format&fit=crop&q=85" alt="Alpine Mountain Chalet" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/60 to-stone-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-500/20 border border-orange-400/50 text-orange-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-mountain text-orange-400"></i> Alpine Cedarwood Retreat &amp; Heated Hydrotherapy Spa
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-orange-50">
                Crisp Mountain Air &amp; Crackling Hearth Fires in <span class="text-orange-400 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-orange-200/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Perched amidst fragrant deodar and pine forests. Cozy cedarwood suites with in-room crackling stone hearths, steaming private hydrotherapy jacuzzis, and panoramic snow peak views." }}
            </p>

            <!-- Alpine Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-orange-200 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-orange-50/70 border border-orange-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-orange-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-orange-600 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-orange-50/70 border border-orange-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-orange-800 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-orange-600 mr-1"></i> Check-Out Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-orange-50/70 border border-orange-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-orange-800 mb-0.5">
                            <i class="fa-solid fa-mountain text-orange-600 mr-1"></i> Chalet Room
                        </span>
                        <div class="text-xs font-bold text-slate-800">Cedar Chalet &bull; Stone Fireplace</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-orange-600 to-amber-700 hover:from-orange-500 hover:to-amber-600 text-white font-extrabold text-xs shadow-lg shadow-orange-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-fire"></i> Book Alpine Chalet
                    </a>
                </div>
            </div>

            <!-- Chalet Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-orange-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-fire-burner text-orange-400 text-sm"></i> In-Suite Stone Fireplace</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-hot-tub-person text-orange-400 text-sm"></i> Heated Indoor Hydro Jacuzzi</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-snowflake text-sky-300 text-sm"></i> Snow-Capped Peak Balconies</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-person-hiking text-orange-400 text-sm"></i> Guided Pine Forest Treks</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'wellness_sanctuary')
    <!-- ======================================================== -->
    <!-- 🧘 LAYOUT 9: HIMALAYAN AYURVEDA, YOGA & WELLNESS RETREAT -->
    <!-- Zen Mountain Mist + Sunrise Yoga & Panchakarma Booking   -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-teal-950/40">
        <!-- Healing Yoga & Lotus Garden Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=1600&auto=format&fit=crop&q=85" alt="Ayurvedic Yoga Retreat" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-teal-950 via-stone-950/70 to-teal-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal-500/20 border border-teal-400/50 text-teal-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-spa text-teal-400"></i> Authentic Himalayan Ayurveda, Panchakarma &amp; Yoga Sanctuary
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-teal-50">
                Restore Deep Harmony of Body, Mind &amp; Prana in <span class="text-teal-300 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-teal-200/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. A sacred haven for rejuvenation and holistic healing. Guided by seasoned Ayurvedic Vaidyas, experience personalized pulse diagnoses, traditional herbal therapies, daily sunrise yoga, and farm-fresh sattvic meals." }}
            </p>

            <!-- Healing Retreat Planner -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-teal-200 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-teal-50/70 border border-teal-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-teal-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-teal-600 mr-1"></i> Retreat Start Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-teal-50/70 border border-teal-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-teal-800 mb-0.5">
                            <i class="fa-solid fa-hourglass-half text-teal-600 mr-1"></i> Retreat Program
                        </span>
                        <div class="text-xs font-bold text-slate-800">7-Day Detox &amp; Rejuvenation</div>
                    </div>

                    <div class="p-2.5 rounded-2xl bg-teal-50/70 border border-teal-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-teal-800 mb-0.5">
                            <i class="fa-solid fa-house-chimney text-teal-600 mr-1"></i> Healing Cottage
                        </span>
                        <div class="text-xs font-bold text-slate-800">Ayurvedic Garden Villa</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-teal-700 to-emerald-600 hover:from-teal-600 hover:to-emerald-500 text-white font-extrabold text-xs shadow-lg shadow-teal-700/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-spa"></i> Begin Healing Journey
                    </a>
                </div>
            </div>

            <!-- Sanctuary Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-teal-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-heart-pulse text-teal-400 text-sm"></i> Doctor Nadi (Pulse) Diagnosis</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-sun text-amber-300 text-sm"></i> Sunrise Yoga &amp; Pranayama</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-leaf text-emerald-400 text-sm"></i> Authentic Herbal Abhyanga Spa</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-bowl-rice text-teal-400 text-sm"></i> Farm-to-Table Sattvic Dining</span>
            </div>
        </div>
    </section>

    @else
    <!-- ======================================================== -->
    <!-- 🏡 LAYOUT 2: MODERN BOUTIQUE & AIRBNB VILLA (DEFAULT)     -->
    <!-- Bento 3-Photo Collage + Amenity Pills + Host Chat         -->
    <!-- ======================================================== -->
    <section id="hero" class="relative overflow-hidden py-12 md:py-20 bg-gradient-to-b from-sky-50/50 via-white to-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols: Boutique Villa Info & Booking Card -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Superhost / Industry Pill -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-sky-200 text-sky-800 text-xs font-black shadow-xs">
                        @if($archetype->code === 'hospitality')
                            <i class="fa-solid fa-star text-amber-400"></i> 4.98 Superhost Rated &bull; Boutique Stays &amp; Villas
                        @elseif($archetype->code === 'b2b')
                            <i class="fa-solid fa-certificate text-amber-500"></i> ISO Certified Industrial Manufacturing &amp; Supply
                        @elseif($archetype->code === 'service')
                            <i class="fa-solid fa-stethoscope text-sky-500"></i> Certified Healthcare &amp; Consultation Clinic
                        @else
                            <i class="fa-solid fa-bag-shopping text-emerald-500"></i> Top Rated Daily Essentials &amp; Retail Store
                        @endif
                    </div>

                    <!-- Modern Sans Headline -->
                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-[1.1]">
                        @if($archetype->code === 'hospitality')
                            Your Private Boutique Haven in the Heart of <span class="text-sky-600">{{ $tenant->city ?: 'Your City' }}</span>
                        @elseif($archetype->code === 'b2b')
                            Precision Engineering &amp; Custom Fabrication in <span class="text-amber-600">{{ $tenant->city ?: 'Our Works' }}</span>
                        @elseif($archetype->code === 'service')
                            Advanced Healthcare &amp; Consultation in <span class="text-sky-600">{{ $tenant->city ?: 'Your City' }}</span>
                        @else
                            Fresh Groceries &amp; Daily Needs Delivered in <span class="text-rose-600">{{ $tenant->city ?: 'Your City' }}</span>
                        @endif
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-xl">
                        {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Providing dependable service, verified quality, and fast WhatsApp order support to our valued patrons in " . ($tenant->city ?: 'our city') . "." }}
                    </p>

                    <!-- Modern Amenity Pills -->
                    <div class="flex flex-wrap gap-2 pt-1">
                        @if($archetype->code === 'hospitality')
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-wifi text-sky-500"></i> 250 Mbps Wi-Fi
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-person-swimming text-sky-500"></i> Pool Access
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-mug-saucer text-sky-500"></i> Free Breakfast
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-square-parking text-sky-500"></i> Free Parking
                            </span>
                        @elseif($archetype->code === 'b2b')
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-gears text-amber-500"></i> CNC Turning &amp; Milling
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-file-contract text-amber-500"></i> MTR Quality Reports
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-truck-fast text-amber-500"></i> Fast Dispatch
                            </span>
                        @else
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-star text-amber-500"></i> 4.9/5 Rating
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-clock text-emerald-500"></i> Open Today
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-shield-halved text-sky-500"></i> Verified Business
                            </span>
                        @endif
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center gap-3 pt-3">
                        <a href="#services" class="w-full sm:w-auto px-7 py-3.5 rounded-2xl bg-sky-600 hover:bg-sky-500 text-white font-extrabold text-sm shadow-lg shadow-sky-600/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                            @if($archetype->code === 'hospitality')
                                <i class="fa-solid fa-bed"></i> Browse Suites &amp; Reserve
                            @elseif($archetype->code === 'b2b')
                                <i class="fa-solid fa-file-invoice-dollar"></i> Request a Quote
                            @elseif($archetype->code === 'service')
                                <i class="fa-regular fa-calendar-check"></i> Book Appointment Slot
                            @else
                                <i class="fa-solid fa-bag-shopping"></i> Browse Store Catalog
                            @endif
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to inquire about your services.') }}" target="_blank" class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-md transition hover:scale-[1.02] flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i> {{ $archetype->code === 'hospitality' ? 'Chat with Host' : 'WhatsApp Us' }}
                        </a>
                    </div>
                </div>

                <!-- Right 5 Cols: Modern Airbnb / Industry Bento Collage (3 Photos) -->
                <div class="lg:col-span-5">
                    <div class="grid grid-cols-2 gap-3.5">
                        <!-- Bento Top Large Photo -->
                        <div class="col-span-2 relative rounded-3xl overflow-hidden shadow-xl aspect-16/10 group">
                            @if($archetype->code === 'hospitality')
                                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&auto=format&fit=crop&q=80" alt="Boutique Villa" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @elseif($archetype->code === 'b2b')
                                <img src="https://images.unsplash.com/photo-1581092335397-9583fe92d232?w=800&auto=format&fit=crop&q=80" alt="Industrial Manufacturing" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @elseif($archetype->code === 'service')
                                <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&auto=format&fit=crop&q=80" alt="Clinic Interior" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <img src="https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=800&auto=format&fit=crop&q=80" alt="Store Front" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @endif

                            <div class="absolute top-3 left-3 bg-white/95 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-black text-slate-900 shadow flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-emerald-500"></i> Verified Facility
                            </div>
                            <div class="absolute bottom-3 left-3 right-3 text-white bg-gradient-to-t from-black/80 to-transparent p-3 rounded-2xl">
                                <span class="font-black text-sm block">{{ $tenant->business_name }}</span>
                                <span class="text-xs text-white/80"><i class="fa-solid fa-location-dot text-rose-400"></i> {{ $tenant->address ?: $tenant->city }}</span>
                            </div>
                        </div>
                        <!-- Bento Small Photo 1 -->
                        <div class="rounded-2xl overflow-hidden aspect-4/3 shadow-md group">
                            <img src="{{ $archetype->code === 'b2b' ? 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=500&auto=format&fit=crop&q=80' : 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=500&auto=format&fit=crop&q=80' }}" alt="Facility Detail" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <!-- Bento Small Photo 2 -->
                        <div class="rounded-2xl overflow-hidden aspect-4/3 shadow-md group">
                            <img src="{{ $archetype->code === 'b2b' ? 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=500&auto=format&fit=crop&q=80' : 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=500&auto=format&fit=crop&q=80' }}" alt="Operations Detail" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endif

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

                @elseif($archetype->code === 'hospitality')
                <!-- Hospitality / Hotel Highlights per Theme -->
                @if($currentTheme === 'hotel_business')
                <!-- City Business Hotel Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-blue-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Ergonomic Workstations</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Every room features dedicated ergonomic desk, universal charging, and 150 Mbps Wi-Fi.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-blue-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Conference Boardrooms</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Equipped for client presentations, video calls, and corporate team negotiations.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-blue-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">24/7 Express Check-In</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Zero wait check-in and checkout tailored for busy corporate flight and train schedules.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-blue-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-van-shuttle"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Airport &amp; Station Shuttle</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Punctual transit pick-up and drop directly to your flight or train terminal.</p>
                </div>

                @elseif($currentTheme === 'motel_highway')
                <!-- Highway Express Motel Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-red-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-red-500/10 text-red-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-square-parking"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Drive-In Safe Parking</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Park directly outside your room with 24/7 CCTV surveillance and security guards.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-red-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">24/7 Front Desk</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Arrive at midnight or 3 AM with zero delay. Instant front desk check-in anytime.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-red-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-orange-500/10 text-orange-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Highway Dhaba Diner</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Freshly made hot dal tadka, rotis, parathas, and hot tea available round the clock.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-red-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-faucet-drip"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">24/7 Hot Water Geyser</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Steaming hot showers to wash off highway road fatigue and recharge quickly.</p>
                </div>

                @elseif($currentTheme === 'hotel_boutique')
                <!-- Urban Boutique Hotel Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-purple-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-martini-glass-citrus"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Rooftop Sunset Lounge</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Panoramic city views, artisanal espresso coffees, woodfired appetizers, and music.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-purple-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-pink-500/10 text-pink-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Couple-Friendly &amp; Safe</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Verified, welcoming, and 100% judgment-free stays with express digital verification.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-purple-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Designer Modern Suites</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Custom furnishings, ambient LED strip lighting, private balconies, and rain showers.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-purple-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">City Center Location</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Situated in the premier dining, shopping, and entertainment hub of the city.</p>
                </div>

                @elseif($currentTheme === 'hotel_budget')
                <!-- Smart Budget Hotel Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">100% Sanitized &amp; Clean</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Deep-sanitized rooms, sealed bath amenities, and fresh crisp white bedding.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-mug-hot"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Free Hot Breakfast</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Complimentary morning breakfast buffet included with every direct booking.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-wifi"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">100 Mbps Free Internet</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Seamless high-speed Wi-Fi in every room for video calls, work, and streaming.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-tag"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Best Rate Guaranteed</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Zero middleman commissions with honest per-night transparent pricing.</p>
                </div>

                @elseif($currentTheme === 'hotel_family')
                <!-- Family Hotel Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Interconnected Suites</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Spacious 4-6 guest adjoining rooms with privacy and shared family living space.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-tree"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">500+ Party &amp; Wedding Lawn</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Expansive landscaped grass lawn for wedding receptions, birthdays, and anniversaries.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-water-ladder"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Kids Splash Pool</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Safe shallow pool and play zone with slides, swings, and games for children.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-bowl-rice"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Pure Veg &amp; Family Dining</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Dedicated family dining hall with authentic North &amp; South Indian vegetarian delicacies.</p>
                </div>

                @elseif($currentTheme === 'hotel_resort')
                <!-- Grand Palace Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-200/60 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">5-Star Butler Service</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Personal concierge, luggage assistance, and bespoke 24/7 in-room dining.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-200/60 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-water-ladder"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Infinity Pool &amp; Cabanas</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Temperature-controlled swimming pool flanked by royal garden sun loungers.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-200/60 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Royal Multi-Cuisine</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Gourmet dining prepared by seasoned chefs with complimentary morning high tea.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-200/60 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Sanitized Royal Suites</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Posturpedic mattresses, daily fresh linens, and premium marble bath amenities.</p>
                </div>

                @elseif($currentTheme === 'dark_luxury')
                <!-- Obsidian VIP Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-zinc-900 border-amber-500/30 shadow-xl">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-car"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-white">VIP Chauffeur Transfer</h4>
                    <p class="text-xs leading-relaxed text-zinc-400">Complimentary luxury vehicle pickup and drop-off for private suite guests.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-zinc-900 border-amber-500/30 shadow-xl">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-hot-tub-person"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-white">Penthouse Jacuzzi</h4>
                    <p class="text-xs leading-relaxed text-zinc-400">In-suite private hot tub with aromatherapy salts and skyline evening vistas.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-zinc-900 border-amber-500/30 shadow-xl">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-martini-glass"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-white">Midnight Lounge</h4>
                    <p class="text-xs leading-relaxed text-zinc-400">Curated rooftop cocktails, mood lighting, and private members ambiance.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-zinc-900 border-amber-500/30 shadow-xl">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-white">Dedicated WhatsApp Butler</h4>
                    <p class="text-xs leading-relaxed text-zinc-400">Instant VIP reservations and concierge response on your personal mobile.</p>
                </div>

                @elseif($currentTheme === 'minimal_card')
                <!-- Santorini Mediterranean Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-sky-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-water-ladder"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Private Plunge Pools</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Cliffside in-suite plunge pools overlooking azure horizons and whitewashed terraces.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-sky-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-sun"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Sunset Caldera Terraces</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Unobstructed golden hour sunsets with chilled Mediterranean wines and appetizers.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-sky-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Organic Aegean Breakfast</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Fresh Greek yoghurt, wild thyme honey, artisan olives, and warm fresh bread daily.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-sky-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-sailboat"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Yacht Charters &amp; Concierge</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Bespoke private boat excursions, hidden beach explorations, and 24/7 host care.</p>
                </div>

                @elseif($currentTheme === 'nature_retreat')
                <!-- Wilderness Safari Glamping Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-emerald-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-truck-monster"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">4x4 Jeep Safaris</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Daily morning and dusk game drives led by veteran wildlife trackers and naturalists.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-emerald-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-tree"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Canopy Treehouses</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Elevated solid teak chalets amidst lush forest canopies with birdwatching decks.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-emerald-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-fire"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Bonfires &amp; Bush Dinners</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Nightly crackling campfires, charcoal BBQ, and astronomy stargazing sessions.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-emerald-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">100% Eco-Sustainable</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Solar-powered luxury canvas tents, zero single-use plastics, and organic forest honey.</p>
                </div>

                @elseif($currentTheme === 'coastal_beach')
                <!-- Maldives Overwater Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-cyan-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 text-cyan-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-water-ladder"></i>
                    </div>
                    <h4 class="font-black text-base mb-1.5 text-slate-900">Lagoon Coral Access</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Private stilt ladder directly into crystalline turquoise reefs filled with exotic marine life.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-cyan-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-umbrella-beach"></i>
                    </div>
                    <h4 class="font-black text-base mb-1.5 text-slate-900">Private Beach Cabanas</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Reserved sun daybeds on powdery white sand with fresh coconut and cocktail service.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-cyan-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-ship"></i>
                    </div>
                    <h4 class="font-black text-base mb-1.5 text-slate-900">Sunset Catamaran Cruise</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Daily twilight yacht sailing to spot playful wild spinner dolphins in open waters.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-cyan-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-champagne-glasses"></i>
                    </div>
                    <h4 class="font-black text-base mb-1.5 text-slate-900">Barefoot Beachfront BBQ</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Candlelight seafood barbecues prepared directly on the sand with ambient island music.</p>
                </div>

                @elseif($currentTheme === 'heritage_haveli')
                <!-- Rajasthan Royal Haveli Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-amber-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Dhol &amp; Tilak Welcome</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Traditional Rajputana royal swagat with rose petal showers and welcome saffron drink.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-amber-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-masks-theater"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Folk Dance &amp; Puppets</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Live courtyard evenings featuring Kathputli puppetry and vibrant Kalbelia dancers.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-amber-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">36-Delicacy Royal Thali</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Authentic Dal Baati Churma, Gatte ki Sabzi, and royal desserts served in silver katoris.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-amber-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-chess-rook"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Carved Jharokha Balconies</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Intricately carved sandstone window bays with plush silken floor cushions.</p>
                </div>

                @elseif($currentTheme === 'mountain_chalet')
                <!-- Alpine Mountain Chalet Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-orange-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-orange-500/10 text-orange-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-fire-burner"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">In-Suite Stone Fireplace</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Crackling alpine cedarwood hearths with cozy armchairs and complimentary hot mulled cider.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-orange-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-hot-tub-person"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Heated Hydro Jacuzzi</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Steaming cedarwood tubs with views of snow-clad pine forest slopes and peaks.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-orange-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-snowflake"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Himalayan Snow Balconies</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Panoramic private balconies catching the first golden morning light on mountain crests.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-orange-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-person-hiking"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Guided Forest Treks</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Private guided walks through fragrant deodar groves, apple orchards, and river trails.</p>
                </div>

                @elseif($currentTheme === 'wellness_sanctuary')
                <!-- Ayurvedic Yoga Sanctuary Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Doctor Nadi Diagnosis</h4>
                    <p class="text-xs leading-relaxed text-stone-600">In-depth Ayurvedic pulse diagnosis and customized Dosha balancing roadmap.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-sun"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Sunrise Yoga &amp; Pranayama</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Daily morning meditation and Hatha yoga sessions in an open-air mountain pavilion.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-spa"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Abhyanga &amp; Shirodhara</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Herbal warm oil therapies and herbal steam baths administered by trained therapists.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-bowl-rice"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Farm-to-Table Sattvic Food</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Organic, freshly cooked alkaline cuisine tailored to enhance vitality and gut health.</p>
                </div>

                @else
                <!-- Modern Boutique Villa Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-slate-200/80 shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Self Check-In Smart Lock</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Effortless arrival with keyless digital access and 24/7 host assistance.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-slate-200/80 shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-wifi"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">250 Mbps Fiber Wi-Fi</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Symmetric high-speed connection for remote work, video calls, and streaming.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-slate-200/80 shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-sparkles"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Spotless Cleanliness</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Professional daily housekeeping, fresh sanitized towels, and crisp linens.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-slate-200/80 shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-tree"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Garden &amp; Pool Access</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Unwind by the swimming pool or enjoy quiet mornings on your private veranda.</p>
                </div>
                @endif

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
                        @elseif($archetype->code === 'hospitality')
                            Accommodations & Suites
                        @else
                            Featured Store Items
                        @endif
                    </h2>
                    <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                        @if($archetype->code === 'service')
                            Available Doctor Consultations & Services
                        @elseif($archetype->code === 'b2b')
                            Industrial Products & Custom Components
                        @elseif($archetype->code === 'hospitality')
                            Luxury Rooms & Suites Availability
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
            @if($archetype->code === 'hospitality')
                <!-- 🏨 HOSPITALITY: 4 DISTINCT ROOM CARD ARCHITECTURES -->

                @if($currentTheme === 'hotel_business')
                <!-- ============================================== -->
                <!-- 🏢 THEME: CITY BUSINESS & EXECUTIVE ROOMS       -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-blue-200 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-briefcase text-[9px]"></i> Corporate Executive
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-wifi text-blue-300"></i> 150 Mbps Wi-Fi &bull; Workstation</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.95 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-blue-50/50 p-4 rounded-2xl border border-blue-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-blue-600 text-xs"></i> Ergonomic Desk &amp; Chair
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-blue-600 text-xs"></i> High-Speed Fiber Wi-Fi
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-blue-600 text-xs"></i> 24/7 Express In-Room Dining
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-blue-600 text-xs"></i> Airport / Station Shuttle
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-blue-600">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ PER NIGHT (INCL. GST)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm availability and corporate booking details.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-bed"></i> Book Executive Room
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have an inquiry about ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'motel_highway')
                <!-- ============================================== -->
                <!-- 🚗 THEME: HIGHWAY EXPRESS MOTEL ROOMS          -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-red-200 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-car text-[9px]"></i> Drive-In Motel
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-square-parking text-red-300"></i> Park in Front &bull; 24/7 Check-in</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.90 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-red-50/50 p-4 rounded-2xl border border-red-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-red-600 text-xs"></i> Drive-In Safe Parking
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-red-600 text-xs"></i> 24/7 Front Desk Check-in
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-red-600 text-xs"></i> 24-Hour Hot Geyser Shower
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-red-600 text-xs"></i> Highway Dhaba Dining
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-red-600">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ NIGHT TRANSIT RATE</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book highway room ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm front desk availability.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-red-600 hover:bg-red-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-key"></i> Quick Highway Booking
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have an inquiry about ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'hotel_boutique')
                <!-- ============================================== -->
                <!-- 🏨 THEME: URBAN BOUTIQUE & ROOFTOP SUITES       -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-purple-200 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-purple-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-martini-glass-citrus text-[9px]"></i> Boutique Designer
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-heart text-purple-300"></i> Couple Friendly &bull; City View</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.97 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-purple-50/50 p-4 rounded-2xl border border-purple-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-purple-600 text-xs"></i> Rooftop Sunset Lounge Access
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-purple-600 text-xs"></i> Couple-Friendly Verified
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-purple-600 text-xs"></i> Private City Balcony
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-purple-600 text-xs"></i> Smart TV with Netflix
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-purple-600">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ PER NIGHT</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to reserve boutique suite ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-couch"></i> Reserve Boutique Room
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have an inquiry about ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'hotel_budget')
                <!-- ============================================== -->
                <!-- 🛏️ THEME: SMART BUDGET & ECONOMY ROOMS         -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-teal-200 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-teal-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-bed text-[9px]"></i> Smart Economy
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-teal-300"></i> 100% Sanitized &bull; Free Breakfast</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.92 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-teal-50/50 p-4 rounded-2xl border border-teal-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-600 text-xs"></i> 100% Sanitized Linen
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-600 text-xs"></i> Free Morning Hot Breakfast
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-600 text-xs"></i> Fast 100 Mbps Wi-Fi
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-600 text-xs"></i> Best Price Guarantee
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-teal-600">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ PER NIGHT (TRANSPARENT TARIFF)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book budget room ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-teal-600 hover:bg-teal-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-shield-halved"></i> Book Sanitized Room
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have an inquiry about ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'hotel_family')
                <!-- ============================================== -->
                <!-- 🌴 THEME: FAMILY SUITES & GARDEN BANQUET       -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-amber-200 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-amber-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-people-roof text-[9px]"></i> Family Suite &bull; Lawn
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-users text-amber-300"></i> Interconnected &bull; 4-6 Guests</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.96 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-amber-50/50 p-4 rounded-2xl border border-amber-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Interconnected Family Rooms
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> 500+ Capacity Green Lawn
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Kids Splash Pool &amp; Play Zone
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Pure Veg &amp; Family Dining
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-amber-600">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ PER NIGHT (FAMILY STAY)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book family suite / lawn ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-people-roof"></i> Reserve Family Suite
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have an inquiry about ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'hotel_resort')
                <!-- ============================================== -->
                <!-- 🏨 THEME 1: GRAND PALACE 2-COLUMN LUXURY SUITES -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-amber-200/70 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Panoramic Suite Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-stone-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-amber-500/90 backdrop-blur-md text-stone-950 text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-crown text-[9px]"></i> Royal Heritage Suite
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-bed text-amber-400"></i> Deluxe AC King Suite</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.98 Rating</span>
                                </div>
                            </div>

                            <!-- Suite Details Body -->
                            <div class="p-6 sm:p-7">
                                <div class="flex items-start justify-between gap-2 mb-3">
                                    <h3 class="font-serif font-black text-2xl text-stone-900 leading-tight">
                                        {{ $item->title }}
                                    </h3>
                                </div>

                                <!-- Royal Amenity Checklist (2 Cols) -->
                                <div class="grid grid-cols-2 gap-2 text-xs text-stone-600 mb-6 bg-stone-50 p-4 rounded-2xl border border-stone-200/60">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Posturepedic King Bed
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Private Garden Balcony
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Marble Bath &amp; Tub
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Royal Breakfast Included
                                    </div>
                                </div>

                                <!-- Price Display -->
                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-rose-700">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-stone-500">/ night (Taxes included)</span>
                                    @if($item->compare_at_price && $item->compare_at_price > $item->price)
                                    <span class="text-xs text-stone-400 line-through">
                                        ₹{{ number_format($item->compare_at_price, 0) }}
                                    </span>
                                    <span class="text-xs font-black text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">
                                        Save {{ round((($item->compare_at_price - $item->price) / $item->compare_at_price) * 100) }}%
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm availability.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-rose-700 to-amber-700 hover:from-rose-600 hover:to-amber-600 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-bed"></i> Reserve Suite Now
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-stone-300 hover:bg-stone-50 text-stone-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'dark_luxury')
                <!-- ============================================== -->
                <!-- 🌙 THEME 3: OBSIDIAN VIP PENTHOUSE SUITES       -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-amber-500/25 bg-[#0D121F] shadow-2xl hover:border-amber-400 transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Image with Dark Gradient & Gold Badge -->
                            <div class="relative aspect-16/10 w-full overflow-hidden bg-zinc-900">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=700&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0D121F] via-transparent to-transparent"></div>
                                <span class="absolute top-3 right-3 bg-amber-500 text-slate-950 text-[10px] font-black uppercase px-2.5 py-1 rounded-full shadow">
                                    <i class="fa-solid fa-crown mr-1"></i> VIP PRIVILEGE
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="font-bold text-lg mb-2 text-white line-clamp-1">
                                    {{ $item->title }}
                                </h3>

                                <!-- VIP Perks -->
                                <div class="flex flex-wrap gap-1.5 mb-4 text-[10px] font-bold text-amber-300">
                                    <span class="px-2.5 py-1 rounded-md bg-zinc-900 border border-zinc-800"><i class="fa-solid fa-hot-tub-person mr-1 text-amber-400"></i> Jacuzzi</span>
                                    <span class="px-2.5 py-1 rounded-md bg-zinc-900 border border-zinc-800"><i class="fa-solid fa-car mr-1 text-amber-400"></i> Chauffeur</span>
                                    <span class="px-2.5 py-1 rounded-md bg-zinc-900 border border-zinc-800"><i class="fa-solid fa-martini-glass mr-1 text-amber-400"></i> Lounge</span>
                                </div>

                                <!-- Price -->
                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-2xl font-black text-amber-400">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-zinc-500">/ NIGHT VIP</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="p-6 pt-0">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book the VIP ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-black text-xs uppercase tracking-wider shadow-lg shadow-amber-500/20 transition flex items-center justify-center gap-2 cursor-pointer">
                                <i class="fa-solid fa-crown"></i> Reserve VIP Penthouse
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'minimal_card')
                <!-- ============================================== -->
                <!-- 🏛️ THEME 4: SANTORINI MEDITERRANEAN CLIFFSIDE  -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-sky-200/80 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Panoramic Sea View Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-sky-50">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-sky-600/90 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-water text-[9px]"></i> Caldera Cliffside Suite
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-water-ladder text-sky-300"></i> Private Sea Plunge Pool</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.99 Rating</span>
                                </div>
                            </div>

                            <!-- Suite Details Body -->
                            <div class="p-6 sm:p-7">
                                <h3 class="font-serif font-black text-2xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <!-- Mediterranean Checklist -->
                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-sky-50/50 p-4 rounded-2xl border border-sky-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-sky-600 text-xs"></i> Sea-Facing Plunge Pool
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-sky-600 text-xs"></i> Sunset Caldera Veranda
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-sky-600 text-xs"></i> Greek Organic Breakfast
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-sky-600 text-xs"></i> Whitewashed Cave Arch
                                    </div>
                                </div>

                                <!-- Price Display -->
                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-sky-700">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ night (Taxes included)</span>
                                    @if($item->compare_at_price && $item->compare_at_price > $item->price)
                                    <span class="text-xs text-slate-400 line-through">
                                        ₹{{ number_format($item->compare_at_price, 0) }}
                                    </span>
                                    <span class="text-xs font-black text-sky-700 bg-sky-50 px-2 py-0.5 rounded-full border border-sky-200">
                                        Save {{ round((($item->compare_at_price - $item->price) / $item->compare_at_price) * 100) }}%
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm availability.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-water"></i> Reserve Caldera Suite
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-sky-200 hover:bg-sky-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'nature_retreat')
                <!-- ============================================== -->
                <!-- 🌿 THEME 5: WILDERNESS SAFARI LODGE & TREEHOUSE -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-emerald-200/80 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Forest Canopy Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-emerald-50">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1510312305653-8ed496efae75?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-emerald-700/90 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-campground text-[9px]"></i> Luxury Safari Tent &bull; Treehouse
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-tree text-emerald-400"></i> Teak Deck &bull; Forest View</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.97 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-serif font-black text-2xl text-emerald-950 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-emerald-50/50 p-4 rounded-2xl border border-emerald-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-700 text-xs"></i> 4x4 Jeep Safari Included
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-700 text-xs"></i> Teak Treehouse Veranda
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-700 text-xs"></i> Starlit Bush Campfire BBQ
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-700 text-xs"></i> Guided Naturalist Walk
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-emerald-800">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ night (All Meals &amp; Safari)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm safari availability.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-emerald-700 to-green-600 hover:from-emerald-600 hover:to-green-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-compass"></i> Reserve Safari Tent
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-emerald-200 hover:bg-emerald-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'coastal_beach')
                <!-- ============================================== -->
                <!-- 🌊 THEME 6: MALDIVES OVERWATER BUNGALOWS       -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-cyan-200/80 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Overwater Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-cyan-50">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-cyan-600/90 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-water-ladder text-[9px]"></i> Overwater Stilt Bungalow
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-fish text-cyan-300"></i> Direct Reef Ladder</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.98 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-2xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-cyan-50/50 p-4 rounded-2xl border border-cyan-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-cyan-600 text-xs"></i> Direct Lagoon Access
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-cyan-600 text-xs"></i> Glass Floor Ocean Panel
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-cyan-600 text-xs"></i> Private Stilt Plunge Pool
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-cyan-600 text-xs"></i> Sunset Catamaran Cruise
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-cyan-700">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ night (Taxes included)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the Overwater ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-fish-fins"></i> Book Overwater Villa
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-cyan-200 hover:bg-cyan-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'heritage_haveli')
                <!-- ============================================== -->
                <!-- 👑 THEME 7: RAJASTHAN ROYAL MAHARAJA SUITES    -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-amber-200/90 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Haveli Courtyard Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-amber-50">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1599661046289-e31897846e41?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-amber-600/90 backdrop-blur-md text-stone-950 text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-chess-rook text-[9px]"></i> Royal Rajputana Suite
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-crown text-amber-300"></i> Jharokha Balcony View</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.99 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-serif font-black text-2xl text-stone-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-stone-600 mb-6 bg-amber-50/50 p-4 rounded-2xl border border-amber-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-700 text-xs"></i> Dhol &amp; Tilak Welcome
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-700 text-xs"></i> 36-Delicacy Royal Thali
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-700 text-xs"></i> Carved Jharokha Window
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-700 text-xs"></i> Antique Brass Poster Bed
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-amber-800">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-stone-500">/ night (Royal Thali included)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm availability.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-amber-600 via-rose-700 to-amber-700 hover:from-amber-500 hover:to-rose-600 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-chess-rook"></i> Reserve Royal Suite
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-amber-200 hover:bg-amber-50 text-stone-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'mountain_chalet')
                <!-- ============================================== -->
                <!-- 🏔️ THEME 8: HIMALAYAN PINE ALPINE CHALETS      -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-orange-200/80 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Alpine Snow Mountain Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-stone-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1502784444187-359ac186c5bb?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-orange-600/90 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-mountain text-[9px]"></i> Alpine Cedar Chalet
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-fire text-amber-400"></i> In-Suite Stone Fireplace</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.96 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-serif font-black text-2xl text-stone-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-stone-600 mb-6 bg-orange-50/50 p-4 rounded-2xl border border-orange-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-orange-600 text-xs"></i> Stone Fireplace Hearth
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-orange-600 text-xs"></i> Heated Hydro Jacuzzi
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-orange-600 text-xs"></i> Snow Peak Mountain Balcony
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-orange-600 text-xs"></i> Deodar Wood Paneling
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-orange-800">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-stone-500">/ night (Breakfast &amp; Hearth Wood)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book the Alpine ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-orange-600 to-amber-700 hover:from-orange-500 hover:to-amber-600 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-fire"></i> Book Alpine Chalet
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-orange-200 hover:bg-orange-50 text-stone-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'wellness_sanctuary')
                <!-- ============================================== -->
                <!-- 🧘 THEME 9: AYURVEDA, YOGA & WELLNESS COTTAGE   -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-teal-200/80 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Zen Garden Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-teal-50">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-teal-700/90 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-spa text-[9px]"></i> Ayurvedic Healing Cottage
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-heart-pulse text-teal-300"></i> Pulse Diagnosis Included</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.99 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-serif font-black text-2xl text-teal-950 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-stone-600 mb-6 bg-teal-50/50 p-4 rounded-2xl border border-teal-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-700 text-xs"></i> Doctor Nadi Diagnosis
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-700 text-xs"></i> Daily Sunrise Yoga &amp; Pranayama
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-700 text-xs"></i> Organic Sattvic Farm Meals
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-700 text-xs"></i> Private Herbal Spa Deck
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-teal-800">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-stone-500">/ night (All Treatments &amp; Meals)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm healing retreat dates.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-teal-700 to-emerald-600 hover:from-teal-600 hover:to-emerald-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-spa"></i> Book Healing Retreat
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-teal-200 hover:bg-teal-50 text-stone-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @else
                <!-- ============================================== -->
                <!-- 🏡 THEME 2: MODERN AIRBNB BOUTIQUE CARDS        -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-slate-200/90 bg-white shadow-sm hover:shadow-xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Modern Rounded Photo -->
                            <div class="relative aspect-4/3 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600&auto=format&fit=crop&q=75' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-md text-slate-900 text-[10px] font-black uppercase px-2.5 py-1 rounded-full shadow flex items-center gap-1">
                                    <i class="fa-solid fa-star text-amber-500 text-[9px]"></i> 4.96 (42)
                                </span>
                                <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/90 backdrop-blur-md text-rose-500 flex items-center justify-center shadow text-xs">
                                    <i class="fa-solid fa-heart"></i>
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <h3 class="font-bold text-lg mb-1.5 text-slate-900 line-clamp-1">
                                    {{ $item->title }}
                                </h3>

                                <div class="flex flex-wrap gap-1.5 mb-3 text-[10px] font-bold text-slate-600">
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100">King Bed</span>
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100">Pool View</span>
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100">Free Wi-Fi</span>
                                </div>

                                <div class="flex items-baseline gap-1.5">
                                    <span class="text-2xl font-black text-slate-900">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs text-slate-500 font-semibold">night &bull; Total includes taxes</span>
                                </div>
                            </div>
                        </div>

                        <!-- CTA -->
                        <div class="p-5 pt-0">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="w-full py-3 px-4 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow transition flex items-center justify-center gap-2">
                                <i class="fa-solid fa-calendar-check"></i> Reserve Room
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            @else
            <!-- 🛒 GENERAL CATALOG FOR SERVICE / B2B / RETAIL -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($items as $item)
                <div class="rounded-3xl overflow-hidden border transition-all duration-300 flex flex-col justify-between group hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800 hover:border-zinc-700' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-300 hover:shadow-xl' : 'bg-white border-slate-200/80 shadow-md hover:shadow-xl') }}">
                    
                    <div>
                        <!-- Image Container -->
                        <div class="relative aspect-16/10 w-full overflow-hidden bg-slate-100">
                            <img src="{{ $item->image_url ?: ($archetype->code === 'service' ? 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=600&auto=format&fit=crop&q=75' : 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=600&auto=format&fit=crop&q=75') }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
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
                                    ₹{{ number_format($item->price, 0) }}
                                </span>
                                @if($item->compare_at_price && $item->compare_at_price > $item->price)
                                <span class="text-xs text-slate-400 line-through">
                                    ₹{{ number_format($item->compare_at_price, 0) }}
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
                            <button wire:click="openBookingModal({{ $item->id }})" class="w-full py-3 px-4 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-regular fa-calendar-check"></i> Book Appointment Slot
                            </button>
                        @elseif($archetype->code === 'b2b')
                            <button wire:click="openQuoteModal({{ $item->id }})" class="w-full py-3 px-4 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-file-invoice-dollar"></i> Request Bulk Quote
                            </button>
                        @else
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
            @endif

        </div>
    </section>

    <!-- 📖 ABOUT OUR BUSINESS / CLINIC / STORE SECTION -->
    <section id="about" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900/40 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-white border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-6 space-y-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-purple-600">
                        @if($archetype->code === 'hospitality')
                            About Our Hotel & Hospitality
                        @elseif($archetype->code === 'service')
                            About Our Healthcare Practice
                        @elseif($archetype->code === 'b2b')
                            About Our Manufacturing Plant
                        @else
                            About Our Business
                        @endif
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                        @if($archetype->code === 'hospitality')
                            Unmatched Comfort, Luxury & Hospitality in {{ $tenant->city }}
                        @else
                            Committed To Raising The Bar In {{ $tenant->city }}
                        @endif
                    </h2>
                    
                    <p class="text-sm sm:text-base leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">
                        @if($archetype->code === 'hospitality')
                            At <strong>{{ $tenant->business_name }}</strong>, our mission is to deliver exceptional stay experiences in {{ $tenant->city }}. Whether traveling for business, vacationing with family, or seeking a quiet retreat, we provide spotless sanitized rooms, 24/7 room service, and heartfelt hospitality.
                        @else
                            At <strong>{{ $tenant->business_name }}</strong>, our mission is to provide personalized, transparent, and superior quality solutions to the community of {{ $tenant->city }}. Whether you are scheduling a specialist consultation or ordering essential goods, we guarantee integrity, prompt customer service, and reliable follow-through.
                        @endif
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
    <section id="reviews" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-[#090D16] border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-[#F5F5F3] border-neutral-300' : ($currentTheme === 'hotel_resort' ? 'bg-[#FDFBF7] border-amber-900/10' : 'bg-white border-slate-200/80')) }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest {{ $currentTheme === 'hotel_resort' ? 'text-amber-700' : ($currentTheme === 'dark_luxury' ? 'text-amber-400' : 'text-purple-600') }}">
                    {{ $archetype->code === 'hospitality' ? 'Guest Experiences & Verified Stays' : 'Patient & Customer Feedback' }}
                </span>
                <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : ($currentTheme === 'hotel_resort' ? 'font-serif text-stone-900' : 'text-slate-900') }}">
                    {{ $archetype->code === 'hospitality' ? 'Loved by Travelers & Guests in ' . $tenant->city : 'What People in ' . $tenant->city . ' Say About Us' }}
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                @if($archetype->code === 'hospitality')
                <!-- Review 1: Hospitality -->
                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-[#0D121F] border-amber-500/20' : ($currentTheme === 'hotel_resort' ? 'bg-white border-amber-200/60' : ($currentTheme === 'nature_retreat' ? 'bg-white border-emerald-200/70' : ($currentTheme === 'coastal_beach' ? 'bg-white border-cyan-200/70' : ($currentTheme === 'heritage_haveli' ? 'bg-white border-amber-200/80' : ($currentTheme === 'mountain_chalet' ? 'bg-white border-orange-200/70' : ($currentTheme === 'wellness_sanctuary' ? 'bg-white border-teal-200/70' : ($currentTheme === 'minimal_card' ? 'bg-white border-sky-200/70' : 'bg-slate-50 border-slate-200/80'))))))) }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : (in_array($currentTheme, ['hotel_resort', 'minimal_card', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'font-serif text-stone-700' : 'text-slate-700') }}">
                        "Our stay at {{ $tenant->business_name }} was incredible. The suite was spotless, bed was exceptionally comfortable, and concierge care arrived promptly. Highly recommended in {{ $tenant->city }}!"
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-rose-600 text-white font-black text-xs flex items-center justify-center">
                            A
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Ananya Deshmukh</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Guest Stay, {{ $tenant->city }}</span>
                        </div>
                    </div>
                </div>

                <!-- Review 2: Hospitality -->
                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-[#0D121F] border-amber-500/20' : ($currentTheme === 'hotel_resort' ? 'bg-white border-amber-200/60' : ($currentTheme === 'nature_retreat' ? 'bg-white border-emerald-200/70' : ($currentTheme === 'coastal_beach' ? 'bg-white border-cyan-200/70' : ($currentTheme === 'heritage_haveli' ? 'bg-white border-amber-200/80' : ($currentTheme === 'mountain_chalet' ? 'bg-white border-orange-200/70' : ($currentTheme === 'wellness_sanctuary' ? 'bg-white border-teal-200/70' : ($currentTheme === 'minimal_card' ? 'bg-white border-sky-200/70' : 'bg-slate-50 border-slate-200/80'))))))) }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : (in_array($currentTheme, ['hotel_resort', 'minimal_card', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'font-serif text-stone-700' : 'text-slate-700') }}">
                        "Effortless check-in and serene ambiance. Booking via WhatsApp was instant. The staff is polite, courteous, and went above and beyond for our holiday stay."
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-amber-600 text-white font-black text-xs flex items-center justify-center">
                            R
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Rajesh Kulkarni</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Suite Reservation</span>
                        </div>
                    </div>
                </div>

                <!-- Review 3: Hospitality -->
                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-[#0D121F] border-amber-500/20' : ($currentTheme === 'hotel_resort' ? 'bg-white border-amber-200/60' : ($currentTheme === 'nature_retreat' ? 'bg-white border-emerald-200/70' : ($currentTheme === 'coastal_beach' ? 'bg-white border-cyan-200/70' : ($currentTheme === 'heritage_haveli' ? 'bg-white border-amber-200/80' : ($currentTheme === 'mountain_chalet' ? 'bg-white border-orange-200/70' : ($currentTheme === 'wellness_sanctuary' ? 'bg-white border-teal-200/70' : ($currentTheme === 'minimal_card' ? 'bg-white border-sky-200/70' : 'bg-slate-50 border-slate-200/80'))))))) }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : (in_array($currentTheme, ['hotel_resort', 'minimal_card', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'font-serif text-stone-700' : 'text-slate-700') }}">
                        "Top-tier luxury experience! Pristine views, seamless Wi-Fi, and freshly prepared gourmet meals daily. We will definitely return again."
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-sky-600 text-white font-black text-xs flex items-center justify-center">
                            S
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Sneha Patil</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Guest Stay</span>
                        </div>
                    </div>
                </div>

                @else
                <!-- General Reviews for other archetypes -->
                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-slate-50 border-slate-200/80' }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : 'text-slate-700' }}">
                        "Booking online on their website was effortless. They listened patiently and explained everything thoroughly. Highly professional!"
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
                @endif

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
                        <span class="text-xs font-bold uppercase tracking-widest text-purple-600">
                            @if($archetype->code === 'hospitality')
                                Reservations & Front Desk
                            @else
                                Get In Touch
                            @endif
                        </span>
                        <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                            @if($archetype->code === 'hospitality')
                                Plan Your Stay or Inquire Room Dates
                            @else
                                Visit Our Location or Message Us
                            @endif
                        </h3>
                        <p class="text-xs sm:text-sm mt-2 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">
                            @if($archetype->code === 'hospitality')
                                Looking for room availability, group stay packages, or special requests? Reach out directly via WhatsApp or phone.
                            @else
                                Have an inquiry or need assistance? Reach out directly via phone or WhatsApp for quick assistance.
                            @endif
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
