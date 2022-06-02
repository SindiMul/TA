<?php

namespace App\Http\Livewire;

use App\product;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
class ProductIndex extends Component
{
    use WithPagination;

    public $search;

    protected $updateQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $tanggal=Carbon::now();
        if($this->search) {
            $products = product::where('title', 'like', '%'.$this->search.'%')->paginate(8);
        }else {
            $products = product::paginate(8);
        }
        
        return view('livewire.product-index', [
            'products' => $products,
            'tanggal'=>$tanggal,
            'title' => 'view all'
        ]);
    }
}
