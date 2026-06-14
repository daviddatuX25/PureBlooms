<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-rose-100 via-white to-pink-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-rose-300/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-pink-300/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>

        <div class="mb-8 text-center relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-700">
            <div class="h-20 w-20 bg-gradient-to-br from-rose-400 to-pink-500 rounded-2xl shadow-xl shadow-rose-500/30 flex items-center justify-center text-4xl mx-auto mb-6 transform -rotate-6 hover:rotate-0 transition-all duration-300 cursor-pointer">
                <a href="/" class="block">🌸</a>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Welcome Back</h2>
            <p class="text-slate-500 font-medium text-lg">The freshest blooms are waiting for you.</p>
        </div>

        <div class="w-full sm:max-w-md bg-white/80 backdrop-blur-xl border border-white shadow-[0_8px_30px_rgb(0,0,0,0.08)] rounded-3xl p-8 relative z-10">
            
            <x-auth-session-status class="mb-6 p-4 bg-rose-50 text-rose-700 rounded-xl border border-rose-200 text-sm font-semibold flex items-center" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input id="email" 
                               class="block w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-colors bg-white/50 backdrop-blur-sm" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required autofocus 
                               placeholder="your@email.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-rose-500" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                    
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" 
                               class="block w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-colors bg-white/50 backdrop-blur-sm"
                               type="password"
                               name="password"
                               required 
                               placeholder="••••••••" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-rose-500" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <div class="relative flex items-center">
                            <input id="remember_me" type="checkbox" class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-slate-300 checked:border-rose-500 checked:bg-rose-500 transition-all" name="remember">
                            <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </div>
                        <span class="ms-3 text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">{{ __('Keep me signed in') }}</span>
                    </label>
                    
                    <a href="{{ route('password.request') }}" class="text-sm text-rose-600 hover:text-rose-700 font-medium hover:underline transition-colors">
                        {{ __('Forgot Password?') }}
                    </a>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-4.5 px-4 border border-transparent rounded-xl shadow-lg shadow-rose-500/30 text-lg font-bold text-white bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-300 transform hover:-translate-y-0.5">
                        {{ __('Sign In') }}
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-500 font-medium">
                    New to PureBlooms? 
                    <a href="{{ route('register') }}" class="text-rose-600 font-bold hover:text-rose-700 hover:underline transition-colors">Create an account</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>