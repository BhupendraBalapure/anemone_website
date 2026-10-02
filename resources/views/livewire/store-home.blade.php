<div class="{{ match($currentTheme) {
    'dark_luxury', 'salon_landing_hair_botox', 'salon_landing_hydrafacial', 'salon_landing_spa_pass', 'salon_landing_men_club', 'salon_landing_nail_lash', 'clinic_landing_urgent_opd', 'clinic_landing_health_checkup', 'clinic_landing_dental_laser', 'clinic_landing_lasik_vision', 'clinic_landing_knee_replacement', 'clinic_landing_maternity_package', 'coaching_ecom_test_series', 'coaching_ecom_recorded_lectures' => 'bg-[#070D1B] text-zinc-100 min-h-screen',
    'hotel_business' => 'bg-[#0B132B] text-slate-100 min-h-screen',
    'motel_highway' => 'bg-[#18181B] text-slate-100 min-h-screen',
    'hotel_boutique' => 'bg-[#120E24] text-slate-100 min-h-screen',
    'hotel_budget' => 'bg-[#F0FDFA] text-slate-900 min-h-screen',
    'hotel_family' => 'bg-[#FFFBEB] text-stone-900 min-h-screen',
    'minimal_card', 'hotel_resort' => 'bg-[#FDFBF7] text-stone-900 min-h-screen',
    'nature_retreat' => 'bg-[#F4F7F4] text-emerald-950 min-h-screen',
    'coastal_beach' => 'bg-[#F0FDFB] text-slate-900 min-h-screen',
    'heritage_haveli' => 'bg-[#FCF8F2] text-stone-900 min-h-screen',
    'mountain_chalet' => 'bg-[#F8F6F2] text-stone-900 min-h-screen',
    'wellness_sanctuary' => 'bg-[#F5F8F6] text-emerald-950 min-h-screen',
    default => 'bg-slate-50 text-slate-800 min-h-screen',
} }}">


@php
    $bizCat = $tenant->settings['business_category'] ?? ($tenant->business_category ?? '');
    $isHotelCategory = stripos($bizCat, 'Hotel') !== false || stripos($bizCat, 'Motel') !== false || ($archetype->code === 'hospitality' && empty($bizCat));
@endphp

    <!-- 🌟 Top Demo & Theme Switcher Bar (Only Shown when explicitly requested with ?demo=1) -->
    @if(request()->boolean('demo'))
    <div class="bg-slate-950 text-white text-xs py-2 px-4 shadow-md sticky top-0 z-50 flex flex-wrap items-center justify-between gap-2 border-b border-purple-950">
        <div class="flex items-center gap-2 flex-wrap">
            <span class="bg-gradient-to-r from-rose-500 to-purple-600 text-white font-bold px-2.5 py-0.5 rounded-full text-[10px] uppercase tracking-wider">
                <i class="fa-solid fa-layer-group text-[9px] mr-1"></i> {{ strtoupper($tenant->business_category ?: 'Archetype: ' . $archetype->code) }}
            </span>
            <span class="bg-purple-900/60 border border-purple-700/60 text-purple-200 font-bold px-2 py-0.5 rounded-full text-[10px] uppercase tracking-wider">
                @if($this->isEcommerce)
                    <i class="fa-solid fa-cart-shopping text-[9px] mr-1"></i> Mode: E-Commerce
                @elseif($this->isLandingPage)
                    <i class="fa-solid fa-bullhorn text-[9px] mr-1"></i> Mode: Landing Page
                @else
                    <i class="fa-solid fa-globe text-[9px] mr-1"></i> Mode: Business Website
                @endif
            </span>
            <span class="font-medium text-slate-300 hidden md:inline">Website Live Preview</span>
        </div>
        <div class="flex items-center gap-1.5 sm:gap-2 overflow-x-auto max-w-full pb-1 sm:pb-0">
            <span class="text-slate-400 text-[11px] hidden sm:inline shrink-0">Theme:</span>

            @if($isHotelCategory)
                <button wire:click="switchTheme('hotel_business')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'hotel_business' ? 'bg-blue-600 text-white font-bold shadow ring-2 ring-blue-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🏢 City Business
                </button>
                <button wire:click="switchTheme('motel_highway')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'motel_highway' ? 'bg-red-600 text-white font-bold shadow ring-2 ring-red-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🚗 Highway Motel
                </button>
                <button wire:click="switchTheme('hotel_boutique')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'hotel_boutique' ? 'bg-purple-600 text-white font-bold shadow ring-2 ring-purple-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🏨 Urban Boutique
                </button>
                <button wire:click="switchTheme('hotel_resort')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'hotel_resort' ? 'bg-rose-600 text-white font-bold shadow ring-2 ring-rose-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    ✨ Grand 5-Star
                </button>
                <button wire:click="switchTheme('hotel_budget')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'hotel_budget' ? 'bg-teal-600 text-white font-bold shadow ring-2 ring-teal-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🛏️ Smart Budget
                </button>
                <button wire:click="switchTheme('hotel_family')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'hotel_family' ? 'bg-amber-600 text-white font-bold shadow ring-2 ring-amber-400/40' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🌴 Family &amp; Lawn
                </button>
            @elseif($bizCat === 'Beauty & Salons')
                @if($this->isEcommerce)
                    <button wire:click="switchTheme('retail_supermarket')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_supermarket' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🛍️ Beauty Store
                    </button>
                    <button wire:click="switchTheme('salon_ecom_organic_skincare')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_ecom_organic_skincare' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ✨ Organic Skincare
                    </button>
                    <button wire:click="switchTheme('salon_ecom_haircare_tools')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_ecom_haircare_tools' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💇 Hair Pro Mart
                    </button>
                    <button wire:click="switchTheme('salon_ecom_bridal_vanity')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_ecom_bridal_vanity' ? 'bg-rose-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💄 Bridal Vanity
                    </button>
                    <button wire:click="switchTheme('salon_ecom_men_grooming')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_ecom_men_grooming' ? 'bg-slate-700 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💈 Men's Grooming
                    </button>
                    <button wire:click="switchTheme('salon_ecom_perfume_bath_body')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_ecom_perfume_bath_body' ? 'bg-pink-700 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌸 Luxury Perfumes
                    </button>
                @elseif($this->isLandingPage)
                    <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👑 Bridal Funnel
                    </button>
                    <button wire:click="switchTheme('salon_landing_hair_botox')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_landing_hair_botox' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚡ Hair Botox Flash
                    </button>
                    <button wire:click="switchTheme('salon_landing_hydrafacial')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_landing_hydrafacial' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💎 HydraFacial Glow
                    </button>
                    <button wire:click="switchTheme('salon_landing_spa_pass')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_landing_spa_pass' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌿 Spa Weekend Pass
                    </button>
                    <button wire:click="switchTheme('salon_landing_men_club')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_landing_men_club' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💈 Men's VIP Club
                    </button>
                    <button wire:click="switchTheme('salon_landing_nail_lash')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_landing_nail_lash' ? 'bg-fuchsia-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💅 ₹999 Nail &amp; Lash
                    </button>
                @else
                    <button wire:click="switchTheme('salon_wellness')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['salon_spa', 'salon_wellness']) ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ✂️ Unisex Salon
                    </button>
                    <button wire:click="switchTheme('salon_bridal')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_bridal' ? 'bg-rose-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👰 Bridal Studio
                    </button>
                    <button wire:click="switchTheme('wellness_sanctuary')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'wellness_sanctuary' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌿 Ayurvedic Spa
                    </button>
                    <button wire:click="switchTheme('salon_barber_lounge')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_barber_lounge' ? 'bg-slate-700 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💈 Men's Barber
                    </button>
                    <button wire:click="switchTheme('salon_nail_lashes')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_nail_lashes' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💅 Nail Aesthetics
                    </button>
                    <button wire:click="switchTheme('salon_luxury_hair_studio')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'salon_luxury_hair_studio' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💇 Balayage &amp; Hair
                    </button>
                @endif
            @elseif($bizCat === 'Clinics & Hospitals')
                @if($this->isEcommerce)
                    <button wire:click="switchTheme('clinic_ecom_pharmacy_rx')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['clinic_ecom_pharmacy_rx', 'retail_supermarket']) ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💊 24/7 Rx Pharmacy
                    </button>
                    <button wire:click="switchTheme('clinic_ecom_diagnostic_tests')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_ecom_diagnostic_tests' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🧪 Lab &amp; Diagnostics
                    </button>
                    <button wire:click="switchTheme('clinic_ecom_ortho_surgical')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_ecom_ortho_surgical' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦽 Mobility &amp; Braces
                    </button>
                    <button wire:click="switchTheme('clinic_ecom_baby_pediatric')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_ecom_baby_pediatric' ? 'bg-rose-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🍼 Baby &amp; Maternity
                    </button>
                    <button wire:click="switchTheme('clinic_ecom_diabetic_devices')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_ecom_diabetic_devices' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🩸 Chronic &amp; Devices
                    </button>
                    <button wire:click="switchTheme('clinic_ecom_dental_hygiene')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_ecom_dental_hygiene' ? 'bg-cyan-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🪥 Oral &amp; Dental
                    </button>
                @elseif($this->isLandingPage)
                    <button wire:click="switchTheme('clinic_landing_urgent_opd')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['clinic_landing_urgent_opd', 'dark_luxury', 'doctor_clinic']) ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚡ Urgent OPD Slot
                    </button>
                    <button wire:click="switchTheme('clinic_landing_health_checkup')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_landing_health_checkup' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🔬 85-Test Checkup
                    </button>
                    <button wire:click="switchTheme('clinic_landing_dental_laser')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_landing_dental_laser' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦷 Laser Dental RCT
                    </button>
                    <button wire:click="switchTheme('clinic_landing_lasik_vision')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_landing_lasik_vision' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👁️ Femto LASIK
                    </button>
                    <button wire:click="switchTheme('clinic_landing_knee_replacement')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_landing_knee_replacement' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦴 Robotic Knee
                    </button>
                    <button wire:click="switchTheme('clinic_landing_maternity_package')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_landing_maternity_package' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👶 Bliss Maternity
                    </button>
                @else
                    <button wire:click="switchTheme('clinic_multispecialty_hospital')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['clinic_multispecialty_hospital', 'doctor_clinic']) ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏥 Multi-Specialty
                    </button>
                    <button wire:click="switchTheme('clinic_dental_implant')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_dental_implant' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦷 Dental &amp; Implants
                    </button>
                    <button wire:click="switchTheme('clinic_maternity_pediatric')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_maternity_pediatric' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👶 Mother &amp; Child
                    </button>
                    <button wire:click="switchTheme('clinic_cardiology_heart')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_cardiology_heart' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ❤️ Heart Institute
                    </button>
                    <button wire:click="switchTheme('clinic_eyecare_lasik')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_eyecare_lasik' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👁️ Eye &amp; LASIK
                    </button>
                    <button wire:click="switchTheme('clinic_ortho_physio')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'clinic_ortho_physio' ? 'bg-indigo-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦴 Ortho &amp; Spine
                    </button>
                @endif
            @elseif($bizCat === 'Doctors & Specialists')
                @if($this->isEcommerce)
                    <button wire:click="switchTheme('doctor_ecom_prescription_refills')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['doctor_ecom_prescription_refills', 'retail_supermarket']) ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💊 Rx Refills
                    </button>
                    <button wire:click="switchTheme('doctor_ecom_supplements_nutrition')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_ecom_supplements_nutrition' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌿 Supplements
                    </button>
                    <button wire:click="switchTheme('doctor_ecom_ortho_supports')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_ecom_ortho_supports' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦿 Ortho Supports
                    </button>
                    <button wire:click="switchTheme('doctor_ecom_baby_pediatric_care')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_ecom_baby_pediatric_care' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🍼 Baby Care
                    </button>
                    <button wire:click="switchTheme('doctor_ecom_derma_skincare_cosmeceuticals')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_ecom_derma_skincare_cosmeceuticals' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ✨ Cosmeceuticals
                    </button>
                    <button wire:click="switchTheme('doctor_ecom_chronic_monitoring_kits')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_ecom_chronic_monitoring_kits' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🩸 Vitals Monitors
                    </button>
                @elseif($this->isLandingPage)
                    <button wire:click="switchTheme('doctor_landing_second_opinion')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['doctor_landing_second_opinion', 'dark_luxury']) ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🔍 2nd Opinion
                    </button>
                    <button wire:click="switchTheme('doctor_landing_teleconsult_urgent')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_landing_teleconsult_urgent' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📱 15-Min Video
                    </button>
                    <button wire:click="switchTheme('doctor_landing_diabetes_reversal')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_landing_diabetes_reversal' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📉 Diabetes Reversal
                    </button>
                    <button wire:click="switchTheme('doctor_landing_pcod_pcos_clinic')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_landing_pcod_pcos_clinic' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌸 PCOD / PCOS Care
                    </button>
                    <button wire:click="switchTheme('doctor_landing_joint_pain_prp')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_landing_joint_pain_prp' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦴 Joint PRP
                    </button>
                    <button wire:click="switchTheme('doctor_landing_hair_loss_trichology')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_landing_hair_loss_trichology' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💇 Hair Loss GFC
                    </button>
                @else
                    <button wire:click="switchTheme('doctor_web_consultant_physician')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['doctor_web_consultant_physician', 'doctor_clinic', 'modern_clean']) ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🩺 MD Physician
                    </button>
                    <button wire:click="switchTheme('doctor_web_pediatrician_child')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_web_pediatrician_child' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👶 Pediatrician
                    </button>
                    <button wire:click="switchTheme('doctor_web_gynecologist_women')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_web_gynecologist_women' ? 'bg-rose-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌸 Gynecologist
                    </button>
                    <button wire:click="switchTheme('doctor_web_ortho_surgeon')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_web_ortho_surgeon' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦴 Ortho Surgeon
                    </button>
                    <button wire:click="switchTheme('doctor_web_derma_trichologist')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_web_derma_trichologist' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💆 Dermatologist
                    </button>
                    <button wire:click="switchTheme('doctor_web_cardio_heart')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'doctor_web_cardio_heart' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ❤️ Cardiologist
                    </button>
                @endif
            @elseif($bizCat === 'Coaching & Institutes')
                @if($this->isEcommerce)
                    <button wire:click="switchTheme('coaching_ecom_test_series')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['coaching_ecom_test_series', 'retail_supermarket']) ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📝 Test Series
                    </button>
                    <button wire:click="switchTheme('coaching_ecom_study_notes')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_ecom_study_notes' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📖 Toppers Notes
                    </button>
                    <button wire:click="switchTheme('coaching_ecom_recorded_lectures')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_ecom_recorded_lectures' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🎥 Video Courses
                    </button>
                    <button wire:click="switchTheme('coaching_ecom_pyq_question_banks')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_ecom_pyq_question_banks' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📚 25-Yr PYQs
                    </button>
                    <button wire:click="switchTheme('coaching_ecom_language_kits')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_ecom_language_kits' ? 'bg-cyan-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🗣️ Language Kits
                    </button>
                    <button wire:click="switchTheme('coaching_ecom_school_stationery')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_ecom_school_stationery' ? 'bg-orange-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📐 Exam Stationery
                    </button>
                @elseif($this->isLandingPage)
                    <button wire:click="switchTheme('coaching_landing_scholarship_admission')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['coaching_landing_scholarship_admission', 'dark_luxury']) ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏆 100% Scholarship
                    </button>
                    <button wire:click="switchTheme('coaching_landing_crash_course_neet_jee')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_landing_crash_course_neet_jee' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚡ 90-Day Crash
                    </button>
                    <button wire:click="switchTheme('coaching_landing_free_demo_class')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_landing_free_demo_class' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🆓 3-Day Demo
                    </button>
                    <button wire:click="switchTheme('coaching_landing_upsc_foundation_batch')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_landing_upsc_foundation_batch' ? 'bg-indigo-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏛️ UPSC 1-Yr Batch
                    </button>
                    <button wire:click="switchTheme('coaching_landing_coding_placement_bootcamp')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_landing_coding_placement_bootcamp' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🚀 Coding Bootcamp
                    </button>
                    <button wire:click="switchTheme('coaching_landing_study_abroad_visa')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_landing_study_abroad_visa' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🛂 Study Abroad
                    </button>
                @else
                    <button wire:click="switchTheme('coaching_web_iit_jee_neet')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['coaching_web_iit_jee_neet', 'coaching_institute', 'minimal_card']) ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🎯 IIT-JEE &amp; NEET
                    </button>
                    <button wire:click="switchTheme('coaching_web_upsc_ias')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_web_upsc_ias' ? 'bg-indigo-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏛️ UPSC &amp; IAS
                    </button>
                    <button wire:click="switchTheme('coaching_web_commerce_ca')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_web_commerce_ca' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📊 CA &amp; Commerce
                    </button>
                    <button wire:click="switchTheme('coaching_web_ielts_abroad')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_web_ielts_abroad' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ✈️ Study Abroad
                    </button>
                    <button wire:click="switchTheme('coaching_web_coding_tech')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_web_coding_tech' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💻 Tech Bootcamp
                    </button>
                    <button wire:click="switchTheme('coaching_web_school_tuition')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'coaching_web_school_tuition' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📚 K-12 Tuitions
                    </button>
                @endif
            @elseif($bizCat === 'Herbal Care')
                @if($this->isLandingPage)
                    <button wire:click="switchTheme('herbal_landing_hair_fall_oil')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['herbal_landing_hair_fall_oil', 'dark_luxury']) ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💇 Hair Regrowth Oil
                    </button>
                    <button wire:click="switchTheme('herbal_landing_weight_detox_tea')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_landing_weight_detox_tea' ? 'bg-orange-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🔥 Belly Detox Pass
                    </button>
                    <button wire:click="switchTheme('herbal_landing_panchakarma_7day_pass')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_landing_panchakarma_7day_pass' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌿 7-Day Panchakarma
                    </button>
                    <button wire:click="switchTheme('herbal_landing_skin_glow_kumkumadi')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_landing_skin_glow_kumkumadi' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ✨ Kumkumadi Glow
                    </button>
                    <button wire:click="switchTheme('herbal_landing_diabetes_madhumeh_churn')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_landing_diabetes_madhumeh_churn' ? 'bg-green-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📉 Madhumeh Sugar Churn
                    </button>
                    <button wire:click="switchTheme('herbal_landing_joint_pain_oil')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_landing_joint_pain_oil' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦴 Joint Relief Oil
                    </button>
                @elseif($this->isEcommerce)
                    <button wire:click="switchTheme('herbal_ecom_cold_pressed_oils')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['herbal_ecom_cold_pressed_oils', 'retail_supermarket']) ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💧 Cold-Pressed Tailam
                    </button>
                    <button wire:click="switchTheme('herbal_ecom_classical_churnas_kadha')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_ecom_classical_churnas_kadha' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏺 Churnas &amp; Kadha
                    </button>
                    <button wire:click="switchTheme('herbal_ecom_immunity_rasayanas')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_ecom_immunity_rasayanas' ? 'bg-amber-700 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ✨ Chyawanprash &amp; Shilajit
                    </button>
                    <button wire:click="switchTheme('herbal_ecom_ayurvedic_skincare_ubtan')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_ecom_ayurvedic_skincare_ubtan' ? 'bg-rose-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌸 Saffron Ubtans &amp; Soaps
                    </button>
                    <button wire:click="switchTheme('herbal_ecom_organic_teas_infusions')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_ecom_organic_teas_infusions' ? 'bg-green-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ☕ Tulsi Herbal Teas
                    </button>
                    <button wire:click="switchTheme('herbal_ecom_joint_pain_balms')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_ecom_joint_pain_balms' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦴 Pain Relief Potli &amp; Oil
                    </button>
                @else
                    <button wire:click="switchTheme('herbal_web_panchakarma_sanctuary')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['herbal_web_panchakarma_sanctuary', 'wellness_sanctuary', 'nature_retreat']) ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌿 Panchakarma Detox
                    </button>
                    <button wire:click="switchTheme('herbal_web_nadi_pariksha_clinic')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_web_nadi_pariksha_clinic' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🧘 Nadi Pariksha Clinic
                    </button>
                    <button wire:click="switchTheme('herbal_web_herbal_farm_apothecary')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_web_herbal_farm_apothecary' ? 'bg-green-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌱 Organic Farm Apothecary
                    </button>
                    <button wire:click="switchTheme('herbal_web_ayurvedic_lifestyle_retreat')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_web_ayurvedic_lifestyle_retreat' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🕊️ Satvik Yoga Retreat
                    </button>
                    <button wire:click="switchTheme('herbal_web_classical_vaidya_hospital')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_web_classical_vaidya_hospital' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏥 Ayurvedic Hospital
                    </button>
                    <button wire:click="switchTheme('herbal_web_ayurvedic_fertility_care')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'herbal_web_ayurvedic_fertility_care' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌸 Garbh Sanskar Center
                    </button>
                @endif
            @elseif($bizCat === 'Manufacturers')
                @if($this->isLandingPage)
                    <button wire:click="switchTheme('mfg_landing_custom_oem_rfq')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['mfg_landing_custom_oem_rfq', 'dark_luxury']) ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📋 24h Blueprint RFQ
                    </button>
                    <button wire:click="switchTheme('mfg_landing_dealership_distributor_franchise')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_landing_dealership_distributor_franchise' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🤝 Distributor Onboarding
                    </button>
                    <button wire:click="switchTheme('mfg_landing_contract_packaging_private_label')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_landing_contract_packaging_private_label' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏷️ Private Label &amp; Packing
                    </button>
                    <button wire:click="switchTheme('mfg_landing_rapid_prototyping_3d_printing')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_landing_rapid_prototyping_3d_printing' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⏱️ 72h Rapid Prototyping
                    </button>
                    <button wire:click="switchTheme('mfg_landing_solar_structural_mounting_oem')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_landing_solar_structural_mounting_oem' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ☀️ Solar Structures RFQ
                    </button>
                    <button wire:click="switchTheme('mfg_landing_export_bulk_container_sourcing')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_landing_export_bulk_container_sourcing' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌐 Global Export Sourcing
                    </button>
                @elseif($this->isEcommerce)
                    <button wire:click="switchTheme('mfg_ecom_industrial_fasteners_hardware')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['mfg_ecom_industrial_fasteners_hardware', 'retail_supermarket', 'modern_clean']) ? 'bg-slate-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🔩 Bolts &amp; Fasteners
                    </button>
                    <button wire:click="switchTheme('mfg_ecom_protective_safety_ppe_gear')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_ecom_protective_safety_ppe_gear' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦺 Industrial PPE &amp; Safety
                    </button>
                    <button wire:click="switchTheme('mfg_ecom_hydraulic_pneumatic_valves')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_ecom_hydraulic_pneumatic_valves' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚙️ Hydraulic &amp; Pneumatic
                    </button>
                    <button wire:click="switchTheme('mfg_ecom_packaging_supplies_tapes')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_ecom_packaging_supplies_tapes' ? 'bg-yellow-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📦 Packaging &amp; Tapes
                    </button>
                    <button wire:click="switchTheme('mfg_ecom_electrical_switchgear_cables')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_ecom_electrical_switchgear_cables' ? 'bg-rose-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚡ Switchgear &amp; Cables
                    </button>
                    <button wire:click="switchTheme('mfg_ecom_raw_metal_pipes_structural')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_ecom_raw_metal_pipes_structural' ? 'bg-cyan-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏗️ Structural Steel Pipes
                    </button>
                @else
                    <button wire:click="switchTheme('mfg_web_precision_machining_plant')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['mfg_web_precision_machining_plant', 'b2b_industrial', 'b2b_manufacturing']) ? 'bg-blue-700 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏭 Precision CNC Plant
                    </button>
                    <button wire:click="switchTheme('mfg_web_sheet_metal_laser_fabrication')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_web_sheet_metal_laser_fabrication' ? 'bg-orange-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚡ Fiber Laser &amp; Bending
                    </button>
                    <button wire:click="switchTheme('mfg_web_injection_moulding_polymers')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_web_injection_moulding_polymers' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🧪 Injection Moulding Unit
                    </button>
                    <button wire:click="switchTheme('mfg_web_industrial_automation_robotics')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_web_industrial_automation_robotics' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🤖 Automation &amp; Robotics
                    </button>
                    <button wire:click="switchTheme('mfg_web_corrugated_packaging_boxes')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_web_corrugated_packaging_boxes' ? 'bg-amber-700 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📦 Corrugated Box Mill
                    </button>
                    <button wire:click="switchTheme('mfg_web_textile_garment_spinning_mill')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'mfg_web_textile_garment_spinning_mill' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🧵 Textile Spinning Mill
                    </button>
                @endif
            @elseif($bizCat === 'Real Estate & Properties')
                <button wire:click="switchTheme('real_estate')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'real_estate' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🏢 Township &amp; RERA
                </button>
                <button wire:click="switchTheme('dark_luxury')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'dark_luxury' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🚀 Pre-Launch Funnel
                </button>
                <button wire:click="switchTheme('nature_retreat')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'nature_retreat' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                    🏡 Villa Plots
                </button>
            @elseif($bizCat === 'Restaurant & Cafes')
                <!-- 🍽️ RESTAURANT & CAFES MODE-AWARE SWITCHER -->
                @if($this->isLandingPage || str_starts_with($currentTheme, 'rest_landing_'))
                    <button wire:click="switchTheme('rest_landing_unlimited_grand_buffet')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['rest_landing_unlimited_grand_buffet', 'dark_luxury']) ? 'bg-rose-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🔥 ₹599 Royal Buffet
                    </button>
                    <button wire:click="switchTheme('rest_landing_banquet_party_hall_celebration')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_landing_banquet_party_hall_celebration' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🎉 AC Banquet Package
                    </button>
                    <button wire:click="switchTheme('rest_landing_midnight_cravings_flash_deal')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_landing_midnight_cravings_flash_deal' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚡ 40% Midnight Delivery
                    </button>
                    <button wire:click="switchTheme('rest_landing_corporate_executive_lunch_catering')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_landing_corporate_executive_lunch_catering' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💼 Corporate Bento Box
                    </button>
                    <button wire:click="switchTheme('rest_landing_romantic_candlelight_dinner')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_landing_romantic_candlelight_dinner' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ❤️ Candlelight Couple
                    </button>
                    <button wire:click="switchTheme('rest_landing_wedding_festive_outdoor_catering')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_landing_wedding_festive_outdoor_catering' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👑 Grand Wedding Catering
                    </button>
                @elseif($this->isEcommerce || str_starts_with($currentTheme, 'rest_ecom_'))
                    <button wire:click="switchTheme('rest_ecom_cloud_kitchen_biryani_box')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['rest_ecom_cloud_kitchen_biryani_box', 'restaurant_cafe']) ? 'bg-orange-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🍗 Handi Biryani Box
                    </button>
                    <button wire:click="switchTheme('rest_ecom_artisan_french_bakery_pastry')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_ecom_artisan_french_bakery_pastry' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🥐 French Bakery &amp; Cakes
                    </button>
                    <button wire:click="switchTheme('rest_ecom_gourmet_smash_burgers_wings')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_ecom_gourmet_smash_burgers_wings' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🍔 Smash Burgers &amp; Wings
                    </button>
                    <button wire:click="switchTheme('rest_ecom_homestyle_healthy_tiffin')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_ecom_homestyle_healthy_tiffin' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🥗 Homestyle Tiffin
                    </button>
                    <button wire:click="switchTheme('rest_ecom_handcrafted_icecream_desserts')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_ecom_handcrafted_icecream_desserts' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🍨 Gelato &amp; Sundaes
                    </button>
                    <button wire:click="switchTheme('rest_ecom_signature_rolls_street_bites')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_ecom_signature_rolls_street_bites' ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌯 Kathi Rolls &amp; Momos
                    </button>
                @else
                    <button wire:click="switchTheme('rest_web_fine_dining_royal_awadh')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['rest_web_fine_dining_royal_awadh', 'restaurant_cafe']) ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👑 Royal Awadh Dining
                    </button>
                    <button wire:click="switchTheme('rest_web_artisanal_rooftop_cafe')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['rest_web_artisanal_rooftop_cafe', 'minimal_card']) ? 'bg-amber-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ☕ Rooftop Bistro Cafe
                    </button>
                    <button wire:click="switchTheme('rest_web_woodfired_italian_pizzeria')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_web_woodfired_italian_pizzeria' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🍕 Wood-Fired Pizzeria
                    </button>
                    <button wire:click="switchTheme('rest_web_pure_veg_thali_bhojanalaya')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_web_pure_veg_thali_bhojanalaya' ? 'bg-orange-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🍲 Pure Veg Royal Thali
                    </button>
                    <button wire:click="switchTheme('rest_web_coastal_seafood_lounge')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_web_coastal_seafood_lounge' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🦀 Coastal Seafood Lounge
                    </button>
                    <button wire:click="switchTheme('rest_web_pan_asian_dimsum_teppanyaki')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'rest_web_pan_asian_dimsum_teppanyaki' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🥢 Live Teppanyaki &amp; Dim Sum
                    </button>
                @endif
            @elseif($bizCat === 'Other Services')
                <!-- 💼 OTHER SERVICES MODE-AWARE SWITCHER -->
                @if($this->isLandingPage || str_starts_with($currentTheme, 'service_landing_'))
                    <button wire:click="switchTheme('service_landing_emergency_plumbing_electrical')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['service_landing_emergency_plumbing_electrical', 'dark_luxury']) ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚡ Emergency Breakdown
                    </button>
                    <button wire:click="switchTheme('service_landing_gst_tax_audit_notice_resolution')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_landing_gst_tax_audit_notice_resolution' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚖️ Tax Notice Defense
                    </button>
                    <button wire:click="switchTheme('service_landing_termite_rodent_pest_free_pass')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_landing_termite_rodent_pest_free_pass' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🛡️ 1-Yr Termite Pass
                    </button>
                    <button wire:click="switchTheme('service_landing_corporate_annual_housekeeping_contract')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_landing_corporate_annual_housekeeping_contract' ? 'bg-cyan-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏢 Corporate Cleaning AMC
                    </button>
                    <button wire:click="switchTheme('service_landing_iso_certification_fasttrack')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_landing_iso_certification_fasttrack' ? 'bg-purple-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏅 7-Day ISO FastTrack
                    </button>
                    <button wire:click="switchTheme('service_landing_solar_rooftop_epc_installation')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_landing_solar_rooftop_epc_installation' ? 'bg-orange-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ☀️ ₹78K Solar Subsidy
                    </button>
                @elseif($this->isEcommerce || str_starts_with($currentTheme, 'service_ecom_'))
                    <button wire:click="switchTheme('service_ecom_home_deep_cleaning_pest_control')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['service_ecom_home_deep_cleaning_pest_control', 'retail_supermarket']) ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ✨ Deep Cleaning &amp; Pest
                    </button>
                    <button wire:click="switchTheme('service_ecom_appliance_repair_ac_maintenance')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_ecom_appliance_repair_ac_maintenance' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ❄️ AC &amp; Appliance Care
                    </button>
                    <button wire:click="switchTheme('service_ecom_company_startup_registration_compliance')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_ecom_company_startup_registration_compliance' ? 'bg-indigo-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📜 Startup Registration
                    </button>
                    <button wire:click="switchTheme('service_ecom_event_wedding_planning_decor')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_ecom_event_wedding_planning_decor' ? 'bg-rose-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🎪 Wedding &amp; Events
                    </button>
                    <button wire:click="switchTheme('service_ecom_packers_movers_relocation')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_ecom_packers_movers_relocation' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📦 Packers &amp; Movers
                    </button>
                    <button wire:click="switchTheme('service_ecom_it_support_cloud_cybersecurity')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_ecom_it_support_cloud_cybersecurity' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💻 Managed IT Support
                    </button>
                @else
                    <button wire:click="switchTheme('service_web_corporate_law_legal_firm')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['service_web_corporate_law_legal_firm', 'minimal_card']) ? 'bg-slate-700 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚖️ Corporate Legal Firm
                    </button>
                    <button wire:click="switchTheme('service_web_chartered_accountants_tax')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_web_chartered_accountants_tax' ? 'bg-teal-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📊 CA &amp; Tax Advisory
                    </button>
                    <button wire:click="switchTheme('service_web_digital_marketing_creative_agency')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['service_web_digital_marketing_creative_agency', 'modern_clean']) ? 'bg-indigo-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🚀 Digital Growth Agency
                    </button>
                    <button wire:click="switchTheme('service_web_express_logistics_supply_chain')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_web_express_logistics_supply_chain' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🚚 Express 3PL Logistics
                    </button>
                    <button wire:click="switchTheme('service_web_architecture_interior_design_studio')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_web_architecture_interior_design_studio' ? 'bg-amber-700 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📐 Architecture &amp; Interiors
                    </button>
                    <button wire:click="switchTheme('service_web_facility_management_security')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'service_web_facility_management_security' ? 'bg-slate-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🛡️ Facility &amp; Guarding
                    </button>
                @endif
            @else
                <!-- 🏬 OTHER RETAIL & CONSUMER GOODS MODE-AWARE SWITCHER -->
                @if($this->isLandingPage)
                    <button wire:click="switchTheme('retail_landing_mega_clearance_sale')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['retail_landing_mega_clearance_sale', 'dark_luxury']) ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🔥 70% Clearance Sale
                    </button>
                    <button wire:click="switchTheme('retail_landing_festive_bridal_combo')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_landing_festive_bridal_combo' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👑 Bridal Trousseau Combo
                    </button>
                    <button wire:click="switchTheme('retail_landing_smartphone_exchange_bonus')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_landing_smartphone_exchange_bonus' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        📱 5G Phone Exchange
                    </button>
                    <button wire:click="switchTheme('retail_landing_modular_kitchen_makeover')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_landing_modular_kitchen_makeover' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🍳 Modular Kitchen
                    </button>
                    <button wire:click="switchTheme('retail_landing_vip_loyalty_gold_pass')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_landing_vip_loyalty_gold_pass' ? 'bg-yellow-500 text-slate-950 font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⭐ VIP Gold Pass
                    </button>
                    <button wire:click="switchTheme('retail_landing_corporate_festive_gift_hamper')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_landing_corporate_festive_gift_hamper' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🎁 Corporate Hampers
                    </button>
                @elseif($this->isEcommerce)
                    <button wire:click="switchTheme('retail_ecom_modern_fashion_apparel')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['retail_ecom_modern_fashion_apparel', 'retail_supermarket', 'modern_clean']) ? 'bg-indigo-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👕 Streetwear &amp; Fashion
                    </button>
                    <button wire:click="switchTheme('retail_ecom_mobile_accessories_gadgets')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_ecom_mobile_accessories_gadgets' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🎧 Audio &amp; Chargers
                    </button>
                    <button wire:click="switchTheme('retail_ecom_artisanal_dryfruits_spices')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_ecom_artisanal_dryfruits_spices' ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🌰 Royal Dry Fruits
                    </button>
                    <button wire:click="switchTheme('retail_ecom_activewear_fitness_gear')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_ecom_activewear_fitness_gear' ? 'bg-red-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🏃 Activewear &amp; Gym
                    </button>
                    <button wire:click="switchTheme('retail_ecom_baby_care_kids_toys')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_ecom_baby_care_kids_toys' ? 'bg-rose-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🧸 Baby Care &amp; Toys
                    </button>
                    <button wire:click="switchTheme('retail_ecom_ceramic_kitchen_tableware')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_ecom_ceramic_kitchen_tableware' ? 'bg-orange-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🍳 Ceramic Tableware
                    </button>
                @else
                    <button wire:click="switchTheme('retail_web_luxury_jewelry_showroom')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ in_array($currentTheme, ['retail_web_luxury_jewelry_showroom', 'modern_clean']) ? 'bg-amber-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        💎 Jewelry Showroom
                    </button>
                    <button wire:click="switchTheme('retail_web_designer_apparel_boutique')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_web_designer_apparel_boutique' ? 'bg-pink-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👗 Couture Boutique
                    </button>
                    <button wire:click="switchTheme('retail_web_smart_electronics_megastore')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_web_smart_electronics_megastore' ? 'bg-blue-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        ⚡ Electronics Megastore
                    </button>
                    <button wire:click="switchTheme('retail_web_luxury_home_furniture_gallery')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_web_luxury_home_furniture_gallery' ? 'bg-amber-800 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🛋️ Living Furniture
                    </button>
                    <button wire:click="switchTheme('retail_web_premium_optical_eyewear_lounge')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_web_premium_optical_eyewear_lounge' ? 'bg-sky-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        👓 Eyewear Lounge
                    </button>
                    <button wire:click="switchTheme('retail_web_artisan_organic_supermarket')" class="px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer whitespace-nowrap {{ $currentTheme === 'retail_web_artisan_organic_supermarket' ? 'bg-emerald-600 text-white font-bold shadow' : 'bg-slate-800 hover:bg-slate-700 text-slate-300' }}">
                        🥦 Fresh Supermarket
                    </button>
                @endif
            @endif


            <a href="{{ route('store.editor', $tenant->slug) }}" target="_top" class="ml-2 px-3 py-1 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-black text-xs flex items-center gap-1.5 shadow shrink-0">
                <i class="fa-solid fa-paintbrush text-[10px]"></i> Template Editor
            </a>
            <a href="{{ route('store.dashboard', $tenant->slug) }}" target="_top" class="ml-1.5 px-3 py-1 rounded-lg bg-purple-600 hover:bg-purple-500 text-white font-bold text-xs flex items-center gap-1.5 shadow shrink-0">
                <i class="fa-solid fa-gauge text-[10px]"></i> Dashboard &amp; Studio
            </a>
            <a href="{{ route('onboarding') }}" target="_top" class="ml-1 btn-brand-gradient text-white px-3 py-1 rounded-lg font-bold text-xs flex items-center gap-1 shadow shrink-0">
                <i class="fa-solid fa-plus text-[10px]"></i> New Store
            </a>
        </div>
    </div>
    @endif

    <!-- ⚡ Flash Message Notification -->
    @if($flashMessage)
    <div class="bg-emerald-600 text-white px-4 py-2.5 text-center text-sm font-semibold flex items-center justify-center gap-2 shadow relative z-40">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ $flashMessage }}</span>
        <button wire:click="$set('flashMessage', '')" class="ml-3 text-emerald-200 hover:text-white cursor-pointer">&times;</button>
    </div>
    @endif

    <!-- ⚡ Mode-Specific Top Announcement Ribbon -->
    @if($this->isLandingPage)
    <div class="bg-gradient-to-r from-rose-600 via-purple-600 to-amber-600 text-white text-[11px] sm:text-xs py-1.5 px-4 text-center font-black tracking-wide flex items-center justify-center gap-2 shadow-sm">
        <span class="w-2 h-2 rounded-full bg-amber-300 animate-ping"></span>
        <span>🔥 LIMITED TIME VOUCHER: Flat 40% Off First Visit &bull; Only 5 Slots Left This Week in {{ $tenant->city ?: 'Nagpur' }}!</span>
    </div>
    @elseif($this->isEcommerce)
    <div class="bg-slate-900 text-slate-200 text-[11px] sm:text-xs py-1.5 px-4 text-center font-bold tracking-wide flex items-center justify-center gap-2 border-b border-slate-800">
        <i class="fa-solid fa-truck-fast text-emerald-400"></i>
        <span>🚚 FREE SHIPPING on orders above ₹499 &bull; 100% Genuine Certified &bull; Fast WhatsApp Order Delivery</span>
    </div>
    @endif

    <!-- 🧭 Main Website Navbar -->
    <nav class="relative z-30 backdrop-blur-md border-b transition-colors {{ 
        $currentTheme === 'dark_luxury' ? 'bg-[#090D16]/95 border-zinc-800 text-white' : (
        $currentTheme === 'hotel_resort' ? 'bg-[#181614]/95 border-amber-500/20 text-stone-100' : (
        $currentTheme === 'nature_retreat' ? 'bg-[#0B1E15]/95 border-emerald-800/40 text-emerald-50' : (
        $currentTheme === 'heritage_haveli' ? 'bg-[#1F1710]/95 border-amber-600/30 text-amber-50' : (
        $currentTheme === 'mountain_chalet' ? 'bg-[#1C1613]/95 border-orange-900/40 text-stone-100' : (
        $currentTheme === 'wellness_sanctuary' ? 'bg-[#0D241C]/95 border-teal-800/40 text-teal-50' : (
        $currentTheme === 'coastal_beach' ? 'bg-white/95 border-cyan-100 text-slate-900' : (
        $currentTheme === 'minimal_card' ? 'bg-[#FDFBF7]/95 border-sky-100 text-slate-900' : 
        'bg-white/95 border-slate-200 text-slate-900'))))))) }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between gap-4">
            
            <!-- Brand Logo & Name -->
            <a href="#hero" class="flex items-center gap-3">
                @if(!empty($tenant->settings['logo_url']))
                    <img src="{{ $tenant->settings['logo_url'] }}" alt="{{ $tenant->business_name }}" class="h-10 w-auto max-w-[150px] object-contain rounded-xl shadow-xs">
                @else
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-lg shadow-md {{ 
                    $currentTheme === 'hotel_resort' ? 'bg-gradient-to-br from-rose-700 via-amber-600 to-amber-700 ring-2 ring-amber-400/30' : (
                    $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border border-amber-500/40 text-amber-400' : (
                    $currentTheme === 'minimal_card' ? 'bg-gradient-to-br from-sky-500 to-blue-600 text-white rounded-2xl shadow-sky-200' : (
                    $currentTheme === 'nature_retreat' ? 'bg-gradient-to-br from-emerald-600 to-teal-800 text-white rounded-2xl ring-2 ring-emerald-400/30' : (
                    $currentTheme === 'coastal_beach' ? 'bg-gradient-to-br from-cyan-400 to-blue-600 text-white rounded-2xl shadow-cyan-200' : (
                    $currentTheme === 'heritage_haveli' ? 'bg-gradient-to-br from-amber-600 via-rose-700 to-amber-800 text-amber-200 rounded-2xl ring-2 ring-amber-400/40' : (
                    $currentTheme === 'mountain_chalet' ? 'bg-gradient-to-br from-orange-700 to-amber-900 text-orange-100 rounded-2xl ring-2 ring-orange-400/30' : (
                    $currentTheme === 'wellness_sanctuary' ? 'bg-gradient-to-br from-teal-700 to-emerald-800 text-teal-100 rounded-2xl ring-2 ring-teal-400/30' : ''))))))) }}" style="{{ !in_array($currentTheme, ['hotel_resort', 'minimal_card', 'dark_luxury', 'nature_retreat', 'coastal_beach', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'background: linear-gradient(135deg, ' . $tenant->brand_color . ', #9333ea);' : '' }}">
                    {{ strtoupper(substr($tenant->business_name, 0, 1)) }}
                </div>
                @endif
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-black text-lg sm:text-xl tracking-tight leading-tight {{ in_array($currentTheme, ['hotel_resort', 'minimal_card', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'font-serif' : '' }}">{{ $tenant->business_name }}</span>
                        @if($currentTheme === 'hotel_business')
                            <i class="fa-solid fa-briefcase text-blue-400 text-xs" title="Corporate Business Hotel"></i>
                        @elseif($currentTheme === 'motel_highway')
                            <i class="fa-solid fa-car text-red-400 text-xs" title="Highway Express Motel"></i>
                        @elseif($currentTheme === 'hotel_boutique')
                            <i class="fa-solid fa-martini-glass-citrus text-purple-400 text-xs" title="Urban Boutique Hotel"></i>
                        @elseif($currentTheme === 'hotel_budget')
                            <i class="fa-solid fa-bed text-teal-400 text-xs" title="Smart Economy Hotel"></i>
                        @elseif($currentTheme === 'hotel_family')
                            <i class="fa-solid fa-people-roof text-amber-400 text-xs" title="Family Hotel &amp; Lawn"></i>
                        @elseif($currentTheme === 'hotel_resort')
                            <i class="fa-solid fa-crown text-amber-400 text-xs" title="5-Star Verified Resort"></i>
                        @elseif($currentTheme === 'dark_luxury')
                            <i class="fa-solid fa-star text-amber-400 text-xs" title="VIP Privilege"></i>
                        @elseif($currentTheme === 'minimal_card')
                            <i class="fa-solid fa-water text-sky-400 text-xs" title="Santorini Cliffside Stay"></i>
                        @elseif($currentTheme === 'nature_retreat')
                            <i class="fa-solid fa-tree text-emerald-400 text-xs" title="Safari Eco-Resort"></i>
                        @elseif($currentTheme === 'coastal_beach')
                            <i class="fa-solid fa-water-ladder text-cyan-400 text-xs" title="Maldives Overwater Resort"></i>
                        @elseif($currentTheme === 'heritage_haveli')
                            <i class="fa-solid fa-chess-rook text-amber-400 text-xs" title="Heritage Fort Haveli"></i>
                        @elseif($currentTheme === 'mountain_chalet')
                            <i class="fa-solid fa-mountain text-orange-400 text-xs" title="Alpine Snow Chalet"></i>
                        @elseif($currentTheme === 'wellness_sanctuary')
                            <i class="fa-solid fa-spa text-teal-400 text-xs" title="Ayurveda Healing Sanctuary"></i>
                        @else
                            <i class="fa-solid fa-circle-check text-sky-500 text-xs" title="Verified Business"></i>
                        @endif
                    </div>
                    <p class="text-[11px] font-medium opacity-70 flex items-center gap-1">
                        <i class="fa-solid fa-location-dot text-[10px] {{ in_array($currentTheme, ['hotel_resort', 'dark_luxury', 'heritage_haveli', 'hotel_family']) ? 'text-amber-400' : ($currentTheme === 'hotel_business' ? 'text-blue-400' : ($currentTheme === 'motel_highway' ? 'text-red-400' : ($currentTheme === 'hotel_boutique' ? 'text-purple-400' : ($currentTheme === 'hotel_budget' ? 'text-teal-400' : ($currentTheme === 'nature_retreat' ? 'text-emerald-400' : ($currentTheme === 'wellness_sanctuary' ? 'text-teal-400' : ($currentTheme === 'mountain_chalet' ? 'text-orange-400' : ($currentTheme === 'coastal_beach' || $currentTheme === 'minimal_card' ? 'text-sky-400' : 'text-rose-500')))))))) }}"></i> {{ $tenant->city }} &bull; {{ $tenant->business_category ?: $archetype->name }}
                    </p>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            @if($this->isLandingPage)
                <div class="hidden md:flex items-center gap-2 text-xs font-bold text-amber-400 bg-amber-500/10 border border-amber-500/30 px-3.5 py-1.5 rounded-full backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                    <span>⚡ Special Offer Funnel &bull; 40% Off Limited Slots</span>
                </div>
            @elseif($this->isEcommerce)
                <div class="hidden lg:flex items-center gap-6 text-sm font-semibold opacity-85">
                    <a href="#services" class="hover:text-amber-400 transition">Shop Products</a>
                    <a href="#about" class="hover:text-amber-400 transition">About Store</a>
                    <a href="#reviews" class="hover:text-amber-400 transition">Customer Reviews</a>
                    <a href="#contact" class="hover:text-amber-400 transition">Contact & Help</a>
                </div>
            @else
                <div class="hidden lg:flex items-center gap-6 text-sm font-semibold opacity-85">
                    <a href="#services" class="hover:text-amber-400 transition">{{ $archetype->code === 'hospitality' ? 'Suites & Rooms' : ($archetype->code === 'service' ? 'Services' : ($archetype->code === 'b2b' ? 'Products' : 'Catalog')) }}</a>
                    <a href="#about" class="hover:text-amber-400 transition">About</a>
                    <a href="#highlights" class="hover:text-amber-400 transition">Why Us</a>
                    <a href="#timings" class="hover:text-amber-400 transition">{{ $archetype->code === 'hospitality' ? 'Check-in Desk' : 'Hours' }}</a>
                    <a href="#reviews" class="hover:text-amber-400 transition">Reviews</a>
                    <a href="#contact" class="hover:text-amber-400 transition">Contact</a>
                </div>
            @endif

            <!-- Navbar Quick Actions -->
            <div class="flex items-center gap-2.5">
                <a href="tel:{{ $tenant->phone }}" class="px-3.5 py-2 rounded-xl border text-xs font-bold transition flex items-center gap-1.5 {{ 
                    in_array($currentTheme, ['dark_luxury', 'hotel_resort', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'border-white/20 hover:bg-white/10 text-white' : 'border-slate-200 hover:bg-slate-100 text-slate-700' }}">
                    <i class="fa-solid fa-phone {{ in_array($currentTheme, ['hotel_resort', 'dark_luxury', 'heritage_haveli']) ? 'text-amber-400' : ($currentTheme === 'nature_retreat' ? 'text-emerald-400' : ($currentTheme === 'mountain_chalet' ? 'text-orange-400' : ($currentTheme === 'wellness_sanctuary' ? 'text-teal-400' : 'text-sky-500'))) }}"></i> <span class="hidden sm:inline">Call</span>
                </a>
                
                <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to inquire about reservations.') }}" target="_blank" class="px-4 py-2 rounded-xl text-xs font-bold shadow-sm transition flex items-center gap-1.5 {{ 
                    $currentTheme === 'hotel_resort' ? 'bg-gradient-to-r from-rose-700 to-amber-700 hover:from-rose-600 hover:to-amber-600 text-white' : (
                    $currentTheme === 'dark_luxury' ? 'bg-amber-500 hover:bg-amber-400 text-slate-950 font-black' : (
                    $currentTheme === 'minimal_card' ? 'bg-sky-600 hover:bg-sky-500 text-white' : (
                    $currentTheme === 'nature_retreat' ? 'bg-emerald-600 hover:bg-emerald-500 text-white' : (
                    $currentTheme === 'coastal_beach' ? 'bg-cyan-600 hover:bg-cyan-500 text-white' : (
                    $currentTheme === 'heritage_haveli' ? 'bg-amber-600 hover:bg-amber-500 text-white' : (
                    $currentTheme === 'mountain_chalet' ? 'bg-orange-600 hover:bg-orange-500 text-white' : (
                    $currentTheme === 'wellness_sanctuary' ? 'bg-teal-700 hover:bg-teal-600 text-white' : 
                    'bg-emerald-600 hover:bg-emerald-700 text-white'))))))) }}">
                    <i class="fa-brands fa-whatsapp text-sm"></i> <span class="hidden sm:inline">{{ $currentTheme === 'dark_luxury' ? 'VIP WhatsApp' : (in_array($currentTheme, ['hotel_resort', 'minimal_card', 'nature_retreat', 'coastal_beach', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'Concierge' : 'WhatsApp') }}</span>
                </a>

                @if($this->isEcommerce && $archetype->hasFeature('cart'))
                <button wire:click="$set('showCartModal', true)" class="relative p-2 rounded-xl border transition cursor-pointer {{ in_array($currentTheme, ['dark_luxury', 'hotel_resort', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'border-white/20 bg-white/10 text-white' : 'border-slate-200 bg-slate-50 text-slate-800' }}">
                    <i class="fa-solid fa-cart-shopping text-base"></i>
                    @if($this->cartCount > 0)
                    <span class="absolute -top-1.5 -right-1.5 bg-rose-500 text-white text-[10px] font-black rounded-full w-5 h-5 flex items-center justify-center shadow">
                        {{ $this->cartCount }}
                    </span>
                    @endif
                </button>
                @endif

                <!-- ⚙️ Merchant Store Admin Access -->
                <a href="{{ route('store.dashboard', $tenant->slug) }}" target="_blank" class="p-2 sm:px-3 sm:py-2 rounded-xl border border-purple-500/30 bg-purple-500/10 hover:bg-purple-500/20 text-purple-400 hover:text-purple-300 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs" title="Store Owner Dashboard">
                    <i class="fa-solid fa-gauge text-xs"></i>
                    <span class="hidden lg:inline text-[11px]">Dashboard</span>
                </a>
            </div>

        </div>
    </nav>

    <!-- 🚀 HERO SECTION: REAL-WORLD INDUSTRY ARCHITECTURAL LAYOUTS -->
    @if($currentTheme === 'hotel_business')
    <!-- ======================================================== -->
    <!-- 🏢 LAYOUT: CITY BUSINESS & EXECUTIVE HOTEL                -->
    <!-- Executive Slate/Navy Palette + Corporate Booking Engine  -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-blue-900/40">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1600&auto=format&fit=crop&q=85" alt="City Business Hotel" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0B132B] via-[#0B132B]/75 to-[#0B132B]/85"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/20 border border-blue-400/50 text-blue-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-briefcase text-blue-400"></i> Corporate Business &amp; Executive Hotel &bull; {{ $tenant->city ?: 'Nagpur' }}
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] mb-5 text-slate-100">
                Executive Stays, Fast Wi-Fi &amp; Boardrooms in <span class="bg-gradient-to-r from-blue-400 via-sky-300 to-indigo-300 bg-clip-text text-transparent">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Tailored for corporate executives, business travelers, and conference delegates. Featuring ergonomic work suites, high-speed 150 Mbps fiber Wi-Fi, 24/7 room service, and airport shuttle." }}
            </p>

            <!-- Floating Corporate Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-blue-200/60 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-blue-600 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-blue-600 mr-1"></i> Check-Out Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-file-invoice text-blue-600 mr-1"></i> Corporate Rate
                        </span>
                        <div class="text-xs font-bold text-slate-800 truncate">Executive AC &bull; GST Invoice</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-500 hover:to-indigo-600 text-white font-extrabold text-xs shadow-lg shadow-blue-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-bed"></i> Book Executive Room
                    </a>
                </div>
            </div>

            <!-- Business Trust Badges -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-slate-300">
                <span class="flex items-center gap-2"><i class="fa-solid fa-wifi text-blue-400 text-sm"></i> 150 Mbps Fiber Wi-Fi</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-handshake text-blue-400 text-sm"></i> Conference Boardrooms</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-clock text-blue-400 text-sm"></i> 24/7 Express Check-In</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-van-shuttle text-blue-400 text-sm"></i> Airport / Station Shuttle</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'motel_highway')
    <!-- ======================================================== -->
    <!-- 🚗 LAYOUT: HIGHWAY EXPRESS MOTEL & TRANSIT LODGE          -->
    <!-- Drive-In Parking + 24/7 Check-in + Highway Dhaba Diner   -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-red-900/40">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=1600&auto=format&fit=crop&q=85" alt="Highway Motel" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#18181B] via-[#18181B]/75 to-[#18181B]/85"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-500/20 border border-red-400/50 text-red-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-car text-red-400"></i> Highway Express Motel &bull; 24/7 Transit Lodging &bull; {{ $tenant->city ?: 'Highway Corridor' }}
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] mb-5 text-slate-100">
                Drive-In Parking, Clean AC Rooms &amp; 24-Hour Roadside Check-In
            </h1>

            <p class="text-base sm:text-lg text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. The trusted national highway stopover for long-distance drivers, tourists, and road-trip families. Park directly outside your room with 24/7 CCTV surveillance, piping hot water, and delicious 24-hr highway dhaba dining." }}
            </p>

            <!-- Highway Quick Stopover Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-red-200/60 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-red-600 mr-1"></i> Arrival Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-bed text-red-600 mr-1"></i> Stay Plan
                        </span>
                        <div class="text-xs font-bold text-slate-800">Night Stay (12 Hours)</div>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-car-side text-red-600 mr-1"></i> Vehicle Parking
                        </span>
                        <div class="text-xs font-bold text-slate-800">Car / SUV In-Front</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-red-600 to-amber-700 hover:from-red-500 hover:to-amber-600 text-white font-extrabold text-xs shadow-lg shadow-red-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-key"></i> Quick Room Check-In
                    </a>
                </div>
            </div>

            <!-- Motel Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-slate-300">
                <span class="flex items-center gap-2"><i class="fa-solid fa-square-parking text-red-400 text-sm"></i> Drive-In Safe Parking</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-clock text-red-400 text-sm"></i> 24/7 Late-Night Check-in</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-utensils text-amber-400 text-sm"></i> 24-Hour Highway Dhaba</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-faucet-drip text-sky-400 text-sm"></i> 24/7 Hot Water Geyser</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'hotel_boutique')
    <!-- ======================================================== -->
    <!-- 🏨 LAYOUT: URBAN BOUTIQUE HOTEL & ROOFTOP LOUNGE          -->
    <!-- Designer Modern Interiors + Couple-Friendly + Rooftop Cafe -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-purple-900/40">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1600&auto=format&fit=crop&q=85" alt="Urban Boutique Hotel" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#120E24] via-[#120E24]/75 to-[#120E24]/85"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-purple-500/20 border border-purple-400/50 text-purple-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-martini-glass-citrus text-purple-400"></i> Urban Boutique Hotel &bull; Sunset Rooftop Lounge &bull; {{ $tenant->city ?: 'Nagpur' }}
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] mb-5 text-slate-100">
                Designer AC Suites, Ambient Moods &amp; Rooftop Dining in <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-rose-300 bg-clip-text text-transparent">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-300 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. A vibrant boutique haven in the city center. Featuring curated designer rooms, private balconies, welcoming couple-friendly check-in, and our signature panoramic rooftop cafe & lounge." }}
            </p>

            <!-- Boutique Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-purple-200/60 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-purple-600 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-purple-600 mr-1"></i> Check-Out Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-heart text-purple-600 mr-1"></i> Suite Type
                        </span>
                        <div class="text-xs font-bold text-slate-800">Balcony Suite &bull; Couple Safe</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-extrabold text-xs shadow-lg shadow-purple-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-couch"></i> Reserve Boutique Room
                    </a>
                </div>
            </div>

            <!-- Boutique Trust Badges -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-slate-300">
                <span class="flex items-center gap-2"><i class="fa-solid fa-martini-glass-citrus text-purple-400 text-sm"></i> Rooftop Sunset Lounge</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-heart text-pink-400 text-sm"></i> Couple-Friendly Verified</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-palette text-purple-400 text-sm"></i> Designer Interior Art</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-rose-400 text-sm"></i> Prime City Center</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'hotel_budget')
    <!-- ======================================================== -->
    <!-- 🛏️ LAYOUT: SMART BUDGET EXPRESS HOTEL & TRAVEL LODGE      -->
    <!-- Ginger & OYO Townhouse Style • Free Breakfast • Best Tariff-->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-teal-200">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=1600&auto=format&fit=crop&q=85" alt="Smart Budget Hotel" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-teal-950 via-slate-900/80 to-slate-900/75"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal-500/20 border border-teal-400/50 text-teal-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-bed text-teal-400"></i> Smart Economy Hotel &bull; Best Price Guarantee &bull; {{ $tenant->city ?: 'Nagpur' }}
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] mb-5 text-slate-100">
                Clean Sanitized AC Rooms, Free Breakfast &amp; Best Rate Guarantee
            </h1>

            <p class="text-base sm:text-lg text-slate-200 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Smart economy lodging with Ginger & OYO Townhouse convenience. Spotless AC rooms, sealed toiletries, free morning breakfast buffet, and 100 Mbps Wi-Fi with transparent tariffs." }}
            </p>

            <!-- Smart Budget Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-teal-200 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-teal-600 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-moon text-teal-600 mr-1"></i> Duration
                        </span>
                        <div class="text-xs font-bold text-slate-800">1 Night &bull; 2 Guests</div>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-0.5">
                            <i class="fa-solid fa-tag text-teal-600 mr-1"></i> Tariff Plan
                        </span>
                        <div class="text-xs font-bold text-teal-700">Best Rate ₹1,299/Night</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-500 hover:to-emerald-500 text-white font-extrabold text-xs shadow-lg shadow-teal-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-shield-halved"></i> Book Sanitized Room
                    </a>
                </div>
            </div>

            <!-- Smart Budget Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-slate-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-shield-halved text-teal-400 text-sm"></i> 100% Sanitized Guarantee</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-mug-hot text-amber-300 text-sm"></i> Free Hot Breakfast Buffet</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-wifi text-teal-400 text-sm"></i> 100 Mbps Fast Internet</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-receipt text-teal-400 text-sm"></i> Zero Hidden Charges</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'hotel_family')
    <!-- ======================================================== -->
    <!-- 🌴 LAYOUT: FAMILY HOTEL & GARDEN BANQUET LAWN             -->
    <!-- Interconnected Suites • 500+ Guest Lawn • Kids Zone      -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-amber-900/30">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=1600&auto=format&fit=crop&q=85" alt="Family Hotel & Lawn" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/70 to-stone-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/20 border border-amber-400/50 text-amber-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-people-roof text-amber-400"></i> Family Staycation Hotel &bull; Marriage Party Lawn &bull; {{ $tenant->city ?: 'Nagpur' }}
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] mb-5 text-amber-50">
                Spacious Family Suites, Green Party Lawns &amp; Celebrations
            </h1>

            <p class="text-base sm:text-lg text-amber-100/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. The top choice for family getaways, wedding guests, birthday parties, and group celebrations in {$tenant->city}. Interconnected family suites, 500+ capacity open marriage lawn, pure veg restaurant, and kids splash pool." }}
            </p>

            <!-- Family & Banquet Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-amber-200 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-amber-600 mr-1"></i> Event / Stay Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-solid fa-tree text-amber-600 mr-1"></i> Purpose
                        </span>
                        <div class="text-xs font-bold text-slate-800">Family Stay / Lawn Event</div>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-solid fa-users text-amber-600 mr-1"></i> Guests
                        </span>
                        <div class="text-xs font-bold text-slate-800">4-6 Family Suite / 100+ Lawn</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-600 to-rose-600 hover:from-amber-500 hover:to-rose-500 text-white font-extrabold text-xs shadow-lg shadow-amber-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-champagne-glasses"></i> Inquire Suite &amp; Lawn
                    </a>
                </div>
            </div>

            <!-- Family Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-amber-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-people-group text-amber-400 text-sm"></i> Interconnected Family Suites</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-tree text-emerald-400 text-sm"></i> 500+ Capacity Green Lawn</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-water-ladder text-sky-400 text-sm"></i> Kids Splash Pool</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-bowl-rice text-amber-400 text-sm"></i> Pure Veg Family Dining</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'hotel_resort')
    <!-- ======================================================== -->
    <!-- 🏨 LAYOUT 1: GRAND PALACE & 5-STAR HERITAGE RESORT       -->
    <!-- Full-Bleed Cinematic Hero + Floating Horizontal Booking Bar -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-amber-900/30">
        <!-- Cinematic Full-Bleed Background Image with Vignette -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600&auto=format&fit=crop&q=85" alt="Grand Luxury Palace Resort" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/60 to-stone-950/80"></div>
        </div>

        <!-- Centered Regal Content -->
        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <!-- Heritage Gold Pill -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/15 border border-amber-400/40 text-amber-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-crown text-[10px] text-amber-400"></i> Five-Star Heritage Luxury Resort &amp; Palace
            </div>

            <!-- Regal Serif Headline -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-stone-100">
                Experience Timeless Grandeur &amp; Royal Stays in <span class="text-amber-400 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-stone-300 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. An oasis of refined hospitality, opulent AC suites, award-winning multi-cuisine dining, and 24/7 personal butler care." }}
            </p>

            <!-- 🏨 Floating Horizontal Hotel Booking Bar (Classic 5-Star Hotel Engine) -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-2xl shadow-2xl border border-amber-200/50 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <!-- Check-In -->
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-rose-500 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <!-- Check-Out -->
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-rose-500 mr-1"></i> Check-Out Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <!-- Guests -->
                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-0.5">
                            <i class="fa-solid fa-user-group text-purple-600 mr-1"></i> Guests &amp; Suites
                        </span>
                        <div class="text-xs font-bold text-slate-800">2 Adults &bull; 1 Suite</div>
                    </div>

                    <!-- Action Button -->
                    <a href="#services" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-rose-600 via-rose-700 to-amber-600 hover:from-rose-500 hover:to-amber-500 text-white font-extrabold text-xs shadow-lg shadow-rose-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-bed"></i> Check Rates &amp; Book
                    </a>
                </div>
            </div>

            <!-- Heritage Trust Badges -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-stone-300">
                <span class="flex items-center gap-2"><i class="fa-solid fa-award text-amber-400 text-sm"></i> 5-Star Heritage Architecture</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-bell-concierge text-amber-400 text-sm"></i> 24/7 Butler &amp; Dining</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-water-ladder text-amber-400 text-sm"></i> Infinity Pool &amp; Spa</span>
                <span class="flex items-center gap-2"><i class="fa-brands fa-whatsapp text-emerald-400 text-sm"></i> Instant WhatsApp Desk</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'coaching_landing_scholarship_admission')
        @include('livewire.templates.coaching.landing.scholarship')

    @elseif($currentTheme === 'coaching_landing_crash_course_neet_jee')
        @include('livewire.templates.coaching.landing.crash-course')

    @elseif($currentTheme === 'coaching_landing_free_demo_class')
        @include('livewire.templates.coaching.landing.free-demo')

    @elseif($currentTheme === 'coaching_landing_upsc_foundation_batch')
        @include('livewire.templates.coaching.landing.upsc-foundation')

    @elseif($currentTheme === 'coaching_landing_coding_placement_bootcamp')
        @include('livewire.templates.coaching.landing.coding-bootcamp')

    @elseif($currentTheme === 'coaching_landing_study_abroad_visa')
        @include('livewire.templates.coaching.landing.study-abroad')

    @elseif(in_array($currentTheme, ['dark_luxury', 'salon_landing_hair_botox', 'salon_landing_hydrafacial', 'salon_landing_spa_pass', 'salon_landing_men_club', 'salon_landing_nail_lash', 'clinic_landing_urgent_opd', 'clinic_landing_health_checkup', 'clinic_landing_dental_laser', 'clinic_landing_lasik_vision', 'clinic_landing_knee_replacement', 'clinic_landing_maternity_package']) || str_starts_with($currentTheme, 'clinic_landing_') || str_starts_with($currentTheme, 'coaching_landing_') || str_starts_with($currentTheme, 'doctor_landing_') || str_starts_with($currentTheme, 'herbal_landing_') || str_starts_with($currentTheme, 'mfg_landing_') || str_starts_with($currentTheme, 'retail_landing_') || str_starts_with($currentTheme, 'rest_landing_') || str_starts_with($currentTheme, 'service_landing_') || $this->isLandingPage)
    <!-- ======================================================== -->
    <!-- 🌙 THEME: OBSIDIAN DARK LUXURY / HIGH-CONVERTING FUNNEL  -->
    <!-- Adapts automatically to Business Category with Dark VIP  -->
    <!-- ======================================================== -->
    @php
        $bizCat = $tenant->business_category ?: ($tenant->settings['business_category'] ?? ($tenant->archetype->name ?? 'Other Retail'));
        $cityUpper = strtoupper($tenant->city ?: 'YOUR CITY');
        $isHotelCategory = stripos($bizCat, 'Hotel') !== false || stripos($bizCat, 'Motel') !== false || ($archetype->code === 'hospitality' && empty($tenant->business_category));
    @endphp

    <section id="hero" class="relative overflow-hidden py-16 md:py-24 bg-gradient-to-b from-[#090D16] via-[#0D121F] to-[#090D16] text-white border-b border-zinc-800">
        <!-- Golden Ambient Glow Orbs -->
        <div class="absolute top-1/4 left-1/3 w-96 h-96 rounded-full blur-3xl opacity-20 pointer-events-none bg-amber-500"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 rounded-full blur-3xl opacity-15 pointer-events-none bg-purple-600"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left 7 Cols: Narrative -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    @if($bizCat === 'Beauty & Salons')
                        @if($currentTheme === 'salon_landing_hair_botox')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-purple-500/40 text-purple-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-purple-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-bolt text-purple-400"></i> FLASH SALE &bull; FLAT 40% OFF KERATIN &amp; BOTOX
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                MIRROR-SHINE GLOSS &amp; FRIZZ-FREE HAIR MAKEOVER IN <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Transform rough, dry hair into silky smooth tresses. Certified Brazilian keratin treatment and deep conditioning hair botox. 48-Hour voucher window!
                            </p>
                        @elseif($currentTheme === 'salon_landing_hydrafacial')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-sky-500/40 text-sky-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-sky-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-droplet text-sky-400"></i> 7-STEP MEDICAL HYDRAFACIAL &bull; GLASS SKIN
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                INSTANT RADIANCE &amp; GLASS SKIN GLOW IN <span class="bg-gradient-to-r from-sky-400 via-teal-300 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Painless vortex extraction, deep hyaluronic hydration, and medical LED phototherapy. Zero downtime, instant red-carpet glow. First 25 registrations only.
                            </p>
                        @elseif($currentTheme === 'salon_landing_spa_pass')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-emerald-500/40 text-emerald-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-emerald-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-leaf text-emerald-400"></i> WEEKEND SPA PASS &bull; HERBAL STEAM INCLUDED
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                AYURVEDIC DETOX &amp; 90-MIN FULL BODY THERAPY IN <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Unwind with warm sesame Abhyanga massage, herbal steam bath, and tension-melting shoulder therapy. Rejuvenate your body and soul this weekend.
                            </p>
                        @elseif($currentTheme === 'salon_landing_men_club')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-user-tie text-amber-400"></i> MEN'S VIP GROOMING COMBO &bull; ZERO-WAIT QUEUE
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                EXECUTIVE FADE, BEARD SCULPTING &amp; CHARCOAL DETAN IN <span class="bg-gradient-to-r from-amber-400 via-orange-400 to-rose-400 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Look sharp in 45 minutes flat. Precision scissor work, hot towel straight-razor shave, and instant pollution detan scrub by master barbers.
                            </p>
                        @elseif($currentTheme === 'salon_landing_nail_lash')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-fuchsia-500/40 text-fuchsia-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-fuchsia-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-hand-sparkles text-fuchsia-400"></i> LAUNCH OFFER &bull; FLAT ₹999 INTRO PASS
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                TRENDING GEL NAILS &amp; KOREAN LASH PERMS IN <span class="bg-gradient-to-r from-fuchsia-400 via-pink-400 to-purple-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Chip-resistant gel nail extensions with custom hand-painted nail art, plus 8-week volumizing Korean lash lifts. Grab your ₹999 launch pass now!
                            </p>
                        @else
                            <!-- Default Bridal HD Makeover Funnel -->
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-pink-500/40 text-pink-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-pink-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-crown text-pink-400"></i> LUXURY BRIDAL &amp; BEAUTY STUDIO &bull; VIP APPOINTMENTS
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                THE OBSIDIAN BEAUTY EXPERIENCE — BESPOKE SALON &amp; BRIDAL LOUNGE IN <span class="bg-gradient-to-r from-pink-400 via-rose-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Flawless bridal HD makeovers, premium hair therapies, and personalized luxury aesthetics. Experience celebrity stylist appointments in private VIP suites with organic care.
                            </p>
                        @endif

                        <!-- Glassmorphic Perks Box -->
                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-wand-magic-sparkles text-pink-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Bridal HD Makeup</span>
                                <span class="text-[9px] text-zinc-500">Airbrush Glamour</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-scissors text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Master Stylists</span>
                                <span class="text-[9px] text-zinc-500">10+ Yrs Experience</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-sparkles text-rose-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Private VIP Booth</span>
                                <span class="text-[9px] text-zinc-500">100% Sanitized</span>
                            </div>
                        </div>

                        <!-- CTAs -->
                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-pink-500 via-rose-500 to-purple-600 hover:from-pink-400 hover:to-purple-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-pink-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-calendar-check"></i> Book VIP Stylist Slot
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a VIP Bridal / Salon Appointment.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> VIP Salon WhatsApp
                            </a>
                        </div>

                    @elseif($bizCat === 'Clinics & Hospitals' || str_starts_with($currentTheme, 'clinic_landing_'))
                        @if($currentTheme === 'clinic_landing_health_checkup')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-purple-500/40 text-purple-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-purple-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-microscope text-purple-400"></i> PREVENTIVE HEALTH &bull; FLAT 60% OFF 85-TEST PANEL
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                COMPREHENSIVE FULL BODY HEALTH SCREENING IN <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Complete 85-parameter health assessment including Cardiac, Lipid, Liver, Kidney, Thyroid, HbA1c &amp; Vitamin D. Free certified home sample pickup and smart NABL digital report in 6 hours.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-vial text-purple-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">85 Parameters</span>
                                    <span class="text-[9px] text-zinc-500">Full Body Panel</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-house-chimney-medical text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Home Pickup</span>
                                    <span class="text-[9px] text-zinc-500">Phlebotomist Visit</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-file-medical text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">NABL Report</span>
                                    <span class="text-[9px] text-zinc-500">Within 6 Hours</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-purple-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-file-invoice text-sm"></i> Claim 60% Off Voucher
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book the 85-Parameter Full Body Health Checkup with Home Sample Collection.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Booking
                                </a>
                            </div>
                        @elseif($currentTheme === 'clinic_landing_dental_laser')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-teal-500/40 text-teal-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-teal-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-tooth text-teal-400"></i> PAINLESS LASER DENTAL &bull; FREE 3D DIGITAL X-RAY
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                SINGLE-SITTING LASER ROOT CANAL &amp; SMILE MAKEOVER IN <span class="bg-gradient-to-r from-teal-400 via-emerald-300 to-cyan-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Zero pain, single-sitting German laser root canal therapy and clear aligner consultations. Get a complimentary 3D digital OPG X-ray worth ₹800. First 20 patients only!
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-tooth text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Painless Laser</span>
                                    <span class="text-[9px] text-zinc-500">Single Sitting RCT</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-wand-magic-sparkles text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free 3D X-Ray</span>
                                    <span class="text-[9px] text-zinc-500">₹800 Value Free</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-virus text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">100% Autoclaved</span>
                                    <span class="text-[9px] text-zinc-500">Sterile Hygiene</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-400 hover:to-emerald-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-teal-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calendar-check text-sm"></i> Claim Free 3D X-Ray Slot
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to claim the Free 3D Digital X-Ray & Laser Dental consultation.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Dental WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'clinic_landing_lasik_vision')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-blue-500/40 text-blue-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-blue-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-eye text-blue-400"></i> BLADELESS FEMTO LASIK &bull; 10-MIN SPECTACLE FREEDOM
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                GET 100% FREEDOM FROM GLASSES IN 10 MINUTES IN <span class="bg-gradient-to-r from-blue-400 via-sky-300 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                US-FDA approved German femtosecond robotic laser technology. No blade cuts, zero stitches, crystal clear HD vision by tomorrow morning, and 0% interest easy monthly installments.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-bolt text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">10-Min Surgery</span>
                                    <span class="text-[9px] text-zinc-500">Walk Out Same Day</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-credit-card text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">0% Easy EMI</span>
                                    <span class="text-[9px] text-zinc-500">Zero Down Payment</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-award text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">US-FDA Laser</span>
                                    <span class="text-[9px] text-zinc-500">Blade-Free Safe</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-eye text-sm"></i> Book Free LASIK Scan
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a Free LASIK Suitability Evaluation.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> LASIK Helpline
                                </a>
                            </div>
                        @elseif($currentTheme === 'clinic_landing_knee_replacement')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-red-500/40 text-red-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-red-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-crutch text-red-400"></i> ROBOTIC KNEE SURGERY &bull; WALK THE NEXT DAY
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                SUB-MILLIMETER ROBOTIC KNEE REPLACEMENT IN <span class="bg-gradient-to-r from-red-400 via-rose-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Get permanent relief from severe knee pain. Sub-millimeter robotic precision, 30-year Swiss implants, zero muscle cutting, walk independently next morning, and 100% cashless mediclaim support.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-person-walking text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Walk Next Day</span>
                                    <span class="text-[9px] text-zinc-500">Rapid Recovery</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-shield-halved text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">30-Yr Implants</span>
                                    <span class="text-[9px] text-zinc-500">Swiss Longevity</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-file-shield text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">100% Cashless</span>
                                    <span class="text-[9px] text-zinc-500">All TPA / Mediclaim</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-red-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-user-doctor text-sm"></i> Consult Senior Orthopedic
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to inquire about Robotic Knee Replacement and Cashless Mediclaim.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Ortho WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'clinic_landing_maternity_package')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-pink-500/40 text-pink-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-pink-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-person-pregnant text-pink-400"></i> BLISS MATERNITY SUITES &bull; ALL-INCLUSIVE PACKAGE
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                LUXURY NORMAL &amp; C-SEC DELIVERY WITH PRIVATE SUITE IN <span class="bg-gradient-to-r from-pink-400 via-rose-300 to-purple-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Welcome your bundle of joy with complete peace of mind. Transparent all-inclusive maternity package, private luxury AC suites, 24/7 senior gynaecologists, Level-3 NICU backup, and free newborn gift kit.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-bed text-pink-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Private AC Suite</span>
                                    <span class="text-[9px] text-zinc-500">Luxury Birthing</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-baby text-purple-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Level-3 NICU</span>
                                    <span class="text-[9px] text-zinc-500">24/7 Pediatric Care</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-gift text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Newborn Gift Kit</span>
                                    <span class="text-[9px] text-zinc-500">Photoshoot Included</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-pink-600 via-rose-500 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-pink-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-baby text-sm"></i> Pre-Book Maternity Package
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a Maternity Hospital Tour and package details.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Maternity Tour WhatsApp
                                </a>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-sky-500/40 text-sky-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-sky-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-stethoscope text-sky-400"></i> SPECIALIST OPD CLINIC &bull; ZERO-WAIT GUARANTEE
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                SAME-DAY SPECIALIST DOCTOR CONSULTATION &amp; OPD TOKEN IN <span class="bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Skip the long hospital waiting queues. Guaranteed consultation slot with senior MD specialists, digital prescription slip, comprehensive diagnostics, and direct token confirmation on WhatsApp.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-user-doctor text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Verified MDs</span>
                                    <span class="text-[9px] text-zinc-500">Senior Specialists</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-clock text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Zero Waiting</span>
                                    <span class="text-[9px] text-zinc-500">Guaranteed Slot</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-notes-medical text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Digital Token</span>
                                    <span class="text-[9px] text-zinc-500">Instant WhatsApp</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-sky-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calendar-check"></i> Book Instant OPD Slot
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book an urgent OPD consultation slot.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Helpline
                                </a>
                            </div>
                        @endif

                    @elseif($bizCat === 'Doctors & Specialists' || str_starts_with($currentTheme, 'doctor_landing_'))
                        @if($currentTheme === 'doctor_landing_second_opinion')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-teal-500/40 text-teal-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-teal-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-notes-medical text-teal-400"></i> CLINICAL SECOND OPINION &bull; AVOID UNNECESSARY SURGERIES
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                CONFIRM YOUR DIAGNOSIS WITH SENIOR SUPER-SPECIALISTS IN <span class="bg-gradient-to-r from-teal-400 via-cyan-300 to-emerald-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Get independent, unbiased second opinions from board-certified MD &amp; DM specialists. Review MRI, CT scans, biopsy reports, and treatment plans within 24 hours.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-user-doctor text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Senior DMs</span>
                                    <span class="text-[9px] text-zinc-500">Board Certified</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-clock-rotate-left text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">24h Turnaround</span>
                                    <span class="text-[9px] text-zinc-500">Fast Report Review</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-halved text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Unbiased Care</span>
                                    <span class="text-[9px] text-zinc-500">Avoid Surgery</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-400 hover:to-emerald-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-teal-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-file-medical text-sm"></i> Submit Reports for Review
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to get a Medical Second Opinion on my reports.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Opinion Desk
                                </a>
                            </div>
                        @elseif($currentTheme === 'doctor_landing_teleconsult_urgent')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-sky-500/40 text-sky-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-sky-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-headset text-sky-400"></i> URGENT 15-MIN VIDEO CONSULT &bull; VERIFIED MD SPECIALISTS
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                CONNECT WITH AN EXPERT MD DOCTOR IN 15 MINUTES IN <span class="bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Skip hospital OPD traffic and waiting rooms. Connect with certified specialist doctors over high-definition encrypted video call with instant digital prescription on WhatsApp.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-bolt text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">In 15 Minutes</span>
                                    <span class="text-[9px] text-zinc-500">Rapid Response</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-video text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">HD Video Call</span>
                                    <span class="text-[9px] text-zinc-500">Encrypted Privacy</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-file-prescription text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">WhatsApp Rx</span>
                                    <span class="text-[9px] text-zinc-500">Digitally Signed</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-sky-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-video text-sm"></i> Start Video Consult Now
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I need an urgent 15-minute video consultation with an MD doctor.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Quick WhatsApp Slot
                                </a>
                            </div>
                        @elseif($currentTheme === 'doctor_landing_diabetes_reversal')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-emerald-500/40 text-emerald-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-emerald-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-chart-line text-emerald-400"></i> 90-DAY DIABETES REVERSAL &bull; LOWER HBA1C SAFELY
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                REVERSE TYPE-2 DIABETES &amp; REDUCE MEDICINES IN 90 DAYS IN <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Clinically proven diabetes remission protocol supervised by senior diabetologists. CGM continuous glucose monitoring, tailored clinical nutrition, and targeted habit coaching.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-heart-pulse text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Lower HbA1c</span>
                                    <span class="text-[9px] text-zinc-500">Clinically Proven</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-mobile-screen text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">CGM Sensor</span>
                                    <span class="text-[9px] text-zinc-500">Real-Time Data</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-prescription text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Med Reduction</span>
                                    <span class="text-[9px] text-zinc-500">Doctor Monitored</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-emerald-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-circle-check text-sm"></i> Join 90-Day Remission Protocol
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to learn more about the 90-Day Diabetes Reversal program.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Diabetologist Chat
                                </a>
                            </div>
                        @elseif($currentTheme === 'doctor_landing_pcod_pcos_clinic')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-pink-500/40 text-pink-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-pink-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-venus text-pink-400"></i> HOLISTIC PCOS/PCOD CLINIC &bull; HORMONE &amp; CYCLE BALANCING
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                NATURALLY RESTORE HORMONAL BALANCE &amp; REGULAR PERIODS IN <span class="bg-gradient-to-r from-pink-400 via-rose-300 to-purple-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Comprehensive clinical PCOS care by leading gynecologists and endocrinologists. Target root causes of irregular cycles, stubborn weight gain, acne, and facial hair.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-calendar-check text-pink-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Cycle Regularity</span>
                                    <span class="text-[9px] text-zinc-500">Natural Flow</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-dna text-purple-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Hormone Panel</span>
                                    <span class="text-[9px] text-zinc-500">Root-Cause Care</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-user-doctor text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Gynecologist MD</span>
                                    <span class="text-[9px] text-zinc-500">Empathetic Care</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-pink-600 to-rose-600 hover:from-pink-500 hover:to-rose-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-pink-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calendar-days text-sm"></i> Book PCOS Assessment
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a confidential consultation for PCOS/PCOD care.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Confidential WhatsApp Desk
                                </a>
                            </div>
                        @elseif($currentTheme === 'doctor_landing_joint_pain_prp')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-bone text-amber-400"></i> REGENERATIVE JOINT CARE &bull; AVOID KNEE SURGERY
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                RELIEVE CHRONIC KNEE &amp; JOINT PAIN WITH ADVANCED PRP IN <span class="bg-gradient-to-r from-amber-400 via-orange-300 to-rose-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                US-FDA approved non-surgical Platelet-Rich Plasma (PRP) therapy and viscosupplementation injections. Restore joint cartilage, eliminate stiffness, and walk pain-free.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-syringe text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Non-Surgical PRP</span>
                                    <span class="text-[9px] text-zinc-500">Day Procedure</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-person-walking text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Walk Pain-Free</span>
                                    <span class="text-[9px] text-zinc-500">Rapid Relief</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-virus text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Autologous Safe</span>
                                    <span class="text-[9px] text-zinc-500">100% Biocompatible</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-400 hover:to-orange-500 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-bone text-sm"></i> Book Knee PRP Evaluation
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to schedule a Knee PRP consultation.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Orthopedic Desk
                                </a>
                            </div>
                        @elseif($currentTheme === 'doctor_landing_hair_loss_trichology')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-purple-500/40 text-purple-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-purple-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-wand-magic-sparkles text-purple-400"></i> MEDICAL TRICHOLOGY CLINIC &bull; GFC &amp; PRP HAIR REGROWTH
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                ADVANCED CLINICAL HAIR REGROWTH &amp; FOLLICLE RESTORATION IN <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Dermatologist-led trichology clinic offering Growth Factor Concentrate (GFC), autologous PRP therapy, and AI scalp dermoscopy. Stop hair thinning and reactivate dormant follicles.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-microscope text-purple-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">AI Scalp Scan</span>
                                    <span class="text-[9px] text-zinc-500">Free Dermoscopy</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-bolt text-pink-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">GFC Therapy</span>
                                    <span class="text-[9px] text-zinc-500">High Concentration</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-user-doctor text-indigo-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Derma MD</span>
                                    <span class="text-[9px] text-zinc-500">Certified Trichologist</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-purple-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-magnifying-glass text-sm"></i> Claim Free Scalp Analysis
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a GFC Hair Regrowth consultation.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Trichologist WhatsApp
                                </a>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-sky-500/40 text-sky-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-sky-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-stethoscope text-sky-400"></i> SPECIALIST OPD CLINIC &bull; ZERO-WAIT DIGITAL CARE
                            </div>

                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                EXPERT MEDICAL CONSULTATIONS &amp; CLINICAL CARE IN <span class="bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>

                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Skip the long OPD queues. Consult certified specialist MD doctors with guaranteed time slots, digital prescriptions, comprehensive diagnostics, and emergency support.
                            </p>

                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-user-doctor text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Verified MDs</span>
                                    <span class="text-[9px] text-zinc-500">Senior Specialists</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-clock text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Zero Waiting</span>
                                    <span class="text-[9px] text-zinc-500">Guaranteed Slot</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-notes-medical text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Digital Token</span>
                                    <span class="text-[9px] text-zinc-500">Instant WhatsApp</span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-sky-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calendar-check"></i> Book Instant OPD Slot
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book an urgent OPD consultation slot.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Helpline
                                </a>
                            </div>
                        @endif

                    @elseif($bizCat === 'Coaching & Institutes' || str_starts_with($currentTheme, 'coaching_landing_'))
                        @if($currentTheme === 'coaching_landing_crash_course_neet_jee')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-red-500/40 text-red-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-red-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-bolt text-red-400"></i> ⚡ 90-DAY CRASH COURSE • NEET &amp; JEE RANK BOOSTER
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                FAST-TRACK 90-DAY CRASH COURSE FOR NEET / JEE ASPIRANTS IN <span class="bg-gradient-to-r from-red-400 via-rose-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Revise full 11th &amp; 12th syllabus with 1200+ high-yield questions, 30 full CBT mocks, Kota star faculty masterclasses, and formula cram books before final exam date.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-fire text-red-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">1200+ Questions</span>
                                    <span class="text-[9px] text-zinc-500">High-Yield Practice</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-laptop-code text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">30 Full Mocks</span>
                                    <span class="text-[9px] text-zinc-500">NTA Pattern CBT</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-chalkboard-user text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Kota Star Faculty</span>
                                    <span class="text-[9px] text-zinc-500">Master Classes</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-red-600 via-rose-600 to-amber-600 hover:from-red-500 hover:to-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-red-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-bolt text-sm"></i> Enroll in 90-Day Crash Course
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want seat reservation and details for the 90-Day NEET/JEE Crash Course.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Crash Course WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'coaching_landing_free_demo_class')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-emerald-500/40 text-emerald-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-emerald-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-chalkboard-user text-emerald-400"></i> 🆓 3 DAYS FREE LIVE DEMO PASS • ZERO FEE
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                ATTEND 3 DAYS FREE LIVE DEMO CLASSES WITH STAR EDUCATORS IN <span class="bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Experience actual Kota faculty classroom teaching before taking admission. 100% free with physical study kit, concept workbook, and personal mentor discussion.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-ticket text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">3 Days Zero Fee</span>
                                    <span class="text-[9px] text-zinc-500">Live Classroom</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-book-open text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Workbook</span>
                                    <span class="text-[9px] text-zinc-500">Concepts Study Bag</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-user-check text-cyan-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Star Faculty Live</span>
                                    <span class="text-[9px] text-zinc-500">Meet in Person</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 hover:from-emerald-500 hover:to-teal-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-emerald-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-ticket text-sm"></i> Claim 3-Day Free Demo Pass
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', please issue my 3-Day Free Live Demo Class Pass.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Instant WhatsApp Pass
                                </a>
                            </div>
                        @elseif($currentTheme === 'coaching_landing_upsc_foundation_batch')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-blue-500/40 text-blue-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-blue-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-landmark text-blue-400"></i> 🏛️ UPSC CIVIL SERVICES 1-YEAR COMPREHENSIVE FOUNDATION
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                MASTER UPSC PRELIMS, MAINS &amp; INTERVIEW WITH EX-BUREAUCRATS IN <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-sky-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Complete GS coverage from NCERTs to advanced Mains answer writing. Personal IAS/IPS mentor assigned, daily editorial analysis, and ₹15,000 early bird waiver.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-scale-balanced text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">IAS Officer Mentor</span>
                                    <span class="text-[9px] text-zinc-500">1-on-1 Guidance</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-feather-pointed text-indigo-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Daily Answer Writing</span>
                                    <span class="text-[9px] text-zinc-500">Mains Evaluation</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-tags text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">₹15,000 Off</span>
                                    <span class="text-[9px] text-zinc-500">Early Bird Pass</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-blue-700 via-indigo-600 to-sky-600 hover:from-blue-600 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-landmark text-sm"></i> Join UPSC Foundation Batch
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want syllabus breakdown and UPSC Foundation batch admission details.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> UPSC Counselor
                                </a>
                            </div>
                        @elseif($currentTheme === 'coaching_landing_coding_placement_bootcamp')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-purple-500/40 text-purple-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-purple-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-code text-purple-400"></i> 🚀 6-MONTH FULL-STACK BOOTCAMP • PAY AFTER PLACEMENT
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                BECOME A HIGH-PAID SOFTWARE DEVELOPER • PAY AFTER YOU GET HIRED IN <span class="bg-gradient-to-r from-purple-400 via-fuchsia-400 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Zero upfront tuition risk. Build 10+ production applications in MERN/Python/GenAI with 1-on-1 code reviews from senior FAANG engineers and guaranteed interview drives.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-hand-holding-dollar text-purple-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Pay When Placed</span>
                                    <span class="text-[9px] text-zinc-500">Zero Upfront Risk</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-briefcase text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Min 6 LPA CTC</span>
                                    <span class="text-[9px] text-zinc-500">150+ Hiring Partners</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-laptop-code text-fuchsia-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">10+ Live Projects</span>
                                    <span class="text-[9px] text-zinc-500">FAANG Code Reviews</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 via-fuchsia-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-purple-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-code text-sm"></i> Apply for Coding Bootcamp Cohort
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to apply for the Pay-After-Placement Coding Bootcamp.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Placement Cell
                                </a>
                            </div>
                        @elseif($currentTheme === 'coaching_landing_study_abroad_visa')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-sky-500/40 text-sky-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-sky-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-passport text-sky-400"></i> 🛂 STUDY IN CANADA, UK, USA &bull; FREE 1-ON-1 VISA COUNSELLING
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                GUARANTEED UNIVERSITY ADMISSION &amp; FAST-TRACK VISA IN <span class="bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Free 45-minute profile assessment with certified overseas counselors. University shortlisting, Band 8+ IELTS prep, scholarship guidance, and 99% visa success rate.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-earth-americas text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Profile Review</span>
                                    <span class="text-[9px] text-zinc-500">45-Min Session</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-language text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Band 8+ IELTS</span>
                                    <span class="text-[9px] text-zinc-500">Certified Trainers</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-file-circle-check text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">99% Visa Success</span>
                                    <span class="text-[9px] text-zinc-500">Fast-Track File</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-600 hover:from-sky-400 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-sky-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calendar-check text-sm"></i> Book Free Visa Counselling
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a free Study Abroad Profile Evaluation session.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Study Abroad Desk
                                </a>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-blue-500/40 text-blue-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-blue-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-award text-amber-400"></i> 🏆 NATIONAL SCHOLARSHIP ADMISSION TEST &bull; UP TO 100% FEE WAIVER
                            </div>

                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                CRACK COMPETITIVE EXAMS WITH UP TO 100% SCHOLARSHIP IN <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>

                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Join intensive rank-booster batches mentored by IITian &amp; Medical alumni. Comprehensive test series, daily 1-on-1 doubt solving, and up to 100% scholarship test pass.
                            </p>

                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-award text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">100% Scholarship</span>
                                    <span class="text-[9px] text-zinc-500">Aptitude Test</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-chalkboard-user text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Demo Class</span>
                                    <span class="text-[9px] text-zinc-500">3 Days Access</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-users text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Small Batches</span>
                                    <span class="text-[9px] text-zinc-500">1-on-1 Doubts</span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-pencil"></i> Register Free Demo Class
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like admission details and free demo pass.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Academic Counselor
                                </a>
                            </div>
                        @endif


                    @elseif($bizCat === 'Real Estate & Properties')
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-teal-500/40 text-teal-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-teal-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-building-circle-check text-teal-400"></i> RERA REGISTERED LUXURY TOWNSHIP &bull; FREE CAB VISIT
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            PRE-LAUNCH LUXURY 2 &amp; 3 BHK RESIDENCES IN <span class="bg-gradient-to-r from-teal-400 via-emerald-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Save up to ₹10 Lakhs with early-bird pre-launch pricing. RERA-approved gated township with 25+ modern amenities and complimentary doorstep AC cab for site visits.
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-shield-halved text-teal-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">RERA Approved</span>
                                <span class="text-[9px] text-zinc-500">100% Clear Title</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-car text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Free Cab Visit</span>
                                <span class="text-[9px] text-zinc-500">Doorstep Pick &amp; Drop</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-building-columns text-emerald-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">80% Bank Loan</span>
                                <span class="text-[9px] text-zinc-500">Pre-Sanctioned</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-400 hover:to-emerald-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-teal-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-car"></i> Book Free Site Visit Cab
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a site visit cab and download brochure.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Download Brochure
                            </a>
                        </div>

                    @elseif($bizCat === 'Herbal Care' || str_starts_with($currentTheme, 'herbal_landing_'))
                        @if($currentTheme === 'herbal_landing_hair_fall_oil')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-emerald-500/40 text-emerald-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-emerald-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-spray-can-sparkles text-emerald-400"></i> 100-DAY HAIR REGROWTH PROTOCOL &bull; 21 HERBS KSHIRPAK
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                STOP SEVERE HAIR FALL &amp; REACTIVATE FOLLICLES NATURALLY IN <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Formulated per classical Charaka Samhita with Bhringraj, Brahmi, and Amla boiled in pure coconut milk. Zero chemicals, 100% money-back promise, and verified results.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-clock-rotate-left text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Stop in 14 Days</span>
                                    <span class="text-[9px] text-zinc-500">Root-Strengthen</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-leaf text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">21 Forest Herbs</span>
                                    <span class="text-[9px] text-zinc-500">Kshirpak Vidhi</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-halved text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Money-Back</span>
                                    <span class="text-[9px] text-zinc-500">100% Guarantee</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-emerald-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-bottle-droplet text-sm"></i> Claim Regrowth Kit (40% Off)
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to order the 100-Day Hair Regrowth Oil.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Vaidya Consultation
                                </a>
                            </div>
                        @elseif($currentTheme === 'herbal_landing_weight_detox_tea')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-orange-500/40 text-orange-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-orange-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-fire text-orange-400"></i> 21-DAY SATVIK METABOLISM &bull; DIGESTIVE AMA FLUSH
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                BURN STUBBORN BELLY FAT &amp; FLUSH GUT TOXINS IN <span class="bg-gradient-to-r from-orange-400 via-amber-400 to-emerald-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Triphala guggul and Garcinia herbal infusion cleanses accumulated digestive Ama toxins, relieves bloating, and accelerates natural fat burn with custom Satvik meal plans.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-fire-burner text-orange-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Flush Toxins</span>
                                    <span class="text-[9px] text-zinc-500">Digestive Ama</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-utensils text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Satvik Diet</span>
                                    <span class="text-[9px] text-zinc-500">Doctor Chart</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-ban text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Zero Laxatives</span>
                                    <span class="text-[9px] text-zinc-500">100% Gentle</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-400 hover:to-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-orange-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-mug-hot text-sm"></i> Start 21-Day Cleanse
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like the 21-Day Belly Detox pass and Satvik diet chart.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Nutritionist WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'herbal_landing_panchakarma_7day_pass')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-teal-500/40 text-teal-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-teal-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-leaf text-teal-400"></i> 7-DAY RESIDENTIAL PANCHAKARMA RETREAT &bull; CELLULAR DETOX
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                EXPERIENCE DEEP CELLULAR HEALING &amp; TRANQUILITY IN <span class="bg-gradient-to-r from-teal-400 via-emerald-300 to-cyan-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Exclusive residential rejuvenation package. Classical Abhyanga, Shirodhara, herbal steam baths, authentic Nadi Pariksha, and luxury private nature villa cottages.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-spa text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Shirodhara</span>
                                    <span class="text-[9px] text-zinc-500">Herbal Tailam</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-tree text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Nature Villa</span>
                                    <span class="text-[9px] text-zinc-500">Private Cottage</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-bowl-rice text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Satvik Dining</span>
                                    <span class="text-[9px] text-zinc-500">Organic Farm</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-400 hover:to-emerald-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-teal-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calendar-check text-sm"></i> Reserve 7-Day Retreat Pass
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book the 7-Day Residential Panchakarma Package.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Retreat Concierge
                                </a>
                            </div>
                        @elseif($currentTheme === 'herbal_landing_skin_glow_kumkumadi')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-gem text-amber-400"></i> GRADE-1 KASHMIRI SAFFRON KUMKUMADI &bull; 7-DAY RADIANCE
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                FADE DARK SPOTS &amp; RESTORE GOLDEN GLOW WITH VEDIC RED GOLD IN <span class="bg-gradient-to-r from-amber-400 via-rose-300 to-purple-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Infused with 26 rare Himalayan herbs and pure Kashmiri red gold saffron. Fades hyperpigmentation, smooths fine lines, and nourishes dull skin with zero parabens.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-award text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Kashmiri Saffron</span>
                                    <span class="text-[9px] text-zinc-500">Pure Grade-1</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-wand-magic-sparkles text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Fade Dark Spots</span>
                                    <span class="text-[9px] text-zinc-500">7-Day Challenge</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-gem text-purple-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Gua Sha</span>
                                    <span class="text-[9px] text-zinc-500">Stone Roller</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 to-rose-600 hover:from-amber-400 hover:to-rose-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-bottle-droplet text-sm"></i> Order Miraculous Beauty Oil
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to order the Kashmiri Saffron Kumkumadi Beauty Oil.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Skin Vaidya WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'herbal_landing_diabetes_madhumeh_churn')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-green-500/40 text-green-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-green-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-chart-line text-green-400"></i> DOCTOR-FORMULATED MADHUMEH CHURN &bull; NATURAL SUGAR CONTROL
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                REGULATE FASTING &amp; POST-MEAL BLOOD SUGAR NATURALLY IN <span class="bg-gradient-to-r from-green-400 via-emerald-300 to-teal-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Potent combination of Gurmar, Jamun seed, Karela, and Methi extracts. Stimulates pancreatic beta cells, reduces sugar cravings, and supports healthy HbA1c levels.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-seedling text-green-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Gurmar &amp; Jamun</span>
                                    <span class="text-[9px] text-zinc-500">Active Extracts</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-heart-pulse text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Beta-Cell Care</span>
                                    <span class="text-[9px] text-zinc-500">Lower Spikes</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-virus text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Zero Side Effects</span>
                                    <span class="text-[9px] text-zinc-500">100% Ayurvedic</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-green-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-prescription text-sm"></i> Order Madhumeh Churn
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want details about the Madhumeh Sugar Control Churn.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Diabetologist Chat
                                </a>
                            </div>
                        @elseif($currentTheme === 'herbal_landing_joint_pain_oil')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-sky-500/40 text-sky-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-sky-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-bone text-sky-400"></i> ORTHOVEDIC MAHANARAYAN OIL &bull; 10-MIN RAPID JOINT COMFORT
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                GET INSTANT RELIEF FROM KNEE &amp; CHRONIC JOINT STIFFNESS IN <span class="bg-gradient-to-r from-sky-400 via-teal-300 to-emerald-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Time-tested classical Maha Narayan Tailam with Gandhapura and Camphor. Penetrates deep into inflamed cartilage, lubricates stiff knees, and restores mobility.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-bolt text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">In 10 Minutes</span>
                                    <span class="text-[9px] text-zinc-500">Fast Absorption</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-person-walking text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Knee Lubrication</span>
                                    <span class="text-[9px] text-zinc-500">Maha Narayan</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-tags text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Buy 1 Get 1</span>
                                    <span class="text-[9px] text-zinc-500">Limited Promo</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-sky-500 to-teal-600 hover:from-sky-400 hover:to-teal-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-sky-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-hand-holding-medical text-sm"></i> Claim Buy 1 Get 1 Free
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want the Buy 1 Get 1 Free offer on Maha Narayan Joint Pain Oil.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Orthopedic Desk
                                </a>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-emerald-500/40 text-emerald-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-emerald-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-leaf text-emerald-400"></i> 100% ORGANIC AYURVEDA &bull; ZERO CHEMICALS
                            </div>

                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                AUTHENTIC AYURVEDIC HEALING &amp; FORMULATIONS IN <span class="bg-gradient-to-r from-emerald-400 via-teal-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>

                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Pure cold-pressed herbal oils, organic immunity formulations, and holistic healing backed by centuries-old Ayurvedic traditions with free certified Vaidya consultations.
                            </p>

                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-seedling text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">100% Organic</span>
                                    <span class="text-[9px] text-zinc-500">GMP Certified</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-user-nurse text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Vaidya Call</span>
                                    <span class="text-[9px] text-zinc-500">Nadi Pariksha</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-truck-fast text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Fast Dispatch</span>
                                    <span class="text-[9px] text-zinc-500">Doorstep Delivery</span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-emerald-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-bag-shopping"></i> Order Herbal Formulations
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like a free Vaidya consultation on WhatsApp.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Free Doctor Call
                                </a>
                            </div>
                        @endif

                    @elseif($bizCat === 'Manufacturers' || str_starts_with($currentTheme, 'mfg_landing_'))
                        @if($currentTheme === 'mfg_landing_custom_oem_rfq')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-blue-500/40 text-blue-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-blue-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-file-contract text-blue-400"></i> INSTANT BLUEPRINT RFQ &bull; 24-HOUR FACTORY QUOTE
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                CUSTOM PRECISION OEM MANUFACTURING IN <span class="bg-gradient-to-r from-blue-400 via-sky-300 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Upload your 2D PDF or 3D STEP drawings. Receive a guaranteed fixed factory quotation with DFM feasibility report and mutual NDA protection within 24 hours.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-stopwatch text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">24-Hr Quote</span>
                                    <span class="text-[9px] text-zinc-500">DFM Feasibility</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-file-pdf text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">CAD / PDF</span>
                                    <span class="text-[9px] text-zinc-500">Instant Upload</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-halved text-indigo-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Strict NDA</span>
                                    <span class="text-[9px] text-zinc-500">IP Protected</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-cloud-arrow-up text-sm"></i> Upload Drawing &amp; Get Quote
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to submit drawings for a custom OEM manufacturing quote.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Factory Head WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'mfg_landing_dealership_distributor_franchise')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-handshake text-amber-400"></i> PAN-INDIA CHANNEL PARTNER &bull; EXCLUSIVE TERRITORY RIGHTS
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                AUTHORIZED INDUSTRIAL DEALERSHIP &amp; DISTRIBUTOR NETWORK IN <span class="bg-gradient-to-r from-amber-400 via-orange-400 to-yellow-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Direct factory partnership for established industrial stockists and traders. Enjoy up to 35% gross operating margins, verified territory exclusivity, and 45-day credit lines.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-chart-line text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">35% Margins</span>
                                    <span class="text-[9px] text-zinc-500">Direct Factory</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-map-location-dot text-orange-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Territory Rights</span>
                                    <span class="text-[9px] text-zinc-500">Exclusive Area</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-building-columns text-yellow-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Credit Terms</span>
                                    <span class="text-[9px] text-zinc-500">45-Day Facility</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-400 hover:to-orange-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-briefcase text-sm"></i> Apply for Dealership
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to apply for the authorized dealership/distributorship in my region.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Commercial Head WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'mfg_landing_contract_packaging_private_label')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-emerald-500/40 text-emerald-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-emerald-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-tag text-emerald-400"></i> TURNKEY CONTRACT PACKING &bull; ZERO CAPEX BRAND LAUNCH
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                PRIVATE LABEL CONTRACT MANUFACTURING &amp; BOTTLING IN <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Launch your consumer brand in 30 days without factory overhead. High-speed automatic bottling, blister packaging, sachet pouching, and FSSAI/GMP compliant formulation.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-rocket text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">30-Day Launch</span>
                                    <span class="text-[9px] text-zinc-500">Zero Factory Setup</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-certificate text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">GMP Certified</span>
                                    <span class="text-[9px] text-zinc-500">ISO 22000 Facility</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-boxes-stacked text-cyan-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Low Pilot MOQ</span>
                                    <span class="text-[9px] text-zinc-500">500 Units Batch</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-emerald-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-wand-magic-sparkles text-sm"></i> Launch Private Label
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to discuss turnkey contract packaging and private label manufacturing.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Packaging Desk WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'mfg_landing_rapid_prototyping_3d_printing')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-purple-500/40 text-purple-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-purple-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-print text-purple-400"></i> 72-HOUR RAPID PROTOTYPING &bull; FUNCTIONAL TEST PARTS
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                PRECISION ADDITIVE &amp; 5-AXIS CNC FUNCTIONAL SAMPLES IN <span class="bg-gradient-to-r from-purple-400 via-fuchsia-300 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Accelerate R&D iterations with aerospace-grade metal DMLS 3D printing and quick-turn CNC machining. Full dimensional CMM inspection report shipped with every sample.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-bolt text-purple-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">72h Turnaround</span>
                                    <span class="text-[9px] text-zinc-500">Courier Dispatch</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-cube text-fuchsia-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">DMLS Metal</span>
                                    <span class="text-[9px] text-zinc-500">Titanium &amp; SS316</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-microscope text-indigo-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">CMM Inspected</span>
                                    <span class="text-[9px] text-zinc-500">10μm Tolerance</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-purple-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-upload text-sm"></i> Upload 3D CAD (.STEP)
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I have a 3D CAD file for functional rapid prototyping.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> R&amp;D Engineer WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'mfg_landing_solar_structural_mounting_oem')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-sky-500/40 text-sky-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-sky-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-solar-panel text-sky-400"></i> UTILITY SOLAR STRUCTURES &bull; 150 KM/H WIND CERTIFIED
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                COLD-ROLL FORMED C/Z SOLAR MOUNTING STRUCTURES IN <span class="bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                PosMAC and Galvalume 550 GSM high-strength mounting structures for ground-mount, tracker, and rooftop solar installations. Wind tunnel certified with 25-year structural anti-corrosion guarantee.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-wind text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">150 km/h Wind</span>
                                    <span class="text-[9px] text-zinc-500">IIT Wind Vetted</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-layer-group text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">PosMAC 550GSM</span>
                                    <span class="text-[9px] text-zinc-500">Heavy Zinc-Alum</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield text-indigo-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">25-Yr Warranty</span>
                                    <span class="text-[9px] text-zinc-500">Zero Rust Guarantee</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-sky-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calculator text-sm"></i> Calculate MW Structure RFQ
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I require pricing and wind load calculations for solar mounting structures.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Solar EPC Desk WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'mfg_landing_export_bulk_container_sourcing')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-teal-500/40 text-teal-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-teal-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-ship text-teal-400"></i> GLOBAL FCL EXPORT SOURCING &bull; PRE-SHIPMENT INSPECTION
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                FACTORY DIRECT EXPORT CONTAINER SOURCING FROM <span class="bg-gradient-to-r from-teal-400 via-emerald-300 to-cyan-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                End-to-end export manufacturing with fumigated wooden palletizing, SGS/Bureau Veritas third-party testing, and customs-cleared FOB/CIF shipping to major global seaports.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-anchor text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">FOB &bull; CIF Delivery</span>
                                    <span class="text-[9px] text-zinc-500">Major Seaports</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-clipboard-check text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">SGS Inspected</span>
                                    <span class="text-[9px] text-zinc-500">Zero-Defect Standard</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-stamp text-cyan-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">LC Accepted</span>
                                    <span class="text-[9px] text-zinc-500">Irrevocable Trade</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-400 hover:to-emerald-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-teal-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-file-invoice text-sm"></i> Request Container Quotation
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like an export FOB/CIF quotation for full container loads.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Export Manager WhatsApp
                                </a>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-blue-500/40 text-blue-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-blue-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-industry text-blue-400"></i> ISO 9001:2015 CERTIFIED MANUFACTURING &bull; PAN-INDIA OEM
                            </div>

                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                HEAVY INDUSTRIAL ENGINEERING &amp; PRECISION MANUFACTURING IN <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-sky-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>

                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                High-precision component machining, heavy structural fabrication, and turnkey contract manufacturing with rigorous CMM quality control and direct factory pricing.
                            </p>

                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-certificate text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">ISO 9001:2015</span>
                                    <span class="text-[9px] text-zinc-500">Certified Quality</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-gears text-indigo-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">10-Micron</span>
                                    <span class="text-[9px] text-zinc-500">Tolerance Spec</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-truck-ramp-box text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Pan-India</span>
                                    <span class="text-[9px] text-zinc-500">Trailer Freight</span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-file-invoice"></i> Request Plant RFQ
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to request an industrial manufacturing quote.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Factory Desk
                                </a>
                            </div>
                        @endif


                    @elseif($isHotelCategory)
                        <!-- EXACT ORIGINAL HOTEL & MOTEL VIP PENTHOUSE -->
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-400 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-crown text-amber-400"></i> EXCLUSIVE VIP RETREAT &bull; PRIVATE MEMBERS &amp; GUESTS
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            THE OBSIDIAN EXPERIENCE — PRIVATE PENTHOUSES IN <span class="bg-gradient-to-r from-amber-300 via-amber-400 to-amber-600 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-400 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Designed for executive privacy, discreet celebrations, and midnight skyline views. Indulge in bespoke penthouse suites, private mixology, and 24/7 VIP concierge butler service.
                        </p>

                        <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                            <div class="p-2">
                                <i class="fa-solid fa-shield-halved text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">100% Privacy</span>
                                <span class="text-[9px] text-zinc-500">Discreet Keycard</span>
                            </div>
                            <div class="p-2 border-x border-zinc-800">
                                <i class="fa-solid fa-car text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">VIP Transfer</span>
                                <span class="text-[9px] text-zinc-500">Chauffeur Ready</span>
                            </div>
                            <div class="p-2">
                                <i class="fa-solid fa-martini-glass-citrus text-amber-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] font-bold text-zinc-300 block">Skyline Lounge</span>
                                <span class="text-[9px] text-zinc-500">Rooftop Access</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-crown"></i> Reserve VIP Penthouse
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve a VIP Suite.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> VIP Concierge WhatsApp
                            </a>
                        </div>

                    @elseif($bizCat === 'Other Retail' || str_starts_with($currentTheme, 'retail_landing_'))
                        @if($currentTheme === 'retail_landing_mega_clearance_sale')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-red-500/40 text-red-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-red-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-fire text-red-400"></i> ANNUAL MEGA CLEARANCE &bull; UP TO 70% OFF STOREWIDE
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                MIDNIGHT MEGA CLEARANCE SALE &amp; DOORBUSTER DEALS IN <span class="bg-gradient-to-r from-red-400 via-rose-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Everything must go! Flat 50% to 70% off on premium apparel, footwear, accessories, and home goods. First 100 walk-in shoppers get a complimentary ₹1,000 gift voucher.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-percent text-red-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Up to 70% Off</span>
                                    <span class="text-[9px] text-zinc-500">Doorbuster Steals</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-gift text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free ₹1,000</span>
                                    <span class="text-[9px] text-zinc-500">First 100 Shoppers</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-stopwatch text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">24h Countdown</span>
                                    <span class="text-[9px] text-zinc-500">Stock Depletion</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-red-600 via-rose-600 to-amber-600 hover:from-red-500 hover:to-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-red-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-fire text-sm"></i> Claim Clearance Voucher
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to claim my ₹1,000 voucher and clearance deals.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Flash Deals
                                </a>
                            </div>
                        @elseif($currentTheme === 'retail_landing_festive_bridal_combo')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-pink-500/40 text-pink-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-pink-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-crown text-pink-400"></i> BRIDAL TROUSSEAU COMBO &bull; FLAT 35% OFF
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                ROYAL WEDDING TROUSSEAU &amp; BRIDAL JEWELRY COMBO IN <span class="bg-gradient-to-r from-pink-400 via-rose-300 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Complete 5-outfit wedding trousseau wardrobe with matching handcrafted artisan Kundan jewelry set. Free 1-on-1 celebrity bridal styling session and custom couture fitting trials.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-vest text-pink-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">5 Outfits</span>
                                    <span class="text-[9px] text-zinc-500">Complete Trousseau</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-gem text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Kundan Set</span>
                                    <span class="text-[9px] text-zinc-500">₹15,000 Value Free</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-scissors text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Bespoke Fit</span>
                                    <span class="text-[9px] text-zinc-500">Master Karigari</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-pink-600 via-rose-600 to-amber-500 hover:from-pink-500 hover:to-amber-400 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-pink-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-wand-magic-sparkles text-sm"></i> Reserve Bridal Trousseau Slot
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a private bridal trousseau and jewelry consultation.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Bridal Stylist WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'retail_landing_smartphone_exchange_bonus')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-blue-500/40 text-blue-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-blue-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-mobile-screen-button text-blue-400"></i> 5G EXCHANGE CARNIVAL &bull; EXTRA ₹5,000 BONUS
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                UPGRADE TO LATEST 5G SMARTPHONES WITH ZERO DOWN PAYMENT IN <span class="bg-gradient-to-r from-blue-400 via-sky-300 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Bring any old working smartphone and get guaranteed instant valuation plus flat ₹5,000 extra trade-in bonus. 0% interest 12-month paperless EMI and complimentary military-grade tempered glass.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-mobile-screen-button text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">+₹5,000 Extra</span>
                                    <span class="text-[9px] text-zinc-500">Exchange Bonus</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-credit-card text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">0% Easy EMI</span>
                                    <span class="text-[9px] text-zinc-500">Zero Down Payment</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield text-sky-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free 9H Guard</span>
                                    <span class="text-[9px] text-zinc-500">Military Tempered</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calculator text-sm"></i> Check Old Phone Value
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to exchange my old smartphone for a new 5G phone with ₹5,000 bonus.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> 5G Exchange WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'retail_landing_modular_kitchen_makeover')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-kitchen-set text-amber-400"></i> 21-DAY MODULAR KITCHEN &bull; FREE CHIMNEY &amp; HOB
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                TRANSFORM YOUR HOME WITH GERMAN MODULAR KITCHEN IN <span class="bg-gradient-to-r from-amber-400 via-orange-400 to-yellow-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                100% waterproof boiling waterproof marine ply cabinets with German soft-close tandem runners. Get a free auto-clean motion sensor kitchen chimney and 3-burner gas hob worth ₹18,000.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-kitchen-set text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">21-Day Handover</span>
                                    <span class="text-[9px] text-zinc-500">Turnkey Setup</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-wand-magic-sparkles text-orange-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Chimney</span>
                                    <span class="text-[9px] text-zinc-500">₹18,000 Value Free</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-halved text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">10-Yr Warranty</span>
                                    <span class="text-[9px] text-zinc-500">Marine BWP Ply</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-400 hover:to-orange-500 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-compass-drafting text-sm"></i> Book Free 3D Kitchen Design
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a free 3D home visit for modular kitchen makeover.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Kitchen Expert WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'retail_landing_vip_loyalty_gold_pass')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-yellow-500/40 text-yellow-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-yellow-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-credit-card text-yellow-400"></i> VIP GOLD PRIVILEGE PASS &bull; FLAT ₹500 WELCOME GIFT
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                GET 1-YEAR VIP GOLD MEMBERSHIP &amp; UNLIMITED FREE HOME DELIVERY IN <span class="bg-gradient-to-r from-yellow-300 via-amber-400 to-orange-400 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Exclusive club pass for smart shoppers. Enjoy flat 15% cashback on every store bill, 24-hour early access to seasonal sales, free express home delivery, and dedicated personal shopping concierge.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-coins text-yellow-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">15% Cashback</span>
                                    <span class="text-[9px] text-zinc-500">On Every Bill</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-truck-fast text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Express</span>
                                    <span class="text-[9px] text-zinc-500">Unlimited Delivery</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-gift text-orange-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">₹500 Welcome</span>
                                    <span class="text-[9px] text-zinc-500">Instant Voucher</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-yellow-500 via-amber-500 to-orange-500 hover:from-yellow-400 hover:to-orange-400 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-yellow-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-crown text-sm"></i> Activate VIP Gold Pass
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to join the 1-Year VIP Gold Shopper Membership.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> VIP Concierge WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'retail_landing_corporate_festive_gift_hamper')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-emerald-500/40 text-emerald-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-emerald-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-gift text-emerald-400"></i> CORPORATE GIFTING SUITE &bull; BULK GST SAVINGS
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                LUXURY GOURMET GIFT HAMPERS &amp; CUSTOM BRANDED BOXES IN <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Handcrafted royal festive gift boxes with laser engraved company logo, vacuum-packed Afghan dry fruits, artisanal chocolates, and 100% GST tax invoices with express multi-location corporate shipping.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-box-open text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Custom Branding</span>
                                    <span class="text-[9px] text-zinc-500">Laser Engraved</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-jar text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Grade-A Nuts</span>
                                    <span class="text-[9px] text-zinc-500">Vacuum Nitrogen</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-receipt text-cyan-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">100% GST Bill</span>
                                    <span class="text-[9px] text-zinc-500">Tax Input Credit</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-emerald-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-file-invoice text-sm"></i> Request Hamper Catalog &amp; Quote
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to inquire about corporate gift hampers and sample box dispatch.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Corporate Gifting Desk
                                </a>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-bolt text-amber-400"></i> MEGA FLASH SALE &bull; FLAT 40% OFF TODAY ONLY
                            </div>

                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                EXCLUSIVE RETAIL OFFERS &amp; NEW ARRIVALS IN <span class="bg-gradient-to-r from-amber-400 via-orange-400 to-rose-400 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>

                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Shop premium collections, everyday essentials, and exclusive brand deals at unbeatable prices. Guaranteed quality and superfast WhatsApp ordering with direct doorstep delivery.
                            </p>

                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-tags text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Flat 40% Off</span>
                                    <span class="text-[9px] text-zinc-500">Today's Deals</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-truck-fast text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Fast Delivery</span>
                                    <span class="text-[9px] text-zinc-500">At Doorstep</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-halved text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">100% Genuine</span>
                                    <span class="text-[9px] text-zinc-500">Verified Products</span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 via-orange-500 to-rose-600 hover:from-amber-400 hover:to-rose-500 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-bag-shopping"></i> Claim Flash Discount Now
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to order products from today\'s flash sale.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Order on WhatsApp
                                </a>
                            </div>
                        @endif
                    @elseif($bizCat === 'Restaurant & Cafes' || str_starts_with($currentTheme, 'rest_landing_'))
                        @if($currentTheme === 'rest_landing_unlimited_grand_buffet')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-rose-500/40 text-rose-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-rose-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-fire text-rose-400"></i> SUNDAY GRAND BUFFET &bull; 50+ DISHES AT FLAT ₹599
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                UNLIMITED ROYAL BUFFET FEAST &amp; LIVE BARBEQUE IN <span class="bg-gradient-to-r from-rose-400 via-orange-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Unlimited indulgence! 12 sizzling kebabs, live chaat counter, authentic dum biryanis, and 8 dessert stations. Book your early bird table pass now before slots run out.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-utensils text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">50+ Dishes</span>
                                    <span class="text-[9px] text-zinc-500">Live Food Counters</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-fire text-orange-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Live BBQ</span>
                                    <span class="text-[9px] text-zinc-500">Grilled at Table</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-ticket text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Flat ₹599</span>
                                    <span class="text-[9px] text-zinc-500">All-Inclusive Pass</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-rose-600 via-orange-600 to-amber-600 hover:from-rose-500 hover:to-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-rose-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-ticket text-sm"></i> Claim ₹599 Buffet Pass
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book the Sunday Grand Buffet Pass for my family.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Reserve Table WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'rest_landing_banquet_party_hall_celebration')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-purple-500/40 text-purple-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-purple-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-champagne-glasses text-purple-400"></i> AC BANQUET &amp; PARTY HALL &bull; ALL-INCLUSIVE PACKAGE
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                BIRTHDAYS, ANNIVERSARIES &amp; PRIVATE PARTIES IN <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Host unforgettable parties for 50 to 250 guests. Central AC banquet, premium balloon &amp; floral theme decor, DJ sound console, and 4-course unlimited multi-cuisine feast from ₹750/plate.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-building-wheat text-purple-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Zero Hall Rent</span>
                                    <span class="text-[9px] text-zinc-500">Pay Only for Food</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-music text-pink-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">DJ Sound Console</span>
                                    <span class="text-[9px] text-zinc-500">Complimentary Setup</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-cake-candles text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Decor</span>
                                    <span class="text-[9px] text-zinc-500">Balloon &amp; Lighting</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 via-pink-600 to-amber-600 hover:from-purple-500 hover:to-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-purple-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calendar-check text-sm"></i> Check Hall Dates &amp; Quote
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to inquire about booking the Banquet Hall for a celebration.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Banquet Desk WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'rest_landing_midnight_cravings_flash_deal')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-red-500/40 text-red-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-red-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-moon text-red-400"></i> MIDNIGHT CRAVINGS FEST &bull; FLAT 40% OFF TILL 4 AM
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                PIPING HOT BIRYANI, ROLLS &amp; BURGERS TILL 4 AM IN <span class="bg-gradient-to-r from-red-400 via-orange-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Late-night hunger strikes? Earthen handi biryani, juicy smashed burgers, Kolkata kathi rolls, and warm chocolate brownies delivered piping hot to your doorstep in 25 minutes.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-clock text-red-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Open Till 4 AM</span>
                                    <span class="text-[9px] text-zinc-500">Every Night</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-bolt text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">25-Min Delivery</span>
                                    <span class="text-[9px] text-zinc-500">Hot &amp; Fresh</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-tag text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Flat 40% Off</span>
                                    <span class="text-[9px] text-zinc-500">Use Code MIDNIGHT</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-red-600 via-rose-600 to-amber-600 hover:from-red-500 hover:to-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-red-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-motorcycle text-sm"></i> Order Midnight Delivery (40% Off)
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to order late night delivery with the 40% discount.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Midnight Order
                                </a>
                            </div>
                        @elseif($currentTheme === 'rest_landing_corporate_executive_lunch_catering')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-blue-500/40 text-blue-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-blue-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-briefcase text-blue-400"></i> CORPORATE LUNCHEON &amp; BENTO BOXES &bull; FROM ₹180/BOX
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                HOT EXECUTIVE MEAL BOXES &amp; OFFICE CATERING IN <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Upgrade your team meetings and office seminars. 100% sanitized, hot-insulated 5-compartment gourmet bento meals with GST invoices, custom branded cutlery, and free executive sample tasting.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-box text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">From ₹180/Box</span>
                                    <span class="text-[9px] text-zinc-500">5-Compartment Meal</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-receipt text-indigo-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">GST Input Tax</span>
                                    <span class="text-[9px] text-zinc-500">Corporate Invoicing</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-truck-fast text-cyan-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Sample Box</span>
                                    <span class="text-[9px] text-zinc-500">For HR / Admin</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-file-invoice text-sm"></i> Request Corporate Tasting &amp; Menu
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to request sample bento boxes for my company.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Corporate Catering WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'rest_landing_romantic_candlelight_dinner')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-pink-500/40 text-pink-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-pink-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-heart text-pink-400"></i> ROOFTOP CANDLELIGHT DINNER &bull; VIP COUPLE CABANA
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                MAGICAL CANDLELIGHT DINNER &amp; 4-COURSE CHEF TASTING IN <span class="bg-gradient-to-r from-pink-400 via-rose-300 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Celebrate your anniversary or date night under starry skies. Rose petal decorated private rooftop cabana, complimentary sparkling wine/mocktails, heart cake, and personalized 4-course dining.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-champagne-glasses text-pink-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Private Cabana</span>
                                    <span class="text-[9px] text-zinc-500">Rose Petal Setup</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-cake-candles text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Complimentary Cake</span>
                                    <span class="text-[9px] text-zinc-500">Heart Anniversary</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-user-tie text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Dedicated Butler</span>
                                    <span class="text-[9px] text-zinc-500">Private Service</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-pink-600 via-rose-600 to-amber-600 hover:from-pink-500 hover:to-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-pink-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-heart text-sm"></i> Reserve VIP Couple Cabana
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a private candlelight dinner cabana for my anniversary.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Candlelight Desk WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'rest_landing_wedding_festive_outdoor_catering')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-crown text-amber-400"></i> ROYAL WEDDING &amp; OUTDOOR CATERING &bull; 100 TO 2,000+ GUESTS
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                GRAND ROYAL WEDDING CATERING &amp; LIVE FOOD STALLS IN <span class="bg-gradient-to-r from-amber-400 via-orange-400 to-yellow-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Spectacular wedding banquet hospitality. Live woodfired tandoor, Turkish kebab station, artisanal pasta wheels, pure ghee royal Indian gravies, authentic Halwai desserts, and 5-star trained service stewards.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-fire-burner text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Live Global Stalls</span>
                                    <span class="text-[9px] text-zinc-500">Chaat, Pasta &amp; Grills</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-utensils text-orange-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Royal Halwai</span>
                                    <span class="text-[9px] text-zinc-500">Pure Ghee Sweets</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-wine-glass text-yellow-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Free Tasting</span>
                                    <span class="text-[9px] text-zinc-500">4-Person Family Trial</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 via-orange-500 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-bowl-food text-sm"></i> Book Free Wedding Food Tasting
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a wedding catering food tasting session.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Catering Manager WhatsApp
                                </a>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-rose-500/40 text-rose-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-rose-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-utensils text-rose-400"></i> GOURMET CHEF SPECIALS &bull; TABLE RESERVATIONS
                            </div>

                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                EXQUISITE ARTISANAL CUISINE &amp; FINE DINING IN <span class="bg-gradient-to-r from-rose-400 via-orange-400 to-amber-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>

                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Explore chef-curated culinary artistry, locally sourced fresh ingredients, and exceptional dining ambience. Book your preferred dining table or order directly via WhatsApp.
                            </p>

                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-star text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Chef Specials</span>
                                    <span class="text-[9px] text-zinc-500">Signature Recipes</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-calendar-check text-rose-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Table Booking</span>
                                    <span class="text-[9px] text-zinc-500">Zero Wait Time</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-bell-concierge text-orange-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Warm Hospitality</span>
                                    <span class="text-[9px] text-zinc-500">Fine Ambience</span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-rose-600 via-orange-600 to-amber-600 hover:from-rose-500 hover:to-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-rose-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-chair"></i> Reserve Dining Table
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve a table for dining.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Desk
                                </a>
                            </div>
                        @endif
                    @elseif($bizCat === 'Other Services' || str_starts_with($currentTheme, 'service_landing_'))
                        @if($currentTheme === 'service_landing_emergency_plumbing_electrical')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-red-500/40 text-red-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-red-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-faucet-drip text-red-400"></i> 24/7 RAPID EMERGENCY DISPATCH &bull; 30-MIN DOORSTEP ETA
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                EMERGENCY PLUMBING, BURST PIPES &amp; ELECTRICAL BREAKDOWN IN <span class="bg-gradient-to-r from-red-400 via-amber-400 to-orange-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Immediate technician arrival for severe pipe bursts, overhead tank overflow, short circuits, electrical fires, and main MCB failures. Certified master plumbers and wiremen with transparent upfront pricing.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-truck-fast text-red-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">30-Min Arrival</span>
                                    <span class="text-[9px] text-zinc-500">Rapid Doorstep ETA</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-shield-halved text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Master Pros</span>
                                    <span class="text-[9px] text-zinc-500">Licensed Wiremen</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-receipt text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Zero Surge</span>
                                    <span class="text-[9px] text-zinc-500">100% Fixed Rates</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-red-600 via-rose-600 to-amber-600 hover:from-red-500 hover:to-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-red-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-triangle-exclamation text-sm"></i> Dispatch Emergency Technician
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I have an URGENT emergency breakdown (plumbing/electrical). Please dispatch a technician immediately.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Emergency SOS WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'service_landing_gst_tax_audit_notice_resolution')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-gavel text-amber-400"></i> URGENT TAX DEFENSE &bull; NOTICE SCRUTINY WITHIN 2 HOURS
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                URGENT GST &amp; INCOME TAX NOTICE SCRUTINY &amp; AUDIT DEFENSE IN <span class="bg-gradient-to-r from-amber-400 via-orange-400 to-yellow-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Received a Section 148, 143(1), or GST DRC-01 show-cause notice? Get urgent 2-hour assessment by ex-IRS officers and senior Chartered Accountants. Complete penalty shield and confidential defense drafting.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-clock text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">2-Hr Review</span>
                                    <span class="text-[9px] text-zinc-500">Notice Scrutiny</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-user-tie text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Ex-IRS Panel</span>
                                    <span class="text-[9px] text-zinc-500">Senior Tax CAs</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-halved text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Penalty Shield</span>
                                    <span class="text-[9px] text-zinc-500">Legal Protection</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 via-orange-500 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-file-shield text-sm"></i> Request Immediate Notice Review
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I received a tax/GST notice and require urgent confidential legal evaluation.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Tax Litigator WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'service_landing_termite_rodent_pest_free_pass')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-emerald-500/40 text-emerald-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-emerald-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-bug text-emerald-400"></i> 1-YEAR GUARANTEED DRILL PROTECTION &bull; 100% ODORLESS
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                1-YEAR GUARANTEED TERMITE DRILLING &amp; PEST ERADICATION PASS IN <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-yellow-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Protect your home foundation, door frames, and wooden furniture from termite decay. Odorless subterranean drill and inject barrier, child-safe German chemicals, and free 12-month re-treatment warranty.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-certificate text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">1-Yr Warranty</span>
                                    <span class="text-[9px] text-zinc-500">Official Certificate</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-syringe text-teal-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Drill &amp; Inject</span>
                                    <span class="text-[9px] text-zinc-500">Odorless Barrier</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-dog text-green-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Pet &amp; Child Safe</span>
                                    <span class="text-[9px] text-zinc-500">Zero Toxicity</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-600 via-teal-600 to-green-600 hover:from-emerald-500 hover:to-green-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-emerald-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-shield-virus text-sm"></i> Claim 1-Year Termite Pass
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book a free termite inspection and 1-year warranty pass.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Pest Specialist WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'service_landing_corporate_annual_housekeeping_contract')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-cyan-500/40 text-cyan-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-cyan-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-building text-cyan-400"></i> 30-DAY RISK-FREE PILOT &bull; CORPORATE FACILITY AMC
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                ANNUAL COMMERCIAL OFFICE HOUSEKEEPING &amp; FACILITY AMC IN <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-indigo-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Elevate workplace hygiene and compliance. Uniformed background-verified housekeeping staff, mechanized floor scrubbers, eco-friendly green chemicals, and full GST input tax invoicing.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-calendar-check text-cyan-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">30-Day Pilot</span>
                                    <span class="text-[9px] text-zinc-500">Zero Risk Trial</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-user-shield text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Verified Staff</span>
                                    <span class="text-[9px] text-zinc-500">Police Checked</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-file-invoice-dollar text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">GST Input</span>
                                    <span class="text-[9px] text-zinc-500">100% Tax Compliant</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600 hover:from-cyan-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-cyan-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-handshake text-sm"></i> Request 30-Day Corporate AMC Pilot
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to request an office site survey for an annual housekeeping contract.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Facility Manager WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'service_landing_iso_certification_fasttrack')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-purple-500/40 text-purple-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-purple-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-certificate text-purple-400"></i> 🏅 7-DAY ACCREDITED CERTIFICATION &bull; 100% PASS GUARANTEE
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                FAST-TRACK ISO 9001 / 27001 / 14001 CERTIFICATION IN <span class="bg-gradient-to-r from-purple-400 via-fuchsia-400 to-pink-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Become tender-ready and win institutional clients. Complete audit documentation, quality manuals, internal gap analysis, and accredited ISO certificate dispatch within 7 working days.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-bolt text-purple-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">7-Day SLA</span>
                                    <span class="text-[9px] text-zinc-500">Fast-Track Delivery</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-stamp text-fuchsia-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">IAF Accredited</span>
                                    <span class="text-[9px] text-zinc-500">Global Recognition</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-file-lines text-pink-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Full Manuals</span>
                                    <span class="text-[9px] text-zinc-500">100% Audit Ready</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 via-fuchsia-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-purple-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-award text-sm"></i> Get Fast-Track ISO Quote
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to get ISO certification (9001/27001/14001) for my business.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> ISO Lead Auditor WhatsApp
                                </a>
                            </div>
                        @elseif($currentTheme === 'service_landing_solar_rooftop_epc_installation')
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-orange-500/40 text-orange-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-orange-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-solar-panel text-orange-400"></i> ☀️ FLAT ₹78,000 DIRECT GOVT SUBSIDY &bull; PM SURYA GHAR
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                RESIDENTIAL &amp; COMMERCIAL ROOFTOP SOLAR EPC IN <span class="bg-gradient-to-r from-orange-400 via-amber-400 to-yellow-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Slash electricity bills to zero with PM Surya Ghar Muft Bijli Yojana. Tier-1 monocrystalline panels, 25-year performance warranty, seamless DISCOM net metering sanction, and central subsidy credited to your bank account.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-money-bill-transfer text-orange-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">₹78K Subsidy</span>
                                    <span class="text-[9px] text-zinc-500">Direct In Bank</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-shield-halved text-amber-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">25-Yr Warranty</span>
                                    <span class="text-[9px] text-zinc-500">Tier-1 Mono Panels</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-bolt text-yellow-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Zero Bill</span>
                                    <span class="text-[9px] text-zinc-500">Net Metering Handled</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-orange-500 via-amber-500 to-yellow-500 hover:from-orange-400 hover:to-yellow-400 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-orange-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calculator text-sm"></i> Check Rooftop Solar Feasibility
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to check rooftop solar feasibility and government subsidy for my home/office.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Solar EPC Engineer WhatsApp
                                </a>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-indigo-500/40 text-indigo-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-indigo-500/10 backdrop-blur-md">
                                <i class="fa-solid fa-briefcase text-indigo-400"></i> EXPERT PROFESSIONAL SERVICES &bull; VERIFIED ADVISORY
                            </div>
                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                                PREMIER PROFESSIONAL SOLUTIONS &amp; ADVISORY IN <span class="bg-gradient-to-r from-indigo-400 via-blue-400 to-teal-300 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                            </h1>
                            <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                Proven professional expertise tailored to your business and residential needs. Consult with accredited specialists, transparent pricing, and instant WhatsApp support.
                            </p>
                            <div class="bg-zinc-900/70 border border-zinc-700/80 rounded-2xl p-4 max-w-lg mx-auto lg:mx-0 backdrop-blur-md grid grid-cols-3 gap-3 text-center">
                                <div class="p-2">
                                    <i class="fa-solid fa-award text-indigo-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Verified Pros</span>
                                    <span class="text-[9px] text-zinc-500">Certified Experts</span>
                                </div>
                                <div class="p-2 border-x border-zinc-800">
                                    <i class="fa-solid fa-handshake text-blue-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">Transparent</span>
                                    <span class="text-[9px] text-zinc-500">Upfront Quotes</span>
                                </div>
                                <div class="p-2">
                                    <i class="fa-solid fa-shield-halved text-emerald-400 text-lg mb-1 block"></i>
                                    <span class="text-[11px] font-bold text-zinc-300 block">100% Quality</span>
                                    <span class="text-[9px] text-zinc-500">Satisfaction Assured</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-indigo-600 via-blue-600 to-teal-600 hover:from-indigo-500 hover:to-teal-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-indigo-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-calendar-check"></i> Book Consultation
                                </a>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to inquire about your professional services.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Helpdesk
                                </a>
                            </div>
                        @endif
                    @else
                        <!-- General / Universal Fallback -->
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-amber-500/40 text-amber-300 text-xs font-black tracking-widest uppercase shadow-lg shadow-amber-500/10 backdrop-blur-md">
                            <i class="fa-solid fa-star text-amber-400"></i> PREMIER LOCAL EXCELLENCE &bull; {{ $tenant->city ?: 'YOUR CITY' }}
                        </div>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] text-white">
                            DISCOVER EXCEPTIONAL QUALITY &amp; VALUE IN <span class="bg-gradient-to-r from-amber-400 via-orange-400 to-rose-400 bg-clip-text text-transparent">{{ $cityUpper }}</span>
                        </h1>

                        <p class="text-base sm:text-lg text-zinc-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Providing dependable service, verified quality, and fast WhatsApp order support." }}
                        </p>

                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                            <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-amber-500 via-orange-500 to-rose-600 hover:from-amber-400 hover:to-rose-500 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                <i class="fa-solid fa-arrow-right"></i> Explore Offerings
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like more information.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> WhatsApp Us
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Right 5 Cols: Photo matching category -->
                <div class="lg:col-span-5">
                    @php
                        if ($currentTheme === 'salon_landing_hair_botox') {
                            $heroImg = 'https://images.unsplash.com/photo-1519699047748-de8e457a634e?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 4.9 FLASH VOUCHER';
                            $imgBadge = 'Keratin & Botox Offer';
                        } elseif ($currentTheme === 'salon_landing_hydrafacial') {
                            $heroImg = 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 GLOW RESULT';
                            $imgBadge = '7-Step HydraFacial';
                        } elseif ($currentTheme === 'salon_landing_spa_pass') {
                            $heroImg = 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 SPA PASS';
                            $imgBadge = 'Ayurvedic Detox Pass';
                        } elseif ($currentTheme === 'salon_landing_men_club') {
                            $heroImg = 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 4.9 BARBER COMBO';
                            $imgBadge = 'VIP Grooming Club';
                        } elseif ($currentTheme === 'salon_landing_nail_lash') {
                            $heroImg = 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 INTRO PASS';
                            $imgBadge = 'Gel Nails & Lash Lift';
                        } elseif ($currentTheme === 'clinic_landing_health_checkup') {
                            $heroImg = 'https://images.unsplash.com/photo-1579165466791-788226ab77b6?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 60% OFF CHECKUP';
                            $imgBadge = '85-Parameter NABL Lab';
                        } elseif ($currentTheme === 'clinic_landing_dental_laser') {
                            $heroImg = 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 PAINLESS LASER';
                            $imgBadge = 'Free 3D Digital X-Ray';
                        } elseif ($currentTheme === 'clinic_landing_lasik_vision') {
                            $heroImg = 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 10-MIN SPECTACLE FREEDOM';
                            $imgBadge = 'Robotic Femto LASIK';
                        } elseif ($currentTheme === 'clinic_landing_knee_replacement') {
                            $heroImg = 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ NEXT-DAY WALKING';
                            $imgBadge = 'Robotic Knee Center';
                        } elseif ($currentTheme === 'clinic_landing_maternity_package') {
                            $heroImg = 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 LUXURY BIRTHING';
                            $imgBadge = 'Private Maternity Suite';
                        } elseif ($currentTheme === 'clinic_landing_urgent_opd') {
                            $heroImg = 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 ZERO-WAIT OPD';
                            $imgBadge = 'Senior MD Specialists';
                        } elseif ($currentTheme === 'doctor_landing_second_opinion') {
                            $heroImg = 'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 SECOND OPINION';
                            $imgBadge = 'Senior Super-Specialists';
                        } elseif ($currentTheme === 'doctor_landing_teleconsult_urgent') {
                            $heroImg = 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 15-MIN TELECONSULT';
                            $imgBadge = 'Instant WhatsApp Rx';
                        } elseif ($currentTheme === 'doctor_landing_diabetes_reversal') {
                            $heroImg = 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 90-DAY REMISSION';
                            $imgBadge = 'Clinical Diabetologist';
                        } elseif ($currentTheme === 'doctor_landing_pcod_pcos_clinic') {
                            $heroImg = 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 PCOS CLINIC';
                            $imgBadge = 'Hormone & Cycle Balance';
                        } elseif ($currentTheme === 'doctor_landing_joint_pain_prp') {
                            $heroImg = 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ NON-SURGICAL PRP';
                            $imgBadge = 'Knee Joint Care Desk';
                        } elseif ($currentTheme === 'doctor_landing_hair_loss_trichology') {
                            $heroImg = 'https://images.unsplash.com/photo-1512290900672-1f4967396752?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ GFC & PRP REGROWTH';
                            $imgBadge = 'Certified Trichology';
                        } elseif ($bizCat === 'Beauty & Salons' || $currentTheme === 'dark_luxury') {
                            $heroImg = 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 BRIDAL HD';
                            $imgBadge = 'Obsidian Bridal Lounge';
                        } elseif (in_array($bizCat, ['Clinics & Hospitals', 'Doctors & Specialists'])) {
                            $heroImg = 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 PATIENT RATING';
                            $imgBadge = 'Multi-Specialty Clinic';
                        } elseif ($currentTheme === 'coaching_landing_crash_course_neet_jee') {
                            $heroImg = 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 90-DAY CRASH BATCH';
                            $imgBadge = 'NEET/JEE Rank Booster';
                        } elseif ($currentTheme === 'coaching_landing_free_demo_class') {
                            $heroImg = 'https://images.unsplash.com/photo-1577896851231-70ef18881754?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 3 DAYS ZERO FEE';
                            $imgBadge = 'Live Classroom Demo';
                        } elseif ($currentTheme === 'coaching_landing_upsc_foundation_batch') {
                            $heroImg = 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ UPSC FOUNDATION 2026';
                            $imgBadge = 'Ex-Bureaucrats Mentorship';
                        } elseif ($currentTheme === 'coaching_landing_coding_placement_bootcamp') {
                            $heroImg = 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ PAY AFTER PLACEMENT';
                            $imgBadge = 'Full-Stack Web Dev Cohort';
                        } elseif ($currentTheme === 'coaching_landing_study_abroad_visa') {
                            $heroImg = 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 99% VISA SUCCESS';
                            $imgBadge = 'Global Education Desk';
                        } elseif ($currentTheme === 'coaching_landing_scholarship_admission' || $bizCat === 'Coaching & Institutes') {
                            $heroImg = 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ UP TO 100% SCHOLARSHIP';
                            $imgBadge = 'National Talent Exam';
                        } elseif ($currentTheme === 'mfg_landing_custom_oem_rfq') {
                            $heroImg = 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 24H BLUEPRINT RFQ';
                            $imgBadge = 'Precision OEM Engineering';
                        } elseif ($currentTheme === 'mfg_landing_dealership_distributor_franchise') {
                            $heroImg = 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 35% GROSS MARGIN';
                            $imgBadge = 'Regional Distributor';
                        } elseif ($currentTheme === 'mfg_landing_contract_packaging_private_label') {
                            $heroImg = 'https://images.unsplash.com/photo-1581093588401-fbb62a02f120?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 30-DAY BRAND LAUNCH';
                            $imgBadge = 'GMP Contract Packaging';
                        } elseif ($currentTheme === 'mfg_landing_rapid_prototyping_3d_printing') {
                            $heroImg = 'https://images.unsplash.com/photo-1581092162384-8987c1d64718?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 72H DISPATCH';
                            $imgBadge = 'DMLS Metal 3D Samples';
                        } elseif ($currentTheme === 'mfg_landing_solar_structural_mounting_oem') {
                            $heroImg = 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 150 KM/H CERTIFIED';
                            $imgBadge = 'Utility Solar Structures';
                        } elseif ($currentTheme === 'mfg_landing_export_bulk_container_sourcing') {
                            $heroImg = 'https://images.unsplash.com/photo-1586528116493-a029325540fa?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ GLOBAL FCL SOURCING';
                            $imgBadge = 'SGS Inspected Shipments';
                        } elseif ($bizCat === 'Manufacturers') {
                            $heroImg = 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ ISO 9001:2015';
                            $imgBadge = 'Certified OEM Plant';
                        } elseif ($bizCat === 'Real Estate & Properties') {
                            $heroImg = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ RERA APPROVED';
                            $imgBadge = 'Flagship Township';
                        } elseif ($currentTheme === 'rest_landing_unlimited_grand_buffet') {
                            $heroImg = 'https://images.unsplash.com/photo-1541544741938-0af808871cc0?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ FLAT ₹599 BUFFET';
                            $imgBadge = '50+ Item Royal Feast';
                        } elseif ($currentTheme === 'rest_landing_banquet_party_hall_celebration') {
                            $heroImg = 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ ZERO HALL RENT';
                            $imgBadge = 'AC Banquet & DJ Sound';
                        } elseif ($currentTheme === 'rest_landing_midnight_cravings_flash_deal') {
                            $heroImg = 'https://images.unsplash.com/photo-1526367790999-0150786686a2?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 25-MIN HOT DELIVERY';
                            $imgBadge = 'Midnight Cravings Fest';
                        } elseif ($currentTheme === 'rest_landing_corporate_executive_lunch_catering') {
                            $heroImg = 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ GST INPUT INVOICING';
                            $imgBadge = 'Executive Bento Boxes';
                        } elseif ($currentTheme === 'rest_landing_romantic_candlelight_dinner') {
                            $heroImg = 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ PRIVATE SKYLINE CABANA';
                            $imgBadge = 'Candlelight Couple Feast';
                        } elseif ($currentTheme === 'rest_landing_wedding_festive_outdoor_catering') {
                            $heroImg = 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ ROYAL WEDDING BANQUET';
                            $imgBadge = 'Live International Counters';
                        } elseif ($bizCat === 'Restaurant & Cafes') {
                            $heroImg = 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 FOODIE RATING';
                            $imgBadge = 'Gourmet Dining Lounge';
                        } elseif ($currentTheme === 'herbal_landing_hair_fall_oil') {
                            $heroImg = 'https://images.unsplash.com/photo-1526947425960-945c6e72858f?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 100-DAY HAIR PROTOCOL';
                            $imgBadge = '21 Forest Herbs Tailam';
                        } elseif ($currentTheme === 'herbal_landing_weight_detox_tea') {
                            $heroImg = 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 21-DAY AMA DETOX';
                            $imgBadge = 'Metabolism Cleanse Pass';
                        } elseif ($currentTheme === 'herbal_landing_panchakarma_7day_pass') {
                            $heroImg = 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 7-DAY REJUVENATION';
                            $imgBadge = 'Private Nature Villa';
                        } elseif ($currentTheme === 'herbal_landing_skin_glow_kumkumadi') {
                            $heroImg = 'https://images.unsplash.com/photo-1601049541289-9b1b7bbbfe19?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ KASHMIRI RED GOLD';
                            $imgBadge = '7-Day Radiance Elixir';
                        } elseif ($currentTheme === 'herbal_landing_diabetes_madhumeh_churn') {
                            $heroImg = 'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ NATURAL SUGAR CONTROL';
                            $imgBadge = 'Doctor-Formulated Churn';
                        } elseif ($currentTheme === 'herbal_landing_joint_pain_oil') {
                            $heroImg = 'https://images.unsplash.com/photo-1584365685547-9a5fb6f3a70c?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 10-MIN JOINT RELIEF';
                            $imgBadge = 'Maha Narayan Tailam';
                        } elseif ($bizCat === 'Herbal Care') {
                            $heroImg = 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 100% AYURVEDIC';
                            $imgBadge = 'Ayurvedic Sanctuary';
                        } elseif ($currentTheme === 'service_landing_emergency_plumbing_electrical') {
                            $heroImg = 'https://images.unsplash.com/photo-1585704032915-c3400ca199e7?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 30-MIN RAPID DISPATCH';
                            $imgBadge = 'Master Emergency Technicians';
                        } elseif ($currentTheme === 'service_landing_gst_tax_audit_notice_resolution') {
                            $heroImg = 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 2-HOUR NOTICE AUDIT';
                            $imgBadge = 'Senior CA & Legal Defense';
                        } elseif ($currentTheme === 'service_landing_termite_rodent_pest_free_pass') {
                            $heroImg = 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 1-YEAR WARRANTY PASS';
                            $imgBadge = 'Odorless Drill & Shield';
                        } elseif ($currentTheme === 'service_landing_corporate_annual_housekeeping_contract') {
                            $heroImg = 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 30-DAY TRIAL PILOT';
                            $imgBadge = 'Corporate Facility AMC';
                        } elseif ($currentTheme === 'service_landing_iso_certification_fasttrack') {
                            $heroImg = 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 7-DAY ACCREDITATION';
                            $imgBadge = 'IAF & NABCB Certified';
                        } elseif ($currentTheme === 'service_landing_solar_rooftop_epc_installation') {
                            $heroImg = 'https://images.unsplash.com/photo-1613665813446-82a78c468a1d?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ ₹78,000 GOVT SUBSIDY';
                            $imgBadge = 'PM Surya Ghar Solar EPC';
                        } elseif ($bizCat === 'Other Services') {
                            $heroImg = 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 ADVISORY RATING';
                            $imgBadge = 'Corporate Advisory';
                        } elseif ($currentTheme === 'retail_landing_mega_clearance_sale') {
                            $heroImg = 'https://images.unsplash.com/photo-1607083206869-4c7672e72a8a?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 70% CLEARANCE SALE';
                            $imgBadge = 'Doorbuster Steals';
                        } elseif ($currentTheme === 'retail_landing_festive_bridal_combo') {
                            $heroImg = 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 35% BRIDAL COMBO';
                            $imgBadge = 'Royal Trousseau Wardrobe';
                        } elseif ($currentTheme === 'retail_landing_smartphone_exchange_bonus') {
                            $heroImg = 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ ₹5,000 TRADE-IN BONUS';
                            $imgBadge = '5G Exchange Carnival';
                        } elseif ($currentTheme === 'retail_landing_modular_kitchen_makeover') {
                            $heroImg = 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 21-DAY MODULAR KITCHEN';
                            $imgBadge = 'Free Auto-Clean Chimney';
                        } elseif ($currentTheme === 'retail_landing_vip_loyalty_gold_pass') {
                            $heroImg = 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ VIP GOLD PASS';
                            $imgBadge = '15% Cashback & Free Delivery';
                        } elseif ($currentTheme === 'retail_landing_corporate_festive_gift_hamper') {
                            $heroImg = 'https://images.unsplash.com/photo-1513885535751-8b9238bd345a?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ CORPORATE GIFTING';
                            $imgBadge = 'Custom Engraved Hampers';
                        } elseif ($isHotelCategory) {
                            $heroImg = 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 VIP RATING';
                            $imgBadge = 'Flagship Residence';
                        } else {
                            $heroImg = 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&auto=format&fit=crop&q=80';
                            $imgRating = '★ 5.0 STORE RATING';
                            $imgBadge = 'Flagship Superstore';
                        }
                    @endphp

                    <div class="relative rounded-3xl overflow-hidden border-2 border-amber-500/30 shadow-2xl shadow-amber-500/10 group aspect-4/3">
                        <img src="{{ $heroImg }}" alt="{{ $tenant->business_name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent"></div>
                        <div class="absolute top-4 right-4 bg-amber-500 text-slate-950 font-black text-[10px] px-3 py-1 rounded-full uppercase tracking-wider shadow">
                            {{ $imgRating }}
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="text-amber-400 text-[10px] font-black uppercase tracking-widest block mb-0.5">{{ $imgBadge }}</span>
                            <h3 class="text-white font-black text-xl">{{ $tenant->business_name }}</h3>
                            <p class="text-xs text-zinc-400"><i class="fa-solid fa-location-dot text-amber-500"></i> {{ $tenant->address ?: $tenant->city }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif($currentTheme === 'minimal_card')
    <!-- ======================================================== -->
    <!-- 🏛️ LAYOUT 4: SANTORINI & MEDITERRANEAN CLIFFSIDE MINIMALIST -->
    <!-- Whitewashed Stucco + Sea-Facing Plunge Pools & Sunset Terraces -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-sky-100">
        <!-- Cinematic Santorini Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=1600&auto=format&fit=crop&q=85" alt="Santorini Cliffside Stay" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-slate-950/70"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <!-- Mediterranean Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md border border-white/40 text-sky-200 text-xs font-bold tracking-widest uppercase mb-6">
                <i class="fa-solid fa-water text-sky-300"></i> Santorini &amp; Cycladic Cliffside Minimalist Stays
            </div>

            <!-- Headline -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-white">
                Sun-Drenched Serenity &amp; Sea-Facing Plunge Pools in <span class="text-sky-300 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-200 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Stripped of noise, immersed in Aegean light. Organic whitewashed curves, private cliffside plunge pools, and uninterrupted sunset views over {$tenant->city}." }}
            </p>

            <!-- Floating Mediterranean Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-sky-100 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-sky-50/60 border border-sky-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-sky-700 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-sky-600 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-sky-50/60 border border-sky-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-sky-700 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-sky-600 mr-1"></i> Check-Out Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-sky-50/60 border border-sky-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-sky-700 mb-0.5">
                            <i class="fa-solid fa-water text-sky-600 mr-1"></i> Cliffside Suite
                        </span>
                        <div class="text-xs font-bold text-slate-800">Caldera Suite &bull; Plunge Pool</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-xs shadow-lg shadow-sky-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-water"></i> Check Plunge Pools
                    </a>
                </div>
            </div>

            <!-- Santorini Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-slate-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-water-ladder text-sky-400 text-sm"></i> Private Sea-Facing Plunge Pools</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-sun text-amber-300 text-sm"></i> Sunset Caldera Terraces</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-utensils text-sky-400 text-sm"></i> Organic Mediterranean Breakfast</span>
                <span class="flex items-center gap-2"><i class="fa-brands fa-whatsapp text-emerald-400 text-sm"></i> Instant Concierge Desk</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'nature_retreat')
    <!-- ======================================================== -->
    <!-- 🌿 LAYOUT 5: WILDERNESS SAFARI CAMP & TREEHOUSE LODGE    -->
    <!-- Canopy Rainforest Atmosphere + 4x4 Jeep Safari Planner   -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-emerald-900/40">
        <!-- Deep Rainforest Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1510312305653-8ed496efae75?w=1600&auto=format&fit=crop&q=85" alt="Safari Glamping Camp" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-emerald-950/70 to-stone-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-campground text-emerald-400"></i> Aman-Inspired Eco-Forest Glamping &amp; Safari Reserve
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-emerald-50">
                Untamed Wilderness, Elevated Luxury in the Forests of <span class="text-emerald-400 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-emerald-200/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Reconnect with the living earth beneath towering forest canopies. Custom teakwood canvas suites, morning 4x4 open jeep game drives, and starlit campfire dining under clear night skies." }}
            </p>

            <!-- Safari Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-emerald-100 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-emerald-50/70 border border-emerald-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-emerald-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-emerald-600 mr-1"></i> Safari Check-In
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-emerald-50/70 border border-emerald-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-emerald-800 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-emerald-600 mr-1"></i> Safari Check-Out
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-emerald-50/70 border border-emerald-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-emerald-800 mb-0.5">
                            <i class="fa-solid fa-tree text-emerald-600 mr-1"></i> Lodging Choice
                        </span>
                        <div class="text-xs font-bold text-slate-800">Canopy Treehouse Villa</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-emerald-700 to-green-600 hover:from-emerald-600 hover:to-green-500 text-white font-extrabold text-xs shadow-lg shadow-emerald-700/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-compass"></i> Reserve Safari Tent
                    </a>
                </div>
            </div>

            <!-- Safari Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-emerald-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-truck-monster text-emerald-400 text-sm"></i> Open 4x4 Jeep Safaris</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-tree text-emerald-400 text-sm"></i> Canopy Teakwood Treehouses</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-fire text-amber-400 text-sm"></i> Starlit Campfire &amp; BBQ</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-binoculars text-emerald-400 text-sm"></i> Guided Naturalist Treks</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'coastal_beach')
    <!-- ======================================================== -->
    <!-- 🌊 LAYOUT 6: MALDIVES OVERWATER VILLA & OCEAN SANCTUARY  -->
    <!-- Crystal Lagoon Atmosphere + Overwater Stilt Bungalow Bar -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-cyan-100">
        <!-- Ocean Lagoon Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=1600&auto=format&fit=crop&q=85" alt="Maldives Overwater Resort" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/35 to-slate-950/60"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-500/20 border border-cyan-400/40 text-cyan-200 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-water-ladder text-cyan-400"></i> Maldives Overwater Bungalows &amp; Ocean Sanctuary
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.1] mb-5 text-white">
                Where Crystal Waters Meet Private Solitude in <span class="text-cyan-300 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-cyan-100/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Step directly from your private bedroom ladder into crystal turquoise ocean waters. Featuring glass floor ocean view panels, private overwater plunge pools, and beach cabana dining." }}
            </p>

            <!-- Lagoon Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-cyan-100 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-cyan-50/70 border border-cyan-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-cyan-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-cyan-600 mr-1"></i> Arrival Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-cyan-50/70 border border-cyan-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-cyan-800 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-cyan-600 mr-1"></i> Departure Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-cyan-50/70 border border-cyan-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-cyan-800 mb-0.5">
                            <i class="fa-solid fa-water text-cyan-600 mr-1"></i> Villa Type
                        </span>
                        <div class="text-xs font-bold text-slate-800">Overwater Glass-Floor Villa</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white font-extrabold text-xs shadow-lg shadow-cyan-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-fish-fins"></i> Book Overwater Villa
                    </a>
                </div>
            </div>

            <!-- Coastal Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-cyan-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-water-ladder text-cyan-400 text-sm"></i> Direct Lagoon Ladder Access</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-umbrella-beach text-cyan-400 text-sm"></i> Private Beachfront Cabanas</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-ship text-cyan-400 text-sm"></i> Sunset Catamaran Sailing</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-champagne-glasses text-cyan-400 text-sm"></i> Candlelight Beach BBQ</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'heritage_haveli')
    <!-- ======================================================== -->
    <!-- 👑 LAYOUT 7: RAJASTHAN ROYAL HAVELI & HERITAGE FORT STAY -->
    <!-- Rajputana Courtyard + Jharokha Arches & Royal Thali Bar  -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-amber-900/40">
        <!-- Royal Haveli Courtyard Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1599661046289-e31897846e41?w=1600&auto=format&fit=crop&q=85" alt="Royal Haveli Rajasthan" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/65 to-stone-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/20 border border-amber-400/50 text-amber-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-chess-rook text-amber-400"></i> 300-Year Heritage Rajputana Haveli &amp; Royal Fort
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-amber-50">
                Live Like Royalty Amidst Carved Jharokhas in <span class="text-amber-400 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-amber-200/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Step into an era of regal splendor. Greeted by traditional Dhol Nagada and fragrant rose petals, relax in hand-painted Maharaja suites with antique four-poster brass beds and courtyards." }}
            </p>

            <!-- Royal Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-amber-200 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-amber-50/70 border border-amber-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-amber-600 mr-1"></i> Royal Arrival
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-amber-50/70 border border-amber-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-amber-600 mr-1"></i> Royal Departure
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-amber-50/70 border border-amber-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-amber-800 mb-0.5">
                            <i class="fa-solid fa-crown text-amber-600 mr-1"></i> Suite Choice
                        </span>
                        <div class="text-xs font-bold text-slate-800">Maharaja Jharokha Suite</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-amber-600 via-rose-700 to-amber-700 hover:from-amber-500 hover:to-rose-600 text-white font-extrabold text-xs shadow-lg shadow-amber-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-chess-rook"></i> Reserve Royal Suite
                    </a>
                </div>
            </div>

            <!-- Haveli Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-amber-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-bell text-amber-400 text-sm"></i> Dhol &amp; Tilak Royal Swagat</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-masks-theater text-amber-400 text-sm"></i> Live Kathputli &amp; Folk Dance</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-utensils text-amber-400 text-sm"></i> 36-Dish Rajasthani Darbar Thali</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-bed text-amber-400 text-sm"></i> Hand-Carved Brass Four-Poster Beds</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'mountain_chalet')
    <!-- ======================================================== -->
    <!-- 🏔️ LAYOUT 8: HIMALAYAN PINE CHALET & ALPINE SNOW RESORT -->
    <!-- Alpine Cedar Wood + Stone Fireplaces & Heated Jacuzzis   -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-orange-950/40">
        <!-- Mountain Snow Chalet Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1502784444187-359ac186c5bb?w=1600&auto=format&fit=crop&q=85" alt="Alpine Mountain Chalet" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/60 to-stone-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-500/20 border border-orange-400/50 text-orange-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-mountain text-orange-400"></i> Alpine Cedarwood Retreat &amp; Heated Hydrotherapy Spa
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-orange-50">
                Crisp Mountain Air &amp; Crackling Hearth Fires in <span class="text-orange-400 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-orange-200/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Perched amidst fragrant deodar and pine forests. Cozy cedarwood suites with in-room crackling stone hearths, steaming private hydrotherapy jacuzzis, and panoramic snow peak views." }}
            </p>

            <!-- Alpine Booking Engine -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-orange-200 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-orange-50/70 border border-orange-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-orange-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-orange-600 mr-1"></i> Check-In Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-orange-50/70 border border-orange-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-orange-800 mb-0.5">
                            <i class="fa-regular fa-calendar-xmark text-orange-600 mr-1"></i> Check-Out Date
                        </span>
                        <input type="date" value="{{ now()->addDays(2)->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-orange-50/70 border border-orange-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-orange-800 mb-0.5">
                            <i class="fa-solid fa-mountain text-orange-600 mr-1"></i> Chalet Room
                        </span>
                        <div class="text-xs font-bold text-slate-800">Cedar Chalet &bull; Stone Fireplace</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-orange-600 to-amber-700 hover:from-orange-500 hover:to-amber-600 text-white font-extrabold text-xs shadow-lg shadow-orange-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-fire"></i> Book Alpine Chalet
                    </a>
                </div>
            </div>

            <!-- Chalet Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-orange-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-fire-burner text-orange-400 text-sm"></i> In-Suite Stone Fireplace</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-hot-tub-person text-orange-400 text-sm"></i> Heated Indoor Hydro Jacuzzi</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-snowflake text-sky-300 text-sm"></i> Snow-Capped Peak Balconies</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-person-hiking text-orange-400 text-sm"></i> Guided Pine Forest Treks</span>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'wellness_sanctuary')
    <!-- ======================================================== -->
    <!-- 🧘 LAYOUT 9: HIMALAYAN AYURVEDA, YOGA & WELLNESS RETREAT -->
    <!-- Zen Mountain Mist + Sunrise Yoga & Panchakarma Booking   -->
    <!-- ======================================================== -->
    <section id="hero" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center overflow-hidden border-b border-teal-950/40">
        <!-- Healing Yoga & Lotus Garden Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=1600&auto=format&fit=crop&q=85" alt="Ayurvedic Yoga Retreat" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-teal-950 via-stone-950/70 to-teal-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 text-white">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal-500/20 border border-teal-400/50 text-teal-300 text-xs font-bold tracking-widest uppercase mb-6 backdrop-blur-md">
                <i class="fa-solid fa-spa text-teal-400"></i> Authentic Himalayan Ayurveda, Panchakarma &amp; Yoga Sanctuary
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-5 text-teal-50">
                Restore Deep Harmony of Body, Mind &amp; Prana in <span class="text-teal-300 italic">{{ $tenant->city ?: 'Your City' }}</span>
            </h1>

            <p class="text-base sm:text-lg text-teal-200/90 max-w-3xl mx-auto leading-relaxed mb-10 font-normal">
                {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. A sacred haven for rejuvenation and holistic healing. Guided by seasoned Ayurvedic Vaidyas, experience personalized pulse diagnoses, traditional herbal therapies, daily sunrise yoga, and farm-fresh sattvic meals." }}
            </p>

            <!-- Healing Retreat Planner -->
            <div class="bg-white/95 backdrop-blur-xl text-slate-800 p-4 sm:p-5 rounded-3xl shadow-2xl border border-teal-200 max-w-4xl mx-auto text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-center">
                    <div class="p-2.5 rounded-2xl bg-teal-50/70 border border-teal-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-teal-800 mb-0.5">
                            <i class="fa-regular fa-calendar-check text-teal-600 mr-1"></i> Retreat Start Date
                        </span>
                        <input type="date" value="{{ now()->format('Y-m-d') }}" class="w-full bg-transparent text-xs font-bold text-slate-800 outline-none">
                    </div>

                    <div class="p-2.5 rounded-2xl bg-teal-50/70 border border-teal-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-teal-800 mb-0.5">
                            <i class="fa-solid fa-hourglass-half text-teal-600 mr-1"></i> Retreat Program
                        </span>
                        <div class="text-xs font-bold text-slate-800">7-Day Detox &amp; Rejuvenation</div>
                    </div>

                    <div class="p-2.5 rounded-2xl bg-teal-50/70 border border-teal-100">
                        <span class="block text-[10px] font-black uppercase tracking-wider text-teal-800 mb-0.5">
                            <i class="fa-solid fa-house-chimney text-teal-600 mr-1"></i> Healing Cottage
                        </span>
                        <div class="text-xs font-bold text-slate-800">Ayurvedic Garden Villa</div>
                    </div>

                    <a href="#services" class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-teal-700 to-emerald-600 hover:from-teal-600 hover:to-emerald-500 text-white font-extrabold text-xs shadow-lg shadow-teal-700/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer text-center">
                        <i class="fa-solid fa-spa"></i> Begin Healing Journey
                    </a>
                </div>
            </div>

            <!-- Sanctuary Perks -->
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 mt-10 text-xs font-semibold text-teal-200">
                <span class="flex items-center gap-2"><i class="fa-solid fa-heart-pulse text-teal-400 text-sm"></i> Doctor Nadi (Pulse) Diagnosis</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-sun text-amber-300 text-sm"></i> Sunrise Yoga &amp; Pranayama</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-leaf text-emerald-400 text-sm"></i> Authentic Herbal Abhyanga Spa</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-bowl-rice text-teal-400 text-sm"></i> Farm-to-Table Sattvic Dining</span>
            </div>
        </div>
    </section>

    @elseif(in_array($currentTheme, ['salon_wellness', 'salon_bridal', 'salon_barber_lounge', 'salon_nail_lashes', 'salon_luxury_hair_studio']) || ($this->isBusinessWebsite && $bizCat === 'Beauty & Salons'))
    <!-- ======================================================== -->
    <!-- ✂️ LAYOUT: PREMIER SALON, SPA & AESTHETICS STUDIO (WEBSITE) -->
    <!-- Soft Rose / Pearl Champagne Palette + Booking Calendar   -->
    <!-- ======================================================== -->
    @php
        $salonConfig = match($currentTheme) {
            'salon_bridal' => [
                'badge' => '👰 Luxury Bridal & HD Makeover Studio',
                'title' => 'Celebrity Bridal Makeovers, HD Airbrush & Pre-Wedding Rituals',
                'desc' => 'High-definition bridal artistry, pre-wedding skin detan therapies, saree draping, and VIP bridal suites in ' . ($tenant->city ?: 'Nagpur') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=400&auto=format&fit=crop&q=80',
                'pills' => ['HD Airbrush Makeup', 'Pre-Bridal Glow Packages', 'Saree Draping & Hair', 'VIP AC Lounge'],
                'tag' => '★ 5.0 BRIDAL ARTIST',
            ],
            'salon_barber_lounge' => [
                'badge' => "💈 Men's Executive Barber & Grooming Lounge",
                'title' => 'Precision Fades, Hot Towel Straight-Razor Shaves & Beard Styling',
                'desc' => "Modern men's grooming lounge with classic fades, charcoal skin detan, and express zero-wait queue booking in " . ($tenant->city ?: 'Nagpur') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1599351431202-1e0f0137899a?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1621607512214-68297480165e?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Hot Towel Shave', 'Beard Spa & Contouring', 'Executive Detan Facial', 'Zero Lobby Waiting'],
                'tag' => '★ 4.9 MASTER BARBER',
            ],
            'salon_nail_lashes' => [
                'badge' => '💅 Nail Art Studio, Lash & Brow Aesthetics Bar',
                'title' => 'Bespoke Gel Nail Extensions, Korean Lash Lifts & Brow Styling',
                'desc' => 'Hand-painted custom nail art, acrylic extensions, Korean lash perming, and sterile autoclaved hygiene protocols in ' . ($tenant->city ?: 'Nagpur') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Gel & Acrylic Nails', 'Korean Lash Perms', 'Ombre Powder Brows', '100% Sterile Tools'],
                'tag' => '★ 5.0 NAIL AESTHETICS',
            ],
            'salon_luxury_hair_studio' => [
                'badge' => '💇 Celebrity Hair Studio & Balayage Color Bar',
                'title' => 'French Balayage, Olaplex Bond Repair & Hair Transformations',
                'desc' => 'High-end designer hair salon specializing in bespoke French balayage, ombre highlights, Olaplex bond repair treatments, and precision styling in ' . ($tenant->city ?: 'Nagpur') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&auto=format&fit=crop&q=80',
                'pills' => ['French Balayage Color', 'Olaplex Bond Repair', 'Global Keratin Therapy', 'VIP Salon Chair'],
                'tag' => '★ 5.0 HAIR COLOR BAR',
            ],
            default => [
                'badge' => '✂️ Premier Luxury Unisex Salon & Spa Studio',
                'title' => 'Luxury Hair Styling, Therapeutic Spa & Bespoke Glow',
                'desc' => 'Relax, revitalize and glow with certified beauty artists, organic therapies, and dedicated bridal suites in ' . ($tenant->city ?: 'Nagpur') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Certified Stylists', 'Duration Badges (30m, 60m)', 'Organic Products', 'Private AC Suites'],
                'tag' => '★ 5.0 LUXURY SALON',
            ],
        };
    @endphp
    <section id="hero" class="relative overflow-hidden py-14 lg:py-20 bg-gradient-to-b from-rose-50/70 via-white to-pink-50/30 border-b border-rose-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-rose-200 text-rose-700 text-xs font-black shadow-xs">
                        <span>{{ $salonConfig['badge'] }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.12]">
                        {{ $salonConfig['title'] }} in <span class="bg-gradient-to-r from-rose-600 to-purple-600 bg-clip-text text-transparent">{{ $tenant->city ?: 'Your City' }}</span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        {{ $salonConfig['desc'] }}
                    </p>

                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start pt-1">
                        @foreach($salonConfig['pills'] as $pill)
                            <span class="px-3.5 py-1.5 rounded-xl bg-white border border-rose-100 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-rose-500 text-[11px]"></i> {{ $pill }}
                            </span>
                        @endforeach
                    </div>

                    <!-- Appointment Booking Action Strip -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 pt-3">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-pink-600 via-rose-600 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white font-black text-sm shadow-xl shadow-rose-500/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                            <i class="fa-regular fa-calendar-check"></i> Book Appointment Slot
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to book a salon appointment.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-md transition hover:scale-[1.02] flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i> Instant WhatsApp Booking
                        </a>
                    </div>
                </div>

                <!-- Right 5 Cols: Salon Bento Gallery -->
                <div class="lg:col-span-5">
                    <div class="grid grid-cols-2 gap-3.5">
                        <div class="col-span-2 relative rounded-3xl overflow-hidden shadow-2xl border-2 border-rose-100 aspect-16/10 group">
                            <img src="{{ $salonConfig['hero_img'] }}" alt="{{ $salonConfig['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute top-3.5 left-3.5 bg-white/95 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black text-rose-700 shadow flex items-center gap-1.5">
                                <i class="fa-solid fa-star text-amber-400"></i> {{ $salonConfig['tag'] }}
                            </div>
                            <div class="absolute bottom-3.5 left-3.5 right-3.5 text-white">
                                <span class="font-black text-base block">{{ $tenant->business_name }}</span>
                                <span class="text-xs text-white/80"><i class="fa-solid fa-location-dot text-rose-400"></i> {{ $tenant->address ?: $tenant->city }}</span>
                            </div>
                        </div>

                        <div class="relative rounded-2xl overflow-hidden shadow-md border border-rose-100 aspect-4/3 group">
                            <img src="{{ $salonConfig['side_img1'] }}" alt="Salon Detail" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-2.5">
                                <span class="text-[11px] font-bold text-white">Private Suites</span>
                            </div>
                        </div>

                        <div class="relative rounded-2xl overflow-hidden shadow-md border border-rose-100 aspect-4/3 group">
                            <img src="{{ $salonConfig['side_img2'] }}" alt="Salon Styling" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-2.5">
                                <span class="text-[11px] font-bold text-white">Certified Stylists</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @elseif(in_array($currentTheme, ['clinic_multispecialty_hospital', 'clinic_dental_implant', 'clinic_maternity_pediatric', 'clinic_cardiology_heart', 'clinic_eyecare_lasik', 'clinic_ortho_physio']) || ($this->isBusinessWebsite && $bizCat === 'Clinics & Hospitals'))
    <!-- ======================================================== -->
    <!-- 🏥 LAYOUT: ADVANCED CLINIC & HOSPITAL HEALTHCARE (WEBSITE) -->
    <!-- Medical Sky/Teal Trust Palette + Instant OPD Appointment  -->
    <!-- ======================================================== -->
    @php
        $clinicConfig = match($currentTheme) {
            'clinic_dental_implant' => [
                'badge' => '🦷 Advanced Dental Care & Implantology Suite',
                'title' => 'Painless Laser Root Canals, Clear Aligners & Swiss Implants',
                'desc' => 'High-tech dental operatory with 3D digital imaging, single-sitting rotary RCTs, invisible orthodontic aligners, and 100% autoclave sterilized protocols in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Painless Rotary RCT', 'Clear Aligners & Braces', 'Swiss Dental Implants', '100% Sterile Autoclaved'],
                'tag' => '★ 5.0 DENTAL IMPLANT SUITE',
            ],
            'clinic_maternity_pediatric' => [
                'badge' => '👶 Bliss Mother & Child Hospital & Neonatal ICU',
                'title' => 'Private LDR Birthing Suites, Level-3 NICU & Pediatric Care',
                'desc' => 'Compassionate maternal care, 24/7 senior gynaecologists, painless normal delivery, infant vaccination center, and luxury post-delivery recovery suites in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Luxury Birthing Suites', 'Level-3 NICU Support', 'Painless Labor', 'Child Vaccinations'],
                'tag' => '★ 5.0 MATERNITY & CHILD',
            ],
            'clinic_cardiology_heart' => [
                'badge' => '❤️ Apex Heart Care & Cardiovascular Institute',
                'title' => 'Digital 2D Echo, TMT Stress Tests & Interventional Cardiology',
                'desc' => 'Advanced heart care diagnostics, emergency chest pain triage, preventive cardiac checkups, and consultations with senior interventional cardiologists in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=400&auto=format&fit=crop&q=80',
                'pills' => ['2D Echo & ECG in 5 Mins', 'Computerized TMT', 'Emergency Chest Pain Desk', 'Senior Cardiologists'],
                'tag' => '★ 4.9 CARDIAC SPECIALISTS',
            ],
            'clinic_eyecare_lasik' => [
                'badge' => '👁️ Vision Super-Specialty Eye Hospital & LASIK Bar',
                'title' => 'Blade-Free Robotic Femto LASIK & Micro-Phaco Cataract Surgery',
                'desc' => 'Freedom from spectacles in 10 minutes. World-class ophthalmic surgery, stitchless micro-cataracts, diabetic retina care, and computerized vision evaluations in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Blade-Free Femto LASIK', '10-Min Micro Cataract', 'Glaucoma & Retina OPD', 'Free Vision Screening'],
                'tag' => '★ 5.0 LASIK VISION CENTER',
            ],
            'clinic_ortho_physio' => [
                'badge' => '🦴 Spine, Bone, Joint Replacement & Advanced Rehab',
                'title' => 'Robotic Knee Replacement, Keyhole Arthroscopy & Sports Rehab',
                'desc' => 'Rapid walking recovery protocols, sub-millimeter robotic joint reconstructions, sports injury rehabilitation gym, on-site digital radiology, and spine therapy in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Robotic Joint Replacement', 'Sports Physio Gym', 'Keyhole Arthroscopy', 'Digital X-Ray On-Site'],
                'tag' => '★ 4.9 ORTHOPEDIC CENTER',
            ],
            default => [
                'badge' => '🏥 NABH Accredited Multi-Specialty Hospital & Trauma Center',
                'title' => '24/7 Trauma Care, Multi-Specialty OPD & Critical ICU Care',
                'desc' => 'Tertiary healthcare hospital featuring 24/7 emergency response, modern surgical theatres, ICU facilities, 40+ senior specialists, and cashless insurance mediclaim in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&auto=format&fit=crop&q=80',
                'pills' => ['24/7 Emergency & ICU', '40+ Super Specialists', 'Cashless Mediclaim TPA', 'Digital OPD Token'],
                'tag' => '★ 4.9 NABH ACCREDITED',
            ],
        };
    @endphp

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-sky-50 via-white to-slate-50 border-b border-sky-100">
        <!-- Ambient Medical Glow Orbs -->
        <div class="absolute top-0 right-1/4 w-96 h-96 rounded-full bg-sky-200/40 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 rounded-full bg-teal-200/30 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols: Clinical Overview -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-sky-200 text-sky-800 text-xs font-bold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-sky-600 animate-pulse"></span>
                        <span>{{ $clinicConfig['badge'] }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-[1.12]">
                        {{ $clinicConfig['title'] }}
                    </h1>

                    <p class="text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        {{ $clinicConfig['desc'] }}
                    </p>

                    <!-- Trust Pills -->
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        @foreach($clinicConfig['pills'] as $pill)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-white border border-sky-200 text-slate-700 text-xs font-bold shadow-2xs">
                            <i class="fa-solid fa-circle-check text-sky-600 text-xs"></i> {{ $pill }}
                        </span>
                        @endforeach
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-sky-600 to-blue-700 hover:from-sky-500 hover:to-blue-600 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-sky-600/25 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-calendar-check text-sm"></i> Book OPD Appointment
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to schedule a clinical consultation slot.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-500 text-base"></i> Hospital WhatsApp
                        </a>
                    </div>

                    <!-- Emergency 24/7 Strip -->
                    <div class="pt-2 flex items-center justify-center lg:justify-start gap-4 text-xs font-semibold text-slate-500">
                        <span class="flex items-center gap-1.5 text-red-600">
                            <i class="fa-solid fa-truck-medical animate-pulse"></i> 24/7 Emergency Care
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-slate-700">
                            <i class="fa-solid fa-clock"></i> Timings: 08:00 AM - 10:00 PM
                        </span>
                    </div>
                </div>

                <!-- Right 5 Cols: Visual Hospital Cards -->
                <div class="lg:col-span-5">
                    <div class="relative">
                        <!-- Main Clinical Image -->
                        <div class="h-80 sm:h-96 rounded-3xl overflow-hidden shadow-2xl border-4 border-white relative group">
                            <img src="{{ $clinicConfig['hero_img'] }}" alt="Hospital Operatory" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent flex flex-col justify-between p-4">
                                <span class="self-start px-3 py-1 rounded-full bg-white/90 backdrop-blur-md text-sky-800 text-[10px] font-black uppercase tracking-wider shadow-sm">
                                    {{ $clinicConfig['tag'] }}
                                </span>
                                <div>
                                    <h3 class="text-white font-black text-lg">{{ $tenant->business_name }}</h3>
                                    <p class="text-sky-200 text-xs font-semibold">{{ $tenant->city ?: 'Central Healthcare' }} &bull; Certified OPD Center</p>
                                </div>
                            </div>
                        </div>

                        <!-- Side Floating Cards -->
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white relative group">
                                <img src="{{ $clinicConfig['side_img1'] }}" alt="Clinical Lab" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Sterile Care</span>
                                </div>
                            </div>
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white relative group">
                                <img src="{{ $clinicConfig['side_img2'] }}" alt="Doctor Consultation" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Senior Doctors</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif($currentTheme === 'coaching_web_iit_jee_neet' || ($this->isBusinessWebsite && $bizCat === 'Coaching & Institutes' && !in_array($currentTheme, ['coaching_web_upsc_ias', 'coaching_web_commerce_ca', 'coaching_web_ielts_abroad', 'coaching_web_coding_tech', 'coaching_web_school_tuition'])))
    <!-- ======================================================== -->
    <!-- 🎯 1. KOTA ENTRANCE ACADEMY (IIT-JEE & NEET PREMIER)      -->
    <!-- Kota Ranker Hall + Live AIR Ticker + 4-Step Kota Pedagogy-->
    <!-- ======================================================== -->
    <div class="bg-gradient-to-r from-blue-700 via-indigo-700 to-rose-700 text-white text-xs py-2 px-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 overflow-x-auto whitespace-nowrap">
            <div class="flex items-center gap-2 font-black">
                <span class="px-2 py-0.5 rounded bg-amber-400 text-slate-950 text-[10px] uppercase font-black animate-pulse">🔥 AIR TOP RANKS</span>
                <span>NEET 2026: 715/720 (AIR 12) &bull; JEE Advanced: AIR 47, AIR 108 &bull; 520+ IIT &amp; AIIMS Selections in {{ $tenant->city ?: 'Nagpur' }}!</span>
            </div>
            <a href="#services" class="text-[11px] font-bold underline hover:text-amber-300">View All-India Merit List &rarr;</a>
        </div>
    </div>

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-blue-900 via-indigo-950 to-slate-950 text-white border-b border-blue-900/60">
        <div class="absolute top-0 right-1/4 w-96 h-96 rounded-full bg-blue-500/20 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-96 h-96 rounded-full bg-rose-500/15 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols: Kota Pedagogy & Classroom System -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/20 border border-blue-400/40 text-blue-300 text-xs font-bold backdrop-blur-md">
                        <i class="fa-solid fa-graduation-cap text-amber-400"></i>
                        <span>🎯 Apex IIT-JEE &amp; NEET Premier Academy &bull; Kota Classroom System</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-[1.12]">
                        Kota Classroom Rigor, Daily Practice Papers &amp; <span class="bg-gradient-to-r from-blue-400 via-sky-300 to-rose-400 bg-clip-text text-transparent">Top All-India Ranks</span>
                    </h1>

                    <p class="text-base text-slate-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Welcome to {{ $tenant->business_name }}. Top-tier IIT-JEE (Main + Advanced) and NEET medical entrance coaching with verified Kota pedagogy, 8 AM - 8 PM live doubt counters, and bi-weekly All-India CBT testing in {{ $tenant->city ?: 'Nagpur' }}.
                    </p>

                    <!-- Kota Pedagogy Pills -->
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-white/10 border border-white/15 text-slate-200 text-xs font-bold backdrop-blur-md">
                            <i class="fa-solid fa-file-pen text-amber-400"></i> Daily Practice Papers (150 Qs)
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-white/10 border border-white/15 text-slate-200 text-xs font-bold backdrop-blur-md">
                            <i class="fa-solid fa-comments text-sky-400"></i> Daily Doubt Counters
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-white/10 border border-white/15 text-slate-200 text-xs font-bold backdrop-blur-md">
                            <i class="fa-solid fa-laptop text-emerald-400"></i> All India CBT Benchmark
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-white/10 border border-white/15 text-slate-200 text-xs font-bold backdrop-blur-md">
                            <i class="fa-solid fa-chalkboard-user text-rose-400"></i> Ex-Kota &amp; IIT Alumni Faculty
                        </span>
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-600 to-rose-600 hover:from-blue-500 hover:to-rose-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-graduation-cap text-sm"></i> Enroll in Kota Batches
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to book a 3-Day Free Classroom Trial Pass for JEE/NEET.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/25 text-white font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2 backdrop-blur-md">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Book 3-Day Free Trial
                        </a>
                    </div>
                </div>

                <!-- Right 5 Cols: Kota Hall of Fame Card -->
                <div class="lg:col-span-5">
                    <div class="bg-slate-900/90 border border-blue-500/30 rounded-3xl p-6 sm:p-7 shadow-2xl backdrop-blur-xl relative">
                        <div class="flex items-center justify-between mb-5 border-b border-slate-800 pb-3">
                            <div>
                                <span class="text-[10px] font-black uppercase tracking-widest text-amber-400 block">🏆 HALL OF FAME 2026</span>
                                <h3 class="text-lg font-black text-white">Our Proven Top Rankers</h3>
                            </div>
                            <span class="px-2.5 py-1 rounded-full bg-blue-500/20 text-blue-300 text-[10px] font-bold border border-blue-400/30">
                                450+ Selections
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div class="p-3 rounded-2xl bg-slate-800/80 border border-slate-700/80 flex items-center gap-3.5">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&auto=format&fit=crop&q=80" alt="Topper 1" class="w-12 h-12 rounded-xl object-cover border-2 border-amber-400">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-bold text-white truncate">Aarav Sharma</h4>
                                        <span class="text-xs font-black text-amber-400 bg-amber-400/10 px-2 py-0.5 rounded">AIR 47</span>
                                    </div>
                                    <p class="text-[11px] text-slate-400">JEE Advanced &bull; Computer Science (IIT Bombay)</p>
                                </div>
                            </div>

                            <div class="p-3 rounded-2xl bg-slate-800/80 border border-slate-700/80 flex items-center gap-3.5">
                                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=120&auto=format&fit=crop&q=80" alt="Topper 2" class="w-12 h-12 rounded-xl object-cover border-2 border-rose-400">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-bold text-white truncate">Priya Patel</h4>
                                        <span class="text-xs font-black text-rose-400 bg-rose-400/10 px-2 py-0.5 rounded">715 / 720</span>
                                    </div>
                                    <p class="text-[11px] text-slate-400">NEET UG &bull; MBBS (AIIMS New Delhi)</p>
                                </div>
                            </div>

                            <div class="p-3 rounded-2xl bg-slate-800/80 border border-slate-700/80 flex items-center gap-3.5">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&auto=format&fit=crop&q=80" alt="Topper 3" class="w-12 h-12 rounded-xl object-cover border-2 border-sky-400">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-bold text-white truncate">Rohan Deshmukh</h4>
                                        <span class="text-xs font-black text-sky-400 bg-sky-400/10 px-2 py-0.5 rounded">99.98 %ile</span>
                                    </div>
                                    <p class="text-[11px] text-slate-400">JEE Main 100 Percentile in Physics &amp; Maths</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400 font-medium">
                            <span>Bi-weekly CBT Benchmarking</span>
                            <span class="text-emerald-400 font-bold"><i class="fa-solid fa-circle-check mr-1"></i> Kota DPP System</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Exclusive Section: The 4-Pillar Kota Pedagogy Engine -->
    <section class="py-12 bg-slate-900 border-b border-slate-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-10">
                <span class="text-xs font-black uppercase tracking-widest text-amber-400">THE KOTA PEDAGOGY BLUEPRINT</span>
                <h3 class="text-2xl sm:text-3xl font-black mt-1">4 Pillars That Produce All-India Rankers</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-2xl bg-slate-800/60 border border-slate-700 hover:border-blue-500 transition">
                    <div class="w-12 h-12 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center text-xl font-black mb-4">01</div>
                    <h4 class="font-bold text-base mb-2">Deep Concept Lectures</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Daily 3-hour concept masterclasses covering foundational theory up to advanced Olympiad level problem solving.</p>
                </div>
                <div class="p-6 rounded-2xl bg-slate-800/60 border border-slate-700 hover:border-amber-500 transition">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-xl font-black mb-4">02</div>
                    <h4 class="font-bold text-base mb-2">Daily Practice Papers</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">150 daily questions graded in 3 levels of difficulty with same-day evening video solutions and error logs.</p>
                </div>
                <div class="p-6 rounded-2xl bg-slate-800/60 border border-slate-700 hover:border-sky-500 transition">
                    <div class="w-12 h-12 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center text-xl font-black mb-4">03</div>
                    <h4 class="font-bold text-base mb-2">8 AM-8 PM Doubt Desk</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Zero pending doubts policy. Walk up to the dedicated doubt floor and get personalized 1-on-1 step-by-step resolution.</p>
                </div>
                <div class="p-6 rounded-2xl bg-slate-800/60 border border-slate-700 hover:border-rose-500 transition">
                    <div class="w-12 h-12 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center text-xl font-black mb-4">04</div>
                    <h4 class="font-bold text-base mb-2">All-India CBT Simulation</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">Computer-based mock tests on exact NTA interface benchmarked across 25,000+ national students with percentile stats.</p>
                </div>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'coaching_web_upsc_ias')
    <!-- ======================================================== -->
    <!-- 🏛️ 2. SANKALP UPSC CIVIL SERVICES ACADEMY                 -->
    <!-- Editorial Think-Tank + Ashoka Insignia + Daily Mains Desk -->
    <!-- ======================================================== -->
    <div class="bg-[#0C1A30] text-amber-300 text-xs py-2 px-4 border-b border-amber-500/20 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 overflow-x-auto whitespace-nowrap">
            <div class="flex items-center gap-2 font-bold">
                <span class="px-2 py-0.5 rounded bg-amber-500 text-slate-950 text-[10px] uppercase font-black">🏛️ CIVIL SERVICES 2027</span>
                <span>GS Foundation Batch &bull; Mentored by Retd. IAS &amp; IFS Bureaucrats &bull; Daily Mains Answer Writing</span>
            </div>
            <a href="#mains-desk" class="text-[11px] font-bold text-white underline hover:text-amber-300">Submit Today's Answer &rarr;</a>
        </div>
    </div>

    <section id="hero" class="relative overflow-hidden py-16 sm:py-24 bg-[#0A1628] text-white border-b border-slate-800">
        <div class="absolute inset-0 z-0 bg-[radial-gradient(circle_at_top,#1E293B,transparent_70%)]"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs font-bold mb-6">
                <i class="fa-solid fa-scale-balanced text-amber-400"></i> UPSC Civil Services Examination (CSE) Foundation
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-tight leading-[1.15] mb-6 text-slate-100">
                Master Prelims, Mains &amp; Personality Test with <span class="text-amber-400 italic font-medium">Ex-Bureaucrats &amp; Rankers</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-300 max-w-3xl mx-auto leading-relaxed mb-8 font-normal">
                {{ $tenant->business_name }} provides rigorous, analytical civil services coaching. Featuring exhaustive General Studies Foundation (GS 1-4), daily editorial breakdown, 1-on-1 Mains answer evaluation within 24 hours, and simulated DAF mock interview boards in {{ $tenant->city ?: 'Nagpur' }}.
            </p>

            <!-- Ex-IAS Mentor Quote Card -->
            <div class="max-w-3xl mx-auto bg-slate-900/90 border-l-4 border-amber-500 p-5 rounded-r-2xl text-left mb-10 shadow-2xl backdrop-blur-md">
                <p class="text-xs sm:text-sm text-slate-300 italic mb-2">
                    "UPSC is not about encyclopedic memorization. It demands structured constitutional thinking, crisp multi-dimensional articulation, and ethical maturity."
                </p>
                <div class="flex items-center justify-between text-xs">
                    <span class="font-bold text-amber-400">— Dr. R.K. Mathur, Retd. IAS (Chief Academic Mentor)</span>
                    <span class="text-slate-500 text-[11px]">Former Addl. Chief Secretary</span>
                </div>
            </div>

            <!-- CTAs -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 transition flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-landmark"></i> Explore GS Foundation 2027
                </a>
                <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to download the UPSC Syllabus & Mains Answer Writing Framework.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-200 font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-file-pdf text-amber-400 text-sm"></i> Download 2027 Syllabus &amp; Strategy
                </a>
            </div>
        </div>
    </section>

    <!-- Exclusive Section: Daily Civil Services Think-Tank Desk -->
    <section id="mains-desk" class="py-12 bg-[#0E1A2E] border-b border-slate-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Left 6: Daily Editorial Breakdown -->
                <div class="lg:col-span-6 bg-slate-900/80 p-6 sm:p-7 rounded-3xl border border-slate-800 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-black uppercase tracking-widest text-amber-400">TODAY'S EDITORIAL ANALYSIS</span>
                            <span class="text-xs text-slate-400">{{ now()->format('d M Y') }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-3">Reforming Fiscal Federalism &amp; Finance Commission Allocations</h3>
                        <p class="text-xs text-slate-300 leading-relaxed mb-4">
                            Key constitutional articles (Art 280), horizontal vs vertical devolution, cess &amp; surcharges impact on states, and policy recommendations for GS Paper-II and GS Paper-III.
                        </p>
                        <div class="flex flex-wrap gap-2 text-[10px] font-bold text-slate-400 mb-4">
                            <span class="bg-slate-800 px-2.5 py-1 rounded-md border border-slate-700">Polity &amp; Governance</span>
                            <span class="bg-slate-800 px-2.5 py-1 rounded-md border border-slate-700">GS Paper II</span>
                            <span class="bg-slate-800 px-2.5 py-1 rounded-md border border-slate-700">Finance Commission</span>
                        </div>
                    </div>
                    <a href="{{ $tenant->getWhatsAppUrl('Hi, please send me today\'s Complete Editorial Analysis PDF.') }}" target="_blank" class="w-full py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-amber-300 font-bold text-xs flex items-center justify-center gap-2 border border-slate-700">
                        <i class="fa-solid fa-file-arrow-down"></i> Download Editorial Handout (PDF)
                    </a>
                </div>

                <!-- Right 6: Daily Mains Question of the Day -->
                <div class="lg:col-span-6 bg-slate-900/80 p-6 sm:p-7 rounded-3xl border border-slate-800 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-black uppercase tracking-widest text-rose-400">DAILY MAINS QUESTION OF THE DAY</span>
                            <span class="text-xs text-amber-400 font-bold">15 Marks &bull; 250 Words</span>
                        </div>
                        <h3 class="text-base font-serif font-bold text-white mb-3 leading-snug">
                            "Examine how the digital public infrastructure (DPI) in India has transformed social welfare delivery while presenting new challenges for data sovereignty."
                        </h3>
                        <div class="p-3 rounded-xl bg-slate-800/60 border border-slate-700/60 text-xs text-slate-400 mb-4">
                            <p class="font-bold text-slate-300 mb-1">Mains Directive Checklist:</p>
                            <p>&bull; Introduction: Define DPI and architectural stack (Aadhaar, UPI, DigiLocker)</p>
                            <p>&bull; Body: Welfare leakages plugged vs digital exclusion risks</p>
                            <p>&bull; Way Forward: Digital Personal Data Protection Act compliance</p>
                        </div>
                    </div>
                    <a href="{{ $tenant->getWhatsAppUrl('Hi, I am submitting my handwritten answer for today\'s Daily Mains Question. Please evaluate.') }}" target="_blank" class="w-full py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-black text-xs flex items-center justify-center gap-2">
                        <i class="fa-solid fa-pen-nib"></i> Submit Handwritten Answer for Evaluation
                    </a>
                </div>
            </div>
        </div>
    </section>

    @elseif($currentTheme === 'coaching_web_commerce_ca')
    <!-- ======================================================== -->
    <!-- 📊 3. EXCEL CA & COMMERCE INSTITUTE                       -->
    <!-- Corporate Finance & Auditor + Pass Rate Benchmark Widget  -->
    <!-- ======================================================== -->
    <div class="bg-emerald-950 text-emerald-200 text-xs py-2 px-4 border-b border-emerald-800/50 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 overflow-x-auto whitespace-nowrap">
            <div class="flex items-center gap-2 font-bold">
                <span class="px-2 py-0.5 rounded bg-emerald-500 text-slate-950 text-[10px] uppercase font-black">📊 ICAI RESULTS 2026</span>
                <span>Institute Pass Percentage: 54.2% (vs 14.8% ICAI All-India Average) &bull; 100% Big 4 Articleship Matching Desk!</span>
            </div>
            <a href="#services" class="text-[11px] font-bold text-white underline hover:text-emerald-300">View Rankers &rarr;</a>
        </div>
    </div>

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-emerald-50 via-white to-slate-50 border-b border-emerald-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold border border-emerald-200">
                        <i class="fa-solid fa-calculator text-emerald-600"></i> Chartered Accountancy, CS &amp; Commerce Hub
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-[1.12]">
                        CA Foundation, Inter &amp; Final with <span class="text-emerald-700">Practicing CAs &amp; Tax Auditors</span>
                    </h1>

                    <p class="text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Welcome to {{ $tenant->business_name }}. Premier professional commerce academy delivering exam-oriented concept clarity, rigorous ICAI question bank drills, fast-track revision marathons, and Big 4 articleship interview preparation in {{ $tenant->city ?: 'Nagpur' }}.
                    </p>

                    <!-- Trust Checklist -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-w-lg mx-auto lg:mx-0 text-xs text-slate-700 font-semibold">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-600"></i> 3.6x Higher Pass % than National Average</span>
                        <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-600"></i> Real Articleship Audit Lab Experience</span>
                        <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-600"></i> Topic-wise ICAI Test Series with Corrections</span>
                        <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-600"></i> Fast-Track Exam Marathons &amp; Revision</span>
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-emerald-700 hover:bg-emerald-600 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-emerald-700/25 transition flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-graduation-cap"></i> Explore CA Batches
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to get CA batch details and fee structure.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-600 text-base"></i> Talk to Senior CA Faculty
                        </a>
                    </div>
                </div>

                <!-- Right 5 Cols: Pass Rate Benchmark Comparison Widget -->
                <div class="lg:col-span-5">
                    <div class="bg-white border-2 border-emerald-200 rounded-3xl p-6 sm:p-7 shadow-2xl relative">
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600 block mb-1">ICAI SUCCESS BENCHMARK</span>
                        <h3 class="text-xl font-black text-slate-900 mb-6">Proven Exam Pass Percentage</h3>

                        <!-- Progress Bars -->
                        <div class="space-y-5 mb-6">
                            <div>
                                <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                                    <span class="text-emerald-800 font-extrabold flex items-center gap-1.5">
                                        <i class="fa-solid fa-award text-emerald-600"></i> {{ $tenant->business_name }}
                                    </span>
                                    <span class="text-emerald-700 font-black text-sm">54.2%</span>
                                </div>
                                <div class="w-full h-4 bg-emerald-100 rounded-full overflow-hidden p-0.5">
                                    <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full" style="width: 54.2%;"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between text-xs font-bold mb-1.5 text-slate-500">
                                    <span>All-India ICAI National Average</span>
                                    <span class="text-slate-700 font-bold">14.8%</span>
                                </div>
                                <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-slate-400 rounded-full" style="width: 14.8%;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Articleship Placement Partners Wall -->
                        <div class="pt-4 border-t border-slate-100">
                            <span class="text-[11px] font-bold text-slate-500 block mb-2">Our Students Doing Articleship At:</span>
                            <div class="grid grid-cols-3 gap-2 text-center text-[10px] font-extrabold text-slate-700">
                                <span class="p-2 rounded-xl bg-slate-50 border border-slate-200">DELOITTE</span>
                                <span class="p-2 rounded-xl bg-slate-50 border border-slate-200">PwC INDIA</span>
                                <span class="p-2 rounded-xl bg-slate-50 border border-slate-200">EY GLOBAL</span>
                                <span class="p-2 rounded-xl bg-slate-50 border border-slate-200">KPMG</span>
                                <span class="p-2 rounded-xl bg-slate-50 border border-slate-200">BDO INDIA</span>
                                <span class="p-2 rounded-xl bg-slate-50 border border-slate-200">GRANT THORNTON</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif($currentTheme === 'coaching_web_ielts_abroad')
    <!-- ======================================================== -->
    <!-- ✈️ 4. GLOBALEDGE IELTS & STUDY ABROAD ACADEMY             -->
    <!-- Global Aviation Theme + Interactive Country Destination  -->
    <!-- ======================================================== -->
    <div class="bg-sky-950 text-sky-200 text-xs py-2 px-4 border-b border-sky-800/50 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 overflow-x-auto whitespace-nowrap">
            <div class="flex items-center gap-2 font-bold">
                <span class="px-2 py-0.5 rounded bg-sky-500 text-slate-950 text-[10px] uppercase font-black">✈️ OVERSEAS EDUCATION</span>
                <span>Guaranteed Band 8+ IELTS Coaching &bull; 100% Visa Filing Success &bull; Top 100 Global University Admissions!</span>
            </div>
            <a href="#services" class="text-[11px] font-bold text-white underline hover:text-sky-300">Free Profile Check &rarr;</a>
        </div>
    </div>

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-sky-50 via-white to-blue-50/50 border-b border-sky-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Interactive Destination Selector Bar -->
            <div class="bg-white p-3 sm:p-4 rounded-2xl border border-sky-200 shadow-lg max-w-4xl mx-auto mb-10">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                    <span class="font-extrabold text-slate-800 uppercase tracking-wider text-[11px] shrink-0">
                        <i class="fa-solid fa-plane-departure text-sky-600 mr-1.5"></i> Select Your Dream Destination:
                    </span>
                    <div class="flex items-center gap-2 overflow-x-auto max-w-full pb-1 sm:pb-0">
                        <button class="px-3 py-1.5 rounded-xl bg-sky-600 text-white font-bold whitespace-nowrap shadow">🇺🇸 USA (Ivy League)</button>
                        <button class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold whitespace-nowrap">🇬🇧 UK (Russell Group)</button>
                        <button class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold whitespace-nowrap">🇨🇦 Canada (PGWP &amp; PR)</button>
                        <button class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold whitespace-nowrap">🇦🇺 Australia (Group of 8)</button>
                        <button class="px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold whitespace-nowrap">🇩🇪 Germany (Tuition-Free)</button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <!-- Left 7 -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-100 text-sky-800 text-xs font-bold border border-sky-200">
                        <i class="fa-solid fa-award text-sky-600"></i> Certified British Council &amp; IDP IELTS Master Trainers
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-[1.12]">
                        Guaranteed <span class="text-sky-600">Band 8+ IELTS</span> Coaching &amp; Top 100 University Admissions
                    </h1>

                    <p class="text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Welcome to {{ $tenant->business_name }}. Comprehensive overseas education coaching with 1-on-1 AI-assisted speaking interview simulators, SOP/LOR drafting cell, university profile matching, and hassle-free visa filing in {{ $tenant->city ?: 'Nagpur' }}.
                    </p>

                    <!-- Features -->
                    <div class="grid grid-cols-2 gap-3 max-w-lg mx-auto lg:mx-0 text-xs font-bold text-slate-700">
                        <span class="p-2.5 rounded-xl bg-white border border-slate-200 flex items-center gap-2"><i class="fa-solid fa-microphone text-sky-500"></i> 1-on-1 Speaking Mock Labs</span>
                        <span class="p-2.5 rounded-xl bg-white border border-slate-200 flex items-center gap-2"><i class="fa-solid fa-passport text-sky-500"></i> 100% Visa Filing Assistance</span>
                        <span class="p-2.5 rounded-xl bg-white border border-slate-200 flex items-center gap-2"><i class="fa-solid fa-building-columns text-sky-500"></i> University Shortlisting Desk</span>
                        <span class="p-2.5 rounded-xl bg-white border border-slate-200 flex items-center gap-2"><i class="fa-solid fa-circle-check text-sky-500"></i> Free Band Score Evaluation</span>
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-sky-600 hover:bg-sky-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-sky-600/25 transition flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-plane-up"></i> Explore IELTS &amp; GRE Batches
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to book a Free Profile Evaluation for study abroad.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-600 text-base"></i> Book Free Visa Assessment
                        </a>
                    </div>
                </div>

                <!-- Right 5: Visa Stamp Wall -->
                <div class="lg:col-span-5">
                    <div class="bg-white border-2 border-sky-200 rounded-3xl p-6 sm:p-7 shadow-2xl">
                        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                            <div>
                                <span class="text-[10px] font-black uppercase tracking-widest text-sky-600 block">VISA SUCCESS STORIES</span>
                                <h3 class="text-base font-black text-slate-900">Recent University Admits</h3>
                            </div>
                            <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">100% Visa Ratio</span>
                        </div>

                        <div class="space-y-3">
                            <div class="p-3 rounded-2xl bg-sky-50/60 border border-sky-100 flex items-center justify-between">
                                <div>
                                    <h4 class="text-xs font-black text-slate-900">University of Toronto &bull; Canada</h4>
                                    <p class="text-[11px] text-slate-500">IELTS Band 8.5 &bull; MS in Data Science</p>
                                </div>
                                <span class="text-xs font-black text-sky-700 bg-sky-100 px-2.5 py-1 rounded-lg">VISA GRANTED</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-sky-50/60 border border-sky-100 flex items-center justify-between">
                                <div>
                                    <h4 class="text-xs font-black text-slate-900">University of Manchester &bull; UK</h4>
                                    <p class="text-[11px] text-slate-500">IELTS Band 8.0 &bull; MSc International Finance</p>
                                </div>
                                <span class="text-xs font-black text-sky-700 bg-sky-100 px-2.5 py-1 rounded-lg">VISA GRANTED</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-sky-50/60 border border-sky-100 flex items-center justify-between">
                                <div>
                                    <h4 class="text-xs font-black text-slate-900">TU Munich &bull; Germany</h4>
                                    <p class="text-[11px] text-slate-500">IELTS Band 7.5 &bull; Automotive Engineering</p>
                                </div>
                                <span class="text-xs font-black text-sky-700 bg-sky-100 px-2.5 py-1 rounded-lg">100% SCHOLARSHIP</span>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-100 text-center text-xs text-slate-500">
                            <span>Includes SOP, LOR, Bank Proofs &amp; Mock Visa Interviews</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    @elseif($currentTheme === 'coaching_web_coding_tech')
    <!-- ======================================================== -->
    <!-- 💻 5. CODECRAFT FULL-STACK & AI BOOTCAMP                  -->
    <!-- Developer Dark Mode + Live Interactive Terminal Mockup    -->
    <!-- ======================================================== -->
    <div class="bg-[#0B0F19] text-emerald-400 text-xs py-2 px-4 border-b border-slate-800 font-mono">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 overflow-x-auto whitespace-nowrap">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>$ npx codecraft --batch=2026 --placement-rate=98.4% --avg-ctc=14.5LPA</span>
            </div>
            <a href="#services" class="text-[11px] text-slate-400 hover:text-white underline">Explore Curriculum &rarr;</a>
        </div>
    </div>

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-[#0B0F19] text-slate-100 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/10 border border-purple-500/30 text-purple-300 text-xs font-mono">
                        <i class="fa-solid fa-code text-emerald-400"></i> Full-Stack Web Development &amp; Generative AI
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-[1.12]">
                        Zero to Job-Ready Software Engineer with <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-emerald-400 bg-clip-text text-transparent">10+ Production Capstones</span>
                    </h1>

                    <p class="text-base text-slate-300 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Welcome to {{ $tenant->business_name }}. Elite developer bootcamp covering React 19, Next.js, Node.js, PostgreSQL, Docker, AWS, and AI Agent workflows. Featuring 1-on-1 code reviews from senior FAANG engineers and dedicated placement cell in {{ $tenant->city ?: 'Nagpur' }}.
                    </p>

                    <!-- Tech Stack Pills -->
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start font-mono text-xs">
                        <span class="px-3 py-1 rounded-lg bg-slate-900 border border-slate-700 text-slate-300"><i class="fa-brands fa-react text-sky-400 mr-1"></i> React 19</span>
                        <span class="px-3 py-1 rounded-lg bg-slate-900 border border-slate-700 text-slate-300"><i class="fa-brands fa-node text-emerald-400 mr-1"></i> Node.js</span>
                        <span class="px-3 py-1 rounded-lg bg-slate-900 border border-slate-700 text-slate-300"><i class="fa-brands fa-python text-amber-400 mr-1"></i> Python AI</span>
                        <span class="px-3 py-1 rounded-lg bg-slate-900 border border-slate-700 text-slate-300"><i class="fa-brands fa-docker text-blue-400 mr-1"></i> Docker &amp; Cloud</span>
                    </div>

                    <!-- Metrics Bar -->
                    <div class="grid grid-cols-3 gap-3 max-w-md mx-auto lg:mx-0 text-left pt-1">
                        <div class="p-3 rounded-2xl bg-slate-900/90 border border-slate-800">
                            <span class="text-xl font-black text-emerald-400 block font-mono">14.5 LPA</span>
                            <span class="text-[10px] text-slate-400 font-bold uppercase">Average CTC</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-slate-900/90 border border-slate-800">
                            <span class="text-xl font-black text-purple-400 block font-mono">42 LPA</span>
                            <span class="text-[10px] text-slate-400 font-bold uppercase">Highest CTC</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-slate-900/90 border border-slate-800">
                            <span class="text-xl font-black text-sky-400 block font-mono">300+</span>
                            <span class="text-[10px] text-slate-400 font-bold uppercase">Hiring Partners</span>
                        </div>
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 via-indigo-600 to-emerald-600 hover:opacity-90 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-purple-600/25 transition flex items-center justify-center gap-2 cursor-pointer font-mono">
                            <i class="fa-solid fa-terminal"></i> Apply for Bootcamp
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to check the tech bootcamp syllabus and schedule.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-700 text-slate-200 font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2 font-mono">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Talk to Lead Tech Mentor
                        </a>
                    </div>
                </div>

                <!-- Right 5 Cols: Dark Code Editor Mockup -->
                <div class="lg:col-span-5">
                    <div class="bg-[#030712] border border-slate-800 rounded-3xl overflow-hidden shadow-2xl font-mono text-xs">
                        <!-- macOS style buttons bar -->
                        <div class="bg-slate-900/90 px-4 py-3 border-b border-slate-800 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                                <span class="w-3 h-3 rounded-full bg-amber-500 inline-block"></span>
                                <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                                <span class="text-[11px] text-slate-400 ml-2">career-launch.ts</span>
                            </div>
                            <span class="text-[10px] text-purple-400 font-bold">TypeScript 5.4</span>
                        </div>

                        <!-- Code Body -->
                        <div class="p-5 space-y-2 text-slate-300 leading-relaxed text-[11px]">
                            <p class="text-slate-500">// Welcome to {{ $tenant->business_name }}</p>
                            <p><span class="text-purple-400">import</span> { <span class="text-yellow-300">SoftwareEngineer</span> } <span class="text-purple-400">from</span> <span class="text-emerald-400">'@codecraft/career'</span>;</p>
                            <p class="pt-2"><span class="text-purple-400">async function</span> <span class="text-blue-400">launchCareer</span>() {</p>
                            <p class="pl-4"><span class="text-purple-400">const</span> student = <span class="text-purple-400">await</span> <span class="text-yellow-300">SoftwareEngineer</span>.<span class="text-blue-400">enroll</span>({</p>
                            <p class="pl-8">stack: [<span class="text-emerald-400">'NextJS'</span>, <span class="text-emerald-400">'Postgres'</span>, <span class="text-emerald-400">'GenAI'</span>],</p>
                            <p class="pl-8">capstones: <span class="text-amber-400">10</span>,</p>
                            <p class="pl-8">mentor: <span class="text-emerald-400">'1-on-1 FAANG SDE'</span></p>
                            <p class="pl-4">});</p>
                            <p class="pl-4 pt-1"><span class="text-purple-400">const</span> dreamOffer = <span class="text-purple-400">await</span> student.<span class="text-blue-400">getPlacement</span>();</p>
                            <p class="pl-4 text-emerald-400"><span class="text-purple-400">return</span> `Placed as ${dreamOffer.role} @ ${dreamOffer.ctc}!`;</p>
                            <p>}</p>
                            <div class="mt-4 pt-3 border-t border-slate-800/80 flex items-center justify-between text-[10px] text-slate-400">
                                <span>Status: <span class="text-emerald-400 font-bold">Live Hiring Drives Active</span></span>
                                <span>Zero Upfront Assessment</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif($currentTheme === 'coaching_web_school_tuition')
    <!-- ======================================================== -->
    <!-- 📚 6. BRIGHTMINDS K-12 BOARD TUITIONS                     -->
    <!-- Warm Trust Amber Theme + Max 15 Batch + Parent App UI    -->
    <!-- ======================================================== -->
    <div class="bg-amber-950 text-amber-200 text-xs py-2 px-4 border-b border-amber-800/50 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 overflow-x-auto whitespace-nowrap">
            <div class="flex items-center gap-2 font-bold">
                <span class="px-2 py-0.5 rounded bg-amber-400 text-slate-950 text-[10px] uppercase font-black">📚 K-12 BOARD EXCELLENCE</span>
                <span>Max 15 Students Per Batch Guaranteed &bull; 94.6% Students Scored Above 90% in CBSE/ICSE &bull; Free 1-Week Trial Class</span>
            </div>
            <a href="#services" class="text-[11px] font-bold text-white underline hover:text-amber-300">Book Free Demo &rarr;</a>
        </div>
    </div>

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-amber-50 via-white to-stone-50 border-b border-amber-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-900 text-xs font-bold border border-amber-200">
                        <i class="fa-solid fa-users text-amber-600"></i> Strict Limit: Maximum 15 Students per Batch
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-[1.12]">
                        Personalized <span class="text-amber-600">K-12 Tuitions</span>, Concept Clarity &amp; Weekly Parent Updates
                    </h1>

                    <p class="text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Welcome to {{ $tenant->business_name }}. Tailored school tuitions for Classes 6th to 12th (CBSE, ICSE &amp; State Boards). We finish the entire syllabus 3 months in advance with weekly Sunday chapter tests and detailed progress reporting to parents in {{ $tenant->city ?: 'Nagpur' }}.
                    </p>

                    <!-- Parent Promises -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 max-w-lg mx-auto lg:mx-0 text-xs font-bold text-slate-700">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-amber-600"></i> Max 15 Students (Individual Attention)</span>
                        <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-amber-600"></i> Syllabus Finished 90 Days Early</span>
                        <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-amber-600"></i> Weekly Sunday Tests &amp; WhatsApp Report</span>
                        <span class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-amber-600"></i> Free Dedicated Doubt Clearing Class</span>
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-amber-600 hover:bg-amber-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-600/25 transition flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-book-open"></i> Explore Grade Batches
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I want to register my child for a Free 1-Week Trial Class.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-600 text-base"></i> Book Free 1-Week Trial
                        </a>
                    </div>
                </div>

                <!-- Right 5: Parent Portal & Progress Card -->
                <div class="lg:col-span-5">
                    <div class="bg-white border-2 border-amber-200 rounded-3xl p-6 sm:p-7 shadow-2xl">
                        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                            <div>
                                <span class="text-[10px] font-black uppercase tracking-widest text-amber-600 block">PARENT DASHBOARD PREVIEW</span>
                                <h3 class="text-base font-black text-slate-900">Weekly Student Analytics</h3>
                            </div>
                            <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">98% Regularity</span>
                        </div>

                        <!-- Analytics Stats -->
                        <div class="space-y-3 mb-4">
                            <div class="p-3 rounded-2xl bg-amber-50/60 border border-amber-100 flex items-center justify-between text-xs">
                                <div>
                                    <span class="font-bold text-slate-900 block">Sunday Chapter Test (Mathematics)</span>
                                    <span class="text-[11px] text-slate-500">Quadratic Equations &amp; Trigonometry</span>
                                </div>
                                <span class="text-sm font-black text-emerald-600 bg-white px-2.5 py-1 rounded-lg border border-emerald-200">48 / 50</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-amber-50/60 border border-amber-100 flex items-center justify-between text-xs">
                                <div>
                                    <span class="font-bold text-slate-900 block">Physics Concept Quiz</span>
                                    <span class="text-[11px] text-slate-500">Optics &amp; Electricity Numericals</span>
                                </div>
                                <span class="text-sm font-black text-emerald-600 bg-white px-2.5 py-1 rounded-lg border border-emerald-200">24 / 25</span>
                            </div>
                        </div>

                        <!-- Teacher's Note to Parent -->
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-600">
                            <strong class="text-slate-900 block mb-1">Teacher's Note to Parent:</strong>
                            <p class="italic text-[11px]">"Student has shown 22% improvement in Physics problem solving over last 3 weeks. Ready for Board Exam Mock."</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif(in_array($currentTheme, ['doctor_web_consultant_physician', 'doctor_web_pediatrician_child', 'doctor_web_gynecologist_women', 'doctor_web_ortho_surgeon', 'doctor_web_derma_trichologist', 'doctor_web_cardio_heart']) || ($this->isBusinessWebsite && $bizCat === 'Doctors & Specialists'))
    <!-- ======================================================== -->
    <!-- 🩺 LAYOUT: DOCTOR & SPECIALIST CLINIC (WEBSITE)          -->
    <!-- Clinical Precision + Verified Credentials + OPD Schedule -->
    <!-- ======================================================== -->
    @php
        $doctorConfig = match($currentTheme) {
            'doctor_web_pediatrician_child' => [
                'badge' => '👶 Pediatric & Child Care Specialist • MD (Pediatrics)',
                'title' => 'Compassionate Child Healthcare, Immunization & Growth Tracking',
                'desc' => 'Dedicated pediatric OPD providing newborn care, milestone monitoring, painless vaccinations, and 24/7 pediatric emergency triage in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=400&auto=format&fit=crop&q=80',
                'pills' => ['MD Senior Pediatrician', 'Painless Vaccinations', 'Growth Milestone Tracking', 'Child-Friendly Clinic'],
                'tag' => '★ 5.0 PEDIATRIC CARE',
            ],
            'doctor_web_gynecologist_women' => [
                'badge' => '🌸 Obstetrics & Advanced Gynecologist • MS (OB-GYN)',
                'title' => 'Comprehensive Women’s Health, Antenatal Care & Laparoscopy',
                'desc' => 'Empathetic women-first clinical practice specializing in high-risk pregnancy management, PCOS/PCOD reversal, laparoscopic wellness, and fertility guidance in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1594824813524-8b63e9f45209?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&auto=format&fit=crop&q=80',
                'pills' => ['MS OB-GYN Specialist', 'High-Risk Pregnancy Care', 'Holistic PCOS Guidance', 'Advanced Laparoscopy'],
                'tag' => '★ 5.0 WOMEN HEALTH',
            ],
            'doctor_web_ortho_surgeon' => [
                'badge' => '🦴 Orthopedic & Joint Replacement Surgeon • MS (Ortho)',
                'title' => 'Pioneering Joint Preservation, Spine & Sports Injury Recovery',
                'desc' => 'Advanced orthopedic surgical consultations, minimally invasive arthroscopy, robotic joint replacement guidance, and fracture rehabilitation in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1584467735871-8e85353a8413?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1584017911766-d451b3d0e843?w=400&auto=format&fit=crop&q=80',
                'pills' => ['MS Orthopedic Surgeon', 'Robotic Joint Surgery', 'Keyhole Arthroscopy', 'Sports Injury Rehab'],
                'tag' => '★ 4.9 ORTHO CLINIC',
            ],
            'doctor_web_derma_trichologist' => [
                'badge' => '✨ Dermatologist, Cosmetologist & Trichologist • MD (Derma)',
                'title' => 'Clinical Dermatology, US-FDA Lasers & Hair Regrowth Therapies',
                'desc' => 'Evidence-based clinical skincare, acne scar remodeling, medical facials, GFC hair regrowth protocols, and pigment reduction in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1512290900672-1f4967396752?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1608248597359-00995fa1b6cf?w=400&auto=format&fit=crop&q=80',
                'pills' => ['MD Dermatologist', 'US-FDA Laser Tech', 'GFC Hair Regrowth', 'Custom Clinical Serums'],
                'tag' => '★ 5.0 DERMA & TRICHO',
            ],
            'doctor_web_cardio_heart' => [
                'badge' => '❤️ Interventional Cardiologist • DM (Cardiology)',
                'title' => 'Preventive Cardiac Care, ECG/2D Echo & Hypertension Control',
                'desc' => 'Comprehensive cardiac evaluation, ambulatory BP monitoring, lipid profile assessment, post-angioplasty care, and lifestyle heart wellness in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=400&auto=format&fit=crop&q=80',
                'pills' => ['DM Senior Cardiologist', '2D Echo & TMT Desk', 'Hypertension Protocol', 'Heart Health Check'],
                'tag' => '★ 4.9 CARDIAC CLINIC',
            ],
            default => [
                'badge' => '🩺 Senior Consultant Physician & Diabetologist • MD (Medicine)',
                'title' => 'Evidence-Based General Medicine, Diabetes & Chronic Care OPD',
                'desc' => 'Comprehensive adult primary care, hypertension management, seasonal infectious fever diagnosis, thyroid disorders, and preventive health screenings in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=400&auto=format&fit=crop&q=80',
                'pills' => ['MD General Medicine', 'Zero Waiting Slots', 'Digital Prescriptions', 'Preventive Health'],
                'tag' => '★ 5.0 MD PHYSICIAN',
            ],
        };
    @endphp

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-sky-50/60 via-white to-teal-50/30 border-b border-sky-100">
        <!-- Ambient Clinical Glow Orbs -->
        <div class="absolute top-0 right-1/4 w-96 h-96 rounded-full bg-sky-200/35 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 rounded-full bg-teal-200/25 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols: Specialist Doctor Overview -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-sky-200 text-sky-800 text-xs font-bold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-sky-600 animate-pulse"></span>
                        <span>{{ $doctorConfig['badge'] }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-[1.12]">
                        {{ $doctorConfig['title'] }}
                    </h1>

                    <p class="text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        {{ $doctorConfig['desc'] }}
                    </p>

                    <!-- Trust Pills -->
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        @foreach($doctorConfig['pills'] as $pill)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-white border border-sky-200 text-slate-700 text-xs font-bold shadow-2xs">
                            <i class="fa-solid fa-user-doctor text-sky-600 text-xs"></i> {{ $pill }}
                        </span>
                        @endforeach
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-sky-600 to-teal-700 hover:from-sky-500 hover:to-teal-600 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-sky-600/25 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-calendar-check text-sm"></i> Book Clinical Consultation
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello Dr. ' . $tenant->business_name . ', I would like to schedule an OPD consultation slot.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-500 text-base"></i> Doctor's WhatsApp
                        </a>
                    </div>

                    <!-- OPD Timings Strip -->
                    <div class="pt-2 flex items-center justify-center lg:justify-start gap-4 text-xs font-semibold text-slate-500">
                        <span class="flex items-center gap-1.5 text-sky-700">
                            <i class="fa-solid fa-stethoscope"></i> Verified Specialist MD/MS
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-slate-700">
                            <i class="fa-solid fa-clock"></i> Timings: 10:00 AM - 08:00 PM
                        </span>
                    </div>
                </div>

                <!-- Right 5 Cols: Visual Clinical Cards -->
                <div class="lg:col-span-5">
                    <div class="relative">
                        <!-- Main Doctor Image -->
                        <div class="h-80 sm:h-96 rounded-3xl overflow-hidden shadow-2xl border-4 border-white relative group">
                            <img src="{{ $doctorConfig['hero_img'] }}" alt="Specialist Doctor Consultation" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent flex flex-col justify-between p-4">
                                <span class="self-start px-3 py-1 rounded-full bg-white/90 backdrop-blur-md text-sky-800 text-[10px] font-black uppercase tracking-wider shadow-sm">
                                    {{ $doctorConfig['tag'] }}
                                </span>
                                <div>
                                    <h3 class="text-white font-black text-lg">{{ $tenant->business_name }}</h3>
                                    <p class="text-sky-200 text-xs font-semibold">{{ $tenant->city ?: 'Specialist Healthcare' }} &bull; Certified OPD Chambers</p>
                                </div>
                            </div>
                        </div>

                        <!-- Side Floating Cards -->
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white relative group">
                                <img src="{{ $doctorConfig['side_img1'] }}" alt="Clinical Chamber" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Private Chambers</span>
                                </div>
                            </div>
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white relative group">
                                <img src="{{ $doctorConfig['side_img2'] }}" alt="Digital Healthcare" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Digital Health</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif(in_array($currentTheme, ['herbal_web_panchakarma_sanctuary', 'herbal_web_nadi_pariksha_clinic', 'herbal_web_herbal_farm_apothecary', 'herbal_web_ayurvedic_lifestyle_retreat', 'herbal_web_classical_vaidya_hospital', 'herbal_web_ayurvedic_fertility_care']) || ($this->isBusinessWebsite && $bizCat === 'Herbal Care'))
    <!-- ======================================================== -->
    <!-- 🌿 LAYOUT: AYURVEDIC WELLNESS & HERBAL SANCTUARY (WEBSITE) -->
    <!-- Authentic Vaidya Wisdom + Classical Panchakarma + Nature -->
    <!-- ======================================================== -->
    @php
        $herbalConfig = match($currentTheme) {
            'herbal_web_nadi_pariksha_clinic' => [
                'badge' => '🧘 Classical Nadi Pariksha Clinic • BAMS Senior Vaidya',
                'title' => 'Ancient Pulse Diagnosis, Tridosha Mapping & Chronic Healing',
                'desc' => 'Discover the root cause of chronic illness through classical Nadi Pariksha. Personalized Vata-Pitta-Kapha balancing diets and customized herbal decoctions in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1512290903671-17adc5ae042e?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Authentic Pulse Reading', 'Tridosha Imbalance Map', 'Custom Herb Formulations', 'Non-Invasive Root Cause'],
                'tag' => '★ 5.0 NADI PARIKSHA',
            ],
            'herbal_web_herbal_farm_apothecary' => [
                'badge' => '🌱 Organic Herb Garden & Botanical Farm Apothecary',
                'title' => 'Living Medicinal Plants, Rare Herb Cultivation & Pure Botanicals',
                'desc' => 'Certified pesticide-free botanical gardens cultivating ancient medicinal herbs. Fresh living potted plants, raw dried herbal ingredients, and guided educational farm tours in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=400&auto=format&fit=crop&q=80',
                'pills' => ['100% Organic Certified', 'Endangered Herbs Bank', 'Farm-to-Bottle Traceability', 'Heritage Herb Seeds'],
                'tag' => '★ 4.9 BOTANICAL FARM',
            ],
            'herbal_web_ayurvedic_lifestyle_retreat' => [
                'badge' => '🕊️ Satvik Living, Yoga & Mindful Detox Retreat',
                'title' => 'Residential Rejuvenation, Forest Meditation & Satvik Cuisine',
                'desc' => 'Peaceful natural sanctuary for mental tranquility and physical revitalization. Sunrise asanas, guided sound meditation, organic garden-fresh Satvik dining, and forest villas in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1507652313519-d4e9174996dd?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Guided Daily Asanas', 'Satvik Organic Dining', 'Forest Villa Cottages', 'Sound Bowl Meditation'],
                'tag' => '★ 5.0 WELLNESS RETREAT',
            ],
            'herbal_web_classical_vaidya_hospital' => [
                'badge' => '🏥 NABH-Accredited Classical Ayurvedic Hospital',
                'title' => 'In-Patient Panchakarma, Spine Rehabilitation & Neuro Care',
                'desc' => 'Full-fledged in-patient classical Ayurvedic healthcare facility. Comprehensive natural management of chronic disc slip, sciatica, arthritis, post-stroke rehab, and geriatrics in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1583912267670-6575ad362e3b?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=400&auto=format&fit=crop&q=80',
                'pills' => ['NABH Accredited Hospital', 'Spine & Neuro Care Wing', '24/7 Resident Vaidyas', 'Cashless Mediclaim Desk'],
                'tag' => '★ 4.9 AYURVEDA HOSPITAL',
            ],
            'herbal_web_ayurvedic_fertility_care' => [
                'badge' => '🌸 Garbh Sanskar, Natural Fertility & Postnatal Recovery',
                'title' => 'Classical Beej Shuddhi, Pre-Conception & 40-Day Mother Care',
                'desc' => 'Holistic Ayurvedic reproductive health clinic. Pre-conception Ayurvedic cleansing, Vedic Garbh Sanskar mantra sessions, prenatal yoga, and authentic 40-day postpartum mother recovery in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Classical Garbh Sanskar', 'Natural Beej Shuddhi', '40-Day Sutika Recovery', 'Ayurvedic Lactation Care'],
                'tag' => '★ 5.0 MOTHER & BABY',
            ],
            default => [
                'badge' => '🌿 Authentic Classical Panchakarma Sanctuary',
                'title' => 'Authentic Panchakarma Shodhana, Shirodhara & Herbal Detox',
                'desc' => 'Traditional Ayurvedic wellness center offering certified classical 7-day and 14-day detox packages, authentic warm herbal tailam Shirodhara, and BAMS Vaidya consultations in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1512290903671-17adc5ae042e?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=400&auto=format&fit=crop&q=80',
                'pills' => ['BAMS Senior Vaidyas', 'Classical Shirodhara Suites', 'Authentic Medicated Steam', '100% Herbal Tailams'],
                'tag' => '★ 5.0 PANCHAKARMA RETREAT',
            ],
        };
    @endphp

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-emerald-50/70 via-white to-teal-50/40 border-b border-emerald-100">
        <!-- Ambient Botanical Glow Orbs -->
        <div class="absolute top-0 right-1/4 w-96 h-96 rounded-full bg-emerald-200/40 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 rounded-full bg-teal-200/30 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols: Herbal Sanctuary Overview -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-emerald-200 text-emerald-800 text-xs font-bold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                        <span>{{ $herbalConfig['badge'] }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-[1.12]">
                        {{ $herbalConfig['title'] }}
                    </h1>

                    <p class="text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        {{ $herbalConfig['desc'] }}
                    </p>

                    <!-- Trust Pills -->
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        @foreach($herbalConfig['pills'] as $pill)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-white border border-emerald-200 text-slate-700 text-xs font-bold shadow-2xs">
                            <i class="fa-solid fa-leaf text-emerald-600 text-xs"></i> {{ $pill }}
                        </span>
                        @endforeach
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-500 hover:to-teal-600 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-emerald-600/25 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-calendar-check text-sm"></i> Book Vaidya Consultation
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Namaste ' . $tenant->business_name . ', I would like to book an Ayurvedic therapy session / Nadi Pariksha.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-500 text-base"></i> Sanctuary WhatsApp
                        </a>
                    </div>

                    <!-- Trust & Timing Strip -->
                    <div class="pt-2 flex items-center justify-center lg:justify-start gap-4 text-xs font-semibold text-slate-500">
                        <span class="flex items-center gap-1.5 text-emerald-700">
                            <i class="fa-solid fa-spa"></i> Authentic Panchakarma &amp; Nadi Pariksha
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-slate-700">
                            <i class="fa-solid fa-clock"></i> Timings: 07:00 AM - 07:00 PM
                        </span>
                    </div>
                </div>

                <!-- Right 5 Cols: Visual Herbal Sanctuary Cards -->
                <div class="lg:col-span-5">
                    <div class="relative">
                        <!-- Main Sanctuary Image -->
                        <div class="h-80 sm:h-96 rounded-3xl overflow-hidden shadow-2xl border-4 border-white relative group">
                            <img src="{{ $herbalConfig['hero_img'] }}" alt="Ayurvedic Wellness Sanctuary" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent flex flex-col justify-between p-4">
                                <span class="self-start px-3 py-1 rounded-full bg-white/90 backdrop-blur-md text-emerald-800 text-[10px] font-black uppercase tracking-wider shadow-sm">
                                    {{ $herbalConfig['tag'] }}
                                </span>
                                <div>
                                    <h3 class="text-white font-black text-lg">{{ $tenant->business_name }}</h3>
                                    <p class="text-emerald-200 text-xs font-semibold">{{ $tenant->city ?: 'Ayurvedic Retreat' }} &bull; Classical Vaidya Sanctuary</p>
                                </div>
                            </div>
                        </div>

                        <!-- Side Floating Cards -->
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white relative group">
                                <img src="{{ $herbalConfig['side_img1'] }}" alt="Ayurvedic Chamber" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Shirodhara Suites</span>
                                </div>
                            </div>
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white relative group">
                                <img src="{{ $herbalConfig['side_img2'] }}" alt="Herbal Formulations" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Pure Tailams</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif(in_array($currentTheme, ['b2b_industrial', 'mfg_web_precision_machining_plant', 'mfg_web_sheet_metal_laser_fabrication', 'mfg_web_injection_moulding_polymers', 'mfg_web_industrial_automation_robotics', 'mfg_web_corrugated_packaging_boxes', 'mfg_web_textile_garment_spinning_mill']) || str_starts_with($currentTheme, 'mfg_web_') || ($this->isBusinessWebsite && $bizCat === 'Manufacturers'))
    <!-- ======================================================== -->
    <!-- 🏭 LAYOUT: PRECISION MANUFACTURING & INDUSTRIAL PLANT    -->
    <!-- Heavy Engineering + ISO Compliance + Plant Tour + RFQ   -->
    <!-- ======================================================== -->
    @php
        $mfgConfig = match($currentTheme) {
            'mfg_web_sheet_metal_laser_fabrication' => [
                'badge' => '⚡ 12kW Fiber Laser Cutting & CNC Press Brake Fabrication',
                'title' => 'Advanced Sheet Metal Engineering, Enclosures & Structural Works',
                'desc' => 'High-power 12kW fiber laser cutting, 250-ton CNC press brake bending, electrical control panel enclosures, and automated robotic MIG/TIG welding in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=400&auto=format&fit=crop&q=80',
                'pills' => ['12kW Fiber Laser Bed', '250-Ton CNC Press Brake', 'Robotic TIG/MIG Welding', 'Powder Coating Line'],
                'tag' => '★ 5.0 LASER FABRICATION',
            ],
            'mfg_web_injection_moulding_polymers' => [
                'badge' => '🧪 Precision Injection Moulding & In-House Tool Room',
                'title' => 'High-Speed Thermoplastic Injection & Custom Mould Engineering',
                'desc' => 'All-electric 50T to 850T injection moulding presses, in-house CAD/CAM tooling room, clean-room assembly, and precision components for automotive and medical devices in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1581092162384-8987c1d64718?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=400&auto=format&fit=crop&q=80',
                'pills' => ['50T-850T All-Electric Presses', 'In-House Tool & Die Shop', 'Clean Room Assembly', 'UL-94 Flame Retardant'],
                'tag' => '★ 4.9 POLYMER MOULDING',
            ],
            'mfg_web_industrial_automation_robotics' => [
                'badge' => '🤖 Turnkey Smart Factory Automation & Robotic Cells',
                'title' => 'Custom Industrial Machinery, SCADA Panels & Robotics',
                'desc' => 'Designing and commissioning high-speed automated packaging lines, delta pick-and-place robotics, PLC/SCADA control desks, and Industry 4.0 smart conveyors in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Turnkey PLC & SCADA', 'Robotic Handling Cells', 'Custom SPM Machinery', 'Industry 4.0 IoT Cloud'],
                'tag' => '★ 5.0 SMART FACTORY',
            ],
            'mfg_web_corrugated_packaging_boxes' => [
                'badge' => '📦 High-Bursting Strength Corrugated Box Manufacturing',
                'title' => 'Export-Grade 5-Ply & 7-Ply Heavy Duty Shipping Cartons',
                'desc' => 'Automated high-speed flexo printer slotter, rotary die-cutters, honeycomb protective buffers, and custom printed shipper boxes for heavy cargo in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1586528116493-a029325540fa?w=400&auto=format&fit=crop&q=80',
                'pills' => ['5-Ply & 7-Ply Fluting', 'Export Heavy-Duty Cartons', 'Auto Flexo Printing', 'Bursting Strength Testing'],
                'tag' => '★ 4.9 PACKAGING MILL',
            ],
            'mfg_web_textile_garment_spinning_mill' => [
                'badge' => '🧵 Integrated Ring Spinning, Knitted Fabrics & Garment Mill',
                'title' => 'Combed Cotton Yarn, Circular Knit Fabrics & Private Apparel',
                'desc' => 'Vertically integrated 50,000 spindle ring spinning facility, German circular knitting machines, zero liquid discharge eco-dyeing, and bulk uniform production in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1606744824163-985d376605aa?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?w=400&auto=format&fit=crop&q=80',
                'pills' => ['OEKO-TEX 100 Certified', '50,000 Ring Spindles', 'Zero Liquid Discharge Dyeing', 'Private Label Apparel'],
                'tag' => '★ 5.0 TEXTILE MILL',
            ],
            default => [
                'badge' => '🏭 ISO 9001:2015 Precision CNC & Engineering Plant',
                'title' => 'Multi-Axis Precision CNC Machining & Heavy Engineering',
                'desc' => 'Equipped with 5-axis VMC machining centers, CNC turning lathes, coordinate measuring machine (CMM) inspection labs, and high-volume component production in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1581092334651-ddf26d9a09d0?w=400&auto=format&fit=crop&q=80',
                'pills' => ['5-Axis VMC Machining', 'IATF 16949 Certified', 'CMM Quality Inspection', 'High-Volume Production'],
                'tag' => '★ 5.0 PRECISION CNC',
            ],
        };
    @endphp

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-slate-900 via-slate-950 to-slate-900 text-white border-b border-slate-800">
        <!-- Ambient Factory Glow Orbs -->
        <div class="absolute top-0 right-1/4 w-96 h-96 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 rounded-full bg-indigo-600/20 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols: Plant Overview -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-800/90 border border-blue-500/40 text-blue-300 text-xs font-bold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        <span>{{ $mfgConfig['badge'] }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-[1.12]">
                        {{ $mfgConfig['title'] }}
                    </h1>

                    <p class="text-base text-slate-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        {{ $mfgConfig['desc'] }}
                    </p>

                    <!-- Trust Pills -->
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        @foreach($mfgConfig['pills'] as $pill)
                            <span class="px-3.5 py-1.5 rounded-xl bg-slate-800/80 border border-slate-700 text-xs font-semibold text-slate-200 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-blue-400 text-xs"></i>
                                <span>{{ $pill }}</span>
                            </span>
                        @endforeach
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-file-invoice text-sm"></i> Request Plant RFQ &bull; Download Specs
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to schedule a plant tour and discuss an industrial manufacturing requirement.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-slate-800 hover:bg-slate-700 border border-slate-700 text-white font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Commercial Desk WhatsApp
                        </a>
                    </div>

                    <!-- Plant Production Metric Strip -->
                    <div class="pt-2 flex items-center justify-center lg:justify-start gap-4 text-xs font-semibold text-slate-400">
                        <span class="flex items-center gap-1.5 text-blue-400">
                            <i class="fa-solid fa-industry"></i> ISO 9001:2015 Plant
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-slate-300">
                            <i class="fa-solid fa-shield-halved"></i> 100% Quality Inspected
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-slate-300">
                            <i class="fa-solid fa-truck-ramp-box"></i> Pan-India Logistics
                        </span>
                    </div>
                </div>

                <!-- Right 5 Cols: Visual Manufacturing Plant Cards -->
                <div class="lg:col-span-5">
                    <div class="relative">
                        <!-- Main Plant Image -->
                        <div class="h-80 sm:h-96 rounded-3xl overflow-hidden shadow-2xl border-4 border-slate-700 relative group">
                            <img src="{{ $mfgConfig['hero_img'] }}" alt="Manufacturing Plant & Engineering" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent flex flex-col justify-between p-4">
                                <span class="self-start px-3 py-1 rounded-full bg-slate-900/90 backdrop-blur-md text-blue-400 border border-blue-500/30 text-[10px] font-black uppercase tracking-wider shadow-sm">
                                    {{ $mfgConfig['tag'] }}
                                </span>
                                <div>
                                    <h3 class="text-white font-black text-lg">{{ $tenant->business_name }}</h3>
                                    <p class="text-blue-300 text-xs font-semibold">{{ $tenant->city ?: 'Heavy Engineering' }} &bull; High-Capacity Manufacturing Facility</p>
                                </div>
                            </div>
                        </div>

                        <!-- Side Floating Cards -->
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-slate-700 relative group">
                                <img src="{{ $mfgConfig['side_img1'] }}" alt="Factory Machinery" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">CNC Workshop</span>
                                </div>
                            </div>
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-slate-700 relative group">
                                <img src="{{ $mfgConfig['side_img2'] }}" alt="Inspection Lab" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">CMM Quality Lab</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif(in_array($currentTheme, ['retail_web_luxury_jewelry_showroom', 'retail_web_designer_apparel_boutique', 'retail_web_smart_electronics_megastore', 'retail_web_luxury_home_furniture_gallery', 'retail_web_premium_optical_eyewear_lounge', 'retail_web_artisan_organic_supermarket']) || str_starts_with($currentTheme, 'retail_web_') || ($currentTheme === 'modern_clean' && in_array($bizCat, ['Other Retail', 'Retail & E-Commerce'])) || ($this->isBusinessWebsite && in_array($bizCat, ['Other Retail', 'Retail & E-Commerce'])))
    <!-- ======================================================== -->
    <!-- 🏬 LAYOUT: PREMIER RETAIL STOREFRONT & SHOWROOM (WEBSITE) -->
    <!-- Luxury Showcase + Brand Tour + Department Catalog + WhatsApp -->
    <!-- ======================================================== -->
    @php
        $retailWebConfig = match($currentTheme) {
            'retail_web_designer_apparel_boutique' => [
                'badge' => '👗 Haute Couture Bridal Lehengas & Ethnic Fashion Studio',
                'title' => 'Couture Bridal Lehengas & Designer Ethnic Fashion Studio',
                'desc' => 'Curated couture boutique showcasing handcrafted zardozi bridal lehengas, royal wedding sherwanis, bespoke fitting trials, and personal stylist consultations in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Handcrafted Zardozi Art', 'Bespoke Fitting Trials', 'Celebrity Bridal Stylists', 'Doorstep Trial Service'],
                'tag' => '★ 5.0 COUTURE STUDIO',
            ],
            'retail_web_smart_electronics_megastore' => [
                'badge' => '⚡ Next-Gen Smart Home Electronics & Mobile Gadget Megastore',
                'title' => 'Flagship Smartphones, 4K OLED TVs & Smart Home Megastore',
                'desc' => 'Multi-brand electronics flagship showroom with live interactive demo zones, official brand warranty, instant exchange bonuses, and 0% interest paperless EMI in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Live Hands-on Demo Zone', 'Instant Exchange Bonus', 'Brand Authorised Warranty', 'Paperless 0% Easy EMI'],
                'tag' => '★ 4.9 TECH MEGASTORE',
            ],
            'retail_web_luxury_home_furniture_gallery' => [
                'badge' => '🛋️ Contemporary Teak Wood & Italian Leather Furniture Studio',
                'title' => 'Architectural Solid Sheesham & Italian Recliner Furniture Gallery',
                'desc' => 'Architectural furniture experience center displaying handcrafted solid wood dining sets, imported motorized recliners, custom modular wardrobes, and free 3D room styling in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&auto=format&fit=crop&q=80',
                'pills' => ['100% Solid Teak & Sheesham', 'Free 3D Living Room Layout', 'Motorized Recliner Lounges', '10-Year Termite Warranty'],
                'tag' => '★ 5.0 LUXURY LIVING',
            ],
            'retail_web_premium_optical_eyewear_lounge' => [
                'badge' => '👓 German Precision Eye Testing & Designer Eyewear Boutique',
                'title' => 'Zeiss Digital Eye Exams, International Frames & Precision Lenses',
                'desc' => 'Modern vision boutique equipped with German Zeiss digital refractive eye testing, international designer sunglass frames, progressive lenses, and 30-minute quick lens crafting in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1591076482161-42ce6da69f67?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Zeiss 3D Digital Eye Exam', 'Designer Eyewear Brands', 'Progressive Precision Lenses', '30-Minute Spectacle Delivery'],
                'tag' => '★ 4.9 EYECARE LOUNGE',
            ],
            'retail_web_artisan_organic_supermarket' => [
                'badge' => '🥦 Farm-Direct Organic Gourmet Grocery & Fresh Supermarket',
                'title' => 'Farm Fresh Organic Produce, Cold-Pressed Groceries & Superstore',
                'desc' => 'Wholesome farm-fresh supermarket offering residue-free organic fruits, pesticide-free hydroponic vegetables, cold-pressed artisanal groceries, and express neighborhood delivery in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Residue-Free Organics', 'Hydroponic Salad Greens', 'Bulk Dispenser Pantry', 'Express 2-Hour Delivery'],
                'tag' => '★ 5.0 FRESH GROCERY',
            ],
            default => [
                'badge' => '💎 Heritage Gold, Solitaire Diamond & Bridal Jewelry Showroom',
                'title' => 'Heritage Gold, Solitaire Diamond & Bridal Jewelry Showroom',
                'desc' => 'Prestigious heirloom jewelry house featuring BIS 916 hallmarked bridal gold, certified diamond solitaires, private bridal VIP lounge, and custom bespoke Karigari design studio in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?w=400&auto=format&fit=crop&q=80',
                'pills' => ['BIS 916 Hallmark Certified', 'IGI Certified Solitaires', 'Private Bridal Lounge', 'Custom Karigari Design'],
                'tag' => '★ 5.0 LUXURY JEWELRY',
            ],
        };
    @endphp

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-amber-50/60 via-white to-orange-50/30 border-b border-amber-100">
        <!-- Ambient Warm Retail Glow Orbs -->
        <div class="absolute top-0 right-1/4 w-96 h-96 rounded-full bg-amber-200/40 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 rounded-full bg-rose-200/30 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols: Store Overview -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-amber-200 text-amber-800 text-xs font-bold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        <span>{{ $retailWebConfig['badge'] }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-[1.12]">
                        {{ $retailWebConfig['title'] }}
                    </h1>

                    <p class="text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        {{ $retailWebConfig['desc'] }}
                    </p>

                    <!-- Trust Pills -->
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        @foreach($retailWebConfig['pills'] as $pill)
                            <span class="px-3.5 py-1.5 rounded-xl bg-white border border-amber-200 text-xs font-semibold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-amber-500 text-xs"></i>
                                <span>{{ $pill }}</span>
                            </span>
                        @endforeach
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-600 via-orange-600 to-rose-600 hover:from-amber-500 hover:to-rose-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-600/25 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-store text-sm"></i> Explore Collections &amp; Store Tour
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to book a private VIP shopping appointment.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-500 text-base"></i> VIP Store WhatsApp
                        </a>
                    </div>

                    <!-- Store Metric Strip -->
                    <div class="pt-2 flex items-center justify-center lg:justify-start gap-4 text-xs font-semibold text-slate-500">
                        <span class="flex items-center gap-1.5 text-amber-700">
                            <i class="fa-solid fa-certificate"></i> 100% Genuine Certified
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-slate-600">
                            <i class="fa-solid fa-shield-halved"></i> Storefront Warranty
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-slate-600">
                            <i class="fa-solid fa-truck-fast"></i> Same-Day Delivery
                        </span>
                    </div>
                </div>

                <!-- Right 5 Cols: Showcase Collage -->
                <div class="lg:col-span-5">
                    <div class="relative max-w-md mx-auto">
                        <div class="h-80 sm:h-96 rounded-3xl overflow-hidden shadow-2xl border-4 border-white relative group">
                            <img src="{{ $retailWebConfig['hero_img'] }}" alt="{{ $retailWebConfig['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-md px-3.5 py-1.5 rounded-full text-xs font-bold text-amber-700 shadow-md">
                                {{ $retailWebConfig['tag'] }}
                            </div>

                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <span class="text-xs font-bold uppercase tracking-wider text-amber-300 block mb-0.5">Flagship Experience</span>
                                <h3 class="text-xl font-black">{{ $tenant->business_name }}</h3>
                                <p class="text-xs text-slate-200 mt-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-location-dot text-amber-400"></i> {{ $tenant->city ?: 'Prime City Center' }}
                                </p>
                            </div>
                        </div>

                        <!-- Side Floating Cards -->
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white relative group">
                                <img src="{{ $retailWebConfig['side_img1'] }}" alt="Store Collection" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">New Arrivals</span>
                                </div>
                            </div>
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white relative group">
                                <img src="{{ $retailWebConfig['side_img2'] }}" alt="Featured Gallery" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Curated Brands</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif(in_array($currentTheme, ['rest_web_fine_dining_royal_awadh', 'rest_web_artisanal_rooftop_cafe', 'rest_web_woodfired_italian_pizzeria', 'rest_web_pure_veg_thali_bhojanalaya', 'rest_web_coastal_seafood_lounge', 'rest_web_pan_asian_dimsum_teppanyaki']) || str_starts_with($currentTheme, 'rest_web_') || ($this->isBusinessWebsite && in_array($bizCat, ['Restaurant & Cafes', 'Food & Dining'])))
    <!-- ======================================================== -->
    <!-- 🍽️ LAYOUT: PREMIER RESTAURANT, CAFE & BISTRO (WEBSITE)   -->
    <!-- Culinary Heritage + Chef Specials + Table Booking + Menu -->
    <!-- ======================================================== -->
    @php
        $restConfig = match($currentTheme) {
            'rest_web_fine_dining_royal_awadh' => [
                'badge' => '👑 Royal Awadhi Fine Dining & Dastarkhwan',
                'title' => 'Centuries-Old Dum Pukht Recipes & Silken Galawati Kebabs',
                'desc' => 'Opulent heritage dining sanctuary serving authentic Awadhi slow-cooked biryanis, silken kakori kebabs, silver-leaf warqi parathas, and live classical sitar in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Slow-Cooked Dum Pukht', 'Royal Family Dastarkhwan', 'Live Classical Sitar', 'Private Dining Rooms'],
                'tag' => '★ 5.0 ROYAL AWADH',
            ],
            'rest_web_artisanal_rooftop_cafe' => [
                'badge' => '☕ Sunset Rooftop Bistro & Speciality Brew Bar',
                'title' => 'Single-Origin Pour Overs, Sourdough Pizzas & Skyline Sunset',
                'desc' => 'Aesthetic open-air rooftop cafe featuring manual brew pour-overs, cold brew mocktails, hand-tossed artisan pizzas, and fairy-lit acoustic live sessions in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Open-Air Skyline Sunset', 'Single-Origin Coffee Bar', 'Acoustic Weekend Nights', 'Pet-Friendly Outdoor Deck'],
                'tag' => '★ 4.9 ROOFTOP BISTRO',
            ],
            'rest_web_woodfired_italian_pizzeria' => [
                'badge' => '🍕 Authentic Wood-Fired Neapolitan Pizzeria & Trattoria',
                'title' => '48-Hour Fermented Sourdough & Volcanic Stone Wood-Fired Oven',
                'desc' => 'Authentic Italian trattoria with a 900°F volcanic stone wood-fired oven, hand-stretched Neapolitan sourdough pizzas, creamy truffle pastas, and artisanal tiramisu in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1551183053-bf91a1d81141?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400&auto=format&fit=crop&q=80',
                'pills' => ['48h Sourdough Ferment', 'Volcanic Stone Oven', 'San Marzano & Fior di Latte', 'Chef Pasta Tasting Menu'],
                'tag' => '★ 5.0 NEAPOLITAN PIZZA',
            ],
            'rest_web_pure_veg_thali_bhojanalaya' => [
                'badge' => '🍲 Grand Rajasthani & Gujarati Heritage Thali Bhojanalay',
                'title' => 'Padharo Sa - Unlimited 28-Item Royal Desi Ghee Thali',
                'desc' => 'Authentic 100% pure vegetarian culinary temple presenting traditional brass thali dining with Dal Baati Churma, Gujarati kadhi, seasonal rotlas, and warm hospitality in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1589302168068-964664d93dc0?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=400&auto=format&fit=crop&q=80',
                'pills' => ['100% Pure Desi Ghee', 'Unlimited 28-Item Thali', 'Traditional Manuhar Service', 'Separate Jain Preparation'],
                'tag' => '★ 5.0 ROYAL THALI',
            ],
            'rest_web_coastal_seafood_lounge' => [
                'badge' => '🦀 Fresh Catch Coastal Seafood & Mangalorean Curry Shack',
                'title' => 'Harbor Fresh Catch Display, Kundapura Ghee Roast & Fish Curries',
                'desc' => 'Coastal seafood dining lounge showcasing fresh daily harbor catch, spicy tawa fry surmai, butter garlic crab, tender coconut curries, and authentic beach shack vibes in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1559847844-5315695dadae?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Live Catch Weight Weighing', 'Kundapura Ghee Roast', 'Authentic Neer Dosa & Appam', 'Fresh Sea Prawns & Crabs'],
                'tag' => '★ 4.9 COASTAL SEAFOOD',
            ],
            'rest_web_pan_asian_dimsum_teppanyaki' => [
                'badge' => '🥢 Live Teppanyaki, Sushi & Pan-Asian Dim Sum Bar',
                'title' => 'Live Teppanyaki Cooking Shows, Truffle Dim Sum & Fresh Sushi Platters',
                'desc' => 'Contemporary Asian gastronomic lounge featuring dramatic teppanyaki live cooking tables, hand-rolled sushi platters, steaming bamboo dim sum baskets, and artisan ramen in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1541696432-82c6da8ce7bf?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Live Teppanyaki Counter', 'Hand-Rolled Sushi Platters', 'Crystal Truffle Dim Sum', 'Artisan Pork & Veg Ramen'],
                'tag' => '★ 5.0 PAN-ASIAN LOUNGE',
            ],
            default => [
                'badge' => '🍷 Gourmet Master Chef Multi-Cuisine Dining & Bistro',
                'title' => 'Artisanal Flavors, Farm-Fresh Produce & Elegant Dining Ambience',
                'desc' => 'Premium dining establishment presenting seasonal tasting menus, wood-fired culinary delicacies, handcrafted beverages, and attentive family hospitality in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Master Chef Signature Dishes', '100% Farm-Fresh Ingredients', 'VIP Family Cabanas', 'Live Acoustic Music'],
                'tag' => '★ 5.0 FINE DINING',
            ],
        };
    @endphp

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-stone-900 via-stone-950 to-stone-900 text-white border-b border-stone-800">
        <!-- Ambient Warm Culinary Glow Orbs -->
        <div class="absolute top-0 right-1/4 w-96 h-96 rounded-full bg-amber-600/15 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 rounded-full bg-rose-600/15 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols: Dining Experience Overview -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-stone-800/90 border border-amber-500/40 text-amber-300 text-xs font-bold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        <span>{{ $restConfig['badge'] }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-[1.12]">
                        {{ $restConfig['title'] }}
                    </h1>

                    <p class="text-base text-stone-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        {{ $restConfig['desc'] }}
                    </p>

                    <!-- Trust / Experience Pills -->
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        @foreach($restConfig['pills'] as $pill)
                            <span class="px-3.5 py-1.5 rounded-xl bg-stone-800/80 border border-stone-700 text-xs font-semibold text-stone-200 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-amber-400 text-xs"></i>
                                <span>{{ $pill }}</span>
                            </span>
                        @endforeach
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-600 via-orange-600 to-rose-600 hover:from-amber-500 hover:to-rose-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-amber-600/30 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-calendar-check text-sm"></i> Reserve A Table &bull; View Food Menu
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to reserve a table / ask about today\'s chef specials.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-stone-800 hover:bg-stone-700 border border-stone-700 text-white font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Table Booking WhatsApp
                        </a>
                    </div>

                    <!-- Culinary Rating Strip -->
                    <div class="pt-2 flex items-center justify-center lg:justify-start gap-4 text-xs font-semibold text-stone-400">
                        <span class="flex items-center gap-1.5 text-amber-400">
                            <i class="fa-solid fa-star"></i> 4.9+ Foodie Rating
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-stone-300">
                            <i class="fa-solid fa-kitchen-set"></i> 100% Fresh Daily Prep
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-stone-300">
                            <i class="fa-solid fa-clock"></i> Zero Long Waiting
                        </span>
                    </div>
                </div>

                <!-- Right 5 Cols: Visual Culinary Cards -->
                <div class="lg:col-span-5">
                    <div class="relative">
                        <!-- Main Culinary Image -->
                        <div class="h-80 sm:h-96 rounded-3xl overflow-hidden shadow-2xl border-4 border-stone-700 relative group">
                            <img src="{{ $restConfig['hero_img'] }}" alt="Dining &amp; Culinary Experience" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-stone-950/80 via-transparent to-transparent flex flex-col justify-between p-4">
                                <span class="self-start px-3 py-1 rounded-full bg-stone-900/90 backdrop-blur-md text-amber-400 border border-amber-500/30 text-[10px] font-black uppercase tracking-wider shadow-sm">
                                    {{ $restConfig['tag'] }}
                                </span>
                                <div>
                                    <h3 class="text-white font-black text-lg">{{ $tenant->business_name }}</h3>
                                    <p class="text-amber-200 text-xs font-semibold">{{ $tenant->city ?: 'Gourmet Cuisine' }} &bull; Artisan Dining &amp; Chef Specials</p>
                                </div>
                            </div>
                        </div>

                        <!-- Side Floating Culinary Cards -->
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-stone-700 relative group">
                                <img src="{{ $restConfig['side_img1'] }}" alt="Dining Ambience" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Dining Ambience</span>
                                </div>
                            </div>
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-stone-700 relative group">
                                <img src="{{ $restConfig['side_img2'] }}" alt="Signature Dishes" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Signature Dishes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif(in_array($currentTheme, ['service_web_corporate_law_legal_firm', 'service_web_chartered_accountants_tax', 'service_web_digital_marketing_creative_agency', 'service_web_express_logistics_supply_chain', 'service_web_architecture_interior_design_studio', 'service_web_facility_management_security']) || str_starts_with($currentTheme, 'service_web_') || ($this->isBusinessWebsite && in_array($bizCat, ['Other Services', 'Professional Services'])))
    <!-- ======================================================== -->
    <!-- 🏢 LAYOUT: OTHER SERVICES & PROFESSIONAL ENTERPRISE (WEB) -->
    <!-- Corporate Advisory + Retainers + Case Studies + Consult   -->
    <!-- ======================================================== -->
    @php
        $serviceWebConfig = match($currentTheme) {
            'service_web_chartered_accountants_tax' => [
                'badge' => '📊 Statutory Audit, Direct Tax & Corporate Governance',
                'title' => 'Chartered Accountants, Forensic Audit & Virtual CFO Advisory',
                'desc' => 'High-trust financial advisory practice providing corporate statutory audits, GST litigation appeals, cross-border FEMA compliance, and startup tax structuring in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Statutory & Tax Audit', 'GST Litigation Appeals', 'Virtual CFO Advisory', 'ROC Company Filing'],
                'tag' => '★ 5.0 CA ADVISORY',
            ],
            'service_web_digital_marketing_creative_agency' => [
                'badge' => '🚀 Full-Funnel Performance Marketing & Brand Strategy',
                'title' => 'Revenue-Driven Meta Ads, Technical SEO & Bespoke Web Apps',
                'desc' => 'Strategic digital acceleration firm engineering high-ROAS paid media funnels, organic Google search dominance, modern web applications, and conversion-optimized creative assets in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=400&auto=format&fit=crop&q=80',
                'pills' => ['High-ROAS Paid Ads', 'Technical SEO Audits', 'Conversion Rate (CRO)', 'Custom Web & Mobile Apps'],
                'tag' => '★ 5.0 GROWTH AGENCY',
            ],
            'service_web_express_logistics_supply_chain' => [
                'badge' => '🚚 Tech-Enabled Pan-India 3PL & Fleet Logistics Hub',
                'title' => 'Multi-City FTL/PTL Road Transport, Cold Chain & Warehousing',
                'desc' => 'End-to-end supply chain infrastructure company operating modern GPS-tracked fleets, temperature-controlled pharma logistics, multi-city fulfillment warehouses, and express parcel dispatch in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1600585152220-90363fe7e115?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=400&auto=format&fit=crop&q=80',
                'pills' => ['IoT GPS Live Fleet', 'Temperature Cold Chain', '3PL Warehousing Hubs', 'Pan-India FTL & PTL'],
                'tag' => '★ 4.9 SUPPLY CHAIN',
            ],
            'service_web_architecture_interior_design_studio' => [
                'badge' => '📐 Architectural Design & Turnkey Interior Atelier',
                'title' => 'Contemporary Bioclimatic Architecture & Bespoke Luxury Interiors',
                'desc' => 'Award-winning architectural studio creating bespoke luxury residences, commercial workspace interiors, photorealistic 3D BIM visualizations, and end-to-end turnkey contracting in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1600585152220-90363fe7e115?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1613665813446-82a78c468a1d?w=400&auto=format&fit=crop&q=80',
                'pills' => ['3D BIM Renders', 'Turnkey Contracting', 'Sustainable Architecture', 'Bespoke Custom Joinery'],
                'tag' => '★ 5.0 DESIGN STUDIO',
            ],
            'service_web_facility_management_security' => [
                'badge' => '🛡️ Integrated Facility Management & PSARA Armed Security',
                'title' => 'Corporate Housekeeping, Mechanized Cleaning & Security Force',
                'desc' => 'Certified facility services enterprise providing PSARA-licensed executive protection, mechanized industrial floor maintenance, HVAC/MEP operations, and EHS workplace compliance in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&auto=format&fit=crop&q=80',
                'pills' => ['PSARA Licensed Guards', 'Mechanized Cleaning', '24/7 MEP Breakdown Team', 'EHS Workplace Safety'],
                'tag' => '★ 4.9 FACILITY MANAGEMENT',
            ],
            default => [
                'badge' => '⚖️ Corporate Legal Counsel, High Court Litigation & IPR Chambers',
                'title' => 'Corporate Law, Contract Due Diligence & Commercial Arbitration',
                'desc' => 'Distinguished legal advisory chambers representing corporate boards, emerging startups, and institutional clients in company law, arbitration, intellectual property, and regulatory compliance in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&auto=format&fit=crop&q=80',
                'side_img1' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?w=400&auto=format&fit=crop&q=80',
                'side_img2' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=400&auto=format&fit=crop&q=80',
                'pills' => ['Corporate Due Diligence', 'High Court Litigation', 'IPR Trademark Filing', 'Confidential Board Counsel'],
                'tag' => '★ 5.0 LEGAL CHAMBERS',
            ],
        };
    @endphp

    <section id="hero" class="relative overflow-hidden py-14 sm:py-20 bg-gradient-to-b from-slate-900 via-slate-950 to-slate-900 text-white border-b border-slate-800">
        <!-- Ambient Corporate Glow Orbs -->
        <div class="absolute top-0 right-1/4 w-96 h-96 rounded-full bg-blue-600/15 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 rounded-full bg-indigo-600/15 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols: Advisory & Firm Overview -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-800/90 border border-blue-500/40 text-blue-300 text-xs font-bold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        <span>{{ $serviceWebConfig['badge'] }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-[1.12]">
                        {{ $serviceWebConfig['title'] }}
                    </h1>

                    <p class="text-base text-slate-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        {{ $serviceWebConfig['desc'] }}
                    </p>

                    <!-- Trust / Practice Pills -->
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        @foreach($serviceWebConfig['pills'] as $pill)
                            <span class="px-3.5 py-1.5 rounded-xl bg-slate-800/80 border border-slate-700 text-xs font-semibold text-slate-200 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-shield-halved text-blue-400 text-xs"></i>
                                <span>{{ $pill }}</span>
                            </span>
                        @endforeach
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white font-black text-xs tracking-wider uppercase shadow-xl shadow-blue-600/25 transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-briefcase text-sm"></i> Explore Practice Areas &amp; Retainers
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hello ' . $tenant->business_name . ', I would like to schedule a confidential advisory consultation.') }}" target="_blank" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-slate-800/90 hover:bg-slate-700/90 border border-slate-700 text-white font-bold text-xs tracking-wider uppercase shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Direct Partner WhatsApp
                        </a>
                    </div>

                    <!-- Enterprise Metric Strip -->
                    <div class="pt-2 flex items-center justify-center lg:justify-start gap-4 text-xs font-semibold text-slate-400">
                        <span class="flex items-center gap-1.5 text-blue-400">
                            <i class="fa-solid fa-certificate"></i> ISO &amp; Bar Council Compliant
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-slate-300">
                            <i class="fa-solid fa-user-shield"></i> 100% Client Confidentiality
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1.5 text-emerald-400">
                            <i class="fa-solid fa-bolt"></i> Rapid Advisory Response
                        </span>
                    </div>
                </div>

                <!-- Right 5 Cols: Visual Presentation Card & Secondary Photos -->
                <div class="lg:col-span-5">
                    <div class="relative">
                        <!-- Main Showcase Card -->
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-700 group aspect-4/3">
                            <img src="{{ $serviceWebConfig['hero_img'] }}" alt="{{ $serviceWebConfig['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-slate-900/90 backdrop-blur-md px-3.5 py-1.5 rounded-full text-[11px] font-black text-blue-300 border border-blue-500/30 shadow flex items-center gap-1.5">
                                <i class="fa-solid fa-award text-blue-400"></i> {{ $serviceWebConfig['tag'] }}
                            </div>
                            <div class="absolute bottom-5 left-5 right-5 text-white flex items-center gap-3">
                                <span class="w-10 h-10 rounded-xl bg-blue-600/30 border border-blue-400/40 flex items-center justify-center text-blue-300 text-lg shrink-0">
                                    <i class="fa-solid fa-building-shield"></i>
                                </span>
                                <div>
                                    <h3 class="text-white font-black text-lg">{{ $tenant->business_name }}</h3>
                                    <p class="text-blue-200 text-xs font-semibold">{{ $tenant->city ?: 'Enterprise Services' }} &bull; Trusted Institutional Advisory</p>
                                </div>
                            </div>
                        </div>

                        <!-- Side Floating Professional Cards -->
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-slate-700 relative group">
                                <img src="{{ $serviceWebConfig['side_img1'] }}" alt="Corporate Advisory" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Client Portfolio</span>
                                </div>
                            </div>
                            <div class="h-28 rounded-2xl overflow-hidden shadow-md border-2 border-slate-700 relative group">
                                <img src="{{ $serviceWebConfig['side_img2'] }}" alt="Audits & Compliance" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-2.5">
                                    <span class="text-[11px] font-bold text-white">Case Studies</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @elseif($currentTheme === 'coaching_ecom_test_series')
        @include('livewire.templates.coaching.ecom.test-series')

    @elseif($currentTheme === 'coaching_ecom_study_notes')
        @include('livewire.templates.coaching.ecom.study-notes')

    @elseif($currentTheme === 'coaching_ecom_recorded_lectures')
        @include('livewire.templates.coaching.ecom.recorded-lectures')

    @elseif($currentTheme === 'coaching_ecom_pyq_question_banks')
        @include('livewire.templates.coaching.ecom.pyq-question-banks')

    @elseif($currentTheme === 'coaching_ecom_language_kits')
        @include('livewire.templates.coaching.ecom.language-kits')

    @elseif($currentTheme === 'coaching_ecom_school_stationery')
        @include('livewire.templates.coaching.ecom.school-stationery')

    @elseif(in_array($currentTheme, ['retail_supermarket', 'salon_ecom_organic_skincare', 'salon_ecom_haircare_tools', 'salon_ecom_bridal_vanity', 'salon_ecom_men_grooming', 'salon_ecom_perfume_bath_body', 'clinic_ecom_pharmacy_rx', 'clinic_ecom_diagnostic_tests', 'clinic_ecom_ortho_surgical', 'clinic_ecom_baby_pediatric', 'clinic_ecom_diabetic_devices', 'clinic_ecom_dental_hygiene']) || str_starts_with($currentTheme, 'doctor_ecom_') || str_starts_with($currentTheme, 'herbal_ecom_') || str_starts_with($currentTheme, 'mfg_ecom_') || str_starts_with($currentTheme, 'retail_ecom_') || str_starts_with($currentTheme, 'rest_ecom_') || str_starts_with($currentTheme, 'service_ecom_') || ($this->isEcommerce && in_array($bizCat, ['Beauty & Salons', 'Clinics & Hospitals', 'Coaching & Institutes', 'Doctors & Specialists', 'Herbal Care', 'Manufacturers', 'Other Retail', 'Retail & E-Commerce', 'Restaurant & Cafes', 'Food & Dining', 'Other Services', 'Professional Services'])))
    <!-- ======================================================== -->
    <!-- 🛍️ LAYOUT: ONLINE STORE & DIGITAL CHECKOUT               -->
    <!-- E-Commerce Storefront + Slide Cart Drawer + Fast Shipping -->
    <!-- ======================================================== -->
    @php
        $ecomConfig = match($currentTheme) {
            'mfg_ecom_industrial_fasteners_hardware' => [
                'badge' => '🔩 High-Tensile Industrial Fasteners, Bolts & Hardware',
                'title' => 'Grade 8.8, 10.9 & SS316 Hex Bolts, Nuts & Anchors Mart',
                'desc' => 'Direct-from-factory wholesale fastener store. Heavy hex nuts, spring washers, foundation anchor bolts with bulk MOQ volume discounts in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1581092334651-ddf26d9a09d0?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Grade 8.8 & 10.9 Steel', 'MOQ Volume Slabs', 'Mill Test Certificate', 'Same-Day Pallet Dispatch'],
                'tag' => '★ 5.0 FASTENERS MART',
            ],
            'mfg_ecom_protective_safety_ppe_gear' => [
                'badge' => '🦺 Certified Industrial Safety PPE, Helmets & Workwear',
                'title' => 'ISI/CE Steel-Toe Safety Shoes, Harnesses & Workwear Store',
                'desc' => 'Factory wholesale safety gear. Impact helmets, chemical nitrile gloves, reflective high-vis jackets, and corporate workwear in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=800&auto=format&fit=crop&q=80',
                'pills' => ['CE & EN 345 Certified', 'Bulk Carton Wholesale', 'Custom Logo Printing', 'Direct Factory Price'],
                'tag' => '★ 4.9 PPE SAFETY',
            ],
            'mfg_ecom_hydraulic_pneumatic_valves' => [
                'badge' => '⚙️ Industrial Hydraulic Fittings, Cylinders & Pneumatics',
                'title' => '3000 PSI High-Pressure Hoses, Directional Valves & Cylinders',
                'desc' => 'Fluid power components store. Hydraulic hose assemblies, quick release couplers, pneumatic air preparation units, and solenoid valves in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1581092921461-eab62e97a780?w=800&auto=format&fit=crop&q=80',
                'pills' => ['3000 PSI Hydro Tested', 'BSP & NPT Standards', 'CAD Datasheets Included', 'Wholesale B2B Cart'],
                'tag' => '★ 5.0 FLUID POWER',
            ],
            'mfg_ecom_packaging_supplies_tapes' => [
                'badge' => '📦 Factory Direct BOPP Packing Tapes & Stretch Wrap Rolls',
                'title' => '50-Micron BOPP Tapes, Pallet Stretch Film & E-com Mailers',
                'desc' => 'High-adhesion packaging supplies store. Cast stretch film rolls, custom logo printed carton tapes, bubble rolls, and corrugated boxes in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800&auto=format&fit=crop&q=80',
                'pills' => ['50 Micron Strong Adhesion', 'Pallet Quantity Discounts', 'Printed Tape Customization', 'GST B2B Invoicing'],
                'tag' => '★ 4.9 PACKAGING MART',
            ],
            'mfg_ecom_electrical_switchgear_cables' => [
                'badge' => '⚡ Heavy Industrial Switchgear, Contactors & Copper Cables',
                'title' => 'IS/IEC 60947 MCBs, MCCB Breakers & Armoured Power Cables',
                'desc' => 'Factory electrical power distribution store. Industrial circuit breakers, thermal overload relays, multi-core flexible copper cables in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?w=800&auto=format&fit=crop&q=80',
                'pills' => ['IS/IEC 60947 Standards', '100% Pure Copper', 'OEM Panel Rates', 'Test Certificates Provided'],
                'tag' => '★ 5.0 SWITCHGEAR',
            ],
            'mfg_ecom_raw_metal_pipes_structural' => [
                'badge' => '🏗️ Structural Steel Pipes, Hollow Sections & MS Channels',
                'title' => 'IS 4923 Square/Rectangular Steel Pipes & Angles Stockyard',
                'desc' => 'Direct mill pricing for metal fabricators. Mild steel square tubes, galvanized pipes, equal angles, and structural channels with weight calculator in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1535813547-99c456a41d4a?w=800&auto=format&fit=crop&q=80',
                'pills' => ['IS 4923 / IS 2062 Grade', 'Trailer Load Billing', 'Weight per Metre Calculator', 'Mill Test Certificate'],
                'tag' => '★ 5.0 STRUCTURAL STEEL',
            ],
            'herbal_ecom_cold_pressed_oils' => [
                'badge' => '💧 Cold-Pressed Herbal Oils & Tailam Apothecary',
                'title' => 'Traditional Wood Ghani Medicated Hair & Body Tailams',
                'desc' => 'Classical Kshirpak Vidhi boiled medicated oils, pure virgin coconut and cold-pressed sesame bases with forest herbs in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Traditional Ghani Pressed', 'Kshirpak Vidhi Boiling', 'Virgin Sesame & Coconut', 'Tamper-Proof Glass Jars'],
                'tag' => '★ 5.0 MEDICATED TAILAMS',
            ],
            'herbal_ecom_classical_churnas_kadha' => [
                'badge' => '🏺 Classical Ayurvedic Churnas, Kwaths & Kadhas',
                'title' => 'Triple Micro-Sifted Pure Herbal Churnas & Decoction Blends',
                'desc' => 'Authentic Ayurvedic powders and decoctions prepared per Sharangadhara Samhita with zero preservatives, high potency, and lab certification in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Triple Micro-Sifted', 'Zero Starch or Additives', 'Batch Heavy Metal Tested', 'Fast Courier Dispatch'],
                'tag' => '★ 5.0 CLASSICAL CHURNAS',
            ],
            'herbal_ecom_immunity_rasayanas' => [
                'badge' => '✨ Gold Grade Ayurvedic Rasayanas & Himalayan Shilajit',
                'title' => 'Forest Amla Chyawanprash, Pure Shilajit Resin & Rasayanas',
                'desc' => 'Premium restorative vitality Rasayanas formulated with wild organic Amla, A2 Gir cow ghee, pure Himalayan shilajit resin, and organic forest honey in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Wild Organic Amla Base', 'Pure Himalayan Shilajit', 'A2 Desi Cow Ghee', 'Swarna Bhasma Infused'],
                'tag' => '★ 5.0 VITALITY RASAYANAS',
            ],
            'herbal_ecom_ayurvedic_skincare_ubtan' => [
                'badge' => '🌸 Saffron Kumkumadi Ubtans & Ayurvedic Beauty Care',
                'title' => 'Handmade Saffron Kumkumadi Ubtans & Artisan Herbal Soaps',
                'desc' => 'Clean botanical skincare formulated without parabens or mineral oils. Kashmiri saffron, sandalwood ubtans, and therapeutic kumkumadi facial oils in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Pure Kashmiri Saffron', 'Sandalwood & Turmeric', 'Cold-Processed Artisan', '100% Chemical Free'],
                'tag' => '★ 5.0 VEDIC SKINCARE',
            ],
            'herbal_ecom_organic_teas_infusions' => [
                'badge' => '☕ Whole Leaf Herbal Teas, Ashwagandha & Tulsi Infusions',
                'title' => 'Vedic Herbal Green Teas & Adaptogenic Healing Blends',
                'desc' => 'Artisanal wellness infusions blending adaptogenic Ashwagandha, certified organic Tulsi trio, ginger root, and fennel for daily vitality in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Organic Certified Leaves', 'Adaptogenic Ashwagandha', 'Plastic-Free Pyramids', 'Zero Artificial Flavor'],
                'tag' => '★ 4.9 HERBAL INFUSIONS',
            ],
            'herbal_ecom_joint_pain_balms' => [
                'badge' => '🦴 Orthovedic Joint Pain Relief Oils, Balms & Potli Pouches',
                'title' => 'Classical Mahanarayan Pain Liniments & Herbal Potli Packs',
                'desc' => 'Doctor-recommended Ayurvedic pain management remedies including fast-acting liniments, Gandhapura roll-ons, and herbal heated potli pouches in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1512069772995-ec65ed45afd6?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Classical Mahanarayan Base', 'Gandhapura & Camphor', 'Heated Potli Relief', 'Immediate Joint Comfort'],
                'tag' => '★ 5.0 ORTHOVEDIC CARE',
            ],
            'doctor_ecom_prescription_refills' => [
                'badge' => '💊 Doctor-Verified Prescription Refills & Pharmacy',
                'title' => '100% Genuine Prescription Medicines with Doctor Approval',
                'desc' => 'Upload your doctor prescription, get genuine cold-chain medicines verified by pharmacists with doorstep delivery in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Doctor Rx Verified', 'Cold-Chain Insulin Storage', 'Flat 20% Discount', 'Doorstep Delivery'],
                'tag' => '★ 5.0 RX REFILLS',
            ],
            'doctor_ecom_supplements_nutrition' => [
                'badge' => '🌿 Clinical Supplements, Multivitamins & Nutraceuticals',
                'title' => 'Physician-Curated Vitamins, Minerals & Therapeutic Nutrition',
                'desc' => 'High-potency therapeutic multivitamins, omega-3 fatty acids, iron, calcium, and gut probiotics with batch quality certificates in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1577401239170-897942555fb3?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Therapeutic Potency', 'Batch Lab Certified', 'High Absorption Grade', 'Doctor Formulated'],
                'tag' => '★ 4.9 NUTRACEUTICALS',
            ],
            'doctor_ecom_ortho_supports' => [
                'badge' => '🩺 Orthopedic Braces, Splints & Ergonomic Supports',
                'title' => 'Doctor-Grade Lumbar Belts, Knee Stabilizers & Cervical Collars',
                'desc' => 'Ergonomic orthopedic rehabilitation braces, silicone heel cups, posture correctors, and compression sleeves for injury recovery in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1584017911766-d451b3d0e843?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Medical-Grade Splints', 'Anatomical Joint Contours', 'Breathable Neoprene', 'Express Courier Delivery'],
                'tag' => '★ 5.0 ORTHO SUPPORTS',
            ],
            'doctor_ecom_baby_pediatric_care' => [
                'badge' => '🍼 Pediatric Care Essentials & Baby Wellness Packs',
                'title' => 'Pediatrician-Approved Hypoallergenic Skincare & Baby Nutrition',
                'desc' => 'Ultra-gentle infant washes, pediatric vitamin D3 drops, non-toxic diaper rash creams, and organic baby care bundles in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Pediatrician Approved', '0% Fragrance & Toxins', 'Baby Diaper & Rash Kits', 'Express Home Delivery'],
                'tag' => '★ 5.0 BABY CARE',
            ],
            'doctor_ecom_derma_skincare_cosmeceuticals' => [
                'badge' => '✨ Clinical Cosmeceuticals & Dermatologist Skincare',
                'title' => 'Prescription-Grade Retinol, Vitamin C & Sunscreen Formulations',
                'desc' => 'Active cosmeceuticals with clinical concentrations. Broad-spectrum SPF50 sunscreens, niacinamide serums, and barrier repair creams in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1608248597359-00995fa1b6cf?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Clinical Concentrations', 'Non-Comedogenic Safe', 'Dermatologist Tested', 'Fast Delivery'],
                'tag' => '★ 5.0 COSMECEUTICALS',
            ],
            'doctor_ecom_chronic_monitoring_kits' => [
                'badge' => '🩸 Home Diagnostics & Chronic Monitoring Devices',
                'title' => 'Automated BP Monitors, Glucometer Kits & Oximeters',
                'desc' => 'Certified medical equipment for home monitoring. Digital blood pressure monitors, glucometers with 50 test strips, and pulse oximeters in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=800&auto=format&fit=crop&q=80',
                'pills' => ['ISO & CE Certified', '5-Year Machine Warranty', 'Free Extra Test Strips', 'Cash on Delivery'],
                'tag' => '★ 4.9 HEALTH MONITORS',
            ],
            'coaching_ecom_test_series' => [
                'badge' => '📝 All-India Mock Test Series & CBT Examination Portal',
                'title' => 'Real NTA/UPSC Examination Pattern CBT Tests & Rank Predictor',
                'desc' => 'Instant access to chapter tests, full-syllabus mocks, and national percentile benchmark test series with detailed step-by-step video solutions in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Real NTA CBT Interface', 'All India Rank Predictor', 'Video Solutions for Every Q', 'Chapter-wise Mock Tests'],
                'tag' => '★ 5.0 TEST SERIES PORTAL',
            ],
            'coaching_ecom_study_notes' => [
                'badge' => '📖 Toppers Handwritten Notes, Mindmaps & Formula Books',
                'title' => 'High-Yield Handwritten Revision Notes & Formula Cheat Sheets',
                'desc' => 'High-yield color-coded handwritten notes prepared by top rankers. Spiral bound hardcopies, formula pocketbooks, and mind maps delivered to your doorstep in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Color-Coded Mindmaps', 'Formula Pocketbooks', 'Doorstep Courier Delivery', 'Sample PDF Preview'],
                'tag' => '★ 4.9 TOPPERS NOTES',
            ],
            'coaching_ecom_recorded_lectures' => [
                'badge' => '🎥 MasterClass 4K Video Courses & Pen-Drive Lecture Kits',
                'title' => 'Complete Syllabus Recorded Video Lectures & Offline Pen-Drive Kits',
                'desc' => 'Studio-recorded 4K lectures by star faculties. Delivered via encrypted pen-drives or Google Drive with digital doubt resolution access in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&auto=format&fit=crop&q=80',
                'pills' => ['4K HD Studio Quality', 'Pen-Drive & Drive Access', '24-Mo Unlimited Views', 'Digital Doubt Clearing'],
                'tag' => '★ 5.0 VIDEO MASTERCLASS',
            ],
            'coaching_ecom_pyq_question_banks' => [
                'badge' => '📚 25 Years Solved PYQ Question Bank Books & Solution Sets',
                'title' => 'Topic-Wise Categorized Previous Year Questions & Answer Keys',
                'desc' => 'Master previous 25 years exam questions. Chapter-wise categorized PYQs with step-by-step verified explanations, speed tricks, and free Pan-India courier in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=800&auto=format&fit=crop&q=80',
                'pills' => ['25 Years PYQ Solved', 'Detailed Step Explanations', 'Speed & Accuracy Tricks', 'Free Express Shipping'],
                'tag' => '★ 4.9 PYQ BOOK MART',
            ],
            'coaching_ecom_language_kits' => [
                'badge' => '🗣️ LinguaPro Spoken English & Foreign Language Learning Kits',
                'title' => 'German, French & Spoken English Flashcards, Audio & Books',
                'desc' => 'Comprehensive self-paced language learning bundles. Audio flashcards, interactive grammar workbooks, and conversation audio manuals delivered in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Audio Flashcard Sets', 'Grammar Workbooks', 'Pronunciation Audio Drive', 'Vocabulary Pocket Dictionaries'],
                'tag' => '★ 5.0 LANGUAGE KITS',
            ],
            'coaching_ecom_school_stationery' => [
                'badge' => '📐 StudentHub Casio Calculators, OMR Sheets & Exam Prep Mart',
                'title' => 'Original Scientific Calculators, 500-Pack OMRs & Exam Geometry',
                'desc' => 'Essential exam equipment. 100% genuine Casio calculators, 500-pack OMR evaluation sheets, drafting instruments, and smooth ink exam pens in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Original Casio Calculators', '500-Pack OMR Practice Sheets', 'Drafting & Geometry Sets', 'Express Fast Dispatch'],
                'tag' => '★ 4.9 EXAM STATIONERY',
            ],
            'clinic_ecom_pharmacy_rx' => [
                'badge' => '💊 24/7 Express Online Prescription Pharmacy',
                'title' => '100% Genuine Prescription Medicines & Daily Health Essentials',
                'desc' => 'Upload your doctor prescription, get genuine cold-chain medicines at flat 20% discount with tamper-proof doorstep delivery in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Doctor Rx Upload', 'Cold-Chain Insulin Storage', 'Flat 20% Off', 'Doorstep WhatsApp Bill'],
                'tag' => '★ 5.0 VERIFIED PHARMACY',
            ],
            'clinic_ecom_diagnostic_tests' => [
                'badge' => '🧪 NABL Pathology Lab Tests & Health Checkup Store',
                'title' => 'Preventive Full Body Health Packages & Home Blood Sample Collection',
                'desc' => 'Order diagnostic lab test packages from home. Certified phlebotomist visit, 80+ health markers, and digital smart reports delivered within 6 hours in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1579165466791-788226ab77b6?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Free Home Sample Pickup', 'NABL Accredited Reports', 'Full Body Packages', 'Digital Report in 6h'],
                'tag' => '★ 4.9 NABL DIAGNOSTICS',
            ],
            'clinic_ecom_ortho_surgical' => [
                'badge' => '🦽 Orthopedic Braces, Wheelchairs & Home Care Mart',
                'title' => 'Medical Lumbar Belts, Wheelchairs, Walkers & Surgical Equipment',
                'desc' => 'Doctor-recommended orthopedic rehabilitation braces, ergonomic wheelchairs, walker supports, and hospital beds with home delivery in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Medical-Grade Ortho Belts', 'Lightweight Wheelchairs', 'Oxygen Concentrators Rental', 'Express COD Delivery'],
                'tag' => '★ 4.9 SURGICAL MART',
            ],
            'clinic_ecom_baby_pediatric' => [
                'badge' => '🍼 Pediatric Nutrition, Baby Formulas & Maternity Care Store',
                'title' => 'Pediatrician-Approved Baby Care, Infant Formulas & Maternity Recovery',
                'desc' => 'Safe hypoallergenic infant skincare, organic milk formulas, postpartum mother recovery bundles, and pediatric nutritional supplements in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Pediatrician Approved', 'Chemical-Free Baby Care', 'New Mom Recovery Kits', 'Fast WhatsApp Order'],
                'tag' => '★ 5.0 BABY & MATERNITY',
            ],
            'clinic_ecom_diabetic_devices' => [
                'badge' => '🩸 Chronic Care, Glucometer Strips & BP Monitors Mart',
                'title' => 'Accu-Chek Strips, Omron BP Monitors & Diabetic Care Essentials',
                'desc' => 'Reliable chronic health monitoring equipment. Genuine blood glucose test strips, automated BP cuffs, orthotic diabetic shoes, and subscription refills in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Accu-Chek Strips Refill', 'Omron Digital BP Cuffs', 'Orthotic Diabetic Footwear', 'Monthly Refill Discounts'],
                'tag' => '★ 4.9 CHRONIC CARE MART',
            ],
            'clinic_ecom_dental_hygiene' => [
                'badge' => '🪥 Professional Sonic Brushes & Clinical Oral Care Shop',
                'title' => 'Dentist-Approved Sonic Toothbrushes, Cordless Flossers & Whitening',
                'desc' => 'Clinical oral hygiene products. Waterproof ultrasonic water flossers, enamel protection toothpastes, aligner cleaning foams, and sensitivity care kits in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1559591937-e1032b4b455b?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Sonic Electric Toothbrushes', 'Pro Cordless Water Flossers', 'Whitening Foam & Gels', 'Dental Care Bundles'],
                'tag' => '★ 5.0 DENTAL ORAL CARE',
            ],
            'salon_ecom_organic_skincare' => [
                'badge' => '✨ Clean Skincare & Active Serums Boutique',
                'title' => 'Cold-Pressed Facial Oils, Hyaluronic Serums & Botanical Care',
                'desc' => 'Dermatologist-curated clean skincare apothecary. 100% cruelty-free, vegan formulations, ingredient transparency, and door delivery in ' . ($tenant->city ?: 'Nagpur') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1608248597359-00995fa1b6cf?w=800&auto=format&fit=crop&q=80',
                'pills' => ['100% Vegan & Clean', 'Cold-Pressed Actives', 'Zero Parabens', 'Express Delivery'],
                'tag' => '★ 5.0 ORGANIC APOTHECARY',
            ],
            'salon_ecom_haircare_tools' => [
                'badge' => '💇 Salon Pro Styling Tools & Haircare Mart',
                'title' => 'Ionic Hair Dryers, Straighteners & Salon-Size Liter Refills',
                'desc' => 'Professional-grade styling equipment with brand warranties, argan hair serums, and bulk salon refills delivered to your door in ' . ($tenant->city ?: 'Nagpur') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?w=800&auto=format&fit=crop&q=80',
                'pills' => ['2-Yr Brand Warranty', 'Jumbo 1-Litre Packs', 'Tourmaline Ionic Tech', 'COD & WhatsApp'],
                'tag' => '★ 4.9 PRO TOOLS MART',
            ],
            'salon_ecom_bridal_vanity' => [
                'badge' => '💄 Bridal Vanity & Makeup Trousseau Shop',
                'title' => 'Complete Bridal Trousseau Vanity Trunks & HD Cosmetics',
                'desc' => 'Curated bridal trousseau kits, 24-hr waterproof foundations, high-pigment eyeshadow palettes, and luxury gift trunk boxes in ' . ($tenant->city ?: 'Nagpur') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Pre-Made Vanity Boxes', '24-Hr Waterproof', 'Gift Trunk Packaging', 'Free Delivery'],
                'tag' => '★ 5.0 BRIDAL TROUSSEAU',
            ],
            'salon_ecom_men_grooming' => [
                'badge' => "💈 Men's Beard Craft & Grooming Apothecary",
                'title' => 'Cedarwood Beard Oils, Matte Styling Clay & Daily Detox Washes',
                'desc' => "High-performance men's daily grooming essentials. Natural beard growth blends, sulfate-free charcoal facewashes, and subscription refill discounts in " . ($tenant->city ?: 'Nagpur') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1621607512214-68297480165e?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Pure Cold-Pressed Oils', 'All-Day Matte Hold', 'Toxin-Free Daily Care', '1-Click Order'],
                'tag' => "★ 4.9 MEN'S APOTHECARY",
            ],
            'salon_ecom_perfume_bath_body' => [
                'badge' => '🌸 Artisanal Luxury Perfumes & Bath Boutique',
                'title' => 'Long-Lasting French Extrait Perfumes & Whipped Shea Butters',
                'desc' => 'Artisanal high-concentration extrait de parfums, whipped Ghanaian body butters, and aromatherapy bath salt gift sets delivered to your doorstep in ' . ($tenant->city ?: 'Nagpur') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Extrait de Parfum Grade', 'Whipped Shea Butters', 'Luxury Gift Packaging', '48h Dispatch'],
                'tag' => '★ 5.0 PERFUME BOUTIQUE',
            ],
            'retail_ecom_modern_fashion_apparel' => [
                'badge' => '👕 Minimalist Streetwear & Everyday Essentials Mart',
                'title' => '240 GSM Heavy Cotton Tees, Oversized Hoodies & Cargo Pants',
                'desc' => 'Premium streetwear boutique. 100% combed pima cotton, pre-shrunk boxy fits, and express COD doorstep delivery in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=800&auto=format&fit=crop&q=80',
                'pills' => ['100% Pima Cotton', 'Boxy & Oversized Fits', 'Cash on Delivery', 'Easy 7-Day Returns'],
                'tag' => '★ 4.9 STREETWEAR',
            ],
            'retail_ecom_mobile_accessories_gadgets' => [
                'badge' => '🎧 Fast Charging Adapters, TWS Audio & Gadgets Hub',
                'title' => '65W GaN Chargers, ANC Earbuds & Drop-Proof Armor Cases',
                'desc' => 'Direct-to-consumer tech accessories. High-speed laptop chargers, braided nylon cables, and military-grade drop protection in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&auto=format&fit=crop&q=80',
                'pills' => ['65W GaN Fast Charge', 'Active Noise Cancelling', 'Military Drop-Tested', '1-Year Replacement'],
                'tag' => '★ 4.9 TECH ESSENTIALS',
            ],
            'retail_ecom_artisanal_dryfruits_spices' => [
                'badge' => '🌰 Kashmiri Mamra Almonds, Saffron & Royal Dry Fruits',
                'title' => 'Handpicked Kashmiri Mamra, Roasted Pistachios & Exotic Nuts',
                'desc' => 'Royal dry fruit apothecary. Oil-rich Grade-A Mamra badam, royal saffron, and vacuum-sealed festive gifting boxes in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Vacuum Nitrogen Pack', 'Zero Artificial Preservatives', 'Grade-A Kashmiri Mamra', 'Gift Hampers Available'],
                'tag' => '★ 5.0 ROYAL DRYFRUITS',
            ],
            'retail_ecom_activewear_fitness_gear' => [
                'badge' => '🏃 High-Performance Activewear & Home Gym Equipment Mart',
                'title' => 'Seamless Squat-Proof Tights, Gym Tops & Olympic Weights',
                'desc' => 'Pro athletic gear. Sweat-wicking 4-way stretch activewear, cast iron dumbbells, and resistance training accessories in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Squat-Proof Compression', 'Anti-Odor Quick Dry', 'Home Gym Equipment', 'Express COD Shipping'],
                'tag' => '★ 4.9 PRO ACTIVEWEAR',
            ],
            'retail_ecom_baby_care_kids_toys' => [
                'badge' => '🧸 BPA-Free Newborn Essentials, Bamboo Wear & STEM Toys',
                'title' => 'Organic Baby Rompers, Teethers & Wooden Montessori Toys',
                'desc' => 'Pediatrician-approved baby store. 100% organic bamboo clothing, non-toxic food-grade silicone teethers, and developmental sensory toys in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?w=800&auto=format&fit=crop&q=80',
                'pills' => ['100% Organic Bamboo', 'Non-Toxic Wooden Toys', 'Pediatrician Approved', 'Sterilized Packaging'],
                'tag' => '★ 5.0 BABY CARE',
            ],
            'retail_ecom_ceramic_kitchen_tableware' => [
                'badge' => '🍳 Artisan Ceramic Tableware, Stoneware & Cast Iron Cookware',
                'title' => 'Handcrafted Studio Pottery Dinner Sets & Heavy Skillets',
                'desc' => 'Artisan kitchen boutique. Lead-free glazed stoneware plates, matte coffee mugs, and pre-seasoned heavy cast iron pans in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Lead-Free Food Safe', 'Pre-Seasoned Cast Iron', 'Microwave & Oven Safe', 'Shatter-Proof Transit'],
                'tag' => '★ 4.9 ARTISAN LIVING',
            ],
            'rest_ecom_cloud_kitchen_biryani_box' => [
                'badge' => '🍗 Authentic Dum Handi Biryani & Kebabs Cloud Delivery',
                'title' => 'Sealed Earthen Clay Handi Biryanis & Charcoal Kebabs Delivery',
                'desc' => 'Freshly prepared coal-dum sealed matka biryanis, succulent galawati kebabs, cooling burani raita, and gulab jamuns delivered piping hot in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Sealed Earthen Matka', 'Charcoal Slow-Cooked Dum', '30-Min Hot Thermal Box', 'Zero Preservatives'],
                'tag' => '★ 5.0 CLOUD DUM BIRYANI',
            ],
            'rest_ecom_artisan_french_bakery_pastry' => [
                'badge' => '🥐 100% French Butter Croissants & Belgian Pastries Boutique',
                'title' => 'Artisanal Sourdough Breads, Flaky Croissants & Custom Celebration Cakes',
                'desc' => 'Handcrafted European patisserie delivering pure French butter croissants, crusty pain de campagne sourdoughs, Belgian chocolate ganache tarts, and customized celebration cakes in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=800&auto=format&fit=crop&q=80',
                'pills' => ['100% Pure French Butter', 'Natural Ferment Sourdough', 'Custom Anniversary Cakes', 'Same-Day Fresh Bake'],
                'tag' => '★ 5.0 ARTISAN BAKERY',
            ],
            'rest_ecom_gourmet_smash_burgers_wings' => [
                'badge' => '🍔 Brioche Smash Burgers, Crispy Fries & Hot Glazed Wings',
                'title' => 'Crispy Edge Smashed Angus Patties, Melted Cheddar & Loaded Fries',
                'desc' => 'American gourmet burger kitchen serving seared smashed patties on toasted brioche buns, secret umami sauce, crispy peri-peri chicken tenders, and loaded cheese fries in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Custom Smashed Patties', 'Toasted Butter Brioche', 'House Secret Sauce', 'Crisp Thermal Dispatch'],
                'tag' => '★ 4.9 SMASH BURGERS',
            ],
            'rest_ecom_homestyle_healthy_tiffin' => [
                'badge' => '🥗 Daily Diet Meal Subscriptions & Homestyle Pure Ghee Tiffins',
                'title' => 'Nutritious Home-Cooked Daily Lunch & Dinner Meal Subscriptions',
                'desc' => 'Wholesome dietitian-balanced meals prepared in clean hygienic kitchens with cold-pressed oils, multigrain rotis, fresh seasonal sabzis, and customized calorie-controlled protein bowls in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Zero Soda & Low Oil', 'Multigrain Phulkas & Dal', 'Flexible Pause & Resume', 'Doorstep Lunch & Dinner'],
                'tag' => '★ 5.0 HEALTHY TIFFIN',
            ],
            'rest_ecom_handcrafted_icecream_desserts' => [
                'badge' => '🍨 Small-Batch Gelato, Real Fruit Sorbets & Handcrafted Sundaes',
                'title' => '100% Real Dairy Artisan Gelato Tubs & Decadent Sundaes',
                'desc' => 'Artisanal craft creamery scooping small-batch pure milk gelato, Alphonso mango sorbets, dark Belgian waffle tubs, and dry-ice chilled home packs in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1501443762994-82bd5dace89a?w=800&auto=format&fit=crop&q=80',
                'pills' => ['100% Pure Milk & Cream', 'Zero Vegetable Fat', 'Dry Ice Leak-Proof Packs', 'Sub-Zero Chilled Transit'],
                'tag' => '★ 4.9 ARTISAN GELATO',
            ],
            'rest_ecom_signature_rolls_street_bites' => [
                'badge' => '🌯 Kolkata Kathi Rolls, Shawarmas & Crispy Street Food Bites',
                'title' => 'Flaky Paratha Kathi Rolls, Melt-in-Mouth Momos & Street Bites',
                'desc' => 'Vibrant street kitchen delivering crispy multi-layered kathi rolls, authentic steam and fried momos, Lebanese garlic chicken shawarmas, and refreshing spiced coolers in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Flaky Handmade Parathas', 'Tangy Mint & Onion Relish', 'Authentic Steamed Momos', 'Piping Hot 20-Min Drop'],
                'tag' => '★ 5.0 KATHI ROLLS',
            ],
            'service_ecom_home_deep_cleaning_pest_control' => [
                'badge' => '✨ Full-Home Deep Cleaning, Sanitization & Pest Defense',
                'title' => 'Hospital-Grade Home Sanitization & Odorless Pest Control Mart',
                'desc' => 'Verified doorstep hygiene services. 4-hour mechanized deep cleaning, intensive kitchen degreasing, sofa shampooing, and odorless pest elimination in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Mechanized Deep Scrubbing', 'Odorless Bayer Chemicals', 'Government Approved', 'Instant WhatsApp Booking'],
                'tag' => '★ 5.0 DEEP CLEANING',
            ],
            'service_ecom_appliance_repair_ac_maintenance' => [
                'badge' => '❄️ High-Pressure Jet AC Clean & Doorstep Appliance Care',
                'title' => 'HVAC Jet Servicing, Inverter PCB Repair & Appliance AMCs',
                'desc' => 'Certified technicians at your doorstep. Split/Window AC foaming jet service, pure copper coil leak fixing, washing machine and refrigerator repairs in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Jet Pump Deep Clean', '90-Day Service Warranty', 'Genuine OEM Spare Parts', 'Direct WhatsApp Dispatch'],
                'tag' => '★ 4.9 APPLIANCE CARE',
            ],
            'service_ecom_company_startup_registration_compliance' => [
                'badge' => '📜 One-Click Pvt Ltd Incorporation & ROC Filing Store',
                'title' => 'Pvt Ltd Registration, GST, Trademark & Startup Compliance Cart',
                'desc' => 'All-inclusive legal and ROC incorporation packs for founders. SPICe+ MCA filing, digital signature DSC, MSME certificate, and direct WhatsApp consult in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?w=800&auto=format&fit=crop&q=80',
                'pills' => ['7-Day MCA Incorporation', '2 DIN & DSC Tokens', 'Zero Hidden Govt Charges', 'Dedicated CA Advisory'],
                'tag' => '★ 5.0 STARTUP LEGAL',
            ],
            'service_ecom_event_wedding_planning_decor' => [
                'badge' => '🎪 Luxury Wedding Production & Floral Mandap Stage Mart',
                'title' => 'Theme Wedding Decor Packages, Stage Lighting & Event Kits',
                'desc' => 'Bespoke event and wedding production store. Curated floral stage setups, fairy tunnel entry arches, haldi-mehendi gazebos, and DJ sound rental packs in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&auto=format&fit=crop&q=80',
                'pills' => ['Turnkey Event Production', 'Custom Theme Renders', 'Fresh Exotic Florals', 'Direct WhatsApp Quote'],
                'tag' => '★ 4.9 LUXURY EVENTS',
            ],
            'service_ecom_packers_movers_relocation' => [
                'badge' => '📦 5-Layer Household Moving & Transit Insurance Mart',
                'title' => 'Intercity Household Relocation, Vehicle Transit & Storage Cart',
                'desc' => 'Zero-damage household and office movers. 5-layer bubble & corrugated box packing, closed container fleets, door-to-door transit insurance in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1600585152220-90363fe7e115?w=800&auto=format&fit=crop&q=80',
                'pills' => ['5-Layer Bubble Packing', 'Free Transit Insurance', 'GPS Container Tracking', 'Zero Hidden Toll Costs'],
                'tag' => '★ 5.0 PACKERS MOVERS',
            ],
            'service_ecom_it_support_cloud_cybersecurity' => [
                'badge' => '💻 Small Business Managed IT & Cloud Security Subscriptions',
                'title' => 'Managed IT Support, Cloud Server Migration & Firewall Security Plans',
                'desc' => 'Essential enterprise IT plans. 24/7 helpdesk SLA, endpoint antivirus protection, automated cloud backups, and Microsoft 365 migrations in ' . ($tenant->city ?: 'your area') . '.',
                'hero_img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&auto=format&fit=crop&q=80',
                'pills' => ['15-Min Response SLA', 'Endpoint Antivirus Shield', 'Daily Cloud Backup', 'WhatsApp Desk Support'],
                'tag' => '★ 4.9 MANAGED IT',
            ],
            default => [
                'badge' => $bizCat === 'Manufacturers' ? '🏭 Wholesale Industrial Spares, Fasteners & Hardware Mart' : ($bizCat === 'Herbal Care' ? '🌿 Herbal Care, Pure Ayurvedic Oils & Rasayanas Store' : (in_array($bizCat, ['Other Services', 'Professional Services']) ? '🛠️ Doorstep Services, AMC Subscriptions & Express Booking Store' : (in_array($bizCat, ['Other Retail', 'Retail & E-Commerce']) ? '🛍️ Retail Store, Curated Essentials & Direct Checkout' : (in_array($bizCat, ['Restaurant & Cafes', 'Food & Dining']) ? '🍽️ Gourmet Cloud Kitchen, Food Delivery & Online Ordering' : '🛍️ Medical, Healthcare & Supplies Online Store')))),
                'title' => $bizCat === 'Manufacturers' ? 'B2B Wholesale Parts, Spares, Fasteners & Hardware Mart' : ($bizCat === 'Herbal Care' ? 'Pure Organic Herbs, Classical Churnas & Medicated Oils' : (in_array($bizCat, ['Other Services', 'Professional Services']) ? 'Professional Services, Doorstep Repairs & Maintenance Plans' : (in_array($bizCat, ['Other Retail', 'Retail & E-Commerce']) ? 'Curated Lifestyle, Fashion & Everyday Essentials' : (in_array($bizCat, ['Restaurant & Cafes', 'Food & Dining']) ? 'Handcrafted Meals, Cloud Kitchen Treats & Instant Delivery' : 'Authentic Healthcare, Diagnostics & Clinical Supplies')))),
                'desc' => $bizCat === 'Manufacturers' ? 'Direct factory supply with tiered volume MOQ pricing, GST tax invoicing, and reliable freight dispatch in ' . ($tenant->city ?: 'your area') . '.' : ($bizCat === 'Herbal Care' ? 'Shop authentic Ayurvedic remedies, cold-pressed herbal oils, and certified immunity boosters with doorstep delivery in ' . ($tenant->city ?: 'your area') . '.' : (in_array($bizCat, ['Other Services', 'Professional Services']) ? 'Book expert doorstep repair, deep cleaning, annual maintenance, and professional services with instant online booking in ' . ($tenant->city ?: 'your area') . '.' : (in_array($bizCat, ['Other Retail', 'Retail & E-Commerce']) ? 'Explore verified lifestyle essentials, instant cart drawer, and direct WhatsApp delivery checkout in ' . ($tenant->city ?: 'your area') . '.' : (in_array($bizCat, ['Restaurant & Cafes', 'Food & Dining']) ? 'Order hot freshly-cooked meals, instant cart checkout, and direct WhatsApp delivery in ' . ($tenant->city ?: 'your area') . '.' : 'Explore authentic health essentials with prescription upload, interactive cart drawer, and direct WhatsApp delivery checkout in ' . ($tenant->city ?: 'Nagpur') . '.')))),
                'hero_img' => $bizCat === 'Manufacturers' ? 'https://images.unsplash.com/photo-1581092334651-ddf26d9a09d0?w=800&auto=format&fit=crop&q=80' : ($bizCat === 'Herbal Care' ? 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=800&auto=format&fit=crop&q=80' : (in_array($bizCat, ['Other Services', 'Professional Services']) ? 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?w=800&auto=format&fit=crop&q=80' : (in_array($bizCat, ['Other Retail', 'Retail & E-Commerce']) ? 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=800&auto=format&fit=crop&q=80' : (in_array($bizCat, ['Restaurant & Cafes', 'Food & Dining']) ? 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=800&auto=format&fit=crop&q=80' : 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=800&auto=format&fit=crop&q=80')))),
                'pills' => $bizCat === 'Manufacturers' ? ['Factory Direct MOQ Slabs', 'B2B GST Invoicing', 'Mill Test Certified', 'Pan-India Dispatch'] : ($bizCat === 'Herbal Care' ? ['100% Pure & Forest Sourced', 'Slide Cart Drawer', 'WhatsApp Checkout', 'Instant Delivery'] : (in_array($bizCat, ['Other Services', 'Professional Services']) ? ['Verified Technicians', 'Slide Cart Drawer', 'WhatsApp Checkout', 'Service Warranty'] : (in_array($bizCat, ['Other Retail', 'Retail & E-Commerce']) ? ['100% Quality Checked', 'Interactive Cart Drawer', 'WhatsApp Checkout', 'Fast Courier Dispatch'] : (in_array($bizCat, ['Restaurant & Cafes', 'Food & Dining']) ? ['Freshly Cooked to Order', 'Slide Cart Drawer', 'WhatsApp Checkout', 'Piping Hot Dispatch'] : ['100% Genuine Certified', 'Slide Cart Drawer', 'WhatsApp Checkout', 'Instant Delivery'])))),
                'tag' => $bizCat === 'Manufacturers' ? '★ 5.0 B2B WHOLESALE' : ($bizCat === 'Herbal Care' ? '★ 5.0 AYURVEDA MART' : (in_array($bizCat, ['Other Services', 'Professional Services']) ? '★ 5.0 VERIFIED SERVICES' : (in_array($bizCat, ['Other Retail', 'Retail & E-Commerce']) ? '★ 4.9 RETAIL MART' : (in_array($bizCat, ['Restaurant & Cafes', 'Food & Dining']) ? '★ 5.0 FOOD MART' : '★ 5.0 HEALTH MART')))),
            ],
        };
    @endphp
    <section id="hero" class="relative overflow-hidden py-14 lg:py-20 bg-gradient-to-b from-purple-50/60 via-white to-slate-50 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-purple-200 text-purple-700 text-xs font-black shadow-xs">
                        <span>{{ $ecomConfig['badge'] }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.12]">
                        {{ $ecomConfig['title'] }} in <span class="bg-gradient-to-r from-purple-600 via-pink-600 to-rose-600 bg-clip-text text-transparent">{{ $tenant->city ?: 'Your City' }}</span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        {{ $ecomConfig['desc'] }}
                    </p>

                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start pt-1">
                        @foreach($ecomConfig['pills'] as $pill)
                            <span class="px-3.5 py-1.5 rounded-xl bg-white border border-purple-100 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-purple-600 text-[11px]"></i> {{ $pill }}
                            </span>
                        @endforeach
                    </div>

                    <!-- E-Commerce CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 pt-3">
                        <a href="#services" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-black text-sm shadow-xl shadow-purple-600/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                            <i class="fa-solid fa-bag-shopping"></i> Shop Products &amp; Add to Cart
                        </a>
                        <button type="button" wire:click="$set('showCartModal', true)" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white hover:bg-slate-50 border-2 border-purple-200 text-purple-900 font-bold text-sm shadow-xs transition hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-cart-shopping text-purple-600"></i> View Cart ({{ $this->cartCount }})
                        </button>
                    </div>
                </div>

                <!-- Right 5 Cols: Product Showcase Card -->
                <div class="lg:col-span-5">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-2 border-purple-100 group aspect-4/3">
                        <img src="{{ $ecomConfig['hero_img'] }}" alt="{{ $ecomConfig['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                        <div class="absolute top-3.5 left-3.5 bg-white/95 backdrop-blur-md px-3.5 py-1.5 rounded-full text-[11px] font-black text-purple-700 shadow flex items-center gap-1.5">
                            <i class="fa-solid fa-truck-fast text-emerald-500"></i> Free 48-Hour Delivery
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <span class="text-purple-300 text-[10px] font-black uppercase tracking-widest block mb-0.5">{{ $ecomConfig['tag'] }}</span>
                            <h3 class="font-black text-lg sm:text-xl">{{ $tenant->business_name }}</h3>
                            <p class="text-xs text-slate-300 mt-1"><i class="fa-brands fa-whatsapp text-emerald-400"></i> Direct WhatsApp Order Dispatch &bull; {{ $tenant->city }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @else
    <!-- ======================================================== -->
    <!-- 🏡 LAYOUT 2: MODERN BOUTIQUE & AIRBNB VILLA (DEFAULT)     -->
    <!-- Bento 3-Photo Collage + Amenity Pills + Host Chat         -->
    <!-- ======================================================== -->
    <section id="hero" class="relative overflow-hidden py-12 md:py-20 bg-gradient-to-b from-sky-50/50 via-white to-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 7 Cols: Boutique Villa Info & Booking Card -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Superhost / Industry Pill -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-sky-200 text-sky-800 text-xs font-black shadow-xs">
                        @if($archetype->code === 'hospitality')
                            <i class="fa-solid fa-star text-amber-400"></i> 4.98 Superhost Rated &bull; Boutique Stays &amp; Villas
                        @elseif($archetype->code === 'b2b')
                            <i class="fa-solid fa-certificate text-amber-500"></i> ISO Certified Industrial Manufacturing &amp; Supply
                        @elseif($archetype->code === 'service')
                            <i class="fa-solid fa-stethoscope text-sky-500"></i> Certified Healthcare &amp; Consultation Clinic
                        @else
                            <i class="fa-solid fa-bag-shopping text-emerald-500"></i> Top Rated Daily Essentials &amp; Retail Store
                        @endif
                    </div>

                    <!-- Modern Sans Headline -->
                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-[1.1]">
                        @if($archetype->code === 'hospitality')
                            Your Private Boutique Haven in the Heart of <span class="text-sky-600">{{ $tenant->city ?: 'Your City' }}</span>
                        @elseif($archetype->code === 'b2b')
                            Precision Engineering &amp; Custom Fabrication in <span class="text-amber-600">{{ $tenant->city ?: 'Our Works' }}</span>
                        @elseif($archetype->code === 'service')
                            Advanced Healthcare &amp; Consultation in <span class="text-sky-600">{{ $tenant->city ?: 'Your City' }}</span>
                        @else
                            Fresh Groceries &amp; Daily Needs Delivered in <span class="text-rose-600">{{ $tenant->city ?: 'Your City' }}</span>
                        @endif
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-xl">
                        {{ $tenant->tagline ?: "Welcome to {$tenant->business_name}. Providing dependable service, verified quality, and fast WhatsApp order support to our valued patrons in " . ($tenant->city ?: 'our city') . "." }}
                    </p>

                    <!-- Modern Amenity Pills -->
                    <div class="flex flex-wrap gap-2 pt-1">
                        @if($archetype->code === 'hospitality')
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-wifi text-sky-500"></i> 250 Mbps Wi-Fi
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-person-swimming text-sky-500"></i> Pool Access
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-mug-saucer text-sky-500"></i> Free Breakfast
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-square-parking text-sky-500"></i> Free Parking
                            </span>
                        @elseif($archetype->code === 'b2b')
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-gears text-amber-500"></i> CNC Turning &amp; Milling
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-file-contract text-amber-500"></i> MTR Quality Reports
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-truck-fast text-amber-500"></i> Fast Dispatch
                            </span>
                        @else
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-star text-amber-500"></i> 4.9/5 Rating
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-clock text-emerald-500"></i> Open Today
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs flex items-center gap-1.5">
                                <i class="fa-solid fa-shield-halved text-sky-500"></i> Verified Business
                            </span>
                        @endif
                    </div>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center gap-3 pt-3">
                        <a href="#services" class="w-full sm:w-auto px-7 py-3.5 rounded-2xl bg-sky-600 hover:bg-sky-500 text-white font-extrabold text-sm shadow-lg shadow-sky-600/20 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                            @if($this->isLandingPage)
                                <i class="fa-solid fa-gift"></i> Claim Limited Promo Offer
                            @elseif($this->isEcommerce)
                                <i class="fa-solid fa-bag-shopping"></i> Shop Online Products
                            @elseif($archetype->code === 'hospitality')
                                <i class="fa-solid fa-bed"></i> Browse Suites &amp; Reserve
                            @elseif($archetype->code === 'b2b')
                                <i class="fa-solid fa-file-invoice-dollar"></i> Request a Quote
                            @elseif($archetype->code === 'service')
                                <i class="fa-regular fa-calendar-check"></i> Book Appointment Slot
                            @else
                                <i class="fa-solid fa-bag-shopping"></i> Browse Store Catalog
                            @endif
                        </a>
                        <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to inquire about your services.') }}" target="_blank" class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-md transition hover:scale-[1.02] flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i> {{ $archetype->code === 'hospitality' ? 'Chat with Host' : 'WhatsApp Us' }}
                        </a>
                    </div>
                </div>

                <!-- Right 5 Cols: Modern Airbnb / Industry Bento Collage (3 Photos) -->
                <div class="lg:col-span-5">
                    <div class="grid grid-cols-2 gap-3.5">
                        <!-- Bento Top Large Photo -->
                        <div class="col-span-2 relative rounded-3xl overflow-hidden shadow-xl aspect-16/10 group">
                            @if($archetype->code === 'hospitality')
                                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&auto=format&fit=crop&q=80" alt="Boutique Villa" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @elseif($archetype->code === 'b2b')
                                <img src="https://images.unsplash.com/photo-1581092335397-9583fe92d232?w=800&auto=format&fit=crop&q=80" alt="Industrial Manufacturing" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @elseif($archetype->code === 'service')
                                <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=800&auto=format&fit=crop&q=80" alt="Clinic Interior" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <img src="https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=800&auto=format&fit=crop&q=80" alt="Store Front" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @endif

                            <div class="absolute top-3 left-3 bg-white/95 backdrop-blur-md px-3 py-1 rounded-full text-[11px] font-black text-slate-900 shadow flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-emerald-500"></i> Verified Facility
                            </div>
                            <div class="absolute bottom-3 left-3 right-3 text-white bg-gradient-to-t from-black/80 to-transparent p-3 rounded-2xl">
                                <span class="font-black text-sm block">{{ $tenant->business_name }}</span>
                                <span class="text-xs text-white/80"><i class="fa-solid fa-location-dot text-rose-400"></i> {{ $tenant->address ?: $tenant->city }}</span>
                            </div>
                        </div>
                        <!-- Bento Small Photo 1 -->
                        <div class="rounded-2xl overflow-hidden aspect-4/3 shadow-md group">
                            <img src="{{ $archetype->code === 'b2b' ? 'https://images.unsplash.com/photo-1504917599217-d4dc5ebe6122?w=500&auto=format&fit=crop&q=80' : 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=500&auto=format&fit=crop&q=80' }}" alt="Facility Detail" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <!-- Bento Small Photo 2 -->
                        <div class="rounded-2xl overflow-hidden aspect-4/3 shadow-md group">
                            <img src="{{ $archetype->code === 'b2b' ? 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=500&auto=format&fit=crop&q=80' : 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=500&auto=format&fit=crop&q=80' }}" alt="Operations Detail" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endif

    @if($this->isLandingPage)
    <!-- ======================================================== -->
    <!-- 🚀 DEDICATED HIGH-CONVERSION LANDING PAGE SPOTLIGHT     -->
    <!-- (NO CART • PROMOTIONAL FUNNEL & VOUCHER CLAIM)          -->
    <!-- ======================================================== -->
    <section id="promo-offer" class="py-14 {{ $currentTheme === 'dark_luxury' ? 'bg-[#090D16] text-white border-b border-zinc-800' : 'bg-slate-50 text-slate-900 border-b border-slate-200' }}">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <span class="text-xs font-black uppercase tracking-widest text-purple-500 bg-purple-500/10 px-3.5 py-1 rounded-full border border-purple-500/20">
                    ⭐ EXCLUSIVE PROMOTIONAL PACKAGE
                </span>
                <h2 class="text-3xl sm:text-4xl font-black mt-3 tracking-tight">
                    Lock In Your VIP Discount Voucher Today
                </h2>
                <p class="text-sm sm:text-base opacity-75 max-w-2xl mx-auto mt-2">
                    Experience world-class treatment by certified specialists with our all-inclusive limited promotional bundle in {{ $tenant->city ?: 'Nagpur' }}.
                </p>
            </div>

            <!-- Spotlight Deal Card -->
            <div class="rounded-3xl border-2 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-purple-500/40 shadow-2xl shadow-purple-500/10' : 'bg-white border-purple-200 shadow-xl' }} p-6 sm:p-10 relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-purple-500/20 rounded-full blur-2xl pointer-events-none"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-5">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-rose-500/10 border border-rose-500/30 text-rose-500 font-extrabold text-xs">
                            <i class="fa-solid fa-fire"></i> Best Value All-In-One Deal &bull; Save ₹1,500
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-black leading-tight">
                            Complete Transformation &amp; Rejuvenation Package
                        </h3>
                        <p class="text-sm opacity-80 leading-relaxed">
                            Includes complete personal consultation, hair/skin diagnosis, full therapy session using premium dermatological products, and complimentary aftercare kit.
                        </p>

                        <!-- Feature Checklist -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                            <div class="flex items-center gap-2.5 text-xs sm:text-sm font-semibold">
                                <i class="fa-solid fa-circle-check text-emerald-500 text-base shrink-0"></i>
                                <span>Certified Senior Specialist</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs sm:text-sm font-semibold">
                                <i class="fa-solid fa-circle-check text-emerald-500 text-base shrink-0"></i>
                                <span>100% Genuine Imported Products</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs sm:text-sm font-semibold">
                                <i class="fa-solid fa-circle-check text-emerald-500 text-base shrink-0"></i>
                                <span>Private Air-Conditioned Suite</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs sm:text-sm font-semibold">
                                <i class="fa-solid fa-circle-check text-emerald-500 text-base shrink-0"></i>
                                <span>Zero Hidden Costs Guarantee</span>
                            </div>
                        </div>

                        <!-- Price Tag -->
                        <div class="pt-4 flex flex-wrap items-baseline gap-4">
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl sm:text-4xl font-black text-emerald-500">₹1,999</span>
                                <span class="text-base text-slate-400 line-through">₹3,500</span>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-black bg-rose-500 text-white shadow">
                                43% FLAT DISCOUNT
                            </span>
                        </div>
                    </div>

                    <!-- Right Column: Instant Claim Form -->
                    <div class="lg:col-span-5 p-6 rounded-2xl {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-950 border border-zinc-800' : 'bg-slate-50 border border-slate-200' }} space-y-4">
                        <div class="text-center">
                            <span class="text-xs font-black uppercase tracking-wider text-purple-500">Fast Voucher Claim</span>
                            <h4 class="font-bold text-base mt-0.5">Claim Your Offer Voucher</h4>
                            <p class="text-[11px] opacity-70">Takes 10 seconds. Locks in price instantly.</p>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <label class="block text-[11px] font-bold mb-1 opacity-80">Your Name *</label>
                                <input wire:model="leadName" type="text" placeholder="Enter your full name" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-700 text-white' : 'bg-white text-slate-900' }} outline-none focus:ring-2 focus:ring-purple-500">
                                @error('leadName') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold mb-1 opacity-80">WhatsApp Mobile Number *</label>
                                <input wire:model="leadPhone" type="tel" placeholder="10-digit mobile number" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-700 text-white' : 'bg-white text-slate-900' }} outline-none focus:ring-2 focus:ring-purple-500">
                                @error('leadPhone') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                            </div>
                            <button wire:click="claimOffer('Exclusive VIP Package (Flat 40% Off)')" class="w-full py-3 px-4 rounded-xl btn-brand-gradient text-white font-extrabold text-xs shadow-lg transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.02]">
                                <i class="fa-solid fa-gift"></i> Claim Instant WhatsApp Voucher
                            </button>
                            <p class="text-[10px] text-center opacity-60">
                                <i class="fa-solid fa-lock text-[9px]"></i> 100% Privacy. Zero Spam. Instant WhatsApp Delivery.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($this->isSectionVisible('trust'))
    <!-- 💎 KEY HIGHLIGHTS / WHY CHOOSE US -->
    <section id="highlights" class="py-14 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900/50 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-neutral-50 border-neutral-200' : 'bg-white border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-xs font-bold uppercase tracking-widest text-purple-600 mb-2">{{ $this->customizations['trust']['heading'] ?? 'Why Customers Trust Us' }}</h2>
                <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                    {{ $this->customizations['trust']['subheading'] ?? ('Setting The Standard For Excellence in ' . $tenant->city) }}
                </h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @if(!empty($this->customizations['trust']['cards']) && is_array($this->customizations['trust']['cards']))
                    @foreach($this->customizations['trust']['cards'] as $card)
                    <div class="p-6 rounded-2xl border transition hover-lift {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures', 'dark_luxury']) ? 'bg-slate-900 border-blue-900/60 text-white' : 'bg-white border-slate-200 text-slate-900 shadow-sm' }}">
                        <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-500 flex items-center justify-center text-xl mb-4 font-black">
                            <i class="fa-solid {{ $card['icon'] ?? 'fa-circle-check' }}"></i>
                        </div>
                        <h4 class="font-black text-base mb-1.5 {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures', 'dark_luxury']) ? 'text-white' : 'text-slate-900' }}">{{ $card['title'] }}</h4>
                        <p class="text-xs leading-relaxed {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures', 'dark_luxury']) ? 'text-slate-300' : 'text-slate-600' }}">{{ $card['desc'] }}</p>
                    </div>
                    @endforeach
                @elseif($archetype->code === 'service')
                    @if($bizCat === 'Beauty & Salons' || str_starts_with($currentTheme, 'salon_') || $currentTheme === 'wellness_sanctuary')
                    <!-- 💇 BEAUTY & SALONS 4 DISTINCT HIGHLIGHTS -->
                    <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                        <div class="w-12 h-12 rounded-2xl bg-pink-500/10 text-pink-600 flex items-center justify-center text-xl mb-4 font-bold">
                            <i class="fa-solid fa-scissors"></i>
                        </div>
                        <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Master Stylists &amp; Artists</h4>
                        <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Internationally certified beauty artists specializing in precision haircuts, balayage color, and HD makeup.</p>
                    </div>
                    <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                        <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 flex items-center justify-center text-xl mb-4 font-bold">
                            <i class="fa-solid fa-leaf"></i>
                        </div>
                        <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Organic &amp; Cruelty-Free</h4>
                        <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Only dermatologist-tested, 100% vegan, and toxin-free luxury products used on your hair and skin.</p>
                    </div>
                    <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl mb-4 font-bold">
                            <i class="fa-solid fa-couch"></i>
                        </div>
                        <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Private VIP Lounges</h4>
                        <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Peaceful ambient lighting, acoustic privacy, comfortable recliner chairs, and soothing aromatherapy music.</p>
                    </div>
                    <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Autoclaved Hygiene</h4>
                        <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Individually sealed and autoclaved instruments, sanitized linens, and single-use disposable kits.</p>
                    </div>
                    @elseif($bizCat === 'Coaching & Institutes' || str_starts_with($currentTheme, 'coaching_'))
                    <!-- 🎓 COACHING & INSTITUTES (PHYSICS WALLAH / ALLEN STYLE) 4 TRUST PILLARS -->
                    <div class="p-6 rounded-2xl border transition hover-lift {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'bg-slate-900 border-blue-900/60 text-white' : 'bg-white border-blue-100 shadow-sm' }}">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-xl mb-4 font-black">
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                        <h4 class="font-black text-base mb-1.5 {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'text-white' : 'text-slate-900' }}">Kota &amp; Ex-IITian Master Mentors</h4>
                        <p class="text-xs leading-relaxed {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'text-slate-300' : 'text-slate-600' }}">Learn directly from star faculties with 15+ years of experience producing AIR 1-100 ranks in JEE, NEET &amp; UPSC.</p>
                    </div>
                    <div class="p-6 rounded-2xl border transition hover-lift {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'bg-slate-900 border-blue-900/60 text-white' : 'bg-white border-blue-100 shadow-sm' }}">
                        <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-500 flex items-center justify-center text-xl mb-4 font-black">
                            <i class="fa-solid fa-crosshairs"></i>
                        </div>
                        <h4 class="font-black text-base mb-1.5 {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'text-white' : 'text-slate-900' }}">NTA Pattern CBT Engine</h4>
                        <p class="text-xs leading-relaxed {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'text-slate-300' : 'text-slate-600' }}">Exact test simulation with negative marking radar, instant All-India percentile benchmark, and video solutions.</p>
                    </div>
                    <div class="p-6 rounded-2xl border transition hover-lift {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'bg-slate-900 border-blue-900/60 text-white' : 'bg-white border-blue-100 shadow-sm' }}">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-xl mb-4 font-black">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <h4 class="font-black text-base mb-1.5 {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'text-white' : 'text-slate-900' }}">24/7 WhatsApp Doubt Desk</h4>
                        <p class="text-xs leading-relaxed {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'text-slate-300' : 'text-slate-600' }}">Instant step-by-step doubt resolution with average turnaround under 15 minutes by dedicated academic teaching assistants.</p>
                    </div>
                    <div class="p-6 rounded-2xl border transition hover-lift {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'bg-slate-900 border-blue-900/60 text-white' : 'bg-white border-blue-100 shadow-sm' }}">
                        <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-500 flex items-center justify-center text-xl mb-4 font-black">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <h4 class="font-black text-base mb-1.5 {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'text-white' : 'text-slate-900' }}">Pan-India 48-Hr Express Courier</h4>
                        <p class="text-xs leading-relaxed {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'text-slate-300' : 'text-slate-600' }}">Spiral notes, hardbound question banks, and offline pen-drive kits dispatched in tamper-proof waterproof packaging.</p>
                    </div>
                    @else
                    <!-- Service / Clinic 4 Highlights -->
                    <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                        <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Licensed Specialists</h4>
                        <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Experienced doctors dedicated to thorough checkups, honest advice, and empathetic care.</p>
                    </div>
                    <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                        <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 flex items-center justify-center text-xl mb-4 font-bold">
                            <i class="fa-solid fa-microscope"></i>
                        </div>
                        <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Modern Diagnostics</h4>
                        <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Equipped with high-precision instruments to provide accurate treatment in sterile conditions.</p>
                    </div>
                    <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Zero Wait Time Slots</h4>
                        <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Pick your preferred appointment slot online and get instant WhatsApp confirmation.</p>
                    </div>
                    <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                        <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 flex items-center justify-center text-xl mb-4 font-bold">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Transparent Pricing</h4>
                        <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Transparent consultation fees with no surprise hidden bills or unnecessary tests.</p>
                    </div>
                    @endif

                @elseif($archetype->code === 'hospitality')
                <!-- Hospitality / Hotel Highlights per Theme -->
                @if($currentTheme === 'hotel_business')
                <!-- City Business Hotel Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-blue-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Ergonomic Workstations</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Every room features dedicated ergonomic desk, universal charging, and 150 Mbps Wi-Fi.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-blue-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Conference Boardrooms</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Equipped for client presentations, video calls, and corporate team negotiations.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-blue-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">24/7 Express Check-In</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Zero wait check-in and checkout tailored for busy corporate flight and train schedules.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-blue-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-van-shuttle"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Airport &amp; Station Shuttle</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Punctual transit pick-up and drop directly to your flight or train terminal.</p>
                </div>

                @elseif($currentTheme === 'motel_highway')
                <!-- Highway Express Motel Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-red-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-red-500/10 text-red-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-square-parking"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Drive-In Safe Parking</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Park directly outside your room with 24/7 CCTV surveillance and security guards.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-red-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">24/7 Front Desk</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Arrive at midnight or 3 AM with zero delay. Instant front desk check-in anytime.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-red-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-orange-500/10 text-orange-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Highway Dhaba Diner</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Freshly made hot dal tadka, rotis, parathas, and hot tea available round the clock.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-red-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-faucet-drip"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">24/7 Hot Water Geyser</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Steaming hot showers to wash off highway road fatigue and recharge quickly.</p>
                </div>

                @elseif($currentTheme === 'hotel_boutique')
                <!-- Urban Boutique Hotel Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-purple-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-martini-glass-citrus"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Rooftop Sunset Lounge</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Panoramic city views, artisanal espresso coffees, woodfired appetizers, and music.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-purple-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-pink-500/10 text-pink-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Couple-Friendly &amp; Safe</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Verified, welcoming, and 100% judgment-free stays with express digital verification.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-purple-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Designer Modern Suites</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Custom furnishings, ambient LED strip lighting, private balconies, and rain showers.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-purple-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">City Center Location</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Situated in the premier dining, shopping, and entertainment hub of the city.</p>
                </div>

                @elseif($currentTheme === 'hotel_budget')
                <!-- Smart Budget Hotel Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">100% Sanitized &amp; Clean</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Deep-sanitized rooms, sealed bath amenities, and fresh crisp white bedding.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-mug-hot"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Free Hot Breakfast</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Complimentary morning breakfast buffet included with every direct booking.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-wifi"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">100 Mbps Free Internet</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Seamless high-speed Wi-Fi in every room for video calls, work, and streaming.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-tag"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Best Rate Guaranteed</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Zero middleman commissions with honest per-night transparent pricing.</p>
                </div>

                @elseif($currentTheme === 'hotel_family')
                <!-- Family Hotel Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Interconnected Suites</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Spacious 4-6 guest adjoining rooms with privacy and shared family living space.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-tree"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">500+ Party &amp; Wedding Lawn</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Expansive landscaped grass lawn for wedding receptions, birthdays, and anniversaries.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-water-ladder"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Kids Splash Pool</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Safe shallow pool and play zone with slides, swings, and games for children.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-bowl-rice"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Pure Veg &amp; Family Dining</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Dedicated family dining hall with authentic North &amp; South Indian vegetarian delicacies.</p>
                </div>

                @elseif($currentTheme === 'hotel_resort')
                <!-- Grand Palace Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-200/60 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">5-Star Butler Service</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Personal concierge, luggage assistance, and bespoke 24/7 in-room dining.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-200/60 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-water-ladder"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Infinity Pool &amp; Cabanas</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Temperature-controlled swimming pool flanked by royal garden sun loungers.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-200/60 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Royal Multi-Cuisine</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Gourmet dining prepared by seasoned chefs with complimentary morning high tea.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-200/60 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Sanitized Royal Suites</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Posturpedic mattresses, daily fresh linens, and premium marble bath amenities.</p>
                </div>

                @elseif($currentTheme === 'dark_luxury')
                <!-- Obsidian VIP Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-zinc-900 border-amber-500/30 shadow-xl">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-car"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-white">VIP Chauffeur Transfer</h4>
                    <p class="text-xs leading-relaxed text-zinc-400">Complimentary luxury vehicle pickup and drop-off for private suite guests.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-zinc-900 border-amber-500/30 shadow-xl">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-hot-tub-person"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-white">Penthouse Jacuzzi</h4>
                    <p class="text-xs leading-relaxed text-zinc-400">In-suite private hot tub with aromatherapy salts and skyline evening vistas.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-zinc-900 border-amber-500/30 shadow-xl">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-martini-glass"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-white">Midnight Lounge</h4>
                    <p class="text-xs leading-relaxed text-zinc-400">Curated rooftop cocktails, mood lighting, and private members ambiance.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-zinc-900 border-amber-500/30 shadow-xl">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-white">Dedicated WhatsApp Butler</h4>
                    <p class="text-xs leading-relaxed text-zinc-400">Instant VIP reservations and concierge response on your personal mobile.</p>
                </div>

                @elseif($currentTheme === 'minimal_card')
                <!-- Santorini Mediterranean Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-sky-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-water-ladder"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Private Plunge Pools</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Cliffside in-suite plunge pools overlooking azure horizons and whitewashed terraces.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-sky-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-sun"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Sunset Caldera Terraces</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Unobstructed golden hour sunsets with chilled Mediterranean wines and appetizers.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-sky-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Organic Aegean Breakfast</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Fresh Greek yoghurt, wild thyme honey, artisan olives, and warm fresh bread daily.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-sky-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-sailboat"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Yacht Charters &amp; Concierge</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Bespoke private boat excursions, hidden beach explorations, and 24/7 host care.</p>
                </div>

                @elseif($currentTheme === 'nature_retreat')
                <!-- Wilderness Safari Glamping Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-emerald-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-truck-monster"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">4x4 Jeep Safaris</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Daily morning and dusk game drives led by veteran wildlife trackers and naturalists.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-emerald-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-tree"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Canopy Treehouses</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Elevated solid teak chalets amidst lush forest canopies with birdwatching decks.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-emerald-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-fire"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">Bonfires &amp; Bush Dinners</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Nightly crackling campfires, charcoal BBQ, and astronomy stargazing sessions.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-emerald-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-slate-900">100% Eco-Sustainable</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Solar-powered luxury canvas tents, zero single-use plastics, and organic forest honey.</p>
                </div>

                @elseif($currentTheme === 'coastal_beach')
                <!-- Maldives Overwater Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-cyan-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 text-cyan-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-water-ladder"></i>
                    </div>
                    <h4 class="font-black text-base mb-1.5 text-slate-900">Lagoon Coral Access</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Private stilt ladder directly into crystalline turquoise reefs filled with exotic marine life.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-cyan-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-umbrella-beach"></i>
                    </div>
                    <h4 class="font-black text-base mb-1.5 text-slate-900">Private Beach Cabanas</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Reserved sun daybeds on powdery white sand with fresh coconut and cocktail service.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-cyan-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-ship"></i>
                    </div>
                    <h4 class="font-black text-base mb-1.5 text-slate-900">Sunset Catamaran Cruise</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Daily twilight yacht sailing to spot playful wild spinner dolphins in open waters.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-cyan-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-champagne-glasses"></i>
                    </div>
                    <h4 class="font-black text-base mb-1.5 text-slate-900">Barefoot Beachfront BBQ</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Candlelight seafood barbecues prepared directly on the sand with ambient island music.</p>
                </div>

                @elseif($currentTheme === 'heritage_haveli')
                <!-- Rajasthan Royal Haveli Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-amber-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Dhol &amp; Tilak Welcome</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Traditional Rajputana royal swagat with rose petal showers and welcome saffron drink.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-amber-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-masks-theater"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Folk Dance &amp; Puppets</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Live courtyard evenings featuring Kathputli puppetry and vibrant Kalbelia dancers.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-amber-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">36-Delicacy Royal Thali</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Authentic Dal Baati Churma, Gatte ki Sabzi, and royal desserts served in silver katoris.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-amber-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-chess-rook"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Carved Jharokha Balconies</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Intricately carved sandstone window bays with plush silken floor cushions.</p>
                </div>

                @elseif($currentTheme === 'mountain_chalet')
                <!-- Alpine Mountain Chalet Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-orange-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-orange-500/10 text-orange-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-fire-burner"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">In-Suite Stone Fireplace</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Crackling alpine cedarwood hearths with cozy armchairs and complimentary hot mulled cider.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-orange-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-hot-tub-person"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Heated Hydro Jacuzzi</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Steaming cedarwood tubs with views of snow-clad pine forest slopes and peaks.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-orange-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-snowflake"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Himalayan Snow Balconies</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Panoramic private balconies catching the first golden morning light on mountain crests.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-orange-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-person-hiking"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Guided Forest Treks</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Private guided walks through fragrant deodar groves, apple orchards, and river trails.</p>
                </div>

                @elseif($currentTheme === 'wellness_sanctuary')
                <!-- Ayurvedic Yoga Sanctuary Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Doctor Nadi Diagnosis</h4>
                    <p class="text-xs leading-relaxed text-stone-600">In-depth Ayurvedic pulse diagnosis and customized Dosha balancing roadmap.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-sun"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Sunrise Yoga &amp; Pranayama</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Daily morning meditation and Hatha yoga sessions in an open-air mountain pavilion.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-spa"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Abhyanga &amp; Shirodhara</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Herbal warm oil therapies and herbal steam baths administered by trained therapists.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-teal-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-700 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-bowl-rice"></i>
                    </div>
                    <h4 class="font-serif font-black text-base mb-1.5 text-stone-900">Farm-to-Table Sattvic Food</h4>
                    <p class="text-xs leading-relaxed text-stone-600">Organic, freshly cooked alkaline cuisine tailored to enhance vitality and gut health.</p>
                </div>

                @else
                <!-- Modern Boutique Villa Highlights -->
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-slate-200/80 shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Self Check-In Smart Lock</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Effortless arrival with keyless digital access and 24/7 host assistance.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-slate-200/80 shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-wifi"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">250 Mbps Fiber Wi-Fi</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Symmetric high-speed connection for remote work, video calls, and streaming.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-slate-200/80 shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-sparkles"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Spotless Cleanliness</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Professional daily housekeeping, fresh sanitized towels, and crisp linens.</p>
                </div>
                <div class="p-6 rounded-3xl border transition hover-lift bg-white border-slate-200/80 shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-tree"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Garden &amp; Pool Access</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Unwind by the swimming pool or enjoy quiet mornings on your private veranda.</p>
                </div>
                @endif

                @elseif($archetype->code === 'b2b')
                <!-- B2B Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">High Micron Tolerance</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Advanced CNC turning and laser cutting engineered to exacting industrial specifications.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">ISO Certified Quality</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Material test reports (MTR) provided with every batch for 100% compliance.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Bulk Wholesale Capacity</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">High-speed batch runs with tiered volume pricing for contract manufacturers.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">On-Time Dispatch</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Guaranteed shipment schedules with full digital consignment tracking.</p>
                </div>

                @elseif($bizCat === 'Coaching & Institutes' || str_starts_with($currentTheme, 'coaching_'))
                <!-- 🎓 COACHING & INSTITUTES HIGHLIGHTS -->
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-blue-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">100% Exam Pattern Calibrated</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Strict NTA, UPSC &amp; Board criteria matching with negative marking &amp; timing radar.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-emerald-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Kota Faculty Mentorship</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Study materials, notes, and full mocks authored &amp; reviewed by top AIR rankers.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-amber-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">Pan-India Express Dispatch</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Doorstep courier for physical notes, solved PYQ hardbounds, and encrypted pen-drives across {{ $tenant->city }}.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift bg-white border-purple-100 shadow-sm">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 text-slate-900">1-on-1 Academic Doubt Desk</h4>
                    <p class="text-xs leading-relaxed text-slate-600">Direct WhatsApp doubt resolution with senior subject teachers within 30 minutes.</p>
                </div>

                @else
                <!-- Retail / Kirana / Food Highlights -->
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">100% Fresh Daily</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Direct farm sourcing and quality inspections ensure genuine fresh groceries.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-motorcycle"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Fast Local Delivery</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Delivered to your doorstep within 60 minutes across {{ $tenant->city }}.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Best Wholesale Prices</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Enjoy daily supermarket discounts and genuine branded staple goods.</p>
                </div>
                <div class="p-6 rounded-2xl border transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 flex items-center justify-center text-xl mb-4 font-bold">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h4 class="font-bold text-base mb-1.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Easy WhatsApp Order</h4>
                    <p class="text-xs leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">Add items to bag and send directly via WhatsApp. No app installation needed.</p>
                </div>
                @endif

            </div>
        </div>
    </section>
    @endif

    @if($this->isSectionVisible('catalog'))
    <!-- 📦 CATALOG & SERVICES SECTION (Intent-Based Dynamic Rendering) -->
    <section id="services" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-950 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-widest text-purple-600 mb-1">
                        @if($this->isEcommerce)
                            Online Products Store
                        @elseif($this->isLandingPage)
                            Featured Promotional Offers
                        @elseif($archetype->code === 'service')
                            Clinical Specialities &amp; Treatments
                        @elseif($archetype->code === 'b2b')
                            Fabrication &amp; Engineering Line
                        @elseif($archetype->code === 'hospitality')
                            Accommodations &amp; Suites
                        @else
                            Featured Store Items
                        @endif
                    </h2>
                    <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                        @if($this->isEcommerce)
                            @if($bizCat === 'Coaching & Institutes' || str_starts_with($currentTheme, 'coaching_'))
                                Exam Study Kits, Test Passes &amp; Prep Mart (Add to Cart)
                            @else
                                Shop Beauty &amp; Essentials (Add to Cart)
                            @endif
                        @elseif($this->isLandingPage)
                            Select Your Discounted Promo Session
                        @elseif($archetype->code === 'service')
                            Available Appointments &amp; Services Menu
                        @elseif($archetype->code === 'b2b')
                            Industrial Products &amp; Custom Components
                        @elseif($archetype->code === 'hospitality')
                            Luxury Rooms &amp; Suites Availability
                        @else
                            Explore Catalog &amp; Inquire
                        @endif
                    </h3>
                </div>

                <!-- Search, Sorter & Category/Brand Toolbar -->
                <div class="flex flex-col gap-3 w-full md:w-auto">
                    <div class="flex flex-col sm:flex-row items-center gap-2.5">
                        <!-- Live Search Input -->
                        <div class="relative w-full sm:w-60">
                            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                            <input wire:model.live.debounce.250ms="search" type="text" placeholder="Search products..." class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 outline-none focus:ring-2 focus:ring-purple-500 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-700 text-white' : 'bg-white' }}">
                        </div>

                        <!-- Sort By Selector -->
                        <div class="relative w-full sm:w-auto">
                            <select wire:model.live="sortBy" class="w-full sm:w-auto px-3 py-2 text-xs font-bold rounded-xl border border-slate-200 outline-none cursor-pointer {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-700 text-white' : 'bg-white text-slate-700' }}">
                                <option value="featured">✨ Featured</option>
                                <option value="price_asc">💰 Price: Low to High</option>
                                <option value="price_desc">💎 Price: High to Low</option>
                                <option value="discount_desc">🏷️ Highest Discount</option>
                            </select>
                        </div>
                    </div>

                    <!-- Category Filter Pills -->
                    <div class="flex items-center gap-1.5 overflow-x-auto w-full max-w-full pb-1">
                        <button wire:click="$set('selectedCategory', 'all')" class="whitespace-nowrap px-3 py-1.5 rounded-full text-xs font-bold transition cursor-pointer {{ $selectedCategory === 'all' ? 'btn-brand-gradient text-white shadow' : ($currentTheme === 'dark_luxury' ? 'bg-zinc-800 text-zinc-300 hover:bg-zinc-700' : 'bg-slate-200 text-slate-700 hover:bg-slate-300') }}">
                            All Categories ({{ $items->count() }})
                        </button>
                        @foreach($categories as $category)
                        <button wire:click="$set('selectedCategory', '{{ $category }}')" class="whitespace-nowrap px-3 py-1.5 rounded-full text-xs font-bold transition cursor-pointer {{ $selectedCategory === $category ? 'btn-brand-gradient text-white shadow' : ($currentTheme === 'dark_luxury' ? 'bg-zinc-800 text-zinc-300 hover:bg-zinc-700' : 'bg-slate-200 text-slate-700 hover:bg-slate-300') }}">
                            {{ $category }}
                        </button>
                        @endforeach
                    </div>

                    <!-- 🏷️ Brand Filter Pills (If Brands Exist) -->
                    @if(isset($brands) && $brands->isNotEmpty())
                    <div class="flex items-center gap-1.5 overflow-x-auto w-full max-w-full pb-1 pt-1 border-t border-slate-100/60 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : '' }}">
                        <span class="text-[10px] font-black uppercase text-slate-400 mr-1 shrink-0 flex items-center gap-1">
                            <i class="fa-solid fa-tag text-[9px]"></i> Brand:
                        </span>
                        <button wire:click="$set('selectedBrand', 'all')" class="whitespace-nowrap px-2.5 py-1 rounded-lg text-[11px] font-bold transition cursor-pointer {{ $selectedBrand === 'all' ? 'bg-purple-600 text-white shadow' : ($currentTheme === 'dark_luxury' ? 'bg-zinc-800 text-zinc-300' : 'bg-slate-100 text-slate-600 hover:bg-slate-200') }}">
                            All Brands
                        </button>
                        @foreach($brands as $bName)
                        <button wire:click="$set('selectedBrand', '{{ $bName }}')" class="whitespace-nowrap px-2.5 py-1 rounded-lg text-[11px] font-bold transition cursor-pointer {{ $selectedBrand === $bName ? 'bg-purple-600 text-white shadow' : ($currentTheme === 'dark_luxury' ? 'bg-zinc-800 text-zinc-300' : 'bg-slate-100 text-slate-600 hover:bg-slate-200') }}">
                            {{ $bName }}
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- Items Cards Grid -->
            @if($items->isEmpty())
            <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-200 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800 text-zinc-400' : '' }}">
                <i class="fa-solid fa-box-open text-4xl text-slate-300 mb-3"></i>
                <h4 class="font-bold text-base">No items found matching your filter</h4>
                <p class="text-xs text-slate-500 mt-1">Try clearing your search query or switching categories.</p>
            </div>
            @else
            @if($archetype->code === 'hospitality')
                <!-- 🏨 HOSPITALITY: 4 DISTINCT ROOM CARD ARCHITECTURES -->

                @if($currentTheme === 'hotel_business')
                <!-- ============================================== -->
                <!-- 🏢 THEME: CITY BUSINESS & EXECUTIVE ROOMS       -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-blue-200 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-briefcase text-[9px]"></i> Corporate Executive
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-wifi text-blue-300"></i> 150 Mbps Wi-Fi &bull; Workstation</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.95 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-blue-50/50 p-4 rounded-2xl border border-blue-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-blue-600 text-xs"></i> Ergonomic Desk &amp; Chair
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-blue-600 text-xs"></i> High-Speed Fiber Wi-Fi
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-blue-600 text-xs"></i> 24/7 Express In-Room Dining
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-blue-600 text-xs"></i> Airport / Station Shuttle
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-blue-600">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ PER NIGHT (INCL. GST)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm availability and corporate booking details.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-bed"></i> Book Executive Room
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have an inquiry about ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'motel_highway')
                <!-- ============================================== -->
                <!-- 🚗 THEME: HIGHWAY EXPRESS MOTEL ROOMS          -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-red-200 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-car text-[9px]"></i> Drive-In Motel
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-square-parking text-red-300"></i> Park in Front &bull; 24/7 Check-in</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.90 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-red-50/50 p-4 rounded-2xl border border-red-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-red-600 text-xs"></i> Drive-In Safe Parking
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-red-600 text-xs"></i> 24/7 Front Desk Check-in
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-red-600 text-xs"></i> 24-Hour Hot Geyser Shower
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-red-600 text-xs"></i> Highway Dhaba Dining
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-red-600">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ NIGHT TRANSIT RATE</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book highway room ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm front desk availability.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-red-600 hover:bg-red-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-key"></i> Quick Highway Booking
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have an inquiry about ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'hotel_boutique')
                <!-- ============================================== -->
                <!-- 🏨 THEME: URBAN BOUTIQUE & ROOFTOP SUITES       -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-purple-200 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-purple-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-martini-glass-citrus text-[9px]"></i> Boutique Designer
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-heart text-purple-300"></i> Couple Friendly &bull; City View</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.97 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-purple-50/50 p-4 rounded-2xl border border-purple-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-purple-600 text-xs"></i> Rooftop Sunset Lounge Access
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-purple-600 text-xs"></i> Couple-Friendly Verified
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-purple-600 text-xs"></i> Private City Balcony
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-purple-600 text-xs"></i> Smart TV with Netflix
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-purple-600">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ PER NIGHT</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to reserve boutique suite ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-couch"></i> Reserve Boutique Room
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have an inquiry about ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'hotel_budget')
                <!-- ============================================== -->
                <!-- 🛏️ THEME: SMART BUDGET & ECONOMY ROOMS         -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-teal-200 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-teal-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-bed text-[9px]"></i> Smart Economy
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-teal-300"></i> 100% Sanitized &bull; Free Breakfast</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.92 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-teal-50/50 p-4 rounded-2xl border border-teal-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-600 text-xs"></i> 100% Sanitized Linen
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-600 text-xs"></i> Free Morning Hot Breakfast
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-600 text-xs"></i> Fast 100 Mbps Wi-Fi
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-600 text-xs"></i> Best Price Guarantee
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-teal-600">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ PER NIGHT (TRANSPARENT TARIFF)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book budget room ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-teal-600 hover:bg-teal-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-shield-halved"></i> Book Sanitized Room
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have an inquiry about ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'hotel_family')
                <!-- ============================================== -->
                <!-- 🌴 THEME: FAMILY SUITES & GARDEN BANQUET       -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-amber-200 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-amber-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-people-roof text-[9px]"></i> Family Suite &bull; Lawn
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-users text-amber-300"></i> Interconnected &bull; 4-6 Guests</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.96 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-amber-50/50 p-4 rounded-2xl border border-amber-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Interconnected Family Rooms
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> 500+ Capacity Green Lawn
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Kids Splash Pool &amp; Play Zone
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Pure Veg &amp; Family Dining
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-amber-600">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ PER NIGHT (FAMILY STAY)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book family suite / lawn ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-people-roof"></i> Reserve Family Suite
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have an inquiry about ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'hotel_resort')
                <!-- ============================================== -->
                <!-- 🏨 THEME 1: GRAND PALACE 2-COLUMN LUXURY SUITES -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-amber-200/70 bg-white shadow-xl hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Panoramic Suite Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-stone-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-amber-500/90 backdrop-blur-md text-stone-950 text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-crown text-[9px]"></i> Royal Heritage Suite
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-bed text-amber-400"></i> Deluxe AC King Suite</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.98 Rating</span>
                                </div>
                            </div>

                            <!-- Suite Details Body -->
                            <div class="p-6 sm:p-7">
                                <div class="flex items-start justify-between gap-2 mb-3">
                                    <h3 class="font-serif font-black text-2xl text-stone-900 leading-tight">
                                        {{ $item->title }}
                                    </h3>
                                </div>

                                <!-- Royal Amenity Checklist (2 Cols) -->
                                <div class="grid grid-cols-2 gap-2 text-xs text-stone-600 mb-6 bg-stone-50 p-4 rounded-2xl border border-stone-200/60">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Posturepedic King Bed
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Private Garden Balcony
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Marble Bath &amp; Tub
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-600 text-xs"></i> Royal Breakfast Included
                                    </div>
                                </div>

                                <!-- Price Display -->
                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-rose-700">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-stone-500">/ night (Taxes included)</span>
                                    @if($item->compare_at_price && $item->compare_at_price > $item->price)
                                    <span class="text-xs text-stone-400 line-through">
                                        ₹{{ number_format($item->compare_at_price, 0) }}
                                    </span>
                                    <span class="text-xs font-black text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">
                                        Save {{ round((($item->compare_at_price - $item->price) / $item->compare_at_price) * 100) }}%
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm availability.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-rose-700 to-amber-700 hover:from-rose-600 hover:to-amber-600 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-bed"></i> Reserve Suite Now
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-xl border border-stone-300 hover:bg-stone-50 text-stone-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'dark_luxury')
                <!-- ============================================== -->
                <!-- 🌙 THEME 3: OBSIDIAN VIP PENTHOUSE SUITES       -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-amber-500/25 bg-[#0D121F] shadow-2xl hover:border-amber-400 transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Image with Dark Gradient & Gold Badge -->
                            <div class="relative aspect-16/10 w-full overflow-hidden bg-zinc-900">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=700&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0D121F] via-transparent to-transparent"></div>
                                <span class="absolute top-3 right-3 bg-amber-500 text-slate-950 text-[10px] font-black uppercase px-2.5 py-1 rounded-full shadow">
                                    <i class="fa-solid fa-crown mr-1"></i> VIP PRIVILEGE
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="font-bold text-lg mb-2 text-white line-clamp-1">
                                    {{ $item->title }}
                                </h3>

                                <!-- VIP Perks -->
                                <div class="flex flex-wrap gap-1.5 mb-4 text-[10px] font-bold text-amber-300">
                                    <span class="px-2.5 py-1 rounded-md bg-zinc-900 border border-zinc-800"><i class="fa-solid fa-hot-tub-person mr-1 text-amber-400"></i> Jacuzzi</span>
                                    <span class="px-2.5 py-1 rounded-md bg-zinc-900 border border-zinc-800"><i class="fa-solid fa-car mr-1 text-amber-400"></i> Chauffeur</span>
                                    <span class="px-2.5 py-1 rounded-md bg-zinc-900 border border-zinc-800"><i class="fa-solid fa-martini-glass mr-1 text-amber-400"></i> Lounge</span>
                                </div>

                                <!-- Price -->
                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-2xl font-black text-amber-400">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-zinc-500">/ NIGHT VIP</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="p-6 pt-0">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to book the VIP ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-black text-xs uppercase tracking-wider shadow-lg shadow-amber-500/20 transition flex items-center justify-center gap-2 cursor-pointer">
                                <i class="fa-solid fa-crown"></i> Reserve VIP Penthouse
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'minimal_card')
                <!-- ============================================== -->
                <!-- 🏛️ THEME 4: SANTORINI MEDITERRANEAN CLIFFSIDE  -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-sky-200/80 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Panoramic Sea View Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-sky-50">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-sky-600/90 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-water text-[9px]"></i> Caldera Cliffside Suite
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-water-ladder text-sky-300"></i> Private Sea Plunge Pool</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.99 Rating</span>
                                </div>
                            </div>

                            <!-- Suite Details Body -->
                            <div class="p-6 sm:p-7">
                                <h3 class="font-serif font-black text-2xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <!-- Mediterranean Checklist -->
                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-sky-50/50 p-4 rounded-2xl border border-sky-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-sky-600 text-xs"></i> Sea-Facing Plunge Pool
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-sky-600 text-xs"></i> Sunset Caldera Veranda
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-sky-600 text-xs"></i> Greek Organic Breakfast
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-sky-600 text-xs"></i> Whitewashed Cave Arch
                                    </div>
                                </div>

                                <!-- Price Display -->
                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-sky-700">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ night (Taxes included)</span>
                                    @if($item->compare_at_price && $item->compare_at_price > $item->price)
                                    <span class="text-xs text-slate-400 line-through">
                                        ₹{{ number_format($item->compare_at_price, 0) }}
                                    </span>
                                    <span class="text-xs font-black text-sky-700 bg-sky-50 px-2 py-0.5 rounded-full border border-sky-200">
                                        Save {{ round((($item->compare_at_price - $item->price) / $item->compare_at_price) * 100) }}%
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm availability.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-water"></i> Reserve Caldera Suite
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-sky-200 hover:bg-sky-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'nature_retreat')
                <!-- ============================================== -->
                <!-- 🌿 THEME 5: WILDERNESS SAFARI LODGE & TREEHOUSE -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-emerald-200/80 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Forest Canopy Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-emerald-50">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1510312305653-8ed496efae75?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-emerald-700/90 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-campground text-[9px]"></i> Luxury Safari Tent &bull; Treehouse
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-tree text-emerald-400"></i> Teak Deck &bull; Forest View</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.97 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-serif font-black text-2xl text-emerald-950 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-emerald-50/50 p-4 rounded-2xl border border-emerald-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-700 text-xs"></i> 4x4 Jeep Safari Included
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-700 text-xs"></i> Teak Treehouse Veranda
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-700 text-xs"></i> Starlit Bush Campfire BBQ
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-700 text-xs"></i> Guided Naturalist Walk
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-emerald-800">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ night (All Meals &amp; Safari)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm safari availability.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-emerald-700 to-green-600 hover:from-emerald-600 hover:to-green-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-compass"></i> Reserve Safari Tent
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-emerald-200 hover:bg-emerald-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'coastal_beach')
                <!-- ============================================== -->
                <!-- 🌊 THEME 6: MALDIVES OVERWATER BUNGALOWS       -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-cyan-200/80 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Overwater Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-cyan-50">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-cyan-600/90 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-water-ladder text-[9px]"></i> Overwater Stilt Bungalow
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-fish text-cyan-300"></i> Direct Reef Ladder</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.98 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-black text-2xl text-slate-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 mb-6 bg-cyan-50/50 p-4 rounded-2xl border border-cyan-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-cyan-600 text-xs"></i> Direct Lagoon Access
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-cyan-600 text-xs"></i> Glass Floor Ocean Panel
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-cyan-600 text-xs"></i> Private Stilt Plunge Pool
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-cyan-600 text-xs"></i> Sunset Catamaran Cruise
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-3xl font-black text-cyan-700">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ night (Taxes included)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the Overwater ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-fish-fins"></i> Book Overwater Villa
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-cyan-200 hover:bg-cyan-50 text-slate-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'heritage_haveli')
                <!-- ============================================== -->
                <!-- 👑 THEME 7: RAJASTHAN ROYAL MAHARAJA SUITES    -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-amber-200/90 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Haveli Courtyard Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-amber-50">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1599661046289-e31897846e41?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-amber-600/90 backdrop-blur-md text-stone-950 text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-chess-rook text-[9px]"></i> Royal Rajputana Suite
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-crown text-amber-300"></i> Jharokha Balcony View</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.99 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-serif font-black text-2xl text-stone-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-stone-600 mb-6 bg-amber-50/50 p-4 rounded-2xl border border-amber-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-700 text-xs"></i> Dhol &amp; Tilak Welcome
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-700 text-xs"></i> 36-Delicacy Royal Thali
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-700 text-xs"></i> Carved Jharokha Window
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-amber-700 text-xs"></i> Antique Brass Poster Bed
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-amber-800">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-stone-500">/ night (Royal Thali included)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to reserve the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm availability.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-amber-600 via-rose-700 to-amber-700 hover:from-amber-500 hover:to-rose-600 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-chess-rook"></i> Reserve Royal Suite
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-amber-200 hover:bg-amber-50 text-stone-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'mountain_chalet')
                <!-- ============================================== -->
                <!-- 🏔️ THEME 8: HIMALAYAN PINE ALPINE CHALETS      -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-orange-200/80 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Alpine Snow Mountain Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-stone-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1502784444187-359ac186c5bb?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-orange-600/90 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-mountain text-[9px]"></i> Alpine Cedar Chalet
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-fire text-amber-400"></i> In-Suite Stone Fireplace</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.96 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-serif font-black text-2xl text-stone-900 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-stone-600 mb-6 bg-orange-50/50 p-4 rounded-2xl border border-orange-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-orange-600 text-xs"></i> Stone Fireplace Hearth
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-orange-600 text-xs"></i> Heated Hydro Jacuzzi
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-orange-600 text-xs"></i> Snow Peak Mountain Balcony
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-orange-600 text-xs"></i> Deodar Wood Paneling
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-orange-800">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-stone-500">/ night (Breakfast &amp; Hearth Wood)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book the Alpine ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-orange-600 to-amber-700 hover:from-orange-500 hover:to-amber-600 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-fire"></i> Book Alpine Chalet
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-orange-200 hover:bg-orange-50 text-stone-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif($currentTheme === 'wellness_sanctuary')
                <!-- ============================================== -->
                <!-- 🧘 THEME 9: AYURVEDA, YOGA & WELLNESS COTTAGE   -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-teal-200/80 bg-white shadow-lg hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Zen Garden Photo -->
                            <div class="relative aspect-16/9 w-full overflow-hidden bg-teal-50">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=800&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-stone-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-teal-700/90 backdrop-blur-md text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow flex items-center gap-1.5">
                                    <i class="fa-solid fa-spa text-[9px]"></i> Ayurvedic Healing Cottage
                                </span>
                                <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white text-xs">
                                    <span class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-heart-pulse text-teal-300"></i> Pulse Diagnosis Included</span>
                                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[11px] font-bold"><i class="fa-solid fa-star text-amber-400"></i> 4.99 Rating</span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7">
                                <h3 class="font-serif font-black text-2xl text-teal-950 leading-tight mb-3">
                                    {{ $item->title }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-xs text-stone-600 mb-6 bg-teal-50/50 p-4 rounded-2xl border border-teal-100">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-700 text-xs"></i> Doctor Nadi Diagnosis
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-700 text-xs"></i> Daily Sunrise Yoga &amp; Pranayama
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-700 text-xs"></i> Organic Sattvic Farm Meals
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-teal-700 text-xs"></i> Private Herbal Spa Deck
                                    </div>
                                </div>

                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="font-serif text-3xl font-black text-teal-800">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-stone-500">/ night (All Treatments &amp; Meals)</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 pt-0 flex flex-col sm:flex-row items-center gap-3">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book the ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night). Please confirm healing retreat dates.') }}" target="_blank" class="flex-1 w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-teal-700 to-emerald-600 hover:from-teal-600 hover:to-emerald-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                <i class="fa-solid fa-spa"></i> Book Healing Retreat
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hello, I have a question regarding ' . $item->title . '.') }}" target="_blank" class="w-full sm:w-auto p-3.5 rounded-2xl border border-teal-200 hover:bg-teal-50 text-stone-700 text-xs font-bold flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @else
                <!-- ============================================== -->
                <!-- 🏡 THEME 2: MODERN AIRBNB BOUTIQUE CARDS        -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                    <div class="rounded-3xl overflow-hidden border border-slate-200/90 bg-white shadow-sm hover:shadow-xl transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Modern Rounded Photo -->
                            <div class="relative aspect-4/3 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600&auto=format&fit=crop&q=75' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-md text-slate-900 text-[10px] font-black uppercase px-2.5 py-1 rounded-full shadow flex items-center gap-1">
                                    <i class="fa-solid fa-star text-amber-500 text-[9px]"></i> 4.96 (42)
                                </span>
                                <span class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/90 backdrop-blur-md text-rose-500 flex items-center justify-center shadow text-xs">
                                    <i class="fa-solid fa-heart"></i>
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <h3 class="font-bold text-lg mb-1.5 text-slate-900 line-clamp-1">
                                    {{ $item->title }}
                                </h3>

                                <div class="flex flex-wrap gap-1.5 mb-3 text-[10px] font-bold text-slate-600">
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100">King Bed</span>
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100">Pool View</span>
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100">Free Wi-Fi</span>
                                </div>

                                <div class="flex items-baseline gap-1.5">
                                    <span class="text-2xl font-black text-slate-900">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs text-slate-500 font-semibold">night &bull; Total includes taxes</span>
                                </div>
                            </div>
                        </div>

                        <!-- CTA -->
                        <div class="p-5 pt-0">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to book ' . $item->title . ' (₹' . number_format($item->price, 0) . '/night).') }}" target="_blank" class="w-full py-3 px-4 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow transition flex items-center justify-center gap-2">
                                <i class="fa-solid fa-calendar-check"></i> Reserve Room
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            @elseif(str_starts_with($currentTheme, 'coaching_web_'))
                <!-- 🎓 COACHING & INSTITUTES: 6 THEME-TAILORED COURSE & BATCH CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                    @php
                        $coachingCardTheme = match($currentTheme) {
                            'coaching_web_upsc_ias' => [
                                'card_bg' => 'bg-slate-900 border-slate-800 text-white',
                                'badge' => '🏛️ UPSC Mentorship Batch',
                                'badge_bg' => 'bg-amber-500/20 text-amber-300 border-amber-500/30',
                                'pill1' => 'Daily Mains Answer Review',
                                'pill2' => '1-on-1 Bureaucrat Mentorship',
                                'pill3' => 'Current Affairs Compendium',
                                'btn_bg' => 'bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-black',
                                'btn_icon' => 'fa-landmark',
                                'btn_text' => 'Enroll in UPSC Batch',
                            ],
                            'coaching_web_commerce_ca' => [
                                'card_bg' => 'bg-white border-emerald-200 text-slate-900 shadow-md',
                                'badge' => '📊 CA / CS Exam Drill',
                                'badge_bg' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                'pill1' => 'ICAI Mock Test Corrections',
                                'pill2' => 'Big 4 Articleship Matching',
                                'pill3' => 'Fast-Track Revision Pass',
                                'btn_bg' => 'bg-emerald-700 hover:bg-emerald-600 text-white font-extrabold shadow-md',
                                'btn_icon' => 'fa-calculator',
                                'btn_text' => 'Register for CA Batch',
                            ],
                            'coaching_web_ielts_abroad' => [
                                'card_bg' => 'bg-white border-sky-200 text-slate-900 shadow-md',
                                'badge' => '✈️ Band 8+ Masterclass',
                                'badge_bg' => 'bg-sky-100 text-sky-800 border-sky-200',
                                'pill1' => 'British Council Certified',
                                'pill2' => '10 Live Speaking Mocks',
                                'pill3' => 'University Filing Included',
                                'btn_bg' => 'bg-sky-600 hover:bg-sky-500 text-white font-extrabold shadow-md',
                                'btn_icon' => 'fa-plane-departure',
                                'btn_text' => 'Book Free Diagnostic Test',
                            ],
                            'coaching_web_coding_tech' => [
                                'card_bg' => 'bg-[#0D121F] border-slate-800 text-slate-100 shadow-xl',
                                'badge' => '💻 Full-Stack & GenAI Bootcamp',
                                'badge_bg' => 'bg-purple-500/20 text-emerald-400 border-emerald-500/30 font-mono',
                                'pill1' => '10+ Live GitHub Capstones',
                                'pill2' => '1-on-1 FAANG Code Reviews',
                                'pill3' => 'Hiring Partner Placement Cell',
                                'btn_bg' => 'bg-gradient-to-r from-purple-600 to-emerald-600 hover:opacity-90 text-white font-mono font-bold shadow-lg',
                                'btn_icon' => 'fa-terminal',
                                'btn_text' => 'Apply for Bootcamp Cohort',
                            ],
                            'coaching_web_school_tuition' => [
                                'card_bg' => 'bg-white border-amber-200 text-slate-900 shadow-md',
                                'badge' => '📚 Max 15 Students Batch',
                                'badge_bg' => 'bg-amber-100 text-amber-900 border-amber-200',
                                'pill1' => 'Syllabus Finished 90 Days Early',
                                'pill2' => 'Weekly Sunday Test & Report',
                                'pill3' => 'Olympiad & NTSE Guidance',
                                'btn_bg' => 'bg-amber-600 hover:bg-amber-500 text-white font-extrabold shadow-md',
                                'btn_icon' => 'fa-book-open',
                                'btn_text' => 'Book 1-Week Trial Class',
                            ],
                            default => [
                                'card_bg' => 'bg-white border-blue-200 text-slate-900 shadow-md',
                                'badge' => '🎯 Kota Entrance Batch',
                                'badge_bg' => 'bg-blue-100 text-blue-800 border-blue-200',
                                'pill1' => 'Daily Practice Papers (150 Qs)',
                                'pill2' => '8 AM - 8 PM Doubt Desk',
                                'pill3' => 'All-India CBT Benchmarking',
                                'btn_bg' => 'bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-500 hover:to-indigo-600 text-white font-extrabold shadow-md',
                                'btn_icon' => 'fa-graduation-cap',
                                'btn_text' => 'Enroll in Kota Batch',
                            ],
                        };
                    @endphp

                    <div class="rounded-3xl overflow-hidden border transition-all duration-300 flex flex-col justify-between group hover:shadow-2xl {{ $coachingCardTheme['card_bg'] }}">
                        <div>
                            <!-- Course Thumbnail -->
                            <div class="relative aspect-16/10 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=700&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-3 left-3 text-[10px] font-black uppercase px-2.5 py-1 rounded-md shadow border backdrop-blur-md {{ $coachingCardTheme['badge_bg'] }}">
                                    {{ $coachingCardTheme['badge'] }}
                                </span>
                                <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-white text-[11px] font-bold">
                                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-users text-blue-300"></i> New Batch Starting Monday</span>
                                    <span class="bg-black/60 px-2 py-0.5 rounded-full"><i class="fa-solid fa-star text-amber-400"></i> 4.9 Rating</span>
                                </div>
                            </div>

                            <!-- Course Body -->
                            <div class="p-6">
                                <h3 class="font-black text-lg mb-2 line-clamp-1 {{ $currentTheme === 'coaching_web_coding_tech' || $currentTheme === 'coaching_web_upsc_ias' ? 'text-white' : 'text-slate-900' }}">
                                    {{ $item->title }}
                                </h3>

                                <div class="space-y-1.5 mb-4 text-xs font-semibold {{ $currentTheme === 'coaching_web_coding_tech' || $currentTheme === 'coaching_web_upsc_ias' ? 'text-slate-300' : 'text-slate-600' }}">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-500 text-xs"></i> {{ $coachingCardTheme['pill1'] }}
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-500 text-xs"></i> {{ $coachingCardTheme['pill2'] }}
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-emerald-500 text-xs"></i> {{ $coachingCardTheme['pill3'] }}
                                    </div>
                                </div>

                                <!-- Fee / Tuition Price -->
                                <div class="flex items-baseline gap-2 mb-2">
                                    <span class="text-2xl font-black {{ $currentTheme === 'coaching_web_coding_tech' ? 'text-emerald-400' : ($currentTheme === 'coaching_web_upsc_ias' ? 'text-amber-400' : 'text-slate-900') }}">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">/ Complete Batch Course</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action CTA -->
                        <div class="p-6 pt-0 flex flex-col gap-2">
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to enroll in course batch: ' . $item->title . ' (₹' . number_format($item->price, 0) . '). Please share batch timings.') }}" target="_blank" class="w-full py-3.5 px-4 rounded-xl text-xs uppercase tracking-wider transition flex items-center justify-center gap-2 cursor-pointer {{ $coachingCardTheme['btn_bg'] }}">
                                <i class="fa-solid {{ $coachingCardTheme['btn_icon'] }}"></i> {{ $coachingCardTheme['btn_text'] }}
                            </a>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi, please send me the complete syllabus PDF and schedule for ' . $item->title . '.') }}" target="_blank" class="w-full py-2 rounded-xl text-center text-[11px] font-bold border transition {{ $currentTheme === 'coaching_web_coding_tech' || $currentTheme === 'coaching_web_upsc_ias' ? 'border-slate-700 text-slate-300 hover:bg-slate-800' : 'border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                                <i class="fa-solid fa-file-arrow-down mr-1"></i> Download Syllabus PDF
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

            @elseif(str_starts_with($currentTheme, 'coaching_ecom_'))
                <!-- 🛍️ COACHING & INSTITUTES: 6 THEME-TAILORED E-COMMERCE PRODUCT & PACKAGE CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                    @php
                        $ecomCardTheme = match($currentTheme) {
                            'coaching_ecom_test_series' => [
                                'card_bg' => 'bg-[#0B1528] border-blue-900/80 text-white shadow-xl',
                                'badge' => '📝 NTA CBT Mock Test Pass',
                                'badge_bg' => 'bg-blue-600/30 text-blue-300 border-blue-500/40',
                                'pill1' => 'Real NTA CBT Simulator Interface',
                                'pill2' => 'Instant All-India Percentile Rank',
                                'pill3' => 'Step-by-Step Video Explanations',
                                'btn_bg' => 'bg-blue-600 hover:bg-blue-500 text-white',
                                'btn_text' => 'Add Test Pass to Cart',
                                'price_color' => 'text-blue-400',
                            ],
                            'coaching_ecom_study_notes' => [
                                'card_bg' => 'bg-[#FFFDF9] border-amber-200 text-stone-900 shadow-md',
                                'badge' => '📖 Kota Handwritten Spiral Book',
                                'badge_bg' => 'bg-emerald-100 text-emerald-900 border-emerald-300',
                                'pill1' => 'AIR 1-50 Ranker Classroom Notes',
                                'pill2' => 'Color Concept Mindmaps & Formulas',
                                'pill3' => '100 GSM Smudge-Proof Spiral Binding',
                                'btn_bg' => 'bg-emerald-700 hover:bg-emerald-600 text-white',
                                'btn_text' => 'Order Spiral Hardcopy',
                                'price_color' => 'text-emerald-800',
                            ],
                            'coaching_ecom_recorded_lectures' => [
                                'card_bg' => 'bg-[#0D121F] border-violet-900/80 text-white shadow-xl',
                                'badge' => '🎥 4K Video Course + Pen-Drive Kit',
                                'badge_bg' => 'bg-violet-600/30 text-violet-300 border-violet-500/40',
                                'pill1' => 'Encrypted Offline Pen-Drive Included',
                                'pill2' => '24-Month Unlimited Video Views',
                                'pill3' => '1-on-1 WhatsApp Faculty Doubt Desk',
                                'btn_bg' => 'bg-gradient-to-r from-violet-600 to-indigo-600 hover:opacity-90 text-white',
                                'btn_text' => 'Order Pen-Drive Kit',
                                'price_color' => 'text-violet-400',
                            ],
                            'coaching_ecom_pyq_question_banks' => [
                                'card_bg' => 'bg-white border-slate-300 text-slate-900 shadow-md',
                                'badge' => '📚 25-Yr Solved PYQ Hardbound',
                                'badge_bg' => 'bg-amber-100 text-amber-900 border-amber-300',
                                'pill1' => '7,500+ Categorized Chapter MCQs',
                                'pill2' => 'Error-Free Verified Answer Keys',
                                'pill3' => 'Speed & Accuracy Shortcut Tricks',
                                'btn_bg' => 'bg-slate-900 hover:bg-slate-800 text-white',
                                'btn_text' => 'Order 25-Yr PYQ Book',
                                'price_color' => 'text-amber-600',
                            ],
                            'coaching_ecom_language_kits' => [
                                'card_bg' => 'bg-white border-cyan-200 text-slate-900 shadow-md',
                                'badge' => '🗣️ CEFR Foreign Language Box Kit',
                                'badge_bg' => 'bg-cyan-100 text-cyan-900 border-cyan-300',
                                'pill1' => '500 Waterproof Vocabulary Flashcards',
                                'pill2' => 'Native Pronunciation Audio USB',
                                'pill3' => 'Situational Grammar & Dialogue Book',
                                'btn_bg' => 'bg-cyan-600 hover:bg-cyan-500 text-white',
                                'btn_text' => 'Add Language Box to Cart',
                                'price_color' => 'text-cyan-700',
                            ],
                            default => [
                                'card_bg' => 'bg-white border-slate-300 text-slate-900 shadow-md',
                                'badge' => '📐 NTA/Board Approved Exam Gear',
                                'badge_bg' => 'bg-amber-100 text-amber-900 border-amber-300',
                                'pill1' => '100% Genuine Casio Brand Warranty',
                                'pill2' => '500-Pack 100 GSM OMR Sheets',
                                'pill3' => 'Shatterproof Engineering Tools',
                                'btn_bg' => 'bg-amber-600 hover:bg-amber-500 text-white',
                                'btn_text' => 'Add Exam Kit to Cart',
                                'price_color' => 'text-amber-600',
                            ],
                        };
                    @endphp

                    <div class="rounded-3xl overflow-hidden border transition-all duration-300 flex flex-col justify-between group hover:shadow-2xl {{ $ecomCardTheme['card_bg'] }}">
                        <div>
                            <!-- Product Image -->
                            <div class="relative aspect-16/10 w-full overflow-hidden bg-slate-100">
                                <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=700&auto=format&fit=crop&q=80' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                                <span class="absolute top-3 left-3 text-[10px] font-black uppercase px-2.5 py-1 rounded-md shadow border backdrop-blur-md {{ $ecomCardTheme['badge_bg'] }}">
                                    {{ $ecomCardTheme['badge'] }}
                                </span>
                                <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-white text-[11px] font-bold">
                                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-truck-fast text-emerald-400"></i> Free Courier Dispatch</span>
                                    <span class="bg-black/60 px-2 py-0.5 rounded-full"><i class="fa-solid fa-star text-amber-400"></i> 4.9★</span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-6">
                                <div class="flex items-center gap-1.5 mb-2 flex-wrap">
                                    @if(!empty($item->attributes['brand']))
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-500/20 text-blue-300 border border-blue-400/30">
                                            <i class="fa-solid fa-tag text-[9px]"></i> {{ $item->attributes['brand'] }}
                                        </span>
                                    @endif
                                    @if(!empty($item->attributes['badge']))
                                        <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded bg-amber-400 text-slate-950">
                                            {{ $item->attributes['badge'] }}
                                        </span>
                                    @endif
                                    @if($item->category_name)
                                        <span class="text-[10px] font-medium text-slate-400">
                                            &bull; {{ $item->category_name }}
                                        </span>
                                    @endif
                                </div>

                                <h3 class="font-black text-lg mb-2 line-clamp-1 {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'text-white' : 'text-slate-900' }}">
                                    {{ $item->title }}
                                </h3>

                                <div class="space-y-1.5 mb-4 text-xs font-semibold {{ in_array($currentTheme, ['coaching_ecom_test_series', 'coaching_ecom_recorded_lectures']) ? 'text-slate-300' : 'text-slate-600' }}">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-circle-check text-emerald-500 text-xs"></i> {{ $ecomCardTheme['pill1'] }}
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-circle-check text-emerald-500 text-xs"></i> {{ $ecomCardTheme['pill2'] }}
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-circle-check text-emerald-500 text-xs"></i> {{ $ecomCardTheme['pill3'] }}
                                    </div>
                                </div>

                                <!-- Price Display with MRP & Discount Tag -->
                                <div class="flex items-baseline gap-2 mb-1 flex-wrap">
                                    <span class="text-2xl font-black {{ $ecomCardTheme['price_color'] }}">
                                        ₹{{ number_format($item->price, 0) }}
                                    </span>
                                    @if($item->compare_at_price && $item->compare_at_price > $item->price)
                                        <span class="line-through text-xs font-bold text-slate-400">
                                            ₹{{ number_format($item->compare_at_price, 0) }}
                                        </span>
                                        @php
                                            $pct = round((($item->compare_at_price - $item->price) / $item->compare_at_price) * 100);
                                        @endphp
                                        <span class="text-[10px] font-black px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                            Save {{ $pct }}% OFF
                                        </span>
                                    @endif
                                </div>

                                <!-- Stock Status Indicator -->
                                <div class="text-[11px] font-bold mb-2">
                                    @if($item->in_stock)
                                        <span class="text-emerald-400 flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            <span>In Stock ({{ $item->stock_quantity ?? 25 }} Kits Available)</span>
                                        </span>
                                    @else
                                        <span class="text-rose-400 flex items-center gap-1">
                                            <i class="fa-solid fa-circle-xmark"></i> Out of Stock
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Add to Cart & WhatsApp CTAs -->
                        <div class="p-6 pt-0 flex items-center gap-2">
                            <button wire:click="addToCart({{ $item->id }})" class="flex-1 py-3 px-3 rounded-xl font-bold text-xs transition flex items-center justify-center gap-1.5 cursor-pointer hover:scale-[1.01] shadow {{ $ecomCardTheme['btn_bg'] }}">
                                <i class="fa-solid fa-cart-plus"></i> {{ $ecomCardTheme['btn_text'] }}
                            </button>
                            <a href="{{ $tenant->getWhatsAppUrl('Hi, I want to order: ' . $item->title . ' (₹' . number_format($item->price, 0) . ')') }}" target="_blank" class="p-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold flex items-center justify-center shadow">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
            <!-- 🛒 GENERAL CATALOG FOR SERVICE / B2B / RETAIL -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($items as $item)
                <div class="rounded-3xl overflow-hidden border transition-all duration-300 flex flex-col justify-between group hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800 hover:border-zinc-700' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-300 hover:shadow-xl' : 'bg-white border-slate-200/80 shadow-md hover:shadow-xl') }}">
                    
                    <div>
                        <!-- Image Container -->
                        <div class="relative aspect-16/10 w-full overflow-hidden bg-slate-100">
                            <img src="{{ $item->image_url ?: ($archetype->code === 'service' ? 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=600&auto=format&fit=crop&q=75' : 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=600&auto=format&fit=crop&q=75') }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            @if($item->category_name)
                            <span class="absolute top-3 left-3 bg-black/75 backdrop-blur-md text-white text-[10px] font-black uppercase px-2.5 py-1 rounded-md shadow">
                                {{ $item->category_name }}
                            </span>
                            @endif

                            @if($archetype->code === 'service' && $item->duration_minutes)
                            <span class="absolute bottom-3 right-3 bg-sky-600 text-white text-[11px] font-bold px-2.5 py-1 rounded-lg shadow flex items-center gap-1">
                                <i class="fa-regular fa-clock"></i> {{ $item->duration_minutes }} Mins
                            </span>
                            @endif

                            @if($archetype->code === 'b2b' && $item->min_order_qty)
                            <span class="absolute bottom-3 right-3 bg-amber-600 text-white text-[11px] font-bold px-2.5 py-1 rounded-lg shadow flex items-center gap-1">
                                <i class="fa-solid fa-boxes-stacked"></i> MOQ: {{ $item->min_order_qty }} Units
                            </span>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <h3 class="font-bold text-lg mb-2 line-clamp-1 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                                {{ $item->title }}
                            </h3>

                            @if(!empty($item->attributes['brand']) || !empty($item->attributes['badge']))
                            <div class="flex items-center gap-1.5 mb-2.5 flex-wrap">
                                @if(!empty($item->attributes['brand']))
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 border border-purple-200">
                                    <i class="fa-solid fa-tag text-[9px]"></i> {{ $item->attributes['brand'] }}
                                </span>
                                @endif
                                @if(!empty($item->attributes['badge']))
                                <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded-md bg-amber-400 text-slate-900">
                                    {{ $item->attributes['badge'] }}
                                </span>
                                @endif
                            </div>
                            @endif

                            <!-- Price Display -->
                            <div class="flex items-baseline gap-2 mb-2">
                                <span class="text-2xl font-black {{ $currentTheme === 'dark_luxury' ? 'text-emerald-400' : 'text-slate-900' }}">
                                    ₹{{ number_format($item->price, 0) }}
                                </span>
                                @if($item->compare_at_price && $item->compare_at_price > $item->price)
                                <span class="text-xs text-slate-400 line-through">
                                    ₹{{ number_format($item->compare_at_price, 0) }}
                                </span>
                                <span class="text-xs font-black text-rose-500 bg-rose-50 px-2 py-0.5 rounded">
                                    {{ round((($item->compare_at_price - $item->price) / $item->compare_at_price) * 100) }}% OFF
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Action CTA Button -->
                    <div class="p-6 pt-0">
                        @if($this->isEcommerce)
                            <div class="flex items-center gap-2">
                                <button wire:click="addToCart({{ $item->id }})" class="flex-1 py-3 px-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition flex items-center justify-center gap-1.5 cursor-pointer hover:scale-[1.01]">
                                    <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                </button>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi, I want to buy: ' . $item->title . ' (₹' . $item->price . ')') }}" target="_blank" class="p-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold flex items-center justify-center shadow">
                                    <i class="fa-brands fa-whatsapp text-lg"></i>
                                </a>
                            </div>
                        @elseif($this->isLandingPage)
                            <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to claim the limited offer for: ' . $item->title . ' (₹' . $item->price . ').') }}" target="_blank" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-purple-600 to-rose-600 hover:from-purple-500 hover:to-rose-500 text-white font-extrabold text-xs shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.02]">
                                <i class="fa-solid fa-gift"></i> Claim Limited Offer
                            </a>
                        @else
                            {{-- Business Website Mode --}}
                            @if($archetype->code === 'service' || $item->type === 'service')
                                <button wire:click="openBookingModal({{ $item->id }})" class="w-full py-3 px-4 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                    <i class="fa-regular fa-calendar-check"></i> Book Appointment Slot
                                </button>
                            @elseif($archetype->code === 'b2b')
                                <button wire:click="openQuoteModal({{ $item->id }})" class="w-full py-3 px-4 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2 cursor-pointer hover:scale-[1.01]">
                                    <i class="fa-solid fa-file-invoice-dollar"></i> Request Bulk Quote
                                </button>
                            @else
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I would like to inquire about: ' . $item->title) }}" target="_blank" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2 cursor-pointer">
                                    <i class="fa-brands fa-whatsapp text-emerald-400"></i> Inquire via WhatsApp
                                </a>
                            @endif
                        @endif
                    </div>

                </div>
                @endforeach
            </div>
            @endif
            @endif

        </div>
    </section>
    @endif

    <!-- 📖 ABOUT OUR BUSINESS / CLINIC / STORE SECTION -->
    <section id="about" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900/40 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-white border-neutral-200' : 'bg-white border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-6 space-y-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-purple-600">
                        @if($archetype->code === 'hospitality')
                            About Our Hotel & Hospitality
                        @elseif($archetype->code === 'service')
                            About Our Healthcare Practice
                        @elseif($archetype->code === 'b2b')
                            About Our Manufacturing Plant
                        @else
                            About Our Business
                        @endif
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                        @if($archetype->code === 'hospitality')
                            Unmatched Comfort, Luxury & Hospitality in {{ $tenant->city }}
                        @else
                            Committed To Raising The Bar In {{ $tenant->city }}
                        @endif
                    </h2>
                    
                    <p class="text-sm sm:text-base leading-relaxed {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">
                        @if($archetype->code === 'hospitality')
                            At <strong>{{ $tenant->business_name }}</strong>, our mission is to deliver exceptional stay experiences in {{ $tenant->city }}. Whether traveling for business, vacationing with family, or seeking a quiet retreat, we provide spotless sanitized rooms, 24/7 room service, and heartfelt hospitality.
                        @else
                            At <strong>{{ $tenant->business_name }}</strong>, our mission is to provide personalized, transparent, and superior quality solutions to the community of {{ $tenant->city }}. Whether you are scheduling a specialist consultation or ordering essential goods, we guarantee integrity, prompt customer service, and reliable follow-through.
                        @endif
                    </p>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
                        <div class="p-4 rounded-2xl border text-center {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800/60 border-zinc-700' : 'bg-slate-50 border-slate-200' }}">
                            <div class="text-2xl font-black text-purple-600 mb-0.5">15+</div>
                            <div class="text-[11px] font-semibold text-slate-500">Years Trust</div>
                        </div>
                        <div class="p-4 rounded-2xl border text-center {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800/60 border-zinc-700' : 'bg-slate-50 border-slate-200' }}">
                            <div class="text-2xl font-black text-rose-500 mb-0.5">1.5K+</div>
                            <div class="text-[11px] font-semibold text-slate-500">Satisfied Clients</div>
                        </div>
                        <div class="p-4 rounded-2xl border text-center {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800/60 border-zinc-700' : 'bg-slate-50 border-slate-200' }}">
                            <div class="text-2xl font-black text-emerald-500 mb-0.5">100%</div>
                            <div class="text-[11px] font-semibold text-slate-500">Genuine Care</div>
                        </div>
                        <div class="p-4 rounded-2xl border text-center {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800/60 border-zinc-700' : 'bg-slate-50 border-slate-200' }}">
                            <div class="text-2xl font-black text-amber-500 mb-0.5">4.9★</div>
                            <div class="text-[11px] font-semibold text-slate-500">Local Rating</div>
                        </div>
                    </div>

                    <div class="pt-2 flex items-center gap-4">
                        <a href="#contact" class="px-6 py-3 rounded-xl border font-bold text-xs transition {{ $currentTheme === 'dark_luxury' ? 'border-zinc-700 hover:bg-zinc-800 text-white' : 'border-slate-300 hover:bg-slate-100 text-slate-800' }}">
                            Contact Management
                        </a>
                        <a href="tel:{{ $tenant->phone }}" class="text-xs font-bold text-purple-600 hover:underline flex items-center gap-1.5">
                            <i class="fa-solid fa-phone"></i> {{ $tenant->phone }}
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <div class="rounded-2xl overflow-hidden aspect-square shadow-lg">
                                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=500&auto=format&fit=crop&q=80" alt="Hospitality" class="w-full h-full object-cover">
                            </div>
                            <div class="p-5 rounded-2xl border {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800 border-zinc-700' : 'bg-purple-50/60 border-purple-100' }}">
                                <i class="fa-solid fa-award text-2xl text-purple-600 mb-2"></i>
                                <h4 class="font-bold text-sm mb-1">Standardized Facility</h4>
                                <p class="text-[11px] text-slate-500">Clean, fully compliant environment adhering to hygiene protocols.</p>
                            </div>
                        </div>
                        <div class="space-y-4 pt-6">
                            <div class="p-5 rounded-2xl border {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-800 border-zinc-700' : 'bg-emerald-50/60 border-emerald-100' }}">
                                <i class="fa-solid fa-comments text-2xl text-emerald-600 mb-2"></i>
                                <h4 class="font-bold text-sm mb-1">WhatsApp Direct</h4>
                                <p class="text-[11px] text-slate-500">Real-time status updates and order tracking sent to your mobile.</p>
                            </div>
                            <div class="rounded-2xl overflow-hidden aspect-square shadow-lg">
                                <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=500&auto=format&fit=crop&q=80" alt="Consultation" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 🕒 WORKING HOURS & TIMINGS SECTION -->
    <section id="timings" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-950 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-neutral-50 border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <div class="lg:col-span-5 space-y-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-purple-600">Hours & Availability</span>
                    <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                        Visiting Hours & Clinic Schedule
                    </h3>
                    <p class="text-xs sm:text-sm {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">
                        We are open 6 days a week to serve patients and customers across {{ $tenant->city }}. Emergency inquiries can be routed via WhatsApp 24/7.
                    </p>
                    
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-600 text-xs font-bold border border-emerald-500/20">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                        Open Today Until 8:30 PM
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="rounded-3xl p-6 sm:p-8 border shadow-xl {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-slate-200' }}">
                        <div class="divide-y {{ $currentTheme === 'dark_luxury' ? 'divide-zinc-800' : 'divide-slate-100' }}">
                            
                            <div class="py-3 flex items-center justify-between text-xs sm:text-sm font-semibold">
                                <span class="flex items-center gap-2">
                                    <i class="fa-regular fa-calendar text-purple-600"></i> Monday – Friday
                                </span>
                                <span class="font-bold text-emerald-600">09:00 AM – 08:30 PM (Regular)</span>
                            </div>

                            <div class="py-3 flex items-center justify-between text-xs sm:text-sm font-semibold">
                                <span class="flex items-center gap-2">
                                    <i class="fa-regular fa-calendar text-purple-600"></i> Saturday
                                </span>
                                <span class="font-bold text-emerald-600">09:00 AM – 09:00 PM (Full Day)</span>
                            </div>

                            <div class="py-3 flex items-center justify-between text-xs sm:text-sm font-semibold">
                                <span class="flex items-center gap-2">
                                    <i class="fa-regular fa-calendar text-rose-500"></i> Sunday
                                </span>
                                <span class="font-bold text-amber-600">10:00 AM – 02:00 PM (Half Day / Priority Slots)</span>
                            </div>

                            <div class="py-3 flex items-center justify-between text-xs sm:text-sm font-semibold">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-phone-volume text-sky-500"></i> WhatsApp Helpdesk
                                </span>
                                <span class="font-bold text-sky-600">Available 24/7 for Inquiries</span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    @if($this->isSectionVisible('reviews'))
    <!-- 🌟 VERIFIED REVIEWS & TESTIMONIALS -->
    <section id="reviews" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-[#090D16] border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-[#F5F5F3] border-neutral-300' : ($currentTheme === 'hotel_resort' ? 'bg-[#FDFBF7] border-amber-900/10' : 'bg-white border-slate-200/80')) }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest {{ $currentTheme === 'hotel_resort' ? 'text-amber-700' : ($currentTheme === 'dark_luxury' ? 'text-amber-400' : 'text-purple-600') }}">
                    {{ $archetype->code === 'hospitality' ? 'Guest Experiences & Verified Stays' : 'Patient & Customer Feedback' }}
                </span>
                <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : ($currentTheme === 'hotel_resort' ? 'font-serif text-stone-900' : 'text-slate-900') }}">
                    {{ $archetype->code === 'hospitality' ? 'Loved by Travelers & Guests in ' . $tenant->city : 'What People in ' . $tenant->city . ' Say About Us' }}
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                @if($archetype->code === 'hospitality')
                <!-- Review 1: Hospitality -->
                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-[#0D121F] border-amber-500/20' : ($currentTheme === 'hotel_resort' ? 'bg-white border-amber-200/60' : ($currentTheme === 'nature_retreat' ? 'bg-white border-emerald-200/70' : ($currentTheme === 'coastal_beach' ? 'bg-white border-cyan-200/70' : ($currentTheme === 'heritage_haveli' ? 'bg-white border-amber-200/80' : ($currentTheme === 'mountain_chalet' ? 'bg-white border-orange-200/70' : ($currentTheme === 'wellness_sanctuary' ? 'bg-white border-teal-200/70' : ($currentTheme === 'minimal_card' ? 'bg-white border-sky-200/70' : 'bg-slate-50 border-slate-200/80'))))))) }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : (in_array($currentTheme, ['hotel_resort', 'minimal_card', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'font-serif text-stone-700' : 'text-slate-700') }}">
                        "Our stay at {{ $tenant->business_name }} was incredible. The suite was spotless, bed was exceptionally comfortable, and concierge care arrived promptly. Highly recommended in {{ $tenant->city }}!"
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-rose-600 text-white font-black text-xs flex items-center justify-center">
                            A
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Ananya Deshmukh</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Guest Stay, {{ $tenant->city }}</span>
                        </div>
                    </div>
                </div>

                <!-- Review 2: Hospitality -->
                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-[#0D121F] border-amber-500/20' : ($currentTheme === 'hotel_resort' ? 'bg-white border-amber-200/60' : ($currentTheme === 'nature_retreat' ? 'bg-white border-emerald-200/70' : ($currentTheme === 'coastal_beach' ? 'bg-white border-cyan-200/70' : ($currentTheme === 'heritage_haveli' ? 'bg-white border-amber-200/80' : ($currentTheme === 'mountain_chalet' ? 'bg-white border-orange-200/70' : ($currentTheme === 'wellness_sanctuary' ? 'bg-white border-teal-200/70' : ($currentTheme === 'minimal_card' ? 'bg-white border-sky-200/70' : 'bg-slate-50 border-slate-200/80'))))))) }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : (in_array($currentTheme, ['hotel_resort', 'minimal_card', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'font-serif text-stone-700' : 'text-slate-700') }}">
                        "Effortless check-in and serene ambiance. Booking via WhatsApp was instant. The staff is polite, courteous, and went above and beyond for our holiday stay."
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-amber-600 text-white font-black text-xs flex items-center justify-center">
                            R
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Rajesh Kulkarni</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Suite Reservation</span>
                        </div>
                    </div>
                </div>

                <!-- Review 3: Hospitality -->
                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-[#0D121F] border-amber-500/20' : ($currentTheme === 'hotel_resort' ? 'bg-white border-amber-200/60' : ($currentTheme === 'nature_retreat' ? 'bg-white border-emerald-200/70' : ($currentTheme === 'coastal_beach' ? 'bg-white border-cyan-200/70' : ($currentTheme === 'heritage_haveli' ? 'bg-white border-amber-200/80' : ($currentTheme === 'mountain_chalet' ? 'bg-white border-orange-200/70' : ($currentTheme === 'wellness_sanctuary' ? 'bg-white border-teal-200/70' : ($currentTheme === 'minimal_card' ? 'bg-white border-sky-200/70' : 'bg-slate-50 border-slate-200/80'))))))) }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : (in_array($currentTheme, ['hotel_resort', 'minimal_card', 'nature_retreat', 'heritage_haveli', 'mountain_chalet', 'wellness_sanctuary']) ? 'font-serif text-stone-700' : 'text-slate-700') }}">
                        "Top-tier luxury experience! Pristine views, seamless Wi-Fi, and freshly prepared gourmet meals daily. We will definitely return again."
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-sky-600 text-white font-black text-xs flex items-center justify-center">
                            S
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Sneha Patil</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Guest Stay</span>
                        </div>
                    </div>
                </div>

                @else
                <!-- General Reviews for other archetypes -->
                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-slate-50 border-slate-200/80' }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : 'text-slate-700' }}">
                        "Booking online on their website was effortless. They listened patiently and explained everything thoroughly. Highly professional!"
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-purple-600 text-white font-black text-xs flex items-center justify-center">
                            A
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Ananya Deshmukh</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Resident, {{ $tenant->city }}</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-slate-50 border-slate-200/80' }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : 'text-slate-700' }}">
                        "Clean and hygienic premises with prompt WhatsApp notifications. No waiting in long lines. Transparent charges with zero hidden fees."
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-rose-500 text-white font-black text-xs flex items-center justify-center">
                            R
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Rajesh Kulkarni</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Appointment</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-3xl border shadow-sm transition hover-lift {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-slate-50 border-slate-200/80' }}">
                    <div class="flex items-center gap-1 text-amber-400 mb-3 text-xs">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span class="text-slate-500 font-bold ml-1">5.0</span>
                    </div>
                    <p class="text-xs sm:text-sm leading-relaxed mb-4 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-300' : 'text-slate-700' }}">
                        "Great experience with {{ $tenant->business_name }}! The staff is courteous and the consultation was top-tier. Wonderful to have this standard in {{ $tenant->city }}."
                    </p>
                    <div class="flex items-center gap-3 border-t pt-3 {{ $currentTheme === 'dark_luxury' ? 'border-zinc-800' : 'border-slate-200' }}">
                        <div class="w-8 h-8 rounded-full bg-sky-500 text-white font-black text-xs flex items-center justify-center">
                            S
                        </div>
                        <div>
                            <strong class="block text-xs {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Sneha Patil</strong>
                            <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Verified Patient</span>
                        </div>
                    </div>
                </div>
                @endif

            </div>

        </div>
    </section>
    @endif

    @if($this->isSectionVisible('inquiry'))
    <!-- 📍 CONTACT, LOCATION & QUICK INQUIRY FORM -->
    <section id="contact" class="py-16 border-b {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-950 border-zinc-800' : ($currentTheme === 'minimal_card' ? 'bg-neutral-50 border-neutral-200' : 'bg-slate-50 border-slate-200/80') }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Contact Details -->
                <div class="lg:col-span-5 space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-purple-600">
                            {{ $this->customizations['inquiry']['title'] ?? ($archetype->code === 'hospitality' ? 'Reservations & Front Desk' : 'Get In Touch') }}
                        </span>
                        <h3 class="text-2xl sm:text-3xl font-black tracking-tight {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">
                            {{ $this->customizations['inquiry']['heading'] ?? ($archetype->code === 'hospitality' ? 'Plan Your Stay or Inquire Room Dates' : 'Visit Our Location or Message Us') }}
                        </h3>
                        <p class="text-xs sm:text-sm mt-2 {{ $currentTheme === 'dark_luxury' ? 'text-zinc-400' : 'text-slate-600' }}">
                            @if($archetype->code === 'hospitality')
                                Looking for room availability, group stay packages, or special requests? Reach out directly via WhatsApp or phone.
                            @else
                                Have an inquiry or need assistance? Reach out directly via phone or WhatsApp for quick assistance.
                            @endif
                        </p>
                    </div>

                    <div class="space-y-4 text-xs sm:text-sm">
                        
                        <div class="p-4 rounded-2xl border flex items-start gap-3.5 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-slate-200' }}">
                            <div class="w-9 h-9 rounded-xl bg-rose-500/10 text-rose-500 flex items-center justify-center text-sm shrink-0">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <strong class="block mb-0.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Address & Location</strong>
                                <p class="text-slate-500">{{ $tenant->address ?: 'Main Street Commercial Complex' }}, {{ $tenant->city }}</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl border flex items-start gap-3.5 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-slate-200' }}">
                            <div class="w-9 h-9 rounded-xl bg-purple-500/10 text-purple-600 flex items-center justify-center text-sm shrink-0">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <strong class="block mb-0.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Phone Number</strong>
                                <a href="tel:{{ $tenant->phone }}" class="text-purple-600 font-bold hover:underline">{{ $tenant->phone }}</a>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl border flex items-start gap-3.5 {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-slate-200' }}">
                            <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center text-sm shrink-0">
                                <i class="fa-brands fa-whatsapp text-base"></i>
                            </div>
                            <div>
                                <strong class="block mb-0.5 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Direct WhatsApp</strong>
                                <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I have a question.') }}" target="_blank" class="text-emerald-600 font-bold hover:underline">Chat on WhatsApp (Instant)</a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Quick Message Form -->
                <div class="lg:col-span-7">
                    <div class="p-6 sm:p-8 rounded-3xl border shadow-xl {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-900 border-zinc-800' : 'bg-white border-slate-200' }}">
                        <h4 class="text-lg font-bold mb-1 {{ $currentTheme === 'dark_luxury' ? 'text-white' : 'text-slate-900' }}">Send a Quick Inquiry</h4>
                        <p class="text-xs text-slate-500 mb-6">Fill out the form below and our team will get back to you via WhatsApp.</p>

                        <form wire:submit.prevent="submitInquiry" class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Your Full Name *</label>
                                <input wire:model="inquiryName" type="text" placeholder="e.g. Vikas Verma" class="input-field" required>
                                @error('inquiryName') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp Number *</label>
                                <input wire:model="inquiryPhone" type="tel" placeholder="e.g. 9876543210" class="input-field" required>
                                @error('inquiryPhone') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Your Message or Required Service *</label>
                                <textarea wire:model="inquiryMessage" rows="3" placeholder="Tell us what you're looking for or your appointment preferences..." class="input-field" required></textarea>
                                @error('inquiryMessage') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="w-full py-3.5 rounded-xl btn-brand-gradient text-white font-extrabold text-sm shadow-lg shadow-purple-500/25 transition cursor-pointer flex items-center justify-center gap-2">
                                <i class="fa-solid fa-paper-plane"></i> {{ $this->customizations['inquiry']['button_text'] ?? 'Send Inquiry via WhatsApp' }}
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section>
    @endif

    @if($this->isSectionVisible('footer'))
    <!-- 🌐 WEBSITE FOOTER -->
    <footer class="py-12 border-t {{ $currentTheme === 'dark_luxury' ? 'bg-zinc-950 border-zinc-800 text-zinc-400' : 'bg-slate-900 border-slate-800 text-slate-400' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-b border-slate-800 pb-8">
                <div class="flex items-center gap-3">
                    @if(!empty($tenant->settings['logo_url']))
                        <img src="{{ $tenant->settings['logo_url'] }}" alt="{{ $tenant->business_name }}" class="h-10 w-auto max-w-[140px] object-contain rounded-xl shadow-xs">
                    @else
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-black text-lg" style="background: linear-gradient(135deg, {{ $tenant->brand_color }}, #9333ea);">
                        {{ strtoupper(substr($tenant->business_name, 0, 1)) }}
                    </div>
                    @endif
                    <div>
                        <h4 class="text-white font-black text-base">{{ $tenant->business_name }}</h4>
                        <p class="text-xs text-slate-500">&copy; {{ date('Y') }} {{ $tenant->business_name }}. All rights reserved.</p>
                    </div>
                </div>

                <div class="flex items-center gap-6 text-xs font-semibold">
                    <a href="#hero" class="hover:text-white transition">Home</a>
                    <a href="#services" class="hover:text-white transition">{{ $archetype->code === 'service' ? 'Services' : 'Catalog' }}</a>
                    <a href="#about" class="hover:text-white transition">About</a>
                    <a href="#timings" class="hover:text-white transition">Timings</a>
                    <a href="#contact" class="hover:text-white transition">Contact</a>
                </div>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                <p class="text-slate-500">
                    Local Business Profile &bull; {{ $tenant->city }}, India &bull; Phone: {{ $tenant->phone }}
                </p>
                <div class="inline-flex items-center gap-1.5 text-xs text-slate-400">
                    <span>Powered by</span>
                    <span class="font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-purple-400">Anemony</span>
                </div>
            </div>
        </div>
    </footer>
    @endif

    <!-- 🛍️ SMART SLIDE-OVER CART DRAWER & COUPON ENGINE (E-COMMERCE ONLY) -->
    @if($this->isEcommerce && $showCartModal)
    <div class="fixed inset-0 z-50 overflow-hidden animate-fade-in">
        <!-- Backdrop -->
        <div wire:click="$set('showCartModal', false)" class="absolute inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>

        <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-md bg-white shadow-2xl flex flex-col justify-between">
                
                <!-- Drawer Header -->
                <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/80">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-purple-600 text-white flex items-center justify-center font-bold text-sm shadow">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-base text-slate-900">Your Shopping Cart</h3>
                            <span class="text-xs text-slate-500 font-semibold">{{ $this->cartCount }} {{ $this->cartCount === 1 ? 'item' : 'items' }} selected</span>
                        </div>
                    </div>
                    <button wire:click="$set('showCartModal', false)" class="w-8 h-8 rounded-xl bg-slate-200/70 hover:bg-slate-300 text-slate-600 flex items-center justify-center transition cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- Free Shipping Progress Meter -->
                @if(!empty($cart))
                <div class="bg-gradient-to-r from-purple-50 via-indigo-50 to-blue-50 border-b border-indigo-100/60 p-3.5 px-5">
                    @if($this->subtotal >= $this->freeShippingThreshold)
                        <div class="flex items-center gap-2 text-emerald-700 text-xs font-bold">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            <span>🎉 Congratulations! You have unlocked <strong>FREE Express Delivery</strong></span>
                        </div>
                    @else
                        @php
                            $needed = $this->freeShippingThreshold - $this->subtotal;
                        @endphp
                        <div class="flex items-center justify-between text-xs font-bold text-slate-700 mb-1.5">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-solid fa-truck-fast text-purple-600"></i> Add ₹{{ number_format($needed, 0) }} more for <strong>FREE Delivery</strong>
                            </span>
                            <span class="text-[10px] text-purple-700 font-extrabold">{{ $this->freeShippingProgress }}%</span>
                        </div>
                        <div class="w-full bg-slate-200/80 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $this->freeShippingProgress }}%;"></div>
                        </div>
                    @endif
                </div>
                @endif

                <!-- Drawer Scrollable Content -->
                <div class="p-5 overflow-y-auto flex-1 space-y-4">
                    @if(empty($cart))
                    <div class="text-center py-16 text-slate-400">
                        <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-300 mx-auto mb-3 text-2xl">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <h4 class="font-bold text-base text-slate-700 mb-1">Your cart is empty</h4>
                        <p class="text-xs text-slate-400 max-w-xs mx-auto mb-5">Browse our catalog and add test series, notes, or products to get started!</p>
                        <button wire:click="$set('showCartModal', false)" class="px-5 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs shadow transition cursor-pointer">
                            Explore Catalog
                        </button>
                    </div>
                    @else
                        <!-- Cart Items List -->
                        <div class="space-y-3">
                            @foreach($cart as $cItem)
                            <div class="p-3 rounded-2xl border border-slate-100 bg-slate-50/50 flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3 flex-1 min-w-0">
                                    @if(!empty($cItem['image']))
                                        <img src="{{ $cItem['image'] }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200 shrink-0">
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <h4 class="text-xs font-bold text-slate-900 truncate">{{ $cItem['title'] }}</h4>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="text-xs font-black text-purple-700">₹{{ number_format($cItem['price'], 0) }}</span>
                                            <span class="text-[10px] text-slate-400">&times; {{ $cItem['qty'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-1.5 shrink-0">
                                    <button wire:click="updateQty({{ $cItem['id'] }}, -1)" class="w-7 h-7 rounded-lg bg-white border border-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center hover:bg-slate-100 transition cursor-pointer">-</button>
                                    <span class="text-xs font-bold w-5 text-center text-slate-800">{{ $cItem['qty'] }}</span>
                                    <button wire:click="updateQty({{ $cItem['id'] }}, 1)" class="w-7 h-7 rounded-lg bg-white border border-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center hover:bg-slate-100 transition cursor-pointer">+</button>
                                    <button wire:click="removeFromCart({{ $cItem['id'] }})" class="p-1.5 text-rose-500 hover:text-rose-700 text-xs ml-1 cursor-pointer" title="Remove">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- 🎟️ E-COMMERCE EXCLUSIVE COUPON ENGINE -->
                        <div class="pt-2 border-t border-slate-100">
                            <div class="bg-purple-50/50 border border-purple-100 rounded-2xl p-3.5 space-y-2.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-black uppercase text-purple-900 flex items-center gap-1.5">
                                        <i class="fa-solid fa-ticket text-purple-600"></i> Have a Promo Coupon?
                                    </span>
                                    @if($appliedCoupon)
                                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-full flex items-center gap-1">
                                            <i class="fa-solid fa-circle-check text-[9px]"></i> Applied
                                        </span>
                                    @endif
                                </div>

                                @if($appliedCoupon)
                                <!-- Applied Coupon Badge -->
                                <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between text-xs">
                                    <div>
                                        <div class="font-mono font-black text-emerald-800 flex items-center gap-1.5">
                                            <i class="fa-solid fa-tag"></i> {{ $appliedCoupon['code'] }}
                                        </div>
                                        <div class="text-[10px] text-emerald-700 font-semibold mt-0.5">
                                            You saved ₹{{ number_format($this->discountAmount, 2) }} on this order!
                                        </div>
                                    </div>
                                    <button type="button" wire:click="removeCoupon" class="px-2 py-1 rounded-lg text-rose-600 hover:bg-rose-50 text-[10px] font-bold transition cursor-pointer">
                                        Remove
                                    </button>
                                </div>
                                @else
                                <!-- Coupon Input Box -->
                                <div class="flex items-center gap-2">
                                    <input wire:model="couponCode" type="text" placeholder="Enter coupon code (e.g. WELCOME10)" class="flex-1 px-3 py-2 rounded-xl border border-slate-200 text-xs font-mono font-bold uppercase outline-none focus:border-purple-500 bg-white">
                                    <button type="button" wire:click="applyCoupon" class="px-4 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs shadow-xs transition cursor-pointer">
                                        Apply
                                    </button>
                                </div>
                                @endif

                                @if($couponError)
                                    <p class="text-[11px] font-bold text-rose-600 flex items-center gap-1">
                                        <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $couponError }}
                                    </p>
                                @endif
                                @if($couponSuccess && !$appliedCoupon)
                                    <p class="text-[11px] font-bold text-emerald-600 flex items-center gap-1">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i> {{ $couponSuccess }}
                                    </p>
                                @endif

                                <!-- Available Quick-Tap Coupons -->
                                @if(!$appliedCoupon && !empty($this->availableCoupons))
                                <div class="pt-1">
                                    <span class="text-[10px] font-bold text-slate-500 block mb-1.5">Available for you (tap to apply):</span>
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        @foreach($this->availableCoupons as $avC)
                                        <button type="button" wire:click="applyCoupon('{{ $avC['code'] }}')" class="px-2.5 py-1 rounded-lg bg-white border border-purple-200 hover:border-purple-400 text-purple-700 font-mono text-[10px] font-bold shadow-2xs transition cursor-pointer flex items-center gap-1">
                                            <span>{{ $avC['code'] }}</span>
                                            <span class="text-purple-400">&bull;</span>
                                            <span class="text-slate-600 font-sans">{{ ($avC['type'] ?? '') === 'percentage' ? $avC['value'].'% OFF' : '₹'.$avC['value'].' OFF' }}</span>
                                        </button>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Customer Delivery Information -->
                        <div class="pt-2 border-t border-slate-100 space-y-2.5">
                            <label class="block text-xs font-black uppercase text-slate-700 tracking-wider">
                                <i class="fa-solid fa-truck-ramp-box text-purple-600"></i> Delivery & Contact Details
                            </label>
                            
                            <div>
                                <input wire:model="customerName" type="text" placeholder="Full Name *" class="input-field text-xs" required>
                                @error('customerName') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <input wire:model="customerPhone" type="tel" placeholder="Mobile Number (e.g. 9876543210) *" class="input-field text-xs font-mono" required>
                                @error('customerPhone') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <textarea wire:model="customerAddress" rows="2" placeholder="Complete Delivery Address & Landmark *" class="input-field text-xs" required></textarea>
                                @error('customerAddress') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Drawer Footer & Dual Checkout Actions -->
                @if(!empty($cart))
                <div class="p-5 border-t border-slate-100 bg-slate-50 space-y-3 shrink-0">
                    <!-- Price Breakdown -->
                    <div class="space-y-1.5 text-xs">
                        <div class="flex items-center justify-between text-slate-500">
                            <span>Subtotal ({{ $this->cartCount }} items)</span>
                            <span class="font-bold text-slate-700">₹{{ number_format($this->subtotal, 2) }}</span>
                        </div>

                        @if($appliedCoupon && $this->discountAmount > 0)
                        <div class="flex items-center justify-between text-emerald-700 font-bold">
                            <span>Coupon Discount ({{ $appliedCoupon['code'] }})</span>
                            <span>-₹{{ number_format($this->discountAmount, 2) }}</span>
                        </div>
                        @endif

                        <div class="flex items-center justify-between text-slate-500">
                            <span>Delivery Shipping</span>
                            @if($this->subtotal >= $this->freeShippingThreshold)
                                <span class="font-bold text-emerald-600 uppercase text-[10px] bg-emerald-50 px-2 py-0.5 rounded">FREE</span>
                            @else
                                <span class="font-bold text-slate-700">₹50</span>
                            @endif
                        </div>

                        <div class="pt-2 border-t border-slate-200/80 flex items-center justify-between text-sm">
                            <span class="font-black text-slate-900">Total Payable:</span>
                            <span class="text-xl font-black text-purple-700">₹{{ number_format($this->cartTotal, 2) }}</span>
                        </div>
                    </div>

                    <!-- Dual Checkout Buttons -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1">
                        <!-- Direct Web Order Button -->
                        <button type="button" wire:click="checkoutWebOrder" class="py-3 px-3 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-1.5 cursor-pointer hover:scale-[1.02]">
                            <i class="fa-solid fa-bolt text-amber-300"></i> Direct Order (COD)
                        </button>

                        <!-- WhatsApp Order Button -->
                        <button type="button" wire:click="checkoutWhatsApp" class="py-3 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition flex items-center justify-center gap-1.5 cursor-pointer hover:scale-[1.02]">
                            <i class="fa-brands fa-whatsapp text-sm"></i> Order via WhatsApp
                        </button>
                    </div>

                    <p class="text-[10px] text-center text-slate-400">
                        <i class="fa-solid fa-lock text-[9px] text-emerald-600"></i> 100% Verified Order &bull; Cash or UPI on Doorstep
                    </p>
                </div>
                @endif

            </div>
        </div>
    </div>
    @endif

    <!-- 🎉 DIRECT WEB ORDER CONFIRMATION MODAL -->
    @if($showOrderSuccessModal && $placedOrder)
    <div class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 animate-fade-in">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl p-6 text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-3xl mx-auto shadow-inner animate-bounce">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div>
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full">
                    Order Placed Successfully
                </span>
                <h3 class="font-black text-xl text-slate-900 mt-2">Thank you, {{ $placedOrder->customer_name }}!</h3>
                <p class="text-xs text-slate-500 mt-1">Your order has been recorded and will be prepared shortly.</p>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 text-left text-xs space-y-2">
                <div class="flex items-center justify-between pb-2 border-b border-slate-200">
                    <span class="text-slate-500">Order Number:</span>
                    <span class="font-mono font-black text-purple-700 text-sm">#{{ $placedOrder->order_number }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Total Amount:</span>
                    <span class="font-black text-slate-900 text-sm">₹{{ number_format($placedOrder->total_amount, 2) }}</span>
                </div>
                @if(!empty($placedOrder->metadata['coupon']['code']))
                <div class="flex items-center justify-between text-emerald-700 font-bold">
                    <span>Coupon Applied:</span>
                    <span>{{ $placedOrder->metadata['coupon']['code'] }} (-₹{{ number_format($placedOrder->metadata['discount_amount'] ?? 0) }})</span>
                </div>
                @endif
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Payment:</span>
                    <span class="font-bold text-slate-700">Cash / UPI on Delivery</span>
                </div>
                <div class="pt-2 border-t border-slate-200 text-slate-600">
                    <span class="text-slate-400 block text-[10px]">Shipping To:</span>
                    <span class="font-semibold block text-[11px]">{{ $placedOrder->customer_address }}</span>
                </div>
            </div>

            <div class="pt-2 flex flex-col gap-2">
                @php
                    $trackMsg = "Hello " . $tenant->business_name . ", I just placed order #" . $placedOrder->order_number . " for ₹" . number_format($placedOrder->total_amount, 0) . ". Please share dispatch tracking!";
                @endphp
                <a href="{{ $tenant->getWhatsAppUrl($trackMsg) }}" target="_blank" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-2 shadow transition">
                    <i class="fa-brands fa-whatsapp text-base"></i> Track Order on WhatsApp
                </a>
                <button type="button" wire:click="$set('showOrderSuccessModal', false)" class="w-full py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-xs transition cursor-pointer">
                    Continue Shopping
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- 🗓️ Appointment Booking Modal for Healthcare/Clinics -->
    @if($showBookingModal && $selectedService)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl">
            <div class="p-5 border-b flex items-center justify-between bg-sky-50">
                <div>
                    <span class="text-[10px] font-black text-sky-700 uppercase tracking-widest">Clinic Slot Booking</span>
                    <h3 class="font-bold text-base text-slate-900">{{ $selectedService->title }}</h3>
                </div>
                <button wire:click="$set('showBookingModal', false)" class="text-slate-400 hover:text-slate-700 text-xl font-bold cursor-pointer">&times;</button>
            </div>

            <form wire:submit.prevent="confirmBooking" class="p-5 space-y-4">
                <div class="flex items-center justify-between bg-slate-50 p-3.5 rounded-2xl border border-slate-100 text-xs">
                    <div>
                        <span class="text-slate-500 block">Consultation Fee</span>
                        <span class="font-black text-base text-slate-900">₹{{ $selectedService->price }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block">Expected Duration</span>
                        <span class="font-bold text-sky-700">{{ $selectedService->duration_minutes }} Mins</span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Appointment Date *</label>
                    <input wire:model="bookingDate" type="date" min="{{ date('Y-m-d') }}" class="input-field" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Select Time Slot *</label>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach(['10:00 AM', '11:30 AM', '01:00 PM', '04:30 PM', '06:00 PM', '07:30 PM'] as $slot)
                        <button type="button" wire:click="$set('bookingSlot', '{{ $slot }}')" class="py-2 text-xs font-bold rounded-xl border text-center transition cursor-pointer {{ $bookingSlot === $slot ? 'bg-sky-600 text-white border-sky-600 shadow' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100' }}">
                            {{ $slot }}
                        </button>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Patient Full Name *</label>
                    <input wire:model="patientName" type="text" placeholder="e.g. Ramesh Kumar" class="input-field" required>
                    @error('patientName') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Phone Number (For WhatsApp Confirmation) *</label>
                    <input wire:model="patientPhone" type="tel" placeholder="e.g. 9876543210" class="input-field" required>
                    @error('patientPhone') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-black text-sm shadow-lg shadow-sky-600/25 transition flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-circle-check"></i> Confirm Slot & Receive SMS
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- 🏭 Quote Request Modal for B2B & Manufacturing -->
    @if($showQuoteModal && $selectedQuoteItem)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full overflow-hidden shadow-2xl">
            <div class="p-5 border-b flex items-center justify-between bg-amber-50">
                <div>
                    <span class="text-[10px] font-black text-amber-700 uppercase tracking-widest">Bulk Quotation Request</span>
                    <h3 class="font-bold text-base text-slate-900">{{ $selectedQuoteItem->title }}</h3>
                </div>
                <button wire:click="$set('showQuoteModal', false)" class="text-slate-400 hover:text-slate-700 text-xl font-bold cursor-pointer">&times;</button>
            </div>

            <form wire:submit.prevent="submitQuoteRequest" class="p-5 space-y-4">
                <div class="bg-amber-50/60 p-3.5 rounded-2xl border border-amber-100 flex items-center justify-between text-xs">
                    <span>Base Unit Rate: <strong>₹{{ $selectedQuoteItem->price }}</strong></span>
                    <span>Min Batch: <strong>{{ $selectedQuoteItem->min_order_qty }} Units</strong></span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Required Quantity *</label>
                    <input wire:model="quoteQty" type="number" min="{{ $selectedQuoteItem->min_order_qty ?: 1 }}" class="input-field" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Company / Organization</label>
                    <input wire:model="quoteCompany" type="text" placeholder="e.g. Acme Industries Ltd" class="input-field">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Contact Person *</label>
                        <input wire:model="customerName" type="text" placeholder="Your Name" class="input-field" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Mobile Number *</label>
                        <input wire:model="customerPhone" type="tel" placeholder="Phone" class="input-field" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Custom Specs / Drawing Notes</label>
                    <textarea wire:model="quoteNotes" rows="2" placeholder="e.g. Surface finish, delivery destination, test certificates..." class="input-field"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-black text-sm shadow-lg shadow-amber-600/25 transition flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-paper-plane"></i> Send Quotation Request
                </button>
            </form>
        </div>
    </div>
    @endif

    @if($this->isLandingPage)
    <!-- ⚡ Sticky Bottom Urgency Voucher Bar for Landing Page -->
    <div class="sm:hidden fixed bottom-0 left-0 right-0 z-40 bg-zinc-950/95 backdrop-blur-md border-t border-purple-500/40 p-3 flex items-center justify-between gap-3 shadow-2xl">
        <div>
            <span class="text-[10px] text-amber-400 font-extrabold uppercase block">⚡ Limited Offer &bull; 40% Off</span>
            <span class="text-xs font-black text-white">VIP Voucher @ ₹1,999</span>
        </div>
        <a href="{{ $tenant->getWhatsAppUrl('Hi ' . $tenant->business_name . ', I want to claim the Flat 40% Off Promo Voucher.') }}" target="_blank" class="px-4 py-2 rounded-xl btn-brand-gradient text-white font-extrabold text-xs shadow flex items-center gap-1.5">
            <i class="fa-brands fa-whatsapp text-sm"></i> Claim Voucher
        </a>
    </div>
    @endif

</div>
