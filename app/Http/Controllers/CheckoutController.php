<?php

namespace App\Http\Controllers;
use Mail;

use App\Mail\TransactionSuccess;
use App\Transaction;
use App\TransactionDetail;
use App\EventPackage;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {   
        
        $item = Transaction::with(['details','event_package','user'])->findOrFail($id);

        return view('pages.checkout',[
            'item' => $item,

        ]);
    }

    public function process(Request $request, $id)
    {
        $event_package = EventPackage::findOrFail($id);

        $transaction = Transaction::create([
            'event_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'transaction_total' => $event_package->price,
            'transaction_status' => 'IN_CART',
            'departure_date'=>$request->departure_date
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'departure_date'=>$request->departure_date
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findorFail($detail_id);

        $transaction = Transaction::with(['details','event_package'])
            ->findOrFail($item->transactions_id);



        $transaction->transaction_total -= $transaction->event_package->price;

        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'departure_date'=> 'required',
        ]);

        $data = $request->all();
        $data['transactions_id'] = $id;

        TransactionDetail::create($data);

        $transaction = Transaction::with(['event_package'])->find($id);

       

        $transaction->transaction_total += $transaction->event_package->price;

        $transaction->save();

        return redirect()->route('checkout', $id);
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::with(['details','event_package.galleries','user'])
        ->findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();
       
    //    set konfigurasi midtrans
    Config::$serverKey = config('midtrans.serverKey');
    Config::$isProduction = config('midtrans.isProduction');   
    Config::$isSanitized = config('midtrans.isSanitized');
    Config::$is3ds = config('midtrans.is3ds');


    // buat array untuk dikirim ke midtrans

$midtrans_params = [
    'transaction_detail' => [
        'order_id' => 'TEST-' . $transaction->id,
        'gross_amount' => (int) $transaction->transaction_total
    ],
    'customer_detail' => [
        'first_mane' => $transaction->user->name,
        'email' => $transaction->user->email,
    ],
    'enabled_payments' => ['gopay'],
    'vtweb' => []
];

try {
    // ambil halaman midtrans
    $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

    // redirect ke halaman midtrans
    header('Location: ' . $paymentUrl);

} catch (Exception $e) {
    echo $e->getMessage();
}





        //return $transaction;
           //kirim email e tiket
        // Mail::to($transaction->user)->send(
        //     new TransactionSuccess($transaction)
        // );

        // return view('pages.success');
    }
}
