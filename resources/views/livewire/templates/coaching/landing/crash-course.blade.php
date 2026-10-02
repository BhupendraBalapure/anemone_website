<!-- ======================================================== -->
<!-- ⚡ COACHING LANDING 2: 90-DAY INTENSIVE CRASH COURSE      -->
<!-- ======================================================== -->
<section id="hero" class="relative overflow-hidden py-12 lg:py-20 bg-[#12070A] text-white border-b border-rose-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Live Countdown Urgency Banner -->
        <div class="bg-rose-950/80 border border-rose-700/80 rounded-2xl px-5 py-3 flex flex-wrap items-center justify-between gap-4 text-xs shadow-xl mb-8">
            <div class="flex items-center gap-2.5">
                <span class="w-3 h-3 rounded-full bg-rose-500 animate-ping"></span>
                <span class="font-black text-rose-300 uppercase tracking-widest text-[11px]">Final Exam Countdown</span>
                <span class="text-rose-500 hidden sm:inline">&bull;</span>
                <span class="text-slate-300 font-semibold hidden sm:inline">90-Day High-Yield Topic Revision Bootcamp</span>
            </div>
            <div class="flex items-center gap-3 font-mono font-bold text-rose-200">
                <span class="bg-rose-900/60 px-2.5 py-1 rounded">42 Days Left</span>
                <span class="bg-rose-900/60 px-2.5 py-1 rounded text-amber-300">Only 12 Seats Available</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left 7 Cols: Crash Course Roadmap -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-rose-950 border border-rose-700/60 text-rose-300 text-xs font-bold">
                    <i class="fa-solid fa-bolt text-rose-400"></i>
                    <span>90-Day Rank-Booster Intensive Crash Program</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.08]">
                    Score 650+ in NEET &amp; 99%ile in JEE with <span class="bg-gradient-to-r from-rose-400 via-amber-300 to-orange-400 bg-clip-text text-transparent">90-Day Intensive Crash</span> in {{ $tenant->city ?: 'your area' }}
                </h1>

                <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Designed for students who want to turn preparation into top ranks. Daily 6-hour intensive rank-booster sessions, 3,000+ highest-yield questions solved live, and daily 1-on-1 doubt clearing counters in {{ $tenant->city ?: 'Nagpur' }}.
                </p>

                <!-- 90-Day 3-Phase Roadmap -->
                <div class="space-y-3 max-w-xl mx-auto lg:mx-0 text-left text-xs">
                    <div class="p-3.5 rounded-2xl bg-slate-900/90 border border-rose-900/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-xl bg-rose-600 text-white font-mono font-bold flex items-center justify-center text-xs">01</span>
                            <div>
                                <strong class="text-white block font-bold">Days 1 - 40: High-Yield Core Revision</strong>
                                <span class="text-slate-400 text-[11px]">80% weightage topics revision with formula shortcut sheets</span>
                            </div>
                        </div>
                        <span class="text-rose-400 font-mono font-bold text-[11px]">Phase 1</span>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-slate-900/90 border border-rose-900/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-xl bg-amber-600 text-white font-mono font-bold flex items-center justify-center text-xs">02</span>
                            <div>
                                <strong class="text-white block font-bold">Days 41 - 70: Topic-Wise PYQs &amp; Speed Drills</strong>
                                <span class="text-slate-400 text-[11px]">Negative marking elimination &amp; 45-sec speed tricks</span>
                            </div>
                        </div>
                        <span class="text-amber-400 font-mono font-bold text-[11px]">Phase 2</span>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-slate-900/90 border border-rose-900/60 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-xl bg-emerald-600 text-white font-mono font-bold flex items-center justify-center text-xs">03</span>
                            <div>
                                <strong class="text-white block font-bold">Days 71 - 90: 20 Full All-India Mock Tests</strong>
                                <span class="text-slate-400 text-[11px]">Exact NTA CBT exam pattern simulation with video analysis</span>
                            </div>
                        </div>
                        <span class="text-emerald-400 font-mono font-bold text-[11px]">Phase 3</span>
                    </div>
                </div>

            </div>

            <!-- Right 5 Cols: Emergency Registration Form -->
            <div class="lg:col-span-5">
                <div class="rounded-3xl border-2 border-rose-600/60 bg-[#1A0A0F] shadow-2xl p-6 sm:p-8 space-y-5">
                    <div>
                        <span class="text-[11px] font-black uppercase tracking-wider text-rose-400 block font-mono">CRASH BATCH ADMISSION PASS</span>
                        <h3 class="text-xl font-black text-white mt-1">Reserve Your Crash Batch Seat</h3>
                        <p class="text-xs text-slate-400 mt-1">Limited to 35 students per batch for personalized attention.</p>
                    </div>

                    <form wire:submit.prevent="submitLead" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Student Full Name *</label>
                            <input wire:model="leadName" type="text" placeholder="e.g. Priyanshu Roy" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-rose-900 text-white text-xs outline-none focus:border-rose-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">WhatsApp Mobile Number *</label>
                            <input wire:model="leadPhone" type="tel" placeholder="e.g. 9876543210" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-rose-900 text-white text-xs outline-none focus:border-rose-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Target Exam *</label>
                            <select class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-rose-900 text-white text-xs outline-none focus:border-rose-400">
                                <option>NEET 2026 90-Day Crash Course</option>
                                <option>JEE Main Session 2 FastTrack</option>
                                <option>Board Exam 45-Day 95%+ Sprint</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-3.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-black text-sm shadow-xl shadow-rose-600/30 transition cursor-pointer flex items-center justify-center gap-2">
                            <i class="fa-solid fa-fire"></i> Claim Crash Course Seat
                        </button>
                    </form>

                    <div class="pt-2 text-center text-[11px] text-slate-400 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-bolt text-amber-400"></i>
                        <span>Includes Printed Formula Book &bull; Zero Upfront Fee</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
