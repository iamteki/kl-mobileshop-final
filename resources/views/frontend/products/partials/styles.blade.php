<style>
/* Product Images Section */
.product-images {
    position: sticky;
    top: 20px;
}

.main-image-container {
    background: var(--bg-card);
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 20px;
    position: relative;
    border: 1px solid var(--border-dark);
}

.main-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

.image-badges {
    position: absolute;
    top: 20px;
    left: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.badge-custom {
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--accent-violet) 100%);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    font-family: var(--font-body);
}

.zoom-hint {
    position: absolute;
    bottom: 20px;
    right: 20px;
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: var(--font-body);
}

.thumbnail-container {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding-bottom: 10px;
}

.thumbnail {
    flex-shrink: 0;
    width: 100px;
    height: 100px;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s;
}

.thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumbnail.active,
.thumbnail:hover {
    border-color: var(--primary-purple);
}

/* Product Info Section */
.product-info-section {
    padding: 0 0 0 30px;
}

.product-category {
    color: var(--primary-purple);
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    font-family: var(--font-body);
    font-weight: 600;
}

.product-title {
    font-family: var(--font-heading);
    font-size: 3.5rem;
    font-weight: 400;
    margin-bottom: 20px;
    color: var(--text-light);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    line-height: 1;
}

.product-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.sku {
    color: var(--text-gray);
    font-size: 14px;
    font-family: var(--font-body);
}

.availability-status {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    font-family: var(--font-body);
}

.availability-status.in-stock {
    color: var(--success-green);
}

.availability-status.low-stock {
    color: var(--warning-yellow);
}

.availability-status.out-stock {
    color: var(--danger-red);
}

.product-description {
    font-family: var(--font-body);
    line-height: 1.6;
}

/* Pricing Section */
.pricing-section {
    background: var(--bg-card);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    border: 1px solid var(--border-dark);
}

.price-note {
    color: var(--text-gray);
    font-size: 14px;
    margin-bottom: 20px;
    font-family: var(--font-body);
}

.pricing-tiers {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.tier-card {
    flex: 1;
    padding: 15px;
    background: var(--bg-dark);
    border-radius: 10px;
    text-align: center;
    border: 1px solid var(--border-dark);
    transition: all 0.3s;
    cursor: pointer;
}

.tier-card:hover {
    border-color: var(--primary-purple);
    transform: translateY(-2px);
}

.tier-days {
    font-family: var(--font-heading);
    font-size: 1.125rem;
    color: var(--text-gray);
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.tier-save {
    font-size: 12px;
    color: var(--success-green);
    margin-top: 5px;
    font-family: var(--font-body);
}

/* Tabs Section */
.tabs-section {
    margin-top: 60px;
}

.nav-tabs {
    border-bottom: 1px solid var(--border-dark);
    gap: 30px;
}

.nav-tabs .nav-link {
    font-family: var(--font-heading);
    color: var(--text-gray);
    border: none;
    padding: 15px 0;
    font-weight: 400;
    font-size: 1.25rem;
    position: relative;
    transition: all 0.3s;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.nav-tabs .nav-link:hover {
    color: var(--secondary-purple);
    border: none;
}

.nav-tabs .nav-link.active {
    color: var(--text-light);
    background: transparent;
    border: none;
}

.nav-tabs .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--primary-purple);
}

.tab-content {
    padding: 30px 0;
}

/* Tab Content Headings */
.tab-pane h5 {
    font-family: var(--font-heading);
    font-size: 1.5rem;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-light);
    margin-bottom: 1rem;
}

/* Specifications Table */
.specs-table {
    background: transparent;
    border-radius: 0;
    overflow: visible;
    border: none;
}

.specs-table table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
}

.specs-table th {
    font-family: var(--font-heading);
    background: transparent;
    color: var(--text-light);
    font-weight: 400;
    font-size: 2rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0 0 20px 0;
    border: none;
    text-align: left;
}

.specs-table td {
    font-family: var(--font-body);
    background: var(--bg-card);
    padding: 20px 25px;
    border: 1px solid var(--border-dark);
}

.specs-table tr td:first-child {
    color: var(--text-gray);
    width: 40%;
    border-radius: 10px 0 0 10px;
    font-weight: 600;
}

.specs-table tr td:last-child {
    color: var(--text-light);
    border-radius: 0 10px 10px 0;
    border-left: none;
}

.specs-table tbody tr:hover td {
    background: var(--bg-card-hover);
    border-color: var(--primary-purple);
}

/* Features Grid */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.feature-item {
    display: flex;
    gap: 15px;
    padding: 20px;
    background: var(--bg-card);
    border-radius: 10px;
    border: 1px solid var(--border-dark);
}

.feature-icon {
    width: 40px;
    height: 40px;
    background: rgba(147, 51, 234, 0.1);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.feature-icon i {
    color: var(--primary-purple);
}

.feature-content h6 {
    font-family: var(--font-heading);
    color: var(--text-light);
    margin-bottom: 5px;
    font-size: 1.125rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.feature-content p {
    color: var(--text-gray);
    font-size: 14px;
    margin: 0;
    font-family: var(--font-body);
}

/* Related Products */
.related-products-section {
    width: 100%;
    margin: 0;
    padding: 0;
    margin-top: 80px;
}

/* Remove the old related products styles that were too large */

/* Lists styling */
.features-list,
.requirements-list {
    list-style: none;
    padding: 0;
}

.features-list li,
.requirements-list li {
    padding: 10px 0;
    font-family: var(--font-body);
    color: var(--text-gray);
}

/* Responsive */
@media (max-width: 991px) {
    .product-info-section {
        padding: 30px 0 0 0;
    }

    .product-images {
        position: relative;
    }
}

@media (max-width: 768px) {
    .product-title {
        font-size: 2.5rem;
    }

    .pricing-tiers {
        flex-direction: column;
    }
    
    .nav-tabs .nav-link {
        font-size: 1rem;
    }
    
    .tab-pane h5 {
        font-size: 1.25rem;
    }
    
    .related-title {
        font-size: 2.5rem;
    }
}
</style>