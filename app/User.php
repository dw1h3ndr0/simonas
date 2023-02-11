<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'nama', 'jabatan', 'no_hp', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function simonas_kegiatan()
    {
        return $this->belongsToMany(Simonas_Kegiatan::class,'simonas_user_kegiatan', 'user_id', 'kegiatan_id');
    }

    public function simonas_user_dsbs()
    {
        return $this->hasMany(Simonas_User_DSBS::class);
    }

    public function simonas_dsbs()
    {
        return $this->belongsToMany(Simonas_DSBS::class,'simonas_user_dsbs', 'user_id', 'dsbs_id');
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
