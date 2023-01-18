<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_stock extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','product_id','stok_gudang1','stok_gudang2','stok_gudang3','stok_gudang4','stok_gudang5','stok_toko1','stok_toko2','stok_toko3','stok_toko4','stok_toko5'
    ];
}
