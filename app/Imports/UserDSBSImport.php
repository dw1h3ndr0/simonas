<?php

namespace App\Imports;

use App\Simonas_User_DSBS;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UserDSBSImport implements ToModel, WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Simonas_User_DSBS([
            //
        ]);
    }

    public function sheets(): array
    {
        return [
            new FirstSheetUserDSBSImport()
        ];
    }
}
