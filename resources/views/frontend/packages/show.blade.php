@extends('layouts.app')

@section('title', $package->name . ' - Event Package')
@section('description', $package->description)

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('packages.index') }}">Packages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $package->name }}</li>
                        </ol>
                    </nav>
                    <h1 class="page-title">{{ $package->name }}</h1>
                    @if($package->badge)
                        <span class="package-badge-large">{{ $package->badge }}</span>
                    @endif
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="package-price-header">
                        <span class="price-label">Package Price</span>
                        <div class="price-amount">
                            <span class="currency">LKR</span>
                            <span class="amount">{{ number_format($package->price) }}</span>
                        </div>
                        <span class="price-unit">{{ $package->suitable_for ?? 'Per Event' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Package Details -->
    <section class="package-details py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Package Image -->
                    @if($package->image)
                        <div class="package-image mb-4">
                            <img src="{{ Storage::url($package->image) }}" 
                                 alt="{{ $package->name }}" 
                                 class="img-fluid rounded-20">
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="content-card mb-4">
                        <h2 class="content-title">Package Overview</h2>
                        <p class="package-description">{{ $package->description }}</p>
                        
                        @if($package->service_duration)
                            <div class="duration-info mt-3">
                                <i class="fas fa-clock me-2"></i>
                                <span>Service Duration: {{ $package->service_duration }} hours</span>
                            </div>
                        @endif
                    </div>

                    <!-- What's Included -->
                    <div class="content-card mb-4">
                        <h2 class="content-title">What's Included</h2>
                        @if($package->items && count($package->items) > 0)
                            <div class="items-grid">
                                @foreach($package->items as $item)
                                    <div class="item-card">
                                        <div class="item-icon">
                                            <i class="{{ $item['icon'] ?? 'fas fa-check' }}"></i>
                                        </div>
                                        <div class="item-details">
                                            <h5 class="item-name">{{ $item['name'] ?? 'Item' }}</h5>
                                            @if(isset($item['quantity']))
                                                <span class="item-quantity">Qty: {{ $item['quantity'] }}</span>
                                            @endif
                                            @if(isset($item['description']))
                                                <p class="item-description">{{ $item['description'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Contact us for detailed item list.</p>
                        @endif
                    </div>

                    <!-- Features -->
                    <div class="content-card mb-4">
                        <h2 class="content-title">Package Features</h2>
                        @if($package->features && count($package->features) > 0)
                            <div class="features-list">
                                @foreach($package->features as $feature)
                                    <div class="feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Additional Information -->
                    <div class="content-card">
                        <h2 class="content-title">Important Information</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <i class="fas fa-truck"></i>
                                <div>
                                    <h6>Delivery & Setup</h6>
                                    <p>Free delivery and professional setup included</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-users"></i>
                                <div>
                                    <h6>Technical Support</h6>
                                    <p>Professional crew available throughout event</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-shield-alt"></i>
                                <div>
                                    <h6>Insurance</h6>
                                    <p>All equipment fully insured for your peace of mind</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-calendar-check"></i>
                                <div>
                                    <h6>Booking</h6>
                                    <p>Advance booking required, subject to availability</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Sticky Sidebar Container -->
                    <div class="sticky-sidebar">
                        <!-- Booking Card -->
                        <div class="booking-card">
                            <h3 class="booking-title">Book This Package</h3>
                            
                            <div class="price-display mb-4">
                                <span class="currency">LKR</span>
                                <span class="amount">{{ number_format($package->price) }}</span>
                            </div>

                            <!-- Quick Info -->
                            <div class="quick-info mb-4">
                                @if($package->category)
                                    <div class="info-row">
                                        <span class="info-label">Category:</span>
                                        <span class="info-value">{{ $package->category }}</span>
                                    </div>
                                @endif
                                @if($package->suitable_for)
                                    <div class="info-row">
                                        <span class="info-label">Suitable for:</span>
                                        <span class="info-value">{{ $package->suitable_for }}</span>
                                    </div>
                                @endif
                                <div class="info-row">
                                    <span class="info-label">Duration:</span>
                                    <span class="info-value">{{ $package->service_duration ?? 8 }} hours</span>
                                </div>
                            </div>

                            <!-- Livewire Booking Component -->
                            @livewire('package-booking', ['package' => $package])
                        </div>

                        <!-- Trust Badges -->
                        <div class="trust-badges mt-4">
                            <div class="badge-item">
                                <i class="fas fa-award"></i>
                                <span>Premium Quality Equipment</span>
                            </div>
                            <div class="badge-item">
                                <i class="fas fa-headset"></i>
                                <span>24/7 Customer Support</span>
                            </div>
                            <div class="badge-item">
                                <i class="fas fa-star"></i>
                                <span>5-Star Rated Service</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Packages -->
            @if($relatedPackages->count() > 0)
                <div class="related-packages mt-5">
                    <h2 class="section-title text-center mb-4">Other Packages You May Like</h2>
                    <div class="row g-4">
                        @foreach($relatedPackages as $relatedPackage)
                            <div class="col-lg-4">
                                <x-package-card :package="$relatedPackage" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
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
    font-size: 3.5rem;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    color: var(--text-light);
    margin-bottom: 0.5rem;
    line-height: 1;
}

.package-badge-large {
    display: inline-block;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--accent-violet) 100%);
    color: white;
    padding: 10px 30px;
    border-radius: 30px;
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    margin-top: 10px;
    box-shadow: 0 10px 25px rgba(147, 51, 234, 0.3);
}

/* Breadcrumb */
.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
    margin-bottom: 1rem;
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

/* Price Header */
.package-price-header {
    text-align: right;
}

.price-label {
    display: block;
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 0.875rem;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

.price-amount {
    margin-bottom: 8px;
}

.currency {
    font-family: 'Inter', sans-serif;
    font-size: 1.25rem;
    color: var(--text-gray);
    margin-right: 5px;
}

.amount {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3rem;
    letter-spacing: 0.02em;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1;
}

.price-unit {
    display: block;
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 0.875rem;
    margin-top: 5px;
}

/* Package Details */
.package-details {
    background-color: var(--bg-darker);
    min-height: 100vh;
}

/* Package Image */
.package-image img {
    width: 100%;
    height: 450px;
    object-fit: cover;
    border-radius: 25px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}

/* Content Card */
.content-card {
    background: var(--bg-card);
    border-radius: 25px;
    padding: 45px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.content-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.5rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.package-description {
    font-family: 'Inter', sans-serif;
    font-size: 1.125rem;
    line-height: 1.8;
    color: var(--text-gray);
}

.duration-info {
    display: inline-flex;
    align-items: center;
    background: rgba(147, 51, 234, 0.1);
    padding: 12px 25px;
    border-radius: 30px;
    color: var(--primary-purple);
    font-family: 'Inter', sans-serif;
    font-weight: 600;
}

/* Items Grid */
.items-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
}

.item-card {
    background: var(--bg-darker);
    border-radius: 20px;
    padding: 25px;
    display: flex;
    gap: 18px;
    border: 1px solid var(--border-dark);
    transition: all 0.3s;
}

.item-card:hover {
    border-color: var(--primary-purple);
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(147, 51, 234, 0.3);
}

.item-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.15) 0%, rgba(124, 58, 237, 0.15) 100%);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.item-icon i {
    font-size: 24px;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.item-name {
    font-family: 'Inter', sans-serif;
    color: var(--text-light);
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.item-quantity {
    display: inline-block;
    background: rgba(147, 51, 234, 0.2);
    color: var(--primary-purple);
    padding: 4px 14px;
    border-radius: 15px;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

.item-description {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 0.875rem;
    margin-top: 10px;
    margin-bottom: 0;
    line-height: 1.6;
}

/* Features List */
.features-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 18px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 15px;
}

.feature-item i {
    color: var(--success-green);
    font-size: 22px;
}

.feature-item span {
    font-family: 'Inter', sans-serif;
    color: var(--text-light);
    font-size: 1rem;
}

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 35px;
}

.info-item {
    display: flex;
    gap: 18px;
}

.info-item i {
    font-size: 28px;
    color: var(--primary-purple);
    width: 35px;
    text-align: center;
}

.info-item h6 {
    font-family: 'Inter', sans-serif;
    color: var(--text-light);
    font-weight: 700;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    font-size: 0.9rem;
}

.info-item p {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 0.875rem;
    margin: 0;
    line-height: 1.6;
}

/* Sticky Sidebar Container */
.sticky-sidebar {
    position: sticky;
    top: 100px;
    z-index: 10;
}

/* Booking Card */
.booking-card {
    background: var(--bg-card);
    border-radius: 25px;
    padding: 40px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    transition: box-shadow 0.3s ease;
}

.booking-card:hover {
    box-shadow: 0 20px 50px rgba(147, 51, 234, 0.25);
}

.booking-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--text-light);
    margin-bottom: 1.5rem;
    text-align: center;
}

