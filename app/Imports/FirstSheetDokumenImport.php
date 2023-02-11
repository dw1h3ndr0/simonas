<?php

namespace App\Imports;

use App\Simonas_Dokumen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;

class FirstSheetDokumenImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new Simonas_Dokumen([
    //         //
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {   
            // dd($row);
            DB::table('simonas_dokumen')
            ->where('kegiatan_id', '=', $row['kegiatan'])
            ->where('nks', '=', $row['nomor_kode_sampel'])
            ->where('nus','=', $row['nomor_urut_sampel'])
            ->update([
                'p1' =>  $row['p1'],
                'p2' =>  $row['p2'],
                'p3' =>  $row['p3'],
                'status' => $row['status_selesaibelum'],
                'updated_at' => date('Y-m-d G:i:s')
            ]); 
        }
    }

    public function rules(): array
    {
        return [
            // '*.kode' => ['required', 'unique:Simonas_User_DSBS,kode'],
            // '*.dsbs_id' => ['dsbs_id', 'unique:Simonas_User_DSBS,dsbs_id']
        ];
    }

    public function withValidator($validator)
    {
        if($validator->errors() != null){
            
            Alert::error('Gagal', 'Terdapat eror saat import data');
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
