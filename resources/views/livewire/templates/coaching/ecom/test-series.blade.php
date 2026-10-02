@php
    $custom = $tenant->settings['template_customizations'] ?? [];
    $customHero = $custom['hero'] ?? [];
    $customPricing = $custom['pricing'] ?? [];
    $heroBg = $customHero['background_image_url'] ?? ($customHero['image_url'] ?? '');
    $bgDarkness = (int) ($customHero['bg_darkness'] ?? 60);
@endphp

<!-- ======================================================== -->
<!-- 📝 COACHING E-COM 1: NTA & UPSC CBT ONLINE EXAMINATION PORTAL -->
<!-- ======================================================== -->
<section id="hero" class="relative overflow-hidden py-12 lg:py-18 bg-[#070D1B] text-white border-b border-blue-900/60">
    @if(!empty($heroBg))
        <!-- Custom Hero Background Image (Clearly Visible) -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-all duration-500 pointer-events-none" style="background-image: url('{{ $heroBg }}');"></div>
        <!-- High-Contrast Dark Tint to ensure text & CBT simulator remain razor-sharp -->
        <div class="absolute inset-0 pointer-events-none transition-all duration-300" style="background-color: rgba(7, 13, 27, {{ $bgDarkness / 100 }});"></div>
    @endif

    <!-- Ambient Glow Spotlights -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 right-0 w-96 h-96 bg-cyan-500/15 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Live Urgent Exam Window Strip -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8 relative z-10">
        <div class="bg-gradient-to-r from-blue-950 via-slate-900 to-indigo-950 border border-blue-700/60 rounded-2xl px-5 py-3 flex flex-wrap items-center justify-between gap-3 text-xs shadow-xl">
            <div class="flex items-center gap-2.5 flex-wrap">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 font-black text-[11px] border border-emerald-500/40">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span> LIVE NTA WINDOW
                </span>
                <span class="text-white font-bold text-xs sm:text-sm">{{ $customHero['ticker_text'] ?? 'NEET 2026: 42 Days Left • JEE Main All-India Mock 04 Live' }}</span>
            </div>
            <div class="flex items-center gap-4 text-slate-300 font-mono text-xs">
                <span class="text-cyan-300 font-bold"><i class="fa-solid fa-users text-cyan-400"></i> 18,420 Active Test Takers</span>
                <span class="hidden sm:inline bg-blue-800/80 text-blue-200 px-2.5 py-0.5 rounded-md font-bold text-[11px]">NTA Engine v4.2</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Left 6 Cols: Test Portal Info + High-Energy Pricing & Toppers -->
            <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                
                <!-- Portal Pill Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-900/40 border border-blue-700/60 text-blue-300 text-xs font-bold">
                    <i class="fa-solid fa-clipboard-check text-blue-400"></i>
                    <span>{{ $customHero['badge'] ?? 'All-India Mock Test Series & CBT Examination Portal' }}</span>
                </div>

                <!-- Ranker Ribbon -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/15 border border-amber-400/40 text-amber-300 text-xs font-black shadow-lg">
                    <i class="fa-solid fa-trophy text-amber-400"></i>
                    <span>{{ $customHero['sub_badge'] ?? 'AIR 1 NEET & AIR 16 JEE Adv Toppers Trained Here' }}</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.1]">
                    {{ $customHero['headline'] ?? 'Real NTA/UPSC CBT Test Series' }} <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-indigo-300 bg-clip-text text-transparent">{{ $customHero['highlight_text'] ?? 'Rank Predictor' }}</span> in {{ $tenant->city ?: 'your city' }}
                </h1>

                <p class="text-sm sm:text-base text-slate-300 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    {{ $customHero['subheadline'] ?? 'Experience the exact NTA computer screen interface with real-time countdown timers, question palettes (+4/-1 negative marking radar), and instant All-India Percentile benchmarking with step-by-step video solutions. Real NTA CBT Interface calibrated to NEET, JEE, and UPSC standard.' }}
                </p>

                <!-- High-Converting Pricing & Discount Banner (PW / Allen Style) -->
                <div class="p-4 rounded-2xl bg-gradient-to-r from-blue-900/60 to-indigo-900/60 border border-blue-600/50 backdrop-blur-md shadow-2xl flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <div class="flex items-baseline gap-2.5">
                            <span class="text-3xl sm:text-4xl font-black text-emerald-400 font-mono">₹{{ $customPricing['sale_price'] ?? '499' }}</span>
                            <span class="text-base text-slate-400 line-through font-mono">₹{{ $customPricing['regular_price'] ?? '1,999' }}</span>
                            <span class="px-2 py-0.5 rounded bg-rose-600 text-white font-black text-xs uppercase tracking-wider">{{ $customPricing['discount_tag'] ?? '75% OFF' }}</span>
                        </div>
                        <span class="text-[11px] text-cyan-200 font-bold block mt-0.5">
                            <i class="fa-solid fa-bolt text-amber-400"></i> {{ $customPricing['offer_subtext'] ?? 'Unlimited Access to 150+ Full & Chapter Tests' }}
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5 text-xs text-slate-300 font-semibold">
                        <span class="flex text-amber-400 text-sm">★★★★★</span>
                        <span class="font-bold text-white">4.9/5</span>
                        <span class="text-slate-400 text-[11px]">(38k+ Reviews)</span>
                    </div>
                </div>

                <!-- Metric Chips -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 pt-1">
                    <div class="p-3 rounded-xl bg-slate-900/80 border border-blue-800/60 text-left">
                        <span class="text-xl font-black text-cyan-400 block font-mono">{{ $customHero['stat1_value'] ?? '150+' }}</span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">{{ $customHero['stat1_label'] ?? 'Chapter Tests' }}</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900/80 border border-blue-800/60 text-left">
                        <span class="text-xl font-black text-emerald-400 block font-mono">{{ $customHero['stat2_value'] ?? '35 Full' }}</span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">{{ $customHero['stat2_label'] ?? 'AIR Mock Tests' }}</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900/80 border border-blue-800/60 text-left">
                        <span class="text-xl font-black text-amber-400 block font-mono">{{ $customHero['stat3_value'] ?? '100%' }}</span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">{{ $customHero['stat3_label'] ?? 'Video Solutions' }}</span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-900/80 border border-blue-800/60 text-left">
                        <span class="text-xl font-black text-indigo-400 block font-mono">{{ $customHero['stat4_value'] ?? 'AIR Radar' }}</span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">{{ $customHero['stat4_label'] ?? 'Instant Rank' }}</span>
                    </div>
                </div>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center gap-3 pt-2 justify-center lg:justify-start">
                    <a href="{{ $customHero['cta_primary_link'] ?? '#services' }}" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-black text-sm shadow-xl shadow-blue-600/40 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-cart-shopping"></i> {{ $customHero['cta_primary_text'] ?? 'Enroll in Test Series — ₹499' }}
                    </a>
                    <a href="{{ $customHero['cta_secondary_link'] ?? $tenant->getWhatsAppUrl('Hi, I want to attempt a Free All-India Diagnostic CBT Mock Test.') }}" target="_blank" class="w-full sm:w-auto px-6 py-4 rounded-xl bg-slate-900 border border-blue-700/80 hover:bg-slate-800 text-slate-100 font-bold text-sm transition flex items-center justify-center gap-2">
                        <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> {{ $customHero['cta_secondary_text'] ?? 'Free Diagnostic Test' }}
                    </a>
                </div>
            </div>

            <!-- Right 6 Cols: Interactive CBT Exam Simulator Console (Live Default) -->
            <div class="lg:col-span-6">
                <div class="rounded-3xl border border-blue-600/60 bg-gradient-to-b from-[#0B1428] to-[#060D1E] shadow-2xl overflow-hidden p-6 space-y-5 relative">
                    <!-- Top Ribbon Badge -->
                    <div class="absolute top-0 right-10 bg-gradient-to-r from-emerald-500 to-teal-500 text-slate-950 font-black text-[10px] px-3 py-0.5 rounded-b-lg uppercase tracking-wider">
                        Official Exam Simulator
                    </div>

                    <!-- CBT Header Bar -->
                    <div class="flex items-center justify-between pb-4 border-b border-blue-900/60">
                        <div class="flex items-center gap-2.5">
                            <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                            <span class="font-mono text-xs text-blue-300 font-black ml-2">NTA-JEE-CBT-SIMULATOR_v4</span>
                        </div>
                        <div class="flex items-center gap-2 font-mono text-xs bg-rose-950/80 border border-rose-700/60 text-rose-300 px-3 py-1 rounded-full font-bold">
                            <i class="fa-regular fa-clock animate-spin"></i>
                            <span>Time Left: 02:59:45</span>
                        </div>
                    </div>

                    <!-- Question Status Bar -->
                    <div class="bg-blue-950/70 rounded-xl p-3 border border-blue-800/80 flex items-center justify-between text-xs">
                        <span class="font-bold text-white">Section: Physics &bull; Q.14 of 75</span>
                        <span class="text-emerald-400 font-mono font-bold bg-emerald-950/70 px-2 py-0.5 rounded border border-emerald-700/60">+4 Correct / -1 Negative</span>
                    </div>

                    <!-- Question Preview Box -->
                    <div class="bg-slate-900/90 rounded-2xl p-4 border border-blue-900 text-xs sm:text-sm text-slate-200 space-y-3">
                        <p class="font-semibold text-slate-100">
                            A parallel plate capacitor of capacitance 10 μF is connected to a battery of 20 V. If dielectric constant K = 4 is inserted between plates:
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs font-mono">
                            <div class="p-2.5 rounded-lg bg-blue-950/80 border border-blue-800 text-slate-300 flex items-center gap-2.5 cursor-pointer hover:border-cyan-400 transition">
                                <span class="w-5 h-5 rounded bg-blue-800 text-white flex items-center justify-center text-[10px] font-bold">A</span>
                                <span>Charge increases 4x</span>
                            </div>
                            <div class="p-2.5 rounded-lg bg-emerald-950/80 border-2 border-emerald-500 text-emerald-300 flex items-center gap-2.5 shadow-lg shadow-emerald-950">
                                <span class="w-5 h-5 rounded bg-emerald-600 text-white flex items-center justify-center text-[10px] font-bold">B</span>
                                <span>Capacitance = 40 μF [Marked]</span>
                            </div>
                        </div>
                    </div>

                    <!-- Question Palette Grid -->
                    <div>
                        <div class="flex items-center justify-between text-[11px] text-slate-400 font-bold mb-2">
                            <span>Question Palette:</span>
                            <span class="text-cyan-400">14 Answered &bull; 2 Review &bull; 4 Pending</span>
                        </div>
                        <div class="grid grid-cols-8 sm:grid-cols-10 gap-1.5 font-mono text-[11px] font-bold">
                            @for($q = 1; $q <= 20; $q++)
                                @php
                                    $qClass = match(true) {
                                        $q === 14 => 'bg-emerald-500 text-slate-950 font-black ring-2 ring-emerald-300 animate-pulse',
                                        in_array($q, [1, 2, 3, 5, 6, 8, 9, 10, 11, 12, 13, 15, 16]) => 'bg-emerald-800/80 text-emerald-200 border border-emerald-600/60',
                                        in_array($q, [4, 7]) => 'bg-purple-800/80 text-purple-200 border border-purple-500/60',
                                        in_array($q, [17, 18]) => 'bg-rose-900/80 text-rose-200 border border-rose-600/60',
                                        default => 'bg-slate-800 text-slate-400 border border-slate-700',
                                    };
                                @endphp
                                <div class="h-7 rounded flex items-center justify-center {{ $qClass }}">
                                    {{ $q }}
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Real-Time AI Rank Card -->
                    <div class="p-3.5 rounded-xl bg-gradient-to-r from-blue-950 to-indigo-950 border border-blue-700/60 flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-gauge-high text-cyan-400 text-xl"></i>
                            <div>
                                <span class="font-bold text-white block">Predicted All-India Percentile</span>
                                <span class="text-[10px] text-slate-400">Benchmarked across 18,420 aspirants today</span>
                            </div>
                        </div>
                        <span class="text-lg font-black text-cyan-300 font-mono">99.42 %ile</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
