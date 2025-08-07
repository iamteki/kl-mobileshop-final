<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <!-- Replace text with SVG logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/kl_logo_final_original.svg') }}" 
                 alt="KL Mobile Events" 
                 class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                
                <!-- Equipment Dropdown (Dynamic) -->
                @if($navEquipmentCategories->count() > 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('equipment/*') ? 'active' : '' }}" 
                           href="#" 
                           data-bs-toggle="dropdown">
                            Equipment
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('categories.index') }}">
                                    <i class="fas fa-th-large me-2"></i>All Categories
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            @foreach($navEquipmentCategories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('category.show', $category->slug) }}">
                                        @if($category->icon)
                                            <i class="{{ $category->icon }} me-2" style="width: 20px;"></i>
                                        @endif
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                
                <!-- Services Dropdown (Dynamic) -->
                @if($navServiceCategories->count() > 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('services*') ? 'active' : '' }}" 
                           href="#" 
                           data-bs-toggle="dropdown">
                            Services
                        </a>
                        <ul class="dropdown-menu dropdown-menu-services">
                            <li>
                                <a class="dropdown-item" href="{{ route('services.index') }}">
                                    <i class="fas fa-users me-2"></i>All Services
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            
                            @foreach($navServiceParentCategories as $parentKey => $parentInfo)
                                @if(isset($navServiceCategories[$parentKey]) && $navServiceCategories[$parentKey]->count() > 0)
                                    <li class="dropdown-header">
            
                                        {{ $parentInfo['name'] }}
                                    </li>
                                    
                                    @foreach($navServiceCategories[$parentKey] as $category)
                                        <li>
                                            <a class="dropdown-item ps-4" 
                                               href="{{ route('services.category', $category->slug) }}">
                                                @if($category->icon)
                                                    <i class="{{ $category->icon }} me-2" style="width: 20px;"></i>
                                                @endif
                                                {{ $category->name }}
                                                <span class="badge bg-secondary ms-1">{{ $category->active_providers_count }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                    
                                    @if(!$loop->last)
                                        <li><hr class="dropdown-divider"></li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
                
                <!-- Packages (Conditional) -->
                @if($navHasPackages)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('packages*') ? 'active' : '' }}" 
                           href="{{ route('packages.index') }}">
                            Packages
                        </a>
                    </li>
                @endif
                
                <!-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li> -->
            </ul>
            
            <div class="d-flex align-items-center">
                @auth
                    <a href="{{ route('account.dashboard') }}" class="btn btn-primary me-2">
                        <i class="fas fa-user"></i> 
                        <span class="d-none d-lg-inline">Account</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                @endauth
                
                <!-- Cart Dropdown Component -->
                @livewire('cart-dropdown')
                
                <a href="{{ route('booking.quick') }}" class="btn btn-primary ms-2 d-none d-md-inline-block">
                    <i class="fas fa-calendar-check me-1"></i>Book Now
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
/* Logo Styles */
.navbar-logo {
    height: 45px; /* Adjust height as needed */
    width: auto;
    max-width: 200px; /* Prevent logo from being too wide */
    transition: all 0.3s ease;
}

/* Logo hover effect */
.navbar-brand:hover .navbar-logo {
    transform: scale(1.05);
    filter: brightness(1.1);
}

/* Responsive logo adjustments */
@media (max-width: 991px) {
    .navbar-logo {
        height: 40px;
        max-width: 180px;
    }
}

@media (max-width: 576px) {
    .navbar-logo {
        height: 35px;
        max-width: 150px;
    }
}

/* Enhanced Dropdown Styles */
.dropdown-menu {
    min-width: 250px;
    max-height: 70vh;
    overflow-y: auto;
    padding: 10px 0;
    scrollbar-width: thin;
    scrollbar-color: var(--primary-purple) var(--bg-dark);
}

.dropdown-menu::-webkit-scrollbar {
    width: 6px;
}

.dropdown-menu::-webkit-scrollbar-track {
    background: var(--bg-dark);
}

.dropdown-menu::-webkit-scrollbar-thumb {
    background: var(--primary-purple);
    border-radius: 3px;
}

