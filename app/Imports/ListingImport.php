<?php

namespace App\Imports;

use App\Simonas_Listing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ListingImport implements ToModel, WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Simonas_Listing([
            //
        ]);
    }

    public function sheets(): array
    {
        return [
            new FirstSheetListingImport()
        ];
    }
}
