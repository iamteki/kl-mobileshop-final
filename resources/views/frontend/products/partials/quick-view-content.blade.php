<div class="quick-view-content">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <div class="quick-view-image">
                <img src="{{ $product->main_image_url }}" 
                     alt="{{ $product->name }}" 
                     class="img-fluid rounded">
                
                @if($product->available_quantity > 0)
                    <span class="availability-badge {{ $product->availability_class }}">
                        {{ $product->available_quantity }} Available
                    </span>
                @else
                    <span class="availability-badge out-stock">
                        Out of Stock
                    </span>
                @endif
            </div>
        </div>
        
        <!-- Product Info -->
        <div class="col-md-6">
            <div class="quick-view-info">
                <div class="product-category text-primary mb-2">
                    {{ $product->category->name }}
                </div>
                
                <h4 class="product-name mb-3">{{ $product->name }}</h4>
                
                @if($product->short_description)
                    <p class="product-description text-muted mb-3">
                        {{ $product->short_description }}
                    </p>
                @endif
                
                <!-- Specifications -->
                @if($product->specifications && count($product->specifications) > 0)
                    <ul class="product-specs mb-3">
                        @foreach($product->specifications as $spec)
                            <li>
                                <i class="{{ $spec['icon'] }}"></i> 
                                {{ $spec['value'] }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                
                <!-- Price -->
                <div class="product-price mb-4">
                    <h3 class="mb-0">
                        LKR {{ number_format($product->base_price) }}
                        <small class="text-muted">/{{ $product->price_unit ?? 'day' }}</small>
                    </h3>
                </div>
                
                <!-- Variations if any -->
                @if($product->variations && $product->variations->count() > 0)
                    <div class="variations mb-3">
                        <label class="form-label">Select Option:</label>
                        <select class="form-select" id="quick-view-variation">
                            @foreach($product->variations as $variation)
                                <option value="{{ $variation->id }}" 
                                        data-price="{{ $variation->price }}"
                                        {{ $variation->available_quantity == 0 ? 'disabled' : '' }}>
                                    {{ $variation->name }} - LKR {{ number_format($variation->price) }}
                                    {{ $variation->available_quantity == 0 ? '(Out of Stock)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                
               <!-- Action Buttons -->
<div class="d-flex gap-2">
    @if($product->available_quantity > 0)
        <button class="btn btn-primary flex-fill" 
                onclick="quickViewAddToCart({{ $product->id }}, event)">
            <i class="fas fa-shopping-cart me-2"></i>
            Add to Cart
        </button>
    @else
        <button class="btn btn-secondary flex-fill" disabled>
            <i class="fas fa-times me-2"></i>
            Out of Stock
        </button>
    @endif
    
    <a href="{{ route('product.show', [$product->category->slug, $product->slug]) }}" 
       class="btn btn-outline-primary">
        <i class="fas fa-eye me-2"></i>
        View Details
    </a>
</div>
                
                <!-- Additional Info -->
                <div class="mt-3 text-muted small">
                    <p class="mb-1">
                        <i class="fas fa-check-circle text-success"></i> 
                        Quality guaranteed
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-truck text-success"></i> 
                        Delivery & setup available
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.quick-view-content {
    padding: 20px;
}

.quick-view-image {
    position: relative;
    background: var(--bg-dark);
    border-radius: 10px;
    overflow: hidden;
}

.quick-view-image img {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: cover;
}

.availability-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    background: rgba(0,0,0,0.8);
    color: white;
}

.availability-badge.in-stock {
    background: rgba(34, 197, 94, 0.9);
}

.availability-badge.low-stock {
    background: rgba(245, 158, 11, 0.9);
}

.availability-badge.out-stock {
    background: rgba(239, 68, 68, 0.9);
}

.quick-view-info {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-category {
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.product-specs {
    list-style: none;
    padding: 0;
    margin: 0;
}

.product-specs li {
    padding: 5px 0;
    color: var(--text-gray);
}

.product-specs i {
    color: var(--primary-purple);
    margin-right: 8px;
    width: 16px;
}

.product-price h3 {
    color: var(--primary-purple);
    font-weight: 700;
}

.variations .form-select {
    background: var(--bg-dark);
    border: 1px solid var(--border-dark);
    color: var(--text-light);
}

@media (max-width: 768px) {
    .quick-view-content .row {
        flex-direction: column;
    }
    
    .quick-view-image {
        margin-bottom: 20px;
    }
}
</style>