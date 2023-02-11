<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_Petugas extends Model
{
    use HasFactory;

    protected $table = 'simonas_petugas';
    protected $fillable = ['user_id','petugas_kegiatan_id','nama','kode','status','jabatan','no_hp','email'];


    public function simonas_kegiatan()
    {
        return $this->belongsToMany(Simonas_Kegiatan::class,'simonas_petugas_kegiatan', 'petugas_id', 'kegiatan_id');	
    }
}
