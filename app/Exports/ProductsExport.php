<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select('product_name', 'product_description', 'product_cost')->get();
    }

    public function headings() : array
    {
        return [
            'Product Name',
            'Product Description',
            'Product Cost'
        ];
    }

}
