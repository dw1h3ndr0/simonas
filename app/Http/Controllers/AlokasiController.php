<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Simonas_User_DSBS;
use App\Simonas_Sampel;
use App\Simonas_Dokumen;
use App\Simonas_Listing;
use Illuminate\Support\Facades\DB;

use App\Exports\UserDSBSExport;
use App\Exports\DaftarPetugasExport;
use App\Imports\UserDSBSImport;
use Maatwebsite\Excel\Facades\Excel;

class AlokasiController extends Controller
{
    public function index()
    {
    	$data_alokasi = \App\Simonas_User_DSBS::all();

    	$data_alokasi = DB::table('simonas_user_dsbs')
            ->leftJoin('users as petugas', 'simonas_user_dsbs.user_id', '=', 'petugas.id')
            ->leftJoin('users as leader', 'simonas_user_dsbs.leader', '=', 'leader.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->leftJoin('simonas_kegiatan','simonas_user_dsbs.kegiatan_id','=','simonas_kegiatan.id')
            ->select('simonas_user_dsbs.*', 'petugas.nama as namaPetugas', 'petugas.jabatan as jabatan', 'leader.nama as namaLeader', 'simonas_dsbs.nks','simonas_kegiatan.nama_keg','simonas_kegiatan.periode','simonas_kegiatan.tahun') 
            // ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();

    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}
    	// dd($data_alokasi);
    	return view('alokasi.index',[
    		'data_alokasi' => $data_alokasi]);
    }

