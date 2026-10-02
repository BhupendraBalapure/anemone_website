<!-- ======================================================== -->
<!-- 🛂 COACHING LANDING 6: STUDY ABROAD VISA & UNIVERSITY FASTTRACK -->
<!-- ======================================================== -->
<section id="hero" class="relative overflow-hidden py-12 lg:py-20 bg-[#051124] text-white border-b border-sky-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left 7 Cols: Study Abroad Value Prop -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-950 border border-sky-700/60 text-sky-300 text-xs font-bold font-mono">
                    <i class="fa-solid fa-passport text-sky-400"></i>
                    <span>Fall 2026 Intake &bull; Top Global Universities Shortlisting</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.08]">
                    Study in UK, Canada, USA, Germany &amp; Australia with <span class="bg-gradient-to-r from-sky-400 via-cyan-300 to-emerald-300 bg-clip-text text-transparent">100% Visa Approval Track Record</span> in {{ $tenant->city ?: 'your area' }}
                </h1>

                <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Turn your international degree dream into reality. Zero processing charge for university shortlisting, comprehensive SOP writing assistance, Band 8+ IELTS prep, and mock visa interview panels with former embassy counselors at {{ $tenant->business_name }}.
                </p>

                <!-- Country Flag Pills Strip -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 max-w-xl mx-auto lg:mx-0 text-left text-xs pt-1">
                    <div class="p-3.5 rounded-2xl bg-slate-900/90 border border-sky-900/60 flex items-center gap-3">
                        <span class="text-2xl">🇬🇧</span>
                        <div>
                            <strong class="text-white block font-bold">United Kingdom</strong>
                            <span class="text-slate-400 text-[10px]">2-Yr Post Study Visa</span>
                        </div>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-slate-900/90 border border-sky-900/60 flex items-center gap-3">
                        <span class="text-2xl">🇨🇦</span>
                        <div>
                            <strong class="text-white block font-bold">Canada</strong>
                            <span class="text-slate-400 text-[10px]">3-Yr PGWP &bull; SDS</span>
                        </div>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-slate-900/90 border border-sky-900/60 flex items-center gap-3">
                        <span class="text-2xl">🇩🇪</span>
                        <div>
                            <strong class="text-white block font-bold">Germany</strong>
                            <span class="text-slate-400 text-[10px]">₹0 Tuition Public Unis</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right 5 Cols: Visa Assessment Form -->
            <div class="lg:col-span-5">
                <div class="rounded-3xl border-2 border-sky-500/60 bg-[#091833] shadow-2xl p-6 sm:p-8 space-y-5">
                    <div>
                        <span class="text-[11px] font-black uppercase tracking-wider text-sky-400 block font-mono">60-SECOND PROFILE EVALUATION</span>
                        <h3 class="text-xl font-black text-white mt-1">Free Visa Eligibility Check</h3>
                        <p class="text-xs text-slate-400 mt-1">Get your personalized university shortlist and scholarship estimate.</p>
                    </div>

                    <form wire:submit.prevent="submitLead" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Student Full Name *</label>
                            <input wire:model="leadName" type="text" placeholder="e.g. Siddharth Verma" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-sky-900 text-white text-xs outline-none focus:border-sky-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">WhatsApp Mobile Number *</label>
                            <input wire:model="leadPhone" type="tel" placeholder="e.g. 9876543210" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-sky-900 text-white text-xs outline-none focus:border-sky-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Preferred Destination Country *</label>
                            <select class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-sky-900 text-white text-xs outline-none focus:border-sky-400">
                                <option>United Kingdom (Russell Group)</option>
                                <option>Canada (Top Public Universities)</option>
                                <option>Germany (Tuition-Free TU9 / English Taught)</option>
                                <option>United States (STEM OPT 3-Yr Extension)</option>
                                <option>Australia (Group of Eight)</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-3.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-black text-sm shadow-xl shadow-sky-600/30 transition cursor-pointer flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> Get Free University Shortlist
                        </button>
                    </form>

                    <div class="pt-1 text-center text-[11px] text-slate-400">
                        <span>Zero Consultation Charges &bull; Authorized British Council &amp; IDP Partner.</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
