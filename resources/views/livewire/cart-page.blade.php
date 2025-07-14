{{-- resources/views/livewire/cart-page.blade.php --}}
<div> {{-- Single root element wrapper for Livewire --}}
    @if(count($cart['items']) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-items-section">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="text-white mb-0">Cart Items ({{ $cart['count'] }})</h5>
                        <button wire:click="clearCart" 
                                wire:confirm="Are you sure you want to clear your cart?"
                                class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash me-2"></i>Clear Cart
                        </button>
                    </div>
                    
                    {{-- Display ALL cart items --}}
                    @foreach($cart['items'] as $itemId => $item)
                        <div class="cart-item-card position-relative" wire:key="cart-item-{{ $itemId }}-{{ $item['quantity'] }}">
                            <div class="row g-4">
                                <div class="col-md-2">
                                    <div class="cart-item-image">
                                        @if(!empty($item['image']) && $item['image'] !== 'https://via.placeholder.com/300')
                                            <img src="{{ $item['image'] }}" 
                                                 alt="{{ $item['name'] }}"
                                                 onerror="this.src='/images/placeholder.jpg'">
                                        @else
                                            <div class="placeholder-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-5">
                                    <h6 class="cart-item-title">{{ $item['name'] }}</h6>
                                    
                                    @if(isset($item['variation']))
                                        <p class="text-muted small mb-1">Variation: {{ $item['variation'] }}</p>
                                    @endif
                                    
                                    <p class="text-muted small mb-2">
                                        Category: {{ $item['category'] ?? 'General' }}
                                    </p>
                                    
                                    @if(isset($item['event_date']))
                                        <p class="text-info small mb-0">
                                            <i class="fas fa-calendar me-1"></i>
                                            Event Date: {{ \Carbon\Carbon::parse($item['event_date'])->format('M d, Y') }}
                                        </p>
                                    @endif
                                    
                                    @if($item['type'] === 'service_provider' && isset($item['start_time']))
                                        <p class="text-info small mb-0">
                                            <i class="fas fa-clock me-1"></i>
                                            Start Time: {{ $item['start_time'] }}
                                            @if(isset($item['duration_text']))
                                                | Duration: {{ $item['duration_text'] }}
                                            @endif
                                        </p>
                                    @endif
                                </div>
                                
                                <div class="col-md-2">
                                    @if($item['type'] === 'product')
                                        <div class="quantity-controls">
                                            <button wire:click="decreaseQuantity('{{ $itemId }}')" 
                                                    wire:loading.attr="disabled"
                                                    wire:target="decreaseQuantity('{{ $itemId }}')"
                                                    class="qty-btn-small"
                                                    @if($item['quantity'] <= 1) disabled @endif>
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" 
                                                   value="{{ $item['quantity'] }}" 
                                                   class="qty-input-small"
                                                   min="1"
                                                   readonly>
                                            <button wire:click="increaseQuantity('{{ $itemId }}')" 
                                                    wire:loading.attr="disabled"
                                                    wire:target="increaseQuantity('{{ $itemId }}')"
                                                    class="qty-btn-small">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        @if(isset($item['rental_days']))
                                            <p class="text-muted small text-center mt-1 mb-0">
                                                {{ $item['rental_days'] }} {{ Str::plural('day', $item['rental_days']) }}
                                            </p>
                                        @endif
                                    @else
                                        <p class="text-muted small text-center">Qty: 1</p>
                                    @endif
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="cart-item-price">
                                        <p class="price mb-1">
                                            LKR {{ number_format($item['price'] * ($item['quantity'] ?? 1) * ($item['rental_days'] ?? 1)) }}
                                        </p>
                                        @if($item['type'] === 'product' && $item['quantity'] > 1)
                                            <p class="text-muted small">
                                                LKR {{ number_format($item['price']) }} each
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-1">
                                    <button wire:click="removeItem('{{ $itemId }}')" 
                                            wire:confirm="Are you sure you want to remove this item?"
                                            class="btn btn-link text-danger p-0">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            
                            {{-- Loading overlay for specific item - Only show when this specific item is being updated --}}
                            @if($updatingItemId === $itemId)
                                <div wire:loading class="item-loading-overlay">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            @endif
                            
                            <div wire:loading wire:target="removeItem('{{ $itemId }}')" class="item-loading-overlay">
                                <div class="spinner-border text-danger" role="status">
                                    <span class="visually-hidden">Removing...</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="cart-summary-wrapper">
                    <div class="cart-summary">
                        <h4 class="summary-title mb-4">Order Summary</h4>
                        
                        {{-- Coupon Section --}}
                        <div class="coupon-section mb-4">
                            @if(!$couponApplied)
                                <div class="input-group">
                                    <input type="text" 
                                           wire:model="couponCode" 
                                           class="form-control coupon-input" 
                                           placeholder="Enter coupon code">
                                    <button wire:click="applyCoupon" 
                                            class="btn btn-outline-primary"
                                            wire:loading.attr="disabled">
                                        <span wire:loading.remove wire:target="applyCoupon">Apply</span>
                                        <span wire:loading wire:target="applyCoupon">
                                            <span class="spinner-border spinner-border-sm" role="status"></span>
                                        </span>
                                    </button>
                                </div>
                            @else
                                <div class="applied-coupon d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fas fa-tag me-2"></i>
                                        Coupon: <strong>{{ $couponCode }}</strong>
                                    </span>
                                    <button wire:click="removeCoupon" 
                                            class="btn btn-link text-danger p-0">
                                        Remove
                                    </button>
                                </div>
                            @endif
                            
                            @if($couponMessage)
                                <div class="mt-2 small {{ $couponApplied ? 'text-success' : 'text-danger' }}">
                                    {{ $couponMessage }}
                                </div>
                            @endif
                        </div>
                        
                        {{-- Price Breakdown --}}
                        <div class="summary-details">
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span>LKR {{ number_format($cart['subtotal'] ?? 0) }}</span>
                            </div>
                            
                            @if(isset($cart['discount']) && $cart['discount'] > 0)
                                <div class="summary-row text-success">
                                    <span>Discount</span>
                                    <span>-LKR {{ number_format($cart['discount']) }}</span>
                                </div>
                            @endif
                            
                            <div class="summary-row">
                                <span>Tax (15% VAT)</span>
                                <span>LKR {{ number_format($cart['tax'] ?? 0) }}</span>
                            </div>
                            
                            <hr class="my-3">
                            
                            <div class="summary-row total">
                                <span>Total</span>
                                <span>LKR {{ number_format($cart['total'] ?? 0) }}</span>
                            </div>
                        </div>
                        
                        <button wire:click="proceedToCheckout" 
                                class="btn btn-primary btn-lg w-100 mt-4"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="proceedToCheckout">
                                Proceed to Checkout
                            </span>
                            <span wire:loading wire:target="proceedToCheckout">
                                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                Processing...
                            </span>
                        </button>
                        
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 mt-2">
                            Continue Shopping
                        </a>
                        
                        <div class="security-info text-center mt-3">
                            <i class="fas fa-lock text-success me-2"></i>
                            <small class="text-muted">Secure checkout powered by Stripe</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
            <h3>Your cart is empty</h3>
            <p class="text-muted mb-4">Start adding items to your cart!</p>
            <a href="{{ route('home') }}" class="btn btn-primary">
                Start Shopping
            </a>
        </div>
    @endif
</div>

{{-- Toast Notifications Outside Livewire Component --}}
@once
    @push('modals')
        {{-- Dynamic Toast Container --}}
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1050" id="dynamicToasts">
            <!-- Dynamic toasts will be inserted here -->
        </div>
    @endpush
@endonce

    @push('styles')
    <style>
    /* Cart Item Cards */
    .cart-item-card {
        background: var(--bg-card, #141414);
        border: 1px solid var(--border-dark, rgba(255, 255, 255, 0.1));
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        position: relative;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .cart-item-card:hover {
        border-color: var(--primary-purple, #9333EA);
        box-shadow: 0 0 20px rgba(147, 51, 234, 0.2);
    }

    .cart-item-image {
        width: 100%;
        height: 120px;
        overflow: hidden;
        border-radius: 10px;
        background: var(--bg-darker, #0A0A0A);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Placeholder image */
    .placeholder-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(147, 51, 234, 0.1);
        color: var(--primary-purple, #9333EA);
        font-size: 40px;
    }

    .cart-item-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-light, #fff);
        margin-bottom: 8px;
    }

    /* Quantity Controls */
    .quantity-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .qty-btn-small {
        width: 30px;
        height: 30px;
        border: 1px solid var(--border-dark, rgba(255, 255, 255, 0.2));
        background: transparent;
        color: var(--text-light, #fff);
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        outline: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .qty-btn-small:hover:not(:disabled) {
        background: var(--primary-purple, #9333EA);
        border-color: var(--primary-purple, #9333EA);
        color: #fff;
    }

    .qty-btn-small:active:not(:disabled) {
        transform: scale(0.95);
    }

    .qty-btn-small:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .qty-input-small {
        width: 50px;
        height: 30px;
        text-align: center;
        background: transparent;
        border: 1px solid var(--border-dark, rgba(255, 255, 255, 0.2));
        color: var(--text-light, #fff);
        border-radius: 5px;
        -moz-appearance: textfield;
        cursor: default;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    
    .qty-input-small:focus {
        outline: none;
        border-color: var(--border-dark, rgba(255, 255, 255, 0.2));
    }
    
    .qty-input-small::-webkit-outer-spin-button,
    .qty-input-small::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Price Display */
    .cart-item-price .price {
        font-size: 20px;
        font-weight: 600;
        color: var(--secondary-purple, #C084FC);
    }

    /* Summary Section */
    .cart-summary-wrapper {
        position: sticky;
        top: 20px;
        max-height: calc(100vh - 40px);
        overflow-y: auto;
        z-index: 10;
    }

    .cart-summary {
        background: var(--bg-card, #141414);
        border: 1px solid var(--border-dark, rgba(255, 255, 255, 0.1));
        border-radius: 15px;
        padding: 30px;
    }

    .summary-title {
        font-size: 24px;
        font-weight: 600;
        color: var(--text-light, #fff);
        margin-bottom: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        color: var(--text-gray, #9CA3AF);
    }

    .summary-row.total {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-light, #fff);
    }

    /* Coupon Section - Fixed */
    .coupon-section .coupon-input {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--border-dark, rgba(255, 255, 255, 0.2));
        color: var(--text-light, #fff);
    }

    /* Make placeholder text visible */
    .coupon-section .coupon-input::placeholder {
        color: rgba(255, 255, 255, 0.5) !important;
        opacity: 1 !important;
    }

    .coupon-section .coupon-input:focus {
        background: rgba(255, 255, 255, 0.08);
        border-color: var(--primary-purple, #9333EA);
        box-shadow: 0 0 0 0.2rem rgba(147, 51, 234, 0.25);
        color: #fff;
    }

    .applied-coupon {
        background: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.3);
        padding: 10px 15px;
        border-radius: 8px;
        color: #22C55E;
    }

    /* Loading overlay for items */
    .item-loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 5;
        border-radius: 15px;
    }

    /* Button states */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Custom Toast Notifications */
    .custom-toast {
        background: var(--bg-card, #141414);
        border: 1px solid rgba(147, 51, 234, 0.3);
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(147, 51, 234, 0.2);
        min-width: 350px;
        animation: slideInRight 0.3s ease-out;
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .custom-toast .toast-header {
        background: transparent;
        border-bottom: 1px solid rgba(147, 51, 234, 0.2);
        color: var(--text-light, #fff);
        padding: 12px 16px;
    }
    
    .custom-toast .toast-body {
        color: var(--text-gray, #9CA3AF);
        padding: 16px;
    }
    
    .toast-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }
    
    .toast-icon.success {
        background: rgba(34, 197, 94, 0.2);
        color: #22C55E;
    }
    
    .toast-icon.error {
        background: rgba(239, 68, 68, 0.2);
        color: #EF4444;
    }
    
    .toast-icon.warning {
        background: rgba(245, 158, 11, 0.2);
        color: #F59E0B;
    }
    
    .toast-icon.info {
        background: rgba(59, 130, 246, 0.2);
        color: #3B82F6;
    }
    
    .custom-toast .btn-close {
        filter: invert(1);
        opacity: 0.8;
    }
    
    .custom-toast .btn-close:hover {
        opacity: 1;
    }

    /* Fix for navbar overlap */
    @media (min-width: 992px) {
        .cart-summary-wrapper {
            top: 80px;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .cart-item-card {
            padding: 15px;
        }
        
        .cart-item-image {
            height: 80px;
        }
        
        .cart-summary-wrapper {
            position: static;
            max-height: none;
            margin-top: 30px;
        }
        
        .placeholder-image {
            font-size: 30px;
        }
    }
    </style>
    @endpush
    
    @push('scripts')
    <script>
        // Function to show toast
        function showToast(message, type = 'info') {
            const toastContainer = document.getElementById('dynamicToasts');
            const toastId = 'toast-' + Date.now();
            
            const icons = {
                success: 'fa-check-circle',
                error: 'fa-exclamation-circle',
                warning: 'fa-exclamation-triangle',
                info: 'fa-info-circle'
            };
            
            const toastHtml = `
                <div class="toast custom-toast show" role="alert" id="${toastId}" data-bs-autohide="true" data-bs-delay="5000">
                    <div class="toast-header">
                        <div class="toast-icon ${type}">
                            <i class="fas ${icons[type]}"></i>
                        </div>
                        <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            `;
            
            toastContainer.insertAdjacentHTML('beforeend', toastHtml);
            
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement);
            
            // Remove toast from DOM after it's hidden
            toastElement.addEventListener('hidden.bs.toast', () => {
                toastElement.remove();
            });
        }
        
        // Initialize Bootstrap toasts
        document.addEventListener('DOMContentLoaded', function() {
            const toastElList = document.querySelectorAll('.toast');
            const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
            
            // Prevent manual input in quantity fields
            document.querySelectorAll('.qty-input-small').forEach(input => {
                input.addEventListener('keydown', (e) => {
                    e.preventDefault();
                    return false;
                });
                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    return false;
                });
                input.addEventListener('drop', (e) => {
                    e.preventDefault();
                    return false;
                });
            });
        });
        
        // Listen for Livewire events to show toasts
        window.addEventListener('showToast', event => {
            showToast(event.detail.message, event.detail.type);
        });
        
        document.addEventListener('livewire:init', () => {
            // Re-apply input restrictions after Livewire updates
            Livewire.hook('message.processed', (message, component) => {
                // Re-enable buttons after Livewire updates
                document.querySelectorAll('.qty-btn-small').forEach(btn => {
                    if (!btn.closest('.cart-item-card').querySelector('.item-loading-overlay')) {
                        btn.disabled = false;
                    }
                });
                
                // Re-apply input restrictions
                document.querySelectorAll('.qty-input-small').forEach(input => {
                    input.addEventListener('keydown', (e) => {
                        e.preventDefault();
                        return false;
                    });
                });
            });
        });
    </script>
    @endpush
</div>