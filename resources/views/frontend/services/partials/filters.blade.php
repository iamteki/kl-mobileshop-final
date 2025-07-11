<!-- Filters Sidebar -->
<div class="filters-sidebar">
    <h3 class="filters-title">
        <i class="fas fa-filter"></i> FILTERS
    </h3>
    
    <form action="{{ route('services.category', $category->slug) }}" method="GET" id="filtersForm">
        <!-- Preserve sort parameter -->
        @if(request('sort'))
            <input type="hidden" name="sort" value="{{ request('sort') }}">
        @endif
        
        <!-- Experience Level -->
        <div class="filter-group">
            <h5 class="filter-heading">EXPERIENCE LEVEL</h5>
            <div class="filter-options">
                @foreach(['Entry' => 'Entry Level', 'Professional' => 'Professional', 'Premium' => 'Premium'] as $value => $label)
                    <label class="radio-option">
                        <input type="radio" 
                               name="experience_level" 
                               value="{{ $value }}"
                               {{ request('experience_level') == $value ? 'checked' : '' }}
                               onchange="this.form.submit()">
                        <span class="radio-custom"></span>
                        <span class="radio-label">{{ $label }}</span>
                    </label>
                @endforeach
                @if(request('experience_level'))
                    <a href="{{ route('services.category', array_merge(['category' => $category->slug], request()->except('experience_level'))) }}" 
                       class="clear-filter">
                        CLEAR
                    </a>
                @endif
            </div>
        </div>
        
        <!-- Price Range -->
        <div class="filter-group">
            <h5 class="filter-heading">PRICE RANGE</h5>
            <div class="filter-options">
                @foreach(['budget' => 'Budget (Under 20K)', 'mid' => 'Mid-range (20K-50K)', 'premium' => 'Premium (50K+)'] as $value => $label)
                    <label class="radio-option">
                        <input type="radio" 
                               name="price_range" 
                               value="{{ $value }}"
                               {{ request('price_range') == $value ? 'checked' : '' }}
                               onchange="this.form.submit()">
                        <span class="radio-custom"></span>
                        <span class="radio-label">{{ $label }}</span>
                    </label>
                @endforeach
                @if(request('price_range'))
                    <a href="{{ route('services.category', array_merge(['category' => $category->slug], request()->except('price_range'))) }}" 
                       class="clear-filter">
                        CLEAR
                    </a>
                @endif
            </div>
        </div>
        
        <!-- Rating -->
        <div class="filter-group">
            <h5 class="filter-heading">MINIMUM RATING</h5>
            <div class="filter-options">
                @foreach([4 => '4+ Stars', 3 => '3+ Stars', 2 => '2+ Stars'] as $value => $label)
                    <label class="radio-option">
                        <input type="radio" 
                               name="rating" 
                               value="{{ $value }}"
                               {{ request('rating') == $value ? 'checked' : '' }}
                               onchange="this.form.submit()">
                        <span class="radio-custom"></span>
                        <span class="radio-label">
                            {{ $label }}
                            <span class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $value ? '' : 'empty' }}"></i>
                                @endfor
                            </span>
                        </span>
                    </label>
                @endforeach
                @if(request('rating'))
                    <a href="{{ route('services.category', array_merge(['category' => $category->slug], request()->except('rating'))) }}" 
                       class="clear-filter">
                        CLEAR
                    </a>
                @endif
            </div>
        </div>
        
        <!-- Languages -->
        @if($languages->count() > 0)
            <div class="filter-group">
                <h5 class="filter-heading">LANGUAGES</h5>
                <div class="filter-options">
                    @foreach($languages as $language)
                        <label class="checkbox-option">
                            <input type="checkbox" 
                                   name="languages[]" 
                                   value="{{ $language }}"
                                   {{ in_array($language, (array)request('languages', [])) ? 'checked' : '' }}
                                   onchange="this.form.submit()">
                            <span class="checkbox-custom"></span>
                            <span class="checkbox-label">{{ $language }}</span>
                        </label>
                    @endforeach
                    @if(request('languages'))
                        <a href="{{ route('services.category', array_merge(['category' => $category->slug], request()->except('languages'))) }}" 
                           class="clear-filter">
                            CLEAR
                        </a>
                    @endif
                </div>
            </div>
        @endif
        
        <!-- Clear All Filters -->
        @if(request()->hasAny(['experience_level', 'price_range', 'rating', 'languages']))
            <div class="clear-all-wrapper">
                <a href="{{ route('services.category', $category->slug) }}" class="clear-all-btn">
                    <i class="fas fa-times"></i> CLEAR ALL FILTERS
                </a>
            </div>
        @endif
    </form>
</div>

<style>
/* Import Bebas Neue font */
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap');

.filters-sidebar {
    background: #1A1A1A;
    padding: 25px;
    border-radius: 15px;
    border: 1px solid #2A2A2A;
    position: sticky;
    top: 100px;
}

