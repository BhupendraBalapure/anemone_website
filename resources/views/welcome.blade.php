<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anemony - India's Smartest MSME Website & Digital Operating System</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Compiled Vite CSS & JS (Fixes wire:navigate styling) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])



    <!-- FontAwesome 6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- AOS (Animate on Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* Exact Logo Swirl Gradient from User Screenshot */
        .gradient-logo-swirl {
            background: linear-gradient(135deg, #fb923c 0%, #f43f5e 35%, #9333ea 70%, #3b82f6 100%);
        }
        .gradient-headline {
            background: linear-gradient(135deg, #1e1b4b 0%, #831843 35%, #6d28d9 70%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gradient-text-accent {
            background: linear-gradient(135deg, #f97316 0%, #ec4899 50%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-brand-gradient {
            background: linear-gradient(135deg, #f43f5e 0%, #9333ea 50%, #4f46e5 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-brand-gradient:hover {
            background: linear-gradient(135deg, #e11d48 0%, #7e22ce 50%, #4338ca 100%);
            box-shadow: 0 12px 25px -4px rgba(147, 51, 234, 0.35);
        }

        /* Ambient Glow based on Logo Colors */
        .bg-mesh-cosmic {
            background-color: #ffffff;
            background-image: 
                radial-gradient(at 10% 10%, rgba(251, 146, 60, 0.08) 0px, transparent 40%),
                radial-gradient(at 85% 15%, rgba(236, 72, 153, 0.09) 0px, transparent 45%),
                radial-gradient(at 50% 80%, rgba(147, 51, 234, 0.08) 0px, transparent 50%),
                radial-gradient(at 90% 90%, rgba(59, 130, 246, 0.06) 0px, transparent 45%);
        }
        
        /* Floating animations */
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes floatFast {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }

        .animate-float-slow { animation: floatSlow 5s ease-in-out infinite; }
        .animate-float-fast { animation: floatFast 3.5s ease-in-out infinite; }

        /* Card Hover Lift */
        .hover-lift {
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -8px rgba(147, 51, 234, 0.12), 0 8px 12px -6px rgba(244, 63, 94, 0.06);
            border-color: rgba(147, 51, 234, 0.25);
        }
    </style>
    @livewireStyles
</head>
<body class="bg-white text-slate-800 font-sans antialiased selection:bg-purple-600 selection:text-white">

    <!-- 🌐 Top Bar -->
    <div class="bg-slate-950 text-slate-300 text-xs py-2.5 px-4 border-b border-slate-900">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="bg-gradient-to-r from-amber-500 to-rose-500 text-white font-black text-[10px] px-2.5 py-0.5 rounded-full uppercase tracking-wider">New</span>
                <span class="text-slate-300 font-medium">India's Smartest No-Code Operating System for MSMEs • Web + WhatsApp + Google Maps</span>
            </div>
            <div class="flex items-center gap-4 text-slate-400">
                <span class="flex items-center gap-1.5 text-slate-300">
                    <i class="fa-solid fa-headset text-rose-400"></i> Support: +91 95792 14456
                </span>
                <span class="text-slate-700">|</span>
                <a href="{{ route('onboarding') }}" wire:navigate class="text-rose-400 font-semibold hover:text-amber-400 flex items-center gap-1 transition">
                    Launch Store Free <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- 🧭 Glassmorphism Navbar -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Brand Logo with Screenshot Gradient Swirl -->
            <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-2xl gradient-logo-swirl flex items-center justify-center text-white shadow-lg shadow-purple-500/25 group-hover:scale-105 transition-transform duration-300">
                    <!-- Swirl Ribbon SVG Matching User's Screenshot -->
                    <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C8 2 4 6 4 11C4 16 8 20 13 20C17.5 20 20 16.5 20 12.5C20 8.5 16.5 5 12 5C9 5 7 7.5 7 10.5C7 13.5 9.5 15.5 12.5 15.5C15 15.5 16.5 14 16.5 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="flex items-baseline">
                    <span class="text-2xl font-black tracking-tight text-slate-900">
                        Anemony<span class="text-rose-500">.</span>
                    </span>
                </div>
            </a>

            <!-- Navigation Links -->
            <div class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="#solutions" class="hover:text-purple-600 transition">Industry Solutions</a>
                <a href="#features" class="hover:text-purple-600 transition">Features</a>
                <a href="#demos" class="hover:text-purple-600 transition flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span> Live Demos
                </a>
                <a href="#why-anemony" class="hover:text-purple-600 transition">Why Anemony?</a>
                <a href="#testimonials" class="hover:text-purple-600 transition">Reviews</a>
                <a href="#faq" class="hover:text-purple-600 transition">FAQs</a>
            </div>

            <!-- Header Action Button -->
            <div class="flex items-center gap-3">
                <a href="{{ route('onboarding') }}" wire:navigate class="btn-brand-gradient text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-md flex items-center gap-2">
                    <i class="fa-solid fa-bolt text-amber-300"></i> Create Free Store
                </a>
            </div>

        </div>
    </nav>

    <!-- ⚡ HERO SECTION (Cosmic Rose-Purple-Amber Glow) -->
    <section class="relative pt-12 pb-20 md:pt-20 md:pb-28 bg-mesh-cosmic overflow-hidden">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Hero Content -->
                <div class="lg:col-span-7 text-center lg:text-left" data-aos="fade-right" data-aos-duration="800">
                    
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-50 border border-purple-200/60 text-xs font-bold text-purple-800 mb-6">
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                        </span>
                        <span>Official Google 360° Partner • 7,000+ MSME Transformations</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15] mb-6">
                        Chhote Business Ko Banayein <br class="hidden sm:inline" />
                        <span class="gradient-text-accent">Digital Superpower</span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed mb-8">
                        The first <strong>no-code category-aware platform</strong> that automatically adapts to your business. Instant dynamic website, WhatsApp commerce, Google Maps 360° SEO, and digital billing in a single dashboard.
                    </p>

                    <!-- Interactive Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 mb-10">
                        <a href="{{ route('onboarding') }}" wire:navigate class="w-full sm:w-auto px-8 py-4 rounded-xl btn-brand-gradient text-white font-extrabold text-base shadow-xl hover-lift transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-rocket"></i> Launch Store In 60 Seconds
                        </a>
                        <a href="#demos" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-white hover:bg-slate-50 text-slate-800 font-bold text-base border border-slate-300 shadow-sm hover-lift transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-store text-purple-600"></i> Explore Live Demos
                        </a>
                    </div>

                    <!-- Trust Stats Bar -->
                    <div class="grid grid-cols-3 gap-6 pt-6 border-t border-slate-200 max-w-lg mx-auto lg:mx-0">
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-slate-900">7,000+</div>
                            <div class="text-xs font-semibold text-slate-500 mt-0.5">Google 360 Listings</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-rose-600">2,000+</div>
                            <div class="text-xs font-semibold text-slate-500 mt-0.5">Active Businesses</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-purple-600">60s</div>
                            <div class="text-xs font-semibold text-slate-500 mt-0.5">Instant Setup</div>
                        </div>
                    </div>

                </div>

                <!-- Right Hero Interactive Card Mockup -->
                <div class="lg:col-span-5 relative" data-aos="fade-left" data-aos-duration="900">
                    
                    <!-- Main Showcase Card Mockup -->
                    <div class="relative bg-white rounded-3xl p-6 shadow-2xl border border-purple-100 max-w-md mx-auto">
                        
                        <!-- Top Browser Bar Mock -->
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-rose-400"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-purple-400"></div>
                            </div>
                            <div class="bg-slate-50 px-3 py-1 rounded-full text-[11px] font-medium text-slate-500 flex items-center gap-1.5 border border-slate-100">
                                <i class="fa-solid fa-lock text-[9px] text-purple-600"></i> yourstore.anemony.in
                            </div>
                            <div class="text-[11px] text-rose-600 font-bold flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> LIVE
                            </div>
                        </div>

                        <!-- Mini Demo Content Inside Card -->
                        <div class="space-y-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-lg font-bold">
                                    <i class="fa-solid fa-store"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-sm">Sharma General & Kirana</h3>
                                    <span class="text-xs text-slate-500 flex items-center gap-1">
                                        <i class="fa-solid fa-location-dot text-rose-500 text-[10px]"></i> Kanpur • Google Verified
                                    </span>
                                </div>
                            </div>

                            <!-- Sample Product Card in Mockup -->
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 flex items-center justify-between">
                                <div>
                                    <div class="text-xs font-bold text-slate-800">Fortune Sunlite Oil (1L)</div>
                                    <div class="text-xs font-extrabold text-purple-700 mt-0.5">₹145.00 <span class="line-through text-slate-400 font-normal">₹165</span></div>
                                </div>
                                <span class="px-3 py-1 rounded-lg bg-slate-900 text-white text-[11px] font-bold flex items-center gap-1">
                                    <i class="fa-solid fa-cart-plus text-[10px]"></i> Add
                                </span>
                            </div>

                            <!-- Live Action Button inside Mockup -->
                            <div class="p-3 rounded-xl bg-purple-50/60 border border-purple-100 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-600 text-xl"></i>
                                    <div class="text-xs font-bold text-purple-950">WhatsApp Order Ready</div>
                                </div>
                                <span class="text-[10px] font-bold bg-gradient-to-r from-rose-500 to-purple-600 text-white px-2 py-0.5 rounded-full">Automated</span>
                            </div>
                        </div>

                    </div>

                    <!-- Floating Badge 1 (Top Left) -->
                    <div class="absolute -top-4 -left-6 bg-white px-4 py-2.5 rounded-xl shadow-xl border border-slate-100 animate-float-slow hidden sm:flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div>
                            <div class="text-[10px] font-bold text-slate-400">Search Growth</div>
                            <div class="text-xs font-extrabold text-slate-900">6x Organic Conversions</div>
                        </div>
                    </div>

                    <!-- Floating Badge 2 (Bottom Right) -->
                    <div class="absolute -bottom-4 -right-6 bg-white px-4 py-2.5 rounded-xl shadow-xl border border-slate-100 animate-float-fast hidden sm:flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-sm">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="text-[10px] font-bold text-slate-400">Doctors & Clinics</div>
                            <div class="text-xs font-extrabold text-slate-900">Live Slot Bookings</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- 📊 STATS COUNTER BAR -->
    <section class="py-12 bg-slate-50 border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="text-3xl sm:text-4xl font-black text-slate-900">7,000+</div>
                    <div class="text-xs sm:text-sm font-semibold text-slate-500 mt-1">Google 360° Tours</div>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <div class="text-3xl sm:text-4xl font-black text-rose-600">2,000+</div>
                    <div class="text-xs sm:text-sm font-semibold text-slate-500 mt-1">MSME Campaigns</div>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="text-3xl sm:text-4xl font-black text-purple-600">99.9%</div>
                    <div class="text-xs sm:text-sm font-semibold text-slate-500 mt-1">System Uptime</div>
                </div>
                <div data-aos="fade-up" data-aos-delay="400">
                    <div class="text-3xl sm:text-4xl font-black text-amber-500">0%</div>
                    <div class="text-xs sm:text-sm font-semibold text-slate-500 mt-1">Theme Data Loss</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 🏢 LIVE DEMOS & INDUSTRY ARCHETYPES -->
    <section id="demos" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <span class="text-purple-700 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-purple-50 border border-purple-200/60">
                    Pre-Configured Industry Archetypes
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">
                    Har Business Ka Alag Workflow & Action Button
                </h2>
                <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                    General website builders har kisi ko ek jaisa template dete hain. Anemony onboarding ke waqt hi aapki category ke hisaab se Action Buttons aur Forms adapt kar deta hai:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Demo 1: Retail & Kirana -->
                <div class="bg-slate-50 rounded-2xl p-7 border border-slate-200 hover-lift flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-2.5 py-1 rounded-md bg-rose-50 text-rose-700 border border-rose-200/50 text-xs font-bold">RETAIL & STORE</span>
                            <i class="fa-solid fa-bag-shopping text-rose-500 text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Sharma Kirana & General Store</h3>
                        <p class="text-xs text-slate-600 mb-6 leading-relaxed">
                            Groceries, fashion aur retail shops ke liye—variants (size/weight), cart bag, stock status, aur fast 1-click WhatsApp order.
                        </p>
                        
                        <div class="space-y-2.5 border-t border-slate-200 pt-4 mb-6 text-xs text-slate-700">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-rose-500"></i>
                                <span><strong>Main CTA:</strong> "Order on WhatsApp / Add to Cart"</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-rose-500"></i>
                                <span>Size, Color & Weight Variant Selector</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-rose-500"></i>
                                <span>Google Store & Product Schema.org</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('store.show', 'sharma-kirana') }}" wire:navigate class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-rose-500 to-purple-600 hover:from-rose-600 hover:to-purple-700 text-white font-bold text-xs flex items-center justify-center gap-2 transition shadow-md shadow-purple-500/20">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Test Retail Demo Store
                    </a>
                </div>

                <!-- Demo 2: Clinic & Doctor -->
                <div class="bg-slate-50 rounded-2xl p-7 border border-slate-200 hover-lift flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-2.5 py-1 rounded-md bg-purple-50 text-purple-700 border border-purple-200/50 text-xs font-bold">CLINIC & DOCTORS</span>
                            <i class="fa-solid fa-calendar-check text-purple-600 text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Care Dental & Implant Clinic</h3>
                        <p class="text-xs text-slate-600 mb-6 leading-relaxed">
                            Doctors, dentists, salons aur clinics ke liye—consultation fees, duration (30 mins), aur interactive time-slot booking calendar.
                        </p>
                        
                        <div class="space-y-2.5 border-t border-slate-200 pt-4 mb-6 text-xs text-slate-700">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-purple-600"></i>
                                <span><strong>Main CTA:</strong> "Book Appointment Slot"</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-purple-600"></i>
                                <span>Date & Morning/Evening Slot Selector</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-purple-600"></i>
                                <span>Google MedicalBusiness Schema.org</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('store.show', 'care-dental-clinic') }}" wire:navigate class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold text-xs flex items-center justify-center gap-2 transition shadow-md shadow-purple-500/20">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Test Clinic Demo Store
                    </a>
                </div>

                <!-- Demo 3: B2B & Manufacturer -->
                <div class="bg-slate-50 rounded-2xl p-7 border border-slate-200 hover-lift flex flex-col justify-between" data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-2.5 py-1 rounded-md bg-amber-50 text-amber-800 border border-amber-200/50 text-xs font-bold">B2B & MANUFACTURING</span>
                            <i class="fa-solid fa-industry text-amber-600 text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Apex Steel & Fabrications</h3>
                        <p class="text-xs text-slate-600 mb-6 leading-relaxed">
                            Manufacturers aur wholesalers ke liye—Minimum Order Quantity (MOQ) rule aur "Request a Quote" lead capture modal.
                        </p>
                        
                        <div class="space-y-2.5 border-t border-slate-200 pt-4 mb-6 text-xs text-slate-700">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-amber-600"></i>
                                <span><strong>Main CTA:</strong> "Request a Quote"</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-amber-600"></i>
                                <span>Minimum Order Quantity (MOQ) Checker</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-amber-600"></i>
                                <span>Technical Drawing Notes & Lead Routing</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('store.show', 'apex-steel-craft') }}" wire:navigate class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs flex items-center justify-center gap-2 transition shadow-sm">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Test B2B Demo Store
                    </a>
                </div>

            </div>

        </div>
    </section>

    <!-- 🛠️ CORE FEATURES -->
    <section id="features" class="py-20 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <span class="text-purple-700 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-purple-50 border border-purple-200/60">
                    All-in-One Digital Stack
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">
                    Everything Your Business Needs to Grow
                </h2>
                <p class="text-slate-600 text-sm mt-3">
                    Bina kisi technical agency ke—sab kuch automated system me chalta hai.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Feature 1: Decoupled Themes -->
                <div class="p-7 rounded-2xl bg-white border border-slate-200 hover-lift" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Zero Data Loss Theme Switcher</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Database content aur visual design alag hain. Naya theme apply karne par aapka catalog, prices ya photo kabhi delete nahi hoti.
                    </p>
                </div>

                <!-- Feature 2: WhatsApp Commerce -->
                <div class="p-7 rounded-2xl bg-white border border-slate-200 hover-lift" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg mb-4">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">WhatsApp Conversational Commerce</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Customer direct WhatsApp par order bhej sakta hai. Automatic order confirmation, abandoned cart alerts aur payment link customer ke chat par.
                    </p>
                </div>

                <!-- Feature 3: Auto Local SEO -->
                <div class="p-7 rounded-2xl bg-white border border-slate-200 hover-lift" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Google Maps & Local SEO</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Google Search aur Maps par "near me" local searches me aage aane ke liye automatically JSON-LD Schema code inject hota hai.
                    </p>
                </div>

                <!-- Feature 4: AI Store Generator -->
                <div class="p-7 rounded-2xl bg-white border border-slate-200 hover-lift" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-11 h-11 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">AI Vision & 1-Click Catalog</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Product photo upload karein—AI automatically title, bullet points description, category aur variants form fill kar deta hai.
                    </p>
                </div>

                <!-- Feature 5: Digital Invoicing -->
                <div class="p-7 rounded-2xl bg-white border border-slate-200 hover-lift" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">GST & Digital Invoicing</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Orders confirm hote hi customer ke phone par digital bill link bhejta hai jise PDF me download ya print kiya ja sakta hai.
                    </p>
                </div>

                <!-- Feature 6: Custom Domain & Free SSL -->
                <div class="p-7 rounded-2xl bg-white border border-slate-200 hover-lift" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Custom Domain & Free SSL</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Apna khud ka custom domain (e.g. `yourshop.com`) map karein bina kisi hosting aur SSL certificate ke extra kharche ke.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- 🆚 COMPARISON SECTION -->
    <section id="why-anemony" class="py-20 bg-slate-950 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
                <span class="text-rose-400 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-rose-950/60 border border-rose-800/60">
                    Clear Comparison
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold mt-3">Anemony vs Traditional Web Agencies</h2>
                <p class="text-slate-400 text-sm mt-2">Kyun hazaron businesses Anemony ko choose kar rahe hain:</p>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-800 bg-slate-900/90" data-aos="zoom-in">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b border-slate-800 bg-slate-800/40 text-xs uppercase tracking-wider">
                            <th class="py-4 px-6 font-bold text-slate-300">Feature</th>
                            <th class="py-4 px-6 font-bold text-rose-400 bg-rose-950/30">Anemony Platform</th>
                            <th class="py-4 px-6 font-semibold text-slate-400">Traditional Agency</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-xs sm:text-sm">
                        <tr>
                            <td class="py-4 px-6 font-medium text-slate-200">Setup Time</td>
                            <td class="py-4 px-6 font-bold text-rose-400 bg-rose-950/20">⚡ 60 Seconds (Instant)</td>
                            <td class="py-4 px-6 text-slate-400">3 to 6 Weeks</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-medium text-slate-200">Category Workflows</td>
                            <td class="py-4 px-6 font-bold text-rose-400 bg-rose-950/20">✅ Auto Archetype (Retail/Clinic/B2B)</td>
                            <td class="py-4 px-6 text-slate-400">❌ Costly Custom Coding</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-medium text-slate-200">Theme Switching</td>
                            <td class="py-4 px-6 font-bold text-rose-400 bg-rose-950/20">✅ 1-Click Zero Data Loss</td>
                            <td class="py-4 px-6 text-slate-400">❌ Complete Rebuild Needed</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-medium text-slate-200">WhatsApp Cart Checkout</td>
                            <td class="py-4 px-6 font-bold text-rose-400 bg-rose-950/20">✅ Native Pre-Built</td>
                            <td class="py-4 px-6 text-slate-400">❌ Expensive Paid Plugins</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 font-medium text-slate-200">Google Local SEO</td>
                            <td class="py-4 px-6 font-bold text-rose-400 bg-rose-950/20">✅ Automated JSON-LD Schema</td>
                            <td class="py-4 px-6 text-slate-400">❌ Monthly SEO Retainers</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <!-- 💬 CLIENT TESTIMONIALS -->
    <section id="testimonials" class="py-20 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
                <span class="text-purple-700 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-purple-50 border border-purple-200/60">
                    Success Stories
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-3">
                    Trusted By India's Growing Businesses
                </h2>
                <p class="text-slate-600 text-sm mt-2">Real feedback from real business owners:</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Client 1 -->
                <div class="p-7 rounded-2xl bg-slate-50 border border-slate-200 hover-lift flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="flex items-center gap-1 text-amber-400 text-xs mb-3">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed italic mb-6">
                            "Anemony made our online presence effortless. The automatic SEO and lead routing brought in nearly 6x increase in organic customer queries in just a few months."
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
                        <div class="w-9 h-9 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-xs">
                            Y
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-900">Yamsanwar & Groups</div>
                            <div class="text-[11px] text-slate-500">Infrastructure & Properties</div>
                        </div>
                    </div>
                </div>

                <!-- Client 2 -->
                <div class="p-7 rounded-2xl bg-slate-50 border border-slate-200 hover-lift flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="flex items-center gap-1 text-amber-400 text-xs mb-3">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed italic mb-6">
                            "The automated appointment booking and medical schema for our clinic has made patient scheduling seamless. Bookings come directly into our calendar with WhatsApp alerts."
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
                        <div class="w-9 h-9 rounded-full bg-rose-100 text-rose-700 flex items-center justify-center font-bold text-xs">
                            C
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-900">Center Point Clinic</div>
                            <div class="text-[11px] text-slate-500">Healthcare Practice</div>
                        </div>
                    </div>
                </div>

                <!-- Client 3 -->
                <div class="p-7 rounded-2xl bg-slate-50 border border-slate-200 hover-lift flex flex-col justify-between" data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <div class="flex items-center gap-1 text-amber-400 text-xs mb-3">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed italic mb-6">
                            "Updating our catalog and Google profile from mobile takes less than 2 minutes. The WhatsApp ordering flow is popular with all our retail customers."
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
                        <div class="w-9 h-9 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-xs">
                            M
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-900">Maitreya Retailers</div>
                            <div class="text-[11px] text-slate-500">Consumer Goods</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ❓ FAQ ACCORDION -->
    <section id="faq" class="py-20 bg-slate-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="text-purple-700 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-purple-50 border border-purple-200/60">
                    Got Questions?
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-3">Frequently Asked Questions</h2>
            </div>

            <div class="space-y-3.5" data-aos="fade-up">
                
                <details class="group border border-slate-200 rounded-xl p-5 [&_summary::-webkit-details-marker]:hidden bg-white">
                    <summary class="flex cursor-pointer items-center justify-between font-bold text-slate-900 text-sm">
                        <span>Kya mujhe coding aani zaroori hai?</span>
                        <span class="transition group-open:-rotate-180"><i class="fa-solid fa-chevron-down text-slate-400"></i></span>
                    </summary>
                    <p class="mt-3 text-xs text-slate-600 leading-relaxed">
                        Bilkul nahi! Anemony 100% No-Code platform hai. Aap sirf apne business ka naam aur category chunte hain, aur system aapki website, products, aur WhatsApp buttons automatically ready kar deta hai.
                    </p>
                </details>

                <details class="group border border-slate-200 rounded-xl p-5 [&_summary::-webkit-details-marker]:hidden bg-white">
                    <summary class="flex cursor-pointer items-center justify-between font-bold text-slate-900 text-sm">
                        <span>Agar main baad me template badalta hu toh mera catalog delete hoga?</span>
                        <span class="transition group-open:-rotate-180"><i class="fa-solid fa-chevron-down text-slate-400"></i></span>
                    </summary>
                    <p class="mt-3 text-xs text-slate-600 leading-relaxed">
                        0% Data Loss! Ye platform headless decoupled architecture par chalta hai. Aapka database safe rehta hai, sirf front-end ka visual design switch hota hai.
                    </p>
                </details>

                <details class="group border border-slate-200 rounded-xl p-5 [&_summary::-webkit-details-marker]:hidden bg-white">
                    <summary class="flex cursor-pointer items-center justify-between font-bold text-slate-900 text-sm">
                        <span>Customer ka order WhatsApp par kaise aayega?</span>
                        <span class="transition group-open:-rotate-180"><i class="fa-solid fa-chevron-down text-slate-400"></i></span>
                    </summary>
                    <p class="mt-3 text-xs text-slate-600 leading-relaxed">
                        Jaise hi customer cart me items add karke "Complete Order" click karega, unke WhatsApp par formatted text generate hoga jisme items list, total amount aur delivery address hoga jo seedha aapke number par receive hoga.
                    </p>
                </details>

                <details class="group border border-slate-200 rounded-xl p-5 [&_summary::-webkit-details-marker]:hidden bg-white">
                    <summary class="flex cursor-pointer items-center justify-between font-bold text-slate-900 text-sm">
                        <span>Kya main apna custom domain (e.g. myshop.com) connect kar sakta hu?</span>
                        <span class="transition group-open:-rotate-180"><i class="fa-solid fa-chevron-down text-slate-400"></i></span>
                    </summary>
                    <p class="mt-3 text-xs text-slate-600 leading-relaxed">
                        Haan! Aap apna personal domain aaram se link kar sakte hain, aur system automated free SSL certificate generate kar deta hai.
                    </p>
                </details>

            </div>

        </div>
    </section>

    <!-- 🚀 BIG CTA FOOTER BANNER (Gradient Swirl Inspired) -->
    <section class="py-20 bg-slate-950 text-white text-center px-4 relative overflow-hidden">
        
        <!-- Ambient Background Glow matching logo -->
        <div class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-rose-500/10 to-purple-600/10 pointer-events-none"></div>

        <div class="max-w-3xl mx-auto relative z-10" data-aos="zoom-in">
            <span class="text-rose-400 text-xs font-black uppercase tracking-wider px-3.5 py-1 rounded-full bg-rose-950/60 border border-rose-800/60">
                Instant 60-Second Setup
            </span>
            <h2 class="text-3xl sm:text-5xl font-black mt-4 mb-4 leading-tight">
                Apne Business Ko Aaj Hi Digital Karein
            </h2>
            <p class="text-slate-400 text-sm sm:text-base max-w-xl mx-auto mb-8 leading-relaxed">
                Join thousands of businesses who automated their sales, bookings and Google presence with Anemony.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('onboarding') }}" wire:navigate class="w-full sm:w-auto px-9 py-4 rounded-xl btn-brand-gradient text-white font-black text-sm shadow-xl hover-lift transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-rocket"></i> Abhi Free Me Store Banayein
                </a>
            </div>
        </div>
    </section>

    <!-- 📑 CLEAN SAAS FOOTER -->
    <footer class="py-12 bg-slate-950 text-slate-400 text-xs border-t border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
                <div>
                    <div class="flex items-center gap-2 mb-3 text-white font-extrabold text-lg">
                        <div class="w-6 h-6 rounded-lg gradient-logo-swirl flex items-center justify-center text-white text-xs">
                            <i class="fa-solid fa-layer-group text-[10px]"></i>
                        </div>
                        Anemony.
                    </div>
                    <p class="text-slate-500 leading-relaxed">
                        All-in-One MSME Operating System + No-Code Website Engine. Empowering Indian local businesses from traditional to digital.
                    </p>
                </div>
                <div>
                    <div class="font-bold text-slate-200 uppercase tracking-wider mb-3">Industry Solutions</div>
                    <ul class="space-y-2">
                        <li><a href="{{ route('store.show', 'sharma-kirana') }}" wire:navigate class="hover:text-rose-400 transition">Retail & Kirana Store</a></li>
                        <li><a href="{{ route('store.show', 'care-dental-clinic') }}" wire:navigate class="hover:text-purple-400 transition">Doctor & Dental Clinic</a></li>
                        <li><a href="{{ route('store.show', 'apex-steel-craft') }}" wire:navigate class="hover:text-amber-400 transition">B2B Manufacturing Plant</a></li>
                    </ul>
                </div>
                <div>
                    <div class="font-bold text-slate-200 uppercase tracking-wider mb-3">Features</div>
                    <ul class="space-y-2">
                        <li><a href="#features" class="hover:text-rose-400 transition">Google 360 & Local SEO</a></li>
                        <li><a href="#features" class="hover:text-purple-400 transition">WhatsApp Commerce</a></li>
                        <li><a href="#features" class="hover:text-amber-400 transition">Decoupled Theme Engine</a></li>
                        <li><a href="#features" class="hover:text-rose-400 transition">Digital GST Invoicing</a></li>
                    </ul>
                </div>
                <div>
                    <div class="font-bold text-slate-200 uppercase tracking-wider mb-3">Contact & Support</div>
                    <p class="text-slate-500 leading-relaxed mb-2">
                        Phone: +91 95792 14456<br>
                        Email: support@anemony.in<br>
                        India
                    </p>
                </div>
            </div>
            
            <div class="border-t border-slate-900 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p>&copy; {{ date('Y') }} Anemony Technologies. All rights reserved.</p>
                <div class="flex items-center gap-4 text-slate-500">
                    <a href="#" class="hover:text-slate-300">About Us</a>
                    <a href="#" class="hover:text-slate-300">Privacy Policy</a>
                    <a href="#" class="hover:text-slate-300">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- 📞 FLOATING WHATSAPP BUTTON -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/919579214456?text=Hi%2C+I+want+to+launch+my+business+website+on+Anemony" target="_blank" class="w-14 h-14 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center text-2xl shadow-2xl hover:scale-110 transition-transform">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 700,
            easing: 'ease-out-cubic',
        });
    </script>
    @livewireScripts
</body>
</html>
