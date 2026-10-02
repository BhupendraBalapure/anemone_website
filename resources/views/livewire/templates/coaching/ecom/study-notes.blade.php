<!-- ======================================================== -->
<!-- 📖 COACHING E-COM 2: TOPPERS HANDWRITTEN SPIRAL NOTES MART -->
<!-- ======================================================== -->
<section id="hero" class="relative overflow-hidden py-12 lg:py-18 bg-[#FFFDF7] text-stone-900 border-b border-amber-200">
    <!-- Warm Paper Ambient Accents -->
    <div class="absolute -top-20 right-0 w-96 h-96 bg-amber-200/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 -left-20 w-80 h-80 bg-emerald-200/25 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Left 6 Cols: Notes Storefront Info + Pricing + Topper Proof -->
            <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                
                <!-- Ranker Ribbon -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-100 border border-emerald-300 text-emerald-900 text-xs font-black shadow-sm">
                    <i class="fa-solid fa-medal text-emerald-700"></i>
                    <span>Kota Classroom Script &bull; Authored by AIR 1, 14 &amp; 38 Toppers</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-stone-950 tracking-tight leading-[1.12]">
                    High-Yield Handwritten Revision Notes &amp; <span class="text-emerald-700 underline decoration-amber-400 decoration-wavy">Formula Cheat Sheets</span> in {{ $tenant->city ?: 'your city' }}
                </h1>

                <p class="text-sm sm:text-base text-stone-700 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Direct Xerox of handwritten classroom notes prepared by top rankers. Spiral-bound hardcopies with color concept mindmaps, formula cheat sheets, and Kota shortcut margin notes delivered to your doorstep.
                </p>

                <!-- High-Converting Pricing & Offer Banner -->
                <div class="p-4 rounded-2xl bg-white border-2 border-amber-300 shadow-xl flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <div class="flex items-baseline gap-2.5">
                            <span class="text-3xl sm:text-4xl font-black text-emerald-800 font-mono">₹799</span>
                            <span class="text-base text-stone-400 line-through font-mono">₹1,599</span>
                            <span class="px-2 py-0.5 rounded bg-emerald-600 text-white font-black text-xs uppercase tracking-wider">50% OFF TODAY</span>
                        </div>
                        <span class="text-[11px] text-stone-600 font-bold block mt-0.5">
                            <i class="fa-solid fa-truck-fast text-emerald-600"></i> Free Express Home Delivery in 48 Hours
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5 text-xs text-stone-700 font-bold bg-amber-50 px-3 py-1.5 rounded-xl border border-amber-200">
                        <span class="text-amber-500 text-sm">★★★★★</span>
                        <span class="font-black text-stone-900">4.9/5</span>
                        <span class="text-stone-500 text-[11px]">(14k+ Readers)</span>
                    </div>
                </div>

                <!-- Spec Pills -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-1">
                    <div class="p-3.5 rounded-2xl bg-white border border-amber-200 shadow-sm text-left">
                        <i class="fa-solid fa-feather text-emerald-700 mb-1.5 text-base"></i>
                        <span class="text-xs font-black text-stone-900 block">AIR 1-50 Rankers</span>
                        <span class="text-[10px] text-stone-500 font-semibold">Exact Classroom Script</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-white border border-amber-200 shadow-sm text-left">
                        <i class="fa-solid fa-layer-group text-amber-700 mb-1.5 text-base"></i>
                        <span class="text-xs font-black text-stone-900 block">100 GSM Opaque</span>
                        <span class="text-[10px] text-stone-500 font-semibold">Zero Highlighter Bleed</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-white border border-amber-200 shadow-sm text-left col-span-2 sm:col-span-1">
                        <i class="fa-solid fa-boxes-packing text-blue-700 mb-1.5 text-base"></i>
                        <span class="text-xs font-black text-stone-900 block">Laminated Cover</span>
                        <span class="text-[10px] text-stone-500 font-semibold">Waterproof Spiral Bind</span>
                    </div>
                </div>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center gap-3 pt-2 justify-center lg:justify-start">
                    <a href="#services" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-black text-sm shadow-xl shadow-emerald-800/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-cart-shopping"></i> Order Spiral Hardcopy — ₹799
                    </a>
                    <a href="{{ $tenant->getWhatsAppUrl('Hi, I want to download a Free 20-Page Sample Chapter PDF of your Handwritten Notes.') }}" target="_blank" class="w-full sm:w-auto px-6 py-4 rounded-xl bg-white border-2 border-stone-800 hover:bg-stone-50 text-stone-900 font-black text-sm transition flex items-center justify-center gap-2 shadow-sm">
                        <i class="fa-solid fa-file-pdf text-rose-600 text-base"></i> Download Free 20-Page Sample
                    </a>
                </div>
            </div>

            <!-- Right 6 Cols: Open Spiral Notebook Mockup (Realistic Two-Page Spread) -->
            <div class="lg:col-span-6">
                <div class="relative bg-white rounded-3xl border-2 border-amber-300 shadow-2xl p-6 sm:p-8">
                    <!-- Spiral Wire Center Graphic -->
                    <div class="absolute inset-y-4 left-1/2 -translate-x-1/2 w-8 flex flex-col justify-between items-center z-20 pointer-events-none opacity-50">
                        @for($i = 0; $i < 12; $i++)
                            <div class="w-7 h-2 rounded-full border-2 border-stone-800 bg-stone-300 shadow-sm"></div>
                        @endfor
                    </div>

                    <!-- Open Spread Content -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 relative z-10 text-xs">
                        
                        <!-- Left Page: Physics Electrostatics Cheat Sheet -->
                        <div class="bg-amber-50/80 p-4 rounded-2xl border border-amber-200 space-y-3 font-serif">
                            <div class="flex items-center justify-between border-b border-amber-200 pb-2">
                                <span class="font-black text-emerald-800 text-[11px] font-sans uppercase tracking-wider">Physics &bull; Chapter 01</span>
                                <span class="text-stone-400 font-mono text-[10px]">p. 42</span>
                            </div>
                            <h4 class="font-bold text-stone-900 text-sm font-sans">Coulomb's Law &amp; Flux Radar</h4>
                            <div class="p-2.5 rounded bg-amber-100 font-mono text-[11px] text-amber-950 border border-amber-300 font-bold">
                                F = (1 / 4πε₀) &times; (|q₁q₂| / r²)
                            </div>
                            <p class="text-[11px] text-stone-700 leading-tight">
                                <span class="bg-yellow-300 px-1 font-sans font-black">Kota Shortcut:</span> For symmetrical charges on a regular polygon, net field at centroid = <strong>0</strong>.
                            </p>
                            <div class="pt-2 text-[10px] text-emerald-800 font-sans font-black flex items-center gap-1">
                                <i class="fa-solid fa-circle-check text-emerald-600"></i> AIR 4 Verified Trick
                            </div>
                        </div>

                        <!-- Right Page: Organic Chemistry Mechanisms -->
                        <div class="bg-amber-50/80 p-4 rounded-2xl border border-amber-200 space-y-3 font-serif">
                            <div class="flex items-center justify-between border-b border-amber-200 pb-2">
                                <span class="font-black text-emerald-800 text-[11px] font-sans uppercase tracking-wider">Chemistry &bull; Reaction Flow</span>
                                <span class="text-stone-400 font-mono text-[10px]">p. 43</span>
                            </div>
                            <h4 class="font-bold text-stone-900 text-sm font-sans">SN1 vs SN2 Decision Tree</h4>
                            <div class="space-y-1.5 font-sans text-[11px]">
                                <div class="flex justify-between bg-white px-2.5 py-1 rounded border border-amber-200">
                                    <span class="text-stone-600 font-semibold">3° Alkyl Halide:</span>
                                    <strong class="text-emerald-700 font-bold">Always SN1</strong>
                                </div>
                                <div class="flex justify-between bg-white px-2.5 py-1 rounded border border-amber-200">
                                    <span class="text-stone-600 font-semibold">Polar Aprotic:</span>
                                    <strong class="text-purple-700 font-bold">Accelerates SN2</strong>
                                </div>
                            </div>
                            <p class="text-[11px] text-stone-700 leading-tight">
                                <span class="bg-emerald-200 px-1 font-sans font-black">Warning:</span> Watch for hydride shift rearrangement!
                            </p>
                            <div class="pt-2 text-[10px] text-amber-800 font-sans font-black flex items-center gap-1">
                                <i class="fa-solid fa-star text-amber-600"></i> High-Yield JEE/NEET
                            </div>
                        </div>

                    </div>

                    <!-- Bottom Delivery & Guarantee Footer -->
                    <div class="mt-4 pt-3 border-t border-amber-200 flex flex-wrap items-center justify-between text-xs text-stone-600">
                        <span class="flex items-center gap-1.5 font-semibold"><i class="fa-solid fa-shield text-emerald-600"></i> Spiral Bound &bull; Waterproof Laminated Cover</span>
                        <span class="font-black text-stone-900">Dispatch in 24 Hours via Bluedart Air</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
