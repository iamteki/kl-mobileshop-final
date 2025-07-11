<!-- price-display.blade.php -->
@props([
    'amount',
    'currency' => 'LKR',
    'period' => null,
    'size' => 'default', // default, large, small
    'showCurrency' => true
])

<div class="price-display {{ $size }}">
    @if($showCurrency)
        <span class="currency">{{ $currency }}</span>
    @endif
    <span class="amount">{{ number_format($amount) }}</span>
    @if($period)
        <span class="period">/{{ $period }}</span>
    @endif
</div>

<style>
.price-display {
    display: inline-flex;
    align-items: baseline;
    gap: 4px;
    line-height: 1;
}

/* Currency styling */
.price-display .currency {
    font-family: var(--font-body);
    font-weight: 600;
    color: var(--text-gray);
    font-size: 0.875rem;
    align-self: flex-start;
    margin-top: 0.25em;
}

/* Amount styling with Bebas */
.price-display .amount {
    font-family: var(--font-heading);
    font-weight: 400;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 1px;
}

/* Period styling */
.price-display .period {
    font-family: var(--font-body);
    font-weight: 400;
    color: var(--text-gray);
    font-size: 0.875rem;
    align-self: flex-end;
    margin-bottom: 0.25em;
}

/* Size variations - INCREASED FONT SIZES */
.price-display.default .amount {
    font-size: 2.5rem; /* Increased from 2rem */
}

.price-display.default .currency {
    font-size: 1rem; /* Increased from 0.875rem */
}

.price-display.default .period {
    font-size: 1rem; /* Increased from 0.875rem */
}

.price-display.large .amount {
    font-size: 4rem; /* Increased from 3rem */
}

.price-display.large .currency {
    font-size: 1.25rem; /* Increased from 1rem */
}

.price-display.large .period {
    font-size: 1.25rem; /* Increased from 1rem */
}

.price-display.small .amount {
    font-size: 2rem; /* Increased from 1.5rem */
}

.price-display.small .currency {
    font-size: 0.875rem; /* Increased from 0.75rem */
}

.price-display.small .period {
    font-size: 0.875rem; /* Increased from 0.75rem */
}

/* Responsive */
@media (max-width: 768px) {
    .price-display.default .amount {
        font-size: 2.25rem; /* Increased from 1.75rem */
    }
    
    .price-display.large .amount {
        font-size: 3.5rem; /* Increased from 2.5rem */
    }
    
    .price-display.small .amount {
        font-size: 1.75rem; /* Increased from 1.25rem */
    }
}
</style>