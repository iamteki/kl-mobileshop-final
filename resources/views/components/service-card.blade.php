<!-- Service Category Card -->
<div class="service-category-card h-100">
    <div class="card-image">
        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" loading="lazy">
        <div class="card-overlay">
            <a href="{{ route('services.category', $category->slug) }}" class="btn btn-primary">
                View Providers
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="card-icon">
            <i class="{{ $category->icon }}"></i>
        </div>
        <h4 class="card-title">{{ $category->name }}</h4>
        <p class="card-description">{{ $category->description }}</p>
        <div class="card-footer">
            <div class="provider-count">
                <i class="fas fa-users me-1"></i>
                <span class="count-number">{{ $category->active_providers_count }}</span>
                <span class="count-label">{{ Str::plural('Provider', $category->active_providers_count) }}</span>
            </div>
            <a href="{{ route('services.category', $category->slug) }}" class="view-link">
                View All <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<style>
/* Import Bebas Neue font */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap');

.service-category-card {
    background: var(--bg-card);
    border-radius: 25px;
    overflow: hidden;
    transition: all 0.3s;
    border: 1px solid var(--border-dark);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
    cursor: pointer;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}

.service-category-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 25px 50px rgba(147, 51, 234, 0.3);
    border-color: var(--primary-purple);
}

.card-image {
    height: 280px;
    position: relative;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.service-category-card:hover .card-image img {
    transform: scale(1.15);
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.9) 0%, rgba(124, 58, 237, 0.9) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.service-category-card:hover .card-overlay {
    opacity: 1;
}

.card-overlay .btn {
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.3s 0.1s;
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    padding: 12px 30px;
}

.service-category-card:hover .card-overlay .btn {
    transform: translateY(0);
    opacity: 1;
}

.card-body {
    padding: 35px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.card-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.15) 0%, rgba(124, 58, 237, 0.15) 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
    transition: all 0.3s;
}

.service-category-card:hover .card-icon {
    transform: scale(1.1);
    box-shadow: 0 10px 25px rgba(147, 51, 234, 0.3);
}

.card-icon i {
    font-size: 30px;
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.card-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    margin-bottom: 15px;
    color: var(--text-light);
    line-height: 1;
}

.card-description {
    font-family: 'Inter', sans-serif;
    color: var(--text-gray);
    margin-bottom: 25px;
    flex: 1;
    font-size: 0.9rem;
    line-height: 1.6;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 25px;
    border-top: 1px solid var(--border-dark);
}

.provider-count {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--text-gray);
    font-family: 'Inter', sans-serif;
}

.count-number {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.5rem;
    color: var(--primary-purple);
    line-height: 1;
    margin: 0 4px;
}

.count-label {
    font-size: 0.875rem;
    font-weight: 500;
}

.view-link {
    color: var(--primary-purple);
    text-decoration: none;
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: 0.875rem;
    transition: all 0.3s;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    display: flex;
    align-items: center;
    gap: 6px;
}

.view-link:hover {
    color: var(--secondary-purple);
    transform: translateX(5px);
}

.view-link i {
    transition: transform 0.3s;
}

.view-link:hover i {
    transform: translateX(5px);
}

/* Hover state animations */
.service-category-card:hover .card-title {
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>