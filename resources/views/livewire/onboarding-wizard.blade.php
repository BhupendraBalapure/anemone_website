<div class="min-h-screen bg-slate-50 flex flex-col justify-center py-10 px-4 sm:px-6 lg:px-8">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-2xl text-center mb-8">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-tr from-amber-400 via-rose-500 to-purple-600 text-white shadow-lg shadow-purple-500/20 mb-3">
            <i class="fa-solid fa-rocket text-xl"></i>
        </div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Launch Your Digital Presence in 60 Seconds</h2>
        <p class="mt-2 text-sm text-slate-600">Category-aware website, auto local SEO, dynamic WhatsApp CTA, & digital billing.</p>
        
        <!-- Step Progress Indicator -->
        <div class="flex items-center justify-center gap-4 mt-6">
            <div class="flex items-center gap-2">
                <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold {{ $step >= 1 ? 'bg-gradient-to-r from-rose-500 to-purple-600 text-white shadow' : 'bg-slate-200 text-slate-600' }}">1</span>
                <span class="text-xs font-semibold {{ $step >= 1 ? 'text-slate-900' : 'text-slate-400' }}">Business Details</span>
            </div>
            <div class="w-8 h-0.5 {{ $step >= 2 ? 'bg-gradient-to-r from-rose-500 to-purple-600' : 'bg-slate-200' }}"></div>
            <div class="flex items-center gap-2">
                <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold {{ $step >= 2 ? 'bg-gradient-to-r from-rose-500 to-purple-600 text-white shadow' : 'bg-slate-200 text-slate-600' }}">2</span>
                <span class="text-xs font-semibold {{ $step >= 2 ? 'text-slate-900' : 'text-slate-400' }}">Category Archetype</span>
            </div>
            <div class="w-8 h-0.5 {{ $step >= 3 ? 'bg-gradient-to-r from-rose-500 to-purple-600' : 'bg-slate-200' }}"></div>
            <div class="flex items-center gap-2">
                <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold {{ $step >= 3 ? 'bg-gradient-to-r from-rose-500 to-purple-600 text-white shadow' : 'bg-slate-200 text-slate-600' }}">3</span>
                <span class="text-xs font-semibold {{ $step >= 3 ? 'text-slate-900' : 'text-slate-400' }}">Theme & Colors</span>
            </div>
        </div>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
        <div class="bg-white py-8 px-6 shadow-xl rounded-3xl sm:px-10 border border-slate-200/80">
            
            <!-- STEP 1: Business Details -->
            @if($step === 1)
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">Tell Us About Your Business</h3>
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Business / Brand Name *</label>
                    <input wire:model="businessName" type="text" placeholder="e.g. Royal Bakery, Care Dental Clinic, Apex Textiles" class="input-field">
                    @error('businessName') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">City / Town *</label>
                        <input wire:model="city" type="text" placeholder="e.g. Mumbai, Kanpur, Jaipur" class="input-field">
                        @error('city') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Mobile / WhatsApp Number *</label>
                        <input wire:model="phone" type="tel" placeholder="e.g. 9876543210" class="input-field">
                        @error('phone') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Short Tagline (Optional)</label>
                    <input wire:model="tagline" type="text" placeholder="e.g. Fresh Daily Sweets & Catering Services" class="input-field">
                </div>

                <div class="pt-4 flex justify-end">
                    <button wire:click="nextStep" class="btn-brand-gradient text-white font-bold text-sm px-6 py-3 rounded-xl shadow-lg shadow-purple-500/25 transition hover:scale-[1.02] active:scale-[0.98] flex items-center gap-2 cursor-pointer">
                        Next: Choose Industry Category <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            @endif

            <!-- STEP 2: Category Archetype Selection (Industry Tree) -->
            @if($step === 2)
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">Select Your Business Archetype</h3>
                <p class="text-xs text-slate-500">Choosing your archetype automatically customizes your Action Buttons (CTA), Catalog Fields, and Google SEO schema.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    @foreach($archetypes as $arch)
                    <div wire:click="selectArchetype('{{ $arch->code }}')" class="p-4 rounded-2xl border-2 cursor-pointer transition flex flex-col justify-between {{ $selectedArchetypeCode === $arch->code ? 'border-purple-600 bg-purple-50/40 ring-2 ring-purple-500/20' : 'border-slate-200 hover:border-slate-300' }}">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold uppercase tracking-wider px-2 py-0.5 rounded {{ $selectedArchetypeCode === $arch->code ? 'bg-gradient-to-r from-rose-500 to-purple-600 text-white' : 'bg-slate-100 text-slate-700' }}">
                                    {{ $arch->code }}
                                </span>
                                @if($selectedArchetypeCode === $arch->code)
                                <i class="fa-solid fa-circle-check text-purple-600"></i>
                                @endif
                            </div>
                            <h4 class="font-bold text-sm text-slate-900 mb-1">{{ $arch->name }}</h4>
                            <p class="text-xs text-slate-500 mb-3">{{ $arch->description }}</p>
                        </div>
                        <div class="text-[11px] font-semibold text-purple-900 bg-white p-2 rounded-lg border border-purple-100">
                            <strong>Default CTA:</strong> {{ $arch->cta_label }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pt-4 flex justify-between">
                    <button wire:click="prevStep" class="px-5 py-2.5 border border-slate-300 bg-white text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 transition cursor-pointer">
                        Back
                    </button>
                    <button wire:click="nextStep" class="btn-brand-gradient text-white font-bold text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-purple-500/25 transition hover:scale-[1.02] active:scale-[0.98] flex items-center gap-2 cursor-pointer">
                        Next: Styling & Colors <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            @endif

            <!-- STEP 3: Themes & Brand Colors -->
            @if($step === 3)
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">Final Touches: Brand Colors & Layout</h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">Primary Brand Color</label>
                    <div class="flex items-center gap-3">
                        @foreach(['#9333EA' => 'Vivid Purple', '#F43F5E' => 'Rose Flame', '#FB923C' => 'Amber Sun', '#3B82F6' => 'Indigo Blue', '#10B981' => 'Emerald', '#0F172A' => 'Midnight'] as $hex => $colorName)
                        <button type="button" wire:click="$set('brandColor', '{{ $hex }}')" class="w-9 h-9 rounded-full flex items-center justify-center border-2 transition {{ $brandColor === $hex ? 'ring-4 ring-offset-2 ring-purple-300 border-white' : 'border-transparent' }}" style="background-color: {{ $hex }};">
                            @if($brandColor === $hex)
                            <i class="fa-solid fa-check text-white text-xs"></i>
                            @endif
                        </button>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2">Select Initial Visual Theme</label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach(['modern_clean' => 'Modern Clean', 'minimal_card' => 'Minimal Card', 'dark_luxury' => 'Dark Luxury'] as $tKey => $tName)
                        <div wire:click="$set('selectedTheme', '{{ $tKey }}')" class="p-3 rounded-xl border-2 cursor-pointer text-center transition {{ $selectedTheme === $tKey ? 'border-purple-600 bg-purple-50 text-purple-900 font-bold' : 'border-slate-200 text-slate-700 hover:border-slate-300' }}">
                            <div class="text-xs font-semibold">{{ $tName }}</div>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-[11px] text-slate-400 mt-2">
                        <i class="fa-solid fa-circle-info"></i> You can freely change themes anytime from the dashboard without losing catalog items.
                    </p>
                </div>

                <div class="pt-6 flex justify-between">
                    <button wire:click="prevStep" class="px-5 py-2.5 border border-slate-300 bg-white text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 transition cursor-pointer">
                        Back
                    </button>
                    <button wire:click="createStore" class="btn-brand-gradient text-white font-bold text-sm px-7 py-3 rounded-xl shadow-xl shadow-purple-500/25 transition hover:scale-[1.02] active:scale-[0.98] flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-bolt"></i> Launch Store Now
                    </button>
                </div>
            </div>
            @endif

        </div>

        <!-- Live Demo Links -->
        <div class="mt-8 text-center text-xs text-slate-500">
            <span class="font-bold text-slate-700">Instant Demo Previews:</span>
            <a href="{{ route('store.show', 'sharma-kirana') }}" wire:navigate class="ml-2 text-rose-600 font-bold underline">Sharma Kirana (Retail)</a> |
            <a href="{{ route('store.show', 'care-dental-clinic') }}" wire:navigate class="ml-2 text-purple-600 font-bold underline">Care Dental (Clinic)</a> |
            <a href="{{ route('store.show', 'apex-steel-craft') }}" wire:navigate class="ml-2 text-amber-600 font-bold underline">Apex Steel (B2B Factory)</a>
        </div>
    </div>

</div>
