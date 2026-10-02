<!-- ======================================================== -->
<!-- 🎥 COACHING E-COM 3: 4K VIDEO COURSES & PEN-DRIVE MASTERCLASS -->
<!-- ======================================================== -->
<section id="hero" class="relative overflow-hidden py-12 lg:py-18 bg-[#090D1C] text-white border-b border-violet-950">
    <!-- Ambient Studio Spotlight Glows -->
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-violet-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 left-0 w-96 h-96 bg-indigo-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Left 6 Cols: MasterClass Video Storefront + Bold Pricing -->
            <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                
                <!-- Faculty Credential Ribbon -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-violet-900/60 border border-violet-500/50 text-violet-200 text-xs font-black shadow-lg">
                    <i class="fa-solid fa-graduation-cap text-violet-400"></i>
                    <span>Taught by Er. Verma (Ex-IIT Delhi &bull; 15+ Yrs Kota Star Faculty)</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.1]">
                    Complete Syllabus 4K <span class="bg-gradient-to-r from-violet-400 via-purple-300 to-indigo-300 bg-clip-text text-transparent">Recorded Video Lectures</span> &amp; Offline Pen-Drive Kits in {{ $tenant->city ?: 'your area' }}
                </h1>

                <p class="text-sm sm:text-base text-slate-300 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Studio-recorded 4K lectures by legendary Kota educators. Delivered directly via encrypted 64GB high-speed USB 3.2 pen-drive or instant cloud stream with 24-month validity and 24/7 faculty doubt resolution desk.
                </p>

                <!-- High-Converting Pricing & Offer Banner -->
                <div class="p-4 rounded-2xl bg-gradient-to-r from-violet-950/80 to-indigo-950/80 border border-violet-600/50 backdrop-blur-md shadow-2xl flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <div class="flex items-baseline gap-2.5">
                            <span class="text-3xl sm:text-4xl font-black text-emerald-400 font-mono">₹2,499</span>
                            <span class="text-base text-slate-400 line-through font-mono">₹6,999</span>
                            <span class="px-2 py-0.5 rounded bg-rose-600 text-white font-black text-xs uppercase tracking-wider">64% OFF TODAY</span>
                        </div>
                        <span class="text-[11px] text-violet-200 font-bold block mt-0.5">
                            <i class="fa-solid fa-hard-drive text-violet-400"></i> Includes Free 64GB Sandisk Pen-Drive &bull; 24-Mo Validity
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5 text-xs text-slate-300 font-semibold bg-violet-900/40 px-3 py-1.5 rounded-xl border border-violet-700/50">
                        <span class="text-amber-400 text-sm">★★★★★</span>
                        <span class="font-bold text-white">4.9/5</span>
                        <span class="text-slate-400 text-[11px]">(22k+ Enrolled)</span>
                    </div>
                </div>

                <!-- Spec Grid -->
                <div class="grid grid-cols-3 gap-3 pt-1 text-left">
                    <div class="p-3 rounded-2xl bg-slate-900/80 border border-violet-800/60">
                        <span class="text-xl font-black text-violet-400 block font-mono">4K UHD</span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Studio Clarity</span>
                    </div>
                    <div class="p-3 rounded-2xl bg-slate-900/80 border border-violet-800/60">
                        <span class="text-xl font-black text-emerald-400 block font-mono">64GB USB</span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Encrypted Pen-Drive</span>
                    </div>
                    <div class="p-3 rounded-2xl bg-slate-900/80 border border-violet-800/60">
                        <span class="text-xl font-black text-cyan-400 block font-mono">24 Months</span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Unlimited Views</span>
                    </div>
                </div>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center gap-3 pt-2 justify-center lg:justify-start">
                    <a href="#services" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600 hover:opacity-95 text-white font-black text-sm shadow-xl shadow-violet-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-cart-shopping"></i> Order 4K Pen-Drive Kit — ₹2,499
                    </a>
                    <a href="{{ $tenant->getWhatsAppUrl('Hi, I want to watch a Free 4K Demo Video Lecture.') }}" target="_blank" class="w-full sm:w-auto px-6 py-4 rounded-xl bg-slate-900 border border-violet-700/80 hover:bg-slate-800 text-slate-100 font-bold text-sm transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-play text-violet-400 text-base"></i> Watch Free 4K Demo Class
                    </a>
                </div>
            </div>

            <!-- Right 6 Cols: Video Player & Chapter Curriculum Console -->
            <div class="lg:col-span-6">
                <div class="rounded-3xl border border-violet-700/70 bg-[#0E152B] shadow-2xl overflow-hidden p-6 space-y-4">
                    
                    <!-- Player Screen Mockup -->
                    <div class="relative aspect-16/9 rounded-2xl overflow-hidden bg-slate-950 border border-violet-800 group">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&auto=format&fit=crop&q=80" alt="Video Player" class="w-full h-full object-cover opacity-60">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                        
                        <!-- Center Play Button with Pulse -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 rounded-full bg-violet-600 text-white flex items-center justify-center text-2xl shadow-2xl ring-4 ring-violet-500/40 group-hover:scale-110 transition duration-300 animate-pulse">
                                <i class="fa-solid fa-play ml-1"></i>
                            </div>
                        </div>

                        <!-- Top Player Badges -->
                        <div class="absolute top-3 left-3 right-3 flex justify-between items-center text-[10px] font-bold">
                            <span class="bg-violet-950/90 border border-violet-600/70 px-2.5 py-1 rounded text-violet-300 font-mono">LECTURE 04: ROTATIONAL MOTION</span>
                            <span class="bg-black/80 px-2.5 py-1 rounded text-emerald-400 font-mono">4K UHD &bull; 60 FPS</span>
                        </div>

                        <!-- Bottom Progress Bar -->
                        <div class="absolute bottom-3 left-3 right-3 space-y-1">
                            <div class="h-1.5 bg-slate-800 rounded-full overflow-hidden">
                                <div class="w-2/3 h-full bg-gradient-to-r from-violet-500 to-indigo-400 rounded-full"></div>
                            </div>
                            <div class="flex justify-between text-[10px] text-slate-300 font-mono">
                                <span>34:12 / 52:00</span>
                                <span class="text-violet-300">1.5x Speed &bull; Kota Master Teacher</span>
                            </div>
                        </div>
                    </div>

                    <!-- Curriculum Chapters List -->
                    <div class="space-y-2 text-xs">
                        <div class="flex items-center justify-between text-slate-400 text-[11px] font-bold">
                            <span>Syllabus Breakdown (350+ Hours Total):</span>
                            <span class="text-emerald-400 font-mono">Offline Pen-Drive Included</span>
                        </div>

                        <div class="p-2.5 rounded-xl bg-violet-950/60 border border-violet-800/80 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-circle-play text-violet-400 text-base"></i>
                                <span class="font-bold text-white">Ch. 1: Rotational Dynamics &amp; Torque</span>
                            </div>
                            <span class="text-[10px] bg-violet-900/80 text-violet-200 px-2 py-0.5 rounded font-mono font-bold">14 Videos &bull; 18h</span>
                        </div>

                        <div class="p-2.5 rounded-xl bg-slate-900/60 border border-slate-800 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-lock text-slate-500 text-sm"></i>
                                <span class="font-medium text-slate-300">Ch. 2: Thermodynamics &amp; Heat Engines</span>
                            </div>
                            <span class="text-[10px] text-slate-500 font-mono">12 Videos &bull; 15h</span>
                        </div>

                        <div class="p-2.5 rounded-xl bg-slate-900/60 border border-slate-800 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-lock text-slate-500 text-sm"></i>
                                <span class="font-medium text-slate-300">Ch. 3: Wave Optics &amp; Interference</span>
                            </div>
                            <span class="text-[10px] text-slate-500 font-mono">9 Videos &bull; 11h</span>
                        </div>
                    </div>

                    <!-- Hardware Pen-Drive Strip -->
                    <div class="p-3 rounded-xl bg-gradient-to-r from-violet-950 to-indigo-950 border border-violet-700/60 flex items-center justify-between text-xs">
                        <span class="flex items-center gap-2 font-bold text-slate-100">
                            <i class="fa-solid fa-hard-drive text-violet-400 text-base"></i> 64GB Encrypted High-Speed USB 3.2 Key
                        </span>
                        <span class="text-[10px] text-emerald-400 font-black uppercase tracking-wider bg-emerald-950/80 px-2 py-0.5 rounded border border-emerald-700/50">Free Express Courier</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
