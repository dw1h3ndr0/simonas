<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'simonas_kecamatan';
    protected $fillable = ['provinsi_id','kabupaten_id','kode','kecamatan'];
}
