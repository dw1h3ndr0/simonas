<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Imports\DokumenImport;
use Maatwebsite\Excel\Facades\Excel;

class DokumenController extends Controller
{
    public function index()
    {    	
    	if(Auth()->user()->role == 'admin'){
	    	$data_dokumen = \App\Simonas_Dokumen::all();
	    	$data_dsbs = \App\Simonas_DSBS::all();
    	}else{
    		$data_dokumen = \App\Simonas_Dokumen::where(
	    		'pml_id','=',Auth()->user()->id
	    	)->get();
	    	$data_dsbs = \App\Simonas_Dokumen::where(
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
    	
    	return view('dokumen.index',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_dsbs' => $data_dsbs,
    		'data_dokumen' => $data_dokumen,
    		'kode_kegiatan' => '1',
    		'kode_nks' => '00'
    	]);
    }

    public function refresh($kode_kegiatan, $kode_nks)
    {    	    	
    	if($kode_nks == '00'){
    		if(Auth()->user()->role == 'admin'){
		    	$data_dokumen = \App\Simonas_Dokumen::where(
		    		'kegiatan_id','=',$kode_kegiatan
		    	)->get();
		    	$data_dsbs = \App\Simonas_DSBS::where(
		    		'kegiatan_id','=',$kode_kegiatan
		    	)->get();
	    	}else{
	    		$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=',$kode_kegiatan)
	    		->where('pml_id','=',Auth()->user()->id
		    	)->get();
		    	$data_dsbs = \App\Simonas_Dokumen::where('kegiatan_id','=',$kode_kegiatan)
		    	->where('pml_id','=',Auth()->user()->id)
		    	->select('nks')
		    	->groupBy('nks')
		    	->get()
		    	->toArray();
	    	}    		
    	}else{  	
    		if(Auth()->user()->role == 'admin'){
		    	$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=',$kode_kegiatan)
		    	->where('nks','=',$kode_nks)
		    	->get();
		    	$data_dsbs = \App\Simonas_DSBS::where(
		    		'kegiatan_id','=',$kode_kegiatan
		    	)->get();
	    	}else{
	    		$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=',$kode_kegiatan)
	    		->where('pml_id','=',Auth()->user()->id)
	    		->where('nks','=',$kode_nks)
	    		->get();
		    	$data_dsbs = \App\Simonas_Dokumen::where('kegiatan_id','=',$kode_kegiatan)
		    	->where('pml_id','=',Auth()->user()->id)
		    	->select('nks')
		    	->groupBy('nks')
		    	->get()
		    	->toArray();
		    }		    	
    	}

    	$data_kegiatan = \App\Simonas_Kegiatan::all();    
    	
    	// dd($data_dokumen);
    	return view('dokumen.index',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_dsbs' => $data_dsbs,
    		'data_dokumen' => $data_dokumen,
    		'kode_kegiatan' => $kode_kegiatan,
    		'kode_nks' => $kode_nks
    	]);
    }

