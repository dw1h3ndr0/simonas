<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_Supervisor extends Model
{
    use HasFactory;
    protected $table = 'simonas_supervisor';
    protected $fillable = ['user_id','kegiatan_id','nama','no_hp','email'];
}
