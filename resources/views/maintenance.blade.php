<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Maintenance Mode - {{ config('app.name', 'PureBlooms') }}</title>
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        
        @vite(['resources/css/app.css'])
        
        <style>
            .maintenance-bg {
                background: linear-gradient(135deg, #f43f5e 0%, #ec4899 50%, #a855f7 100%);
                min-height: 100vh;
            }
            
            .float-animation {
                animation: float 6s ease-in-out infinite;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            
            .pulse-animation {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
            
            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="maintenance-bg flex items-center justify-center px-4">
            <div class="max-w-2xl w-full text-center">
                
                <!-- Animated Icon -->
                <div class="mb-8 float-animation">
                    <div class="inline-flex items-center justify-center w-32 h-32 bg-white/20 backdrop-blur-sm rounded-full border-4 border-white/30">
                        <span class="text-6xl">🌸</span>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 md:p-12 border border-white/20 shadow-2xl">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                        🌸 Under Maintenance
                    </h1>
                    
                    <p class="text-xl text-white/90 mb-8 leading-relaxed">
                        We're currently making improvements to bring you the freshest blooms. 
                        We'll be back shortly!
                    </p>
                    
                    <!-- Animated Dots -->
                    <div class="flex justify-center space-x-2 mb-8">
                        <div class="w-3 h-3 bg-white rounded-full pulse-animation"></div>
                        <div class="w-3 h-3 bg-white rounded-full pulse-animation" style="animation-delay: 0.2s"></div>
                        <div class="w-3 h-3 bg-white rounded-full pulse-animation" style="animation-delay: 0.4s"></div>
                    </div>
                    
                    <!-- Admin Login Link -->
                    <div class="bg-white/10 rounded-xl p-6 mb-6">
                        <p class="text-white/80 text-sm mb-4">
                            Are you an administrator? Access the admin panel below:
                        </p>
                        @if(auth()->guest())
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-rose-500 to-pink-500 text-white font-bold rounded-xl hover:from-rose-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Admin Login
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}" 
                               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-rose-500 to-pink-500 text-white font-bold rounded-xl hover:from-rose-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Go to Admin Dashboard
                            </a>
                        @endif
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="text-white/70 text-sm">
                        <p class="mb-2">
                            📧 For urgent inquiries: 
                            <a href="mailto:info@pureblooms.com" 
                               class="text-white hover:text-white/90 underline">
                                info@pureblooms.com
                            </a>
                        </p>
                        <p>
                            📱 Call us: +63 912 345 6789
                        </p>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="mt-8 text-white/60 text-sm">
                    <p>© {{ date('Y') }} {{ config('app.name', 'PureBlooms') }}. All rights reserved.</p>
                    <p class="mt-1">Thank you for your patience! 🌸</p>
                </div>
            </div>
        </div>
        
        <!-- Auto-refresh every 5 minutes -->
        <script>
            setTimeout(function() {
                window.location.reload();
            }, 300000); // 5 minutes
        </script>
    </body>
</html>
