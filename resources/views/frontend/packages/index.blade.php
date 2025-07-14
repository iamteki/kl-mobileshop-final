@extends('layouts.app')

@section('title', 'Event Packages - KL Mobile')
@section('description', 'Choose from our pre-configured event packages designed for different event sizes and types. Complete solutions for your events.')

@section('content')
    <!-- Page Header -->
  <section class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Packages</li>
                    </ol>
                </nav>
                <h1 class="page-title">Event Packages</h1>
                <p class="page-subtitle">Complete solutions for every type of event</p>
            </div>
        </div>
    </div>
</section>

    <!-- Packages Section -->
    <section class="packages-listing py-5">
        <div class="container">
            <!-- Category Intro -->
            <div class="text-center mb-5">
                <div class="icon-wrapper mx-auto mb-4">
                    <i class="fas fa-box-open"></i>
                </div>
                <h2 class="section-title">Choose Your Perfect Package</h2>
                <p class="section-description">
                    We've carefully curated packages to suit different event types and sizes. 
                    Each package includes everything you need for a successful event.
                </p>
            </div>

            <!-- Package Categories -->
            @if($packages->groupBy('category')->count() > 1)
                <div class="package-categories mb-5">
                    <div class="d-flex justify-content-center flex-wrap gap-2">
                        <button class="btn btn-category active" data-category="all">
                            All Packages <span class="badge">{{ $packages->count() }}</span>
                        </button>
                        @foreach($packages->groupBy('category') as $category => $categoryPackages)
                            <button class="btn btn-category" data-category="{{ Str::slug($category) }}">
                                {{ $category }} <span class="badge">{{ $categoryPackages->count() }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Packages Grid -->
            <div class="row g-4" id="packagesGrid">
                @forelse($packages as $index => $package)
                    <div class="col-lg-4 col-md-6 package-item" data-category="{{ Str::slug($package->category) }}">
                        <x-package-card :package="$package" :featured="$package->featured" />
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state text-center py-5">
                            <div class="empty-icon mb-4">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h3 class="empty-title">No Packages Available</h3>
                            <p class="empty-text mb-4">We're currently updating our packages. Please check back soon!</p>
                            <a href="{{ route('contact') }}" class="btn btn-primary">
                                <i class="fas fa-phone me-2"></i>Contact Us
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Custom Package CTA -->
            <div class="custom-package-cta text-center mt-5 pt-5">
                <div class="cta-card">
                    <div class="row align-items-center">
                        <div class="col-lg-8 text-lg-start">
                            <h3 class="cta-title mb-3">Need a Custom Package?</h3>
                            <p class="cta-text mb-lg-0">
                                Can't find what you're looking for? We can create a custom package 
                                tailored to your specific event requirements and budget.
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="#" class="btn btn-primary btn-lg">
                                <i class="fas fa-comments me-2"></i>Get Custom Quote
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="package-features mt-5">
                <h3 class="features-title text-center mb-5">Why Choose Our Packages?</h3>
                <div class="row g-4">
                    <div class="col-md-3 col-6">
                        <div class="feature-item text-center">
                            <div class="feature-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <h5 class="feature-name">Best Value</h5>
                            <p class="feature-desc">Save up to 20% compared to individual rentals</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="feature-item text-center">
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h5 class="feature-name">All Inclusive</h5>
                            <p class="feature-desc">Everything you need in one convenient package</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="feature-item text-center">
                            <div class="feature-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h5 class="feature-name">Free Delivery</h5>
                            <p class="feature-desc">Setup and delivery included in package price</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="feature-item text-center">
                            <div class="feature-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h5 class="feature-name">Full Support</h5>
                            <p class="feature-desc">Professional crew and technical support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
/* Import Bebas Neue font */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap');

/* Page Header */
.page-header {
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.05) 0%, rgba(99, 102, 241, 0.05) 100%);
    padding: 120px 0 60px;
    border-bottom: 1px solid var(--border-dark);
}

.page-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 4rem;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    color: var(--text-light);
    margin-bottom: 0.5rem;
    line-height: 1;
}

.page-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: 1.25rem;
    color: var(--text-gray);
    font-weight: 400;
}

/* Breadcrumb */
.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}

.breadcrumb-item {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 0.875rem;
}

.breadcrumb-item a {
    color: var(--primary-purple);
    text-decoration: none;
    transition: color 0.3s;
}

.breadcrumb-item a:hover {
    color: var(--secondary-purple);
}

.breadcrumb-item.active {
    color: var(--text-light);
}

