<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductsImport implements WithMultipleSheets
{
    public function sheets() : array
    {
        return [
            new FirstSheetImport()
        ];
    }
}
