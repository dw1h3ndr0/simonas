<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_Pesan extends Model
{
    use HasFactory;

    protected $table = 'simonas_pesan';
    protected $fillable = ['user_id','judul','pesan','penerima','no_penerima'];
}
