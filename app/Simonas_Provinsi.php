<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_Provinsi extends Model
{
    use HasFactory;

    protected $table = 'simonas_provinsi';
    protected $fillable = ['kode','provinsi'];
}
