<?php

namespace App\Http\Controllers;
use Mail;

use App\Mail\TransactionSuccess;
use App\Pesanan;
use App\PesananDetail;
use Illuminate\Support\Facades\Auth;

class OkeController extends Controller
{
   

    public function success()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id);
      

        //kirim email e tiket
        Mail::to($pesanan->user)->send(
            new TransactionSuccess($pesanan)
        );

        return view('pages.success');
    }
}
