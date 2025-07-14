<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartService;

class CartPage extends Component
{
    public $cart = [];
    public $couponCode = '';
    public $couponApplied = false;
    public $couponMessage = '';
    public $updatingItemId = null;
    
    protected $listeners = ['cartUpdated' => 'refreshCart'];
    
    public function mount()
    {
        $this->refreshCart();
    }
    
    public function refreshCart()
    {
        $cartService = app(CartService::class);
        $this->cart = $cartService->getCart();
        
        // Check if coupon is applied
        if (isset($this->cart['coupon']) && $this->cart['coupon']) {
            $this->couponApplied = true;
            $this->couponCode = $this->cart['coupon'];
        }
    }
    
    public function increaseQuantity($itemId)
    {
        $this->updatingItemId = $itemId;
        
        $cartService = app(CartService::class);
        $item = $this->cart['items'][$itemId] ?? null;
        
        if (!$item) {
            $this->updatingItemId = null;
            return;
        }
        
        $newQuantity = $item['quantity'] + 1;
        
        // Check available quantity for products
        if ($item['type'] === 'product') {
            $availableQty = $this->getAvailableQuantity($item);
            
            if ($newQuantity > $availableQty) {
                $this->dispatch('showToast', 
                    message: 'Only ' . $availableQty . ' items available in stock for ' . $item['name'],
                    type: 'warning'
                );
                $this->updatingItemId = null;
                return;
            }
        }
        
        try {
            $cartService->updateQuantity($itemId, $newQuantity);
            $this->refreshCart();
            $this->dispatch('cartUpdated');
        } catch (\Exception $e) {
            $this->dispatch('showToast', 
                message: $e->getMessage(),
                type: 'error'
            );
        }
        
        $this->updatingItemId = null;
    }
    
    public function decreaseQuantity($itemId)
    {
        $this->updatingItemId = $itemId;
        
        $cartService = app(CartService::class);
        $item = $this->cart['items'][$itemId] ?? null;
        
        if (!$item) {
            $this->updatingItemId = null;
            return;
        }
        
        $newQuantity = $item['quantity'] - 1;
        
        if ($newQuantity < 1) {
            $this->removeItem($itemId);
            return;
        }
        
        try {
            $cartService->updateQuantity($itemId, $newQuantity);
            $this->refreshCart();
            $this->dispatch('cartUpdated');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        
        $this->updatingItemId = null;
    }
    
    public function updateQuantity($itemId, $quantity)
    {
        $this->updatingItemId = $itemId;
        
        if ($quantity < 1) {
            $this->removeItem($itemId);
            return;
        }
        
        $cartService = app(CartService::class);
        
        // Check available quantity for products
        $item = $this->cart['items'][$itemId] ?? null;
        if ($item && $item['type'] === 'product') {
            $availableQty = $this->getAvailableQuantity($item);
            
            if ($quantity > $availableQty) {
                session()->flash('error', 'Only ' . $availableQty . ' items available in stock');
                $this->updatingItemId = null;
                return;
            }
        }
        
        try {
            $cartService->updateQuantity($itemId, $quantity);
            $this->refreshCart();
            $this->dispatch('cartUpdated');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        
        $this->updatingItemId = null;
    }
    
    protected function getAvailableQuantity($item)
    {
        // Check inventory based on product type and variation
        $inventory = \App\Models\Inventory::where('product_id', $item['product_id']);
        
        if (isset($item['variation_id']) && $item['variation_id']) {
            $inventory->where('product_variation_id', $item['variation_id']);
        } else {
            $inventory->whereNull('product_variation_id');
        }
        
        $inventoryRecord = $inventory->first();
        
        return $inventoryRecord ? $inventoryRecord->available_quantity : 0;
    }
    
    public function removeItem($itemId)
    {
        $cartService = app(CartService::class);
        $cartService->removeItem($itemId);
        
        $this->refreshCart();
        $this->dispatch('cartUpdated');
        
        // Show success message
        $this->dispatch('showToast', 
            message: 'Item removed from cart',
            type: 'success'
        );
        
        // If cart is empty, redirect
        if (count($this->cart['items']) === 0) {
            return redirect()->route('home')->with('info', 'Your cart is empty');
        }
    }
    
    public function clearCart()
    {
        $cartService = app(CartService::class);
        $cartService->clearCart();
        
        return redirect()->route('home')->with('info', 'Cart cleared');
    }
    
    public function applyCoupon()
    {
        if (empty($this->couponCode)) {
            $this->couponMessage = 'Please enter a coupon code.';
            $this->couponApplied = false;
            return;
        }
        
        $cartService = app(CartService::class);
        $result = $cartService->applyCoupon($this->couponCode);
        
        $this->couponMessage = $result['message'];
        $this->couponApplied = $result['success'];
        
        if ($result['success']) {
            $this->refreshCart();
            $this->dispatch('showToast', 
                message: 'Coupon applied successfully! You saved LKR ' . number_format($result['discount']),
                type: 'success'
            );
        } else {
            $this->dispatch('showToast', 
                message: $result['message'],
                type: 'error'
            );
        }
    }
    
    public function removeCoupon()
    {
        $cartService = app(CartService::class);
        $cartService->removeCoupon();
        
        $this->couponCode = '';
        $this->couponApplied = false;
        $this->couponMessage = '';
        $this->refreshCart();
        
        $this->dispatch('showToast', 
            message: 'Coupon removed',
            type: 'info'
        );
    }
    
    public function proceedToCheckout()
    {
        // Validate cart has items
        if (count($this->cart['items']) === 0) {
            return redirect()->route('home')->with('error', 'Your cart is empty');
        }
        
        // Validate stock availability before checkout
        $hasStockIssue = false;
        foreach ($this->cart['items'] as $itemId => $item) {
            if ($item['type'] === 'product') {
                $availableQty = $this->getAvailableQuantity($item);
                if ($item['quantity'] > $availableQty) {
                    $this->dispatch('showToast', 
                        message: $item['name'] . ' has only ' . $availableQty . ' items in stock',
                        type: 'error'
                    );
                    $hasStockIssue = true;
                }
            }
        }
        
        if ($hasStockIssue) {
            return;
        }
        
        // Check if user is logged in
        if (auth()->check()) {
            return redirect()->route('checkout.event-details');
        } else {
            session(['url.intended' => route('checkout.event-details')]);
            return redirect()->route('login')->with('info', 'Please login to continue with checkout');
        }
    }
    
    public function render()
    {
        return view('livewire.cart-page');
    }
}