.dropdown-menu-services {
    min-width: 300px;
}

.dropdown-header {
    color: var(--primary-purple);
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 8px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.dropdown-divider {
    border-color: var(--border-dark);
    margin: 5px 0;
}

.dropdown-item {
    padding: 8px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.dropdown-item i {
    color: var(--primary-purple);
    opacity: 0.7;
}

.dropdown-item:hover i {
    opacity: 1;
}

.dropdown-item .badge {
    font-size: 10px;
    padding: 2px 6px;
}

/* Mobile Navigation Button Improvements */
@media (max-width: 767px) {
    /* Make the action buttons container responsive */
    .navbar .d-flex.align-items-center {
        flex-wrap: wrap;
        gap: 8px;
        width: 100%;
        justify-content: center;
        padding: 10px 0;
    }
    
    /* Adjust button sizes for mobile */
    .navbar .btn-primary {
        padding: 8px 16px !important;
        font-size: 0.875rem !important;
        min-width: auto !important;
        flex: 1;
        max-width: 120px;
    }
    
    /* Login/Account button specific */
    .navbar a[href*="login"].btn-primary,
    .navbar a[href*="account"].btn-primary {
        flex: 0 0 auto;
        min-width: 80px;
    }
    
    /* Book Now button - full width on very small screens */
    .navbar a[href*="booking.quick"].btn-primary {
        display: inline-flex !important;
        flex: 1 1 100%;
        max-width: none;
        margin-top: 8px;
        justify-content: center;
    }
    
    /* Cart dropdown adjustments */
    .navbar .dropdown {
        flex: 0 0 auto;
    }
    
    /* Ensure cart button matches other buttons */
    .navbar .dropdown .btn-primary {
        padding: 8px 16px !important;
        font-size: 0.875rem !important;
    }
    
    /* Icon adjustments for mobile */
    .navbar .btn-primary i {
        font-size: 0.875rem;
    }
    
    /* Hide text labels on very small screens to save space */
    @media (max-width: 400px) {
        .navbar .btn-primary .d-none.d-lg-inline {
            display: none !important;
        }
    }
}

/* Additional improvements for tablet view */
@media (min-width: 768px) and (max-width: 991px) {
    .navbar .d-flex.align-items-center {
        gap: 10px;
    }
    
    .navbar .btn-primary {
        padding: 8px 20px !important;
        font-size: 0.9375rem !important;
    }
    
    /* Show Book Now button on tablets */
    .navbar a[href*="booking.quick"].btn-primary {
        display: inline-flex !important;
    }
}

/* Improve navbar collapse behavior */
@media (max-width: 991px) {
    .navbar-collapse {
        background-color: var(--bg-card);
        margin-top: 15px;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid var(--border-dark);
        position: relative;
        z-index: 1000;
    }
    
    /* Ensure proper spacing when navbar is expanded */
    .navbar-collapse.show + .d-flex.align-items-center {
        margin-top: 15px;
    }
}

/* Alternative layout for better mobile UX */
@media (max-width: 575px) {
    /* Stack buttons vertically on very small screens */
    .navbar .d-flex.align-items-center {
        flex-direction: column;
        width: 100%;
        padding: 15px;
        gap: 10px;
    }
    
    /* Full width buttons on mobile */
    .navbar .btn-primary,
    .navbar .dropdown {
        width: 100%;
        max-width: 300px;
    }
    
    .navbar .dropdown .btn-primary {
        width: 100%;
        justify-content: center;
    }
    
    /* Book Now as prominent CTA */
    .navbar a[href*="booking.quick"].btn-primary {
        background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 24px !important;
    }
}

/* Cart dropdown specific mobile styles */
@media (max-width: 767px) {
    .dropdown-menu {
        position: fixed !important;
        top: auto !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        border-radius: 15px 15px 0 0 !important;
        max-height: 70vh;
        transform: none !important;
    }
    
    .dropdown-menu.show {
        display: block;
        animation: slideUp 0.3s ease-out;
    }
    
    @keyframes slideUp {
        from {
            transform: translateY(100%);
        }
        to {
            transform: translateY(0);
        }
    }
}
</style>