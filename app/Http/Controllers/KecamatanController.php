<?php

namespace App\Http\Controllers;

use \App\Simonas_Kecamatan;
use \App\Simonas_Desa;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function getDesa($kode_provinsi, $kode_kabupaten ,$kode_kecamatan)
    {
        // return $kecamatan->desa()->select('kode', 'desa')->get();   
        // $desa = Desa::where('provinsi_id',$kode_provinsi)
        // 		->orWhere('kabupaten_id',$kode_kabupaten)
        // 		->orWhere('kecamatan_id',$kode_kecamatan)
        // 		->pluck('desa','kode');
        $desa = Simonas_Desa::where([
        	['provinsi_id','=',$kode_provinsi],
        	['kabupaten_id','=',$kode_kabupaten],
        	['kecamatan_id','=',$kode_kecamatan],
        ])->pluck('desa','kode');        
		return json_encode($desa);     
    }
}
