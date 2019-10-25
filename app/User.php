<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Absen;
use App\Status;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nama', 'username', 'email',
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

    public function Absen()
    {
        return $this->hasMany(Absen::class);
    }

    public function Status()
    {
        return $this->belongsTo(Status::class);
    }

    public function onwsAbsen(Absen $absen)
    {
        return auth()->id() === $absen->user->id;
    }

    public function ownsStatus(Status $status)
    {
        return auth()->id() === $status->user->id;
    }
}
