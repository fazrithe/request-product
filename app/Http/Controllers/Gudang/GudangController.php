<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sales_stock;
use App\Models\Request_product;
use App\Models\User;

class GudangController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        //  $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:product-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index(){
        $requestProducts = Request_product::select('request_products.sales_id','request_products.total','request_products.request_time','request_products.answare_time','request_products.answare','products.nama_barang')
        ->where('gudang_id',Auth::user()->id)
        ->join('products','products.id', '=','request_products.product_id')
        ->get();
        $data = Product::find(1);
        $datastock = Sales_stock::where('product_id',1)->first();
        $total_toko = $datastock->stok_toko1 + $datastock->stok_toko2 + $datastock->stok_toko3 + $datastock->stok_toko4 + $datastock->stok_toko4;
        $total_gudang = $datastock->stok_gudang1 + $datastock->stok_gudang2 + $datastock->stok_gudang3 + $datastock->stok_gudang4 + $datastock->stok_gudang4;
        $total = $total_gudang + $total_toko;
        return view('gudang.show', compact('requestProducts','data','datastock','total','total_toko','total_gudang'));

    }
}
