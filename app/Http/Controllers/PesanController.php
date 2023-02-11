<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PesanController extends Controller
{
    public function index()
    {
    	$users = \App\User::all();
    	$data_pesan = \App\Simonas_Pesan::all();

    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}

    	return view('pesan.index', [
    		'users' => $users,
    		'data_pesan' => $data_pesan]);
    }

    public function send(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    		'judul' => 'required',
    		'pesan' => 'required',
    	]);

    	if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

    		$list_penerima = [];

    		if($request->jenis_penerima == 'petugas'){

    			$user = \App\User::findOrFail($request->petugas);
				$list_penerima['id'][] = $user->id;
				$list_penerima['phone'][] = $user->no_hp;
				$list_penerima['nama'][] = $user->nama;

				if( \App\Simonas_User_DSBS::where('user_id',$user->id)->pluck('status')->first() == 'PCL'){
					$sampel = \App\Simonas_Sampel::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pcl_id','=',$user->id)
		            ->get();

		            $dokumen = \App\Simonas_Dokumen::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pcl_id','=',$user->id)
		            ->get();    

		        	$listing = \App\Simonas_Listing::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pcl_id','=',$user->id)
		            ->get();
				}else {
					
					$sampel = \App\Simonas_Sampel::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pml_id','=',$user->id)
		            ->get();

		            $dokumen = \App\Simonas_Dokumen::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pml_id','=',$user->id)
		            ->get();    

		        	$listing = \App\Simonas_Listing::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pml_id','=',$user->id)
		            ->get();
				}

    		}elseif ($request->jenis_penerima == 'pml' ) {
    			$daftar_user_dsbs = DB::table('simonas_user_dsbs')->select('user_id')->distinct()->where('status','PML')->get();
    			foreach ($daftar_user_dsbs as $user_dsbs) {
    				$user = \App\User::findOrFail($user_dsbs->user_id);	
    				$list_penerima['id'][] = $user->id;
    				$list_penerima['phone'][] = $user->no_hp;
    				$list_penerima['nama'][] = $user->nama;

    				$sampel = \App\Simonas_Sampel::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pml_id','=',$user->id)
		            ->get();

		            $dokumen = \App\Simonas_Dokumen::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pml_id','=',$user->id)
		            ->get();    

		        	$listing = \App\Simonas_Listing::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pml_id','=',$user->id)
		            ->get();
    			}
    		}elseif ($request->jenis_penerima == 'pcl') {
    			$daftar_user_dsbs = DB::table('simonas_user_dsbs')->select('user_id')->distinct()->where('status','PCL')->get();
    			foreach ($daftar_user_dsbs as $user_dsbs) {
    				$user = \App\User::findOrFail($user_dsbs->user_id);	
    				$list_penerima['id'][] = $user->id;
    				$list_penerima['phone'][] = $user->no_hp;
    				$list_penerima['nama'][] = $user->nama;

					$sampel = \App\Simonas_Sampel::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pcl_id','=',$user->id)
		            ->get();

		            $dokumen = \App\Simonas_Dokumen::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pcl_id','=',$user->id)
		            ->get();    

		        	$listing = \App\Simonas_Listing::select(
		            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
		            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
		            \DB::raw("COUNT(*) as target"))
		            ->where('kegiatan_id','=','1')
		            ->where('pcl_id','=',$user->id)
		            ->get();
    			}
    		}

    		$request->pesan = Str::replaceArray('#RL', [$listing[0]->selesai,$listing[0]->selesai,$listing[0]->selesai,$listing[0]->selesai,$listing[0]->selesai], $request->pesan);
    		$request->pesan = Str::replaceArray('#TL', [$listing[0]->target,$listing[0]->target,$listing[0]->target,$listing[0]->target,$listing[0]->target], $request->pesan);
    		$request->pesan = Str::replaceArray('#RC', [$sampel[0]->selesai,$sampel[0]->selesai,$sampel[0]->selesai,$sampel[0]->selesai,$sampel[0]->selesai], $request->pesan);
    		$request->pesan = Str::replaceArray('#TC', [$sampel[0]->target,$sampel[0]->target,$sampel[0]->target,$sampel[0]->target,$sampel[0]->target], $request->pesan);
    		$request->pesan = Str::replaceArray('#RD', [$dokumen[0]->selesai,$dokumen[0]->selesai,$dokumen[0]->selesai,$dokumen[0]->selesai,$dokumen[0]->selesai], $request->pesan);
    		$request->pesan = Str::replaceArray('#TD', [$dokumen[0]->target,$dokumen[0]->target,$dokumen[0]->target,$dokumen[0]->target,$dokumen[0]->target], $request->pesan);
    		
    		$judul = "*$request->judul*";
    		$message = "
$judul

$request->pesan
";
			// dd($message);
			for ($i=0; $i<count($list_penerima['phone']); $i++){
			// foreach ($list_penerima as $penerima) {
				$kirim = $this->send_wa_message($list_penerima['phone'][$i], $message);
				dd($kirim);
				$pesan = new \App\Simonas_Pesan;				
				$pesan->user_id = $list_penerima['id'][$i];
				$pesan->judul = $request->judul;
				$pesan->pesan = $message;
				$pesan->penerima = $list_penerima['nama'][$i];
				$pesan->no_penerima = $list_penerima['phone'][$i];
				$pesan->save();
			}

    		return redirect('pesan')->withSuccessMessage('Pesan Berhasil Dikirim');
    	}
    }

    public function send_wa_message($phone, $message)
    {
        $curl = curl_init();
        $token = "qxKrOh9ME9GL8Zk9JMovLNBaqAG09CaaL4q5xAAHXgrMCTEFCUe5yyeoOGW2R53z";
        $data = [
            'phone' => $phone,
            'message' => $message,
		    'secret' => false, // or true
		    'priority' => false, // or true
        ];

        $url = "https://sawit.wablas.com/api/send-message";
       
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }
}
