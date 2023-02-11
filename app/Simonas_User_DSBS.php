<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simonas_User_DSBS extends Model
{
    use HasFactory;

    protected $table = 'simonas_user_dsbs';
    protected $fillable = [
    	'user_id',
    	'dsbs_id',
    	'kegiatan_id',
    	'status',
    	'leader',
    	'kode',
    ];

    public function simonas_dsbs()
    {
        return $this->belongsTo(Simonas_DSBS::class,'dsbs_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function users_leader()
    {
        return $this->belongsTo(User::class,'leader');
    }

    public function simonas_kegiatan()
    {
        return $this->belongsTo(Simonas_Kegiatan::class,'kegiatan_id');
    }
}
