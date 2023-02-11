<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'simonas_kabupaten';
    protected $fillable = ['provinsi_id','kode','kabupaten'];
}
