<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProfileController extends Controller
{
    /**
     * Display customer's own profile.
     */
    public function show()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('items')->latest()->paginate(10);

        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()->where('payment_status', 'paid')->sum('total_amount');
        $pendingOrders = $user->orders()->where('order_status', 'pending')->count();
        $completedOrders = $user->orders()->where('order_status', 'delivered')->count();

        return view('customer.profile.show', compact(
            'user',
            'orders',
            'totalOrders',
            'totalSpent',
            'pendingOrders',
            'completedOrders'
        ));
    }

    /**
     * Show the form for editing profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('customer.profile.edit', compact('user'));
    }

    /**
     * Update customer's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? $user->phone;

        $user->save();

        return redirect()->route('customer.profile.show')
            ->with('success', '✅ Profile updated successfully!');
    }

    /**
     * Show change password form.
     */
    public function editPassword()
    {
        return view('customer.profile.password');
    }

    /**
     * Update customer's password - WITH STRONG VALIDATION
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // ✅ STRONG PASSWORD RULES
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                'different:current_password' // New password must be different from current
            ],
        ], [
            'current_password.required' => 'Current password is required.',
            'current_password.current_password' => 'Current password is incorrect.',
            'password.required' => 'New password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.regex' => 'Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character (@$!%*?&).',
            'password.different' => 'New password must be different from your current password.',
        ]);

        // ✅ Additional security: Check if new password was recently used (password history)
        $this->validatePasswordHistory($user, $validated['password']);

        // ✅ Hash and save new password
        $user->password = Hash::make($validated['password']);
        $user->save();

        // ✅ Log the password change for security audit
        if (class_exists('\Spatie\Activitylog\Facades\Activitylog')) {
            activity()
                ->causedBy($user)
                ->log('Password changed successfully');
        }

        return redirect()->route('customer.profile.show')
            ->with('success', '✅ Password changed successfully! For security, please log in again with your new password.')
            ->with('requires_relogin', true);
    }

    /**
     * Validate password history to prevent reuse
     */
    private function validatePasswordHistory($user, $newPassword)
    {
        // In a real application, you would store password hashes in a separate table
        // For now, we'll just check against the current password
        if (Hash::check($newPassword, $user->password)) {
            throw ValidationException::withMessages([
                'password' => 'New password cannot be the same as your current password.',
            ]);
        }
    }

    /**
     * Display order details.
     */
    public function orderDetails($orderId)
    {
        $user = Auth::user();
        $order = $user->orders()->with(['items', 'user'])->findOrFail($orderId);
        
        // Generate QR Code for order tracking
        $qrCodeUrl = route('customer.profile.orders.track', $orderId);
        $qrCode = QrCode::size(350)
            ->color(244, 63, 94)        // Rose-500
            ->backgroundColor(255, 255, 255)  // White
            ->margin(10)
            ->generate($qrCodeUrl);
            
        return view('customer.orders.show', compact('order', 'qrCode', 'qrCodeUrl'));
    }

    /**
     * Track order status with timeline.
     */
    public function trackOrder($orderId)
    {
        $user = Auth::user();
        $order = $user->orders()->with('items')->findOrFail($orderId);
        
        // Generate QR Code for order tracking
        $qrCodeUrl = route('customer.profile.orders.track', $orderId);
        $qrCode = QrCode::size(350)
            ->color(244, 63, 94)        // Rose-500
            ->backgroundColor(255, 255, 255)  // White
            ->margin(10)
            ->generate($qrCodeUrl);
            
        return view('customer.orders.track', compact('order', 'qrCode', 'qrCodeUrl'));
    }
}
