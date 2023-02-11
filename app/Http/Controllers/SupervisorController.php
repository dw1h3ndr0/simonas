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

use App\Exports\SupervisorExport;
use App\Imports\SupervisorImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class SupervisorController extends Controller
{
    public function index()
    {
    	$data_kegiatan = \App\Simonas_Kegiatan::all();
    	$data_supervisor = \App\Simonas_Supervisor::all();

    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}
    	
    	return view('petugas.supervisor',[
    		'data_kegiatan' => $data_kegiatan,
    		'data_supervisor' => $data_supervisor]);
    }

    public function tambah(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    		'add_kegiatan_id' => 'required|numeric',
    		'add_nama' => 'required|min:3|max:50',
    		'add_no_hp'=> 'required|numeric',
    		'add_email' => 'required|email|regex:/^.+@.+$/i'
    	]);

    	// dd($request);

    	if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

    		//insert ke tabel users
    		$user = new \App\User;
    		$user->role = 'admin';	
    		$user->name = $request->add_nama;
    		$user->email = $request->add_email;
    		$user->password = Hash::make('12345678');
    		$user->remember_token = Str::random(60);
    		$user->save();

    		//insert ke tabel user_kegiatan
    		$user->simonas_kegiatan()->attach($request->add_kegiatan_id);

    		//insert ke tabel simonas_supervisor
	    	\App\Simonas_Supervisor::create([
	    		'user_id' => $user->id,
    			'kegiatan_id' => $request->add_kegiatan_id,
    			'nama' => $request->add_nama,
    			'no_hp' => $request->add_no_hp,
    			'email' => $request->add_email,
			]);    	

			//insert ke tabel simonas_petugas
			$petugas = new \App\Simonas_Petugas;
			$petugas->user_id = $user->id;    		
			$petugas->nama = $request->add_nama;
			$petugas->status = 'supervisor';
			$petugas->no_hp = $request->add_no_hp;
			$petugas->email = $request->add_email;
			$petugas->save();			

			//insert ke tabel petugas_kegiatan
    		$petugas->simonas_kegiatan()->attach($request->add_kegiatan_id);

	    	return redirect('supervisor')->withSuccessMessage('Supervisor berhasil ditambahkan');  		
    	}

    }

    public function edit(Request $request)
    {
    	$data = \App\Simonas_Supervisor::findOrFail($request->get('id'));
		// $data = \App\Simonas_Petugas::findOrFail($request->get('id'));
		
		echo json_encode($data);
    }

    public function update(Request $request)
    {    	
    	$validator = Validator::make($request->all(),[
    		// 'kegiatan_id' => 'required|numeric',
    		'nama' => 'required|min:3|max:50',
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
	    	//update simonas_supervisor
	    	$supervisor = \App\Simonas_Supervisor::findOrFail($request->post('id'));
	    	$supervisor->update($request->all());

	    	//update user
	    	$user = \App\User::findOrFail($request->post('id'));
	    	$user->kegiatan_id = $request->kegiatan_id;
	    	$user->name = $request->nama;
	        $user->email = $request->email;
	        // $user->password = Hash::make('12345678');
    		// $user->remember_token = Str::random(60);
    		$user->save(); 

			return redirect('supervisor')->withSuccessMessage('Data berhasil diubah');
		}
	}

	public function delete($id)
	{
		$supervisor = \App\Simonas_Supervisor::findOrFail($id);
		
    	//delete users
    	$pengguna = \App\User::findOrFail($supervisor->user_id);
    	$pengguna->delete($pengguna);

		//delete simonas_supervisor
    	$supervisor->delete($supervisor);

		return redirect('supervisor')->withSuccessMessage('Supervisor berhasil dihapus');
	}

	public function konfirmasi($id)
	{
		alert()->question('Peringatan !','Anda yakin akan menghapus data ?')
		->showConfirmButton('<a href="/supervisor/'.$id.'/delete" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
		->showCancelButton('Batal', '#aaa')->reverseButtons();

		return redirect('supervisor');
	}

	public function export_excel()
	{

		return Excel::download(new SupervisorExport, 'supervisor.xls', \Maatwebsite\Excel\Excel::XLS);
	
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
		$file->move('file_supervisor',$nama_file);
 
		// import data
		// $import = new SupervisorImport();
		// $import->onlySheets('')
		Excel::import(new SupervisorImport, public_path('/file_supervisor/'.$nama_file));
 
		// alihkan halaman kembali
		return redirect('supervisor')->withSuccessMessage('Data berhasil diimport');
	}
}
