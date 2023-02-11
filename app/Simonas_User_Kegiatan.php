<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_User_Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'simonas_user_kegiatan';
    protected $fillable = ['user_id','kegiatan_id'];
}