.filters-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.5rem;
    letter-spacing: 0.1em;
    color: #FFFFFF;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #2A2A2A;
    display: flex;
    align-items: center;
    gap: 10px;
}

.filters-title i {
    color: #9333EA;
    font-size: 1.2rem;
}

.filter-group {
    margin-bottom: 35px;
}

.filter-heading {
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    color: #FFFFFF;
    margin-bottom: 20px;
    letter-spacing: 0.05em;
}

/* Radio Option Styles */
.radio-option {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    cursor: pointer;
    position: relative;
    padding-left: 35px;
    min-height: 24px;
}

.radio-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.radio-custom {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
    border: 2px solid #4A4A4A;
    border-radius: 50%;
    background: transparent;
    transition: all 0.3s ease;
}

.radio-option input[type="radio"]:checked ~ .radio-custom {
    border-color: #9333EA;
    background: #9333EA;
}

.radio-option input[type="radio"]:checked ~ .radio-custom::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}

.radio-option:hover .radio-custom {
    border-color: #6B6B6B;
}

.radio-option input[type="radio"]:checked:hover ~ .radio-custom {
    border-color: #A855F7;
    background: #A855F7;
}

/* Checkbox Option Styles */
.checkbox-option {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    cursor: pointer;
    position: relative;
    padding-left: 35px;
    min-height: 24px;
}

.checkbox-option input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.checkbox-custom {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
    border: 2px solid #4A4A4A;
    border-radius: 4px;
    background: transparent;
    transition: all 0.3s ease;
}

.checkbox-option input[type="checkbox"]:checked ~ .checkbox-custom {
    border-color: #9333EA;
    background: #9333EA;
}

.checkbox-option input[type="checkbox"]:checked ~ .checkbox-custom::after {
    content: '\f00c';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 10px;
}

.checkbox-option:hover .checkbox-custom {
    border-color: #6B6B6B;
}

.checkbox-option input[type="checkbox"]:checked:hover ~ .checkbox-custom {
    border-color: #A855F7;
    background: #A855F7;
}

/* Label Styles */
.radio-label,
.checkbox-label {
    font-family: 'Inter', sans-serif;
    font-size: 0.9rem;
    color: #B8B8B8;
    font-weight: 400;
    transition: color 0.3s ease;
    user-select: none;
}

.radio-option:hover .radio-label,
.checkbox-option:hover .checkbox-label {
    color: #FFFFFF;
}

.radio-option input[type="radio"]:checked ~ .radio-label,
.checkbox-option input[type="checkbox"]:checked ~ .checkbox-label {
    color: #FFFFFF;
}

/* Selected state background */
.radio-option input[type="radio"]:checked,
.checkbox-option input[type="checkbox"]:checked {
    & ~ .radio-label,
    & ~ .checkbox-label {
        position: relative;
    }
}

.radio-option input[type="radio"]:checked::before,
.checkbox-option input[type="checkbox"]:checked::before {
    content: '';
    position: absolute;
    left: -25px;
    right: -25px;
    top: -12px;
    bottom: -12px;
    background: rgba(147, 51, 234, 0.1);
    border-radius: 8px;
    z-index: -1;
}

/* Stars Rating */
.stars {
    display: inline-flex;
    gap: 2px;
    margin-left: 8px;
}

.stars i {
    font-size: 0.875rem;
    color: #F59E0B;
}

.stars i.empty {
    color: #4A4A4A;
}

/* Clear Filter Link */
.clear-filter {
    display: inline-block;
    margin-top: 10px;
    margin-left: 35px;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    color: #9333EA;
    text-decoration: none;
    font-weight: 600;
    letter-spacing: 0.05em;
    transition: all 0.3s ease;
}

.clear-filter:hover {
    color: #A855F7;
}

/* Clear All Button */
.clear-all-wrapper {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid #2A2A2A;
}

.clear-all-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px 20px;
    background: transparent;
    border: 1px solid #4A4A4A;
    border-radius: 8px;
    color: #B8B8B8;
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-decoration: none;
    transition: all 0.3s ease;
}

.clear-all-btn:hover {
    background: rgba(147, 51, 234, 0.1);
    border-color: #9333EA;
    color: #9333EA;
}

.clear-all-btn i {
    font-size: 0.75rem;
}

/* Responsive */
@media (max-width: 991px) {
    .filters-sidebar {
        position: static;
        margin-bottom: 30px;
    }
}

/* Custom scrollbar for filter sidebar */
.filters-sidebar::-webkit-scrollbar {
    width: 6px;
}

.filters-sidebar::-webkit-scrollbar-track {
    background: #1A1A1A;
}

.filters-sidebar::-webkit-scrollbar-thumb {
    background: #4A4A4A;
    border-radius: 3px;
}

.filters-sidebar::-webkit-scrollbar-thumb:hover {
    background: #6B6B6B;
}
</style>