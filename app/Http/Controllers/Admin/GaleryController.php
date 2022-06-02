<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GaleryRequest;
use App\wisata_galeri;
use App\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = wisata_galeri::with(['wisata'])->get();

        return view('pages.admin.galery.index',[
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
        $wisatas = Wisata::all();
        return view('pages.admin.galery.create',[
            'wisatas' => $wisatas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GaleryRequest $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store(
            'assets/gallery', 'public'
        );

        wisata_galeri::create($data);

        return redirect()->route('galery.index');
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
        $item = wisata_galeri::findOrFail($id);
        $wisatas = Wisata::all();

        return view('pages.admin.galery.edit',[
            'item' => $item,
            'wisatas' => $wisatas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GaleryRequest $request, $id)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store(
            'assets/gallery', 'public'
        );

        $item = wisata_galeri::findOrFail($id);

        $item->update($data);

        return redirect()->route('galery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = wisata_galeri::findorFail($id);
        $item->delete();

        return redirect()->route('galery.index');

    }
}
