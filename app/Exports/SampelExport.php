<?php

namespace App\Exports;

use App\Simonas_Sampel;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Simonas_DSBS;
use App\Simonas_User_DSBS;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SampelExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$data_sampel = DB::table('simonas_sampel')
    		->leftJoin('simonas_user_dsbs','simonas_sampel.user_dsbs_id','=','simonas_user_dsbs.id')
            ->leftJoin('simonas_dsbs','simonas_user_dsbs.dsbs_id','=','simonas_dsbs.id')
            ->select('simonas_dsbs.provinsi_id', 'simonas_dsbs.kabupaten_id', 'simonas_sampel.nks', 'simonas_sampel.nus', 'simonas_sampel.status', 'simonas_sampel.p1', 'simonas_sampel.p2', 'simonas_sampel.p3', 'simonas_sampel.p4', 'simonas_sampel.p5' ) 
            // ->where('simonas_supervisor.kegiatan_id', '=', Auth::user()->kegiatan_id )
            ->get();

        return $data_sampel;
    }

    public function headings(): array

    {

        return [

        	'kode prop [2 digit]',

        	'kode kabupaten [2 digit]',

        	'kode NKS [5 digit]',

        	'Nomor Urut Ruta [max: 2 digit]',

        	'Sudah Selesai? [sudah/belum]',

            'Jumlah ART (R301)',

        	'BIV.3.2. R16 Kolom 3',

            'BIV.3.3 R8 Kolom 3',

            'R304',

            'R305' 	

        ];

    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => [
            		'font' => [
            			'bold' => false,
            			'color' => [
            				'argb' => 'FFFFFFFF'
            			]
            		],
            		 'alignment' => [
            		 	'wrapText' => true, 
            		 	'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
					    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            		],
            		'fill' => [
				        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				        'startColor' => [
				            'argb' => '0070C0',
				        ],
				        'endColor' => [
				            'argb' => '0070C0',
				        ],
        			],
        			// 'borders' => [
        			// 	'inside'=> [
        			// 		'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
        			// 		'color' => ['argb' => 'FFFFFF']
        			// 	]
        			// ],         				
        		],        		

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}
