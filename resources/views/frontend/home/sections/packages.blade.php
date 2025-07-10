<section class="package-section" id="packages">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white">Event Packages</h2>
            <p class="text-muted">Complete solutions for your events</p>
        </div>
        
        <div class="row g-4">
            @foreach($packages as $index => $package)
                <div class="col-lg-4">
                    <x-package-card :package="$package" :featured="$index === 1" />
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('packages.index') }}" class="btn btn-primary">
                BROWSE ALL PACKAGES <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>