<!-- ======================================================== -->
<!-- 🚀 COACHING LANDING 5: PAY AFTER PLACEMENT CODING BOOTCAMP -->
<!-- ======================================================== -->
<section id="hero" class="relative overflow-hidden py-12 lg:py-20 bg-[#070614] text-white border-b border-purple-950 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left 7 Cols: Bootcamp Value Proposition & Salary Metric -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-950 border border-purple-700/60 text-purple-300 text-xs font-bold font-mono">
                    <i class="fa-solid fa-code text-emerald-400"></i>
                    <span>6-Month Full-Stack Developer &amp; AI Agents Bootcamp</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.08]">
                    Pay After Placement &bull; <span class="bg-gradient-to-r from-purple-400 via-pink-300 to-emerald-400 bg-clip-text text-transparent">Min ₹8 LPA Job Guarantee</span> or ₹0 Tuition Fee in {{ $tenant->city ?: 'your area' }}
                </h1>

                <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Don't waste time on theoretical courses. Build 10+ production-grade web applications, master LLM prompt pipelines, write production TypeScript, and get placed with 300+ hiring partners from {{ $tenant->business_name }}.
                </p>

                <!-- Salary Hike Matrix Box -->
                <div class="p-6 rounded-3xl bg-purple-950/40 border border-purple-800/60 shadow-xl space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-purple-300 uppercase tracking-wider font-mono">Career Placement Benchmark</span>
                        <span class="text-[10px] bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 px-2 py-0.5 rounded-full font-bold">96.4% Placement Rate</span>
                    </div>

                    <div class="grid grid-cols-3 gap-3 font-mono text-center">
                        <div class="p-3 rounded-2xl bg-slate-900 border border-purple-900">
                            <span class="text-xl font-black text-emerald-400 block">14.8 LPA</span>
                            <span class="text-[10px] text-slate-400 font-sans">Avg Starting CTC</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-slate-900 border border-purple-900">
                            <span class="text-xl font-black text-purple-400 block">42 LPA</span>
                            <span class="text-[10px] text-slate-400 font-sans">Highest Package</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-slate-900 border border-purple-900">
                            <span class="text-xl font-black text-sky-400 block">300+</span>
                            <span class="text-[10px] text-slate-400 font-sans">Hiring Partners</span>
                        </div>
                    </div>

                    <!-- Tech Stack Pills -->
                    <div class="flex flex-wrap gap-2 text-xs font-mono">
                        <span class="px-2.5 py-1 rounded bg-slate-900 text-slate-300 border border-purple-900"><i class="fa-brands fa-react text-sky-400 mr-1"></i> React 19</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 text-slate-300 border border-purple-900"><i class="fa-brands fa-node text-emerald-400 mr-1"></i> Node.js</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 text-slate-300 border border-purple-900"><i class="fa-solid fa-robot text-purple-400 mr-1"></i> AI Agents</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 text-slate-300 border border-purple-900"><i class="fa-brands fa-docker text-blue-400 mr-1"></i> Docker &amp; Cloud</span>
                    </div>
                </div>

            </div>

            <!-- Right 5 Cols: Bootcamp Application Form -->
            <div class="lg:col-span-5">
                <div class="rounded-3xl border-2 border-purple-500/60 bg-[#0F0C24] shadow-2xl p-6 sm:p-8 space-y-5">
                    <div>
                        <span class="text-[11px] font-black uppercase tracking-wider text-emerald-400 block font-mono">APPLICATIONS OPEN FOR NEXT COHORT</span>
                        <h3 class="text-xl font-black text-white mt-1">Apply for Developer Cohort</h3>
                        <p class="text-xs text-slate-400 mt-1">No prior coding degree required. Open for graduates and working pros.</p>
                    </div>

                    <form wire:submit.prevent="submitLead" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Your Full Name *</label>
                            <input wire:model="leadName" type="text" placeholder="e.g. Tanmay Bhatia" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-purple-900 text-white text-xs outline-none focus:border-purple-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">WhatsApp Mobile Number *</label>
                            <input wire:model="leadPhone" type="tel" placeholder="e.g. 9876543210" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-purple-900 text-white text-xs outline-none focus:border-purple-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Current Background *</label>
                            <select class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-purple-900 text-white text-xs outline-none focus:border-purple-400">
                                <option>Final Year College Student (B.Tech / BCA / BSc)</option>
                                <option>Working Professional Seeking Career Transition</option>
                                <option>Non-Tech Graduate Wanting Tech Career</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 hover:opacity-95 text-white font-black text-sm shadow-xl shadow-purple-600/30 transition cursor-pointer flex items-center justify-center gap-2">
                            <i class="fa-solid fa-code"></i> Apply for Bootcamp &amp; ISA
                        </button>
                    </form>

                    <div class="pt-1 text-center text-[11px] text-slate-400">
                        <span>Includes 1-on-1 Portfolio Reviews by FAANG Senior Staff.</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