    public function tambah()
    {
    	$data_kegiatan = \App\Simonas_Kegiatan::all();
    	$data_provinsi = \App\Simonas_Provinsi::all();
    	$data_kabupaten = \App\Simonas_Kabupaten::all();
    	$data_kecamatan = \App\Simonas_Kecamatan::all();
    	$data_desa = \App\Simonas_Desa::all();

    	$data_petugas = \App\User::all();
    	$data_dsbs = \App\Simonas_DSBS::all();

    	return view('alokasi.tambah',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_provinsi' => $data_provinsi,
    		'data_kabupaten' => $data_kabupaten,
    		'data_kecamatan' => $data_kecamatan,
    		'data_desa' => $data_desa,
    		'data_petugas' => $data_petugas,
    		'data_dsbs' => $data_dsbs
    	]);
    }

    public function create(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    		'kegiatan' => 'required',
    		'provinsi' => 'required',
    		'kabupaten' => 'required',
    		'kecamatan' => 'required',
    		'desa' => 'required',
    		'nks'=> 'required',
    		'nama_petugas'=> 'required',
    		'status' => 'required',
    		'kode' => 'required',
    		// 'nama_atasan' => 'required',
    		// 'kode_pml' => 'required'
    	]);
    	
    	if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

    		//insert ke tabel user_dsbs
    		try{
    			$dsbs = \App\Simonas_DSBS::where('nks',$request->nks)->first();

	    		if($request->status == "PCL"){

		    		$user_dsbs = new \App\Simonas_User_DSBS;
		    		$user_dsbs->user_id = $request->nama_petugas;
		    		$user_dsbs->dsbs_id = $dsbs->id;
		    		$user_dsbs->kegiatan_id = $dsbs->kegiatan_id;
		    		$user_dsbs->status = $request->status;
		    		$user_dsbs->leader = $request->nama_atasan;
		    		$user_dsbs->kode = $request->kode;

		    		$user_dsbs->save(); 

	    			//insert ke tabel simonas_sampel
		    		for ($i=0; $i < 10; $i++) { 
		    		  	$sampel = new \App\Simonas_Sampel;
		    		  	$sampel->user_dsbs_id = $user_dsbs->id;
		    		  	$sampel->kegiatan_id = $user_dsbs->kegiatan_id;
		    		  	$sampel->pml_id = $user_dsbs->leader;
		    		  	$sampel->pcl_id = $user_dsbs->user_id;
		    		  	$sampel->nks = $request->nks;
		    		  	$sampel->nus = strval($i+1);
		    		  	$sampel->save();
		    		}  		

	    			//insert ke tabel simonas_dokumen
		    		for ($i=0; $i < 10; $i++) { 
		    		  	$dokumen = new \App\Simonas_Dokumen;
		    		  	$dokumen->user_dsbs_id = $user_dsbs->id;
		    		  	$dokumen->kegiatan_id = $user_dsbs->kegiatan_id;
		    		  	$dokumen->pml_id = $user_dsbs->leader;
		    		  	$dokumen->pcl_id = $user_dsbs->user_id;
		    		  	$dokumen->nks = $request->nks;
		    		  	$dokumen->nus = strval($i+1);
		    		  	$dokumen->save();
		    		}  		

	    			//insert ke tabel simonas_listing
	    		  	$listing = new \App\Simonas_Listing;
	    		  	$listing->user_dsbs_id = $user_dsbs->id;
	    		  	$listing->kegiatan_id = $user_dsbs->kegiatan_id;
	    		  	$listing->pml_id = $user_dsbs->leader;
	    		  	$listing->pcl_id = $user_dsbs->user_id;
	    		  	$listing->nks = $request->nks;
	    		  	$listing->save();

	    		  // 	if(Simonas_User_DSBS::where([
	    		  // 		['kegiatan_id',$request->kegiatan_id],
		       //          ['user_id',$request->nama_atasan],
		       //          ['dsbs_id',$dsbs->id],
		       //          ['status','PML']
		       //      ])->exists()){

		       //      }else{
		       //          $user_dsbs = new \App\Simonas_User_DSBS;
			    		// $user_dsbs->user_id = $request->nama_atasan;
			    		// $user_dsbs->dsbs_id = $dsbs->id;
			    		// $user_dsbs->kegiatan_id = $dsbs->kegiatan_id;
			    		// $user_dsbs->status = 'PML';
			    		// $user_dsbs->kode = $request->kode_pml;

			    		// $user_dsbs->save();               
		       //      }
  		
	    		}elseif($request->status == "PML"){
	    			if(Simonas_User_DSBS::where([
	    		  		['kegiatan_id',$request->kegiatan_id],
		                ['user_id',$request->nama_petugas],
		                ['dsbs_id',$dsbs->id],
		                ['status','PML']
		            ])->exists()){

		            }else{
	    			// dd('tes');
		                $user_dsbs = new \App\Simonas_User_DSBS;
			    		$user_dsbs->user_id = $request->nama_petugas ;
			    		$user_dsbs->dsbs_id = $dsbs->id;
			    		$user_dsbs->kegiatan_id = $dsbs->kegiatan_id;
			    		$user_dsbs->status = $request->status;
			    		$user_dsbs->kode = $request->kode;

			    		$user_dsbs->save();                 
		            }
	    		}
	    		// dd($user_dsbs);

    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}

	    	return redirect('alokasi')->withSuccessMessage('Sampel Blok Sensus berhasil ditambahkan');
    	}
    }

    public function edit($id)
    {
    	
    	$data_kegiatan = \App\Simonas_Kegiatan::all();
    	$data_provinsi = \App\Simonas_Provinsi::all();

    	$data_petugas = \App\User::all();
    	$data_dsbs = \App\Simonas_DSBS::all();

		$alokasi = \App\Simonas_User_DSBS::findOrFail($id);

		$dsbs = \App\Simonas_DSBS::findOrFail($alokasi->dsbs_id);

		$data_kabupaten = \App\Simonas_Kabupaten::where('provinsi_id','=',$dsbs->provinsi_id)
        ->get();
    	
        $data_kecamatan = \App\Simonas_Kecamatan::where('provinsi_id','=',$dsbs->provinsi_id)
        ->where('kabupaten_id','=',$dsbs->kabupaten_id)
        ->get();

        $data_desa = \App\Simonas_Desa::where('provinsi_id','=',$dsbs->provinsi_id)
        ->where('kabupaten_id','=',$dsbs->kabupaten_id)
        ->where('kecamatan_id','=',$dsbs->kecamatan_id)
        ->get();

		$leader = true;

		if($alokasi->leader == NULL){
			$leader = false;
		}

    	return view('alokasi.edit',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_provinsi' => $data_provinsi,
    		'data_kabupaten' => $data_kabupaten,
    		'data_kecamatan' => $data_kecamatan,
    		'data_desa' => $data_desa,
    		'data_petugas' => $data_petugas,
    		'data_dsbs' => $data_dsbs,
    		'alokasi' => $alokasi,
    		'leader' => $leader
    	]);
    }

    public function update(Request $request, $id)
    {
    	$validator = Validator::make($request->all(),[
    		'kegiatan' => 'required',
    		'provinsi' => 'required',
    		'kabupaten' => 'required',
    		'kecamatan' => 'required',
    		'desa' => 'required',
    		'nks'=> 'required',
    		'nama_petugas'=> 'required',
    		'status' => 'required',
    		'kode' => 'required',
    		// 'nama_atasan' => 'required',
    		// 'kode_pml' => 'required'
    	]);
    	
    	if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

    		//update user_dsbs
    		try{
    			$dsbs = \App\Simonas_DSBS::where('nks',$request->nks)->first();

	    		$user_dsbs = \App\Simonas_User_DSBS::findOrFail($id);
	    		$user_dsbs->user_id = $request->nama_petugas;
	    		$user_dsbs->dsbs_id = $dsbs->id;
	    		$user_dsbs->kegiatan_id = $dsbs->kegiatan_id;
	    		$user_dsbs->status = $request->status;
	    		$user_dsbs->leader = $request->nama_atasan;
	    		$user_dsbs->kode = $request->kode;

	    		$user_dsbs->save(); 

	    		if($request->status == "PCL"){

	    			if (Simonas_Sampel::where('user_dsbs_id', '=', $user_dsbs->id)->exists()) {
					   					
		    			//update or insert simonas_sampel
			    		for ($i=0; $i < 10; $i++) { 
			    		  	DB::table('simonas_sampel')
			    		  	->where('user_dsbs_id', '=', $user_dsbs->id)
			    		  	->where('nus', '=', strval($i+1))
			    		  	->update([
			    		  		'user_dsbs_id' => $user_dsbs->id,
			    		  		'kegiatan_id' => $user_dsbs->kegiatan_id,
			    		  		'pml_id' => $user_dsbs->leader,
			    		  		'pcl_id' => $user_dsbs->user_id,
			    		  		'nks' => $request->nks
			    		  	]);			    		  	
			    		}  		

		    			//update or insert simonas_dokumen
			    		for ($i=0; $i < 10; $i++) { 
			    		  	DB::table('simonas_dokumen')
			    		  	->where('user_dsbs_id', '=', $user_dsbs->id)
			    		  	->where('nus', '=', strval($i+1))
			    		  	->update([
			    		  		'user_dsbs_id' => $user_dsbs->id,
			    		  		'kegiatan_id' => $user_dsbs->kegiatan_id,
			    		  		'pml_id' => $user_dsbs->leader,
			    		  		'pcl_id' => $user_dsbs->user_id,
			    		  		'nks' => $request->nks
			    		  	]);	
			    		}  		

		    			//update or insert simonas_listing
		    		  	DB::table('simonas_listing')
			    		  	->where('user_dsbs_id', '=', $user_dsbs->id)
			    		  	->update([
			    		  		'user_dsbs_id' => $user_dsbs->id,
			    		  		'kegiatan_id' => $user_dsbs->kegiatan_id,
			    		  		'pml_id' => $user_dsbs->leader,
			    		  		'pcl_id' => $user_dsbs->user_id,
			    		  		'nks' => $request->nks
			    		  	]);	
	  					
  					}else{
  						//insert ke tabel simonas_sampel
			    		for ($i=0; $i < 10; $i++) { 
			    		  	$sampel = new \App\Simonas_Sampel;
			    		  	$sampel->user_dsbs_id = $user_dsbs->id;
			    		  	$sampel->kegiatan_id = $user_dsbs->kegiatan_id;
			    		  	$sampel->pml_id = $user_dsbs->leader;
			    		  	$sampel->pcl_id = $user_dsbs->user_id;
			    		  	$sampel->nks = $request->nks;
			    		  	$sampel->nus = strval($i+1);
			    		  	$sampel->save();
			    		}  		

		    			//insert ke tabel simonas_dokumen
			    		for ($i=0; $i < 10; $i++) { 
			    		  	$dokumen = new \App\Simonas_Dokumen;
			    		  	$dokumen->user_dsbs_id = $user_dsbs->id;
			    		  	$dokumen->kegiatan_id = $user_dsbs->kegiatan_id;
			    		  	$dokumen->pml_id = $user_dsbs->leader;
			    		  	$dokumen->pcl_id = $user_dsbs->user_id;
			    		  	$dokumen->nks = $request->nks;
			    		  	$dokumen->nus = strval($i+1);
			    		  	$dokumen->save();
			    		}  		

		    			//insert ke tabel simonas_listing
		    		  	$listing = new \App\Simonas_Listing;
		    		  	$listing->user_dsbs_id = $user_dsbs->id;
		    		  	$listing->kegiatan_id = $user_dsbs->kegiatan_id;
		    		  	$listing->pml_id = $user_dsbs->leader;
		    		  	$listing->pcl_id = $user_dsbs->user_id;
		    		  	$listing->nks = $request->nks;
		    		  	$listing->save();
  					}

	    		} elseif ($request->status == "PML") {
	    			if (Simonas_Sampel::where('user_dsbs_id', '=', $user_dsbs->id)->exists()) {
	    				DB::table('simonas_sampel')
			    		  	->where('user_dsbs_id', '=', $user_dsbs->id)
			    		  	->delete();
			    		DB::table('simonas_dokumen')
			    		  	->where('user_dsbs_id', '=', $user_dsbs->id)
			    		  	->delete();

			    		DB::table('simonas_listing')
			    		  	->where('user_dsbs_id', '=', $user_dsbs->id)
			    		  	->delete();
	    			}
	    		}
	    		// dd($user_dsbs);

    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}

	    	return redirect('alokasi')->withSuccessMessage('Sampel Blok Sensus berhasil diubah');
    	}
    }

    public function lihat($id)
    {
    	
    	$data_kegiatan = \App\Simonas_Kegiatan::all();
    	$data_provinsi = \App\Simonas_Provinsi::all();

    	$data_petugas = \App\User::all();
    	$data_dsbs = \App\Simonas_DSBS::all();

		$alokasi = \App\Simonas_User_DSBS::findOrFail($id);

		$dsbs = \App\Simonas_DSBS::findOrFail($alokasi->dsbs_id);

		$data_kabupaten = \App\Simonas_Kabupaten::where('provinsi_id','=',$dsbs->provinsi_id)
        ->get();
    	
        $data_kecamatan = \App\Simonas_Kecamatan::where('provinsi_id','=',$dsbs->provinsi_id)
        ->where('kabupaten_id','=',$dsbs->kabupaten_id)
        ->get();

        $data_desa = \App\Simonas_Desa::where('provinsi_id','=',$dsbs->provinsi_id)
        ->where('kabupaten_id','=',$dsbs->kabupaten_id)
        ->where('kecamatan_id','=',$dsbs->kecamatan_id)
        ->get();

		$leader = true;

		if($alokasi->leader == NULL){
			$leader = false;
		}

    	return view('alokasi.lihat',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_provinsi' => $data_provinsi,
    		'data_kabupaten' => $data_kabupaten,
    		'data_kecamatan' => $data_kecamatan,
    		'data_desa' => $data_desa,
    		'data_petugas' => $data_petugas,
    		'data_dsbs' => $data_dsbs,
    		'alokasi' => $alokasi,
    		'leader' => $leader
    	]);
    }

    public function delete($id)
	{
		//delete user_dsbs
    	$user_dsbs = \App\Simonas_User_DSBS::findOrFail($id);

    	DB::table('simonas_sampel')
		  	->where('user_dsbs_id', '=', $user_dsbs->id)
		  	->delete();

		DB::table('simonas_dokumen')
		  	->where('user_dsbs_id', '=', $user_dsbs->id)
		  	->delete();

		DB::table('simonas_listing')
		  	->where('user_dsbs_id', '=', $user_dsbs->id)
		  	->delete();
    	
    	$user_dsbs->delete($user_dsbs);

		return redirect('alokasi')->withSuccessMessage('Alokasi Petugas berhasil dihapus');
	}

	public function konfirmasi($id)
	{
		alert()->question('Peringatan !','Anda yakin akan menghapus data ?')
		->showConfirmButton('<a href="/alokasi/'.$id.'/delete" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
		->showCancelButton('Batal', '#aaa')->reverseButtons();

		return redirect('alokasi');
	}

	public function export_excel()
	{

		return Excel::download(new UserDSBSExport, 'alokasi.xls', \Maatwebsite\Excel\Excel::XLS);
	
	}

	public function export_petugas()
	{

		return Excel::download(new DaftarPetugasExport, 'daftar_petugas.xls', \Maatwebsite\Excel\Excel::XLS);
	
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
		$file->move('file_alokasi',$nama_file);
 
		// import data
		// $import = new PetugasImport();
		// $import->public_path('/file_petugas/'.$nama_file);
		// $import->onlySheets('')
		if(Excel::import(new UserDSBSImport, public_path('/file_alokasi/'.$nama_file))){
		// if($import->validate fails){
			return redirect('alokasi')->withSuccessMessage('Data berhasil diimport');
		}
		else
		{

    		Alert::error('Gagal', 'Terdapat eror');
		}
 
		// alihkan halaman kembali

	}
}
