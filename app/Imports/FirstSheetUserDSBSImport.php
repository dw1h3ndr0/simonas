<?php

namespace App\Imports;

use App\Simonas_User_DSBS;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Concerns\WithValidation;

class FirstSheetUserDSBSImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new Simonas_User_DSBS([
    //         //
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {   

            $pcl = \App\User::where('email',$row['email_pcl'])->first();
            $pml = \App\User::where('email',$row['email_pml'])->first();
            $dsbs = \App\Simonas_DSBS::where('nks',$row['nomor_kode_sampel_nks'])->first();

            // dd($dsbs);
            //insert ke tabel user_dsbs dengan status PCL
            $user_dsbs = new \App\Simonas_User_DSBS;
            $user_dsbs->user_id = $pcl->id;
            $user_dsbs->dsbs_id = $dsbs->id;
            $user_dsbs->kegiatan_id = $row['kegiatan'];
            $user_dsbs->status = 'PCL';
            $user_dsbs->leader = $pml->id;
            $user_dsbs->kode = $row['kode_pcl'];

            $user_dsbs->save(); 

            //insert ke tabel simonas_sampel
            for ($i=0; $i < 10; $i++) { 
                $sampel = new \App\Simonas_Sampel;
                $sampel->user_dsbs_id = $user_dsbs->id;
                $sampel->kegiatan_id = $user_dsbs->kegiatan_id;
                $sampel->pml_id = $user_dsbs->leader;
                $sampel->pcl_id = $user_dsbs->user_id;
                $sampel->nks = $dsbs->nks;
                $sampel->nus = strval($i+1);
                $sampel->save();
            }       

            //insert ke tabel simonas_dokumen
            for ($i=0; $i < 10; $i++) { 
                $dokumen = new \App\Simonas_Dokumen;
                $dokumen->user_dsbs_id = $user_dsbs->id;
                $dokumen->kegiatan_id = $user_dsbs->kegiatan_id;
                $dokumen->pml_id = $user_dsbs->leader;
                $dokumen->pcl_id = $user_dsbs->user_id;
                $dokumen->nks = $dsbs->nks;
                $dokumen->nus = strval($i+1);
                $dokumen->save();
            }       

            //insert ke tabel simonas_listing
            $listing = new \App\Simonas_Listing;
            $listing->user_dsbs_id = $user_dsbs->id;
            $listing->kegiatan_id = $user_dsbs->kegiatan_id;
            $listing->pml_id = $user_dsbs->leader;
            $listing->pcl_id = $user_dsbs->user_id;
            $listing->nks = $dsbs->nks;
            $listing->save();

            //Cek tabel user_dsbs dengan status PML
            if(Simonas_User_DSBS::where([
                ['user_id',$pml->id],
                ['dsbs_id',$dsbs->id],
                ['status','PML']
            ])->exists()){

            }else{
                //jika belum ada PML pada NKS maka insert user_dsbs dengan status PML 
                Simonas_User_DSBS::create([
                    'kegiatan_id' => $row['kegiatan'],
                    'user_id' => $pml->id,
                    'dsbs_id' => $dsbs->id,
                    'status' => 'PML',
                    'kode' => $row['kode_pml']
                ]);                
            }
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
