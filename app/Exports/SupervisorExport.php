<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Simonas_Kegiatan;
use App\Simonas_Supervisor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SupervisorExport implements FromCollection, WithStrictNullComparison, WithHeadings, WithStyles
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {    	

    	$supervisors = DB::table('simonas_supervisor')
            ->join('simonas_kegiatan', 'simonas_supervisor.kegiatan_id', '=', 'simonas_kegiatan.id')
            ->select('simonas_kegiatan.nama_keg', 'simonas_kegiatan.periode', 'simonas_kegiatan.tahun', 'simonas_supervisor.nama', 'simonas_supervisor.no_hp','simonas_supervisor.email') 
            ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();

        return $supervisors;
    }

    public function headings(): array

    {

        return [

        	'Nama Kegiatan',

        	'Periode',

        	'Tahun ',

            'Nama',

            'Nomor HP',

            'Email',

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
