<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Simonas_Supervisor;
use App\Simonas_Petugas;
use App\Simonas_User_Kegiatan;
use App\Simonas_Petugas_Kegiatan;

use App\Exports\PetugasExport;
use App\Imports\PetugasImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class PetugasController extends Controller
{
    public function index()
    {
    	
    	$data_user = \App\User::all();

    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}
    	// dd($data_user);
    	return view('petugas.index',[
    		'data_petugas' => $data_user]);
    }

    public function tambah(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    		'add_role' => 'required',
    		'add_nama' => 'required|min:3|max:50',
    		'add_jabatan' => 'required',
    		'add_no_hp'=> 'required|numeric',
    		'add_email' => 'required|unique:\App\User,email|email|regex:/^.+@.+$/i'
    	]);

    	// dd($request);

    	if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

    		//insert ke tabel users
    		try{
	    		$user = new \App\User;
	    		$user->role = $request->add_role;	
	    		$user->nama = $request->add_nama;
	    		$user->jabatan = $request->add_jabatan;
	    		$user->no_hp = $request->add_no_hp;
	    		$user->email = $request->add_email;
	    		$user->password = Hash::make('12345678');
	    		$user->remember_token = Str::random(60);
	    		$user->save();   		
    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}

	    	return redirect('petugas')->withSuccessMessage('Petugas berhasil ditambahkan');  		
    	}

    }

    public function edit(Request $request)
    {

		$data = \App\User::findOrFail($request->get('id'));
		echo json_encode($data);
    }

    public function update(Request $request)
    {    	
    	$validator = Validator::make($request->all(),[
    		'role' => 'required',
    		'nama' => 'required|min:3|max:50',
    		'jabatan' => 'required',
    		'no_hp'=> 'required|numeric',
    		'email' => 'required|email|regex:/^.+@.+$/i'
    	]);

    	if($validator->fails()){
    		// foreach ($validator->messages()->getMessages() as $field_name => $messages)
		    // {
		    //     var_dump($messages); // messages are retrieved (publicly)
		    // }
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

	    	//update user
	    	$user = \App\User::findOrFail($request->post('id'));
	    	$user->role = $request->role;
	    	$user->nama = $request->nama;
	    	$user->jabatan = $request->jabatan;
	    	$user->no_hp =$request->no_hp;
	        $user->email = $request->email;
	        // $user->password = Hash::make('12345678');
    		// $user->remember_token = Str::random(60);
    		$user->save(); 

			return redirect('petugas')->withSuccessMessage('Data Petugas berhasil diubah');
		}
	}

	public function delete($id)
	{
		//delete users
    	$pengguna = \App\User::findOrFail($id);
    	$pengguna->delete($pengguna);

		return redirect('petugas')->withSuccessMessage('Petugas berhasil dihapus');
	}

	public function profil($id)
	{
		$pengguna = \App\User::findOrFail($id);
		return view('petugas.profil',['pengguna' => $pengguna ]);
	}

	public function updateprofil($id, Request $request)
    {    	
    	$validator = Validator::make($request->all(),[
    		'nama' => 'required|min:3|max:50',
    		'jabatan' => 'required',
    		'no_hp'=> 'required|numeric',
    		'email' => 'required|email|regex:/^.+@.+$/i'
    	]);    	

    	if($validator->fails()){
    		// foreach ($validator->messages()->getMessages() as $field_name => $messages)
		    // {
		    //     var_dump($messages); // messages are retrieved (publicly)
		    // }
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

	    	//update user
	    	$user = \App\User::findOrFail($id);
	    	// $user->role = $request->role;
	    	$user->nama = $request->nama;
	    	$user->jabatan = $request->jabatan;
	    	$user->no_hp =$request->no_hp;
	        $user->email = $request->email;
	        // $user->password = Hash::make('12345678');
    		// $user->remember_token = Str::random(60);
    		$user->save(); 

    		Alert::success('Berhasil', 'Data Profil berhasil diubah');
			return back();
		}
	}

	public function konfirmasi($id)
	{
		alert()->question('Peringatan !','Anda yakin akan menghapus data ?')
		->showConfirmButton('<a href="/petugas/'.$id.'/delete" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
		->showCancelButton('Batal', '#aaa')->reverseButtons();

		return redirect('petugas');
	}

	public function export_excel()
	{

		return Excel::download(new PetugasExport, 'petugas.xls', \Maatwebsite\Excel\Excel::XLS);
	
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
		$file->move('file_petugas',$nama_file);
 
		// import data
		// $import = new PetugasImport();
		// $import->public_path('/file_petugas/'.$nama_file);
		// $import->onlySheets('')
		if(Excel::import(new PetugasImport, public_path('/file_petugas/'.$nama_file))){
		// if($import->validate fails){
			return redirect('petugas')->withSuccessMessage('Data berhasil diimport');
		}
		else
		{

    		Alert::error('Gagal', 'Terdapat eror');
		}
 
		// alihkan halaman kembali

	}

	public function getJabatan($id_petugas)
    {
        $jabatan = User::where('id',$id_petugas)->pluck('jabatan');
		return json_encode($jabatan);
    }
}
