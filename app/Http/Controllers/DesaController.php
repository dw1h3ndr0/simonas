<?php

namespace App\Http\Controllers;

use \App\Simonas_Desa;
use \App\Simonas_DSBS;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function getNKS($kode_kegiatan, $kode_provinsi, $kode_kabupaten ,$kode_kecamatan, $kode_desa)
    {
        // return $kecamatan->desa()->select('kode', 'desa')->get();   
        // $desa = Desa::where('provinsi_id',$kode_provinsi)
        // 		->orWhere('kabupaten_id',$kode_kabupaten)
        // 		->orWhere('kecamatan_id',$kode_kecamatan)
        // 		->pluck('desa','kode');
        $nks = Simonas_DSBS::where([
        	['kegiatan_id','=',$kode_kegiatan],
        	['provinsi_id','=',$kode_provinsi],
        	['kabupaten_id','=',$kode_kabupaten],
        	['kecamatan_id','=',$kode_kecamatan],
        	['desa_id','=',$kode_desa],
        ])->pluck('nks');     
		return json_encode($nks);     
    }
}
