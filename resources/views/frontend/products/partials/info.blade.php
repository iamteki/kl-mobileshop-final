<div class="product-info-section">
    <div class="product-category">{{ strtoupper($category->name) }}</div>
    <h1 class="product-title">{{ $product->name }}</h1>
    
    <div class="product-meta">
        <span class="sku">SKU: {{ $product->sku }}</span>
        <div class="availability-status {{ $product->available_quantity > 0 ? 'in-stock' : 'out-stock' }}">
            <i class="fas fa-{{ $product->available_quantity > 0 ? 'check' : 'times' }}-circle"></i>
            <span>{{ $product->available_quantity }} Units Available</span>
        </div>
        @if($product->ratings_count > 0)
            <div class="rating">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star{{ $i <= $product->average_rating ? '' : '-half-alt' }}"></i>
                    @endfor
                </div>
                <span class="rating-text">{{ $product->average_rating }} ({{ $product->ratings_count }} rentals)</span>
            </div>
        @endif
    </div>

    <p class="product-description text-gray mb-4">
        {{ $product->short_description }}
    </p>

    <!-- Pricing Section -->
    <div class="pricing-section">
        <x-price-display 
            :amount="$product->base_price" 
            size="large" />
        <div class="price-note">Per day rental • Minimum 1 day</div>
        
        @if(count($pricingTiers) > 0)
            <div class="pricing-tiers">
                @foreach($pricingTiers as $tier)
                    <div class="tier-card">
                        <div class="tier-days">{{ $tier['days'] }}</div>
                        <div class="tier-price">
                            <x-price-display 
                                :amount="$tier['price']" 
                                period="day"
                                size="small"
                                :showCurrency="false" />
                        </div>
                        @if($tier['savings'] > 0)
                            <div class="tier-save">Save {{ $tier['savings'] }}%</div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Variations -->
    @if($product->variations->count() > 0)
        @livewire('variation-selector', ['product' => $product])
    @endif

    <!-- Booking Section -->
    @livewire('booking-form', ['product' => $product])

    <!-- Additional Info -->
    <div class="mt-4 p-3 bg-card rounded">
        <small class="text-gray">
            <i class="fas fa-info-circle me-2"></i>
            Free delivery within Kuala Lumpur • Setup assistance available • 
            Insurance required for rentals over LKR 50,000
        </small>
    </div>
</div>

@push('styles')
<style>
/* Override to ensure product title is properly sized */
.product-title {
    font-family: var(--font-heading) !important;
    font-size: 3.5rem !important;
    font-weight: 400 !important;
    margin-bottom: 20px !important;
    color: var(--text-light) !important;
    text-transform: uppercase !important;
    letter-spacing: 1.5px !important;
    line-height: 1 !important;
}

@media (max-width: 768px) {
    .product-title {
        font-size: 2.5rem !important;
    }
}
</style>
@endpush