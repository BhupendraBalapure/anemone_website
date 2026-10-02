<!-- ======================================================== -->
<!-- 🗣️ COACHING E-COM 5: FOREIGN LANGUAGE BOX KITS & AUDIO DRIVE -->
<!-- ======================================================== -->
<section id="hero" class="relative overflow-hidden py-12 lg:py-18 bg-[#F8FAFC] text-slate-900 border-b border-cyan-200">
    <!-- Ambient Cyan & Indigo Glows -->
    <div class="absolute -top-32 right-0 w-96 h-96 bg-cyan-200/40 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 -left-20 w-80 h-80 bg-indigo-200/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Left 6 Cols: Language Kit Storefront Info + Bold Pricing -->
            <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                
                <!-- Immersion Ribbon -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-100 border border-cyan-300 text-cyan-900 text-xs font-black shadow-sm">
                    <span class="text-base">🇩🇪 🇫🇷 🇬🇧</span>
                    <span>CEFR International Foreign Language Immersion Standard</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-950 tracking-tight leading-[1.1]">
                    German, French &amp; Spoken English <span class="text-cyan-700 underline decoration-cyan-400 decoration-wavy">Flashcard Box Kits</span> in {{ $tenant->city ?: 'your area' }}
                </h1>

                <p class="text-sm sm:text-base text-slate-600 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Comprehensive self-paced language immersion bundles. 500 waterproof audio flashcards, interactive grammar workbooks, and conversation audio drive delivered to your doorstep. Aligned with CEFR standards (A1 to C2).
                </p>

                <!-- High-Converting Pricing & Offer Banner -->
                <div class="p-4 rounded-2xl bg-white border-2 border-cyan-300 shadow-xl flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <div class="flex items-baseline gap-2.5">
                            <span class="text-3xl sm:text-4xl font-black text-cyan-800 font-mono">₹1,299</span>
                            <span class="text-base text-slate-400 line-through font-mono">₹2,499</span>
                            <span class="px-2 py-0.5 rounded bg-emerald-600 text-white font-black text-xs uppercase tracking-wider">48% OFF</span>
                        </div>
                        <span class="text-[11px] text-slate-600 font-bold block mt-0.5">
                            <i class="fa-solid fa-usb text-cyan-600"></i> Includes 32GB Audio Pen-Drive &bull; Free Pan-India Courier
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5 text-xs text-slate-700 font-bold bg-cyan-50 px-3 py-1.5 rounded-xl border border-cyan-200">
                        <span class="text-amber-500 text-sm">★★★★★</span>
                        <span class="font-black text-slate-900">4.9/5</span>
                        <span class="text-slate-500 text-[11px]">(9k+ Learners)</span>
                    </div>
                </div>

                <!-- Spec Grid -->
                <div class="grid grid-cols-3 gap-3 pt-1 text-left">
                    <div class="p-3.5 rounded-2xl bg-white border border-cyan-200 shadow-sm">
                        <span class="text-xl font-black text-cyan-700 block font-mono">500 Cards</span>
                        <span class="text-[10px] text-slate-500 font-bold uppercase">Waterproof Lexicon</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-white border border-cyan-200 shadow-sm">
                        <span class="text-xl font-black text-emerald-700 block font-mono">CEFR A1-C2</span>
                        <span class="text-[10px] text-slate-500 font-bold uppercase">German &bull; French</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-white border border-cyan-200 shadow-sm">
                        <span class="text-xl font-black text-blue-700 block font-mono">32GB USB</span>
                        <span class="text-[10px] text-slate-500 font-bold uppercase">Native Pronounce</span>
                    </div>
                </div>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center gap-3 pt-2 justify-center lg:justify-start">
                    <a href="#services" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-gradient-to-r from-cyan-600 via-teal-600 to-emerald-600 hover:opacity-95 text-white font-black text-sm shadow-xl shadow-cyan-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-cart-shopping"></i> Order Language Box Kit — ₹1,299
                    </a>
                    <a href="{{ $tenant->getWhatsAppUrl('Hi, I want to take the 5-Minute Free CEFR Language Placement Test.') }}" target="_blank" class="w-full sm:w-auto px-6 py-4 rounded-xl bg-white border-2 border-slate-900 hover:bg-slate-50 text-slate-900 font-black text-sm transition flex items-center justify-center gap-2 shadow-sm">
                        <i class="fa-solid fa-headphones text-cyan-600 text-base"></i> Listen Audio Sample
                    </a>
                </div>
            </div>

            <!-- Right 6 Cols: Physical Language Box Kit Unboxing Visualizer -->
            <div class="lg:col-span-6">
                <div class="rounded-3xl border-2 border-cyan-300 bg-white shadow-2xl p-6 sm:p-8 space-y-5">
                    
                    <!-- Box Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-cyan-100">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl">🇩🇪 🇫🇷 🇬🇧</span>
                            <span class="font-black text-xs text-cyan-900 uppercase tracking-wider font-mono">CEFR IMMERSION BOX KIT</span>
                        </div>
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 border border-emerald-300 px-3 py-1 rounded-full font-black">100% Native Audio</span>
                    </div>

                    <!-- Flashcard Fan-Out Preview -->
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="p-4 rounded-2xl bg-cyan-50/80 border border-cyan-200 shadow-sm space-y-2">
                            <div class="flex justify-between items-center text-[10px] text-cyan-800 font-mono font-bold">
                                <span>CARD #142</span>
                                <span class="bg-cyan-200 px-2 py-0.5 rounded font-black">GERMAN</span>
                            </div>
                            <h4 class="font-black text-slate-900 text-lg">das Fernweh</h4>
                            <p class="text-[11px] text-slate-600 italic">"An intense longing for far-off places / travel."</p>
                            <div class="pt-1.5 text-[10px] text-cyan-800 font-mono font-bold flex items-center gap-1.5 bg-white p-1.5 rounded-lg border border-cyan-200">
                                <i class="fa-solid fa-volume-high text-cyan-600 text-xs"></i> [FEHRN-vay]
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-cyan-50/80 border border-cyan-200 shadow-sm space-y-2">
                            <div class="flex justify-between items-center text-[10px] text-cyan-800 font-mono font-bold">
                                <span>CARD #089</span>
                                <span class="bg-cyan-200 px-2 py-0.5 rounded font-black">FRENCH</span>
                            </div>
                            <h4 class="font-black text-slate-900 text-lg">l'esprit d'escalier</h4>
                            <p class="text-[11px] text-slate-600 italic">"Thinking of the perfect comeback too late."</p>
                            <div class="pt-1.5 text-[10px] text-cyan-800 font-mono font-bold flex items-center gap-1.5 bg-white p-1.5 rounded-lg border border-cyan-200">
                                <i class="fa-solid fa-volume-high text-cyan-600 text-xs"></i> [lehs-pree]
                            </div>
                        </div>
                    </div>

                    <!-- Included Components Strip -->
                    <div class="p-4 rounded-2xl bg-slate-900 text-white flex items-center justify-between text-xs shadow-md">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center font-bold text-lg">
                                <i class="fa-solid fa-usb"></i>
                            </div>
                            <div>
                                <span class="font-black block text-slate-100 text-sm">32GB Native Audio Drive</span>
                                <span class="text-[10px] text-slate-400">Over 1,200 Real Dialogue MP3 Recordings</span>
                            </div>
                        </div>
                        <span class="bg-cyan-600 text-white px-3 py-1 rounded-lg font-black text-[10px] uppercase tracking-wider">Plug &amp; Play</span>
                    </div>

                    <!-- CEFR Level Ladder -->
                    <div class="flex items-center justify-between text-center text-xs font-mono font-bold pt-1">
                        <div class="p-2.5 rounded-xl bg-slate-100 flex-1 mx-1 border border-slate-200">
                            <span class="block text-slate-800 font-black">A1-A2</span>
                            <span class="text-[9px] text-slate-500 font-semibold">Beginner</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-cyan-100 flex-1 mx-1 border border-cyan-300">
                            <span class="block text-cyan-900 font-black">B1-B2</span>
                            <span class="text-[9px] text-cyan-700 font-semibold">Fluent</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-100 flex-1 mx-1 border border-emerald-300">
                            <span class="block text-emerald-900 font-black">C1-C2</span>
                            <span class="text-[9px] text-emerald-700 font-semibold">Mastery</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
