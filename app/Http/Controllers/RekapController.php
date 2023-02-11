<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Simonas_DSBS;
use App\Simonas_User_DSBS;
use App\Simonas_Sampel;

use App\Exports\SampelExport;
use App\Exports\DokumenExport;
use App\Exports\ListingExport;
use Maatwebsite\Excel\Facades\Excel;

class RekapController extends Controller
{
    public function index_sampel()
    {    	
    	$data_sampel = DB::table('simonas_sampel')
    		->leftJoin('simonas_user_dsbs','simonas_sampel.user_dsbs_id','=','simonas_user_dsbs.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->select('simonas_sampel.*', 'simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id') 
            // ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();

    	$data_dsbs = \App\Simonas_DSBS::all();    
    	$data_kegiatan = \App\Simonas_Kegiatan::all();

    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}
    	
    	return view('rekap.index_sampel',[
    		'data_kegiatan' =>$data_kegiatan,
    		'data_dsbs' => $data_dsbs,
    		'data_sampel' => $data_sampel,
    		'kode_kegiatan' => '1',
    		'kode_nks' => '00'
    	]);
    }

    public function index_dokumen()
    {    	
    	$data_dokumen = DB::table('simonas_dokumen')
    		->leftJoin('simonas_user_dsbs','simonas_dokumen.user_dsbs_id','=','simonas_user_dsbs.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->select('simonas_dokumen.*', 'simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id') 
            // ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();

    	$data_dsbs = \App\Simonas_DSBS::all();    
    	$data_kegiatan = \App\Simonas_Kegiatan::all();

    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}
    	
    	return view('rekap.index_dokumen',[
    		'data_kegiatan' =>$data_kegiatan,
    		'data_dsbs' => $data_dsbs,
    		'data_dokumen' => $data_dokumen,
    		'kode_kegiatan' => '1',
    		'kode_nks' => '00'
    	]);
    }

    public function index_listing()
    {    	
    	$data_listing = DB::table('simonas_listing')
    		->leftJoin('simonas_user_dsbs','simonas_listing.user_dsbs_id','=','simonas_user_dsbs.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->select('simonas_listing.*', 'simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id') 
            // ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();

    	$data_dsbs = \App\Simonas_DSBS::all();    
    	$data_kegiatan = \App\Simonas_Kegiatan::all();

    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}
    	
    	return view('rekap.index_listing',[
    		'data_kegiatan' =>$data_kegiatan,
    		'data_dsbs' => $data_dsbs,
    		'data_listing' => $data_listing,
    		'kode_kegiatan' => '1',
    		'kode_nks' => '00'
    	]);
    }

    public function refresh_sampel($kode_kegiatan, $kode_nks)
    {    	    	
    	if($kode_nks == '00'){    		
	    	$data_sampel = DB::table('simonas_sampel')
    		->leftJoin('simonas_user_dsbs','simonas_sampel.user_dsbs_id','=','simonas_user_dsbs.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->select('simonas_sampel.*', 'simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id') 
            // ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();    	    		
    	}else{  	
    		$data_sampel = DB::table('simonas_sampel')
    		->leftJoin('simonas_user_dsbs','simonas_sampel.user_dsbs_id','=','simonas_user_dsbs.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->select('simonas_sampel.*', 'simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id') 
            ->where('simonas_sampel.nks', '=', $kode_nks )
            ->get();    		   	
    	}

    	$data_kegiatan = \App\Simonas_Kegiatan::all();      	
    	$data_dsbs = \App\Simonas_DSBS::all();   
    	
    	// dd($data_sampel);
    	return view('rekap.index_sampel',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_dsbs' => $data_dsbs,
    		'data_sampel' => $data_sampel,
    		'kode_kegiatan' => $kode_kegiatan,
    		'kode_nks' => $kode_nks
    	]);
    }

    public function refresh_dokumen($kode_kegiatan, $kode_nks)
    {    	    	
    	if($kode_nks == '00'){    		
	    	$data_dokumen = DB::table('simonas_dokumen')
    		->leftJoin('simonas_user_dsbs','simonas_dokumen.user_dsbs_id','=','simonas_user_dsbs.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->select('simonas_dokumen.*', 'simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id') 
            // ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();    	    		
    	}else{  	
    		$data_dokumen = DB::table('simonas_dokumen')
    		->leftJoin('simonas_user_dsbs','simonas_dokumen.user_dsbs_id','=','simonas_user_dsbs.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->select('simonas_dokumen.*', 'simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id') 
            ->where('simonas_dokumen.nks', '=', $kode_nks )
            ->get();    		   	
    	}

    	$data_kegiatan = \App\Simonas_Kegiatan::all();      	
    	$data_dsbs = \App\Simonas_DSBS::all();   
    	
    	// dd($data_dokumen);
    	return view('rekap.index_dokumen',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_dsbs' => $data_dsbs,
    		'data_dokumen' => $data_dokumen,
    		'kode_kegiatan' => $kode_kegiatan,
    		'kode_nks' => $kode_nks
    	]);
    }

    public function refresh_listing($kode_kegiatan, $kode_nks)
    {    	    	
    	if($kode_nks == '00'){    		
	    	$data_listing = DB::table('simonas_listing')
    		->leftJoin('simonas_user_dsbs','simonas_listing.user_dsbs_id','=','simonas_user_dsbs.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->select('simonas_listing.*', 'simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id') 
            // ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();    	    		
    	}else{  	
    		$data_listing = DB::table('simonas_listing')
    		->leftJoin('simonas_user_dsbs','simonas_listing.user_dsbs_id','=','simonas_user_dsbs.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->select('simonas_listing.*', 'simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id') 
            ->where('simonas_listing.nks', '=', $kode_nks )
            ->get();    		   	
    	}

    	$data_kegiatan = \App\Simonas_Kegiatan::all();      	
    	$data_dsbs = \App\Simonas_DSBS::all();   
    	
    	// dd($data_listing);
    	return view('rekap.index_listing',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_dsbs' => $data_dsbs,
    		'data_listing' => $data_listing,
    		'kode_kegiatan' => $kode_kegiatan,
    		'kode_nks' => $kode_nks
    	]);
    }

    public function export_excel_sampel()
	{

		return Excel::download(new SampelExport, 'pencacahan.xls', \Maatwebsite\Excel\Excel::XLS);
	
	}


    public function export_excel_dokumen()
	{

		return Excel::download(new DokumenExport, 'dokumen.xls', \Maatwebsite\Excel\Excel::XLS);
	
	}

    public function export_excel_listing()
	{

		return Excel::download(new ListingExport, 'listing.xls', \Maatwebsite\Excel\Excel::XLS);
	
	}

}
