<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PureBlooms - Fresh Floral Artistry</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .hero-mesh {
            background-color: #f43f5e;
            background-image: 
                radial-gradient(at 0% 0%, hsla(340,100%,76%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
        }
    </style>
</head>
<body class="selection:bg-rose-200">

@php
    // Always try to get products and categories
    if (!isset($featuredProducts)) {
        try {
            $featuredProducts = \App\Models\Product::with('category')
                ->where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();
        } catch (\Exception $e) {
            $featuredProducts = collect([]);
        }
    }
    
    // Get categories for filtering
    if (!isset($categories)) {
        try {
            $categories = \App\Models\Category::where('is_active', true)->get();
        } catch (\Exception $e) {
            $categories = collect([]);
        }
    }
    
    // Get unique flower types from product names for filtering
    if (!isset($flowerTypes)) {
        try {
            $flowerNames = $featuredProducts->pluck('name')->unique();
            $flowerTypes = [];
            foreach ($flowerNames as $name) {
                // Extract flower type from product name (simplified)
                if (stripos($name, 'rose') !== false) {
                    $flowerTypes[] = ['id' => 'rose', 'name' => 'Roses'];
                } elseif (stripos($name, 'tulip') !== false) {
                    $flowerTypes[] = ['id' => 'tulip', 'name' => 'Tulips'];
                } elseif (stripos($name, 'lily') !== false) {
                    $flowerTypes[] = ['id' => 'lily', 'name' => 'Lilies'];
                } elseif (stripos($name, 'orchid') !== false) {
                    $flowerTypes[] = ['id' => 'orchid', 'name' => 'Orchids'];
                } else {
                    $flowerTypes[] = ['id' => 'mixed', 'name' => 'Mixed Bouquets'];
                }
            }
            // Remove duplicates
            $flowerTypes = collect($flowerTypes)->unique('id')->values();
        } catch (\Exception $e) {
            $flowerTypes = collect([]);
        }
    }
@endphp

<!-- Navbar for Welcome Page -->
<nav class="bg-white/70 backdrop-blur-lg border-b border-rose-100/50 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <!-- Logo -->
            <div class="flex flex-1 items-center">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2">
                        <span class="text-2xl">🌸</span>
                        <span class="text-xl font-black text-rose-600 tracking-tighter uppercase">
                            PureBlooms
                        </span>
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="/" class="text-slate-600 hover:text-rose-500 font-medium transition">
                    🏠 Home
                </a>
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-rose-500 font-medium transition">
                    🌺 Shop
                </a>
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-rose-500 font-medium transition">
                    📦 Orders
                </a>
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-rose-500 font-medium transition">
                    🛒 Cart
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <a href="{{ route('login') }}" class="text-rose-600 hover:text-rose-700 font-medium transition px-4 py-2">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-rose-500 to-pink-500 text-white px-6 py-2 rounded-full font-bold hover:shadow-lg transition">
                    Sign Up
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button onclick="toggleMobileMenu()" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-rose-500 hover:bg-rose-50 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden sm:hidden bg-white/95 backdrop-blur-lg border-b border-rose-100/50">
        <div class="pt-2 pb-3 space-y-1">
            <a href="/" class="block px-4 py-3 text-slate-600 hover:text-rose-500 font-medium transition">
                🏠 Home
            </a>
            <a href="{{ route('login') }}" class="block px-4 py-3 text-slate-600 hover:text-rose-500 font-medium transition">
                🌺 Shop
            </a>
            <a href="{{ route('login') }}" class="block px-4 py-3 text-slate-600 hover:text-rose-500 font-medium transition">
                📦 Orders
            </a>
            <a href="{{ route('login') }}" class="block px-4 py-3 text-slate-600 hover:text-rose-500 font-medium transition">
                🛒 Cart
            </a>
            <div class="border-t border-rose-100 pt-2">
                <a href="{{ route('login') }}" class="block px-4 py-3 text-rose-600 hover:text-rose-700 font-medium transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-3 bg-gradient-to-r from-rose-500 to-pink-500 text-white font-bold hover:shadow-lg transition mx-4 rounded-full text-center">
                    Sign Up
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}
</script>
    <div class="min-h-screen hero-mesh relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,...')"></div>

        <div class="container mx-auto px-6 py-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between mt-12 gap-12">
                <div class="lg:w-1/2 text-white">
                    <span class="inline-block px-4 py-1 rounded-full bg-white/20 text-sm font-semibold mb-6 backdrop-blur-sm">✨ 2026 Collection Now Live</span>
                    <h2 class="text-6xl lg:text-8xl font-black mb-8 leading-[0.9] tracking-tighter">
                        Artistry in <br><span class="text-rose-300 italic">Every Bloom.</span>
                    </h2>
                    <p class="text-xl text-rose-50 mb-10 max-w-lg leading-relaxed opacity-90">
                        Where every flower tells a story of love, handcrafted with passion and delivered with care to brighten your special moments.
                    </p>
                    <div class="flex flex-wrap gap-5">
                        <a href="{{ route('register') }}" class="btn-premium">
                            Start Shopping 🌺
                        </a>
                        <a href="#features" class="px-8 py-4 rounded-2xl border-2 border-white/30 text-white font-bold hover:bg-white/10 transition">
                            The Process
                        </a>
                    </div>
                </div>

                <div class="lg:w-5/12">
                    <!-- Product Carousel -->
                    <div class="card-glass relative group mb-6">
                        <div class="relative overflow-hidden rounded-2xl">
                            <div id="productCarousel" class="flex transition-transform duration-500 ease-in-out">
                                <!-- Carousel slides will be generated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-12 border-b border-rose-50">
        <div class="container mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div><p class="text-3xl font-black text-rose-600">50k+</p> <p class="text-sm text-slate-500 uppercase tracking-widest">Happy Hearts</p></div>
            <div><p class="text-3xl font-black text-rose-600">100%</p> <p class="text-sm text-slate-500 uppercase tracking-widest">Organic</p></div>
            <div><p class="text-3xl font-black text-rose-600">3hr</p> <p class="text-sm text-slate-500 uppercase tracking-widest">Fast Delivery</p></div>
            <div><p class="text-3xl font-black text-rose-600">4.9/5</p> <p class="text-sm text-slate-500 uppercase tracking-widest">Rating</p></div>
        </div>
    </div>

    <!-- Shop by Category - Interactive Pills with Images -->
    <div class="bg-white py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">🌺 Shop by Category</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Click a category to view our beautiful flowers
                </p>
            </div>
            
            @if($categories->count() > 0)
            <!-- Category Pills -->
            <div class="flex flex-wrap justify-center gap-4 max-w-5xl mx-auto mb-12">
                <button onclick="showCategory('all')" 
                        class="category-pill group flex items-center gap-3 px-8 py-4 rounded-full text-lg font-bold transition-all duration-300 bg-gradient-to-r from-rose-500 to-pink-500 text-white shadow-lg hover:shadow-rose-500/30 hover:scale-105 transform active"
                        data-category="all">
                    <span class="text-2xl group-hover:rotate-12 transition-transform">🌸</span>
                    <span>All Products</span>
                </button>
                
                @foreach($categories as $category)
                <button onclick="showCategory('{{ $category->id }}')" 
                        class="category-pill group flex items-center gap-3 px-8 py-4 rounded-full text-lg font-bold transition-all duration-300 bg-white text-rose-600 border-2 border-rose-200 shadow-md hover:shadow-lg hover:border-rose-400 hover:bg-rose-50 hover:scale-105 transform"
                        data-category="{{ $category->id }}">
                    <span class="text-2xl group-hover:rotate-12 transition-transform">
                        @if($category->name === 'redroses')
                            🌹
                        @elseif($category->name === 'blueroses')
                            🔵
                        @else
                            🌸
                        @endif
                    </span>
                    <span>{{ ucfirst($category->name) }}</span>
                </button>
                @endforeach
            </div>
            
            <!-- Product Display Area -->
            <div id="productDisplay" class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="productGrid">
                    @foreach($featuredProducts as $product)
                    <div class="product-card group bg-white rounded-2xl border-2 border-gray-100 hover:border-rose-300 hover:shadow-2xl transition-all duration-300 overflow-hidden" 
                         data-category="{{ $product->category_id ?? 'uncategorized' }}">
                        <!-- Product Image -->
                        <div class="relative overflow-hidden bg-gray-50 h-72">
                            @if($product->image_path)
                            <img src="{{ Storage::url($product->image_path) }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" 
                                 alt="{{ $product->name }}">
                            @else
                            <div class="w-full h-full bg-gradient-to-br from-rose-100 to-pink-100 flex items-center justify-center">
                                <span class="text-7xl">🌸</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-6">
                            <h4 class="font-bold text-gray-900 text-lg mb-2 truncate">{{ $product->name }}</h4>
                            @if($product->category)
                            <p class="text-sm text-gray-500 mb-3">{{ $product->category->name }}</p>
                            @endif
                            <p class="text-rose-600 font-bold text-2xl mb-4">₱{{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('login') }}" class="block w-full text-center py-3 bg-rose-500 text-white rounded-xl font-bold text-lg hover:bg-rose-600 transition">
                                View Details
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="text-center py-12">
                <span class="text-6xl mb-4 block">🌸</span>
                <p class="text-gray-600 text-lg">No products available at the moment.</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        // Category filter functionality
        function showCategory(categoryId) {
            // Update pill styles
            document.querySelectorAll('.category-pill').forEach(pill => {
                if (pill.dataset.category === categoryId) {
                    pill.className = 'category-pill group flex items-center gap-3 px-8 py-4 rounded-full text-lg font-bold transition-all duration-300 bg-gradient-to-r from-rose-500 to-pink-500 text-white shadow-lg hover:shadow-rose-500/30 hover:scale-105 transform active';
                } else {
                    pill.className = 'category-pill group flex items-center gap-3 px-8 py-4 rounded-full text-lg font-bold transition-all duration-300 bg-white text-rose-600 border-2 border-rose-200 shadow-md hover:shadow-lg hover:border-rose-400 hover:bg-rose-50 hover:scale-105 transform';
                }
            });
            
            // Filter products
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                if (categoryId === 'all' || product.dataset.category == categoryId || (categoryId === 'uncategorized' && product.dataset.category === 'uncategorized')) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    </script>

    <!-- Footer Tagline -->
    <div class="bg-gradient-to-r from-rose-50 to-pink-50 py-16">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <div class="mb-6">
                    <span class="text-6xl">🌸</span>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold text-rose-800 mb-4 italic leading-relaxed">
                    "May every bloom bring joy to the heart — 100% handmade with love by Pureblooms Ventures"
                </h3>
                <div class="flex items-center justify-center gap-2 text-rose-600 mt-6">
                    <span class="text-sm font-medium">Crafted with passion</span>
                    <span class="text-rose-400">•</span>
                    <span class="text-sm font-medium">Delivered with care</span>
                    <span class="text-rose-400">•</span>
                    <span class="text-sm font-medium">Made with love</span>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
// Product Carousel with Category and Flower Type Filtering
let currentSlide = 0;
let allProducts = @json($featuredProducts);
let filteredProducts = [...allProducts];
let totalSlides = filteredProducts.length;
let currentCategoryFilter = 'all';
let currentFlowerFilter = 'all';

// Update carousel display
function updateCarousel() {
    const carousel = document.getElementById('productCarousel');
    
    // Clear existing slides
    carousel.innerHTML = '';
    
    // Add filtered products
    if (filteredProducts.length > 0) {
        filteredProducts.forEach(product => {
            const slide = document.createElement('div');
            slide.className = 'min-w-full';
            
            if (product.image_path) {
                slide.innerHTML = `<img src="/storage/${product.image_path}" 
                                         alt="${product.name}" 
                                         class="w-full h-72 object-cover rounded-2xl"
                                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-72 bg-gradient-to-br from-rose-100 to-pink-100 rounded-2xl flex items-center justify-center\'><span class=\'text-7xl\'>🌸</span></div>'">`;
            } else {
                slide.innerHTML = `<div class="w-full h-72 bg-gradient-to-br from-rose-100 to-pink-100 rounded-2xl flex items-center justify-center">
                                      <span class="text-7xl">🌸</span>
                                   </div>`;
            }
            
            carousel.appendChild(slide);
        });
    } else {
        // Fallback flowers if no products
        const flowers = ['🌸', '🌺', '🌷'];
        flowers.forEach(flower => {
            const slide = document.createElement('div');
            slide.className = 'min-w-full';
            slide.innerHTML = `<div class="w-full h-72 bg-gradient-to-br from-rose-100 to-pink-100 rounded-2xl flex items-center justify-center">
                                  <span class="text-7xl">${flower}</span>
                               </div>`;
            carousel.appendChild(slide);
        });
    }
    
    totalSlides = carousel.children.length;
    currentSlide = 0;
    showSlide(currentSlide);
}

function showSlide(index) {
    const carousel = document.getElementById('productCarousel');
    carousel.style.transform = `translateX(-${index * 100}%)`;
}

function nextSlide() {
    if (totalSlides > 0) {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }
}

// Filter products by category
function filterProducts(categoryId) {
    currentCategoryFilter = categoryId;
    applyFilters();
    
    // Update button styles
    document.querySelectorAll('.category-filter-btn').forEach(btn => {
        if (btn.dataset.category === categoryId) {
            btn.className = 'category-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-rose-500 text-white';
        } else {
            btn.className = 'category-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-white text-rose-600 hover:bg-rose-100';
        }
    });
}

// Filter products by flower type
function filterByFlower(flowerType) {
    currentFlowerFilter = flowerType;
    applyFilters();
    
    // Update button styles
    document.querySelectorAll('.flower-filter-btn').forEach(btn => {
        if (btn.dataset.flower === flowerType) {
            btn.className = 'flower-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-purple-500 text-white';
        } else {
            btn.className = 'flower-filter-btn px-4 py-2 rounded-full text-sm font-medium transition bg-white text-purple-600 hover:bg-purple-100';
        }
    });
}

// Apply both category and flower filters
function applyFilters() {
    filteredProducts = allProducts.filter(product => {
        let categoryMatch = currentCategoryFilter === 'all' || 
                          (product.category && product.category.id == currentCategoryFilter);
        
        let flowerMatch = currentFlowerFilter === 'all';
        if (currentFlowerFilter !== 'all') {
            const productName = (product.name || '').toLowerCase();
            if (currentFlowerFilter === 'rose' && strpos(productName, 'rose') !== false) {
                flowerMatch = true;
            } else if (currentFlowerFilter === 'tulip' && strpos(productName, 'tulip') !== false) {
                flowerMatch = true;
            } else if (currentFlowerFilter === 'lily' && strpos(productName, 'lily') !== false) {
                flowerMatch = true;
            } else if (currentFlowerFilter === 'orchid' && strpos(productName, 'orchid') !== false) {
                flowerMatch = true;
            } else if (currentFlowerFilter === 'mixed') {
                flowerMatch = true; // Show mixed bouquets
            }
        }
        
        return categoryMatch && flowerMatch;
    });
    
    // Reset carousel with filtered products
    updateCarousel();
}

// Helper function for string contains
function strpos(haystack, needle, offset) {
    var i = (haystack + '').indexOf(needle, (offset || 0));
    return i === -1 ? false : i;
}

// Auto-play carousel every 3 seconds
setInterval(() => {
    if (totalSlides > 1) {
        nextSlide();
    }
}, 3000);

// Initialize carousel
document.addEventListener('DOMContentLoaded', function() {
    updateCarousel();
});
</script>
</html>