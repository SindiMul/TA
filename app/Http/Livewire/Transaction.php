<?php

namespace App\Http\Livewire;
use Mail;
use App\Mail\TransactionSuccess;
use Livewire\Component;
use App\Pesanan;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

use Midtrans\Config;
use Midtrans\Snap;


class Transaction extends Component
{
    use WithFileUploads;

    public $total_harga, $image;

    public function mount()
    {
        if(!Auth::user()) {
            return redirect()->route('login');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status','IN_CART')->first();

        if(!empty($pesanan))
        {
            $this->total_harga = $pesanan->total_harga;
        }else {
            return redirect()->route('home');
        }
    }

    public function checkout()
    {
        $this->validate([
            'image' => 'required'
        ]);

        //Simpan nohp Alamat ke data user
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('image', null)->first();
        $pesanan->image = $this->image->store(
            'assets/Bukti', 'public');
        $pesanan->update();


        //update data pesanan
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 'IN_CART')->first();
        $pesanan->status = 'PENDING';
        $pesanan->update();

        $this->emit('masukKeranjang');
        Mail::to($pesanan->user)->send(
            new TransactionSuccess($pesanan)
        );


        session()->flash('message', "Sukses Checkout");
        
        return redirect()->route('history');
    }
    public function checkout2()
    {
        //midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('midtrans.is3ds');
    
        $midtrans_params = [
            'transaction_details' =>[
                'order_id' =>'MIDTRANS-' . $pesanan->id,
                'gross_amount' => (int) $pesanan->total_harga
            ], 
             'customer_details'  =>[
                'first_name' => $pesanan->user->name,
                'email' => (int) $pesanan->user->email
            ], 
            'enabled_payment'=>['gopay'] ,
            'vtweb' =>[]
            
        ];
        try {
            //halaman midtrans
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

            header('Location:'. $paymentUrl);
        } catch (Exeption $e) {
            echo $e->getMessage();
        }
    
    }

    public function render()
    {
        return view('livewire.transaction');
    }
}
