<?php

namespace App\Http\Livewire;
use Mail;
use App\Mail\TransactionSuccess;
use Livewire\Component;
use App\Pesanan;
use App\User;
use Illuminate\Support\Facades\Auth;

class History extends Component
{


    public $pesanans;

       
    

    public function render()
    {
        if(Auth::user())
        {
            $this->pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status', '!=', 'IN_CART')->get();
        }
        
        return view('livewire.history');
    }
}
