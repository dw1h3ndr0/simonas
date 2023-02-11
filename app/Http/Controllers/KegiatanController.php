<?php

namespace App\Http\Controllers;

use \App\Simonas_Kegiatan;
use \App\Simonas_Provinsi;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function getProvinsi()
    {
        //return $provinsi->kabupaten()->select('kode', 'kabupaten')->get();
        $prov = Simonas_Provinsi::all()->pluck('provinsi','kode');        
		return json_encode($prov);
    }
}
