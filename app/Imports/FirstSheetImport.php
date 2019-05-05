<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FirstSheetImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            Product::create([
                'product_name' => $row[0],
                'product_description' => $row[1],
                'product_cost' => $row[2],
                'product_image' => $row[3]
            ]);
        }
    }
}
