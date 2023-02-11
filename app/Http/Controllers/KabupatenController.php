<?php

namespace App\Http\Controllers;

use \App\Simonas_Kabupaten;
use \App\Simonas_Kecamatan;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function getKecamatan($kode_provinsi,$kode_kabupaten)
    {
        // $kec = Kecamatan::where('provinsi_id',$kode_provinsi)
        // 		->andWhere('kabupaten_id',$kode_kabupaten)
        // 		->pluck('kecamatan','kode');
        $kec = Simonas_Kecamatan::where([
        	['provinsi_id','=',$kode_provinsi],
        	['kabupaten_id','=',$kode_kabupaten],
        ])->pluck('kecamatan','kode');
		return json_encode($kec);
    }
}
