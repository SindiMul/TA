<?php

namespace App\Http\Livewire;


use App\category;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductLiga extends Component
{
    use WithPagination;

    public $search, $category;

    protected $updateQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($categoryId)
    {
        $ligaDetail = category::find($categoryId);

        if($ligaDetail) {
            $this->category = $ligaDetail;
        }
    }

    public function render()
    {
        if($this->search) {
            $products = Product::where('category_id', $this->category->id)->where('title', 'like', '%'.$this->search.'%')->paginate(8);
        }else {
            $products = Product::where('category_id', $this->category->id)->paginate(8);
        }
        
        return view('livewire.product-index', [
            'products' => $products,
            'title' => 'Category '.$this->category->nama
        ]);
    }
}
