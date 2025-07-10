<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'KL Mobile - Event Equipment Rental & DJ Services')</title>
    <meta name="description" content="@yield('description', 'Rent professional event equipment, sound systems, lighting, and book DJ services. Instant booking with real-time availability in Kuala Lumpur.')">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    @include('layouts.partials.styles')
    
    <!-- Page Specific CSS -->
    @stack('styles')
    
    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body>
    <!-- Header -->
    @include('layouts.partials.header')
    
    <!-- Navigation -->
    @include('layouts.partials.navigation')
    
    <!-- Breadcrumb -->
    @hasSection('breadcrumb')
        <div class="breadcrumb-section">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
        </div>
    @endif
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('layouts.partials.footer')
    
    <!-- Scripts -->
    @include('layouts.partials.scripts')
    
    <!-- Livewire Scripts (This already includes Alpine.js in Livewire v3) -->
    @livewireScripts
    
    <!-- DO NOT include Alpine.js separately if using Livewire 3 -->
    <!-- It's already bundled with Livewire -->
    
    <!-- Custom Scripts -->
    @stack('scripts')
    <script>
// Quick View Modal Handler
document.addEventListener('DOMContentLoaded', function() {
    const quickViewModal = document.getElementById('quickViewModal');
    
    if (quickViewModal) {
        quickViewModal.addEventListener('show.bs.modal', function(event) {
            // Get the button that triggered the modal
            const button = event.relatedTarget;
            const productId = button.getAttribute('data-product-id');
            const modalBody = this.querySelector('.modal-body');
            
            // Show loading spinner
            modalBody.innerHTML = `
                <div class="text-center p-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;
            
            // Fetch product data
            fetch(`/products/${productId}/quick-view`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        modalBody.innerHTML = data.html;
                    } else {
                        throw new Error('Failed to load product');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    modalBody.innerHTML = `
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Failed to load product details. Please try again.
                        </div>
                    `;
                });
        });
        
        // Clear modal content when closed
        quickViewModal.addEventListener('hidden.bs.modal', function() {
            const modalBody = this.querySelector('.modal-body');
            modalBody.innerHTML = `
                <div class="text-center p-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;
        });
    }
});

// Quick View Add to Cart Function
function quickViewAddToCart(productId) {
    const button = event.currentTarget;
    const originalHTML = button.innerHTML;
    
    // Disable button and show loading
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding...';
    
    // Get default rental period (1 day) - same as product card
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const eventDate = tomorrow.toISOString().split('T')[0];
    
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    // Match the exact data structure from the product card
    const cartData = {
        type: 'product',
        product_id: productId,
        quantity: 1,
        rental_days: 1,
        event_date: eventDate
    };
    
    // Check if there's a variation selected
    const variationSelect = document.getElementById('quick-view-variation');
    if (variationSelect) {
        cartData.variation_id = variationSelect.value;
    }
    
    fetch('/cart/add', {
        method: 'POST',
        body: JSON.stringify(cartData),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update Livewire cart components
            if (window.Livewire) {
                Livewire.dispatch('itemAddedToCart');
            }
            
            // Show success animation
            button.innerHTML = '<i class="fas fa-check me-2"></i>Added!';
            button.classList.remove('btn-primary');
            button.classList.add('btn-success');
            
            // Update cart count if element exists
            const cartCount = document.querySelector('.cart-count');
            if (cartCount && data.cartCount) {
                cartCount.textContent = data.cartCount;
            }
            
            // Close modal after a delay
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('quickViewModal'));
                if (modal) {
                    modal.hide();
                }
            }, 1500);
            
        } else {
            alert(data.message || 'Failed to add to cart');
            button.innerHTML = originalHTML;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
        button.innerHTML = originalHTML;
        button.disabled = false;
    });
}
</script>
</body>
</html>