<?php

namespace App\Http\Livewire;

use App\Pesanan;
use App\PesananDetail;
use App\product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product, $date, $jumlah_pesanan;

    public function mount($slug)
    {
        $productDetail = product::with(['productgalery'])->where('slug', $slug)->firstOrFail();

        if($productDetail) {
            $this->product = $productDetail;
        }
    }

    public function masukkanKeranjang()
    {
        $this->validate([
            'jumlah_pesanan' => 'required',
            'date'=> 'required'
        ]);

        //Validasi Jika Belum Login
        if(!Auth::user()) {
            return redirect()->route('login');
        }

        //Menghitung Total Harga
        
            $total_harga = $this->jumlah_pesanan*$this->product->price;
            
       

        //Ngecek Apakah user punya data pesanan utama yg status nya 0
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status','IN_CART')->first();

        //Menyimpan / Update Data Pesanan Utama
        if(empty($pesanan))
        {
            Pesanan::create([
                'user_id' => Auth::user()->id,
                'total_harga' => $total_harga,
                'status' => 'IN_CART',
                
                
            ]);

            $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status','IN_CART')->first();
            $pesanan->kode_pemesanan = 'DIGARUT-'.$pesanan->id;
            $pesanan->update();

        }else {
            $pesanan->total_harga = $pesanan->total_harga+$total_harga;
            
            $pesanan->update();
        }

        //Meyimpanan Pesanan Detail
        PesananDetail::create([
            'product_id' => $this->product->id,
            'pesanan_id' => $pesanan->id,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'date' => $this->date,
            'total_harga'=> $total_harga
        ]);

        $this->emit('masukKeranjang');

        session()->flash('message', 'Success Input to Cart');

        return redirect()->back();


    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
