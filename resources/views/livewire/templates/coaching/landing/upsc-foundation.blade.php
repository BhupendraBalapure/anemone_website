<!-- ======================================================== -->
<!-- 🏛️ COACHING LANDING 4: 1-YEAR UPSC IAS GS FOUNDATION BATCH -->
<!-- ======================================================== -->
<section id="hero" class="relative overflow-hidden py-12 lg:py-20 bg-[#070D1B] text-white border-b border-indigo-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left 7 Cols: UPSC Program & 4-Stage Roadmap -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-950 border border-indigo-700/60 text-indigo-300 text-xs font-bold font-serif">
                    <i class="fa-solid fa-landmark text-amber-400"></i>
                    <span>UPSC Civil Services 1-Year Integrated GS Foundation Program</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.08] font-serif">
                    Complete Prelims-Cum-Mains Mentorship with <span class="bg-gradient-to-r from-amber-300 via-indigo-300 to-sky-300 bg-clip-text text-transparent font-sans">Answer Writing &amp; Current Affairs</span> in {{ $tenant->city ?: 'your area' }}
                </h1>

                <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Transform your IAS ambition into reality. Integrated classroom batch covering General Studies Papers 1-4, CSAT, Essay, daily answer evaluation with model answers, and mentorship from former civil servants at {{ $tenant->business_name }}.
                </p>

                <!-- 4-Stage Master Roadmap Timeline -->
                <div class="space-y-3 max-w-xl mx-auto lg:mx-0 text-left text-xs">
                    <div class="p-3 rounded-xl bg-slate-900/90 border border-indigo-900/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white font-mono font-bold flex items-center justify-center text-xs">I</span>
                            <div>
                                <strong class="text-white block font-bold">Stage 1: NCERTs &amp; Core Foundation (Months 1-3)</strong>
                                <span class="text-slate-400 text-[11px]">History, Polity, Geography &amp; Basic Economics</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-900/90 border border-indigo-900/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white font-mono font-bold flex items-center justify-center text-xs">II</span>
                            <div>
                                <strong class="text-white block font-bold">Stage 2: Advanced GS &amp; CSAT Aptitude (Months 4-7)</strong>
                                <span class="text-slate-400 text-[11px]">Standard reference books + weekly thematic tests</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-900/90 border border-indigo-900/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-lg bg-amber-600 text-white font-mono font-bold flex items-center justify-center text-xs">III</span>
                            <div>
                                <strong class="text-white block font-bold">Stage 3: Daily Mains Answer Writing (Months 8-10)</strong>
                                <span class="text-slate-400 text-[11px]">Strict 24-hr evaluation by selected officers</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-900/90 border border-indigo-900/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-lg bg-emerald-600 text-white font-mono font-bold flex items-center justify-center text-xs">IV</span>
                            <div>
                                <strong class="text-white block font-bold">Stage 4: DAF &amp; Mock Interview Panel (Months 11-12)</strong>
                                <span class="text-slate-400 text-[11px]">Chaired by retired IAS, IPS &amp; IFS officers</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right 5 Cols: Foundation Batch Registration Form -->
            <div class="lg:col-span-5">
                <div class="rounded-3xl border-2 border-indigo-500/60 bg-[#0C152B] shadow-2xl p-6 sm:p-8 space-y-5">
                    <div>
                        <span class="text-[11px] font-black uppercase tracking-wider text-amber-400 block font-mono">NEW BATCH COMMENCING SOON</span>
                        <h3 class="text-xl font-black text-white mt-1">UPSC Foundation Batch Inquiries</h3>
                        <p class="text-xs text-slate-400 mt-1">Schedule 1-on-1 counseling session with our senior mentor.</p>
                    </div>

                    <form wire:submit.prevent="submitLead" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Aspirant Full Name *</label>
                            <input wire:model="leadName" type="text" placeholder="e.g. Vikramaditya Rao" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-indigo-800 text-white text-xs outline-none focus:border-indigo-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">WhatsApp Mobile Number *</label>
                            <input wire:model="leadPhone" type="tel" placeholder="e.g. 9876543210" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-indigo-800 text-white text-xs outline-none focus:border-indigo-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Target UPSC Attempt *</label>
                            <select class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-indigo-800 text-white text-xs outline-none focus:border-indigo-400">
                                <option>UPSC CSE 2026 (1-Year Foundation)</option>
                                <option>UPSC CSE 2027 (2-Year College Integrated)</option>
                                <option>State PSC (MPSC / BPSC / UPPSC)</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-sm shadow-xl shadow-indigo-600/30 transition cursor-pointer flex items-center justify-center gap-2">
                            <i class="fa-solid fa-compass"></i> Book UPSC Mentor Consultation
                        </button>
                    </form>

                    <div class="pt-1 text-center text-[11px] text-slate-400">
                        <span>Includes Free UPSC Syllabus Booklet &amp; Past 5 Years Micro-Topic Analysis.</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
