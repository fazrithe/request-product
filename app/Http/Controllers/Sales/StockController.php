<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sales_stock;

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
            'area'  => Auth::user()->area,
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
        $area = Auth::user()->area;
        $user_id = Auth::user()->id;
        $data = Sales_stock::where('product_id',$request->id)
        ->whereDate('sales_stocks.updated_at', $request->update_date)
        ->first();
        if(!empty($data)){
            $salesStock = Sales_stock::where('product_id',$request->id)->first();
            $salesStock->user_id = $user_id;
            $salesStock->product_id = $request->id;
            if($area == 'toko1'){
                $salesStock->stok_toko1 = $request->stock;
            }elseif($area == 'toko2'){
                $salesStock->stok_toko2 = $request->stock;
            }elseif($area == 'toko3'){
                $salesStock->stok_toko3 = $request->stock;
            }elseif($area == 'toko4'){
                $salesStock->stok_toko4 = $request->stock;
            }elseif($area == 'toko5'){
                $salesStock->stok_toko5 = $request->stock;
            }elseif($area == 'gudang1'){
                $salesStock->stok_gudang1 = $request->stock;
            }elseif($area == 'gudang2'){
                $salesStock->stok_gudang2 = $request->stock;
            }elseif($area == 'gudang3'){
                $salesStock->stok_gudang3 = $request->stock;
            }elseif($area == 'gudang4'){
                $salesStock->stok_gudang4 = $request->stock;
            }elseif($area == 'gudang5'){
                $salesStock->stok_gudang5 = $request->stock;
            }
            $salesStock->updated_at = $request->update_date;
            $salesStock->save();
        }else{
            $salesStock = new Sales_stock();
            $salesStock->user_id = $user_id;
            $salesStock->product_id = $request->id;
            if($area == 'toko1'){
                $salesStock->stok_toko1 = $request->stock;
            }elseif($area == 'toko2'){
                $salesStock->stok_toko2 = $request->stock;
            }elseif($area == 'toko3'){
                $salesStock->stok_toko3 = $request->stock;
            }elseif($area == 'toko4'){
                $salesStock->stok_toko4 = $request->stock;
            }elseif($area == 'toko5'){
                $salesStock->stok_toko5 = $request->stock;
            }elseif($area == 'gudang1'){
                $salesStock->stok_gudang1 = $request->stock;
            }elseif($area == 'gudang2'){
                $salesStock->stok_gudang2 = $request->stock;
            }elseif($area == 'gudang3'){
                $salesStock->stok_gudang3 = $request->stock;
            }elseif($area == 'gudang4'){
                $salesStock->stok_gudang4 = $request->stock;
            }elseif($area == 'gudang5'){
                $salesStock->stok_gudang5 = $request->stock;
            }
            $salesStock->updated_at = $request->update_date;
            $salesStock->save();
        }

        return redirect()->to('showProduct/'.$request->id);
    }

          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProduct($id)
    {
        $data = Product::find($id);
        $datastock = Sales_stock::where('product_id',$id)->first();
        $total_toko = $datastock->stok_toko1 + $datastock->stok_toko2 + $datastock->stok_toko3 + $datastock->stok_toko4 + $datastock->stok_toko4;
        $total_gudang = $datastock->stok_gudang1 + $datastock->stok_gudang2 + $datastock->stok_gudang3 + $datastock->stok_gudang4 + $datastock->stok_gudang4;
        $total = $total_gudang + $total_toko;
        return view('stock.show', compact('data','datastock','total','total_toko','total_gudang'));
    }
}
