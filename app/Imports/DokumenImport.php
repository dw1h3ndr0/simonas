<?php

namespace App\Imports;

use App\Simonas_Dokumen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DokumenImport implements ToModel, WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Simonas_Dokumen([
            //
        ]);
    }

    public function sheets(): array
    {
        return [
            new FirstSheetDokumenImport()
        ];
    }
}
