<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sales_stock;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $auth = Auth::user()->roles->first()->name ;
        if($auth == 'Admin'){
            $date =  date('Y-m-d');
            // return $date;
            $gudang1 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_gudang1');
            $gudang2 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_gudang2');
            $gudang3 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_gudang3');
            $gudang4 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_gudang4');
            $gudang5 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_gudang5');

            $toko1 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_toko1');
            $toko2 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_toko2');
            $toko3 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_toko3');
            $toko4 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_toko4');
            $toko5 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_toko5');

            $toko5 = Sales_stock::whereDate('sales_stocks.updated_at', $date)->sum('stok_toko5');

            $total_gudang = $gudang1+$gudang2+$gudang3+$gudang4+$gudang5;
            $toal_toko = $toko1+$toko2+$toko3+$toko4+$toko5;
            $total = $total_gudang+$toal_toko;

            $products = Product::all();
            $total_product = $products->count();

            $users = User::all();
            $total_user = $users->count();
            return view('home', compact('total','total_product','total_user'));
        }else{
            $data = [
                'login_date' => $request->session()->get('login_date'),
                'area'  => Auth::user()->area,
            ];
            return view('stock.index', compact('data'));
        }
    }
}
