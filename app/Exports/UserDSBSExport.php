<?php

namespace App\Exports;

use App\Simonas_User_DSBS;
use Maatwebsite\Excel\Concerns\FromCollection;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserDSBSExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data_alokasi = DB::table('simonas_user_dsbs')
            ->leftJoin('users as petugas', 'simonas_user_dsbs.user_id', '=', 'petugas.id')
            ->leftJoin('users as leader', 'simonas_user_dsbs.leader', '=', 'leader.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->leftJoin('simonas_kegiatan','simonas_user_dsbs.kegiatan_id','=','simonas_kegiatan.id')
            ->select('simonas_kegiatan.nama_keg','simonas_kegiatan.periode','simonas_kegiatan.tahun', 'simonas_dsbs.nks', 'petugas.nama as namaPetugas', 'petugas.jabatan as jabatan', 'simonas_user_dsbs.status', 'simonas_user_dsbs.kode', 'leader.nama as namaLeader') 
            // ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();

        // dd($data_alokasi);    
        return $data_alokasi;
    }

    public function headings(): array

    {

        return [

        	'Nama Kegiatan',

        	'Periode',

        	'Tahun',

        	'NKS',

        	'Nama Petugas',

            'Jabatan',

        	'Status',

            'Kode Petugas',

            'Pengawas' 	

        ];

    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}
