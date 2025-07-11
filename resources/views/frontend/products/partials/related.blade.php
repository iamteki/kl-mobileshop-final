<!-- Related Products -->
<div class="related-products">
    <h2 class="related-title text-center mb-5">Frequently Rented <span>Together</span></h2>
    <div class="container">
        <div class="row g-4">
            @foreach($relatedProducts as $relatedProduct)
                <div class="col-lg-3 col-md-6">
                    <div class="related-product-card">
                        <a href="{{ route('product.show', [$relatedProduct->category->slug, $relatedProduct->slug]) }}" class="related-product-link">
                            <div class="related-product-image">
                                <img src="{{ $relatedProduct->main_image_url ?? 'https://via.placeholder.com/400x300' }}" 
                                     alt="{{ $relatedProduct->name }}"
                                     loading="lazy">
                                
                                @if($relatedProduct->available_quantity > 0)
                                    <span class="availability-badge in-stock">
                                        {{ $relatedProduct->available_quantity }} Available
                                    </span>
                                @else
                                    <span class="availability-badge out-stock">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                            
                            <div class="related-product-info">
                                <div class="related-product-category">{{ $relatedProduct->category->name }}</div>
                                <h4 class="related-product-title">{{ $relatedProduct->name }}</h4>
                                
                                <div class="related-product-footer">
                                    <div class="related-product-price">
                                        <span class="currency">LKR</span>
                                        <span class="amount">{{ number_format($relatedProduct->base_price) }}</span>
                                        <span class="period">/day</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
/* Related Products Section */
.related-products {
    background-color: var(--bg-dark);
    padding: 60px 0;
    width: 100%;
}

.related-title {
    font-family: var(--font-heading);
    font-size: 3rem;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--text-light);
    line-height: 1;
}

.related-title span {
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Related Product Cards */
.related-product-card {
    background: var(--bg-card);
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    border: 1px solid var(--border-dark);
}

.related-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(147, 51, 234, 0.3);
    border-color: var(--primary-purple);
}

.related-product-link {
    text-decoration: none;
    color: inherit;
    display: block;
    height: 100%;
}

.related-product-image {
    height: 200px;
    overflow: hidden;
    position: relative;
    background: var(--bg-darker);
}

.related-product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.related-product-card:hover .related-product-image img {
    transform: scale(1.1);
}

.related-product-info {
    padding: 20px;
}

.related-product-category {
    color: var(--primary-purple);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
    font-family: var(--font-body);
    font-weight: 600;
}

.related-product-title {
    font-family: var(--font-heading);
    color: var(--text-light);
    font-size: 1.25rem !important;
    font-weight: 400;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    line-height: 1.2;
}

.related-product-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    border-top: 1px solid var(--border-dark);
}

.related-product-price {
    display: flex;
    align-items: baseline;
    gap: 4px;
}

.related-product-price .currency {
    font-family: var(--font-body);
    font-weight: 600;
    color: var(--text-gray);
    font-size: 0.75rem;
    align-self: flex-start;
    margin-top: 0.25em;
}

.related-product-price .amount {
    font-family: var(--font-heading);
    font-size: 2rem;
    font-weight: 400;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 0.5px;
}

.related-product-price .period {
    font-family: var(--font-body);
    font-weight: 400;
    color: var(--text-gray);
    font-size: 0.75rem;
    align-self: flex-end;
    margin-bottom: 0.25em;
}

/* Availability Badge */
.availability-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    background: rgba(0,0,0,0.8);
    color: white;
    font-family: var(--font-body);
}

.availability-badge.in-stock {
    background: rgba(34, 197, 94, 0.9);
}

.availability-badge.out-stock {
    background: rgba(239, 68, 68, 0.9);
}

/* Responsive */
@media (max-width: 768px) {
    .related-title {
        font-size: 2.5rem;
    }
    
    .related-product-title {
        font-size: 1.125rem !important;
    }
    
    .related-product-price .amount {
        font-size: 1.25rem;
    }
}
</style>