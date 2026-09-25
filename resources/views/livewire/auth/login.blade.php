<div class="min-h-screen bg-slate-950 flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden text-slate-100">

    <!-- Ambient Cosmic Background Glows -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-600/15 rounded-full blur-3xl pointer-events-none -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-rose-600/15 rounded-full blur-3xl pointer-events-none translate-y-1/2"></div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10 px-4">
        <!-- Brand Logo Header -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl gradient-logo-swirl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-purple-500/25 group-hover:scale-105 transition-transform duration-300">
                    <i class="fa-solid fa-crown text-amber-300"></i>
                </div>
                <div class="text-left">
                    <span class="text-2xl font-black tracking-tight text-white">Anemony<span class="text-rose-500">.</span></span>
                    <span class="block text-[11px] font-bold text-purple-400 tracking-wider uppercase">Unified Cloud Auth</span>
                </div>
            </a>
            <h2 class="mt-6 text-2xl font-extrabold tracking-tight text-white">
                Sign in to your account
            </h2>
            <p class="mt-1 text-xs text-slate-400">
                Access your Super Admin command center or Merchant Studio
            </p>
        </div>

        <!-- ⚡ Quick Demo 1-Click Fill Buttons -->
        <div class="mt-6 bg-slate-900/80 border border-slate-800 p-3.5 rounded-2xl backdrop-blur-md">
            <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2 flex items-center gap-1.5">
                <i class="fa-solid fa-bolt text-amber-400"></i> 1-Click Quick Fill (Demo)
            </div>
            <div class="grid grid-cols-3 gap-2">
                <button 
                    type="button"
                    wire:click="fillCredentials('super_admin')" 
                    class="py-2 px-2.5 rounded-xl bg-purple-950/60 hover:bg-purple-900/80 border border-purple-800/60 text-purple-200 text-[11px] font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-crown text-amber-400 text-[10px]"></i> Admin
                </button>
                <button 
                    type="button"
                    wire:click="fillCredentials('merchant')" 
                    class="py-2 px-2.5 rounded-xl bg-slate-800 hover:bg-slate-700/80 border border-slate-700 text-slate-200 text-[11px] font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-store text-emerald-400 text-[10px]"></i> Sharma
                </button>
                <button 
                    type="button"
                    wire:click="fillCredentials('biztraffics')" 
                    class="py-2 px-2.5 rounded-xl bg-rose-950/60 hover:bg-rose-900/80 border border-rose-800/60 text-rose-200 text-[11px] font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-bolt text-amber-400 text-[10px]"></i> Biztraffics
                </button>
            </div>
        </div>

        <!-- Main Card -->
        <div class="mt-4 bg-slate-900/90 border border-slate-800/80 py-8 px-5 shadow-2xl rounded-2xl sm:px-10 backdrop-blur-xl">

            <!-- Flash Error Message -->
            @if($errorMessage)
            <div class="mb-5 p-3 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-semibold flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation text-rose-400 text-sm shrink-0"></i>
                <span>{{ $errorMessage }}</span>
            </div>
            @endif

            <form wire:submit.prevent="login" class="space-y-5">
                <!-- Email or Phone Field -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                        Email Address or Mobile Number
                    </label>
                    <div class="relative rounded-xl shadow-xs">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 text-sm">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <input 
                            wire:model="email" 
                            id="email" 
                            type="text" 
                            autocomplete="username" 
                            placeholder="admin@anemony.in or 8999355932"
                            required 
                            class="block w-full pl-10 pr-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-hidden focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition"
                        />
                    </div>
                    @error('email') 
                        <span class="text-rose-400 text-[11px] font-semibold mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                        Password
                    </label>
                    <div class="relative rounded-xl shadow-xs">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 text-sm">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input 
                            wire:model="password" 
                            id="password" 
                            type="{{ $showPassword ? 'text' : 'password' }}" 
                            autocomplete="current-password" 
                            placeholder="••••••••"
                            required 
                            class="block w-full pl-10 pr-10 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-hidden focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition"
                        />
                        <button 
                            type="button" 
                            wire:click="togglePassword" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-300 transition cursor-pointer text-sm">
                            <i class="fa-regular {{ $showPassword ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        </button>
                    </div>
                    @error('password') 
                        <span class="text-rose-400 text-[11px] font-semibold mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input 
                            wire:model="remember" 
                            type="checkbox" 
                            class="w-4 h-4 rounded-sm bg-slate-950 border-slate-800 text-purple-600 focus:ring-purple-500 focus:ring-offset-slate-900"
                        />
                        <span class="text-slate-400 font-medium">Remember me</span>
                    </label>

                    <a href="https://wa.me/919579214456?text=Hi%2C+I+need+help+logging+into+my+Anemony+account" target="_blank" class="text-purple-400 hover:text-purple-300 font-semibold transition">
                        Need Help?
                    </a>
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        wire:loading.attr="disabled"
                        class="w-full py-3 px-4 rounded-xl btn-brand-gradient text-white text-sm font-extrabold shadow-lg shadow-purple-500/20 transition hover:scale-[1.01] flex items-center justify-center gap-2 cursor-pointer">
                        <span wire:loading.remove>
                            Sign In to Platform <i class="fa-solid fa-arrow-right ml-1"></i>
                        </span>
                        <span wire:loading class="inline-flex items-center gap-2">
                            <i class="fa-solid fa-circle-notch fa-spin"></i> Authenticating...
                        </span>
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-5 border-t border-slate-800/80 text-center">
                <p class="text-xs text-slate-400">
                    Don't have an online store yet? 
                    <a href="{{ route('onboarding') }}" class="font-bold text-rose-400 hover:text-rose-300 transition">
                        Launch Store Free &rarr;
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home Link -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-300 transition flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Back to Anemony Home
            </a>
        </div>
    </div>
</div>
