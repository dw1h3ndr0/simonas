<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_Petugas_Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'simonas_petugas_kegiatan';
    protected $fillable = ['petugas_id','kegiatan_id'];
}
