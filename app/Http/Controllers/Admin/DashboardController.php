<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\product;
use App\category;
use App\Pesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        return view('pages.admin.dashboard',[
            'category'=>category::count(),
            'paket'=>product::where('category_id', 1)->count(),
            'wisata'=>product::where('category_id', 2)->count(),
            'event'=>product::where('category_id', 3)->count(),
            'food'=>product::where('category_id', 4)->count(),
            'entertaiment'=>product::where('category_id', 5)->count(),
            'pending'=>pesanan::where('status', 'PENDING')->count(),
            'sukses'=>pesanan::where('status', 'SUCCESS')->count(),
            'pesanan'=>pesanan::count()
        ]);
    }
}
