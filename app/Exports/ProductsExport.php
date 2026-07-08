<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    public function collection()
    {
        return Product::select(
            'product_code',
            'product_name',
            'stock',
            'location',
            'status'
        )->get();
    }
}