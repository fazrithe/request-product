<?php
use App\Models\User;
use App\Models\Product;
use App\Models\Sales_stock;
use Illuminate\Support\Facades\DB;

function rupiah($angka){

	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	echo $hasil_rupiah;

}

function salesUsers($product_id,$user_id,$date){
   $sales = Sales_stock::where('product_id',$product_id)
//    ->where('user_id',$user_id)
   ->whereDate('updated_at', $date)
   ->first();

   return $sales->user_id;
}

function salesTokoStok($product_id,$user_id,$date){
    $sales = Sales_stock::where('product_id',$product_id)
    ->where('user_id',$user_id)
    ->whereDate('updated_at', $date)
    ->selectRaw("SUM(stok_toko) as total")
    ->first();

    return $sales->total;
 }

 function salesGudangStok($product_id,$user_id){
    $sales = Sales_stock::where('product_id',$product_id)
    ->where('user_id',$user_id)
    ->selectRaw("SUM(stok_gudang) as total")
    ->first();

    return $sales->total;
 }
