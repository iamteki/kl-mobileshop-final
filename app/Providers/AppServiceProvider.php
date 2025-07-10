<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\CartService;
use App\Services\AvailabilityService;
use App\Services\PricingService;
use App\Services\BookingService;
use App\View\Composers\NavigationComposer;
use Livewire\Livewire;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\BookingItem;
use App\Observers\BookingItemObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register services as singletons
        $this->app->singleton(CartService::class, function ($app) {
            return new CartService();
        });
        
        $this->app->singleton(AvailabilityService::class, function ($app) {
            return new AvailabilityService();
        });
        
        $this->app->singleton(PricingService::class, function ($app) {
            return new PricingService();
        });
        
        $this->app->singleton(BookingService::class, function ($app) {
            return new BookingService(
                $app->make(CartService::class),
                $app->make(AvailabilityService::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register view composers
        View::composer(
            ['layouts.partials.navigation', 'layouts.partials.footer'], 
            NavigationComposer::class
        );

         Relation::morphMap([
            'product' => \App\Models\Product::class,
            'service_provider' => \App\Models\ServiceProvider::class,
            'package' => \App\Models\Package::class,
        ]);


         // Register Livewire components
    Livewire::component('cart-dropdown', \App\Livewire\CartDropdown::class);
    Livewire::component('cart-page', \App\Livewire\CartPage::class);
    Livewire::component('booking-form', \App\Livewire\BookingForm::class);
    Livewire::component('package-booking', \App\Livewire\PackageBooking::class);

     BookingItem::observe(BookingItemObserver::class);

    }
}