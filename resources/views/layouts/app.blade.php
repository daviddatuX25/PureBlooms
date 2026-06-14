<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Prevent Back Navigation Script -->
        <script>
            // Prevent back navigation after logout
            (function() {
                if (window.history && window.history.pushState) {
                    // Clear all history when user logs out
                    function clearHistory() {
                        // Push current state to replace history
                        history.pushState(null, null, location.href);
                        
                        // Add more states to push back the logout page
                        history.pushState(null, null, location.href);
                        history.pushState(null, null, location.href);
                    }
                    
                    // Listen for back button
                    window.addEventListener('popstate', function(e) {
                        // Check if user is logged out by checking if we're on login page
                        if (window.location.pathname.includes('/login')) {
                            // If on login page and user tries to go back, redirect to login again
                            window.location.href = '/login';
                        }
                    });
                    
                    // Run on page load
                    clearHistory();
                }
            })();
        </script>
        
        <style>
            /* Hide all GCash buttons and features */
            [class*="gcash" i],
            [class*="gcash" i] *,
            button:has-text("GCash"),
            button:has-text("gcash"),
            a:has-text("GCash"),
            a:has-text("gcash"),
            .gcash-payment,
            .gcash-btn,
            [data-payment="gcash"],
            option[value*="gcash" i],
            label:has-text("GCash"),
            label:has-text("gcash") {
                display: none !important;
                visibility: hidden !important;
                opacity: 0 !important;
                pointer-events: none !important;
            }
            
            /* Custom 2026 'Glass' effect for the header */
            .glass-header {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }
        </style>
    </head>
    <body class="font-sans antialiased text-slate-900 selection:bg-indigo-100 selection:text-indigo-700">
        <div class="min-h-screen bg-[#fcfcfd]">
            
            <div class="sticky top-0 z-50">
                @include('layouts.navigation')
            </div>

            @isset($header)
                <header class="glass-header sticky top-[65px] z-40">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between">
                            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                                {{ $header }}
                            </h1>
                            </div>
                    </div>
                </header>
            @endisset

            <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
                <div class="animate-in fade-in slide-in-from-bottom-4 duration-700">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>