<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $connection = 'pgsql';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'penempatan',
        'jabatan',
        'sektor',
        'allowed'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tracking()
    {
        return $this->hasMany(Tracking::class, 'id_user', 'id');
    }

    public function survey()
    {
        return $this->hasMany(Survey::class, 'id_user', 'id');
    }

    public function perkembangan()
    {
        return $this->hasMany(SurveyPerkembangan::class, 'id_user', 'id');
    }

    public function perkembangan_today()
    {
        return $this->hasMany(SurveyPerkembangan::class, 'id_user', 'id')->whereDate('date', today());
    }

    public function image()
    {
        return $this->hasMany(SurveyPerkembanganImage::class, 'id_survey', 'id');
    }

    public function kegiatan()
    {
        return $this->hasMany(KegiatanUser::class, 'id_user', 'id');
    }

    public function lingkungan_perhari()
    {
        return $this->hasMany(IzinLingkungan::class, 'id_user', 'id')->whereDate('update_time', today());
    }

    public function lingkungan_total()
    {
        return $this->hasMany(IzinLingkungan::class, 'id_user', 'id');
    }

    public function pendataan()
    {
        return $this->hasMany(PendataanUsaha::class, 'id_user', 'id');
    }

    public function input_pendataa_perhari()
    {
        return $this->hasMany(PendataanUsaha::class, 'id_user', 'id')->whereDate('tgl', today());
    }

    public function status_pegawai()
    {
        return $this->hasOne(StatusPegawai::class, 'id', 'id_status_pegawai');
    }

    public function harian_aksesibilitas()
    {
        return $this->hasMany(SurveyAksesibilitas::class, 'id_user', 'id')->whereDate('created_at', today());
    }

    public function total_aksesibilitas()
    {
        return $this->hasMany(SurveyAksesibilitas::class, 'id_user', 'id');
    }
}
