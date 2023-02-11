<?php

namespace App\Imports;

use App\Simonas_Sampel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SampelImport implements ToModel, WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Simonas_Sampel([
            //
        ]);
    }

    public function sheets(): array
    {
        return [
            new FirstSheetSampelImport()
        ];
    }
}
