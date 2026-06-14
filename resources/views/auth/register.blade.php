<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-rose-100 via-white to-pink-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">

        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-rose-300/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-pink-300/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>

        <div class="mb-8 text-center relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-700">
            <div class="h-20 w-20 bg-gradient-to-br from-rose-400 to-pink-500 rounded-2xl shadow-xl shadow-rose-500/30 flex items-center justify-center text-4xl mx-auto mb-6 transform rotate-6 hover:rotate-0 transition-all duration-300 cursor-pointer">
                <a href="/" class="block">🌸</a>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Create Account</h2>
            <p class="text-slate-500 font-medium text-lg">Join PureBlooms and start ordering.</p>
        </div>

        <div class="w-full sm:max-w-md bg-white/80 backdrop-blur-xl border border-white shadow-[0_8px_30px_rgb(0,0,0,0.08)] rounded-3xl p-8 relative z-10">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Name</label>
                    <input id="name"
                           class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-colors bg-white/50 backdrop-blur-sm"
                           type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required autofocus
                           placeholder="Your name"
                           autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold text-rose-500" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                    <input id="email"
                           class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-colors bg-white/50 backdrop-blur-sm"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           placeholder="your@email.com"
                           autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-rose-500" />
                </div>

                <div>
                    <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">Phone Number</label>
                    <input id="phone"
                           class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-colors bg-white/50 backdrop-blur-sm"
                           type="tel"
                           name="phone"
                           value="{{ old('phone') }}"
                           placeholder="e.g., 09123456789"
                           autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2 text-xs font-bold text-rose-500" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                    <input id="password"
                           class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-colors bg-white/50 backdrop-blur-sm"
                           type="password"
                           name="password"
                           required
                           placeholder="••••••••"
                           autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-rose-500" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Confirm Password</label>
                    <input id="password_confirmation"
                           class="block w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-colors bg-white/50 backdrop-blur-sm"
                           type="password"
                           name="password_confirmation"
                           required
                           placeholder="••••••••"
                           autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold text-rose-500" />
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-rose-500/30 text-base font-bold text-white bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-300 transform hover:-translate-y-0.5">
                        {{ __('Create Account') }}
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-500 font-medium">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-rose-600 font-bold hover:text-rose-700 hover:underline transition-colors">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
