<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Absen;
use App\Status;

class Absen extends Model
{
    protected $table = 'absen';

    protected $fillable = [
        'id','user_id','status_id','date','nama', 'email', 'time_in', 'time_out', 'note'
    ];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id','DESC');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
