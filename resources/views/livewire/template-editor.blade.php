<div class="h-screen flex flex-col bg-slate-950 text-slate-100 overflow-hidden font-sans" x-data="{ sidebarOpen: true }">
    
    <!-- 🌟 TOP STUDIO HEADER BAR -->
    <header class="h-16 bg-slate-900 border-b border-slate-800 px-4 sm:px-6 flex items-center justify-between gap-4 shrink-0 z-30 shadow-md">
        
        <!-- Left: Back & Store Identity -->
        <div class="flex items-center gap-3">
            <a href="{{ route('store.dashboard', $tenant->slug) }}" class="p-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 transition text-xs font-bold flex items-center gap-1.5" title="Back to Dashboard">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="hidden sm:inline">Dashboard</span>
            </a>
            
            <div class="h-5 w-px bg-slate-800 hidden sm:block"></div>

            <button type="button" @click="sidebarOpen = !sidebarOpen" class="px-2.5 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 transition text-xs font-bold flex items-center gap-1.5 cursor-pointer shadow-sm" :title="sidebarOpen ? 'Collapse Controls Sidebar' : 'Expand Controls Sidebar'">
                <i class="fa-solid" :class="sidebarOpen ? 'fa-angles-left' : 'fa-sliders'"></i>
                <span class="hidden md:inline" x-text="sidebarOpen ? 'Hide Controls' : 'Show Controls'"></span>
            </button>

            <div class="flex items-center gap-2.5">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $tenant->business_name }}" class="h-8 w-auto max-w-[90px] object-contain rounded-lg p-0.5 bg-white/10 border border-slate-700">
                @endif
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-sm font-black text-white line-clamp-1">{{ $tenant->business_name }}</h1>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-purple-900/60 text-purple-300 border border-purple-700/60">
                            Template Editor
                        </span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-900/40 text-blue-300 border border-blue-700/60 hidden sm:inline">
                            {{ $tenant->business_category ?: 'Coaching & Institutes' }}
                        </span>
                    </div>
                    <span class="text-[11px] text-slate-400 font-mono hidden md:inline">Theme: {{ $activeTheme }}</span>
                </div>
            </div>
        </div>

        <!-- Center: Dual-Mode Switcher & Device Viewport -->
        <div class="flex items-center gap-3">
            <!-- Mode Switcher Pill (Simple vs Advance) -->
            <div class="flex items-center bg-slate-950 p-1 rounded-xl border border-slate-800 shadow-inner">
                <button type="button" wire:click="setEditorMode('simple')" class="px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ $editorMode === 'simple' ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md' : 'text-slate-400 hover:text-slate-200' }}" title="Easy 2-Minute Setup for Fast Launch">
                    <i class="fa-solid fa-bolt text-xs"></i> <span>Simple Mode</span>
                </button>
                <button type="button" wire:click="setEditorMode('advance')" class="px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ $editorMode === 'advance' ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:text-slate-200' }}" title="Granular Pro Controls & Layout Reordering">
                    <i class="fa-solid fa-sliders text-xs"></i> <span>Advance Mode</span>
                </button>
            </div>

            <!-- Viewport Switcher -->
            <div class="hidden xl:flex items-center bg-slate-950 p-1 rounded-xl border border-slate-800">
                <button wire:click="setDeviceMode('desktop')" class="px-2.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ $deviceMode === 'desktop' ? 'bg-slate-800 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}" title="Desktop View">
                    <i class="fa-solid fa-desktop"></i>
                </button>
                <button wire:click="setDeviceMode('tablet')" class="px-2.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ $deviceMode === 'tablet' ? 'bg-slate-800 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}" title="Tablet View">
                    <i class="fa-solid fa-tablet-screen-button"></i>
                </button>
                <button wire:click="setDeviceMode('mobile')" class="px-2.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ $deviceMode === 'mobile' ? 'bg-slate-800 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}" title="Mobile View">
                    <i class="fa-solid fa-mobile-screen"></i>
                </button>
            </div>
        </div>

        <!-- Right: Actions & Save Button -->
        <div class="flex items-center gap-2.5">
            <button wire:click="resetToDefaults" wire:confirm="Are you sure you want to reset all customizations to theme defaults?" class="px-3 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold text-xs transition" title="Reset to Template Defaults">
                <i class="fa-solid fa-rotate-left mr-1"></i> <span class="hidden sm:inline">Reset Defaults</span>
            </button>

            <a href="{{ route('store.show', $tenant->slug) }}" target="_blank" class="px-3 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-blue-400 font-bold text-xs transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> <span class="hidden sm:inline">View Live</span>
            </a>

            <button wire:click="saveCustomizations" class="px-4 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-black text-xs shadow-lg shadow-emerald-900/50 transition flex items-center gap-1.5 cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i> Save &amp; Publish
            </button>
        </div>

    </header>

    <!-- 📢 FLASH NOTIFICATION STRIP -->
    @if($flashSuccess)
    <div class="bg-emerald-950 border-b border-emerald-700/60 px-4 py-2 text-xs text-emerald-200 font-bold flex items-center justify-between z-20">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
            <span>{{ $flashSuccess }}</span>
        </div>
        <button wire:click="$set('flashSuccess', '')" class="text-emerald-400 hover:text-white">&times;</button>
    </div>
    @endif

    <!-- 🛠️ SPLIT WORKSPACE (LEFT CONTROLS + RIGHT REAL-TIME PREVIEW) -->
    <div class="flex-1 flex overflow-hidden">
        
        <!-- ============================================== -->
        <!-- 🎛️ LEFT CONTROLS SIDEBAR (Fixed 410px Studio)   -->
        <!-- ============================================== -->
        <aside x-show="sidebarOpen" class="w-[410px] shrink-0 bg-slate-900 border-r border-slate-800 flex flex-col h-full overflow-hidden z-20 shadow-2xl transition-all duration-200" style="width: 410px; min-width: 360px; max-width: 440px;">
            
            @if($editorMode === 'simple')
                <!-- ⚡ SIMPLE MODE TOP BAR -->
                <div class="p-3 bg-slate-950/80 border-b border-slate-800 flex items-center justify-between gap-2 shrink-0">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center text-xs font-black">
                            <i class="fa-solid fa-bolt"></i>
                        </span>
                        <div>
                            <h2 class="text-xs font-black text-white">⚡ Simple Mode</h2>
                            <p class="text-[10px] text-slate-400">Essential 2-minute store customization</p>
                        </div>
                    </div>
                    <button type="button" wire:click="setEditorMode('advance')" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-blue-400 hover:text-white text-[11px] font-bold transition flex items-center gap-1 shadow-sm cursor-pointer">
                        <i class="fa-solid fa-sliders text-xs"></i> <span>Advance</span>
                    </button>
                </div>

                <!-- ⚡ SIMPLE MODE SCROLLABLE CONTENT -->
                <div class="flex-1 overflow-y-auto p-4 space-y-5 text-xs">

                    <!-- 1. Brand Identity (Logo, Colors, Theme) -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 space-y-3.5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center text-xs">
                                    <i class="fa-solid fa-palette"></i>
                                </span>
                                <span class="font-bold text-white text-xs">1. Brand Logo &amp; Color Theme</span>
                            </div>
                            @if($logoUrl)
                                <button type="button" wire:click="removeLogo" class="text-rose-400 hover:text-rose-300 text-[10px] font-bold flex items-center gap-1 transition">
                                    <i class="fa-solid fa-trash"></i> Remove
                                </button>
                            @endif
                        </div>

                        <!-- Logo Preview & Upload -->
                        <div class="p-3 rounded-xl border border-dashed border-slate-700 bg-slate-900/60 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-2.5 min-w-0">
                                @if($logoUrl)
                                    <img src="{{ $logoUrl }}" alt="{{ $businessName ?: $tenant->business_name }}" class="h-10 max-w-[120px] object-contain rounded-lg p-1 bg-white/5 border border-slate-800 shadow-sm shrink-0">
                                    <span class="text-[10px] text-emerald-400 font-bold truncate">Custom Logo Active</span>
                                @else
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-black text-sm shadow-md shrink-0" style="background: linear-gradient(135deg, {{ $brandColor }}, #9333ea);">
                                        {{ strtoupper(substr($businessName ?: $tenant->business_name, 0, 1)) }}
                                    </div>
                                    <span class="text-[11px] text-slate-400 truncate">Default letter badge</span>
                                @endif
                            </div>
                            <label class="px-2.5 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold text-[11px] transition cursor-pointer shrink-0">
                                <span>Upload</span>
                                <input type="file" wire:model="logoFile" accept="image/*" class="hidden">
                            </label>
                        </div>
                        <div wire:loading wire:target="logoFile" class="text-xs text-blue-400 font-bold flex items-center gap-2">
                            <i class="fa-solid fa-spinner animate-spin"></i> Uploading logo...
                        </div>

                        <!-- 1-Tap Color Swatches -->
                        <div class="space-y-1.5 pt-2 border-t border-slate-800/80">
                            <div class="flex items-center justify-between">
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Primary Brand Accent</label>
                                <div class="flex items-center gap-1.5">
                                    <input type="color" wire:model.live="brandColor" class="w-5 h-5 rounded-md bg-transparent border-0 cursor-pointer">
                                    <span class="text-[10px] font-mono text-slate-400 uppercase font-bold">{{ $brandColor }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-wrap pt-1">
                                <button type="button" wire:click="$set('brandColor', '#2563EB')" class="w-7 h-7 rounded-full bg-blue-600 border-2 transition {{ $brandColor === '#2563EB' ? 'border-white scale-110 shadow-lg' : 'border-transparent' }}" title="Electric Blue"></button>
                                <button type="button" wire:click="$set('brandColor', '#059669')" class="w-7 h-7 rounded-full bg-emerald-600 border-2 transition {{ $brandColor === '#059669' ? 'border-white scale-110 shadow-lg' : 'border-transparent' }}" title="Emerald Green"></button>
                                <button type="button" wire:click="$set('brandColor', '#4F46E5')" class="w-7 h-7 rounded-full bg-indigo-600 border-2 transition {{ $brandColor === '#4F46E5' ? 'border-white scale-110 shadow-lg' : 'border-transparent' }}" title="Indigo Pro"></button>
                                <button type="button" wire:click="$set('brandColor', '#DC2626')" class="w-7 h-7 rounded-full bg-red-600 border-2 transition {{ $brandColor === '#DC2626' ? 'border-white scale-110 shadow-lg' : 'border-transparent' }}" title="Crimson Red"></button>
                                <button type="button" wire:click="$set('brandColor', '#7C3AED')" class="w-7 h-7 rounded-full bg-purple-600 border-2 transition {{ $brandColor === '#7C3AED' ? 'border-white scale-110 shadow-lg' : 'border-transparent' }}" title="Royal Purple"></button>
                                <button type="button" wire:click="$set('brandColor', '#D97706')" class="w-7 h-7 rounded-full bg-amber-600 border-2 transition {{ $brandColor === '#D97706' ? 'border-white scale-110 shadow-lg' : 'border-transparent' }}" title="Amber Gold"></button>
                                <button type="button" wire:click="$set('brandColor', '#0891B2')" class="w-7 h-7 rounded-full bg-cyan-600 border-2 transition {{ $brandColor === '#0891B2' ? 'border-white scale-110 shadow-lg' : 'border-transparent' }}" title="Cyan Tech"></button>
                                <button type="button" wire:click="$set('brandColor', '#E11D48')" class="w-7 h-7 rounded-full bg-rose-600 border-2 transition {{ $brandColor === '#E11D48' ? 'border-white scale-110 shadow-lg' : 'border-transparent' }}" title="Rose Luxe"></button>
                            </div>
                        </div>

                        <!-- Theme Tone -->
                        <div class="grid grid-cols-2 gap-2 pt-2 border-t border-slate-800/80">
                            <button type="button" wire:click="$set('themeMode', 'dark')" class="p-2 rounded-xl border text-center transition {{ $themeMode === 'dark' ? 'bg-blue-600/30 border-blue-500 text-blue-300 font-bold shadow' : 'bg-slate-900 border-slate-800 text-slate-400 hover:text-white' }}">
                                <i class="fa-solid fa-moon mr-1 text-blue-400"></i> Dark Theme
                            </button>
                            <button type="button" wire:click="$set('themeMode', 'light')" class="p-2 rounded-xl border text-center transition {{ $themeMode === 'light' ? 'bg-blue-600/30 border-blue-500 text-blue-300 font-bold shadow' : 'bg-slate-900 border-slate-800 text-slate-400 hover:text-white' }}">
                                <i class="fa-solid fa-sun mr-1 text-amber-400"></i> Light Theme
                            </button>
                        </div>
                    </div>

                    <!-- 2. 1-Click Magic Presets -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 space-y-3 shadow-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-purple-500/20 text-purple-400 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                            </span>
                            <div>
                                <span class="font-bold text-white text-xs block">2. 1-Click Magic Presets</span>
                                <span class="text-[10px] text-slate-400">Apply ready-to-launch exam campaigns instantly</span>
                            </div>
                        </div>

                        <div class="space-y-2 pt-1">
                            <!-- Preset 1: NEET & JEE 2026 -->
                            <button type="button" wire:click="applyContentPreset('neet_jee')" class="w-full text-left p-3 rounded-xl border border-slate-800 bg-slate-900/60 hover:bg-slate-800/80 hover:border-blue-500/60 transition group cursor-pointer">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-bold text-white text-xs group-hover:text-blue-400 transition flex items-center gap-1.5">
                                        <span>🎯</span> NEET / JEE 2026 Pass
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-blue-900/60 text-blue-300 border border-blue-700/60">₹499 (75% OFF)</span>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-1 leading-relaxed">NTA Exam Simulator, AIR Radar, Topper Mentorship, 150+ Mocks.</p>
                            </button>

                            <!-- Preset 2: UPSC CSE Foundation -->
                            <button type="button" wire:click="applyContentPreset('upsc_foundation')" class="w-full text-left p-3 rounded-xl border border-slate-800 bg-slate-900/60 hover:bg-slate-800/80 hover:border-indigo-500/60 transition group cursor-pointer">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-bold text-white text-xs group-hover:text-indigo-400 transition flex items-center gap-1.5">
                                        <span>🏛️</span> UPSC Prelims &amp; Mains Pass
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-indigo-900/60 text-indigo-300 border border-indigo-700/60">₹999 (75% OFF)</span>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-1 leading-relaxed">Ex-IAS Mentorship, 60+ GS &amp; CSAT Mocks, UPSC Trend Aligned.</p>
                            </button>

                            <!-- Preset 3: 45-Day High-Yield Sprint -->
                            <button type="button" wire:click="applyContentPreset('crash_course')" class="w-full text-left p-3 rounded-xl border border-slate-800 bg-slate-900/60 hover:bg-slate-800/80 hover:border-emerald-500/60 transition group cursor-pointer">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-bold text-white text-xs group-hover:text-emerald-400 transition flex items-center gap-1.5">
                                        <span>⚡</span> 45-Day Rapid Revision Sprint
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-emerald-900/60 text-emerald-300 border border-emerald-700/60">₹299 (75% OFF)</span>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-1 leading-relaxed">High-yield repeated questions, 30 speed mocks, +85 score booster.</p>
                            </button>
                        </div>
                    </div>

                    <!-- 3. Hero Background & Atmosphere -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 space-y-3.5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-xs">
                                    <i class="fa-solid fa-image"></i>
                                </span>
                                <span class="font-bold text-white text-xs">3. Hero Background &amp; Contrast</span>
                            </div>
                            @if($heroBackgroundImageUrl || $heroImageUrl)
                                <button type="button" wire:click="removeHeroBackgroundImage" class="text-rose-400 hover:text-rose-300 text-[10px] font-bold flex items-center gap-1 transition cursor-pointer" title="Restore Default Live Background">
                                    <i class="fa-solid fa-rotate-left"></i> Restore Default
                                </button>
                            @endif
                        </div>

                        <!-- Active Background State Indicator -->
                        @if($heroBackgroundImageUrl || $heroImageUrl)
                            <div class="relative rounded-xl overflow-hidden border border-slate-700 h-24 bg-slate-900 flex items-end p-2.5 shadow-inner">
                                <img src="{{ $heroBackgroundImageUrl ?: $heroImageUrl }}" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40"></div>
                                <div class="relative z-10 flex items-center justify-between w-full">
                                    <span class="text-[10px] font-bold text-white bg-slate-950/80 px-2 py-0.5 rounded-md border border-slate-700">Custom Photo Active</span>
                                    <span class="text-[10px] font-bold text-cyan-300 bg-cyan-950/80 px-2 py-0.5 rounded-md border border-cyan-700">{{ $heroBgDarkness }}% Tint</span>
                                </div>
                            </div>
                        @else
                            <div class="p-3 rounded-xl border border-dashed border-slate-700 bg-slate-900/40 text-center">
                                <i class="fa-solid fa-laptop-code text-cyan-400 text-lg mb-1 block"></i>
                                <span class="text-[11px] text-slate-300 font-bold block">Live CBT Simulator Background</span>
                                <span class="text-[10px] text-slate-400">Interactive live exam console is visible by default.</span>
                            </div>
                        @endif

                        <!-- Upload Custom Image -->
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Upload Custom Background Image</label>
                            <input type="file" wire:model="heroBackgroundImageFile" accept="image/*" class="block w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-500 cursor-pointer bg-slate-900 rounded-xl border border-slate-800 p-1">
                            <div wire:loading wire:target="heroBackgroundImageFile" class="text-xs text-blue-400 font-bold flex items-center gap-2 mt-1">
                                <i class="fa-solid fa-spinner animate-spin"></i> Uploading &amp; Applying Image...
                            </div>
                        </div>

                        <!-- 4 Curated 1-Click Wallpapers -->
                        <div class="space-y-1.5 pt-2 border-t border-slate-800/80">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Or Pick Curated Coaching Wallpaper</label>
                            <div class="grid grid-cols-4 gap-2">
                                <button type="button" wire:click="selectPresetHeroBg('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1920&q=80')" class="group relative rounded-lg overflow-hidden border border-slate-700 hover:border-cyan-400 h-14 transition cursor-pointer" title="Modern Lab">
                                    <img src="https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=300&q=70" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    <span class="absolute inset-x-0 bottom-0 bg-black/70 text-[8px] text-white font-bold text-center py-0.5 truncate">Lab</span>
                                </button>
                                <button type="button" wire:click="selectPresetHeroBg('https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1920&q=80')" class="group relative rounded-lg overflow-hidden border border-slate-700 hover:border-cyan-400 h-14 transition cursor-pointer" title="Study Hall">
                                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=300&q=70" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    <span class="absolute inset-x-0 bottom-0 bg-black/70 text-[8px] text-white font-bold text-center py-0.5 truncate">Library</span>
                                </button>
                                <button type="button" wire:click="selectPresetHeroBg('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=1920&q=80')" class="group relative rounded-lg overflow-hidden border border-slate-700 hover:border-cyan-400 h-14 transition cursor-pointer" title="Campus Hall">
                                    <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=300&q=70" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    <span class="absolute inset-x-0 bottom-0 bg-black/70 text-[8px] text-white font-bold text-center py-0.5 truncate">Campus</span>
                                </button>
                                <button type="button" wire:click="selectPresetHeroBg('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1920&q=80')" class="group relative rounded-lg overflow-hidden border border-slate-700 hover:border-cyan-400 h-14 transition cursor-pointer" title="Dark Tech">
                                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=300&q=70" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    <span class="absolute inset-x-0 bottom-0 bg-black/70 text-[8px] text-white font-bold text-center py-0.5 truncate">Tech</span>
                                </button>
                            </div>
                        </div>

                        <!-- Darkness Tint Quick Presets -->
                        <div class="space-y-1.5 pt-2 border-t border-slate-800/80">
                            <div class="flex items-center justify-between">
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Photo Contrast Tint</label>
                                <span class="text-[10px] font-bold text-blue-400">{{ $heroBgDarkness }}%</span>
                            </div>
                            <div class="grid grid-cols-3 gap-2">
                                <button type="button" wire:click="$set('heroBgDarkness', 35)" class="py-1 px-2 rounded-lg border text-center transition cursor-pointer {{ (int)$heroBgDarkness === 35 ? 'bg-blue-600 text-white border-blue-500 font-bold' : 'bg-slate-900 border-slate-800 text-slate-300 hover:text-white' }}">
                                    <span class="text-[10px] block">35% Bright</span>
                                </button>
                                <button type="button" wire:click="$set('heroBgDarkness', 60)" class="py-1 px-2 rounded-lg border text-center transition cursor-pointer {{ (int)$heroBgDarkness === 60 ? 'bg-blue-600 text-white border-blue-500 font-bold' : 'bg-slate-900 border-slate-800 text-slate-300 hover:text-white' }}">
                                    <span class="text-[10px] block">60% Balanced</span>
                                </button>
                                <button type="button" wire:click="$set('heroBgDarkness', 80)" class="py-1 px-2 rounded-lg border text-center transition cursor-pointer {{ (int)$heroBgDarkness === 80 ? 'bg-blue-600 text-white border-blue-500 font-bold' : 'bg-slate-900 border-slate-800 text-slate-300 hover:text-white' }}">
                                    <span class="text-[10px] block">80% Deep Focus</span>
                                </button>
                            </div>
                            <input type="range" min="0" max="95" step="5" wire:model.live.debounce.150ms="heroBgDarkness" class="w-full h-1.5 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-blue-500 mt-1">
                        </div>
                    </div>

                    <!-- 4. Main Message & WhatsApp Quick Connect -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 space-y-3.5 shadow-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-pencil"></i>
                            </span>
                            <span class="font-bold text-white text-xs">4. Store Message &amp; WhatsApp</span>
                        </div>

                        <!-- Academy / Store Display Name -->
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Store / Academy Name</label>
                            <input type="text" wire:model.live.debounce.400ms="businessName" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:border-blue-500 focus:outline-none font-bold">
                        </div>

                        <!-- Main Value Headline -->
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Main Hero Headline</label>
                            <textarea rows="2" wire:model.live.debounce.400ms="heroHeadline" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:border-blue-500 focus:outline-none"></textarea>
                        </div>

                        <!-- Subheadline -->
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Subtitle Description</label>
                            <textarea rows="2" wire:model.live.debounce.400ms="heroSubheadline" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-300 focus:border-blue-500 focus:outline-none text-[11px]"></textarea>
                        </div>

                        <!-- WhatsApp Quick Connect -->
                        <div class="space-y-1 pt-1">
                            <label class="block text-[10px] font-bold text-emerald-400 uppercase tracking-wider flex items-center gap-1">
                                <i class="fa-brands fa-whatsapp text-emerald-400"></i> WhatsApp Orders &amp; Inquiries
                            </label>
                            <input type="text" wire:model.live.debounce.400ms="whatsappNumber" placeholder="e.g. 9876543210" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-emerald-300 focus:border-emerald-500 focus:outline-none font-mono">
                        </div>
                    </div>

                    <!-- 5. Advance Mode Callout -->
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-slate-900 to-blue-950/40 border border-blue-900/40 space-y-2.5 text-center">
                        <div class="w-8 h-8 rounded-xl bg-blue-600/20 text-blue-400 flex items-center justify-center mx-auto text-sm">
                            <i class="fa-solid fa-sliders"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-black text-white">Need Deeper Customization?</h3>
                            <p class="text-[11px] text-slate-400 mt-0.5 leading-relaxed">
                                Switch to <span class="text-blue-300 font-bold">Advance Mode</span> to reorder sections up/down, edit 4 trust pillar cards, customize strikethrough pricing, and fine-tune exam simulator chips.
                            </p>
                        </div>
                        <button type="button" wire:click="setEditorMode('advance')" class="w-full py-2 px-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-lg shadow-blue-900/40 transition flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-sliders"></i> Open Advance Mode
                        </button>
                    </div>

                </div>
            @else
                <!-- ============================================== -->
                <!-- 🛠️ ADVANCE MODE TOP BAR & TAB SELECTOR         -->
                <!-- ============================================== -->
                <div class="flex items-center bg-slate-950 border-b border-slate-800 p-1.5 overflow-x-auto gap-1 text-xs shrink-0">
                    <button wire:click="setEditorTab('branding')" class="px-2.5 py-1.5 rounded-lg font-bold transition flex items-center gap-1.5 whitespace-nowrap {{ $activeEditorTab === 'branding' ? 'bg-blue-600 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}">
                        <i class="fa-solid fa-gem text-amber-400"></i> Logo &amp; Brand
                    </button>
                    <button wire:click="setEditorTab('sections')" class="px-2.5 py-1.5 rounded-lg font-bold transition flex items-center gap-1.5 whitespace-nowrap {{ $activeEditorTab === 'sections' ? 'bg-blue-600 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}">
                        <i class="fa-solid fa-arrows-up-down"></i> Layout
                    </button>
                    <button wire:click="setEditorTab('hero')" class="px-2.5 py-1.5 rounded-lg font-bold transition flex items-center gap-1.5 whitespace-nowrap {{ $activeEditorTab === 'hero' ? 'bg-blue-600 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}">
                        <i class="fa-solid fa-bullhorn text-cyan-400"></i> Hero
                    </button>
                    <button wire:click="setEditorTab('pricing')" class="px-2.5 py-1.5 rounded-lg font-bold transition flex items-center gap-1.5 whitespace-nowrap {{ $activeEditorTab === 'pricing' ? 'bg-blue-600 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}">
                        <i class="fa-solid fa-tags text-rose-400"></i> Pricing
                    </button>
                    <button wire:click="setEditorTab('trust')" class="px-2.5 py-1.5 rounded-lg font-bold transition flex items-center gap-1.5 whitespace-nowrap {{ $activeEditorTab === 'trust' ? 'bg-blue-600 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}">
                        <i class="fa-solid fa-shield-halved text-emerald-400"></i> Trust
                    </button>
                    <button wire:click="setEditorTab('inquiry')" class="px-2.5 py-1.5 rounded-lg font-bold transition flex items-center gap-1.5 whitespace-nowrap {{ $activeEditorTab === 'inquiry' ? 'bg-blue-600 text-white shadow' : 'text-slate-400 hover:text-slate-200' }}">
                        <i class="fa-solid fa-envelope text-purple-400"></i> Contact
                    </button>
                </div>

                <!-- Tab Content (Scrollable Advance Studio) -->
                <div class="flex-1 overflow-y-auto p-5 space-y-6 text-xs">
                    
                    <!-- Advance Mode Banner -->
                    <div class="p-2.5 rounded-xl bg-slate-950/70 border border-slate-800 flex items-center justify-between text-[11px]">
                        <span class="text-slate-400 font-bold flex items-center gap-1.5">
                            <i class="fa-solid fa-sliders text-blue-400"></i> Advance Studio Active
                        </span>
                        <button type="button" wire:click="setEditorMode('simple')" class="text-amber-400 hover:text-amber-300 font-bold transition cursor-pointer">
                            &larr; Switch to Simple Mode
                        </button>
                    </div>
                
                <!-- ============================================== -->
                <!-- 🔀 TAB 1: SECTIONS MANAGER (ORDER & ACTIVE/DEACTIVE) -->
                <!-- ============================================== -->
                @if($activeEditorTab === 'sections')
                <div class="space-y-4">
                    <div>
                        <h2 class="text-sm font-black text-white">Layout &amp; Section Exchange</h2>
                        <p class="text-slate-400 text-[11px] mt-0.5">Reorder sections up/down or toggle them active/deactive on your live website.</p>
                    </div>

                    <div class="space-y-2.5">
                        @foreach($sectionsOrder as $idx => $sectionKey)
                            @php
                                $label = match($sectionKey) {
                                    'hero' => '1. Hero &amp; Value Proposition Banner',
                                    'trust' => '2. Why Customers Trust Us (4 Pillars)',
                                    'catalog' => '3. Products / Services Catalog',
                                    'reviews' => '4. Verified Customer Reviews',
                                    'inquiry' => '5. Quick Inquiry &amp; WhatsApp Form',
                                    'footer' => '6. Website Footer &amp; Business Address',
                                    default => ucfirst($sectionKey),
                                };
                                $icon = match($sectionKey) {
                                    'hero' => 'fa-bullhorn text-cyan-400',
                                    'trust' => 'fa-shield-halved text-amber-400',
                                    'catalog' => 'fa-layer-group text-purple-400',
                                    'reviews' => 'fa-star text-yellow-400',
                                    'inquiry' => 'fa-envelope text-emerald-400',
                                    'footer' => 'fa-shoe-prints text-slate-400',
                                    default => 'fa-cube text-blue-400',
                                };
                                $isActive = $sectionsVisibility[$sectionKey] ?? true;
                            @endphp

                            <div class="p-3.5 rounded-2xl border transition {{ $isActive ? 'bg-slate-950 border-slate-700/80 shadow-sm' : 'bg-slate-900/50 border-slate-800 opacity-60' }} flex items-center justify-between gap-3">
                                
                                <!-- Label & Icon -->
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="w-8 h-8 rounded-xl bg-slate-800 flex items-center justify-center shrink-0">
                                        <i class="fa-solid {{ $icon }}"></i>
                                    </span>
                                    <div class="min-w-0">
                                        <span class="font-bold text-white block text-xs truncate">{!! $label !!}</span>
                                        <span class="text-[10px] {{ $isActive ? 'text-emerald-400' : 'text-slate-500' }} font-semibold">
                                            {{ $isActive ? '● Active on Live Site' : '○ Deactivated (Hidden)' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Actions: Up/Down Swap & Active/Deactive Toggle -->
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <button wire:click="moveSectionUp({{ $idx }})" @if($idx === 0) disabled @endif class="p-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 disabled:opacity-30 disabled:cursor-not-allowed text-slate-300 transition" title="Move Up">
                                        <i class="fa-solid fa-arrow-up text-xs"></i>
                                    </button>
                                    <button wire:click="moveSectionDown({{ $idx }})" @if($idx === count($sectionsOrder) - 1) disabled @endif class="p-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 disabled:opacity-30 disabled:cursor-not-allowed text-slate-300 transition" title="Move Down">
                                        <i class="fa-solid fa-arrow-down text-xs"></i>
                                    </button>
                                    <button wire:click="toggleSectionVisibility('{{ $sectionKey }}')" class="p-1.5 px-2.5 rounded-lg text-xs font-bold transition {{ $isActive ? 'bg-emerald-600/30 text-emerald-300 border border-emerald-500/40 hover:bg-emerald-600/50' : 'bg-slate-800 text-slate-400 hover:bg-slate-700' }}" title="Toggle Visibility">
                                        {{ $isActive ? 'Active' : 'Hidden' }}
                                    </button>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- ============================================== -->
                <!-- 🎯 TAB 2: HERO CONTENT CONTROLS                -->
                <!-- ============================================== -->
                @if($activeEditorTab === 'hero')
                <div class="space-y-5">
                    <div>
                        <h2 class="text-sm font-black text-white flex items-center gap-2">
                            <i class="fa-solid fa-bullhorn text-cyan-400"></i>
                            <span>Hero Banner &amp; Visual Showcase</span>
                        </h2>
                        <p class="text-slate-400 text-[11px] mt-0.5">Control the main headline, custom hero image or simulator console, badges, stats, and CTAs.</p>
                    </div>

                    <!-- 1. HERO BACKGROUND IMAGE (WALLPAPER & TEXTURE) -->
                    <div class="p-3.5 rounded-2xl bg-slate-950 border border-slate-800 space-y-3 shadow-sm">
                        <div class="flex items-center justify-between">
                            <label class="block text-[11px] font-bold text-white uppercase tracking-wider flex items-center gap-1.5">
                                <i class="fa-solid fa-image text-amber-400"></i>
                                <span>Hero Background Image</span>
                            </label>
                            @if($heroBackgroundImageUrl)
                                <button type="button" wire:click="removeHeroBackgroundImage" class="text-rose-400 hover:text-rose-300 text-[10px] font-bold flex items-center gap-1 transition">
                                    <i class="fa-solid fa-trash"></i> Reset to Default
                                </button>
                            @endif
                        </div>
                        <p class="text-slate-400 text-[10px]">Add an atmospheric background image behind your hero banner. The official CBT Exam Simulator console stays interactive on the right by default.</p>

                        <!-- Live Background Preview Card -->
                        <div class="rounded-xl border border-dashed border-slate-700 bg-slate-900/60 p-2 overflow-hidden flex flex-col items-center justify-center text-center">
                            @if($heroBackgroundImageUrl)
                                <div class="relative w-full h-28 rounded-lg overflow-hidden border border-slate-800 shadow">
                                    <img src="{{ $heroBackgroundImageUrl }}" alt="Hero Background Preview" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 to-slate-950/40 flex items-center justify-center">
                                        <span class="text-[10px] text-emerald-300 font-bold bg-slate-950/80 px-2 py-0.5 rounded border border-emerald-500/40">
                                            ✓ Custom Background Active
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="py-5 flex flex-col items-center justify-center text-slate-500">
                                    <i class="fa-solid fa-sparkles text-xl mb-1 text-cyan-400"></i>
                                    <span class="text-[11px] font-medium text-slate-400">Default Dark Cyber Glow active</span>
                                    <span class="text-[10px] text-slate-500 mt-0.5">Upload a photo below if you want a custom background</span>
                                </div>
                            @endif
                        </div>

                        <!-- Upload Input -->
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Upload Background Image (PNG, JPG, WebP)</label>
                            <input type="file" wire:model="heroBackgroundImageFile" accept="image/png,image/jpeg,image/webp" class="block w-full text-xs text-slate-400 file:mr-2.5 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-500 cursor-pointer bg-slate-900 rounded-xl border border-slate-800 p-1">
                            <div wire:loading wire:target="heroBackgroundImageFile" class="text-[11px] text-blue-400 font-bold flex items-center gap-1.5 mt-1">
                                <i class="fa-solid fa-spinner animate-spin"></i> Uploading Background Image...
                            </div>
                            @error('heroBackgroundImageFile') <span class="text-rose-400 text-[10px] block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Direct Image URL Input -->
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Or Paste Background Image URL</label>
                            <input type="text" wire:model.live.debounce.300ms="heroBackgroundImageUrl" placeholder="https://images.unsplash.com/photo-..." class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-1.5 text-xs text-white font-mono focus:border-blue-500 focus:outline-none">
                        </div>

                        <!-- Curated Preset Backgrounds -->
                        <div class="pt-2 border-t border-slate-800/80">
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Preset Background Wallpapers:</span>
                            <div class="grid grid-cols-2 gap-1.5 text-[10px]">
                                <button type="button" wire:click="$set('heroBackgroundImageUrl', 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1200&auto=format&fit=crop&q=80')" class="px-2 py-1 rounded bg-slate-900 hover:bg-slate-800 border border-slate-800 text-slate-300 text-left truncate transition">
                                    🎓 Student Campus
                                </button>
                                <button type="button" wire:click="$set('heroBackgroundImageUrl', 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1200&auto=format&fit=crop&q=80')" class="px-2 py-1 rounded bg-slate-900 hover:bg-slate-800 border border-slate-800 text-slate-300 text-left truncate transition">
                                    🏫 Modern Institute
                                </button>
                                <button type="button" wire:click="$set('heroBackgroundImageUrl', 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=1200&auto=format&fit=crop&q=80')" class="px-2 py-1 rounded bg-slate-900 hover:bg-slate-800 border border-slate-800 text-slate-300 text-left truncate transition">
                                    💻 Tech Lab Hub
                                </button>
                                <button type="button" wire:click="$set('heroBackgroundImageUrl', 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1200&auto=format&fit=crop&q=80')" class="px-2 py-1 rounded bg-slate-900 hover:bg-slate-800 border border-slate-800 text-slate-300 text-left truncate transition">
                                    🌌 Dark Cyber Matrix
                                </button>
                            </div>
                        </div>

                        <!-- Darkness / Contrast Tint Control -->
                        <div class="pt-2 border-t border-slate-800/80 space-y-1.5">
                            <div class="flex items-center justify-between text-[10px] font-bold text-slate-300">
                                <span class="flex items-center gap-1">
                                    <i class="fa-solid fa-circle-half-stroke text-blue-400"></i>
                                    <span>Background Darkness Tint</span>
                                </span>
                                <span class="text-cyan-400 font-mono font-bold">{{ $heroBgDarkness }}%</span>
                            </div>
                            <div class="grid grid-cols-3 gap-1.5 text-[10px]">
                                <button type="button" wire:click="$set('heroBgDarkness', 35)" class="py-1 px-2 rounded-lg border text-center font-bold transition {{ $heroBgDarkness == 35 ? 'bg-blue-600 border-blue-500 text-white shadow' : 'bg-slate-900 border-slate-800 text-slate-400 hover:text-white' }}">
                                    Clear (35%)
                                </button>
                                <button type="button" wire:click="$set('heroBgDarkness', 60)" class="py-1 px-2 rounded-lg border text-center font-bold transition {{ $heroBgDarkness == 60 ? 'bg-blue-600 border-blue-500 text-white shadow' : 'bg-slate-900 border-slate-800 text-slate-400 hover:text-white' }}">
                                    Medium (60%)
                                </button>
                                <button type="button" wire:click="$set('heroBgDarkness', 80)" class="py-1 px-2 rounded-lg border text-center font-bold transition {{ $heroBgDarkness == 80 ? 'bg-blue-600 border-blue-500 text-white shadow' : 'bg-slate-900 border-slate-800 text-slate-400 hover:text-white' }}">
                                    Deep (80%)
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 2. LIVE URGENT TICKER STRIP -->
                    <div class="p-3.5 rounded-2xl bg-slate-950 border border-slate-800 space-y-2.5 shadow-sm">
                        <label class="block text-[11px] font-bold text-white uppercase tracking-wider">Top Urgent Exam Window Ticker</label>
                        <input type="text" wire:model.live.debounce.300ms="heroTickerText" placeholder="NEET 2026: 42 Days Left • JEE Main All-India Mock 04 Live" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:border-blue-500 focus:outline-none font-medium">
                    </div>

                    <!-- 3. TOP BADGES & RIBBONS -->
                    <div class="p-3.5 rounded-2xl bg-slate-950 border border-slate-800 space-y-3 shadow-sm">
                        <label class="block text-[11px] font-bold text-white uppercase tracking-wider">Hero Badges &amp; Ribbons</label>
                        
                        <div>
                            <label class="block text-[10px] text-slate-400 mb-1">Top Pill Badge</label>
                            <input type="text" wire:model.live.debounce.300ms="heroBadge" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-blue-300 focus:border-blue-500 focus:outline-none font-semibold">
                        </div>

                        <div>
                            <label class="block text-[10px] text-slate-400 mb-1">Topper Ribbon / Gold Badge</label>
                            <input type="text" wire:model.live.debounce.300ms="heroSubBadge" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-amber-300 focus:border-blue-500 focus:outline-none font-semibold">
                        </div>
                    </div>

                    <!-- 4. HEADLINE & HIGHLIGHT -->
                    <div class="p-3.5 rounded-2xl bg-slate-950 border border-slate-800 space-y-3 shadow-sm">
                        <label class="block text-[11px] font-bold text-white uppercase tracking-wider">Main Headline &amp; Copy</label>

                        <div>
                            <label class="block text-[10px] text-slate-400 mb-1">Headline Text</label>
                            <input type="text" wire:model.live.debounce.300ms="heroHeadline" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white font-bold focus:border-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-[10px] text-slate-400 mb-1">Gradient Highlighted Keyword</label>
                            <input type="text" wire:model.live.debounce.300ms="heroHighlight" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-cyan-300 font-bold focus:border-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-[10px] text-slate-400 mb-1">Subheadline / Paragraph Description</label>
                            <textarea wire:model.live.debounce.300ms="heroSubheadline" rows="3" class="w-full bg-slate-900 border border-slate-800 rounded-xl p-2.5 text-xs text-slate-200 focus:border-blue-500 focus:outline-none"></textarea>
                        </div>
                    </div>

                    <!-- 5. 4 KEY METRIC STAT CHIPS -->
                    <div class="p-3.5 rounded-2xl bg-slate-950 border border-slate-800 space-y-3 shadow-sm">
                        <label class="block text-[11px] font-bold text-white uppercase tracking-wider">4 Key Metric Stat Chips</label>
                        
                        <div class="grid grid-cols-2 gap-2.5">
                            <div class="p-2 rounded-xl bg-slate-900 border border-slate-800 space-y-1">
                                <span class="text-[10px] font-bold text-cyan-400 block">Stat #1</span>
                                <input type="text" wire:model.live.debounce.300ms="heroStat1Value" placeholder="150+" class="w-full bg-slate-950 border border-slate-800 rounded-lg px-2 py-1 text-xs text-cyan-300 font-mono font-bold">
                                <input type="text" wire:model.live.debounce.300ms="heroStat1Label" placeholder="Chapter Tests" class="w-full bg-slate-950 border border-slate-800 rounded-lg px-2 py-1 text-[11px] text-slate-300">
                            </div>

                            <div class="p-2 rounded-xl bg-slate-900 border border-slate-800 space-y-1">
                                <span class="text-[10px] font-bold text-emerald-400 block">Stat #2</span>
                                <input type="text" wire:model.live.debounce.300ms="heroStat2Value" placeholder="35 Full" class="w-full bg-slate-950 border border-slate-800 rounded-lg px-2 py-1 text-xs text-emerald-300 font-mono font-bold">
                                <input type="text" wire:model.live.debounce.300ms="heroStat2Label" placeholder="AIR Mock Tests" class="w-full bg-slate-950 border border-slate-800 rounded-lg px-2 py-1 text-[11px] text-slate-300">
                            </div>

                            <div class="p-2 rounded-xl bg-slate-900 border border-slate-800 space-y-1">
                                <span class="text-[10px] font-bold text-amber-400 block">Stat #3</span>
                                <input type="text" wire:model.live.debounce.300ms="heroStat3Value" placeholder="100%" class="w-full bg-slate-950 border border-slate-800 rounded-lg px-2 py-1 text-xs text-amber-300 font-mono font-bold">
                                <input type="text" wire:model.live.debounce.300ms="heroStat3Label" placeholder="Video Solutions" class="w-full bg-slate-950 border border-slate-800 rounded-lg px-2 py-1 text-[11px] text-slate-300">
                            </div>

                            <div class="p-2 rounded-xl bg-slate-900 border border-slate-800 space-y-1">
                                <span class="text-[10px] font-bold text-indigo-400 block">Stat #4</span>
                                <input type="text" wire:model.live.debounce.300ms="heroStat4Value" placeholder="AIR Radar" class="w-full bg-slate-950 border border-slate-800 rounded-lg px-2 py-1 text-xs text-indigo-300 font-mono font-bold">
                                <input type="text" wire:model.live.debounce.300ms="heroStat4Label" placeholder="Instant Rank" class="w-full bg-slate-950 border border-slate-800 rounded-lg px-2 py-1 text-[11px] text-slate-300">
                            </div>
                        </div>
                    </div>

                    <!-- 6. CALL TO ACTION BUTTONS -->
                    <div class="p-3.5 rounded-2xl bg-slate-950 border border-slate-800 space-y-3 shadow-sm">
                        <span class="block font-bold text-white text-[11px] uppercase tracking-wider">Call-to-Action (CTA) Buttons</span>
                        
                        <div>
                            <label class="block text-[10px] text-slate-400 mb-1">Primary CTA Button Text</label>
                            <input type="text" wire:model.live.debounce.300ms="heroPrimaryCtaText" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white font-bold">
                        </div>

                        <div>
                            <label class="block text-[10px] text-slate-400 mb-1">Primary CTA Action / Link</label>
                            <input type="text" wire:model.live.debounce.300ms="heroPrimaryCtaLink" placeholder="#services" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-300 font-mono">
                        </div>

                        <div>
                            <label class="block text-[10px] text-slate-400 mb-1">Secondary CTA Button Text (WhatsApp)</label>
                            <input type="text" wire:model.live.debounce.300ms="heroSecondaryCtaText" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-emerald-300 font-bold">
                        </div>
                    </div>

                </div>
                @endif

                <!-- ============================================== -->
                <!-- 💰 TAB 3: PRICING & OFFERS                     -->
                <!-- ============================================== -->
                @if($activeEditorTab === 'pricing')
                <div class="space-y-4">
                    <div>
                        <h2 class="text-sm font-black text-white">Pricing &amp; Urgency Banner</h2>
                        <p class="text-slate-400 text-[11px] mt-0.5">Control discounted pricing, strikethrough MRP, discount percentage, and delivery promises.</p>
                    </div>

                    <div class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-300 mb-1">Sale Price (₹)</label>
                                <input type="text" wire:model.live.debounce.300ms="pricingSalePrice" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-emerald-400 font-bold font-mono">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-300 mb-1">Regular MRP (₹)</label>
                                <input type="text" wire:model.live.debounce.300ms="pricingRegularPrice" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-400 line-through font-mono">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Discount Tag (e.g. 75% OFF TODAY)</label>
                            <input type="text" wire:model.live.debounce.300ms="pricingDiscountTag" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-rose-400 font-bold uppercase">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Offer &amp; Delivery Promise Subtext</label>
                            <input type="text" wire:model.live.debounce.300ms="pricingOfferSubtext" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-200">
                        </div>
                    </div>
                </div>
                @endif

                <!-- ============================================== -->
                <!-- 🏆 TAB 4: TRUST PILLARS (4 CARDS)             -->
                <!-- ============================================== -->
                @if($activeEditorTab === 'trust')
                <div class="space-y-4">
                    <div>
                        <h2 class="text-sm font-black text-white">Trust Highlights (4 Pillars)</h2>
                        <p class="text-slate-400 text-[11px] mt-0.5">Customize the 4 credibility cards shown directly under your hero section.</p>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Section Heading</label>
                            <input type="text" wire:model.live.debounce.300ms="trustHeading" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Subheading</label>
                            <input type="text" wire:model.live.debounce.300ms="trustSubheading" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-300">
                        </div>

                        <div class="space-y-3 pt-2">
                            @foreach($trustCards as $cIdx => $card)
                            <div class="p-3 rounded-xl bg-slate-950 border border-slate-800 space-y-2">
                                <span class="font-bold text-blue-400 text-[11px]">Pillar #{{ $cIdx + 1 }}</span>
                                <div>
                                    <input type="text" wire:model.live.debounce.300ms="trustCards.{{ $cIdx }}.title" placeholder="Pillar Title" class="w-full bg-slate-900 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-white font-bold">
                                </div>
                                <div>
                                    <textarea wire:model.live.debounce.300ms="trustCards.{{ $cIdx }}.desc" rows="2" placeholder="Description" class="w-full bg-slate-900 border border-slate-800 rounded-lg p-2 text-xs text-slate-300"></textarea>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- ============================================== -->
                <!-- 💬 TAB 5: CONTACT & INQUIRY FORM              -->
                <!-- ============================================== -->
                @if($activeEditorTab === 'inquiry')
                <div class="space-y-4">
                    <div>
                        <h2 class="text-sm font-black text-white">Contact &amp; Inquiry Form</h2>
                        <p class="text-slate-400 text-[11px] mt-0.5">Customize your lead capture form and WhatsApp inquiry button.</p>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Tagline</label>
                            <input type="text" wire:model.live.debounce.300ms="inquiryTitle" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Main Heading</label>
                            <input type="text" wire:model.live.debounce.300ms="inquiryHeading" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-300 mb-1">Submit Button Text</label>
                            <input type="text" wire:model.live.debounce.300ms="inquiryButtonText" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-emerald-400 font-bold">
                        </div>
                    </div>
                </div>
                @endif

                <!-- ============================================== -->
                <!-- 💎 TAB: BRANDING & LOGO                        -->
                <!-- ============================================== -->
                @if($activeEditorTab === 'branding')
                <div class="space-y-5">
                    <div>
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-black text-white">Brand Identity &amp; Logo</h2>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-blue-950 text-blue-300 border border-blue-800">
                                {{ $tenant->business_category ?: 'Business' }}
                            </span>
                        </div>
                        <p class="text-slate-400 text-[11px] mt-0.5">Upload your company logo, set your primary brand accent, and toggle theme mode.</p>
                    </div>

                    <!-- 1. Logo Customization -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 space-y-3.5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <label class="block text-[11px] font-bold text-white">Company / Store Logo</label>
                            @if($logoUrl)
                                <button type="button" wire:click="removeLogo" wire:confirm="Remove your custom logo?" class="text-rose-400 hover:text-rose-300 text-[10px] font-bold flex items-center gap-1 transition">
                                    <i class="fa-solid fa-trash"></i> Remove Logo
                                </button>
                            @endif
                        </div>

                        <!-- Current Logo Preview -->
                        <div class="p-4 rounded-xl border border-dashed border-slate-700 bg-slate-900/60 flex flex-col items-center justify-center text-center gap-2">
                            @if($logoUrl)
                                <img src="{{ $logoUrl }}" alt="{{ $tenant->business_name }}" class="h-14 max-w-[220px] object-contain rounded-lg p-1 bg-white/5 border border-slate-800 shadow-sm">
                                <span class="text-[10px] text-emerald-400 font-bold flex items-center gap-1">
                                    <i class="fa-solid fa-circle-check"></i> Custom Logo Active on Store
                                </span>
                            @else
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-md" style="background: linear-gradient(135deg, {{ $brandColor }}, #9333ea);">
                                    {{ strtoupper(substr($tenant->business_name, 0, 1)) }}
                                </div>
                                <span class="text-[11px] text-slate-400 font-medium">Standard letter badge in use. Upload a real logo below.</span>
                            @endif
                        </div>

                        <!-- File Upload -->
                        <div class="space-y-1.5">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Upload Logo File (PNG, JPG, SVG, WebP)</label>
                            <input type="file" wire:model="logoFile" accept="image/png,image/jpeg,image/svg+xml,image/webp" class="block w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-500 cursor-pointer bg-slate-900 rounded-xl border border-slate-800 p-1">
                            <div wire:loading wire:target="logoFile" class="text-xs text-blue-400 font-bold flex items-center gap-2 mt-1">
                                <i class="fa-solid fa-spinner animate-spin"></i> Uploading &amp; Publishing Logo...
                            </div>
                            @error('logoFile') <span class="text-rose-400 text-[11px] block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Direct Image URL Alternative -->
                        <div class="pt-2 border-t border-slate-800/80 space-y-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Or Paste Logo Image URL</label>
                            <input type="text" wire:model.live.debounce.400ms="logoUrl" placeholder="https://example.com/logo.png" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:border-blue-500 focus:outline-none font-mono">
                        </div>
                    </div>

                    <!-- 2. Brand Primary Color & Presets -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 space-y-3 shadow-sm">
                        <label class="block text-[11px] font-bold text-white">Primary Brand Accent Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" wire:model.live="brandColor" class="w-10 h-10 rounded-xl bg-transparent border border-slate-700 cursor-pointer">
                            <input type="text" wire:model.live="brandColor" class="w-32 bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white font-mono uppercase font-bold">
                        </div>

                        <!-- Quick Color Swatches -->
                        <div class="pt-2 border-t border-slate-800/80">
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Popular Color Presets</span>
                            <div class="flex items-center gap-2 flex-wrap">
                                <button type="button" wire:click="$set('brandColor', '#2563EB')" class="w-6 h-6 rounded-full bg-blue-600 border-2 {{ $brandColor === '#2563EB' ? 'border-white scale-110 shadow-md' : 'border-transparent' }}" title="Royal Blue"></button>
                                <button type="button" wire:click="$set('brandColor', '#16A34A')" class="w-6 h-6 rounded-full bg-emerald-600 border-2 {{ $brandColor === '#16A34A' ? 'border-white scale-110 shadow-md' : 'border-transparent' }}" title="Emerald Green"></button>
                                <button type="button" wire:click="$set('brandColor', '#DB2777')" class="w-6 h-6 rounded-full bg-pink-600 border-2 {{ $brandColor === '#DB2777' ? 'border-white scale-110 shadow-md' : 'border-transparent' }}" title="Rose Pink"></button>
                                <button type="button" wire:click="$set('brandColor', '#EA580C')" class="w-6 h-6 rounded-full bg-orange-600 border-2 {{ $brandColor === '#EA580C' ? 'border-white scale-110 shadow-md' : 'border-transparent' }}" title="Sunset Orange"></button>
                                <button type="button" wire:click="$set('brandColor', '#D97706')" class="w-6 h-6 rounded-full bg-amber-600 border-2 {{ $brandColor === '#D97706' ? 'border-white scale-110 shadow-md' : 'border-transparent' }}" title="Luxury Gold"></button>
                                <button type="button" wire:click="$set('brandColor', '#7C3AED')" class="w-6 h-6 rounded-full bg-purple-600 border-2 {{ $brandColor === '#7C3AED' ? 'border-white scale-110 shadow-md' : 'border-transparent' }}" title="Royal Purple"></button>
                                <button type="button" wire:click="$set('brandColor', '#0284C7')" class="w-6 h-6 rounded-full bg-sky-600 border-2 {{ $brandColor === '#0284C7' ? 'border-white scale-110 shadow-md' : 'border-transparent' }}" title="Ocean Sky"></button>
                                <button type="button" wire:click="$set('brandColor', '#475569')" class="w-6 h-6 rounded-full bg-slate-600 border-2 {{ $brandColor === '#475569' ? 'border-white scale-110 shadow-md' : 'border-transparent' }}" title="Industrial Slate"></button>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Theme Mode (Dark / Light) -->
                    <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 space-y-2.5 shadow-sm">
                        <label class="block text-[11px] font-bold text-white">Canvas Mood / Theme Mode</label>
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" wire:click="$set('themeMode', 'dark')" class="p-3 rounded-xl border text-center transition {{ $themeMode === 'dark' ? 'bg-blue-600/30 border-blue-500 text-blue-300 font-bold shadow' : 'bg-slate-900 border-slate-800 text-slate-400 hover:text-white' }}">
                                <i class="fa-solid fa-moon mb-1 text-base block text-blue-400"></i> Dark Cyber
                            </button>
                            <button type="button" wire:click="$set('themeMode', 'light')" class="p-3 rounded-xl border text-center transition {{ $themeMode === 'light' ? 'bg-blue-600/30 border-blue-500 text-blue-300 font-bold shadow' : 'bg-slate-900 border-slate-800 text-slate-400 hover:text-white' }}">
                                <i class="fa-solid fa-sun mb-1 text-base block text-amber-400"></i> Clean Light
                            </button>
                        </div>
                    </div>

                </div>
                @endif

            </div>
            @endif

            <!-- Footer Status Bar -->
            <div class="p-3 bg-slate-950 border-t border-slate-800 text-[11px] text-slate-400 flex items-center justify-between shrink-0">
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Live Sync Active</span>
                </span>
                <button wire:click="saveCustomizations" class="text-emerald-400 hover:underline font-bold">Publish Changes &rarr;</button>
            </div>

        </aside>

                <!-- ============================================== -->
        <!-- 🖥️ RIGHT REAL-TIME INTERACTIVE LIVE PREVIEW     -->
        <!-- ============================================== -->
        <main class="flex-1 bg-slate-950 flex flex-col items-center justify-start p-2 sm:p-4 overflow-hidden relative"
              x-data="{
                  refreshIframe() {
                      const f = document.getElementById('store-live-preview-frame');
                      if (f) {
                          f.src = '{{ route('store.show', $tenant->slug) }}?in_editor=1&theme={{ $activeTheme }}&t=' + Date.now();
                      }
                  }
              }"
              @refresh-preview.window="refreshIframe()">
            
            <!-- Canvas Window Wrapper -->
            <div class="h-full w-full flex flex-col items-center justify-start transition-all duration-300">
                
                @if($deviceMode === 'desktop')
                <!-- 💻 Desktop Viewport: Full Edge-to-Edge Canvas -->
                <div class="w-full h-full bg-slate-900 rounded-2xl shadow-2xl border border-slate-800/80 overflow-hidden flex flex-col">
                    <!-- Sleek Viewport URL & Control Bar -->
                    <div class="h-9 bg-slate-900 border-b border-slate-800 px-4 flex items-center justify-between text-xs text-slate-400 select-none shrink-0">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
                            <span class="text-[10px] font-bold text-slate-500 ml-2 uppercase tracking-wider">Live Storefront</span>
                        </div>
                        <div class="bg-slate-950 border border-slate-800 px-3.5 py-0.5 rounded-lg text-[11px] font-mono text-slate-300 flex items-center gap-2 shadow-inner">
                            <i class="fa-solid fa-lock text-emerald-400 text-[10px]"></i>
                            <span>{{ url('/store/' . $tenant->slug) }}?theme={{ $activeTheme }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="refreshIframe()" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold transition flex items-center gap-1.5 shadow-sm" title="Reload Live Preview">
                                <i class="fa-solid fa-rotate-right text-[11px]"></i> <span>Reload</span>
                            </button>
                            <a href="{{ route('store.show', $tenant->slug) }}?theme={{ $activeTheme }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-blue-600/20 hover:bg-blue-600/30 text-blue-400 text-xs font-bold transition flex items-center gap-1.5" title="Open Storefront in New Tab">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> <span>Live Site</span>
                            </a>
                        </div>
                    </div>

                    <!-- REAL LIVE WEBSITE IFRAME -->
                    <div class="flex-1 w-full bg-white relative overflow-hidden">
                        <iframe id="store-live-preview-frame" src="{{ route('store.show', $tenant->slug) }}?in_editor=1&theme={{ $activeTheme }}" class="w-full h-full border-0" title="Real Live Storefront Preview"></iframe>
                    </div>
                </div>

                @elseif($deviceMode === 'tablet')
                <!-- 📟 Tablet Viewport: iPad Frame -->
                <div class="w-[768px] h-full max-h-[96vh] bg-slate-900 rounded-[36px] p-3 shadow-2xl border-4 border-slate-800 flex flex-col my-auto">
                    <!-- Top Bar -->
                    <div class="h-7 flex items-center justify-between px-3 text-[10px] text-slate-400 shrink-0">
                        <div class="flex items-center gap-1.5 font-bold">
                            <i class="fa-solid fa-tablet-screen-button text-blue-400"></i>
                            <span>iPad View (768px)</span>
                        </div>
                        <button @click="refreshIframe()" class="hover:text-white transition flex items-center gap-1 font-bold">
                            <i class="fa-solid fa-rotate-right text-[10px]"></i> <span>Reload</span>
                        </button>
                    </div>
                    <div class="flex-1 w-full bg-white rounded-2xl overflow-hidden shadow-inner">
                        <iframe id="store-live-preview-frame" src="{{ route('store.show', $tenant->slug) }}?in_editor=1&theme={{ $activeTheme }}" class="w-full h-full border-0" title="Live Storefront Tablet Preview"></iframe>
                    </div>
                </div>

                @else
                <!-- 📱 Mobile Viewport: Sleek iPhone Frame -->
                <div class="w-[390px] h-full max-h-[844px] bg-slate-900 rounded-[48px] p-2.5 shadow-2xl border-[6px] border-slate-800 flex flex-col relative my-auto">
                    <!-- Dynamic Island Notch -->
                    <div class="w-28 h-4 bg-slate-950 rounded-full mx-auto mb-2 shrink-0 flex items-center justify-center">
                        <div class="w-2 h-2 rounded-full bg-slate-800 ml-auto mr-3"></div>
                    </div>
                    <!-- Screen -->
                    <div class="flex-1 w-full bg-white rounded-[38px] overflow-hidden shadow-inner">
                        <iframe id="store-live-preview-frame" src="{{ route('store.show', $tenant->slug) }}?in_editor=1&theme={{ $activeTheme }}" class="w-full h-full border-0" title="Live Storefront Mobile Preview"></iframe>
                    </div>
                    <div class="py-1.5 text-center">
                        <button @click="refreshIframe()" class="text-[11px] font-bold text-slate-400 hover:text-white transition flex items-center justify-center gap-1 mx-auto">
                            <i class="fa-solid fa-rotate-right text-[10px]"></i> <span>Reload</span>
                        </button>
                    </div>
                </div>
                @endif

            </div>

        </main>

    </div>

</div>
