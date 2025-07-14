@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<section class="cart-section py-5">
    <div class="container">
        <h1 class="mb-4">Shopping Cart</h1>
        
        {{-- Use Livewire component for reactive cart --}}
        <livewire:cart-page />
    </div>
</section>

{{-- Dynamic Toast Container --}}
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1050" id="dynamicToasts">
    <!-- Dynamic toasts will be inserted here -->
</div>
@endsection