<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductgaleryRequest;
use App\productgalery;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductgaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = productgalery::with(['product'])->get();

        return view('pages.admin.productgalery.index',[
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = product::all();
        return view('pages.admin.productgalery.create',[
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductgaleryRequest $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store(
            'assets/gallery', 'public'
        );

        productgalery::create($data);

        return redirect()->route('productgalery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = productgalery::findOrFail($id);
        $products = Product::all();

        return view('pages.admin.productgalery.edit',[
            'item' => $item,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductgaleryRequest $request, $id)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store(
            'assets/gallery', 'public'
        );

        $item = productgalery::findOrFail($id);

        $item->update($data);

        return redirect()->route('productgalery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = productgalery::findorFail($id);
        $item->delete();

        return redirect()->route('productgalery.index');

    }
}
