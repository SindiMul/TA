<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Transaction2Request;
use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Transaction2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Pesanan::with([
            'pesanan_details', 'user'
        ])->get();

        return view('pages.admin.transaction2.index',[
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Transaction2Request $request)
    {
        $data = $request->all();

        Pesanan::create($data);
        return redirect()->route('transaction2.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Pesanan::with([
            'pesanan_details', 'user'
        ])->findOrFail($id);

        return view('pages.admin.transaction2.detail',[
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Pesanan::findOrFail($id);

        return view('pages.admin.transaction2.edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Transaction2Request $request, $id)
    {
        $data = $request->all();

        $item = Pesanan::findOrFail($id);

        $item->update($data);

        return redirect()->route('transaction2.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pesanan::findorFail($id);
        $item->delete();

        return redirect()->route('transaction2.index');

    }
}
