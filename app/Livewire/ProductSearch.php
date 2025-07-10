<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class ProductSearch extends Component
{
    public $category = '';
    public $searchTerm = '';
    
    public $categories = [];
    public $searchResults = [];
    public $showResults = false;
    
    public function mount()
    {
        $this->categories = Category::where('status', 'active')
            ->orderBy('sort_order')
            ->get();
    }
    
    public function search()
    {
        if (empty($this->category) && empty($this->searchTerm)) {
            $this->addError('search', 'Please select a category or enter a search term.');
            return;
        }
        
        // Build query
        $query = Product::with(['category', 'media'])
            ->where('status', 'active');
        
        // Filter by category
        if ($this->category) {
            $query->where('category_id', $this->category);
        }
        
        // Filter by search term
        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('name', 'like', "%{$this->searchTerm}%")
                  ->orWhere('short_description', 'like', "%{$this->searchTerm}%");
            });
        }
        
        $this->searchResults = $query->limit(12)->get();
        $this->showResults = true;
        
        // Dispatch event for analytics
        $this->dispatch('searchPerformed', 
            category: $this->category,
            term: $this->searchTerm
        );
    }
    
    public function clearSearch()
    {
        $this->reset(['category', 'searchTerm', 'searchResults', 'showResults']);
    }
    
    public function render()
    {
        return view('livewire.product-search');
    }
}