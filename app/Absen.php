<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Absen;

class Absen extends Model
{
    protected $fillable = [
        'id','user_id','status','keterangan',
    ];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id','DESC');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
