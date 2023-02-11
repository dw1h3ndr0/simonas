<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $sampel = \App\Simonas_Sampel::select(
            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
            \DB::raw("COUNT(*) as target"))
            ->where('kegiatan_id','=','1')
            ->get();
        // dd($sampel[0]->selesai);
        
        $dokumen = \App\Simonas_Dokumen::select(
            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
            \DB::raw("COUNT(*) as target"))
            ->where('kegiatan_id','=','1')
            ->get();    

        $listing = \App\Simonas_Listing::select(
            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as selesai"), 
            \DB::raw("COUNT(case when status = 'Belum' then 1 end) as belum"), 
            \DB::raw("COUNT(*) as target"))
            ->where('kegiatan_id','=','1')
            ->get();

        $realisasiToday = \App\Simonas_Sampel::whereDate('updated_at', Carbon::today())
            ->where('kegiatan_id','=','1')
            ->where('status','=','Selesai')
            ->count();

        $kegiatan = \App\Simonas_Kegiatan::findOrFail(1);
        $begin = new DateTime($kegiatan->mulai);
        $end   = new DateTime($kegiatan->selesai);
        // $begin = new DateTime('2021-05-27');
        // $end   = new DateTime('2021-06-15');

        $data = [];
        $realisasi =[];        

        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            // echo $i->format("Y-m-d");
            $data['labelArea'][] = $i->format("d-m-Y");
            $realisasi[] = \App\Simonas_Sampel::whereDate('created_at', $i)
            ->where('kegiatan_id','=','1')
            ->where('status','=','Selesai')
            ->count();
            // $realisasi[] = 2;
        }    

        //hitung kumulatif
        for ($i=0; $i<count($realisasi); $i++){
            $total = 0;
            for($j=0; $j<=$i; $j++){
                $total = $total + $realisasi[$j];
            }
            $data['dataArea'][]= $total;
        }

        $data['sampelSelesai'] = $sampel[0]->selesai;
        $data['sampelProses'] = $sampel[0]->belum;
        $data['sampelBelum'] = $sampel[0]->target - $sampel[0]->selesai - $sampel[0]->belum;
        
        $data['dokumenSelesai'] = $dokumen[0]->selesai;
        $data['dokumenProses'] = $dokumen[0]->belum;
        $data['dokumenBelum'] = $dokumen[0]->target - $dokumen[0]->selesai - $dokumen[0]->belum;

        $data['listingSelesai'] = $listing[0]->selesai;
        $data['listingProses'] = $listing[0]->belum;
        $data['listingBelum'] = $listing[0]->target - $listing[0]->selesai - $listing[0]->belum;

        if($sampel[0]->target == 0){
            $data['sampelCapaian'] = 0;
            $data['dokumenCapaian'] = 0;
            $data['listingCapaian'] = 0;
        }else{            
            $data['sampelCapaian'] = number_format($sampel[0]->selesai/$sampel[0]->target*100,2);
            $data['dokumenCapaian'] = number_format($dokumen[0]->selesai/$dokumen[0]->target*100,2);
            $data['listingCapaian'] = number_format($listing[0]->selesai/$listing[0]->target*100,2);
        }

        $data['totalTarget'] = $sampel[0]->target;
        $data['totalRealisasi'] = $sampel[0]->selesai;
        $data['realisasiToday'] = $realisasiToday;

        $recordSampel = \App\Simonas_Sampel::select(
            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as realisasi"), 
            'pml_id', 
            \DB::raw("COUNT(*) as target"))
            ->where('kegiatan_id','=','1')  
            ->groupBy('pml_id')
            ->orderBy('pml_id')
            ->get();

        foreach($recordSampel as $row) {          
            $selesai = (int) $row->realisasi;
            $target = (int) $row->target;
                
            // $data['label'][] = \App\User::findOrFail($row->pml_id)->nama;
            // $data['selesai'][] = $selesai;
            // $data['belum'][] = $target - $selesai;
            $data['realisasiSampel'][]= number_format(($selesai/$target*100),2);
        }

        $recordDokumen = \App\Simonas_Dokumen::select(
            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as realisasi"), 
            'pml_id', 
            \DB::raw("COUNT(*) as target"))
            ->where('kegiatan_id','=','1')  
            ->groupBy('pml_id')
            ->orderBy('pml_id')
            ->get();

        foreach($recordDokumen as $row) {          
            $selesai = (int) $row->realisasi;
            $target = (int) $row->target;
                
            // $data['label'][] = \App\User::findOrFail($row->pml_id)->nama;
            // $data['selesai'][] = $selesai;
            // $data['belum'][] = $target - $selesai;
            $data['realisasiDokumen'][]= number_format(($selesai/$target*100),2);
        }

        $recordListing = \App\Simonas_Listing::select(
            \DB::raw("COUNT(case when status = 'Selesai' then 1 end) as realisasi"), 
            'pml_id', 
            \DB::raw("COUNT(*) as target"))
            ->where('kegiatan_id','=','1')  
            ->groupBy('pml_id')
            ->orderBy('pml_id')
            ->get();

        foreach($recordListing as $row) {          
            $selesai = (int) $row->realisasi;
            $target = (int) $row->target;
                
            $data['label'][] = \App\User::findOrFail($row->pml_id)->nama;
            // $data['selesai'][] = $selesai;
            // $data['belum'][] = $target - $selesai;
            $data['realisasiListing'][]= number_format(($selesai/$target*100),2);
        }

        $data['dashboard'] = json_encode($data);
        // dd($data);
        return view('home', $data)->with('data', $data);
    }
}
