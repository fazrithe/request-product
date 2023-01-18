<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sales_stock;
use App\Models\Request_product;
use App\Models\User;

class StockController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'login_date' => $request->session()->get('login_date'),
            'area'  =>  $request->session()->get('login_area'),
        ];
        return view('stock.index', compact('data'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchProduct(Request $request)
    {
        $data = Product::where('kode_barang', $request->kode_barang)->orWhere('barcode',$request->kode_barang)->first();
        $datastock = Sales_stock::where('product_id', $data->id)->first();
        if(!empty($datastock)){
            $stok1 = $datastock->stok_gudang1;
            $stok2 = $datastock->stok_gudang2;
            $stok3 = $datastock->stok_gudang3;
            $stok4 = $datastock->stok_gudang4;
            $stok5 = $datastock->stok_gudang5;
            $stok = $stok1+$stok2+$stok3+$stok4+$stok5;
        }else{
            $stok = 0;
        }
        if(empty($data)){
            $statusCode = 500;
        }else{
            $statusCode = 200;
        }
        return json_encode(array(
            "data"=>$data,
            "stok"=>$stok,
            "statusCode"=>$statusCode,
        ));
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(Request $request)
    {
        $area = $request->session()->get('login_area');
        $dataGudang = User::where('name',$area)->first();
        $user_id = Auth::user()->id;

        $requestProduct = new Request_product();
        $requestProduct->product_id = $request->id;
        $requestProduct->sales_id = $user_id;
        $requestProduct->gudang_id = $dataGudang->id;
        $requestProduct->total = $request->stock;
        $requestProduct->request_time = date('Y-m-d H:i:s');
        $requestProduct->save();

        return redirect()->to('showProduct');
    }

          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProduct()
    {
        $requestProducts = Request_product::select('request_products.sales_id','request_products.total','request_products.request_time','request_products.answare_time','request_products.answare','products.nama_barang')
                                            ->where('sales_id',Auth::user()->id)
                                            ->join('products','products.id', '=','request_products.product_id')
                                            ->get();
        $data = Product::find(1);
        $datastock = Sales_stock::where('product_id',1)->first();
        $total_toko = $datastock->stok_toko1 + $datastock->stok_toko2 + $datastock->stok_toko3 + $datastock->stok_toko4 + $datastock->stok_toko4;
        $total_gudang = $datastock->stok_gudang1 + $datastock->stok_gudang2 + $datastock->stok_gudang3 + $datastock->stok_gudang4 + $datastock->stok_gudang4;
        $total = $total_gudang + $total_toko;
        return view('stock.show', compact('requestProducts','data','datastock','total','total_toko','total_gudang'));
    }
}
