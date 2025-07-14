@props([
    'provider',
    'showBookButton' => true
])

<a href="{{ route('services.provider', [$provider->category->slug, $provider->slug]) }}" class="provider-card-link">
    <div class="provider-card h-100">
        <div class="provider-image">
            <img src="{{ $provider->profile_image_url }}" 
                 alt="{{ $provider->display_name }}"
                 loading="lazy">
            
            @if($provider->badge)
                <span class="provider-badge {{ $provider->badge_class ?? '' }}">
                    {{ $provider->badge }}
                </span>
            @endif
            
            @if($provider->featured)
                <span class="featured-badge">
                    <i class="fas fa-star"></i> Featured
                </span>
            @endif
        </div>
        
        <div class="provider-info">
            <div class="provider-header">
                <h4 class="provider-name">{{ $provider->display_name }}</h4>
                @if($provider->rating > 0)
                    <div class="provider-rating">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $provider->rating ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                        <span class="rating-value">{{ number_format($provider->rating, 1) }}</span>
                        <span class="review-count">({{ $provider->total_reviews }})</span>
                    </div>
                @endif
            </div>
            
            <p class="provider-bio">{!! Str::limit(strip_tags($provider->bio), 100) !!}</p>
            
            <div class="provider-details">
                @if($provider->experience_level)
                    <div class="detail-item">
                        <i class="fas fa-award"></i>
                        {{ $provider->experience_level }}
                    </div>
                @endif
                
                @if($provider->years_experience > 0)
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        {{ $provider->years_experience }} years
                    </div>
                @endif
                
                @if($provider->languages && count($provider->languages) > 0)
                    <div class="detail-item">
                        <i class="fas fa-language"></i>
                        {{ implode(', ', array_slice($provider->languages, 0, 2)) }}
                        @if(count($provider->languages) > 2)
                            +{{ count($provider->languages) - 2 }}
                        @endif
                    </div>
                @endif
            </div>
            
            @if($provider->specialties && count($provider->specialties) > 0)
                <div class="provider-specialties">
                    @foreach(array_slice($provider->specialties, 0, 3) as $specialty)
                        <span class="specialty-tag">{{ $specialty }}</span>
                    @endforeach
                    @if(count($provider->specialties) > 3)
                        <span class="specialty-tag">+{{ count($provider->specialties) - 3 }}</span>
                    @endif
                </div>
            @endif
            
            <div class="provider-footer">
                <div class="provider-price">
                    <span class="price-label">From</span>
                    <div class="price-amount">
                        <span class="currency">LKR</span>
                        <span class="amount">{{ number_format($provider->base_price) }}</span>
                        <span class="price-unit">/{{ $provider->price_unit }}</span>
                    </div>
                </div>
                
                @if($showBookButton)
                    <span class="btn btn-primary btn-sm view-profile-btn">
                        View Profile
                    </span>
                @endif
            </div>
        </div>
    </div>
</a>

<style>
/* Import Bebas Neue font */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap');

.provider-card-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.provider-card {
    background: var(--bg-card);
    border-radius: 25px;
    overflow: hidden;
    transition: all 0.3s;
    border: 1px solid var(--border-dark);
    display: flex;
    flex-direction: column;
    cursor: pointer;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    min-height: 520px;
    position: relative;
}

.provider-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(147, 51, 234, 0.3);
    border-color: var(--primary-purple);
}

.provider-image {
    height: 240px;
    position: relative;
    overflow: hidden;
    background-color: var(--bg-darker);
}

.provider-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.provider-card:hover .provider-image img {
    transform: scale(1.1);
}

.provider-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.9);
    color: white;
    padding: 6px 18px;
    border-radius: 20px;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 700;
    backdrop-filter: blur(10px);
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

.featured-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--accent-violet) 100%);
    color: white;
    padding: 6px 18px;
    border-radius: 20px;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    box-shadow: 0 5px 15px rgba(147, 51, 234, 0.3);
}

.provider-info {
    padding: 30px;
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.provider-header {
    margin-bottom: 15px;
}

.provider-name {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.75rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    margin-bottom: 8px;
    color: var(--text-light);
    line-height: 1;
}

.provider-rating {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.875rem;
}

.rating-value {
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    color: var(--text-light);
    margin-left: 5px;
}

.review-count {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 0.75rem;
}

.provider-bio {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 0.875rem;
    margin-bottom: 20px;
    line-height: 1.6;
    min-height: 48px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}

.provider-details {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 20px;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--text-gray);
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
}

.detail-item i {
    color: var(--primary-purple);
    font-size: 0.875rem;
}

.provider-specialties {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 25px;
}

.specialty-tag {
    background: rgba(147, 51, 234, 0.1);
    color: var(--primary-purple);
    padding: 5px 14px;
    border-radius: 15px;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 600;
    border: 1px solid rgba(147, 51, 234, 0.2);
    transition: all 0.3s;
}

.provider-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 25px;
    border-top: 1px solid var(--border-dark);
}

.provider-price {
    display: flex;
    flex-direction: column;
}

.price-label {
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    color: var(--text-gray);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
    margin-bottom: 5px;
}

.price-amount {
    display: flex;
    align-items: baseline;
}

.currency {
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    color: var(--text-gray);
    margin-right: 4px;
}

.amount {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.75rem;
    letter-spacing: 0.02em;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1;
}

.price-unit {
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    color: var(--text-gray);
    margin-left: 2px;
}

/* Button Styling */
.view-profile-btn {
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    font-size: 0.75rem;
    padding: 10px 20px;
    background-color: var(--primary-purple);
    border-color: var(--primary-purple);
    color: white;
    border-radius: 4px;
    pointer-events: none; /* Prevent button from intercepting clicks */
}

/* Hover Effects */
.provider-card:hover .specialty-tag {
    background: rgba(147, 51, 234, 0.15);
}

.provider-card:hover .provider-name {
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Responsive */
@media (max-width: 1400px) {
    .provider-card {
        min-height: 500px;
    }
}

@media (max-width: 768px) {
    .provider-card {
        min-height: auto;
    }
    
    .provider-image {
        height: 200px;
    }
    
    .provider-info {
        padding: 25px;
    }
}
</style>