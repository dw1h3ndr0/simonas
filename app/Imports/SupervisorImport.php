<?php

namespace App\Imports;

use App\Simonas_Supervisor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SupervisorImport implements  WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     //insert ke tabel users
    //         $user = new \App\User;
    //         $user->kegiatan_id = $row[0];
    //         $user->role = 'admin';
    //         $user->name = $row[1];
    //         $user->email = $row[3];
    //         $user->password = Hash::make('12345678');
    //         $user->remember_token = Str::random(60);
    //         $user->save();

    //     return new Simonas_Supervisor([
    //         'user_id' => $user->id,
    //         'kegiatan_id' => $row['kegiatan'],
    //         'nama' => $row['nama'],
    //         'no_hp' => $row['nomor_hp'], 
    //         'email' => $row['email'],
    //     ]);
    // }


    public function sheets(): array
    {
        return [
            new FirstSheetSupervisorImport()
        ];
    }

    
}
