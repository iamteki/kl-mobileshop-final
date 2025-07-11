@extends('layouts.app')

@section('title', 'Professional Event Services - KL Mobile')
@section('description', 'Browse our professional service providers including DJs, photographers, videographers, and event staff.')

@section('content')
<!-- Hero Section -->
<section class="services-hero position-relative">
    <div class="hero-bg-overlay"></div>
    <div class="container position-relative z-1">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-1 fw-bold text-white mb-4">
                    Professional Event Services
                </h1>
                <p class="lead text-white-50 mb-5">
                    Find the perfect professionals for your event from our vetted network of service providers
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Service Categories -->
<section class="service-categories py-5">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <h2 class="section-title">Our Service Categories</h2>
            <p class="text-gray-400">Choose from our wide range of professional services</p>
        </div>
        
        <!-- Category Tabs -->
        <div class="category-tabs mb-5">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" 
                            data-bs-toggle="tab" 
                            data-bs-target="#all-services" 
                            type="button">
                        All Services
                    </button>
                </li>
                @foreach($parentCategories as $key => $name)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" 
                                data-bs-toggle="tab" 
                                data-bs-target="#{{ $key }}" 
                                type="button">
                            {{ $name }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
        
        <!-- Tab Content -->
        <div class="tab-content">
            <!-- All Services -->
            <div class="tab-pane fade show active" id="all-services" role="tabpanel">
                <div class="row g-4">
                    @foreach($categories as $category)
                        <div class="col-lg-4 col-md-6">
                            @include('frontend.services.partials.category-card', ['category' => $category])
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Parent Category Tabs -->
            @foreach($parentCategories as $key => $name)
                <div class="tab-pane fade" id="{{ $key }}" role="tabpanel">
                    <div class="row g-4">
                        @if(isset($groupedCategories[$key]))
                            @foreach($groupedCategories[$key] as $category)
                                <div class="col-lg-4 col-md-6">
                                    @include('frontend.services.partials.category-card', ['category' => $category])
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="fas fa-users fa-4x text-muted mb-3"></i>
                                    <h3 class="text-muted">No services in this category yet</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Choose Our Services -->
<section class="why-choose-services py-5 bg-dark">
    <div class="container">
        <h2 class="section-title text-center mb-5">Why Choose Our Service Providers</h2>
        <div class="row g-4">
            <div class="col-md-3 text-center">
                <div class="feature-box">
                    <i class="fas fa-certificate fa-3x mb-3" style="color: var(--primary-purple);"></i>
                    <h5 class="feature-title">Vetted Professionals</h5>
                    <p class="text-muted">All providers are verified and experienced</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="feature-box">
                    <i class="fas fa-star fa-3x mb-3" style="color: var(--primary-purple);"></i>
                    <h5 class="feature-title">Customer Reviews</h5>
                    <p class="text-muted">Real reviews from verified bookings</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="feature-box">
                    <i class="fas fa-shield-alt fa-3x mb-3" style="color: var(--primary-purple);"></i>
                    <h5 class="feature-title">Guaranteed Quality</h5>
                    <p class="text-muted">Quality assurance on all services</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="feature-box">
                    <i class="fas fa-headset fa-3x mb-3" style="color: var(--primary-purple);"></i>
                    <h5 class="feature-title">24/7 Support</h5>
                    <p class="text-muted">Always here to help you</p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Import Bebas Neue font */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap');

/* Hero Styles */
.services-hero {
    background-image: url('https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=1920&h=1080&fit=crop');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 50vh;
    display: flex;
    align-items: center;
    position: relative;
}

.hero-bg-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.9) 0%, rgba(147,51,234,0.2) 100%);
    z-index: 0;
}

/* Typography Updates */
.display-1 {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 5rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    background: linear-gradient(135deg, #FFFFFF 0%, rgba(255,255,255,0.9) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 1rem;
    animation: fadeInUp 0.8s ease-out;
}

@media (max-width: 768px) {
    .display-1 {
        font-size: 3.5rem;
    }
}

.section-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3rem;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    color: var(--text-light);
    margin-bottom: 0.5rem;
}

.feature-title {
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    color: var(--text-light);
}

/* Lead text styling */
.lead {
    font-family: 'Inter', sans-serif;
    font-weight: 400;
    font-size: 1.2rem;
    line-height: 1.8;
}

/* Category Tabs */
.category-tabs {
    background: var(--bg-card);
    padding: 25px;
    border-radius: 20px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.nav-pills .nav-link {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    background-color: transparent;
    border-radius: 30px;
    padding: 12px 30px;
    margin: 0 5px;
    transition: all 0.3s;
    border: 1px solid var(--border-dark);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    font-size: 0.9rem;
}

.nav-pills .nav-link:hover {
    background-color: var(--bg-card-hover);
    color: var(--text-light);
    border-color: var(--primary-purple);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(147, 51, 234, 0.3);
}

.nav-pills .nav-link.active {
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--accent-violet) 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 10px 25px rgba(147, 51, 234, 0.4);
}

/* Service Categories */
.service-categories {
    background-color: var(--bg-darker);
    min-height: 600px;
    padding: 80px 0;
}

/* Feature Box */
.feature-box {
    padding: 40px 30px;
    transition: transform 0.3s;
    background: var(--bg-card);
    border-radius: 20px;
    border: 1px solid var(--border-dark);
    height: 100%;
}

.feature-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(147, 51, 234, 0.3);
    border-color: var(--primary-purple);
}

.feature-box i {
    opacity: 0.8;
    transition: all 0.3s;
}

.feature-box:hover i {
    opacity: 1;
    transform: scale(1.1);
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Text colors */
.text-gray-400 {
    color: #9CA3AF;
}
</style>
@endpush

@push('scripts')
<script>
// Remember selected tab
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const parentCategory = urlParams.get('parent');
    
    if (parentCategory) {
        const tabButton = document.querySelector(`[data-bs-target="#${parentCategory}"]`);
        if (tabButton) {
            new bootstrap.Tab(tabButton).show();
        }
    }
});
</script>
@endpush

@endsection