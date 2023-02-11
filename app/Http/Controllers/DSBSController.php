<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Exports\DSBSExport;
use App\Imports\DSBSImport;
use Maatwebsite\Excel\Facades\Excel;

class DSBSController extends Controller
{
    public function index(){

    	$data_dsbs = \App\Simonas_DSBS::all();

    	$count = 0;
        if($data_dsbs->isEmpty()){
            $daftar_nama_provinsi[$count] = '';
            $daftar_nama_kabupaten[$count] = '';
            $daftar_nama_kecamatan[$count] = '';
            $daftar_nama_desa[$count] = '';
        }else{            
        	foreach ($data_dsbs as $dsbs) {    		
        		$daftar_nama_provinsi[$count] = $this->getNamaProvinsi($dsbs);
        		$daftar_nama_kabupaten[$count] = $this->getNamaKabuapten($dsbs);
        		$daftar_nama_kecamatan[$count] = $this->getNamaKecamatan($dsbs);
        		$daftar_nama_desa[$count] = $this->getNamaDesa($dsbs);
        		$count++; 
        	}
        }

    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}
    	return view('dsbs.index',[
    		'data_dsbs' => $data_dsbs,
    		'daftar_nama_provinsi' => $daftar_nama_provinsi,
    		'daftar_nama_kabupaten' => $daftar_nama_kabupaten,
    		'daftar_nama_kecamatan' => $daftar_nama_kecamatan,
    		'daftar_nama_desa' => $daftar_nama_desa
    	]);
    }

    public function tambah()
    {
    	$data_kegiatan = \App\Simonas_Kegiatan::all();
    	$data_provinsi = \App\Simonas_Provinsi::all();
    	$data_kabupaten = \App\Simonas_Kabupaten::all();
    	$data_kecamatan = \App\Simonas_Kecamatan::all();
    	$data_desa = \App\Simonas_Desa::all();

    	return view('dsbs.tambah',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_provinsi' => $data_provinsi,
    		'data_kabupaten' => $data_kabupaten,
    		'data_kecamatan' => $data_kecamatan,
    		'data_desa' => $data_desa,
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
    		'nbs'=> 'required|size:4',
    		'nks'=> 'required|unique:\App\Simonas_DSBS,nks|size:5'
    	]);
    	
    	if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

    		//insert ke tabel dsbs
    		try{
	    		$dsbs = new \App\Simonas_DSBS;
	    		$dsbs->kegiatan_id = $request->kegiatan;
	    		$dsbs->provinsi_id = $request->provinsi;
	    		$dsbs->kabupaten_id = $request->kabupaten;
	    		$dsbs->kecamatan_id = $request->kecamatan;
	    		$dsbs->desa_id = $request->desa;
	    		$dsbs->nbs = $request->nbs;
	    		$dsbs->nks = $request->nks;
	    		$dsbs->save();   		

    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}

	    	return redirect('dsbs')->withSuccessMessage('Sampel Blok Sensus berhasil ditambahkan');
    	}
    }

    public function edit($id)
    {
    	$data_kegiatan = \App\Simonas_Kegiatan::all();
    	$data_provinsi = \App\Simonas_Provinsi::all();
		
        $dsbs = \App\Simonas_DSBS::findOrFail($id);

    	$data_kabupaten = \App\Simonas_Kabupaten::where('provinsi_id','=',$dsbs->provinsi_id)
        ->get();
    	
        $data_kecamatan = \App\Simonas_Kecamatan::where('provinsi_id','=',$dsbs->provinsi_id)
        ->where('kabupaten_id','=',$dsbs->kabupaten_id)
        ->get();

        $data_desa = \App\Simonas_Desa::where('provinsi_id','=',$dsbs->provinsi_id)
        ->where('kabupaten_id','=',$dsbs->kabupaten_id)
        ->where('kecamatan_id','=',$dsbs->kecamatan_id)
        ->get();

		return view('dsbs.edit',[
			'data_kegiatan' => $data_kegiatan,
    		'data_provinsi' => $data_provinsi,
    		'data_kabupaten' => $data_kabupaten,
    		'data_kecamatan' => $data_kecamatan,
    		'data_desa' => $data_desa,    		
    		'dsbs' => $dsbs
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
    		'nbs'=> 'required|size:4',
    		'nks'=> 'required|size:5'
    	]);

    	if($validator->fails()){
    		// foreach ($validator->messages()->getMessages() as $field_name => $messages)
		    // {
		    //     var_dump($messages); // messages are retrieved (publicly)
		    // }
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

	    	//update dsbs
	    	$dsbs = \App\Simonas_DSBS::findOrFail($id);
	    	$dsbs->kegiatan_id = $request->kegiatan;
    		$dsbs->provinsi_id = $request->provinsi;
    		$dsbs->kabupaten_id = $request->kabupaten;
    		$dsbs->kecamatan_id = $request->kecamatan;
    		$dsbs->desa_id = $request->desa;
    		$dsbs->nbs = $request->nbs;
    		$dsbs->nks = $request->nks;
    		$dsbs->save(); 

			return redirect('dsbs')->withSuccessMessage('Sampel Blok Sensus berhasil diubah');
		}
	}

	public function lihat($id)
    {
    	$data_kegiatan = \App\Simonas_Kegiatan::all();
    	$data_provinsi = \App\Simonas_Provinsi::all();

		$dsbs = \App\Simonas_DSBS::findOrFail($id);
    	        
        $data_kabupaten = \App\Simonas_Kabupaten::where('provinsi_id','=',$dsbs->provinsi_id)
        ->get();
        
        $data_kecamatan = \App\Simonas_Kecamatan::where('provinsi_id','=',$dsbs->provinsi_id)
        ->where('kabupaten_id','=',$dsbs->kabupaten_id)
        ->get();

        $data_desa = \App\Simonas_Desa::where('provinsi_id','=',$dsbs->provinsi_id)
        ->where('kabupaten_id','=',$dsbs->kabupaten_id)
        ->where('kecamatan_id','=',$dsbs->kecamatan_id)
        ->get();

		return view('dsbs.lihat',[
			'data_kegiatan' => $data_kegiatan,
    		'data_provinsi' => $data_provinsi,
    		'data_kabupaten' => $data_kabupaten,
    		'data_kecamatan' => $data_kecamatan,
    		'data_desa' => $data_desa,    		
    		'dsbs' => $dsbs
    	]);
    }

    public function delete($id)
	{
		//delete dsbs
    	$dsbs = \App\Simonas_DSBS::findOrFail($id);
    	$dsbs->delete($dsbs);

		return redirect('dsbs')->withSuccessMessage('Sampel Blok Sensus berhasil dihapus');
	}

	public function konfirmasi($id)
	{
		alert()->question('Peringatan !','Anda yakin akan menghapus data ?')
		->showConfirmButton('<a href="/dsbs/'.$id.'/delete" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
		->showCancelButton('Batal', '#aaa')->reverseButtons();

		return redirect('dsbs');
	}

	public function export_excel()
	{

		return Excel::download(new DSBSExport, 'dsbs.xls', \Maatwebsite\Excel\Excel::XLS);
	
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
		$file->move('file_dsbs',$nama_file);
 
		// import data
		// $import = new PetugasImport();
		// $import->public_path('/file_petugas/'.$nama_file);
		// $import->onlySheets('')
		if(Excel::import(new DSBSImport, public_path('/file_dsbs/'.$nama_file))){
		// if($import->validate fails){
			return redirect('dsbs')->withSuccessMessage('Data berhasil diimport');
		}
		else
		{

    		Alert::error('Gagal', 'Terdapat eror');
		}
 
		// alihkan halaman kembali

	}

	public function getNamaProvinsi($dsbs)
	{
		$nama_provinsi = \App\Simonas_Provinsi::where('kode',$dsbs->provinsi_id)->value('provinsi');
		return $nama_provinsi;
	}

	public function getNamaKabuapten($dsbs)
	{
		$nama_kabupaten = \App\Simonas_Kabupaten::where([
        	['provinsi_id','=',$dsbs->provinsi_id],
        	['kode','=',$dsbs->kabupaten_id],
        	])->value('kabupaten');
		return $nama_kabupaten;
	}

	public function getNamaKecamatan($dsbs)
	{
		$nama_kecamatan = \App\Simonas_Kecamatan::where([
        	['provinsi_id','=',$dsbs->provinsi_id],
        	['kabupaten_id','=',$dsbs->kabupaten_id],
        	['kode','=',$dsbs->kecamatan_id],
        	])->value('kecamatan');
		return $nama_kecamatan;
	}

	public function getNamaDesa($dsbs)
	{
		$nama_desa = \App\Simonas_Desa::where([
        	['provinsi_id','=',$dsbs->provinsi_id],
        	['kabupaten_id','=',$dsbs->kabupaten_id],
        	['kecamatan_id','=',$dsbs->kecamatan_id],
        	['kode','=',$dsbs->desa_id]
        	])->value('desa');
		return $nama_desa;
	}
}
