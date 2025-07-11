@extends('layouts.app')

@section('title', $category->name . ' - Professional Service Providers')
@section('description', $category->description)

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3" style="background-color: var(--bg-darker);">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('services.index') }}">Services</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </div>
</nav>

<!-- Category Header -->
<section class="category-header py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="category-icon-large me-4">
                        <i class="{{ $category->icon }}"></i>
                    </div>
                    <div>
                        <h1 class="category-title mb-2">{{ $category->name }}</h1>
                        <p class="category-description mb-0">{{ $category->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="category-stats">
                    <div class="stat-item">
                        <span class="stat-value">{{ $providers->total() }}</span>
                        <span class="stat-label">{{ Str::plural('Provider', $providers->total()) }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">{{ number_format($providers->avg('rating'), 1) }}</span>
                        <span class="stat-label">Avg Rating</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filters and Providers -->
<section class="providers-section py-5">
    <div class="container">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3">
                @include('frontend.services.partials.filters', ['category' => $category, 'languages' => $languages])
            </div>
            
            <!-- Providers Grid -->
            <div class="col-lg-9">
                <!-- Sort Bar -->
                <div class="sort-bar mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="results-count mb-0">Showing {{ $providers->firstItem() ?? 0 }}-{{ $providers->lastItem() ?? 0 }} of {{ $providers->total() }} providers</p>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('services.category', $category->slug) }}" method="GET" id="sortForm">
                                @foreach(request()->except('sort') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                
                                <div class="d-flex align-items-center justify-content-md-end">
                                    <label class="sort-label me-2 text-nowrap">Sort by:</label>
                                    <select name="sort" class="form-select" onchange="document.getElementById('sortForm').submit()">
                                        <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Providers Grid -->
                <div class="row g-4">
                    @forelse($providers as $provider)
                        <div class="col-lg-6">
                            <x-service-provider-card :provider="$provider" />
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state text-center py-5">
                                <i class="fas fa-users fa-4x text-muted mb-3"></i>
                                <h3 class="empty-title">No providers found</h3>
                                <p class="empty-text">Try adjusting your filters or check back later.</p>
                                <a href="{{ route('services.index') }}" class="btn btn-primary mt-3">
                                    Browse All Services
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                @if($providers->hasPages())
                    <div class="mt-5">
                        {{ $providers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Import Bebas Neue font */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap');

/* Category Header */
.category-header {
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.05) 0%, rgba(99, 102, 241, 0.05) 100%);
    border-bottom: 1px solid var(--border-dark);
}

.category-icon-large {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.15) 0%, rgba(124, 58, 237, 0.15) 100%);
    border-radius: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(147, 51, 234, 0.2);
    transition: all 0.3s;
}

.category-icon-large:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 40px rgba(147, 51, 234, 0.3);
}

.category-icon-large i {
    font-size: 40px;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Typography */
.category-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 3.5rem;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    color: var(--text-light);
    line-height: 1;
}

.category-description {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    color: var(--text-gray);
    font-weight: 400;
}

.empty-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--text-gray);
    margin-bottom: 1rem;
}

.empty-text {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-size: 1rem;
}

/* Stats */
.category-stats {
    display: flex;
    gap: 40px;
    justify-content: flex-end;
}

.stat-item {
    text-align: center;
}

.stat-value {
    display: block;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.5rem;
    letter-spacing: 0.02em;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1;
}

.stat-label {
    display: block;
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    color: var(--text-gray);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
    margin-top: 0.25rem;
}

/* Providers Section */
.providers-section {
    background-color: var(--bg-darker);
    min-height: 600px;
}

/* Sort Bar */
.sort-bar {
    background: var(--bg-card);
    padding: 25px;
    border-radius: 20px;
    border: 1px solid var(--border-dark);
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}

.results-count {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    font-weight: 500;
}

.sort-label {
    font-family: 'Inter', sans-serif;
    color: var(--text-light);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    font-size: 0.875rem;
}

.sort-bar .form-select {
    max-width: 220px;
    background-color: var(--bg-dark);
    border: 1px solid var(--border-dark);
    color: var(--text-light);
    font-family: 'Inter', sans-serif;
    font-weight: 500;
    padding: 10px 15px;
    border-radius: 10px;
}

.sort-bar .form-select:focus {
    border-color: var(--primary-purple);
    box-shadow: 0 0 0 0.2rem rgba(147, 51, 234, 0.25);
}

/* Empty State */
.empty-state {
    padding: 80px 20px;
}

.empty-state i {
    opacity: 0.3;
}

/* Responsive */
@media (max-width: 991px) {
    .category-stats {
        justify-content: flex-start;
        margin-top: 20px;
    }
    
    .category-title {
        font-size: 2.5rem;
    }
    
    .stat-value {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .category-title {
        font-size: 2rem;
    }
    
    .category-icon-large {
        width: 70px;
        height: 70px;
    }
    
    .category-icon-large i {
        font-size: 30px;
    }
}

/* Pagination Custom Styles */
.pagination {
    justify-content: center;
}

.page-link {
    background-color: var(--bg-card);
    border: 1px solid var(--border-dark);
    color: var(--text-light);
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    padding: 10px 20px;
    margin: 0 3px;
    border-radius: 10px;
    transition: all 0.3s;
}

.page-link:hover {
    background-color: var(--primary-purple);
    border-color: var(--primary-purple);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(147, 51, 234, 0.3);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--accent-violet) 100%);
    border-color: transparent;
    color: white;
}

.page-item.disabled .page-link {
    background-color: var(--bg-dark);
    color: var(--text-gray);
    opacity: 0.5;
}
</style>
@endpush

@endsection