.price-display {
    text-align: center;
    padding: 25px;
    background: var(--bg-darker);
    border-radius: 20px;
}

.price-display .currency {
    font-family: 'Inter', sans-serif;
    font-size: 1.25rem;
    color: var(--text-gray);
    margin-right: 8px;
}

.price-display .amount {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3rem;
    letter-spacing: 0.02em;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1;
}

/* Quick Info */
.quick-info {
    background: var(--bg-darker);
    border-radius: 20px;
    padding: 25px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid var(--border-dark);
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

.info-value {
    font-family: 'Inter', sans-serif;
    color: var(--text-light);
    font-weight: 600;
    font-size: 0.875rem;
}

/* Trust Badges */
.trust-badges {
    background: var(--bg-card);
    border-radius: 20px;
    padding: 25px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.badge-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 12px 0;
}

.badge-item i {
    color: var(--primary-purple);
    font-size: 22px;
}

.badge-item span {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 0.875rem;
}

/* Related Packages */
.related-packages {
    padding-top: 60px;
    border-top: 1px solid var(--border-dark);
}

.section-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--text-light);
}

/* Package Booking Component Styles */
.booking-form-wrapper {
    background: var(--bg-darker);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 25px;
}

.form-title {
    font-family: 'Inter', sans-serif;
    color: var(--text-light);
    font-weight: 700;
    font-size: 1.25rem;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

.form-label {
    font-family: 'Inter', sans-serif;
    color: var(--text-light);
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

.form-control,
.form-select {
    background-color: var(--bg-card);
    border: 1px solid var(--border-dark);
    color: var(--text-light);
    padding: 14px 18px;
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-weight: 500;
    transition: all 0.3s;
}

.form-control:focus,
.form-select:focus {
    background-color: var(--bg-card);
    border-color: var(--primary-purple);
    color: var(--text-light);
    box-shadow: 0 0 0 0.2rem rgba(147, 51, 234, 0.25);
}

.form-control::placeholder {
    color: var(--text-muted);
}

.form-select option {
    background-color: var(--bg-card);
    color: var(--text-light);
}

.is-invalid {
    border-color: var(--danger-red);
}

.invalid-feedback {
    font-family: 'Inter', sans-serif;
    color: var(--danger-red);
    font-size: 0.8rem;
    margin-top: 5px;
}

.quick-contact {
    padding-top: 25px;
    border-top: 1px solid var(--border-dark);
}

/* Contact Info - Simple Links for WhatsApp and Call */
.contact-link {
    color: var(--primary-purple);
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s;
}

.contact-link:hover {
    color: var(--secondary-purple);
}

/* Just make WhatsApp and Call links purple - no button styling */
a[href*="whatsapp"],
a[href*="WhatsApp"],
a[href*="tel:"] {
    color: var(--primary-purple) !important;
    text-decoration: none !important;
}

a[href*="whatsapp"]:hover,
a[href*="WhatsApp"]:hover,
a[href*="tel:"]:hover {
    color: var(--secondary-purple) !important;
    text-decoration: none !important;
}

/* Responsive */
@media (max-width: 991px) {
    .page-title {
        font-size: 2.5rem;
    }
    
    .sticky-sidebar {
        position: relative;
        top: 0;
        margin-top: 30px;
    }
    
    .items-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 767px) {
    .content-card {
        padding: 30px;
    }
    
    .content-title {
        font-size: 2rem;
    }
    
    .features-list {
        grid-template-columns: 1fr;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .amount {
        font-size: 2.5rem;
    }
}

@media (max-width: 576px) {
    .booking-form-wrapper {
        padding: 20px;
    }
    
    .booking-card {
        padding: 30px 20px;
    }
    
    .d-flex.gap-2 {
        flex-direction: column;
    }
    
    .d-flex.gap-2 .btn {
        width: 100%;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Optional: Add shadow effect to booking card on scroll
    const bookingCard = document.querySelector('.booking-card');
    if (bookingCard) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            if (scrolled > 100) {
                bookingCard.style.boxShadow = '0 20px 50px rgba(147, 51, 234, 0.25)';
            } else {
                bookingCard.style.boxShadow = '0 15px 40px rgba(0,0,0,0.3)';
            }
        });
    }
});
</script>
@endpush