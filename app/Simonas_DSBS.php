<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_DSBS extends Model
{
    use HasFactory;

    protected $table = 'simonas_dsbs';
    protected $fillable = [
    	'kegiatan_id',
    	'provinsi_id',
    	'kabupaten_id',
    	'kecamatan_id',
    	'desa_id',
    	'nks',
    	'nbs'
    ];

    public function simonas_kegiatan()
    {
        return $this->belongsTo(Simonas_Kegiatan::class,'kegiatan_id');
    }

    public function simonas_user_dsbs()
    {
        return $this->hasMany(Simonas_User_DSBS::class);
    }

    public function users()
    {
        return $this->belongsToMany(Users::class, 'simonas_user_kegiatan','dsbs_id','user_id');
    }
}
