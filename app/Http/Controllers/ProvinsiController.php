<?php

namespace App\Http\Controllers;

use \App\Simonas_Provinsi;
use \App\Simonas_Kabupaten;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function getKabupaten($kode_provinsi)
    {
        //return $provinsi->kabupaten()->select('kode', 'kabupaten')->get();
        $kab = Simonas_Kabupaten::where('provinsi_id',$kode_provinsi)->orderBy('id','asc')->pluck('kabupaten','kode');
		return json_encode($kab);
    }
}
