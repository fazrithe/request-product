<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements FromView
{
     /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(string $keyword)
    {
        $this->date = $keyword;
    }

    public function view(): View
    {
        return view('products.export', [
            'data' => Product::select('sales_stocks.*','products.*','sales_stocks.updated_at as stock_date')
            ->whereDate('sales_stocks.updated_at', $this->date)
            ->leftjoin('sales_stocks', 'sales_stocks.product_id', '=', 'products.id')
            ->get(),
            'user' => User::whereHas(
                'roles', function($q){
                    $q->where('name', 'Sales');
                }
            )->get()
        ]);
    }
}