/* Packages Section */
.packages-listing {
    background-color: var(--bg-darker);
    min-height: 600px;
}

/* Icon Wrapper */
.icon-wrapper {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.15) 0%, rgba(124, 58, 237, 0.15) 100%);
    border-radius: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(147, 51, 234, 0.2);
    transition: all 0.3s;
}

.icon-wrapper:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 40px rgba(147, 51, 234, 0.3);
}

.icon-wrapper i {
    font-size: 56px;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Section Title */
.section-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.section-description {
    font-family: 'Inter', sans-serif;
    font-size: 1.125rem;
    color: var(--text-gray);
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.8;
}

/* Package Categories */
.package-categories {
    background: var(--bg-card);
    padding: 30px;
    border-radius: 25px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.btn-category {
    background: transparent;
    border: 1px solid var(--border-dark);
    color: var(--text-gray);
    padding: 12px 28px;
    border-radius: 30px;
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    transition: all 0.3s;
}

.btn-category:hover {
    border-color: var(--primary-purple);
    color: var(--primary-purple);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(147, 51, 234, 0.3);
}

.btn-category.active {
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--accent-violet) 100%);
    border-color: transparent;
    color: white;
    box-shadow: 0 10px 25px rgba(147, 51, 234, 0.4);
}

.btn-category .badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 3px 8px;
    border-radius: 12px;
    margin-left: 8px;
    font-size: 0.75rem;
}

/* Empty State */
.empty-state {
    background: var(--bg-card);
    border-radius: 30px;
    padding: 80px 40px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.empty-icon {
    font-size: 100px;
    color: var(--text-muted);
    opacity: 0.2;
}

.empty-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.5rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--text-gray);
    margin-bottom: 1rem;
}

.empty-text {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 1.1rem;
}

/* Custom Package CTA */
.cta-card {
    background: linear-gradient(135deg, var(--bg-card) 0%, rgba(147, 51, 234, 0.05) 100%);
    border: 1px solid var(--primary-purple);
    border-radius: 30px;
    padding: 60px 50px;
    box-shadow: 0 20px 50px rgba(147, 51, 234, 0.2);
    transition: all 0.3s;
}

.cta-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 60px rgba(147, 51, 234, 0.3);
}

.cta-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.5rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--text-light);
}

.cta-text {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 1.1rem;
    line-height: 1.8;
}

/* Features */
.package-features {
    background: var(--bg-card);
    border-radius: 30px;
    padding: 60px 50px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.features-title {
    padding-top: 20px;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--text-light);
}

.feature-item {
    padding: 30px 20px;
    transition: transform 0.3s;
}

.feature-item:hover {
    transform: translateY(-10px);
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.15) 0%, rgba(124, 58, 237, 0.15) 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    transition: all 0.3s;
}

.feature-item:hover .feature-icon {
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.25) 0%, rgba(124, 58, 237, 0.25) 100%);
    transform: scale(1.1);
    box-shadow: 0 10px 25px rgba(147, 51, 234, 0.3);
}

.feature-icon i {
    padding-left: 10px;
    font-size: 32px;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.feature-name {
    font-family: 'Inter', sans-serif;
    color: var(--text-light);
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

.feature-desc {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 0.875rem;
    line-height: 1.6;
}

/* Package Item Animation */
.package-item {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 991px) {
    .page-title {
        font-size: 3rem;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
    
    .cta-card {
        text-align: center;
        padding: 40px 30px;
    }
    
    .cta-title {
        font-size: 2rem;
    }
}

@media (max-width: 767px) {
    .page-header {
        padding: 100px 0 40px;
    }
    
    .page-title {
        font-size: 2.5rem;
    }
    
    .package-categories {
        padding: 20px;
    }
    
    .btn-category {
        font-size: 0.8rem;
        padding: 10px 20px;
    }
    
    .package-features {
        padding: 40px 30px;
        
    }
    
    .features-title {
        font-size: 2rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category filtering
    const categoryButtons = document.querySelectorAll('.btn-category');
    const packageItems = document.querySelectorAll('.package-item');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active state
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter packages
            const selectedCategory = this.getAttribute('data-category');
            
            packageItems.forEach((item, index) => {
                if (selectedCategory === 'all' || item.getAttribute('data-category') === selectedCategory) {
                    item.style.display = 'block';
                    // Add staggered fade in animation
                    item.style.opacity = '0';
                    setTimeout(() => {
                        item.style.transition = 'opacity 0.3s';
                        item.style.opacity = '1';
                    }, index * 50);
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush