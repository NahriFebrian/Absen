<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Absen;

class Absen extends Model
{
    protected $table = 'absen';
    protected $fillable = [
        'user_id', 'date', 'nama', 'email', 'time_in', 'time_out', 'note'
    ];
}
