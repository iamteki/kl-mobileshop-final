<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quickViewModalLabel">Quick View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Content will be loaded dynamically -->
                <div class="text-center p-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
#quickViewModal .modal-content {
    background: var(--bg-card);
    border: 1px solid var(--border-dark);
    border-radius: 15px;
}

#quickViewModal .modal-header {
    background: var(--bg-dark);
    border-bottom: 1px solid var(--border-dark);
    border-radius: 15px 15px 0 0;
}

#quickViewModal .modal-title {
    color: var(--text-light);
    font-weight: 600;
}

#quickViewModal .btn-close {
    filter: invert(1);
    opacity: 0.8;
}

#quickViewModal .modal-body {
    padding: 0;
}

@media (max-width: 768px) {
    #quickViewModal .modal-dialog {
        margin: 10px;
    }
}
</style>