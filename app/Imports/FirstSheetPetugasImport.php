<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Concerns\WithValidation;


class FirstSheetPetugasImport implements ToCollection, WithHeadingRow, WithValidation
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new User([
    //         //
    //     ]);
    // }

    public function collection(Collection $rows)
    {

        // $validator = Validator::make($rows->toArray(), [
        //     'role_adminuser' => 'required',
        //     'nama' => 'required|min:3|max:50',
        //     'jabatan_organikmitra' => 'required',
        //     'no_hp'=> 'required|numeric',
        //     'email' => 'required|unique:\App\User,email|email|regex:/^.+@.+$/i'
        //  ]);

        // if($validator->fails()){
        //     return Alert::error('Gagal', 'Terdapat eror');
        //     // $validator->validate()
        // }else{

            foreach ($rows as $row) 
            {
            // var_dump($row['nomor_hp']);
            // dd($row);
                // $array = $row->toArray();
                // var_dump($array);


                //insert ke tabel users
                // dd($row);
                $password = Hash::make('12345678');
                $remember_token = Str::random(60);            

                User::create([
                    'role' => $row['role_adminuser'],
                    'nama' => $row['nama'],
                    'jabatan' => $row['jabatan_organikmitra'],
                    'no_hp' => $row['nomor_hp'], 
                    'email' => $row['email'],
                    'password' => $password,
                    'remember_token' => $remember_token
                ]);
            }
        // }

    }

    public function rules(): array
    {
        return [
            '*.email' => ['email', 'unique:\App\User,email']
        ];
    }

    public function withValidator($validator)
    {
        if($validator->errors() != null){
            
            Alert::error('Gagal', 'Terdapat duplikasi email');
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

    // public function onFailure(Failure ...$failures)
    // {
    //     // Handle the failures how you'd like.
    // }


}
