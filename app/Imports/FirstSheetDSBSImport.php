<?php

namespace App\Imports;

use App\Simonas_DSBS;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Concerns\WithValidation;

class FirstSheetDSBSImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new Simonas_DSBS([
    //         //
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {                   
            // dd($row);
            Simonas_DSBS::create([
                'kegiatan_id' => $row['kegiatan'],
                'provinsi_id' => $row['kode_provinsi'],
                'kabupaten_id' => $row['kode_kabupaten'],
                'kecamatan_id' => $row['kode_kecamatan'], 
                'desa_id' => $row['kode_desakelurahan'],
                'nbs' => $row['nbs'],
                'nks' => $row['nks']
            ]);
        }
    }

    public function rules(): array
    {
        return [
            '*.nks' => ['required', 'unique:\App\Simonas_DSBS,nks']
        ];
    }

    public function withValidator($validator)
    {
        if($validator->errors() != null){
            
            Alert::error('Gagal', 'Terdapat duplikasi nomor kode sampel');
        }
        // $validator = Validator::make($rows->toArray(), [
        //     'role_adminuser' => 'required',
        //     'nama' => 'required|min:3|max:50',
        //     'jabatan_organikmitra' => 'required',
        //     'no_hp'=> 'required|numeric',
        //     'email' => 'required|unique:\App\User,email|email|regex:/^.+@.+$/i'
        //  ]);

        // $validator->after(function ($validator) {
        //     if ($this->somethingElseIsInvalid()) {
        //         $validator->errors()->add('field', 'Something is wrong with this field!');
        //     }
        // });

        // // or...

        // $validator->sometimes('*.email', 'required', $this->someConditionalRequirement());
    }
}
