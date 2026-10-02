<!-- ======================================================== -->
<!-- 🆓 COACHING LANDING 3: 3-DAY CLASSROOM TRIAL PASS        -->
<!-- ======================================================== -->
<section id="hero" class="relative overflow-hidden py-12 lg:py-20 bg-[#061512] text-white border-b border-emerald-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left 7 Cols: Trial Offer Details -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-950 border border-emerald-700/60 text-emerald-300 text-xs font-bold">
                    <i class="fa-solid fa-ticket text-emerald-400"></i>
                    <span>3-Day Classroom Trial &amp; Star Faculty Demo Pass</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.08]">
                    Attend 3-Day Classroom Lectures with Star Faculty at <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-300 bg-clip-text text-transparent">Flat ₹0 Cost</span> in {{ $tenant->city ?: 'your area' }}
                </h1>

                <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Don't just believe testimonials—experience our classroom teaching pedagogy live. Attend 3 full lectures with our senior-most faculty, receive comprehensive study materials, and take a diagnostic test with zero commitment at {{ $tenant->business_name }}.
                </p>

                <!-- Trial Pass Highlights -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 max-w-xl mx-auto lg:mx-0 text-left text-xs pt-1">
                    <div class="p-3.5 rounded-2xl bg-slate-900/90 border border-emerald-900/60">
                        <i class="fa-solid fa-chalkboard-user text-emerald-400 text-base mb-1.5 block"></i>
                        <strong class="text-white block font-bold">Star Faculty Lectures</strong>
                        <span class="text-slate-400 text-[11px]">15+ years Kota teaching experience</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-slate-900/90 border border-emerald-900/60">
                        <i class="fa-solid fa-book text-emerald-400 text-base mb-1.5 block"></i>
                        <strong class="text-white block font-bold">Free Printed Kit</strong>
                        <span class="text-slate-400 text-[11px]">Formula sheets &amp; practice DPPs</span>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-slate-900/90 border border-emerald-900/60">
                        <i class="fa-solid fa-badge-check text-emerald-400 text-base mb-1.5 block"></i>
                        <strong class="text-white block font-bold">Zero Obligations</strong>
                        <span class="text-slate-400 text-[11px]">No forced admission or fees</span>
                    </div>
                </div>

            </div>

            <!-- Right 5 Cols: Graphical VIP Admit Card Pass & Quick Registration -->
            <div class="lg:col-span-5">
                <div class="rounded-3xl border-2 border-emerald-500/60 bg-[#0A1F1A] shadow-2xl p-6 sm:p-8 space-y-5">
                    
                    <!-- Graphical Pass Card -->
                    <div class="p-4 rounded-2xl bg-emerald-950/80 border border-emerald-500/40 relative overflow-hidden">
                        <div class="flex justify-between items-center text-xs pb-3 border-b border-emerald-800/80">
                            <span class="font-bold text-white uppercase tracking-wider font-mono">OFFICIAL VIP TRIAL PASS</span>
                            <span class="bg-emerald-500 text-slate-950 font-black px-2 py-0.5 rounded text-[10px]">100% FREE</span>
                        </div>
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-emerald-300 font-bold uppercase">Pass Valid For:</span>
                                <h4 class="font-black text-white text-base">3 Full Classroom Days</h4>
                                <span class="text-xs text-slate-300">{{ $tenant->business_name }} &bull; {{ $tenant->city }}</span>
                            </div>
                            <i class="fa-solid fa-qrcode text-emerald-400 text-4xl"></i>
                        </div>
                    </div>

                    <form wire:submit.prevent="submitLead" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Student Full Name *</label>
                            <input wire:model="leadName" type="text" placeholder="e.g. Riya Deshmukh" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-emerald-900 text-white text-xs outline-none focus:border-emerald-400" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">WhatsApp Mobile Number *</label>
                            <input wire:model="leadPhone" type="tel" placeholder="e.g. 9876543210" class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-emerald-900 text-white text-xs outline-none focus:border-emerald-400" required>
                        </div>

                        <button type="submit" class="w-full py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-sm shadow-xl shadow-emerald-600/30 transition cursor-pointer flex items-center justify-center gap-2">
                            <i class="fa-solid fa-ticket"></i> Generate My 3-Day Free Pass
                        </button>
                    </form>

                    <div class="pt-1 text-center text-[11px] text-slate-400">
                        <span>Instant QR Pass sent directly to your WhatsApp inbox.</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
