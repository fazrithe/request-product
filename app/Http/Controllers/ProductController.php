<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;
use DataTables;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product_date = $request->session()->get('create_date');
        // return $product_date;
        $products = Product::select('sales_stocks.*','products.*','sales_stocks.updated_at as stock_date')
        ->whereDate('sales_stocks.updated_at', $request->date)
        ->orWhereDate('products.updated_at', $product_date)
        ->leftjoin('sales_stocks', 'sales_stocks.product_id', '=', 'products.id')
        ->get();

        // return $product;
        return view('products.index', compact('products'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectProduct()
    {
        // $u = User::whereHas(
        //     'roles', function($q){
        //         $q->where('name', 'Sales');
        //     }
        // )->get();
        // foreach($u as $d){
        //     return $d->name;
        // }
        return view('products.select');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'kode_barang' => 'required',
            'barcode' => 'required',
            'nama_barang' => 'required',
        ]);

        $product = new Product();
        $product->kode_barang = $request->kode_barang;
        $product->barcode = $request->barcode;
        $product->nama_barang = $request->nama_barang;
        $product->merk = $request->merk;
        $product->satuan = $request->satuan;
        $product->harga_jakarta = $request->harga_jakarta;
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/uploads'), $filename);
            $product->gambar = $filename;
        }
        $product->harga_bali = $request->harga_bali;
        $product->created_at = $request->create_date;
        $product->save();
        $request->session()->put('create_date', $request->create_date);
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
         request()->validate([
            'nama_barang' => 'required',
        ]);

        $product = Product::find($request->id);
        $product->kode_barang = $request->kode_barang;
        $product->barcode = $request->barcode;
        $product->nama_barang = $request->nama_barang;
        $product->merk = $request->merk;
        $product->satuan = $request->satuan;
        $product->harga_jakarta = $request->harga_jakarta;
        $product->harga_bali = $request->harga_bali;
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/uploads'), $filename);
            $product->gambar = $filename;
        }
        $product->created_at = $request->create_date;
        $product->updated_at = $request->create_date;
        $product->save();
        $request->session()->put('create_date', $request->create_date);

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $date = $request->date;
        return Excel::download(new ProductExport($date), 'product.xlsx');
    }
}
