<?php

namespace App\Imports;

use App\Simonas_DSBS;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DSBSImport implements ToModel, WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Simonas_DSBS([
            //
        ]);
    }

    public function sheets(): array
    {
        return [
            new FirstSheetDSBSImport()
        ];
    }
}
