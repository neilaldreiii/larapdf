<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Storage;

class FirstSheetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            Product::create([
                'name' => $row['product_name'],
                'description' => $row['product_description'],
                'cost' => $row['product_cost'],
                'image' => $row['product_image']
            ]);
        }
    }
}