    public function edit($kode_kegiatan, $kode_nks, $kode_nus, $page)
    {
    	// $dokumen = \App\Simonas_Dokumen::findOrFail($id);
    	$dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=',$kode_kegiatan)
    	->where('nks','=',$kode_nks)
    	->where('nus','=',$kode_nus)
    	->first();

    	$user_dsbs = \App\Simonas_User_DSBS::findOrFail($dokumen->user_dsbs_id);
    	$dsbs = \App\Simonas_DSBS::findOrFail($user_dsbs->dsbs_id);

    	if(Auth()->user()->role == 'admin'){
		    	$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=',$kode_kegiatan)
		    	->where('nks','=',$kode_nks)
		    	->get();
		    	$data_dsbs = \App\Simonas_DSBS::where(
		    		'kegiatan_id','=',$kode_kegiatan)
		    	->get();
	    	}else{
	    		$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=',$kode_kegiatan)
	    		->where('pml_id','=',Auth()->user()->id)
	    		->where('nks','=',$kode_nks)
	    		->get();
		    	$data_dsbs = \App\Simonas_Dokumen::where('kegiatan_id','=',$kode_kegiatan)
		    	->where('pml_id','=',Auth()->user()->id)
		    	->select('nks')
		    	->groupBy('nks')
		    	->get()
		    	->toArray();
		    }
    	// dd($data_dsbs);

    	$data_kegiatan = \App\Simonas_Kegiatan::all();    
    	$data_provinsi = \App\Simonas_Provinsi::all();
    	$data_kabupaten = \App\Simonas_Kabupaten::all();

    	return view('dokumen.edit',[
    		'dokumen' => $dokumen,
    		'kode_provinsi' => $dsbs->provinsi_id,
    		'kode_kabupaten' => $dsbs->kabupaten_id,
    		'data_dsbs' => $data_dsbs,
    		'data_dokumen' => $data_dokumen,
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
    		'nus'=> 'required',
    		'p1' => 'required|numeric',
    		'p2' => 'required|numeric',
    		'p3' => 'required|numeric',
    		'status' => 'required',
    	]);
    	
    	if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

    		//insert ke tabel dokumen
    		try{
    			if(\App\Simonas_Dokumen::where([
	    		  		['kegiatan_id',$request->kegiatan],
		                ['nks',$request->nks],
		                ['nus',$request->nus],
		                ['status',NULL]
		            ])->exists()){

    				DB::table('simonas_dokumen')
		    		  	->where('kegiatan_id', '=', $request->kegiatan)
		    		  	->where('nks', '=', $request->nks)
		    		  	->where('nus','=', $request->nus)
		    		  	->update([
		    		  		'p1' =>  $request->p1,
		    		  		'p2' =>  $request->p2,
		    		  		'p3' =>  $request->p3,
		    		  		'status' => $request->status,
			                'created_at' => Carbon::now(),
			                'updated_at' => Carbon::now()
		    		  	]);	
    			}else{    				
		    		DB::table('simonas_dokumen')
		    		  	->where('kegiatan_id', '=', $request->kegiatan)
		    		  	->where('nks', '=', $request->nks)
		    		  	->where('nus','=', $request->nus)
		    		  	->update([
		    		  		'p1' =>  $request->p1,
		    		  		'p2' =>  $request->p2,
		    		  		'p3' =>  $request->p3,
		    		  		'status' => $request->status,
			                'updated_at' => Carbon::now()
		    		  	]);	   		
    			}
    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}

    		if(Auth()->user()->role == 'admin'){
		    	$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=',$request->kegiatan)
		    	->where('nks','=',$request->nks)
		    	->get();
		    	$data_dsbs = \App\Simonas_DSBS::where(
		    		'kegiatan_id','=',$request->kegiatan)
		    	->get();
	    	}else{
	    		$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=',$request->kegiatan)
	    		->where('pml_id','=',Auth()->user()->id)
	    		->where('nks','=',$request->nks)
	    		->get();
		    	$data_dsbs = \App\Simonas_Dokumen::where('kegiatan_id','=',$request->kegiatan)
		    	->where('pml_id','=',Auth()->user()->id)
		    	->select('nks')
		    	->groupBy('nks')
		    	->get()
		    	->toArray();
		    }

		    $data_kegiatan = \App\Simonas_Kegiatan::all();

    		//jika dari halaman index kembali ke halaman index
	    	if($page == 'index'){
	    		
		    	Alert::success('Berhasil', 'Data pemasukan dokumen berhasil diinput');
		    	return view('dokumen.index',[
		    		'data_kegiatan' => $data_kegiatan,
		    		'data_dsbs' => $data_dsbs,
		    		'data_dokumen' => $data_dokumen,
		    		'kode_kegiatan' => $request->kegiatan,
		    		'kode_nks' => $request->nks
		    	]);
	    	}else //jika dari halaman input kembali ke halaman edit
	    	{

	    		$dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=',$request->kegiatan)
		    	->where('nks','=',$request->nks)
		    	->where('nus','=',$request->nus)
		    	->first();
		    	// dd($dokumen);

		    	$user_dsbs = \App\Simonas_User_DSBS::findOrFail($dokumen->user_dsbs_id);
		    	$dsbs = \App\Simonas_DSBS::findOrFail($user_dsbs->dsbs_id);

		    	$data_provinsi = \App\Simonas_Provinsi::all();
		    	$data_kabupaten = \App\Simonas_Kabupaten::all();

		    	Alert::success('Berhasil', 'Data pemasukan dokumen berhasil diinput');
	    		return view('dokumen.input',[
		    		// 'dokumen' => $dokumen,
		    		'kode_kegiatan' => '1',
		    		'kode_provinsi' => $dsbs->provinsi_id,
		    		'kode_kabupaten' => $dsbs->kabupaten_id,
		    		'data_dsbs' => $data_dsbs,
		    		'data_dokumen' => $data_dokumen,
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
	    	$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=','1')
	    	->get();
	    	$data_dsbs = \App\Simonas_DSBS::where(
	    		'kegiatan_id','=','1')
	    	->get()
	    	->toArray();
    	}else{
    		$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=','1')
    		->where('pml_id','=',Auth()->user()->id)
    		->get();
	    	$data_dsbs = \App\Simonas_Dokumen::where('kegiatan_id','=','1')
	    	->where('pml_id','=',Auth()->user()->id)
	    	->select('nks')
	    	->groupBy('nks')
	    	->get()
	    	->toArray();
	    }

    	// $dokumen = \App\Simonas_Dokumen::findOrFail($id);
    	// $user_dsbs = \App\Simonas_User_DSBS::where('kegiatan_id','=','1')
    	// ->where('user_id','=',Auth()->user()->id)
    	// ->first();
    	// $dsbs = \App\Simonas_DSBS::findOrFail($user_dsbs->dsbs_id);

    	// $data_dsbs = \App\Simonas_DSBS::all();
    	// $data_dokumen = \App\Simonas_Dokumen::all();
    	$data_kegiatan = \App\Simonas_Kegiatan::all();    
    	$data_provinsi = \App\Simonas_Provinsi::all();
    	$data_kabupaten = \App\Simonas_Kabupaten::all();

    	return view('dokumen.input',[
    		// 'dokumen' => $dokumen,
    		'kode_kegiatan' => '1',
    		'kode_provinsi' => '75',
    		'kode_kabupaten' => '02',
    		'data_dsbs' => $data_dsbs,
    		'data_dokumen' => $data_dokumen,
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
		$file->move('file_dokumen',$nama_file);
 
		// import data
		// $import = new PetugasImport();
		// $import->public_path('/file_petugas/'.$nama_file);
		// $import->onlySheets('')
		if(Excel::import(new DokumenImport, public_path('/file_dokumen/'.$nama_file))){
		// if($import->validate fails){
			if(Auth()->user()->role == 'admin'){
		    	$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=','1')
		    	->get();
		    	$data_dsbs = \App\Simonas_DSBS::where(
		    		'kegiatan_id','=','1')
		    	->get();
	    	}else{
	    		$data_dokumen = \App\Simonas_Dokumen::where('kegiatan_id','=','1')
	    		->where('pml_id','=',Auth()->user()->id)
	    		->get();
		    	$data_dsbs = \App\Simonas_Dokumen::where('kegiatan_id','=','1')
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
			return view('dokumen.input',[
	    		// 'dokumen' => $dokumen,
	    		'kode_kegiatan' => '1',
	    		'kode_provinsi' => '75',
	    		'kode_kabupaten' => '02',
	    		'data_dsbs' => $data_dsbs,
	    		'data_dokumen' => $data_dokumen,
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

			$record = \App\Simonas_Dokumen::select(
				\DB::raw("COUNT(case when status = 'Selesai' then 1 end) as realisasi"), 
				'pml_id', 
				\DB::raw("COUNT(*) as target"))
				->where('kegiatan_id','=','1')	
		    	->groupBy('pml_id')
		    	->orderBy('realisasi')
		    	->get();

		    $realisasiToday = \App\Simonas_Dokumen::whereDate('updated_at', Carbon::today())
			    ->where('kegiatan_id','=','1')
			    ->where('status','=','Selesai')
			    ->count();
		}else{

			$record = \App\Simonas_Dokumen::select(
				\DB::raw("COUNT(case when status = 'Selesai' then 1 end) as realisasi"), 
				'pcl_id', 
				\DB::raw("COUNT(*) as target"))
				->where('kegiatan_id','=','1')
				->where('pml_id','=', Auth()->user()->id)	
		    	->groupBy('pcl_id')
		    	->orderBy('realisasi')
		    	->get();

		    $realisasiToday = \App\Simonas_Dokumen::whereDate('updated_at', Carbon::today())
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
	    
	    $data['data_dokumen'] = json_encode($data);

		return view('dokumen.progres', $data)->with('data', $data);
	}
}
