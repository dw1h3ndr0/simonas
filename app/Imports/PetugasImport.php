<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\SkipsOnError;
// use Throwable;


class PetugasImport implements toModel, WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            //
        ]);
    }

    public function sheets(): array
    {
        return [
            new FirstSheetPetugasImport()
        ];
    }

    // public function onError(Throwable $e)
    // {
    //     // return 'eror';
    // }

}
