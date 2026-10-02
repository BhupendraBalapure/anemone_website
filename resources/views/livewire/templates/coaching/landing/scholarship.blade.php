<!-- ======================================================== -->
<!-- 🏆 COACHING LANDING 1: NATIONAL SCHOLARSHIP ADMISSION TEST -->
<!-- ======================================================== -->
<section id="hero" class="relative overflow-hidden py-12 lg:py-20 bg-[#060D1E] text-white border-b border-blue-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Top Urgency Ribbon -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-900/60 border border-blue-500/40 text-blue-300 text-xs font-black tracking-widest uppercase mb-6 shadow-lg shadow-blue-500/10">
            <i class="fa-solid fa-trophy text-amber-400"></i>
            <span>UP TO 100% SCHOLARSHIP &bull; NATIONAL SCHOLARSHIP ADMISSION TEST</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left 7 Cols: Headline & Scholarship Slab Matrix -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.08]">
                    NATIONAL SCHOLARSHIP ADMISSION TEST IN <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-amber-300 bg-clip-text text-transparent">{{ strtoupper($tenant->city ?: 'YOUR CITY') }}</span>
                </h1>

                <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Secure up to 100% fee waiver for JEE, NEET, and Foundation batches at {{ $tenant->business_name }}. Test your aptitude against thousands of peers, receive personalized diagnostic strengths radar, and get mentorship from star IITian faculties.
                </p>

                <!-- Interactive Scholarship Fee Waiver Calculator Box -->
                <div class="p-6 rounded-3xl bg-blue-950/60 border border-blue-800/80 shadow-xl space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-blue-300 uppercase tracking-wider font-mono">Scholarship Waiver Calculator</span>
                        <span class="text-[10px] bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 px-2 py-0.5 rounded-full font-bold">Registration Fee ₹0 Today</span>
                    </div>

                    <!-- Discount Slabs -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 font-mono text-center">
                        <div class="p-3 rounded-2xl bg-blue-900/40 border border-blue-700/60">
                            <span class="text-xl font-black text-amber-400 block">100%</span>
                            <span class="text-[10px] text-slate-300 font-sans">Score 95%+</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-blue-900/40 border border-blue-700/60">
                            <span class="text-xl font-black text-emerald-400 block">75%</span>
                            <span class="text-[10px] text-slate-300 font-sans">Score 85-94%</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-blue-900/40 border border-blue-700/60">
                            <span class="text-xl font-black text-sky-400 block">50%</span>
                            <span class="text-[10px] text-slate-300 font-sans">Score 75-84%</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-blue-900/40 border border-blue-700/60">
                            <span class="text-xl font-black text-purple-400 block">35%</span>
                            <span class="text-[10px] text-slate-300 font-sans">Score 65-74%</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-xs text-slate-400 pt-1">
                        <span><i class="fa-solid fa-circle-check text-emerald-400"></i> Free Diagnostic Aptitude Report</span>
                        <span><i class="fa-solid fa-qrcode text-blue-400"></i> Instant WhatsApp Admit Card</span>
                    </div>
                </div>

            </div>

            <!-- Right 5 Cols: Quick Registration Form -->
            <div class="lg:col-span-5">
                <div class="rounded-3xl border-2 border-blue-500/60 bg-[#0B152B] shadow-2xl p-6 sm:p-8 space-y-5">
                    <div>
                        <span class="text-[11px] font-black uppercase tracking-wider text-amber-400 block">Limited 50 Slots Per Center</span>
                        <h3 class="text-xl font-black text-white mt-1">Register for Scholarship Test</h3>
                        <p class="text-xs text-slate-400 mt-1">Get your exam slot and online hall ticket sent directly on WhatsApp.</p>
                    </div>

                    <form wire:submit.prevent="submitLead" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Student Full Name *</label>
                            <input wire:model="leadName" type="text" placeholder="e.g. Aryan Sharma" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-blue-800 text-white text-xs outline-none focus:border-blue-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">WhatsApp Mobile Number *</label>
                            <input wire:model="leadPhone" type="tel" placeholder="e.g. 9876543210" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-blue-800 text-white text-xs outline-none focus:border-blue-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Applying For *</label>
                            <select class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-blue-800 text-white text-xs outline-none focus:border-blue-400">
                                <option>JEE (Main &amp; Advanced) 2-Year Program</option>
                                <option>NEET (Medical Entrance) 2-Year Program</option>
                                <option>Foundation (Class 8th, 9th, 10th)</option>
                                <option>1-Year Dropper / Repeater Batch</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-500 hover:opacity-95 text-white font-black text-sm shadow-xl shadow-blue-600/30 transition cursor-pointer flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> Claim Scholarship Test Pass
                        </button>
                    </form>

                    <div class="pt-2 text-center text-[11px] text-slate-400 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-lock text-emerald-400"></i>
                        <span>Zero Spam &bull; 100% Safe &bull; Instant Admit Card</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
