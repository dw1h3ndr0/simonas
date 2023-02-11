<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Imports\ListingImport;
use Maatwebsite\Excel\Facades\Excel;

class ListingController extends Controller
{
    public function index()
    {    	
    	if(Auth()->user()->role == 'admin'){
	    	$data_listing = \App\Simonas_Listing::all();
	    	$data_dsbs = \App\Simonas_DSBS::all();
    	}else{
    		$data_listing = \App\Simonas_Listing::where(
	    		'pml_id','=',Auth()->user()->id
	    	)->get();
	    	$data_dsbs = \App\Simonas_Listing::where(
	    		'pml_id','=',Auth()->user()->id
	    	)->select('nks')->groupBy('nks')->get()->toArray();
    	}

    	$data_kegiatan = \App\Simonas_Kegiatan::all();
    
    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}
    	
    	return view('listing.index',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_dsbs' => $data_dsbs,
    		'data_listing' => $data_listing,
    		'kode_kegiatan' => '1',
    		'kode_nks' => '00'
    	]);
    }

    public function refresh($kode_kegiatan, $kode_nks)
    {    	    	
    	if($kode_nks == '00'){
    		if(Auth()->user()->role == 'admin'){
		    	$data_listing = \App\Simonas_Listing::where(
		    		'kegiatan_id','=',$kode_kegiatan
		    	)->get();
		    	$data_dsbs = \App\Simonas_DSBS::where(
		    		'kegiatan_id','=',$kode_kegiatan
		    	)->get();
	    	}else{
	    		$data_listing = \App\Simonas_Listing::where('kegiatan_id','=',$kode_kegiatan)
	    		->where('pml_id','=',Auth()->user()->id
		    	)->get();
		    	$data_dsbs = \App\Simonas_Listing::where('kegiatan_id','=',$kode_kegiatan)
		    	->where('pml_id','=',Auth()->user()->id)
		    	->select('nks')
		    	->groupBy('nks')
		    	->get()
		    	->toArray();
	    	}    		
    	}else{  	
    		if(Auth()->user()->role == 'admin'){
		    	$data_listing = \App\Simonas_Listing::where('kegiatan_id','=',$kode_kegiatan)
		    	->where('nks','=',$kode_nks)
		    	->get();
		    	$data_dsbs = \App\Simonas_DSBS::where(
		    		'kegiatan_id','=',$kode_kegiatan
		    	)->get();
	    	}else{
	    		$data_listing = \App\Simonas_Listing::where('kegiatan_id','=',$kode_kegiatan)
	    		->where('pml_id','=',Auth()->user()->id)
	    		->where('nks','=',$kode_nks)
	    		->get();
		    	$data_dsbs = \App\Simonas_Listing::where('kegiatan_id','=',$kode_kegiatan)
		    	->where('pml_id','=',Auth()->user()->id)
		    	->select('nks')
		    	->groupBy('nks')
		    	->get()
		    	->toArray();
		    }		    	
    	}

    	$data_kegiatan = \App\Simonas_Kegiatan::all();    
    	
    	// dd($data_listing);
    	return view('listing.index',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_dsbs' => $data_dsbs,
    		'data_listing' => $data_listing,
    		'kode_kegiatan' => $kode_kegiatan,
    		'kode_nks' => $kode_nks
    	]);
    }

    public function edit($kode_kegiatan, $kode_nks, $page)
    {
    	// $listing = \App\Simonas_Listing::findOrFail($id);
    	$listing = \App\Simonas_Listing::where('kegiatan_id','=',$kode_kegiatan)
    	->where('nks','=',$kode_nks)
    	->first();
    	// dd($listing);

    	$user_dsbs = \App\Simonas_User_DSBS::findOrFail($listing->user_dsbs_id);
    	$dsbs = \App\Simonas_DSBS::findOrFail($user_dsbs->dsbs_id);

    	if(Auth()->user()->role == 'admin'){
		    	$data_listing = \App\Simonas_Listing::where('kegiatan_id','=',$kode_kegiatan)
		    	->where('nks','=',$kode_nks)
		    	->get();
		    	$data_dsbs = \App\Simonas_DSBS::where(
		    		'kegiatan_id','=',$kode_kegiatan)
		    	->get();
	    	}else{
	    		$data_listing = \App\Simonas_Listing::where('kegiatan_id','=',$kode_kegiatan)
	    		->where('pml_id','=',Auth()->user()->id)
	    		->where('nks','=',$kode_nks)
	    		->get();
		    	$data_dsbs = \App\Simonas_Listing::where('kegiatan_id','=',$kode_kegiatan)
		    	->where('pml_id','=',Auth()->user()->id)
		    	->select('nks')
		    	->groupBy('nks')
		    	->get()
		    	->toArray();
		    }

    	$data_kegiatan = \App\Simonas_Kegiatan::all();    
    	$data_provinsi = \App\Simonas_Provinsi::all();
    	$data_kabupaten = \App\Simonas_Kabupaten::all();

    	return view('listing.edit',[
    		'listing' => $listing,
    		'kode_provinsi' => $dsbs->provinsi_id,
    		'kode_kabupaten' => $dsbs->kabupaten_id,
    		'data_dsbs' => $data_dsbs,
    		'data_listing' => $data_listing,
    		'data_kegiatan' => $data_kegiatan,
    		'data_provinsi' => $data_provinsi,
    		'data_kabupaten' => $data_kabupaten,
    		'page' => $page
    	]);

    }

    public function update(Request $request, $page )
    {
    	$validator = Validator::make($request->all(),[
    		'kegiatan' => 'required',
    		'provinsi' => 'required',
    		'kabupaten' => 'required',
    		'nks'=> 'required',
    		'p1' => 'required|numeric',
    		'status' => 'required',
    	]);
    	
    	if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

    		//insert ke tabel listing
    		try{
    			if(\App\Simonas_Listing::where([
	    		  		['kegiatan_id',$request->kegiatan],
		                ['nks',$request->nks],
		                ['status',NULL]
		            ])->exists()){

					DB::table('simonas_listing')
		    		  	->where('kegiatan_id', '=', $request->kegiatan)
		    		  	->where('nks', '=', $request->nks)
		    		  	->update([
		    		  		'p1' =>  $request->p1,
		    		  		'status' => $request->status,
			                'created_at' => Carbon::now(),
			                'updated_at' => Carbon::now()
		    		  	]);
    			}else{    				
		    		DB::table('simonas_listing')
		    		  	->where('kegiatan_id', '=', $request->kegiatan)
		    		  	->where('nks', '=', $request->nks)
		    		  	->update([
		    		  		'p1' =>  $request->p1,
		    		  		'status' => $request->status,
			                'updated_at' => Carbon::now()
		    		  	]);	   		
    			}
    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}

    		if(Auth()->user()->role == 'admin'){
		    	$data_listing = \App\Simonas_Listing::where('kegiatan_id','=',$request->kegiatan)
		    	->where('nks','=',$request->nks)
		    	->get();
		    	$data_dsbs = \App\Simonas_DSBS::where(
		    		'kegiatan_id','=',$request->kegiatan)
		    	->get();
	    	}else{
	    		$data_listing = \App\Simonas_Listing::where('kegiatan_id','=',$request->kegiatan)
	    		->where('pml_id','=',Auth()->user()->id)
	    		->where('nks','=',$request->nks)
	    		->get();
		    	$data_dsbs = \App\Simonas_Listing::where('kegiatan_id','=',$request->kegiatan)
		    	->where('pml_id','=',Auth()->user()->id)
		    	->select('nks')
		    	->groupBy('nks')
		    	->get()
		    	->toArray();
		    }

		    $data_kegiatan = \App\Simonas_Kegiatan::all();

    		//jika dari halaman index kembali ke halaman index
	    	if($page == 'index'){
	    		
		    	Alert::success('Berhasil', 'Data listing berhasil diinput');
		    	return view('listing.index',[
		    		'data_kegiatan' => $data_kegiatan,
		    		'data_dsbs' => $data_dsbs,
		    		'data_listing' => $data_listing,
		    		'kode_kegiatan' => $request->kegiatan,
		    		'kode_nks' => $request->nks
		    	]);
	    	}else //jika dari halaman input kembali ke halaman edit
	    	{

	    		$listing = \App\Simonas_Listing::where('kegiatan_id','=',$request->kegiatan)
		    	->where('nks','=',$request->nks)
		    	->first();
		    	// dd($listing);

		    	$user_dsbs = \App\Simonas_User_DSBS::findOrFail($listing->user_dsbs_id);
		    	$dsbs = \App\Simonas_DSBS::findOrFail($user_dsbs->dsbs_id);

		    	$data_provinsi = \App\Simonas_Provinsi::all();
		    	$data_kabupaten = \App\Simonas_Kabupaten::all();

		    	Alert::success('Berhasil', 'Data listing berhasil diinput');
	    		return view('listing.input',[
		    		// 'listing' => $listing,
		    		'kode_kegiatan' => '1',
		    		'kode_provinsi' => $dsbs->provinsi_id,
		    		'kode_kabupaten' => $dsbs->kabupaten_id,
		    		'data_dsbs' => $data_dsbs,
		    		'data_listing' => $data_listing,
		    		'data_kegiatan' => $data_kegiatan,
		    		'data_provinsi' => $data_provinsi,
		    		'data_kabupaten' => $data_kabupaten,
		    		// 'page' => $page
		    	]);
		    	// $this->edit($request->kegiatan,$request->nks,$request->nus,$page);
	    	}

    	}
    }

    public function input()
    {
    	if(Auth()->user()->role == 'admin'){
	    	$data_listing = \App\Simonas_Listing::where('kegiatan_id','=','1')
	    	->get();
	    	$data_dsbs = \App\Simonas_DSBS::where(
	    		'kegiatan_id','=','1')
	    	->get();
    	}else{
    		$data_listing = \App\Simonas_Listing::where('kegiatan_id','=','1')
    		->where('pml_id','=',Auth()->user()->id)
    		->get();
	    	$data_dsbs = \App\Simonas_Listing::where('kegiatan_id','=','1')
	    	->where('pml_id','=',Auth()->user()->id)
	    	->select('nks')
	    	->groupBy('nks')
	    	->get()
	    	->toArray();
	    }

    	// $listing = \App\Simonas_Listing::findOrFail($id);
    	// $user_dsbs = \App\Simonas_User_DSBS::where('kegiatan_id','=','1')
    	// ->where('user_id','=',Auth()->user()->id)
    	// ->first();
    	// $dsbs = \App\Simonas_DSBS::findOrFail($user_dsbs->dsbs_id);

    	// $data_dsbs = \App\Simonas_DSBS::all();
    	// $data_listing = \App\Simonas_Listing::all();
    	$data_kegiatan = \App\Simonas_Kegiatan::all();    
    	$data_provinsi = \App\Simonas_Provinsi::all();
    	$data_kabupaten = \App\Simonas_Kabupaten::all();

    	return view('listing.input',[
    		// 'listing' => $listing,
    		'kode_kegiatan' => '1',
    		'kode_provinsi' => '75',
    		'kode_kabupaten' => '02',
    		'data_dsbs' => $data_dsbs,
    		'data_listing' => $data_listing,
    		'data_kegiatan' => $data_kegiatan,
    		'data_provinsi' => $data_provinsi,
    		'data_kabupaten' => $data_kabupaten
    	]);

    }

    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 // dd($request);
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_listing',$nama_file);
 
		// import data
		// $import = new PetugasImport();
		// $import->public_path('/file_petugas/'.$nama_file);
		// $import->onlySheets('')
		if(Excel::import(new ListingImport, public_path('/file_listing/'.$nama_file))){
		// if($import->validate fails){
			if(Auth()->user()->role == 'admin'){
		    	$data_listing = \App\Simonas_Listing::where('kegiatan_id','=','1')
		    	->get();
		    	$data_dsbs = \App\Simonas_DSBS::where(
		    		'kegiatan_id','=','1')
		    	->get();
	    	}else{
	    		$data_listing = \App\Simonas_Listing::where('kegiatan_id','=','1')
	    		->where('pml_id','=',Auth()->user()->id)
	    		->get();
		    	$data_dsbs = \App\Simonas_Listing::where('kegiatan_id','=','1')
		    	->where('pml_id','=',Auth()->user()->id)
		    	->select('nks')
		    	->groupBy('nks')
		    	->get()
		    	->toArray();
		    }
	    	$data_kegiatan = \App\Simonas_Kegiatan::all();    
	    	$data_provinsi = \App\Simonas_Provinsi::all();
	    	$data_kabupaten = \App\Simonas_Kabupaten::all();
	    	// dd('tes');
			
			Alert::success('Berhasil','Data berhasil diimport');
			return view('listing.input',[
	    		// 'listing' => $listing,
	    		'kode_kegiatan' => '1',
	    		'kode_provinsi' => '75',
	    		'kode_kabupaten' => '02',
	    		'data_dsbs' => $data_dsbs,
	    		'data_listing' => $data_listing,
	    		'data_kegiatan' => $data_kegiatan,
	    		'data_provinsi' => $data_provinsi,
	    		'data_kabupaten' => $data_kabupaten
	    	]);
		}
		else
		{
    		Alert::error('Gagal', 'Terdapat eror');
		}
 
		// alihkan halaman kembali

	}

	public function progres()
	{
		if(Auth()->user()->role == 'admin'){

			$record = \App\Simonas_Listing::select(
				\DB::raw("COUNT(case when status = 'Selesai' then 1 end) as realisasi"), 
				'pml_id', 
				\DB::raw("COUNT(*) as target"))
				->where('kegiatan_id','=','1')	
		    	->groupBy('pml_id')
		    	->orderBy('realisasi')
		    	->get();

		    $realisasiToday = \App\Simonas_Listing::whereDate('updated_at', Carbon::today())
			    ->where('kegiatan_id','=','1')
			    ->where('status','=','Selesai')
			    ->count();
		}else{

			$record = \App\Simonas_Listing::select(
				\DB::raw("COUNT(case when status = 'Selesai' then 1 end) as realisasi"), 
				'pcl_id', 
				\DB::raw("COUNT(*) as target"))
				->where('kegiatan_id','=','1')
				->where('pml_id','=', Auth()->user()->id)	
		    	->groupBy('pcl_id')
		    	->orderBy('realisasi')
		    	->get();

		    $realisasiToday = \App\Simonas_Listing::whereDate('updated_at', Carbon::today())
			    ->where('kegiatan_id','=','1')
			    ->where('status','=','Selesai')
				->where('pml_id','=', Auth()->user()->id)	
			    ->count();
		}


	    $data = [];
	    $totalTarget = 0;
	    $totalRealisasi = 0;
	    $capaian = 0;
	    foreach($record as $row) {	    	
	    	$realisasi = (int) $row->realisasi;
	    	$target = (int) $row->target;

	    	if(Auth()->user()->role == 'admin'){
		        $data['label'][] = \App\User::findOrFail($row->pml_id)->nama;	    		
	    	}else{
	    		$data['label'][] = \App\User::findOrFail($row->pcl_id)->nama;
	    	}

	        $data['selesai'][] = $realisasi;
	        $data['belum'][] = $target - $realisasi;
	        $data['realisasi'][]= number_format(($realisasi/$target*100),2);
	        $totalTarget = $totalTarget + $target;
	        $totalRealisasi = $totalRealisasi + $realisasi;
	        $capaian = $totalRealisasi/$totalTarget*100;
	    }
	    $data['totalTarget'] = $totalTarget;
	    $data['totalRealisasi'] = $totalRealisasi;
	    $data['capaian'] = number_format($capaian,2);
	    $data['realisasiToday'] = $realisasiToday;

		// dd($data);
	    
	    $data['data_listing'] = json_encode($data);

		return view('listing.progres', $data)->with('data', $data);
	}
}
