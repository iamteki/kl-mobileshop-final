<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title">
                    Rent <span>Event Equipment</span> & Book <span>Professional Services</span>
                </h1>
                <p class="lead mb-4">
                    Complete event solutions with instant booking and real-time availability. 
                    From sound systems to professional DJs - we've got everything covered.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-box me-2"></i>Browse Equipment
                    </a>
                    <a href="{{ route('packages.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-star me-2"></i>View Packages
                    </a>
                </div>
                
                <!-- Trust Indicators -->
                <div class="trust-indicators mt-5">
                    <div class="row g-4">
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-purple me-2"></i>
                                <span class="text-muted">Instant Booking</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-truck text-purple me-2"></i>
                                <span class="text-muted">Free Delivery in KL</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shield-alt text-purple me-2"></i>
                                <span class="text-muted">Equipment Insurance</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 d-flex align-items-center">
                <div class="hero-carousel-wrapper position-relative w-100">
                    <!-- Carousel -->
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&h=600&fit=crop" 
                                     alt="Event Equipment" 
                                     class="img-fluid rounded">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=800&h=600&fit=crop" 
                                     alt="DJ Equipment" 
                                     class="img-fluid rounded">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=800&h=600&fit=crop" 
                                     alt="Event Lighting" 
                                     class="img-fluid rounded">
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=800&h=600&fit=crop" 
                                     alt="Concert Setup" 
                                     class="img-fluid rounded">
                            </div>
                        </div>
                        
                        <!-- Left Fade Overlay -->
                        <div class="carousel-fade-overlay"></div>
                        
                        <!-- Carousel Indicators -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Purple color for icons */
.text-purple {
    color: #9333EA !important;
}

.bg-purple {
    background-color: #9333EA !important;
}

/* Carousel Container Styling */
.hero-carousel-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 20px;
    /* Match the height with content */
    width: 100%;
    max-width: 600px;
    margin-left: auto;
}

#heroCarousel {
    position: relative;
    width: 100%;
}

.carousel-inner {
    border-radius: 20px;
    overflow: hidden;
}

.carousel-item {
    position: relative;
}

.carousel-item img {
    width: 100%;
    height: 450px;
    object-fit: cover;
}

/* Left fade overlay that matches hero background */
.carousel-fade-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        to right,
        /* Hero section background colors with fade */
        rgba(147, 51, 234, 0.1) 0%,
        rgba(99, 102, 241, 0.1) 10%,
        rgba(147, 51, 234, 0.05) 20%,
        rgba(99, 102, 241, 0.02) 30%,
        transparent 40%
    );
    pointer-events: none;
    z-index: 2;
}

/* Additional overlay for better blending */
.carousel-fade-overlay::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 50%;
    height: 100%;
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0.95) 0%,
        rgba(255, 255, 255, 0.7) 20%,
        rgba(255, 255, 255, 0.3) 40%,
        rgba(255, 255, 255, 0.1) 60%,
        transparent 100%
    );
}

/* Dark theme adjustment for overlay */
@media (prefers-color-scheme: dark) {
    .carousel-fade-overlay::before {
        background: linear-gradient(
            to right,
            rgba(26, 26, 30, 0.95) 0%,
            rgba(26, 26, 30, 0.7) 20%,
            rgba(26, 26, 30, 0.3) 40%,
            rgba(26, 26, 30, 0.1) 60%,
            transparent 100%
        );
    }
}

/* Carousel indicators */
.carousel-indicators {
    bottom: 20px;
    z-index: 3;
    margin-bottom: 0;
}

.carousel-indicators [data-bs-target] {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
    margin: 0 4px;
}

.carousel-indicators .active {
    background-color: #9333EA;
    width: 30px;
    border-radius: 5px;
}

/* Trust indicators */
.trust-indicators {
    opacity: 1;
}

/* Ensure proper alignment on large screens */
@media (min-width: 992px) {
    .hero-section .row {
        align-items: stretch !important;
    }
    
    .hero-section .col-lg-6:first-child {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-right: 40px;
    }
    
    .hero-section .col-lg-6:last-child {
        display: flex;
        align-items: center;
    }
}

/* Responsive adjustments */
@media (max-width: 991px) {
    .hero-carousel-wrapper {
        margin-top: 40px;
        max-width: 100%;
    }
    
    .carousel-item img {
        height: 400px;
    }
}

@media (max-width: 768px) {
    .hero-carousel-wrapper {
        margin-top: 30px;
    }
    
    .carousel-item img {
        height: 350px;
    }
    
    .carousel-fade-overlay {
        background: linear-gradient(
            to bottom,
            transparent 0%,
            transparent 60%,
            rgba(147, 51, 234, 0.05) 80%,
            rgba(147, 51, 234, 0.1) 100%
        );
    }
    
    .carousel-fade-overlay::before {
        display: none;
    }
}

/* Smooth transitions */
.carousel-item {
    transition: transform 0.6s ease-in-out;
}

.carousel-fade .carousel-item {
    opacity: 0;
    transition: opacity 0.6s ease-in-out;
}

.carousel-fade .carousel-item.active {
    opacity: 1;
}
</style>

@push('scripts')
<script>
// Initialize carousel with custom options
document.addEventListener('DOMContentLoaded', function() {
    // Ensure smooth transitions
    const carousel = new bootstrap.Carousel(document.getElementById('heroCarousel'), {
        interval: 4000,
        pause: 'hover',
        ride: 'carousel',
        wrap: true
    });
});
</script>
@endpush