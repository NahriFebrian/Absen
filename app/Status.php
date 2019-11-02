<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Absen;
use App\User;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable = [
    	'id','keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function absen()
    {
        return $this->hasOne(Absen::class);
    } 
}
