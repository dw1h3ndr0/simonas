<?php

namespace App\Exports;

use App\Simonas_DSBS;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DSBSExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

    	$dsbs = DB::table('simonas_dsbs')
            ->join('simonas_kegiatan', 'simonas_dsbs.kegiatan_id', '=', 'simonas_kegiatan.id')
            ->select('simonas_kegiatan.nama_keg', 'simonas_kegiatan.periode', 'simonas_kegiatan.tahun', 'simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id','simonas_dsbs.kecamatan_id','simonas_dsbs.desa_id','simonas_dsbs.nbs','simonas_dsbs.nks') 
            // ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();

    	// $dsbs = DB::table('simonas_dsbs')->select('role', 'nama', 'jabatan', 'no_hp', 'email')->get();

        return $dsbs;
    }

     public function headings(): array

    {

        return [

        	'Nama Kegiatan',

        	'Periode',

        	'Tahun',

            'Provinsi',

        	'Kabupaten',

            'Kecamatan',        	

            'Desa/Keluaran',

            'NBS',

            'NKS'

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
