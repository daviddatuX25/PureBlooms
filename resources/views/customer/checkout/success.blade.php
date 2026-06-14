<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl bg-gradient-to-r from-rose-600 via-pink-600 to-purple-600 bg-clip-text text-transparent">
            🎉 Order Successful!
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto">
            
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden" id="printable-area">
                <!-- Success Header -->
                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 p-8 text-center text-white">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Thank You for Your Order!</h1>
                    <p class="text-emerald-100">Your order has been placed successfully</p>
                </div>

                <div class="p-8">
                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 mb-8 print:hidden">
                        <button onclick="window.print()" class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl font-semibold hover:shadow-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Print Receipt
                        </button>
                        
                        <button onclick="copyOrderDetails()" class="flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-xl font-semibold hover:shadow-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Copy Details
                        </button>
                        
                        <a href="{{ route('customer.orders.track', $order->id) }}" class="flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl font-semibold hover:shadow-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            Track Order
                        </a>
                    </div>

                    <!-- Order Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Order Number</p>
                            <p class="text-xl font-bold text-gray-900">{{ $order->order_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Order Date</p>
                            <p class="text-xl font-bold text-gray-900">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>

                    <!-- Order Details -->
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">🌸 Order Details</h3>
                        <div class="space-y-3">
                            @foreach($order->items as $item)
                            <div class="flex justify-between items-center">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $item->product_name }}</p>
                                    <p class="text-sm text-gray-600">Qty: {{ $item->quantity }} × ₱{{ number_format($item->price, 2) }}</p>
                                </div>
                                <p class="font-bold text-gray-900">₱{{ number_format($item->subtotal, 2) }}</p>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Addons Display -->
                        @if(isset($order->addons_decoded) && is_array($order->addons_decoded) && !empty($order->addons_decoded))
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-900 mb-2">🎁 Additional Services</h4>
                            @foreach($order->addons_decoded as $addonSlug => $addonData)
                                @if(is_array($addonData) && isset($addonData['quantity']) && $addonData['quantity'] > 0)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-700">{{ $addonData['name'] ?? 'Addon' }} × {{ $addonData['quantity'] }}</span>
                                    <span class="font-medium">₱{{ number_format(($addonData['price'] ?? 0) * $addonData['quantity'], 2) }}</span>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <div class="flex justify-between items-center text-xl font-bold">
                            <span>Total Amount</span>
                            <span class="text-rose-600">₱{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">📦 Shipping Information</h3>
                        <div class="space-y-2 text-gray-700">
                            <p><span class="font-semibold">Name:</span> {{ $order->customer_name }}</p>
                            <p><span class="font-semibold">Email:</span> {{ $order->customer_email }}</p>
                            <p><span class="font-semibold">Phone:</span> {{ $order->customer_phone }}</p>
                            <p><span class="font-semibold">Address:</span> {{ $order->shipping_address }}, {{ $order->city }} {{ $order->postal_code }}</p>
                            <p><span class="font-semibold">Payment:</span> 
                                @if($order->payment_method === 'cod')
                                    💵 Cash on Delivery (COD)
                                @else
                                    📱 GCash
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="font-semibold text-amber-900">Order Status: <span class="uppercase">{{ $order->order_status }}</span></p>
                                <p class="text-sm text-amber-700">We'll notify you when your order is processed</p>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code for Tracking -->
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6 mb-6 text-center">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">📱 Track Your Order</h3>
                        <div class="bg-white p-4 rounded-lg inline-block">
                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate(route('customer.orders.track', $order->id)) !!}
                        </div>
                        <p class="text-sm text-gray-600 mt-3">Scan this QR code to track your order</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap gap-4 print:hidden">
                        <a href="{{ route('customer.profile.show') }}" class="flex-1 bg-gradient-to-r from-rose-500 to-pink-600 text-white text-center py-3 rounded-xl font-semibold hover:shadow-lg transition">
                            View All Orders
                        </a>
                        <a href="{{ route('customer.dashboard') }}" class="flex-1 bg-white border-2 border-gray-300 text-gray-700 text-center py-3 rounded-xl font-semibold hover:bg-gray-50 transition">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #printable-area, #printable-area * {
                visibility: visible;
            }
            #printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .print:hidden {
                display: none !important;
            }
        }
    </style>

    <!-- Copy Function -->
    <script>
    function copyOrderDetails() {
        const orderDetails = `
ORDER RECEIPT - PureBlooms
================================
Order Number: {{ $order->order_number }}
Date: {{ $order->created_at->format('M d, Y h:i A') }}
Status: {{ strtoupper($order->order_status) }}

CUSTOMER INFORMATION
Name: {{ $order->customer_name }}
Email: {{ $order->customer_email }}
Phone: {{ $order->customer_phone }}
Address: {{ $order->shipping_address }}, {{ $order->city }} {{ $order->postal_code }}

ORDER ITEMS
@foreach($order->items as $item)
{{ $item->product_name }} - Qty: {{ $item->quantity }} × ₱{{ number_format($item->price, 2) }} = ₱{{ number_format($item->subtotal, 2) }}
@endforeach

TOTAL: ₱{{ number_format($order->total_amount, 2) }}
Payment Method: {{ strtoupper($order->payment_method) }}

Track your order: {{ route('customer.orders.track', $order->id) }}
        `.trim();

        navigator.clipboard.writeText(orderDetails).then(() => {
            alert('Order details copied to clipboard!');
        }).catch(() => {
            alert('Failed to copy. Please select and copy manually.');
        });
    }
    </script>
</x-app-layout>