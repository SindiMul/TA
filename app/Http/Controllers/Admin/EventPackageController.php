<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventPackageRequest;
use App\EventPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = EventPackage::all();

        return view('pages.admin.event-package.index',[
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
        return view('pages.admin.event-package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventPackageRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        EventPackage::create($data);
        return redirect()->route('event-package.index');
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
        $item = EventPackage::findOrFail($id);

        return view('pages.admin.event-package.edit',[
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
    public function update(EventPackageRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $item = EventPackage::findOrFail($id);

        $item->update($data);

        return redirect()->route('event-package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = EventPackage::findorFail($id);
        $item->delete();

        return redirect()->route('event-package.index');

    }
}
