<?php

namespace App\Imports;

use App\Simonas_Supervisor;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

class FirstSheetSupervisorImport implements ToCollection, WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new Simonas_Supervisor([
    //         //
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
        // var_dump($row['nomor_hp']);
        // dd($row);
            // $array = $row->toArray();
            // var_dump($array);
            //insert ke tabel users
            $user = new \App\User;
            $user->kegiatan_id = $row['kegiatan'];
            $user->role = 'admin';
            $user->name = $row['nama'];
            $user->email = $row['email'];
            $user->password = Hash::make('12345678');
            $user->remember_token = Str::random(60);
            $user->save();

            Simonas_Supervisor::create([
                'user_id' => $user->id,
                'kegiatan_id' => $row['kegiatan'],
                'nama' => $row['nama'],
                'no_hp' => $row['nomor_hp'], 
                'email' => $row['email'],
            ]);
        }
    }
    
}
