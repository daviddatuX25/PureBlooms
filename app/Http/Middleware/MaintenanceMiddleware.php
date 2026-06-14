<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if maintenance mode is enabled
        $maintenanceMode = Setting::get('maintenance_mode', false);
        
        if ($maintenanceMode) {
            // Allow admin users to access the site
            if (auth()->check() && auth()->user()->role === 'admin') {
                $response = $next($request);
                $response->headers->set('X-Maintenance-Mode', 'on');
                $response->headers->set('X-Maintenance-Bypass', 'admin');
                return $response;
            }
            
            // Allow access to admin routes
            if ($request->is('admin') || $request->is('admin/*')) {
                $response = $next($request);
                $response->headers->set('X-Maintenance-Mode', 'on');
                $response->headers->set('X-Maintenance-Bypass', 'admin-path');
                return $response;
            }
            
            // Allow access to auth routes (login, register, etc.)
            if ($request->is('login') || $request->is('register') || $request->is('password/*') || $request->is('logout*')) {
                $response = $next($request);
                $response->headers->set('X-Maintenance-Mode', 'on');
                $response->headers->set('X-Maintenance-Bypass', 'auth');
                return $response;
            }
            
            // Allow access to maintenance page itself (prevent redirect loop)
            if ($request->is('maintenance')) {
                $response = $next($request);
                $response->headers->set('X-Maintenance-Mode', 'on');
                $response->headers->set('X-Maintenance-Bypass', 'maintenance');
                return $response;
            }
            
            // Redirect to maintenance page for all other users
            return redirect()->route('maintenance');
        }
        
        return $next($request);
    }
}
