@extends('layouts.app')

@section('title', $provider->display_name . ' - ' . $provider->category->name)
@section('description', $provider->bio)

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3" style="background-color: var(--bg-darker);">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('services.index') }}">Services</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('services.category', $provider->category->slug) }}">
                    {{ $provider->category->name }}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $provider->display_name }}</li>
        </ol>
    </div>
</nav>

<!-- Provider Detail -->
<section class="provider-detail py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Left Column - Gallery & Info -->
            <div class="col-lg-8">
                <!-- Provider Header -->
                <div class="provider-header mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img src="{{ $provider->profile_image_url }}" 
                                 alt="{{ $provider->display_name }}"
                                 class="provider-profile-img">
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <h1 class="provider-name mb-2">{{ $provider->display_name }}</h1>
                                    @if($provider->stage_name && $provider->stage_name != $provider->name)
                                        <p class="real-name text-muted mb-2">{{ $provider->name }}</p>
                                    @endif
                                    <div class="provider-meta mb-3">
                                        @if($provider->badge)
                                            <span class="badge bg-primary me-2">{{ $provider->badge }}</span>
                                        @endif
                                        @if($provider->featured)
                                            <span class="badge bg-success me-2">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @endif
                                        <span class="badge bg-secondary">
                                            {{ $provider->experience_level }}
                                        </span>
                                    </div>
                                    @if($provider->rating > 0)
                                        <div class="provider-rating mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $provider->rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                            <span class="rating-info ms-2">
                                                {{ number_format($provider->rating, 1) }} 
                                                ({{ $provider->total_reviews }} {{ Str::plural('review', $provider->total_reviews) }})
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- About Section -->
                <div class="provider-section">
                    <h3 class="section-title">About</h3>
                    <p class="provider-bio">{!! nl2br(strip_tags($provider->bio)) !!}</p>
                    
                    <div class="provider-stats mt-4">
                        <div class="row g-3">
                            <div class="col-md-3 col-6">
                                <div class="stat-box">
                                    <i class="fas fa-briefcase"></i>
                                    <span class="stat-value">{{ $provider->years_experience }}</span>
                                    <span class="stat-label">Years Experience</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="stat-box">
                                    <i class="fas fa-calendar-check"></i>
                                    <span class="stat-value">{{ $provider->total_bookings }}</span>
                                    <span class="stat-label">Completed Events</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="stat-box">
                                    <i class="fas fa-language"></i>
                                    <span class="stat-value">{{ count($provider->languages ?? []) }}</span>
                                    <span class="stat-label">Languages</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="stat-box">
                                    <i class="fas fa-clock"></i>
                                    <span class="stat-value">{{ $provider->min_booking_hours }}+</span>
                                    <span class="stat-label">Min Hours</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($provider->mediaItems->count() > 0)
                    <div class="provider-section">
                        <h3 class="section-title">Portfolio</h3>
                        <div class="media-gallery">
                            <div class="row g-3">
                                @foreach($provider->getAllPortfolioItems() as $media)
                                    <div class="col-md-4">
                                        <div class="media-item" data-type="{{ $media->type }}">
                                            @if($media->type == 'image')
                                                <!-- Image Display -->
                                                <a href="{{ $media->url }}" 
                                                   data-fancybox="gallery" 
                                                   data-caption="{{ $media->title }}">
                                                    <img src="{{ $media->url }}" 
                                                         alt="{{ $media->title }}"
                                                         class="img-fluid rounded"
                                                         loading="lazy">
                                                    <div class="media-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                </a>
                                            @elseif($media->type == 'video')
                                                <!-- Video Display -->
                                                <div class="video-wrapper">
                                                    @if($media->thumbnail_url)
                                                        <img src="{{ $media->thumbnail_url }}" 
                                                             alt="{{ $media->title }}"
                                                             class="img-fluid rounded video-thumbnail"
                                                             loading="lazy">
                                                    @else
                                                        <div class="video-placeholder">
                                                            <i class="fas fa-play-circle"></i>
                                                        </div>
                                                    @endif
                                                    <a href="{{ $media->url }}" 
                                                       data-fancybox="gallery"
                                                       data-caption="{{ $media->title }}"
                                                       class="play-button">
                                                        <i class="fas fa-play"></i>
                                                    </a>
                                                </div>
                                            @elseif($media->type == 'audio')
                                                <!-- Audio Display -->
                                                <div class="audio-wrapper">
                                                    <div class="audio-placeholder">
                                                        <i class="fas fa-music"></i>
                                                    </div>
                                                    <h5 class="media-title">{{ $media->title }}</h5>
                                                    <audio controls class="w-100 mt-2">
                                                        <source src="{{ $media->url }}" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                </div>
                                            @endif
                                            
                                            <!-- Media Info -->
                                            <div class="media-info mt-2">
                                                <h6 class="media-title">{{ $media->title }}</h6>
                                                @if($media->description)
                                                    <p class="media-description">{{ $media->description }}</p>
                                                @endif
                                                @if($media->is_featured)
                                                    <span class="badge bg-primary">Featured</span>
                                                @endif
                                            </div>
                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Specialties -->
                @if($provider->specialties && count($provider->specialties) > 0)
                    <div class="provider-section">
                        <h3 class="section-title">Specialties</h3>
                        <div class="specialties-tags">
                            @foreach($provider->specialties as $specialty)
                                <span class="specialty-tag">{{ $specialty }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                <!-- Reviews -->
                @if($provider->approvedReviews->count() > 0)
                    <div class="provider-section">
                        <h3 class="section-title">Reviews</h3>
                        @foreach($featuredReviews as $review)
                            <div class="review-item">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <h5 class="reviewer-name">{{ $review->customer->user->name }}</h5>
                                        <div class="review-meta">
                                            <span class="review-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </span>
                                            <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    @if($review->verified_booking)
                                        <span class="verified-badge">
                                            <i class="fas fa-check-circle"></i> Verified Booking
                                        </span>
                                    @endif
                                </div>
                                @if($review->title)
                                    <h6 class="review-title">{{ $review->title }}</h6>
                                @endif
                                <p class="review-comment">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                        
                        @if($provider->approvedReviews->count() > 3)
                            <button class="btn btn-outline-primary btn-sm mt-3" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#allReviewsModal">
                                View All Reviews ({{ $provider->approvedReviews->count() }})
                            </button>
                        @endif
                    </div>
                @endif
            </div>
            
            <!-- Right Column - Booking -->
            <div class="col-lg-4">
                <div class="booking-card-wrapper">
                    <div class="booking-card">
                        <h3 class="booking-title">Book {{ $provider->display_name }}</h3>
                        
                        <!-- Pricing Tiers -->
                        @if($provider->pricingTiers->count() > 0)
                            <div class="pricing-tiers mb-4">
                                @foreach($provider->pricingTiers as $tier)
                                    <div class="pricing-tier {{ $tier->is_popular ? 'popular' : '' }}">
                                        @if($tier->is_popular)
                                            <span class="popular-badge">Most Popular</span>
                                        @endif
                                        <h5 class="tier-name">{{ $tier->tier_name }}</h5>
                                        <div class="tier-price">
                                            <span class="currency">LKR</span>
                                            <span class="amount">{{ number_format($tier->price) }}</span>
                                        </div>
                                        <div class="tier-duration">{{ $tier->duration }}</div>
                                        @if($tier->included_features)
                                            <ul class="tier-features">
                                                @foreach($tier->included_features as $feature)
                                                    <li>{{ $feature }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="base-pricing mb-4">
                                <div class="price-display">
                                    <span class="price-label">Starting from</span>
                                    <div class="price-amount">
                                        <span class="currency">LKR</span>
                                        <span class="amount">{{ number_format($provider->base_price) }}</span>
                                        <span class="price-unit">/{{ $provider->price_unit }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Booking Form -->
                        <form id="providerBookingForm" class="booking-form">
                            @csrf
                            <input type="hidden" name="provider_id" value="{{ $provider->id }}">
                            
                            <div class="mb-3">
                                <label class="form-label">Event Date</label>
                                <input type="date" 
                                       class="form-control" 
                                       name="event_date" 
                                       id="event_date"
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       required>
                            </div>
                            
                            @if($provider->pricingTiers->count() > 0)
                                <div class="mb-3">
                                    <label class="form-label">Select Package</label>
                                    <select class="form-select" name="pricing_tier_id" id="pricing_tier_id" required>
                                        <option value="">Choose a package</option>
                                        @foreach($provider->pricingTiers as $tier)
                                            <option value="{{ $tier->id }}" 
                                                    data-price="{{ $tier->price }}"
                                                    data-duration="{{ $tier->duration }}"
                                                    {{ $tier->is_popular ? 'selected' : '' }}>
                                                {{ $tier->tier_name }} - LKR {{ number_format($tier->price) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="mb-3">
                                    <label class="form-label">Duration (hours)</label>
                                    <input type="number" 
                                           class="form-control" 
                                           name="duration" 
                                           id="duration"
                                           min="{{ $provider->min_booking_hours }}"
                                           max="{{ $provider->max_booking_hours ?? 24 }}"
                                           value="{{ $provider->min_booking_hours }}"
                                           required>
                                </div>
                            @endif
                            
                            <div class="mb-3">
                                <label class="form-label">Start Time</label>
                                <input type="time" 
                                       class="form-control" 
                                       name="start_time" 
                                       id="start_time"
                                       required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-2">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Add to Cart
                            </button>
                            
                            <button type="button" class="btn btn-outline-primary w-100" id="checkAvailabilityBtn">
                                <i class="fas fa-calendar-check me-2"></i>
                                Check Availability
                            </button>
                        </form>
                        
                        <!-- Quick Info -->
                        <div class="quick-info mt-4">
                            <h5 class="info-title mb-3">Quick Info</h5>
                            <ul class="info-list">
                                @if($provider->languages)
                                    <li>
                                        <i class="fas fa-language"></i>
                                        <span>Languages: {{ implode(', ', $provider->languages) }}</span>
                                    </li>
                                @endif
                                @if($provider->equipment_provided)
                                    <li>
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span>Equipment Provided</span>
                                    </li>
                                @endif
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <span>Min Booking: {{ $provider->min_booking_hours }} hours</span>
                                </li>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Service Area: Kuala Lumpur & Selangor</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Providers -->
        @if($relatedProviders->count() > 0)
            <div class="related-providers mt-5">
                <h2 class="section-title text-center mb-4">Similar Service Providers</h2>
                <div class="row g-4">
                    @foreach($relatedProviders as $related)
                        <div class="col-lg-4 col-md-6">
                            <x-service-provider-card :provider="$related" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

<!-- All Reviews Modal -->
<div class="modal fade" id="allReviewsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">All Reviews for {{ $provider->display_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="reviews-list">
                    @foreach($provider->approvedReviews as $review)
                        <div class="review-item">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <h6 class="reviewer-name">{{ $review->customer->user->name }}</h6>
                                    <div class="review-meta">
                                        <span class="review-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                        </span>
                                        <span class="review-date">{{ $review->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            @if($review->title)
                                <h6 class="review-title">{{ $review->title }}</h6>
                            @endif
                            <p class="review-comment">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Import Bebas Neue font */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap');

/* Provider Detail Styles */
.provider-detail {
    background-color: var(--bg-darker);
    min-height: 600px;
}

/* Container max width */
.container {
    max-width: 1200px;
}

/* Profile Image */
.provider-profile-img {
    width: 100%;
    max-width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 25px;
    border: 3px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

/* Typography */
.provider-name {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3rem;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    color: var(--text-light);
    line-height: 1;
    word-wrap: break-word;
}

.real-name {
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    font-weight: 400;
}

.section-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.5rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    margin-bottom: 1.5rem;
    color: var(--text-light);
}

.booking-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.info-title {
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    color: var(--text-light);
}

/* Provider Section */
.provider-section {
    background: var(--bg-card);
    padding: 35px;
    border-radius: 25px;
    margin-bottom: 25px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    overflow: hidden;
}

/* Provider Bio */
.provider-bio {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 1rem;
    line-height: 1.8;
    white-space: pre-line;
    word-wrap: break-word;
}

/* Stats Box */
.stat-box {
    background: var(--bg-darker);
    padding: 25px;
    border-radius: 20px;
    text-align: center;
    border: 1px solid var(--border-dark);
    transition: all 0.3s;
}

.stat-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(147, 51, 234, 0.3);
    border-color: var(--primary-purple);
}

.stat-box i {
    font-size: 28px;
    color: var(--primary-purple);
    margin-bottom: 12px;
    display: block;
}

.stat-value {
    display: block;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    letter-spacing: 0.02em;
    color: var(--text-light);
    line-height: 1;
}

.stat-label {
    display: block;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    color: var(--text-gray);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
    margin-top: 0.5rem;
}

/* Media Gallery */
.media-gallery {
    margin-top: 25px;
}

.media-item {
    position: relative;
    overflow: hidden;
    border-radius: 20px;
    cursor: pointer;
    margin-bottom: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    transition: all 0.3s;
}

.media-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(147, 51, 234, 0.3);
}

.media-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s;
}

.media-item:hover img {
    transform: scale(1.05);
}

.media-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(147, 51, 234, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.media-item:hover .media-overlay {
    opacity: 1;
}

.media-overlay i {
    color: white;
    font-size: 2rem;
}

.video-wrapper {
    position: relative;
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background: rgba(147, 51, 234, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    transition: all 0.3s;
}

.play-button:hover {
    background: var(--primary-purple);
    transform: translate(-50%, -50%) scale(1.1);
}

.media-title {
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--text-light);
}

.media-description {
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    color: var(--text-gray);
}

/* Specialties */
.specialties-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.specialty-tag {
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
    color: var(--primary-purple);
    padding: 10px 24px;
    border-radius: 25px;
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    font-weight: 600;
    border: 1px solid rgba(147, 51, 234, 0.2);
    transition: all 0.3s;
}

.specialty-tag:hover {
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--accent-violet) 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(147, 51, 234, 0.3);
}

/* Reviews */
.review-item {
    background: var(--bg-darker);
    padding: 25px;
    border-radius: 20px;
    margin-bottom: 20px;
    border: 1px solid var(--border-dark);
}

.reviewer-name {
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.review-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 0.875rem;
    color: var(--text-gray);
}

.review-title {
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: var(--text-light);
}

.review-comment {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    line-height: 1.8;
}

.verified-badge {
    background: rgba(34, 197, 94, 0.1);
    color: var(--success-green);
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

/* Booking Card Wrapper */
.booking-card-wrapper {
    position: sticky;
    top: 100px;
    z-index: 10;
}

/* Booking Card */
.booking-card {
    background: var(--bg-card);
    padding: 35px;
    border-radius: 25px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

/* Pricing Tiers */
.pricing-tier {
    background: var(--bg-darker);
    padding: 25px;
    border-radius: 20px;
    margin-bottom: 20px;
    border: 1px solid var(--border-dark);
    position: relative;
    transition: all 0.3s;
}

.pricing-tier:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(147, 51, 234, 0.3);
}

.pricing-tier.popular {
    border-color: var(--primary-purple);
    box-shadow: 0 10px 30px rgba(147, 51, 234, 0.2);
}

.popular-badge {
    position: absolute;
    top: -12px;
    right: 20px;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--accent-violet) 100%);
    color: white;
    padding: 6px 20px;
    border-radius: 20px;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

.tier-name {
    font-family: 'Inter', sans-serif;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.tier-price {
    margin-bottom: 10px;
}

.currency {
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    color: var(--text-gray);
    margin-right: 5px;
}

.amount {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.5rem;
    letter-spacing: 0.02em;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1;
}

.tier-duration {
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    color: var(--text-gray);
    margin-bottom: 20px;
}

.tier-features {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tier-features li {
    padding: 8px 0;
    color: var(--text-gray);
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    padding-left: 24px;
    position: relative;
}

.tier-features li::before {
    content: '\f00c';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    color: var(--success-green);
    position: absolute;
    left: 0;
}

/* Base Pricing */
.base-pricing {
    background: var(--bg-darker);
    padding: 30px;
    border-radius: 20px;
    text-align: center;
    border: 1px solid var(--border-dark);
}

.price-display {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.price-label {
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    color: var(--text-gray);
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

.price-amount {
    display: flex;
    align-items: baseline;
}

.price-unit {
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    color: var(--text-gray);
    margin-left: 5px;
}

/* Quick Info */
.quick-info {
    background: var(--bg-darker);
    padding: 25px;
    border-radius: 20px;
    border: 1px solid var(--border-dark);
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    padding: 10px 0;
    color: var(--text-gray);
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 12px;
}

.info-list i {
    width: 20px;
    color: var(--primary-purple);
    text-align: center;
}

/* Form Controls */
.booking-form .form-control,
.booking-form .form-select {
    background: var(--bg-dark);
    border: 1px solid var(--border-dark);
    color: var(--text-primary);
    padding: 14px 18px;
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-weight: 500;
}

.booking-form .form-control:focus,
.booking-form .form-select:focus {
    background: var(--bg-dark);
    border-color: var(--primary-purple);
    color: var(--text-primary);
    box-shadow: 0 0 0 0.2rem rgba(147, 51, 234, 0.25);
}

/* Form Labels */
.booking-form .form-label {
    color: var(--text-primary);
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    font-size: 0.875rem;
}

/* Related Providers */
.related-providers {
    padding-top: 60px;
    border-top: 1px solid var(--border-dark);
}

/* Modal Styles */
.modal-content {
    background: var(--bg-card) !important;
    border: 1px solid var(--border-dark);
}

.modal-header {
    border-bottom: 1px solid var(--border-dark);
}

.modal-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--text-light);
}

/* Rating Info */
.rating-info {
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    color: var(--text-light);
}

/* Responsive */
@media (max-width: 1200px) {
    .container {
        max-width: 100%;
        padding: 0 15px;
    }
}

@media (max-width: 991px) {
    .provider-profile-img {
        margin-bottom: 20px;
    }
    
    .booking-card {
        margin-top: 30px;
    }
    
    .booking-card-wrapper {
        position: relative;
        top: 0;
    }
    
    .provider-name {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .provider-name {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 1.75rem;
    }
    
    .stat-box {
        padding: 20px;
    }
    
    .stat-value {
        font-size: 1.5rem;
    }
    
    .amount {
        font-size: 2rem;
    }
}

/* Date input calendar icon */
.booking-form input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
}

/* Time input clock icon */
.booking-form input[type="time"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
}

/* Select dropdown arrow */
.booking-form .form-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
}

/* Placeholder text */
.booking-form .form-control::placeholder {
    color: #ffffff;
    opacity: 0.5;
}

/* Option styles for select dropdown */
.booking-form .form-select option {
    background: var(--bg-dark);
    color: var(--text-primary);
}
</style>
@endpush

@push('scripts')
<script>
// Handle Add to Cart
document.getElementById('providerBookingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const button = this.querySelector('button[type="submit"]');
    const originalText = button.innerHTML;
    
    // Show loading state
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding to Cart...';
    
    // Prepare cart data
    const cartData = {
        type: 'service_provider',
        provider_id: formData.get('provider_id'),
        event_date: formData.get('event_date'),
        start_time: formData.get('start_time'),
        _token: '{{ csrf_token() }}'
    };
    
    // Add pricing tier or duration
    if (formData.get('pricing_tier_id')) {
        cartData.pricing_tier_id = formData.get('pricing_tier_id');
    } else {
        cartData.duration = parseInt(formData.get('duration')) || {{ $provider->min_booking_hours }};
    }
    
    // Add to cart via AJAX
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        body: JSON.stringify(cartData),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('success', 'Added to cart successfully!');
            updateCartCount();
            
            if (window.Livewire) {
                Livewire.dispatch('cartUpdated');
                Livewire.dispatch('itemAddedToCart');
            }
            
            setTimeout(() => {
                if (confirm('Service added to cart. Would you like to view your cart?')) {
                    window.location.href = '{{ route("cart.index") }}';
                }
            }, 500);
        } else {
            showNotification('error', data.message || 'Failed to add to cart');
        }
    })
    .catch(error => {
        showNotification('error', 'An error occurred. Please try again.');
        console.error('Error:', error);
    })
    .finally(() => {
        button.disabled = false;
        button.innerHTML = originalText;
    });
});

// Update cart count helper
function updateCartCount() {
    document.dispatchEvent(new CustomEvent('cartUpdated'));
}

// Handle Check Availability
document.getElementById('checkAvailabilityBtn').addEventListener('click', function() {
    const eventDate = document.getElementById('event_date').value;
    const providerId = document.querySelector('input[name="provider_id"]').value;
    
    if (!eventDate) {
        alert('Please select an event date first.');
        return;
    }
    
    const button = this;
    const originalText = button.innerHTML;
    
    // Show loading state
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Checking...';
    
    // Get duration
    let duration;
    if (document.getElementById('pricing_tier_id')) {
        const selectedOption = document.querySelector('#pricing_tier_id option:checked');
        duration = selectedOption ? parseInt(selectedOption.dataset.duration) : {{ $provider->min_booking_hours }};
    } else {
        duration = document.getElementById('duration').value;
    }
    
    // Check availability
    fetch('{{ route("services.provider.check-availability", $provider->id) }}', {
        method: 'POST',
        body: JSON.stringify({
            date: eventDate,
            duration: duration
        }),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.available) {
            showNotification('success', data.message);
        } else {
            showNotification('warning', data.message);
        }
    })
    .catch(error => {
        showNotification('error', 'Failed to check availability');
    })
    .finally(() => {
        button.disabled = false;
        button.innerHTML = originalText;
    });
});

// Notification helper
function showNotification(type, message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} notification-popup`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
        ${message}
    `;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => notification.classList.add('show'), 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add notification styles
const style = document.createElement('style');
style.textContent = `
    .notification-popup {
        position: fixed;
        top: 100px;
        right: 20px;
        min-width: 300px;
        z-index: 9999;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
    }
    
    .notification-popup.show {
        opacity: 1;
        transform: translateX(0);
    }
    
    .alert-success {
        background: rgba(34, 197, 94, 0.2);
        border: 1px solid var(--success-green);
        color: var(--success-green);
    }
    
    .alert-error {
        background: rgba(239, 68, 68, 0.2);
        border: 1px solid #ef4444;
        color: #ef4444;
    }
    
    .alert-warning {
        background: rgba(245, 158, 11, 0.2);
        border: 1px solid var(--warning-yellow);
        color: var(--warning-yellow);
    }
`;
document.head.appendChild(style);
</script>
@endpush

@endsection