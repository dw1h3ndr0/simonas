<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_Listing extends Model
{
    use HasFactory;

    protected $table = 'simonas_listing';
    protected $fillable = ['user_dsbs_id','kegiatan_id','pml_id','pcl_id','nks','status','p1'];


    public function simonas_kegiatan()
    {
        return $this->belongsTo(Simonas_Kegiatan::class,'kegiatan_id');
    }

    public function user_pcl()
    {
        return $this->belongsTo(User::class,'pcl_id');
    }

    public function user_pml()
    {
        return $this->belongsTo(User::class,'pml_id');
    }
}
