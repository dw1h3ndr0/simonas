<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_Desa extends Model
{
    use HasFactory;

    protected $table = 'simonas_desa';
    protected $fillable = ['provinsi_id','kabupaten','kecamatan_id','kode','desa'];
}
