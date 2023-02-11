<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'simonas_kegiatan';
    protected $fillable = ['tahun','nama_keg','periode'];

    public function users()
    {
    	return $this->belongsToMany(Users::class, 'simonas_user_kegiatan','kegiatan_id','user_id');
    }

    public function petugas()
    {
    	return $this->belongsToMany(Petugas::class, 'simonas_petugas_kegiatan','kegiatan_id','petugas_id');
    }

    public function simonas_dsbs()
    {
        return $this->hasMany(Simonas_DSBS::class);
    }

    public function simonas_user_kegiatan()
    {
        return $this->hasMany(Simonas_User_DSBS::class);
    }

    public function simonas_sampel()
    {
        return $this->hasMany(Simonas_Sampel::class);
    }

    public function simonas_dokumen()
    {
        return $this->hasMany(Simonas_Dokumen::class);
    }

    public function simonas_listing()
    {
        return $this->hasMany(Simonas_Listing::class);
    }

}
