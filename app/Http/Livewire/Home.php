<?php

namespace App\Http\Livewire;


use App\product;
use App\category;
use App\EventPackage;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {$items = product::with(['productgalery'])->get();
        return view('livewire.home', [
            'items' => $items,
            'products' => product::take(4)->get(),
            'categories' => category::all()

        ]);
    }
}
