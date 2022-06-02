<?php

namespace App\Http\Controllers;

use App\EventPackage;
use App\category;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Request $request, $slug)
    {
        $categories = category::all();
        $item = EventPackage::with(['galleries'])->where('slug', $slug)->firstOrFail();
        return view('pages.detail',[
            'item' => $item,
            'categories'=>$categories
        ]);
    }
    
}
